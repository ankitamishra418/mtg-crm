<?php

use app\services\utilities\Arr;

defined('BASEPATH') or exit('No direct script access allowed');

class Clients_model extends App_Model
{
    private $contact_columns;

    public function __construct()
    {
        parent::__construct();

        $this->contact_columns = hooks()->apply_filters('contact_columns', ['firstname', 'lastname', 'email', 'phonenumber', 'title', 'password', 'send_set_password_email', 'donotsendwelcomeemail', 'permissions', 'direction', 'invoice_emails', 'estimate_emails', 'credit_note_emails', 'contract_emails', 'task_emails', 'project_emails', 'ticket_emails', 'is_primary']);

        $this->load->model(['client_vault_entries_model', 'client_groups_model', 'statement_model']);
    }

    /**
     * Get client object based on passed clientid if not passed clientid return array of all clients
     * @param  mixed $id    client id
     * @param  array  $where
     * @return mixed
     */
    public function get($id = '', $where = [])
    {
        $this->db->select(implode(',', prefixed_table_fields_array(db_prefix() . 'clients')) . ',' . get_sql_select_client_company());

        $this->db->join(db_prefix() . 'countries', '' . db_prefix() . 'countries.country_id = ' . db_prefix() . 'clients.country', 'left');
        $this->db->join(db_prefix() . 'contacts', '' . db_prefix() . 'contacts.userid = ' . db_prefix() . 'clients.userid AND is_primary = 1', 'left');
        if ((is_array($where) && count($where) > 0) || (is_string($where) && $where != '')) {
            $this->db->where($where);
        }

        if (is_numeric($id)) {
            $this->db->where(db_prefix() . 'clients.userid', $id);
            $client = $this->db->get(db_prefix() . 'clients')->row();

            if ($client && get_option('company_requires_vat_number_field') == 0) {
                $client->vat = null;
            }

            $GLOBALS['client'] = $client;
            return $client;
        }

        $this->db->order_by('company', 'asc');


        return $this->db->get(db_prefix() . 'clients')->result_array();
    }

    /**
     * Get customers contacts
     * @param  mixed $customer_id
     * @param  array  $where       perform where in query
     * @return array
     */
    public function get_contacts($customer_id = '', $where = ['active' => 1])
    {
        $this->db->where($where);
        if ($customer_id != '') {
            $this->db->where('userid', $customer_id);
        }

        $this->db->order_by('is_primary', 'DESC');

        return $this->db->get(db_prefix() . 'contacts')->result_array();
    }

    public function getKeyContact($userid)
    {
        $this->db->select('*');
        $this->db->from('tblcontacts');
        $this->db->where('userid', $userid);
        $this->db->where('contact_key', 1);
        $query = $this->db->get();
        $result = $query->result_array();
        $residential_country = $result[0]['residential_country'];
        $this->db->select('short_name');
        $this->db->from('tblcountries');
        $this->db->where('country_id', $residential_country);
        $query1 = $this->db->get();
        $result1 = $query1->result_array();
        $result[0]['residential_country'] = $result1[0]['short_name'];
        return $result;
    }
    public function check_key_contact($userid)
    {
        $this->db->select('*');
        $this->db->from('tblcontacts');
        $this->db->where('userid', $userid);
        $this->db->where('contact_key', 1);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function key_contact_address($userid)
    {
        $this->db->select('*');
        $this->db->from('tblcontacts');
        $this->db->where('userid', $userid);
        $this->db->where('contact_key', 1);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function get_active_contacts($customer_id = '', $where = ['active' => 1])
    {
        $this->db->where($where);
        if ($customer_id != '') {
            $this->db->where('userid', $customer_id);
        }

        $this->db->group_by('email');
        return $this->db->get(db_prefix() . 'contacts')->result_array();
    }

    /**
     * Get customers contacts
     * @param  mixed $customer_id
     * @param  array  $where       perform where in query
     * @return array
     */
    public function get_NotBelongToContacts($customer_id = '', $where = ['active' => 1])
    {
        $this->db->where($where);
        if ($customer_id != '') {
            $this->db->where('userid !=', $customer_id);
        }

        $this->db->order_by('is_primary', 'DESC');

        return $this->db->get(db_prefix() . 'contacts')->result_array();
    }

    /**
     * Get single contacts
     * @param  mixed $id contact id
     * @return object
     */
    public function get_contact($id)
    {
        $this->db->where('id', $id);

        return $this->db->get(db_prefix() . 'contacts')->row();
    }

    /**
     * Get contact by given email
     *
     * @since 2.8.0
     *
     * @param  string $email
     *
     * @return \strClass|null
     */
    public function get_contact_by_email($email)
    {
        $this->db->where('email', $email);
        $this->db->limit(1);

        return $this->db->get('contacts')->row();
    }

    /**
     * @param array $_POST data
     * @param withContact
     *
     * @return integer Insert ID
     *
     * Add new client to database
     */
    public function add($data, $withContact = false)
    {
        //this is for adviser data due to show adviser in client Grid.
        if (isset($data['adviser_data'])) {
            foreach ($data['adviser_data'] as $adviser) {
                $adviser;
                $this->db->select('firstname , lastname , email_signature');
                $this->db->where('staffid', $adviser);
                $this->db->from('tblstaff');
                $query = $this->db->get();
                $result = $query->result_array();
                $email_signature = $result[0]['email_signature'];
                unset($result[0]['email_signature']);
                $single_array = array_merge(...$result);
            }
            ;
        }
        ;
        unset($data['adviser_data']);
        $data['adviser_data_contact'] = implode(' ', $single_array);
        $data['vat'] = implode(' ', $single_array);
        $data['address'] = $email_signature;

        $data = $this->check_zero_columns($data);

        $data = hooks()->apply_filters('before_client_added', $data);

        $contact_data = [];
        foreach ($this->contact_columns as $field) {
            if (!isset($data[$field])) {
                continue;
            }

            $contact_data[$field] = $data[$field];

            // Phonenumber is also used for the company profile
            if ($field != 'phonenumber') {
                unset($data[$field]);
            }
        }

        $groups_in = Arr::pull($data, 'groups_in') ?? [];
        $custom_fields = Arr::pull($data, 'custom_fields') ?? [];

        // From customer profile register
        if (isset($data['contact_phonenumber'])) {
            $contact_data['phonenumber'] = $data['contact_phonenumber'];
            unset($data['contact_phonenumber']);
        }

        $this->db->insert(db_prefix() . 'clients', array_merge($data, [
            'datecreated' => date('Y-m-d H:i:s'),
            'addedfrom' => is_staff_logged_in() ? get_staff_user_id() : 0,
        ]));

        $client_id = $this->db->insert_id();

        if ($client_id) {
            if (count($custom_fields) > 0) {
                $_custom_fields = $custom_fields;
                // Possible request from the register area with 2 types of custom fields for contact and for comapny/customer
                if (count($custom_fields) == 2) {
                    unset($custom_fields);
                    $custom_fields['customers'] = $_custom_fields['customers'];
                    $contact_data['custom_fields']['contacts'] = $_custom_fields['contacts'];
                } elseif (count($custom_fields) == 1) {
                    if (isset($_custom_fields['contacts'])) {
                        $contact_data['custom_fields']['contacts'] = $_custom_fields['contacts'];
                        unset($custom_fields);
                    }
                }

                handle_custom_fields_post($client_id, $custom_fields);
            }

            /**
             * Used in Import, Lead Convert, Register
             */
            if ($withContact == true) {
                $contact_id = $this->add_contact($contact_data, $client_id, $withContact);
            }

            foreach ($groups_in as $group) {
                $this->db->insert('customer_groups', [
                    'customer_id' => $client_id,
                    'groupid' => $group,
                ]);
            }

            $log = 'ID: ' . $client_id;

            if ($log == '' && isset($contact_id)) {
                $log = get_contact_full_name($contact_id);
            }

            $isStaff = null;

            if (!is_client_logged_in() && is_staff_logged_in()) {
                $log .= ', From Staff: ' . get_staff_user_id();
                $isStaff = get_staff_user_id();
            }

            do_action_deprecated('after_client_added', $client_id, '2.9.4', 'after_client_created');

            hooks()->do_action('after_client_created', [
                'id' => $client_id,
                'data' => $data,
                'contact_data' => $contact_data,
                'custom_fields' => $custom_fields,
                'groups_in' => $groups_in,
                'with_contact' => $withContact,
            ]);

            log_activity('New Client Created [' . $log . ']', $isStaff);
        }

        return $client_id;
    }

    /**
     * @param  array $_POST data
     * @param  integer ID
     * @return boolean
     * Update client informations
     */
    public function update($data, $id, $client_request = false)
    {
        //this is for adviser data due to show adviser in client Grid.
        if (isset($data['adviser_data'])) {
            foreach ($data['adviser_data'] as $adviser) {
                $adviser;
                $this->db->select('firstname , lastname , email_signature');
                $this->db->where('staffid', $adviser);
                $this->db->from('tblstaff');
                $query = $this->db->get();
                $result = $query->result_array();
                $email_signature = $result[0]['email_signature'];
                unset($result[0]['email_signature']);
                $single_array = array_merge(...$result);
            }
            ;
        }
        ;
        unset($data['adviser_data']);
        $data['adviser_data_contact'] = implode(' ', $single_array);
        $data['vat'] = implode(' ', $single_array);
        $data['address'] = $email_signature;

        $updated = false;
        $data = $this->check_zero_columns($data);

        $data = hooks()->apply_filters('before_client_updated', $data, $id);

        $update_all_other_transactions = (bool) Arr::pull($data, 'update_all_other_transactions');
        $update_credit_notes = (bool) Arr::pull($data, 'update_credit_notes');
        $custom_fields = Arr::pull($data, 'custom_fields') ?? [];
        $groups_in = Arr::pull($data, 'groups_in') ?? false;

        if (handle_custom_fields_post($id, $custom_fields)) {
            $updated = true;
        }

        $this->db->where('userid', $id);
        $this->db->update(db_prefix() . 'clients', $data);

        if ($this->db->affected_rows() > 0) {
            $updated = true;
        }

        if ($update_all_other_transactions || $update_credit_notes) {
            $transactions_update = [
                'billing_street' => $data['billing_street'],
                'billing_city' => $data['billing_city'],
                'billing_state' => $data['billing_state'],
                'billing_zip' => $data['billing_zip'],
                'billing_country' => $data['billing_country'],
                'shipping_street' => $data['shipping_street'],
                'shipping_city' => $data['shipping_city'],
                'shipping_state' => $data['shipping_state'],
                'shipping_zip' => $data['shipping_zip'],
                'shipping_country' => $data['shipping_country'],
            ];

            if ($update_all_other_transactions) {
                // Update all invoices except paid ones.
                $this->db->where('clientid', $id)
                    ->where('status !=', 2)
                    ->update('invoices', $transactions_update);

                if ($this->db->affected_rows() > 0) {
                    $updated = true;
                }

                // Update all estimates
                $this->db->where('clientid', $id)
                    ->update('estimates', $transactions_update);
                if ($this->db->affected_rows() > 0) {
                    $updated = true;
                }
            }

            if ($update_credit_notes) {
                $this->db->where('clientid', $id)
                    ->where('status !=', 2)
                    ->update('creditnotes', $transactions_update);

                if ($this->db->affected_rows() > 0) {
                    $updated = true;
                }
            }
        }

        if ($this->client_groups_model->sync_customer_groups($id, $groups_in)) {
            $updated = true;
        }

        do_action_deprecated('after_client_updated', $id, '2.9.4', 'client_updated');

        hooks()->do_action('client_updated', [
            'id' => $id,
            'data' => $data,
            'update_all_other_transactions' => $update_all_other_transactions,
            'update_credit_notes' => $update_credit_notes,
            'custom_fields' => $custom_fields,
            'groups_in' => $groups_in,
            'updated' => &$updated,
        ]);

        if ($updated) {
            log_activity('Customer Info Updated [ID: ' . $id . ']');
        }

        return $updated;
    }

    /**
     * Update contact data
     * @param  array  $data           $_POST data
     * @param  mixed  $id             contact id
     * @param  boolean $client_request is request from customers area
     * @return mixed
     */
    public function update_contact($data, $id, $client_request = false)
    {
        $affectedRows = 0;
        $contact = $this->get_contact($id);
        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = app_hash_password($data['password']);
            $data['last_password_change'] = date('Y-m-d H:i:s');
        }

        $send_set_password_email = isset($data['send_set_password_email']) ? true : false;
        $set_password_email_sent = false;

        $permissions = isset($data['permissions']) ? $data['permissions'] : [];
        $data['is_primary'] = isset($data['is_primary']) ? 1 : 0;

        // Contact cant change if is primary or not
        if ($client_request == true) {
            unset($data['is_primary']);
        }

        if (isset($data['custom_fields'])) {
            $custom_fields = $data['custom_fields'];
            if (handle_custom_fields_post($id, $custom_fields)) {
                $affectedRows++;
            }
            unset($data['custom_fields']);
        }

        if ($client_request == false) {
            $data['invoice_emails'] = isset($data['invoice_emails']) ? 1 : 0;
            $data['estimate_emails'] = isset($data['estimate_emails']) ? 1 : 0;
            $data['credit_note_emails'] = isset($data['credit_note_emails']) ? 1 : 0;
            $data['contract_emails'] = isset($data['contract_emails']) ? 1 : 0;
            $data['task_emails'] = isset($data['task_emails']) ? 1 : 0;
            $data['project_emails'] = isset($data['project_emails']) ? 1 : 0;
            $data['ticket_emails'] = isset($data['ticket_emails']) ? 1 : 0;
        }

        $data = hooks()->apply_filters('before_update_contact', $data, $id);

        $this->db->where('id', $id);
        $this->db->update(db_prefix() . 'contacts', $data);

        if ($this->db->affected_rows() > 0) {
            $affectedRows++;
            if (isset($data['is_primary']) && $data['is_primary'] == 1) {
                $this->db->where('userid', $contact->userid);
                $this->db->where('id !=', $id);
                $this->db->update(db_prefix() . 'contacts', [
                    'is_primary' => 0,
                ]);
            }
        }

        if ($client_request == false) {
            $customer_permissions = $this->roles_model->get_contact_permissions($id);
            if (sizeof($customer_permissions) > 0) {
                foreach ($customer_permissions as $customer_permission) {
                    if (!in_array($customer_permission['permission_id'], $permissions)) {
                        $this->db->where('userid', $id);
                        $this->db->where('permission_id', $customer_permission['permission_id']);
                        $this->db->delete(db_prefix() . 'contact_permissions');
                        if ($this->db->affected_rows() > 0) {
                            $affectedRows++;
                        }
                    }
                }
                foreach ($permissions as $permission) {
                    $this->db->where('userid', $id);
                    $this->db->where('permission_id', $permission);
                    $_exists = $this->db->get(db_prefix() . 'contact_permissions')->row();
                    if (!$_exists) {
                        $this->db->insert(db_prefix() . 'contact_permissions', [
                            'userid' => $id,
                            'permission_id' => $permission,
                        ]);
                        if ($this->db->affected_rows() > 0) {
                            $affectedRows++;
                        }
                    }
                }
            } else {
                foreach ($permissions as $permission) {
                    $this->db->insert(db_prefix() . 'contact_permissions', [
                        'userid' => $id,
                        'permission_id' => $permission,
                    ]);
                    if ($this->db->affected_rows() > 0) {
                        $affectedRows++;
                    }
                }
            }
            if ($send_set_password_email) {
                $set_password_email_sent = $this->authentication_model->set_password_email($data['email'], 0);
            }
        }

        if (($client_request == true) && $send_set_password_email) {
            $set_password_email_sent = $this->authentication_model->set_password_email($data['email'], 0);
        }

        if ($affectedRows > 0) {
            hooks()->do_action('contact_updated', $id, $data);
        }

        if ($affectedRows > 0 && !$set_password_email_sent) {
            log_activity('Contact Updated [ID: ' . $id . ']');

            return true;
        } elseif ($affectedRows > 0 && $set_password_email_sent) {
            return [
                'set_password_email_sent_and_profile_updated' => true,
            ];
        } elseif ($affectedRows == 0 && $set_password_email_sent) {
            return [
                'set_password_email_sent' => true,
            ];
        }

        return false;
    }
    public function update_contact_email($data, $id, $client_request = false)
    {
        $affectedRows = 0;
        $contact = $this->get_contact($id);
        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = app_hash_password($data['password']);
            $data['last_password_change'] = date('Y-m-d H:i:s');
        }

        $send_set_password_email = isset($data['send_set_password_email']) ? true : false;
        $set_password_email_sent = false;

        $permissions = isset($data['permissions']) ? $data['permissions'] : [];
        $data['is_primary'] = isset($data['is_primary']) ? 1 : 0;

        // Contact cant change if is primary or not
        if ($client_request == true) {
            unset($data['is_primary']);
        }

        if (isset($data['custom_fields'])) {
            $custom_fields = $data['custom_fields'];
            if (handle_custom_fields_post($id, $custom_fields)) {
                $affectedRows++;
            }
            unset($data['custom_fields']);
        }

        if ($client_request == false) {
            $data['invoice_emails'] = isset($data['invoice_emails']) ? 1 : 0;
            $data['estimate_emails'] = isset($data['estimate_emails']) ? 1 : 0;
            $data['credit_note_emails'] = isset($data['credit_note_emails']) ? 1 : 0;
            $data['contract_emails'] = isset($data['contract_emails']) ? 1 : 0;
            $data['task_emails'] = isset($data['task_emails']) ? 1 : 0;
            $data['project_emails'] = isset($data['project_emails']) ? 1 : 0;
            $data['ticket_emails'] = isset($data['ticket_emails']) ? 1 : 0;
        }
        $data = hooks()->apply_filters('before_update_contact', $data, $id);

        // $this->db->where('id', $id);
        $this->db->select('email');
        $this->db->from('contacts');
        $this->db->where('id', $id);
        $query = $this->db->get()->row();
        $this->db->where('email', $query->email);
        $this->db->update(db_prefix() . 'contacts', $data);

        if ($this->db->affected_rows() > 0) {
            $affectedRows++;
            if (isset($data['is_primary']) && $data['is_primary'] == 1) {
                $this->db->where('userid', $contact->userid);
                $this->db->where('id !=', $id);
                $this->db->update(db_prefix() . 'contacts', [
                    'is_primary' => 0,
                ]);
            }
        }

        if ($client_request == false) {
            $customer_permissions = $this->roles_model->get_contact_permissions($id);
            if (sizeof($customer_permissions) > 0) {
                foreach ($customer_permissions as $customer_permission) {
                    if (!in_array($customer_permission['permission_id'], $permissions)) {
                        $this->db->where('userid', $id);
                        $this->db->where('permission_id', $customer_permission['permission_id']);
                        $this->db->delete(db_prefix() . 'contact_permissions');
                        if ($this->db->affected_rows() > 0) {
                            $affectedRows++;
                        }
                    }
                }
                foreach ($permissions as $permission) {
                    $this->db->where('userid', $id);
                    $this->db->where('permission_id', $permission);
                    $_exists = $this->db->get(db_prefix() . 'contact_permissions')->row();
                    if (!$_exists) {
                        $this->db->insert(db_prefix() . 'contact_permissions', [
                            'userid' => $id,
                            'permission_id' => $permission,
                        ]);
                        if ($this->db->affected_rows() > 0) {
                            $affectedRows++;
                        }
                    }
                }
            } else {
                foreach ($permissions as $permission) {
                    $this->db->insert(db_prefix() . 'contact_permissions', [
                        'userid' => $id,
                        'permission_id' => $permission,
                    ]);
                    if ($this->db->affected_rows() > 0) {
                        $affectedRows++;
                    }
                }
            }
            if ($send_set_password_email) {
                $set_password_email_sent = $this->authentication_model->set_password_email($data['email'], 0);
            }
        }

        if (($client_request == true) && $send_set_password_email) {
            $set_password_email_sent = $this->authentication_model->set_password_email($data['email'], 0);
        }

        if ($affectedRows > 0) {
            hooks()->do_action('contact_updated', $id, $data);
        }

        if ($affectedRows > 0 && !$set_password_email_sent) {
            log_activity('Contact Updated [ID: ' . $id . ']');

            return true;
        } elseif ($affectedRows > 0 && $set_password_email_sent) {
            return [
                'set_password_email_sent_and_profile_updated' => true,
            ];
        } elseif ($affectedRows == 0 && $set_password_email_sent) {
            return [
                'set_password_email_sent' => true,
            ];
        }

        return false;
    }

    /**
     * Add new contact
     * @param array  $data               $_POST data
     * @param mixed  $customer_id        customer id
     * @param boolean $not_manual_request is manual from admin area customer profile or register, convert to lead
     */
    public function add_contact($data, $customer_id, $not_manual_request = false)
    {

        $send_set_password_email = isset($data['send_set_password_email']) ? true : false;

        if (isset($data['custom_fields'])) {
            $custom_fields = $data['custom_fields'];
            unset($data['custom_fields']);
        }

        if (isset($data['permissions'])) {
            $permissions = $data['permissions'];
            unset($data['permissions']);
        }
        // change the dob format
        // if(isset($data['dob'])){
        //     $orgDate = $data['dob']; 
        //     $data['dob'] = date("Y-m-d", strtotime($orgDate)); 
        // }

        $data['email_verified_at'] = date('Y-m-d H:i:s');

        $send_welcome_email = true;

        if (isset($data['donotsendwelcomeemail'])) {
            $send_welcome_email = false;
        }

        if (defined('CONTACT_REGISTERING')) {
            $send_welcome_email = true;

            // Do not send welcome email if confirmation for registration is enabled
            if (get_option('customers_register_require_confirmation') == '1') {
                $send_welcome_email = false;
            }

            // If client register set this contact as primary
            $data['is_primary'] = 1;

            if (is_email_verification_enabled() && !empty($data['email'])) {
                // Verification is required on register
                $data['email_verified_at'] = null;
                $data['email_verification_key'] = app_generate_hash();
            }
        }

        if (isset($data['is_primary'])) {
            $data['is_primary'] = 1;
            $this->db->where('userid', $customer_id);
            $this->db->update(db_prefix() . 'contacts', [
                'is_primary' => 0,
            ]);

        } else {
            $data['is_primary'] = 0;
        }

        $password_before_hash = '';
        $data['userid'] = $customer_id;
        if (isset($data['password'])) {
            $password_before_hash = $data['password'];
            $data['password'] = app_hash_password($data['password']);
        }

        $data['datecreated'] = date('Y-m-d H:i:s');

        if (!$not_manual_request) {
            $data['invoice_emails'] = isset($data['invoice_emails']) ? 1 : 0;
            $data['estimate_emails'] = isset($data['estimate_emails']) ? 1 : 0;
            $data['credit_note_emails'] = isset($data['credit_note_emails']) ? 1 : 0;
            $data['contract_emails'] = isset($data['contract_emails']) ? 1 : 0;
            $data['task_emails'] = isset($data['task_emails']) ? 1 : 0;
            $data['project_emails'] = isset($data['project_emails']) ? 1 : 0;
            $data['ticket_emails'] = isset($data['ticket_emails']) ? 1 : 0;
        }

        $data['email'] = trim($data['email']);

        $data = hooks()->apply_filters('before_create_contact', $data);

        $this->db->insert(db_prefix() . 'contacts', $data);
        $contact_id = $this->db->insert_id();

        if ($contact_id) {
            if (isset($custom_fields)) {
                handle_custom_fields_post($contact_id, $custom_fields);
            }
            // request from admin area
            if (!isset($permissions) && $not_manual_request == false) {
                $permissions = [];
            } elseif ($not_manual_request == true) {
                $permissions = [];
                $_permissions = get_contact_permissions();
                $default_permissions = @unserialize(get_option('default_contact_permissions'));
                if (is_array($default_permissions)) {
                    foreach ($_permissions as $permission) {
                        if (in_array($permission['id'], $default_permissions)) {
                            array_push($permissions, $permission['id']);
                        }
                    }
                }
            }

            if ($not_manual_request == true) {
                // update all email notifications to 0
                $this->db->where('id', $contact_id);
                $this->db->update(db_prefix() . 'contacts', [
                    'invoice_emails' => 0,
                    'estimate_emails' => 0,
                    'credit_note_emails' => 0,
                    'contract_emails' => 0,
                    'task_emails' => 0,
                    'project_emails' => 0,
                    'ticket_emails' => 0,
                ]);
            }
            foreach ($permissions as $permission) {
                $this->db->insert(db_prefix() . 'contact_permissions', [
                    'userid' => $contact_id,
                    'permission_id' => $permission,
                ]);

                // Auto set email notifications based on permissions
                if ($not_manual_request == true) {
                    if ($permission == 6) {
                        $this->db->where('id', $contact_id);
                        $this->db->update(db_prefix() . 'contacts', ['project_emails' => 1, 'task_emails' => 1]);
                    } elseif ($permission == 3) {
                        $this->db->where('id', $contact_id);
                        $this->db->update(db_prefix() . 'contacts', ['contract_emails' => 1]);
                    } elseif ($permission == 2) {
                        $this->db->where('id', $contact_id);
                        $this->db->update(db_prefix() . 'contacts', ['estimate_emails' => 1]);
                    } elseif ($permission == 1) {
                        $this->db->where('id', $contact_id);
                        $this->db->update(db_prefix() . 'contacts', ['invoice_emails' => 1, 'credit_note_emails' => 1]);
                    } elseif ($permission == 5) {
                        $this->db->where('id', $contact_id);
                        $this->db->update(db_prefix() . 'contacts', ['ticket_emails' => 1]);
                    }
                }
            }

            if ($send_welcome_email == true && !empty($data['email'])) {
                send_mail_template(
                    'customer_created_welcome_mail',
                    $data['email'],
                    $data['userid'],
                    $contact_id,
                    $password_before_hash
                );
            }

            if ($send_set_password_email) {
                $this->authentication_model->set_password_email($data['email'], 0);
            }

            if (defined('CONTACT_REGISTERING')) {
                $this->send_verification_email($contact_id);
            } else {
                // User already verified because is added from admin area, try to transfer any tickets
                $this->load->model('tickets_model');
                $this->tickets_model->transfer_email_tickets_to_contact($data['email'], $contact_id);
            }

            log_activity('Contact Created [ID: ' . $contact_id . ']');

            hooks()->do_action('contact_created', $contact_id);

            return $contact_id;
        }

        return false;
    }

    /**
     * Add new contact via customers area
     *
     * @param array  $data
     * @param mixed  $customer_id
     */
    public function add_contact_via_customers_area($data, $customer_id)
    {
        $send_welcome_email = isset($data['donotsendwelcomeemail']) && $data['donotsendwelcomeemail'] ? false : true;
        $send_set_password_email = isset($data['send_set_password_email']) && $data['send_set_password_email'] ? true : false;
        $custom_fields = $data['custom_fields'];
        unset($data['custom_fields']);

        if (!is_email_verification_enabled()) {
            $data['email_verified_at'] = date('Y-m-d H:i:s');
        } elseif (is_email_verification_enabled() && !empty($data['email'])) {
            // Verification is required on register
            $data['email_verified_at'] = null;
            $data['email_verification_key'] = app_generate_hash();
        }

        $password_before_hash = $data['password'];

        $data = array_merge($data, [
            'datecreated' => date('Y-m-d H:i:s'),
            'userid' => $customer_id,
            'password' => app_hash_password(isset($data['password']) ? $data['password'] : time()),
        ]);

        $data = hooks()->apply_filters('before_create_contact', $data);
        $this->db->insert(db_prefix() . 'contacts', $data);

        $contact_id = $this->db->insert_id();

        if ($contact_id) {
            handle_custom_fields_post($contact_id, $custom_fields);

            // Apply default permissions
            $default_permissions = @unserialize(get_option('default_contact_permissions'));

            if (is_array($default_permissions)) {
                foreach (get_contact_permissions() as $permission) {
                    if (in_array($permission['id'], $default_permissions)) {
                        $this->db->insert(db_prefix() . 'contact_permissions', [
                            'userid' => $contact_id,
                            'permission_id' => $permission['id'],
                        ]);
                    }
                }
            }

            if ($send_welcome_email === true) {
                send_mail_template(
                    'customer_created_welcome_mail',
                    $data['email'],
                    $customer_id,
                    $contact_id,
                    $password_before_hash
                );
            }

            if ($send_set_password_email === true) {
                $this->authentication_model->set_password_email($data['email'], 0);
            }

            log_activity('Contact Created [ID: ' . $contact_id . ']');
            hooks()->do_action('contact_created', $contact_id);

            return $contact_id;
        }

        return false;
    }

    /**
     * Used to update company details from customers area
     * @param  array $data $_POST data
     * @param  mixed $id
     * @return boolean
     */
    public function update_company_details($data, $id)
    {
        $affectedRows = 0;
        if (isset($data['custom_fields'])) {
            $custom_fields = $data['custom_fields'];
            if (handle_custom_fields_post($id, $custom_fields)) {
                $affectedRows++;
            }
            unset($data['custom_fields']);
        }
        if (isset($data['country']) && $data['country'] == '' || !isset($data['country'])) {
            $data['country'] = 0;
        }
        if (isset($data['billing_country']) && $data['billing_country'] == '') {
            $data['billing_country'] = 0;
        }
        if (isset($data['shipping_country']) && $data['shipping_country'] == '') {
            $data['shipping_country'] = 0;
        }

        // From v.1.9.4 these fields are textareas
        $data['address'] = trim($data['address']);
        $data['address'] = nl2br($data['address']);
        if (isset($data['billing_street'])) {
            $data['billing_street'] = trim($data['billing_street']);
            $data['billing_street'] = nl2br($data['billing_street']);
        }
        if (isset($data['shipping_street'])) {
            $data['shipping_street'] = trim($data['shipping_street']);
            $data['shipping_street'] = nl2br($data['shipping_street']);
        }

        $data = hooks()->apply_filters('customer_update_company_info', $data, $id);

        $this->db->where('userid', $id);
        $this->db->update(db_prefix() . 'clients', $data);
        if ($this->db->affected_rows() > 0) {
            $affectedRows++;
        }
        if ($affectedRows > 0) {
            hooks()->do_action('customer_updated_company_info', $id);
            log_activity('Customer Info Updated From Clients Area [ID: ' . $id . ']');

            return true;
        }

        return false;
    }

    /**
     * Get customer staff members that are added as customer admins
     * @param  mixed $id customer id
     * @return array
     */
    public function get_admins($id)
    {
        $this->db->where('customer_id', $id);

        return $this->db->get(db_prefix() . 'customer_admins')->result_array();
    }

    public function get_adviser($id)
    {
        $this->db->where('customer_id', $id);

        return $this->db->get(db_prefix() . 'customer_adviser')->result_array();
    }

    /**
     * Get unique staff id's of customer admins
     * @return array
     */
    public function get_customers_admin_unique_ids()
    {
        return $this->db->query('SELECT DISTINCT(staff_id) FROM ' . db_prefix() . 'customer_admins')->result_array();
    }

    /**
     * Assign staff members as admin to customers
     * @param  array $data $_POST data
     * @param  mixed $id   customer id
     * @return boolean
     */

    public function assign_adviser($data, $id)
    {
        $affectedRows = 0;
        $affectedRows = 0;
        if (count($data) == 0) {
            $this->db->where('customer_id', $id);
            $this->db->delete(db_prefix() . 'customer_adviser');
            if ($this->db->affected_rows() > 0) {
                $affectedRows++;
            }
        } else {
            $current_admins = $this->get_adviser($id);
            $current_admins_ids = [];
            foreach ($current_admins as $c_admin) {
                array_push($current_admins_ids, $c_admin['staff_id']);
            }
            foreach ($current_admins_ids as $c_admin_id) {
                if (!in_array($c_admin_id, $data['customerAdvisor'])) {
                    $this->db->where('staff_id', $c_admin_id);
                    $this->db->where('customer_id', $id);
                    $this->db->delete(db_prefix() . 'customer_adviser');
                    if ($this->db->affected_rows() > 0) {
                        $affectedRows++;
                    }
                }
            }

            foreach ($data['customerAdvisor'] as $n_admin_id) {

                if (
                    total_rows(db_prefix() . 'customer_adviser', [
                        'customer_id' => $id,
                        'staff_id' => $n_admin_id,
                    ]) == 0
                ) {
                    $this->db->insert(db_prefix() . 'customer_adviser', [
                        'customer_id' => $id,
                        'staff_id' => $n_admin_id,
                        'date_assigned' => date('Y-m-d H:i:s'),
                    ]);
                    if ($this->db->affected_rows() > 0) {
                        $affectedRows++;
                    }
                }
            }
        }
        if ($affectedRows > 0) {
            return true;
        }
        return false;
    }

    public function assign_admins($data, $id)
    {
        $affectedRows = 0;

        if (count($data) == 0) {
            $this->db->where('customer_id', $id);
            $this->db->delete(db_prefix() . 'customer_admins');
            if ($this->db->affected_rows() > 0) {
                $affectedRows++;
            }
        } else {
            $current_admins = $this->get_admins($id);
            $current_admins_ids = [];
            foreach ($current_admins as $c_admin) {
                array_push($current_admins_ids, $c_admin['staff_id']);
            }
            foreach ($current_admins_ids as $c_admin_id) {
                if (!in_array($c_admin_id, $data['customer_admins'])) {
                    $this->db->where('staff_id', $c_admin_id);
                    $this->db->where('customer_id', $id);
                    $this->db->delete(db_prefix() . 'customer_admins');
                    if ($this->db->affected_rows() > 0) {
                        $affectedRows++;
                    }
                }
            }
            foreach ($data['customer_admins'] as $n_admin_id) {
                if (
                    total_rows(db_prefix() . 'customer_admins', [
                        'customer_id' => $id,
                        'staff_id' => $n_admin_id,
                    ]) == 0
                ) {
                    $this->db->insert(db_prefix() . 'customer_admins', [
                        'customer_id' => $id,
                        'staff_id' => $n_admin_id,
                        'date_assigned' => date('Y-m-d H:i:s'),
                    ]);
                    if ($this->db->affected_rows() > 0) {
                        $affectedRows++;
                    }
                }
            }
        }
        if ($affectedRows > 0) {
            return true;
        }

        return false;
    }

    /**
     * @param  integer ID
     * @return boolean
     * Delete client, also deleting rows from, dismissed client announcements, ticket replies, tickets, autologin, user notes
     */
    public function delete($id)
    {
        $affectedRows = 0;

        if (!is_gdpr() && is_reference_in_table('clientid', db_prefix() . 'invoices', $id)) {
            return [
                'referenced' => true,
            ];
        }

        if (!is_gdpr() && is_reference_in_table('clientid', db_prefix() . 'estimates', $id)) {
            return [
                'referenced' => true,
            ];
        }

        if (!is_gdpr() && is_reference_in_table('clientid', db_prefix() . 'creditnotes', $id)) {
            return [
                'referenced' => true,
            ];
        }

        hooks()->do_action('before_client_deleted', $id);

        $last_activity = get_last_system_activity_id();
        $company = get_company_name($id);

        $this->db->where('userid', $id);
        $this->db->delete(db_prefix() . 'clients');
        if ($this->db->affected_rows() > 0) {
            $affectedRows++;
            // Delete all user contacts
            $this->db->where('userid', $id);
            $contacts = $this->db->get(db_prefix() . 'contacts')->result_array();
            foreach ($contacts as $contact) {
                $this->delete_contact($contact['id']);
            }

            // Delete all tickets start here
            $this->db->where('userid', $id);
            $tickets = $this->db->get(db_prefix() . 'tickets')->result_array();
            $this->load->model('tickets_model');
            foreach ($tickets as $ticket) {
                $this->tickets_model->delete($ticket['ticketid']);
            }

            $this->db->where('rel_id', $id);
            $this->db->where('rel_type', 'customer');
            $this->db->delete(db_prefix() . 'notes');

            if (is_gdpr() && get_option('gdpr_on_forgotten_remove_invoices_credit_notes') == '1') {
                $this->load->model('invoices_model');
                $this->db->where('clientid', $id);
                $invoices = $this->db->get(db_prefix() . 'invoices')->result_array();
                foreach ($invoices as $invoice) {
                    $this->invoices_model->delete($invoice['id'], true);
                }

                $this->load->model('credit_notes_model');
                $this->db->where('clientid', $id);
                $credit_notes = $this->db->get(db_prefix() . 'creditnotes')->result_array();
                foreach ($credit_notes as $credit_note) {
                    $this->credit_notes_model->delete($credit_note['id'], true);
                }
            } elseif (is_gdpr()) {
                $this->db->where('clientid', $id);
                $this->db->update(db_prefix() . 'invoices', ['deleted_customer_name' => $company]);

                $this->db->where('clientid', $id);
                $this->db->update(db_prefix() . 'creditnotes', ['deleted_customer_name' => $company]);
            }

            $this->db->where('clientid', $id);
            $this->db->update(db_prefix() . 'creditnotes', [
                'clientid' => 0,
                'project_id' => 0,
            ]);

            $this->db->where('clientid', $id);
            $this->db->update(db_prefix() . 'invoices', [
                'clientid' => 0,
                'recurring' => 0,
                'recurring_type' => null,
                'custom_recurring' => 0,
                'cycles' => 0,
                'last_recurring_date' => null,
                'project_id' => 0,
                'subscription_id' => 0,
                'cancel_overdue_reminders' => 1,
                'last_overdue_reminder' => null,
                'last_due_reminder' => null,
            ]);

            if (is_gdpr() && get_option('gdpr_on_forgotten_remove_estimates') == '1') {
                $this->load->model('estimates_model');
                $this->db->where('clientid', $id);
                $estimates = $this->db->get(db_prefix() . 'estimates')->result_array();
                foreach ($estimates as $estimate) {
                    $this->estimates_model->delete($estimate['id'], true);
                }
            } elseif (is_gdpr()) {
                $this->db->where('clientid', $id);
                $this->db->update(db_prefix() . 'estimates', ['deleted_customer_name' => $company]);
            }

            $this->db->where('clientid', $id);
            $this->db->update(db_prefix() . 'estimates', [
                'clientid' => 0,
                'project_id' => 0,
                'is_expiry_notified' => 1,
            ]);

            $this->load->model('subscriptions_model');
            $this->db->where('clientid', $id);
            $subscriptions = $this->db->get(db_prefix() . 'subscriptions')->result_array();
            foreach ($subscriptions as $subscription) {
                $this->subscriptions_model->delete($subscription['id'], true);
            }
            // Get all client contracts
            $this->load->model('contracts_model');
            $this->db->where('client', $id);
            $contracts = $this->db->get(db_prefix() . 'contracts')->result_array();
            foreach ($contracts as $contract) {
                $this->contracts_model->delete($contract['id']);
            }
            // Delete the custom field values
            $this->db->where('relid', $id);
            $this->db->where('fieldto', 'customers');
            $this->db->delete(db_prefix() . 'customfieldsvalues');

            // Get customer related tasks
            $this->db->where('rel_type', 'customer');
            $this->db->where('rel_id', $id);
            $tasks = $this->db->get(db_prefix() . 'tasks')->result_array();

            foreach ($tasks as $task) {
                $this->tasks_model->delete_task($task['id'], false);
            }

            $this->db->where('rel_type', 'customer');
            $this->db->where('rel_id', $id);
            $this->db->delete(db_prefix() . 'reminders');

            $this->db->where('customer_id', $id);
            $this->db->delete(db_prefix() . 'customer_admins');

            $this->db->where('customer_id', $id);
            $this->db->delete(db_prefix() . 'vault');

            $this->db->where('customer_id', $id);
            $this->db->delete(db_prefix() . 'customer_groups');

            $this->load->model('proposals_model');
            $this->db->where('rel_id', $id);
            $this->db->where('rel_type', 'customer');
            $proposals = $this->db->get(db_prefix() . 'proposals')->result_array();
            foreach ($proposals as $proposal) {
                $this->proposals_model->delete($proposal['id']);
            }
            $this->db->where('rel_id', $id);
            $this->db->where('rel_type', 'customer');
            $attachments = $this->db->get(db_prefix() . 'files')->result_array();
            foreach ($attachments as $attachment) {
                $this->delete_attachment($attachment['id']);
            }

            $this->db->where('clientid', $id);
            $expenses = $this->db->get(db_prefix() . 'expenses')->result_array();

            $this->load->model('expenses_model');
            foreach ($expenses as $expense) {
                $this->expenses_model->delete($expense['id'], true);
            }

            $this->db->where('client_id', $id);
            $this->db->delete(db_prefix() . 'user_meta');

            $this->db->where('client_id', $id);
            $this->db->update(db_prefix() . 'leads', ['client_id' => 0]);

            // Delete all projects
            $this->load->model('projects_model');
            $this->db->where('clientid', $id);
            $projects = $this->db->get(db_prefix() . 'projects')->result_array();
            foreach ($projects as $project) {
                $this->projects_model->delete($project['id']);
            }
        }
        if ($affectedRows > 0) {
            hooks()->do_action('after_client_deleted', $id);

            // Delete activity log caused by delete customer function
            if ($last_activity) {
                $this->db->where('id >', $last_activity->id);
                $this->db->delete(db_prefix() . 'activity_log');
            }

            log_activity('Client Deleted [ID: ' . $id . ']');

            return true;
        }

        return false;
    }

    /**
     * Delete customer contact
     * @param  mixed $id contact id
     * @return boolean
     */
    public function delete_contact($id)
    {
        hooks()->do_action('before_delete_contact', $id);

        $this->db->where('id', $id);
        $result = $this->db->get(db_prefix() . 'contacts')->row();
        $customer_id = $result->userid;

        $last_activity = get_last_system_activity_id();

        $this->db->where('id', $id);
        $this->db->delete(db_prefix() . 'contacts');

        if ($this->db->affected_rows() > 0) {
            if (is_dir(get_upload_path_by_type('contact_profile_images') . $id)) {
                delete_dir(get_upload_path_by_type('contact_profile_images') . $id);
            }

            $this->db->where('contact_id', $id);
            $this->db->delete(db_prefix() . 'consents');

            $this->db->where('contact_id', $id);
            $this->db->delete(db_prefix() . 'shared_customer_files');

            $this->db->where('userid', $id);
            $this->db->where('staff', 0);
            $this->db->delete(db_prefix() . 'dismissed_announcements');

            $this->db->where('relid', $id);
            $this->db->where('fieldto', 'contacts');
            $this->db->delete(db_prefix() . 'customfieldsvalues');

            $this->db->where('userid', $id);
            $this->db->delete(db_prefix() . 'contact_permissions');

            $this->db->where('user_id', $id);
            $this->db->where('staff', 0);
            $this->db->delete(db_prefix() . 'user_auto_login');

            $this->db->select('ticketid');
            $this->db->where('contactid', $id);
            $this->db->where('userid', $customer_id);
            $tickets = $this->db->get(db_prefix() . 'tickets')->result_array();

            $this->load->model('tickets_model');
            foreach ($tickets as $ticket) {
                $this->tickets_model->delete($ticket['ticketid']);
            }

            $this->load->model('tasks_model');

            $this->db->where('addedfrom', $id);
            $this->db->where('is_added_from_contact', 1);
            $tasks = $this->db->get(db_prefix() . 'tasks')->result_array();

            foreach ($tasks as $task) {
                $this->tasks_model->delete_task($task['id'], false);
            }

            // Added from contact in customer profile
            $this->db->where('contact_id', $id);
            $this->db->where('rel_type', 'customer');
            $attachments = $this->db->get(db_prefix() . 'files')->result_array();

            foreach ($attachments as $attachment) {
                $this->delete_attachment($attachment['id']);
            }

            // Remove contact files uploaded to tasks
            $this->db->where('rel_type', 'task');
            $this->db->where('contact_id', $id);
            $filesUploadedFromContactToTasks = $this->db->get(db_prefix() . 'files')->result_array();

            foreach ($filesUploadedFromContactToTasks as $file) {
                $this->tasks_model->remove_task_attachment($file['id']);
            }

            $this->db->where('contact_id', $id);
            $tasksComments = $this->db->get(db_prefix() . 'task_comments')->result_array();
            foreach ($tasksComments as $comment) {
                $this->tasks_model->remove_comment($comment['id'], true);
            }

            $this->load->model('projects_model');

            $this->db->where('contact_id', $id);
            $files = $this->db->get(db_prefix() . 'project_files')->result_array();
            foreach ($files as $file) {
                $this->projects_model->remove_file($file['id'], false);
            }

            $this->db->where('contact_id', $id);
            $discussions = $this->db->get(db_prefix() . 'projectdiscussions')->result_array();
            foreach ($discussions as $discussion) {
                $this->projects_model->delete_discussion($discussion['id'], false);
            }

            $this->db->where('contact_id', $id);
            $discussionsComments = $this->db->get(db_prefix() . 'projectdiscussioncomments')->result_array();
            foreach ($discussionsComments as $comment) {
                $this->projects_model->delete_discussion_comment($comment['id'], false);
            }

            $this->db->where('contact_id', $id);
            $this->db->delete(db_prefix() . 'user_meta');

            $this->db->where('(email="' . $result->email . '" OR bcc LIKE "%' . $result->email . '%" OR cc LIKE "%' . $result->email . '%")');
            $this->db->delete(db_prefix() . 'mail_queue');

            if (is_gdpr()) {
                $this->db->where('email', $result->email);
                $this->db->delete(db_prefix() . 'listemails');

                if (!empty($result->last_ip)) {
                    $this->db->where('ip', $result->last_ip);
                    $this->db->delete(db_prefix() . 'knowedge_base_article_feedback');
                }

                $this->db->where('email', $result->email);
                $this->db->delete(db_prefix() . 'tickets_pipe_log');

                $this->db->where('email', $result->email);
                $this->db->delete(db_prefix() . 'tracked_mails');

                $this->db->where('contact_id', $id);
                $this->db->delete(db_prefix() . 'project_activity');

                $this->db->where('(additional_data LIKE "%' . $result->email . '%" OR full_name LIKE "%' . $result->firstname . ' ' . $result->lastname . '%")');
                $this->db->where('additional_data != "" AND additional_data IS NOT NULL');
                $this->db->delete(db_prefix() . 'sales_activity');

                $contactActivityQuery = false;
                if (!empty($result->email)) {
                    $this->db->or_like('description', $result->email);
                    $contactActivityQuery = true;
                }
                if (!empty($result->firstname)) {
                    $this->db->or_like('description', $result->firstname);
                    $contactActivityQuery = true;
                }
                if (!empty($result->lastname)) {
                    $this->db->or_like('description', $result->lastname);
                    $contactActivityQuery = true;
                }

                if (!empty($result->phonenumber)) {
                    $this->db->or_like('description', $result->phonenumber);
                    $contactActivityQuery = true;
                }

                if (!empty($result->last_ip)) {
                    $this->db->or_like('description', $result->last_ip);
                    $contactActivityQuery = true;
                }

                if ($contactActivityQuery) {
                    $this->db->delete(db_prefix() . 'activity_log');
                }
            }

            // Delete activity log caused by delete contact function
            if ($last_activity) {
                $this->db->where('id >', $last_activity->id);
                $this->db->delete(db_prefix() . 'activity_log');
            }

            hooks()->do_action('contact_deleted', $id, $result);

            return true;
        }

        return false;
    }

    /**
     * Get customer default currency
     * @param  mixed $id customer id
     * @return mixed
     */
    public function get_customer_default_currency($id)
    {
        $this->db->select('default_currency');
        $this->db->where('userid', $id);
        $result = $this->db->get(db_prefix() . 'clients')->row();
        if ($result) {
            return $result->default_currency;
        }

        return false;
    }

    /**
     *  Get customer billing details
     * @param   mixed $id   customer id
     * @return  array
     */
    public function get_customer_billing_and_shipping_details($id)
    {
        $this->db->select('billing_street,billing_city,billing_state,billing_zip,billing_country,shipping_street,shipping_city,shipping_state,shipping_zip,shipping_country');
        $this->db->from(db_prefix() . 'clients');
        $this->db->where('userid', $id);

        $result = $this->db->get()->result_array();
        if (count($result) > 0) {
            $result[0]['billing_street'] = clear_textarea_breaks($result[0]['billing_street']);
            $result[0]['shipping_street'] = clear_textarea_breaks($result[0]['shipping_street']);
        }

        return $result;
    }

    /**
     * Get customer files uploaded in the customer profile
     * @param  mixed $id    customer id
     * @param  array  $where perform where
     * @return array
     */
    public function get_customer_files($id, $where = [])
    {
        $this->db->where($where);
        $this->db->where('rel_id', $id);
        $this->db->where('rel_type', 'customer');
        $this->db->order_by('dateadded', 'desc');

        return $this->db->get(db_prefix() . 'files')->result_array();
    }

    /**
     * Delete customer attachment uploaded from the customer profile
     * @param  mixed $id attachment id
     * @return boolean
     */
    public function delete_attachment($id)
    {
        $this->db->where('id', $id);
        $attachment = $this->db->get(db_prefix() . 'files')->row();
        $deleted = false;
        if ($attachment) {
            if (empty($attachment->external)) {
                $relPath = get_upload_path_by_type('customer') . $attachment->rel_id . '/';
                $fullPath = $relPath . $attachment->file_name;
                unlink($fullPath);
                $fname = pathinfo($fullPath, PATHINFO_FILENAME);
                $fext = pathinfo($fullPath, PATHINFO_EXTENSION);
                $thumbPath = $relPath . $fname . '_thumb.' . $fext;
                if (file_exists($thumbPath)) {
                    unlink($thumbPath);
                }
            }

            $this->db->where('id', $id);
            $this->db->delete(db_prefix() . 'files');
            if ($this->db->affected_rows() > 0) {
                $deleted = true;
                $this->db->where('file_id', $id);
                $this->db->delete(db_prefix() . 'shared_customer_files');
                log_activity('Customer Attachment Deleted [ID: ' . $attachment->rel_id . ']');
            }

            if (is_dir(get_upload_path_by_type('customer') . $attachment->rel_id)) {
                // Check if no attachments left, so we can delete the folder also
                $other_attachments = list_files(get_upload_path_by_type('customer') . $attachment->rel_id);
                if (count($other_attachments) == 0) {
                    delete_dir(get_upload_path_by_type('customer') . $attachment->rel_id);
                }
            }
        }

        return $deleted;
    }

    /**
     * @param  integer ID
     * @param  integer Status ID
     * @return boolean
     * Update contact status Active/Inactive
     */
    public function change_contact_status($id, $status)
    {
        $status = hooks()->apply_filters('change_contact_status', $status, $id);

        $this->db->where('id', $id);
        $this->db->update(db_prefix() . 'contacts', [
            'active' => $status,
        ]);
        if ($this->db->affected_rows() > 0) {
            hooks()->do_action('contact_status_changed', [
                'id' => $id,
                'status' => $status,
            ]);

            log_activity('Contact Status Changed [ContactID: ' . $id . ' Status(Active/Inactive): ' . $status . ']');

            return true;
        }

        return false;
    }

    /**
     * @param  integer ID
     * @param  integer Status ID
     * @return boolean
     * Update client status Active/Inactive
     */
    public function change_client_status($id, $status)
    {
        $this->db->where('userid', $id);
        $this->db->update(db_prefix() . 'clients', [
            'active' => $status,
        ]);

        if ($this->db->affected_rows() > 0) {
            hooks()->do_action('client_status_changed', [
                'id' => $id,
                'status' => $status,
            ]);

            log_activity('Customer Status Changed [ID: ' . $id . ' Status(Active/Inactive): ' . $status . ']');

            return true;
        }

        return false;
    }

    /**
     * Change contact password, used from client area
     * @param  mixed $id          contact id to change password
     * @param  string $oldPassword old password to verify
     * @param  string $newPassword new password
     * @return boolean
     */
    public function change_contact_password($id, $oldPassword, $newPassword)
    {
        // Get current password
        $this->db->where('id', $id);
        $client = $this->db->get(db_prefix() . 'contacts')->row();

        if (!app_hasher()->CheckPassword($oldPassword, $client->password)) {
            return [
                'old_password_not_match' => true,
            ];
        }

        $this->db->where('id', $id);
        $this->db->update(db_prefix() . 'contacts', [
            'last_password_change' => date('Y-m-d H:i:s'),
            'password' => app_hash_password($newPassword),
        ]);

        if ($this->db->affected_rows() > 0) {
            log_activity('Contact Password Changed [ContactID: ' . $id . ']');

            return true;
        }

        return false;
    }

    /**
     * Get customer groups where customer belongs
     * @param  mixed $id customer id
     * @return array
     */
    public function get_customer_groups($id)
    {
        return $this->client_groups_model->get_customer_groups($id);
    }

    /**
     * Get all customer groups
     * @param  string $id
     * @return mixed
     */
    public function get_groups($id = '')
    {
        return $this->client_groups_model->get_groups($id);
    }

    /**
     * Delete customer groups
     * @param  mixed $id group id
     * @return boolean
     */
    public function delete_group($id)
    {
        return $this->client_groups_model->delete($id);
    }

    /**
     * Add new customer groups
     * @param array $data $_POST data
     */
    public function add_group($data)
    {
        return $this->client_groups_model->add($data);
    }

    /**
     * Edit customer group
     * @param  array $data $_POST data
     * @return boolean
     */
    public function edit_group($data)
    {
        return $this->client_groups_model->edit($data);
    }

    /**
     * Create new vault entry
     * @param  array $data        $_POST data
     * @param  mixed $customer_id customer id
     * @return boolean
     */
    public function vault_entry_create($data, $customer_id)
    {
        return $this->client_vault_entries_model->create($data, $customer_id);
    }

    /**
     * Update vault entry
     * @param  mixed $id   vault entry id
     * @param  array $data $_POST data
     * @return boolean
     */
    public function vault_entry_update($id, $data)
    {
        return $this->client_vault_entries_model->update($id, $data);
    }

    /**
     * Delete vault entry
     * @param  mixed $id entry id
     * @return boolean
     */
    public function vault_entry_delete($id)
    {
        return $this->client_vault_entries_model->delete($id);
    }

    /**
     * Get customer vault entries
     * @param  mixed $customer_id
     * @param  array  $where       additional wher
     * @return array
     */
    public function get_vault_entries($customer_id, $where = [])
    {
        return $this->client_vault_entries_model->get_by_customer_id($customer_id, $where);
    }

    /**
     * Get single vault entry
     * @param  mixed $id vault entry id
     * @return object
     */
    public function get_vault_entry($id)
    {
        return $this->client_vault_entries_model->get($id);
    }

    /**
     * Get customer statement formatted
     * @param  mixed $customer_id customer id
     * @param  string $from        date from
     * @param  string $to          date to
     * @return array
     */
    public function get_statement($customer_id, $from, $to)
    {
        return $this->statement_model->get_statement($customer_id, $from, $to);
    }

    /**
     * Send customer statement to email
     * @param  mixed $customer_id customer id
     * @param  array $send_to     array of contact emails to send
     * @param  string $from        date from
     * @param  string $to          date to
     * @param  string $cc          email CC
     * @return boolean
     */
    public function send_statement_to_email($customer_id, $send_to, $from, $to, $cc = '')
    {
        return $this->statement_model->send_statement_to_email($customer_id, $send_to, $from, $to, $cc);
    }

    /**
     * When customer register, mark the contact and the customer as inactive and set the registration_confirmed field to 0
     * @param  mixed $client_id  the customer id
     * @return boolean
     */
    public function require_confirmation($client_id)
    {
        $contact_id = get_primary_contact_user_id($client_id);
        $this->db->where('userid', $client_id);
        $this->db->update(db_prefix() . 'clients', ['active' => 0, 'registration_confirmed' => 0]);

        $this->db->where('id', $contact_id);
        $this->db->update(db_prefix() . 'contacts', ['active' => 0]);

        return true;
    }

    public function confirm_registration($client_id)
    {
        $contact_id = get_primary_contact_user_id($client_id);
        $this->db->where('userid', $client_id);
        $this->db->update(db_prefix() . 'clients', ['active' => 1, 'registration_confirmed' => 1]);

        $this->db->where('id', $contact_id);
        $this->db->update(db_prefix() . 'contacts', ['active' => 1]);

        $contact = $this->get_contact($contact_id);

        if ($contact) {
            send_mail_template('customer_registration_confirmed', $contact);

            return true;
        }

        return false;
    }

    public function send_verification_email($id)
    {
        $contact = $this->get_contact($id);

        if (empty($contact->email)) {
            return false;
        }

        $success = send_mail_template('customer_contact_verification', $contact);

        if ($success) {
            $this->db->where('id', $id);
            $this->db->update(db_prefix() . 'contacts', ['email_verification_sent_at' => date('Y-m-d H:i:s')]);
        }

        return $success;
    }

    public function mark_email_as_verified($id)
    {
        $contact = $this->get_contact($id);

        $this->db->where('id', $id);
        $this->db->update(db_prefix() . 'contacts', [
            'email_verified_at' => date('Y-m-d H:i:s'),
            'email_verification_key' => null,
            'email_verification_sent_at' => null,
        ]);

        if ($this->db->affected_rows() > 0) {

            // Check for previous tickets opened by this email/contact and link to the contact
            $this->load->model('tickets_model');
            $this->tickets_model->transfer_email_tickets_to_contact($contact->email, $contact->id);

            return true;
        }

        return false;
    }

    public function get_clients_distinct_countries()
    {
        return $this->db->query('SELECT DISTINCT(country_id), short_name FROM ' . db_prefix() . 'clients JOIN ' . db_prefix() . 'countries ON ' . db_prefix() . 'countries.country_id=' . db_prefix() . 'clients.country')->result_array();
    }

    public function send_notification_customer_profile_file_uploaded_to_responsible_staff($contact_id, $customer_id)
    {
        $staff = $this->get_staff_members_that_can_access_customer($customer_id);
        $merge_fields = $this->app_merge_fields->format_feature('client_merge_fields', $customer_id, $contact_id);
        $notifiedUsers = [];


        foreach ($staff as $member) {
            mail_template('customer_profile_uploaded_file_to_staff', $member['email'], $member['staffid'])
                ->set_merge_fields($merge_fields)
                ->send();

            if (
                add_notification([
                    'touserid' => $member['staffid'],
                    'description' => 'not_customer_uploaded_file',
                    'link' => 'clients/client/' . $customer_id . '?group=attachments',
                ])
            ) {
                array_push($notifiedUsers, $member['staffid']);
            }
        }
        pusher_trigger_notification($notifiedUsers);
    }

    public function get_staff_members_that_can_access_customer($id)
    {
        $id = $this->db->escape_str($id);

        return $this->db->query('SELECT * FROM ' . db_prefix() . 'staff
            WHERE (
                    admin=1
                    OR staffid IN (SELECT staff_id FROM ' . db_prefix() . "customer_admins WHERE customer_id='.$id.')
                    OR staffid IN(SELECT staff_id FROM " . db_prefix() . 'staff_permissions WHERE feature = "customers" AND capability="view")
                )
            AND active=1')->result_array();
    }

    private function check_zero_columns($data)
    {
        if (!isset($data['show_primary_contact'])) {
            $data['show_primary_contact'] = 0;
        }

        if (isset($data['default_currency']) && $data['default_currency'] == '' || !isset($data['default_currency'])) {
            $data['default_currency'] = 0;
        }

        if (isset($data['country']) && $data['country'] == '' || !isset($data['country'])) {
            $data['country'] = 0;
        }

        if (isset($data['billing_country']) && $data['billing_country'] == '' || !isset($data['billing_country'])) {
            $data['billing_country'] = 0;
        }

        if (isset($data['shipping_country']) && $data['shipping_country'] == '' || !isset($data['shipping_country'])) {
            $data['shipping_country'] = 0;
        }

        return $data;
    }

    public function delete_contact_profile_image($id)
    {
        hooks()->do_action('before_remove_contact_profile_image');
        if (file_exists(get_upload_path_by_type('contact_profile_images') . $id)) {
            delete_dir(get_upload_path_by_type('contact_profile_images') . $id);
        }
        $this->db->where('id', $id);
        $this->db->update(db_prefix() . 'contacts', [
            'profile_image' => null,
        ]);
    }

    /**
     * @param $projectId
     * @param  string  $tasks_email
     *
     * @return array[]
     */
    public function get_contacts_for_project_notifications($projectId, $type)
    {
        $this->db->select('clientid,contact_notification,notify_contacts');
        $this->db->from(db_prefix() . 'projects');
        $this->db->where('id', $projectId);
        $project = $this->db->get()->row();

        if (!in_array($project->contact_notification, [1, 2])) {
            return [];
        }

        $this->db
            ->where('userid', $project->clientid)
            ->where('active', 1)
            ->where($type, 1);

        if ($project->contact_notification == 2) {
            $projectContacts = unserialize($project->notify_contacts);
            $this->db->where_in('id', $projectContacts);
        }

        return $this->db->get(db_prefix() . 'contacts')->result_array();
    }

    public function fetchOccupationClass()
    {
        $this->db->select('*');
        $this->db->where('is_deleted', 0);
        $this->db->from('tblcustomer_occupation');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function save_Occupation_Class($data)
    {
        $this->db->insert('tblcustomer_occupation', $data);
        $lastid = $this->db->insert_id();
        return $lastid;
    }

    public function delete_OccupationClass($data, $id)
    {
        $this->db->where('id', $id);
        $result = $this->db->update('tblcustomer_occupation', $data);
        return $result;
    }

    public function fetchSmoker()
    {
        $this->db->select('*');
        $this->db->where('is_deleted', 0);
        $this->db->from('tblcustomer_smoker');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function save_Smoker($data)
    {
        $this->db->insert('tblcustomer_smoker', $data);
        $lastid = $this->db->insert_id();
        return $lastid;
    }

    public function delete_Smoker($data, $id)
    {
        $this->db->where('id', $id);
        $result = $this->db->update('tblcustomer_smoker', $data);
        return $result;
    }

    public function get_contact_bymail($mail)
    {
        $this->db->where('email', $mail);
        $this->db->group_by('email');
        return $this->db->get(db_prefix() . 'contacts')->row();
    }

    // public function updateCategory($data,$attachementId){
    //     $this->db->where('id' , $attachementId);
    //     $this->db->update('tblfiles',$data);
    // }

    // public function updateCompliancez($compliance_id, $attachementId){
    //     $this->db->where('id',$attachementId);
    //     $this->db->update('tblfiles' , $compliance_id);
    // }

    function insertRecord($record)
    {

        if (count($record) > 0) {
            // Check user
            $this->db->select('*');
            $this->db->where('email', $record[3]);
            $q = $this->db->get('tblcontacts');
            $response = $q->result_array();
            if ($response[0]['email'] == trim($record[3])) {
                IndividualLogActivity($response[0]['email'] . ": Exist in table");
            }
            if (count($response) == 0) {
                if (
                    !empty(trim($record[0])) && !empty(trim($record[1])) && !empty(trim($record[2]))
                    && !empty(trim($record[3])) && !empty(trim($record[4])) && !empty(trim($record[5]))
                    && !empty(trim($record[6])) && !empty(trim($record[7])) && !empty(trim($record[8]))
                ) {
                    if ($response[0]['email'] != trim($record[3])) {

                        $Contactage = date_diff(date_create(trim($record[25])), date_create('today'))->y;
                        $date = date('y-m-d');

                        $dobdate = trim($record[25]);
                        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $dobdate)) {
                            $insert_date = $dobdate;
                        } else {
                            $insert_date = date("Y-m-d", strtotime($dobdate));
                        }

                        $newuser = array(
                            "userid" => trim($record[0]),
                            "firstname" => trim($record[1]),
                            "lastname" => trim($record[2]),
                            "email" => trim($record[3]),
                            "phonenumber" => trim($record[4]),
                            "homephone" => trim($record[5]),
                            "title" => trim($record[6]),
                            "password" => trim(app_hash_password($record[7])),
                            "gender" => trim($record[8]),
                            "vulnerable_client" => trim($record[9]),
                            "client_type" => trim($record[10]),
                            "occupation" => trim($record[11]),
                            "custom_occupation" => trim($record[12]),
                            "smoker" => trim($record[13]),
                            "residential_address" => trim($record[14]),
                            "residential_city" => trim($record[15]),
                            "residential_state" => trim($record[16]),
                            "residential_zipcode" => trim($record[17]),
                            "residential_country" => trim($record[18]),
                            "postal_address" => trim($record[19]),
                            "postal_city" => trim($record[20]),
                            "postal_state" => trim($record[21]),
                            "postal_zipcode" => trim($record[22]),
                            "postal_country" => trim($record[23]),
                            "additional_note" => trim($record[24]),
                            "dob" => $insert_date,
                            "imported_date" => $date,
                            "age" => $Contactage,
                            "occupation_name" => $this->clients_model->occupationContact(trim($record[11])),
                        );

                        $result = $this->db->insert('tblcontacts', $newuser);
                        if ($result) {
                            IndividualLogActivity($newuser['email'] . ": Individual imported successfully");
                        }
                    }
                } else {
                    IndividualLogActivity(trim($record[3]) . ': Contact not imported successfully due to empty column');
                }
            }
        }
    }

    public function occupationContact($id)
    {
        $this->db->select('occupation');
        $this->db->where('id', $id);
        $this->db->from('tblcustomer_occupation');
        $query = $this->db->get();
        $result = $query->result_array();
        $id = $result[0];
        foreach ($id as $ids) {
            $sendid[] = $ids;
        }
        $string_version = implode(',', $sendid);
        return $string_version;
    }

    public function IndividualLog_Activity($message)
    {
        $staff_id = get_staff_user_id();
        $data = [
            'description' => $message,
            'staffid' => $staff_id,
        ];
        $this->db->insert('tblactivity_log_Individual', $data);
        $lastID = $this->db->insert_id();
        return $lastID;
    }

    public function activity_log_Individuals()
    {
        $this->db->select('firstname,lastname,description,date');
        $this->db->from('tblactivity_log_Individual');
        $this->db->join('tblstaff', 'tblstaff.staffid = tblactivity_log_Individual.staffid', 'inner');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function change_Status_Vul_Check($vulnerable_checkValue, $individeal_id)
    {
        if (!empty($vulnerable_checkValue) && is_array($vulnerable_checkValue)) {
            $this->db->where('id', $individeal_id);
            $this->db->update('tblcontacts', $vulnerable_checkValue);
        }
    }

    // public function change_Status_Vul_Check($vulnerable_checkValue , $individeal_id){
    //     $this->db->where('id',$individeal_id);
    //     $this->db->update('tblcontacts' , $vulnerable_checkValue);
    // }

    public function change_Status_primary_Check($primary_checkVal, $individeal)
    {
        $this->db->where('id', $individeal);
        $this->db->update('tblcontacts', $primary_checkVal);
    }

    public function change_Status_deceaed_Check($data, $deceased)
    {
        $this->db->where('id', $deceased);
        $this->db->update('tblcontacts', $data);
        echo $this->db->last_query();
    }

    public function change_email_reciever_Check($data, $deceased)
    {
        // $this->db->where('id', $deceased);
        // $this->db->update('tblcontacts', $data);
        if (!empty($data) && is_array($data)) {
            $this->db->where('id', $deceased);
            $this->db->update('tblcontacts', $data);
        }
    }

    public function save_vulnerableClient($id, $data)
    {
        // if (!$id) {
        //     $this->db->insert('tblvulnerabledrivers', $data);
        //     return $this->db->insert_id();
        // }
        // if ($id) {
        //     $this->db->where('id', $id);
        //     $result = $this->db->update('tblvulnerabledrivers', $data);
        //     if ($result) {
        //         return yes;
        //     } else {
        //         return no;
        //     }
        // }

        if (empty($data) || !is_array($data)) {
            return false;
        }

        if (!$id) {
            $this->db->insert('tblvulnerabledrivers', $data);
            return $this->db->insert_id();
        }

        if ($id) {
            $this->db->where('id', $id);
            $result = $this->db->update('tblvulnerabledrivers', $data);
            if ($result) {
                return 'yes';
            } else {
                return 'no';
            }
        }
    }

    public function fetchvulnerableClient()
    {
        $this->db->select('*');
        $this->db->where('is_deleted', 0);
        $this->db->from('tblvulnerabledrivers');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function clientRelatedData($contact_id_under_client, $userid)
    {

        $this->db->select('*');
        $this->db->where('userid', $userid);
        $this->db->where('id', $contact_id_under_client);
        $this->db->from('tblcontacts');
        $result = $this->db->get();
        $individualdata = $result->result_array();
        foreach ($individualdata as $individualdatas) {

            $individual_data = [

                'firstname' => $individualdatas['firstname'],
                'lastname' => $individualdatas['lastname'],
                'email' => $individualdatas['email'],
                'phonenumber' => $individualdatas['phonenumber'],
                'residential_address' => $individualdatas['residential_address'],
                'residential_state' => $individualdatas['residential_state'],
                'residential_city' => $individualdatas['residential_city'],
                'residential_zipcode' => $individualdatas['residential_zipcode'],
                'residential_country' => $this->clients_model->residential_countryCountry($individualdatas['residential_country']),
                'postal_address' => $individualdatas['postal_address'],
                'postal_state' => $individualdatas['postal_state'],
                'postal_city' => $individualdatas['postal_city'],
                'postal_zipcode' => $individualdatas['postal_zipcode'],
                'postal_country' => $this->clients_model->postal_countryCountry($individualdatas['postal_country']),

            ];
        }
        return $individual_data;
    }

    public function postal_countryCountry($postal_country_id)
    {
        $this->db->select('short_name');
        $this->db->from('tblcountries');
        $this->db->where('country_id', $postal_country_id);
        $query = $this->db->get();
        $result = $query->row();

        return $result->short_name;
    }

    public function residential_countryCountry($residential_country_id)
    {
        $this->db->select('short_name');
        $this->db->from('tblcountries');
        $this->db->where('country_id', $residential_country_id);
        $query = $this->db->get();
        $result = $query->row();

        return $result->short_name;
    }

    public function save_type($id, $data)
    {
        if (empty($data) || !is_array($data)) {
            return false;
        }

        if (!$id) {
            $this->db->insert('tblcustomer_type', $data);
            return $this->db->insert_id();
        }

        if ($id) {
            $this->db->where('id', $id);
            $result = $this->db->update('tblcustomer_type', $data);
            if ($result) {
                return 'yes';
            } else {
                return 'no';
            }
        }
    }


    public function fetchtype()
    {
        $this->db->select('*');
        $this->db->where('is_deleted', 0);
        $this->db->from('tblcustomer_type');
        $result = $this->db->get();
        return $result->result_array();
    }


    public function GetClientTypeById($typeid)
    {
        $this->db->select('client_type');
        $this->db->from('tblcustomer_type');
        $this->db->where('id', $typeid);
        $this->db->where('is_deleted', 0);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function fetchclient_type($client_type_id)
    {
        $this->db->select('view_type_sorting');
        $this->db->where('id', $client_type_id);
        $this->db->where('is_deleted', 0);
        $this->db->from('tblcustomer_type');
        $result = $this->db->get();
        $d_result = $result->row();
        return $d_result->view_type_sorting;

    }

    public function firstNameExists($firstname, $lastname, $dob)
    {
        $this->db->select('*');
        $this->db->from('tblcontacts');
        $this->db->where('firstname', $firstname);
        $this->db->where('lastname', $lastname);
        $this->db->where('dob', $dob);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    // public function review_month()
    // {
    //     $this->db->select('*');
    //     $this->db->from('tblclient_review_month');
    //     $query = $this->db->get();
    //     $result = $query->result_array();
    //     return $result;
    // }

    public function review_month($client_review_month = "")
    {
        $this->db->select('*');
        if ($client_review_month != "") {
            $this->db->where('id', $client_review_month);
        }
        $this->db->from('tblclient_review_month');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function compliance_name($complianId)
    {
        $this->db->select('compliance');
        $this->db->where('id', $complianId);
        $this->db->from('tblproject_compliance');
        $result = $this->db->get();
        $complianceData = $result->row();
        return $complianceData->compliance;
    }

    public function updateCompliancez($data, $file_id)
    {
        $this->db->where('id', $file_id);
        $this->db->update('tblfiles', $data);
    }

    public function getCategory_Name($categoryId)
    {
        $this->db->select('category');
        $this->db->where('id', $categoryId);
        $this->db->from('tblproject_category');
        $result = $this->db->get();
        $categoryData = $result->row();
        return $categoryData->category;
    }

    public function saveupdatecat($data, $file_id)
    {
        $this->db->where('id', $file_id);
        $this->db->update('tblfiles', $data);
    }


    public function is_exist_userId($user_id = "")
    {
        $this->db->select('*');
        if ($user_id != "") {
            $this->db->where('user_id', $user_id);
        }
        $this->db->from('tblclient_deactive_client_reason');
        $result = $this->db->get();
        $exitData = $result->result_array();
        return $exitData;
    }
    public function reasonOfDisable_not_exist($data)
    {
        $this->db->insert('tblclient_deactive_client_reason', $data);
    }
    public function reasonOfDisable_exist($data, $user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->update('tblclient_deactive_client_reason', $data);
    }
    public function save_active_one($active, $inputcheckId)
    {
        $data = [
            'active' => $active,
        ];
        $this->db->where('userid', $inputcheckId);
        $this->db->update('tblclients', $data);
    }
    public function getReasonOfDisable($clientGridId)
    {
        $this->db->select('reason_of_disable');
        $this->db->where('user_id', $clientGridId);
        $this->db->from('tblclient_deactive_client_reason');
        $result = $this->db->get();
        $exitData = $result->row();
        return $exitData->reason_of_disable;
    }
    public function update_fileData($rowid, $clientId, $data)
    {
        $this->db->where('id', $rowid);
        $this->db->where('rel_id', $clientId);
        $this->db->update('tblfiles', $data);
    }

    // Client Review Report
    public function fetchClient_review_data($cleck_is_admin)
    {
        # Non Admin
        if ($cleck_is_admin == 0) {
            $staff_id = get_staff_user_id();
            # NEW ADDED
            $this->db->select("customer_id");
            $this->db->from("tblcustomer_admins");
            $this->db->where("tblcustomer_admins.staff_id", $staff_id);
            $query = $this->db->get();
            $result = $query->result_array();
            $result1 = [];
            // $m =0;
            foreach ($result as $results) {
                $this->db->select('*');
                $this->db->from('tblclients');
                $this->db->join('tblcustomer_admins', 'tblclients.userid = tblcustomer_admins.customer_id');
                $this->db->where_in("tblcustomer_admins.customer_id", $results);
                $this->db->where("tblcustomer_admins.staff_id", $staff_id);
                $this->db->where('tblclients.active', 1);
                $query = $this->db->get();
                $result1[] = $query->result_array();
                // $m++;
            }
            $data = [];
            $i = 0;
            foreach ($result1 as $result) {

                foreach ($result as $results) {
                    $contactKey = $this->getContact($results['userid']);
                    $client_type = $this->GetClientTypeById($results['client_type']);

                    $data[$i] = [
                        'userid' => $results['userid'],
                        'company' => $results['company'],
                        'adviser_data_contact' => $results['adviser_data_contact'],
                        'contact_name' => $results['contact_name'],
                        // 'individual_name'        => $results['individual_name'],
                        // 'individual_phonenumber' => $results['individual_phonenumber'],
                        // 'individual_email'       => $results['individual_email'],
                        'individual_name' => $contactKey[0]['firstname'] . " " . $contactKey[0]['lastname'],
                        'individual_phonenumber' => $contactKey[0]['phonenumber'],
                        'individual_email' => $contactKey[0]['email'],
                        'client_type' => $client_type[0]['client_type'],
                        'review_month_name' => $results['review_month_name'],
                        'residential_address' => $results['individual_residential_address'],
                        'ownership' => $results['mtg_owned'],
                        // 'vulnerable'             => $this->clients_model->get_vulnerable_data($results['userid']),
                        // 'vulnerable'             => $this->clients_model->check_vulnerable_data($results['userid'],$results['contact_name']),
                        'vulnerable' => $this->clients_model->check_vulnerable_data($results['userid'], $contactKey[0]['id']),
                    ];
                    $i++;
                }
            }

            return $data;
        }
        # Admin
        if ($cleck_is_admin == 1) {
            $this->db->select('*');
            $this->db->from('tblclients');
            $this->db->where('tblclients.active', 1);
            $query = $this->db->get();
            $result = $query->result_array();
            $data = [];
            $i = 0;
            foreach ($result as $results) {
                $contactKey = $this->getContact($results['userid']);
                $client_type = $this->GetClientTypeById($results['client_type']);

                $data[$i] = [
                    'userid' => $results['userid'],
                    'company' => $results['company'],
                    'adviser_data_contact' => $results['adviser_data_contact'],
                    'contact_name' => $results['contact_name'],
                    // 'individual_name'        => $results['individual_name'],
                    // 'individual_phonenumber' => $results['individual_phonenumber'],
                    // 'individual_email'       => $results['individual_email'],
                    'individual_name' => $contactKey[0]['firstname'] . " " . $contactKey[0]['lastname'],
                    'individual_phonenumber' => $contactKey[0]['phonenumber'],
                    'individual_email' => $contactKey[0]['email'],
                    'client_type' => $client_type[0]['client_type'],
                    'review_month_name' => $results['review_month_name'],
                    'residential_address' => $results['individual_residential_address'],
                    'ownership' => $results['mtg_owned'],
                    // 'vulnerable'             => $this->clients_model->get_vulnerable_data($results['userid']),
                    // 'vulnerable'             => $this->clients_model->check_vulnerable_data($results['userid'],$results['contact_name']),
                    'vulnerable' => $this->clients_model->check_vulnerable_data($results['userid'], $contactKey[0]['id']),
                ];
                $i++;
            }

            return $data;
        }
    }
    // public function get_vulnerable_data($id){
    //     $this->db->select('vulnerable_client');
    //     $this->db->where('userid' , $id);
    //     $this->db->from('tblcontacts');
    //     $result     = $this->db->get();
    //     $exitData   = $result->result_array();
    //     $vulnerable_name = [];
    //     foreach($exitData as $exitDatas){
    //         $vulnerableData = (unserialize($exitDatas['vulnerable_client']));
    //         $m=0;
    //         foreach($vulnerableData as $vulnerableDatas){
    //             $vulnerable_name[$m] =  $this->clients_model->get_vulnerable_name($vulnerableDatas);
    //             $m++;
    //         }
    //     }
    //     return implode(", ",$vulnerable_name);
    // }
    public function check_vulnerable_data($id, $contact_name)
    {
        $this->db->select('checkBox_vulnerable');
        $this->db->where('userid', $id);
        $this->db->where('id', $contact_name);
        $this->db->from('tblcontacts');
        $result = $this->db->get();
        $exitData = $result->result_array();
        foreach ($exitData as $exitDatas) {
            $vulnerable_or_not = $exitDatas['checkBox_vulnerable'];
        }
        if ($vulnerable_or_not == 1) {
            return 'vulnerable';
        }
        if ($vulnerable_or_not == 0) {
            return '';
        }
    }

    public function get_vulnerable_name($vulnerableDatas)
    {
        $this->db->select('vulnerabledrivers');
        $this->db->where('id', $vulnerableDatas);
        $this->db->from('tblvulnerabledrivers');
        $query = $this->db->get();
        $result = $query->row();
        return $result->vulnerabledrivers;
    }
    public function fetchClient_filter_review_data($filter, $cleck_is_admin)
    {
        # Non Admin
        if ($cleck_is_admin == 0) {
            $staff_id = get_staff_user_id();
            # NEW ADDED
            $this->db->select("customer_id");
            $this->db->from("tblcustomer_admins");
            $this->db->where("staff_id", $staff_id);
            $query = $this->db->get();
            $result = $query->result_array();

            foreach ($result as $results) {
                $this->db->select('*');
                $this->db->from('tblclients');
                $this->db->join('tblcustomer_adviser', 'tblclients.userid = tblcustomer_adviser.customer_id');
                $this->db->join('tblcustomer_admins', 'tblclients.userid = tblcustomer_admins.customer_id');
                $this->db->where("tblcustomer_admins.staff_id", $staff_id);
                $this->db->where('tblclients.active', 1);
                $this->db->where_in("tblcustomer_admins.customer_id", $results);
                if ($filter['adviser'] != '') {
                    $this->db->where_in('tblcustomer_adviser.staff_id', $filter['adviser']);
                }
                if ($filter['type'] != '') {
                    $this->db->where_in('tblclients.client_type', $filter['type']);
                }
                if (($filter['client_review_month'] != '')) {
                    $this->db->where('tblclients.client_review_month', $filter['client_review_month']);
                }
                $query = $this->db->get();
                $result1[] = $query->result_array();
            }

            $data = [];
            $i = 0;
            foreach ($result1 as $result) {
                foreach ($result as $results) {
                    $contactKey = $this->getContact($results['userid']);
                    $client_type = $this->GetClientTypeById($results['client_type']);
                    $data[$i] = [
                        'userid' => $results['userid'],
                        'company' => $results['company'],
                        'adviser_data_contact' => $results['adviser_data_contact'],
                        'contact_name' => $results['contact_name'],
                        // 'individual_name'        => $results['individual_name'],
                        // 'individual_phonenumber' => $results['individual_phonenumber'],
                        // 'individual_email'       => $results['individual_email'],
                        'individual_name' => $contactKey[0]['firstname'] . " " . $contactKey[0]['lastname'],
                        'individual_phonenumber' => $contactKey[0]['phonenumber'],
                        'individual_email' => $contactKey[0]['email'],
                        'client_type' => $client_type[0]['client_type'],
                        'review_month_name' => $results['review_month_name'],
                        'residential_address' => $results['individual_residential_address'],
                        'ownership' => $results['mtg_owned'],
                        // 'vulnerable'             => $this->clients_model->get_vulnerable_data($results['userid']),
                        // 'vulnerable'             => $this->clients_model->check_vulnerable_data($results['userid'],$results['contact_name']),
                        'vulnerable' => $this->clients_model->check_vulnerable_data($results['userid'], $contactKey[0]['id']),
                    ];
                    $i++;
                }
            }
            return $data;
        }
        # Admin
        if ($cleck_is_admin == 1) {
            $this->db->select('*');
            $this->db->from('tblclients');
            $this->db->join('tblcustomer_adviser', 'tblclients.userid = tblcustomer_adviser.customer_id');

            $this->db->where('tblclients.active', 1);

            if ($filter['adviser'] != '') {
                $this->db->where_in('tblcustomer_adviser.staff_id', $filter['adviser']);
            }
            if ($filter['type'] != '') {
                $this->db->where_in('tblclients.client_type', $filter['type']);
            }
            if (($filter['client_review_month'] != '')) {
                $this->db->where('tblclients.client_review_month', $filter['client_review_month']);
            }
            $query = $this->db->get();
            $result = $query->result_array();
            $data = [];
            $i = 0;
            foreach ($result as $results) {
                $contactKey = $this->getContact($results['userid']);
                $client_type = $this->GetClientTypeById($results['client_type']);
                $data[$i] = [
                    'userid' => $results['userid'],
                    'company' => $results['company'],
                    'adviser_data_contact' => $results['adviser_data_contact'],
                    'contact_name' => $results['contact_name'],
                    // 'individual_name'        => $results['individual_name'],
                    // 'individual_phonenumber' => $results['individual_phonenumber'],
                    // 'individual_email'       => $results['individual_email'],
                    'individual_name' => $contactKey[0]['firstname'] . " " . $contactKey[0]['lastname'],
                    'individual_phonenumber' => $contactKey[0]['phonenumber'],
                    'individual_email' => $contactKey[0]['email'],
                    'client_type' => $client_type[0]['client_type'],
                    'review_month_name' => $results['review_month_name'],
                    'residential_address' => $results['individual_residential_address'],
                    'ownership' => $results['mtg_owned'],
                    // 'vulnerable'             => $this->clients_model->get_vulnerable_data($results['userid']),
                    // 'vulnerable'             => $this->clients_model->check_vulnerable_data($results['userid'],$results['contact_name']),
                    'vulnerable' => $this->clients_model->check_vulnerable_data($results['userid'], $contactKey[0]['id']),
                ];
                $i++;
            }
            return $data;
        }
    }

    public function saveArchiveFiles($data)
    {
        $this->db->insert('tbl_achive_files', $data);
        $lastid = $this->db->insert_id();
        return $lastid;
    }
    public function fetchArchiveFiles($data)
    {
        $this->db->select('tblclients.company, tbl_achive_files.id, tbl_achive_files.customer ,tbl_achive_files.date_created ,tblstaff.firstname ,tbl_achive_files.hyper_link ,tblstaff.lastname');
        $this->db->from('tbl_achive_files');
        $this->db->join('tblstaff', 'tblstaff.staffid = tbl_achive_files.staff_id');
        $this->db->join('tblclients', 'tblclients.userid = tbl_achive_files.customer');
        $this->db->where_in('is_deleted', 0);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function deleteArchive_file($data, $id)
    {
        $this->db->where('id', $id);
        $result = $this->db->update('tbl_achive_files', $data);
        return $result;
    }
    public function edit_archive_file($edit_archive_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_achive_files');
        $this->db->where('id', $edit_archive_id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function updateArchiveFiles($archive_id, $data)
    {
        $this->db->where('id', $archive_id);
        $result = $this->db->update('tbl_achive_files', $data);
        return $result;
    }
    public function archive_file($id)
    {
        $this->db->select('hyper_link');
        $this->db->from('tbl_achive_files');
        $this->db->where('customer', $id);
        $this->db->where('is_deleted', 0);
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->row();
        $result_1 = $result->hyper_link;
        return $result_1;
    }

    public function date_of_birth()
    {
        $this->db->select('id,dob');
        $this->db->from('tblcontacts');
        $query = $this->db->get();
        $result = $query->result_array();
        $currentDate = date('Y-m-d'); // Get the current date in the format 'YYYY-MM-DD'
        foreach ($result as &$person) {
            $dob = $person['dob'];
            // Skip if the date of birth is invalid or missing
            if ($dob == '0000-00-00') {
                continue;
            }
            $dobDateTime = new DateTime($dob);
            $currentDateTime = new DateTime($currentDate);
            $ageInterval = $currentDateTime->diff($dobDateTime);
            $person['age'] = $ageInterval->y; // Extract the years from the interval
        }

        $collect_dob_data = $result;
        foreach ($collect_dob_data as $collect_dob_datas) {
            $this->clients_model->update_dob($collect_dob_datas['id'], $collect_dob_datas['age']);
        }

        return $result;
    }
    public function update_dob($id, $age)
    {
        // echo" hii";
        // exit;
        $data = array(
            'age' => $age,
        );
        $this->db->where('id', $id);
        $result = $this->db->update('tblcontacts', $data);
        return $result;
    }

    #Provider Summary report
#Provider Summary report
    public function provider_summary_data($cleck_is_admin)
    {
        // $individualFirstName = $this->session->userdata('firstNameClientdashboard');
        // $individualLastName = $this->session->userdata('lastNameClientdashboard');
        // if (isset($individualFirstName) || isset($individualLastName)) 
        // {
        //     $this->db->select('userid');
        //     $this->db->from('tblcontacts');
        //     if ($individualFirstName != '') 
        //     {
        //         $this->db->where('firstname' , $individualFirstName);
        //     }
        //     if ($individualLastName != '') 
        //     {
        //         $this->db->where('lastname' , $individualLastName);
        //     }
        //     $query  = $this->db->get();
        //     $customerIds = $query->result_array();
        //     $customerIds2 = [];
        //     $data = [];
        //     if(!empty($customerIds))
        //     {
        //         foreach($customerIds as $row)
        //         {
        //             $customerIds2[] = $row['userid'];
        //         }
        //     } 
        //     else 
        //     {
        //         return $data;
        //     }
        if ($cleck_is_admin == 0) {
            $staff_id = get_staff_user_id();
            $this->db->select("tblcustomer_admins.customer_id, tblpolicy.customer");
            $this->db->from("tblcustomer_admins");
            $this->db->join("tblpolicy", "tblcustomer_admins.customer_id = tblpolicy.customer");
            $this->db->where("tblcustomer_admins.staff_id", $staff_id);
            $this->db->where('tblpolicy.policy_status', 'In-force');
            $this->db->where('tblpolicy.is_deleted', 0);
            $query = $this->db->get();
            $customerdetails = $query->result_array();
            // echo $this->db->last_query();
            // print_r($cids);
            // exit;
            foreach ($customerdetails as $customerdetail) {
                // $cids[] = $customerdetail['customer_id'];
                $cids[] = $customerdetail['customer'];
            }


            $cids = array_unique($cids);
            $result2 = [];
            $provider = [];

            foreach ($cids as $cid) {
                $this->db->select('tblpolicy.provider_id,tblpolicy.provider');
                $this->db->from('tblpolicy');
                $this->db->join('tblclients', 'tblpolicy.customer=tblclients.userid');
                $this->db->where('tblclients.active', 1);
                $this->db->where('tblpolicy.policy_status', 'In-force');
                $this->db->where('tblpolicy.customer', $cid);
                $this->db->where('tblpolicy.is_deleted', 0);
                // $this->db->where_in('tblpolicy.customer',$customerIds2);
                // $this->db->group_by('tblpolicy.provider_id');
                $query = $this->db->get();
                $result = $query->result_array();

                if (!empty($result)) {
                    foreach ($result as $row) {
                        //     if (!in_array($row[], $result2)) 
                        //     {
                        //         $result2[] = $row;
                        //     } 

                        if (!in_array($row['provider'], $provider)) {
                            $result2[] = $row;
                            $provider[] = $row['provider'];
                        }
                    }
                }
            }
            $i = 0;
            foreach ($result2 as $results) {
                $provider_id = $results['provider_id'];
                $provider = $results['provider'];

                if ($provider_id != '' || $provider != '') {
                    $data[$i] = [
                        'provider' => $results['provider'],
                        'client_data' => $this->clients_model->client_data($cids, $provider_id, $provider),
                        'policies' => $this->clients_model->policies($cids, $provider_id, $provider),
                        'api' => $this->clients_model->total_premium($cids, $provider_id, $provider),
                        'life_assured' => $this->clients_model->count_life_assured($cids, $provider_id, $provider),
                    ];
                    $i++;
                }
            }
            // exit;
            return $data;

        }
        if ($cleck_is_admin == 1) {

            $result2 = [];
            $provider = [];
            $this->db->select('provider_id,provider');
            $this->db->from('tblpolicy');
            $this->db->join('tblclients', 'tblpolicy.customer=tblclients.userid');
            $this->db->where('tblclients.active', 1);
            // $this->db->group_by('provider_id');
            // $this->db->where('policy_status_id',2);
            $this->db->where('tblpolicy.policy_status', 'In-force');
            $this->db->where('tblpolicy.is_deleted', 0);
            // $this->db->where_in('tblclients.userid',$customerIds2);
            $query = $this->db->get();
            $result = $query->result_array();

            if (!empty($result)) {
                foreach ($result as $row) {
                    // if (!in_array($row, $result2)) 
                    // {
                    //     $result2[] = $row;
                    // }
                    if (!in_array($row['provider'], $provider)) {
                        $result2[] = $row;
                        $provider[] = $row['provider'];
                    }
                }
            }

            $i = 0;
            $data = [];
            $cids = [];
            foreach ($result2 as $results) {

                $provider_id = $results['provider_id'];
                $provider = $results['provider'];
                if ($provider_id != '' || $provider != '') {
                    $data[$i] = [
                        'provider' => $results['provider'],
                        'client_data' => $this->clients_model->client_data($cids, $provider_id, $provider),
                        'policies' => $this->clients_model->policies($cids, $provider_id, $provider),
                        'api' => $this->clients_model->total_premium($cids, $provider_id, $provider),
                        'life_assured' => $this->clients_model->count_life_assured($cids, $provider_id, $provider),
                    ];
                    $i++;
                }
            }
            return $data;
        }
        // }

    }
    // $this->db->where('active',1);
    public function count_life_assured($cids, $provider_id, $provider)
    {
        if (is_admin()) {
            $this->db->select('life_assured');
            $this->db->from('tblpolicy');
            // $this->db->group_by('policy_number');
            // $this->db->group_start();
            // $this->db->where_in('provider_id' , $provider_id);
            // $this->db->or_where('provider' , $provider);
            // $this->db->group_end();
            $this->db->where('provider', $provider);
            $this->db->where('policy_status', 'In-force');
            $this->db->where('is_deleted', 0);
            $query = $this->db->get();
            $result = $query->result_array();

        } else {
            $this->db->select('life_assured');
            $this->db->from('tblpolicy');
            $this->db->group_by('policy_number');
            // $this->db->group_start();
            // $this->db->where_in('provider_id' , $provider_id);
            // $this->db->or_where('provider' , $provider);
            // $this->db->group_end();
            $this->db->where('provider', $provider);
            $this->db->where('policy_status', 'In-force');
            $this->db->where('is_deleted', 0);
            $this->db->where_in('customer', $cids);

            $query = $this->db->get();
            $result = $query->result_array();
        }
        $life_assureds = [];
        foreach ($result as $customerdetail) {
            if ($customerdetail['life_assured'] != "") {
                $unserialized_data = unserialize($customerdetail['life_assured']);
                foreach ($unserialized_data as $index => $value) {
                    if (!empty($value)) {
                        $life_assureds[] = $value;
                    }
                }
            }

        }

        $life_assureds = array_unique($life_assureds);
        if (!empty($life_assureds)) {
            $this->db->select('*');
            $this->db->from('tblcontacts');
            $this->db->where_in('userid', $life_assureds);
            $this->db->where('active', 1);
            $query1 = $this->db->get();
            $result1 = $query1->result_array();
        }
        return count($result1);
    }

    public function client_data($cids, $provider_id, $provider)
    {
        if (is_admin()) {
            $this->db->select('customer');
            $this->db->from('tblpolicy');
            // $this->db->group_by('customer');
            // $this->db->group_start();
            // $this->db->where_in('provider_id' , $provider_id);
            // $this->db->or_where('provider' , $provider);
            // $this->db->group_end();
            $this->db->where('provider', $provider);
            $this->db->where('policy_status', 'In-force');
            $this->db->where('policy.is_deleted', 0);
            $query = $this->db->get();
            $result = $query->num_rows();
            return $result;
        } else {
            $this->db->select('customer');
            $this->db->from('tblpolicy');
            // $this->db->group_by('customer');
            // $this->db->group_start();
            // $this->db->where_in('provider_id' , $provider_id);
            // $this->db->or_where('provider' , $provider);
            // $this->db->group_end();
            $this->db->where('provider', $provider);
            $this->db->where('policy_status', 'In-force');
            $this->db->where('is_deleted', 0);
            $this->db->where_in('customer', $cids);
            $query = $this->db->get();
            $result = $query->num_rows();
            return $result;

        }

    }

    public function policies($cid, $provider_id, $provider)
    {
        if (is_admin()) {
            $this->db->select('policy_number');
            $this->db->from('tblpolicy');
            // $this->db->group_by('policy_number');
            // $this->db->group_start();
            // $this->db->where_in('provider_id', $provider_id);
            // $this->db->or_where_in('provider', $provider);
            // $this->db->group_end();
            $this->db->where('provider', $provider);
            $this->db->where('policy_status', 'In-force');
            $this->db->where('is_deleted', 0);
            $query = $this->db->get();
            $result = $query->num_rows();
            return $result;

        } else {
            $this->db->select('policy_number');
            $this->db->from('tblpolicy');
            // $this->db->group_by('policy_number');
            // $this->db->where('provider_id', $provider_id);
            // $this->db->group_start();
            // $this->db->where_in('provider_id', $provider_id);
            // $this->db->or_where_in('provider', $provider);
            // $this->db->group_end();
            $this->db->where('provider', $provider);
            $this->db->where_in('customer', $cid);
            $this->db->where('policy_status', 'In-force');
            $this->db->where('is_deleted', 0);
            $query = $this->db->get();
            $result = $query->num_rows();
            return $result;

        }

    }

    public function total_premium($cid, $provider_id, $provider)
    {
        if (is_admin()) {
            $this->db->select('total_premium');
            $this->db->from('tblpolicy');
            // $this->db->group_by('policy_number');
            // $this->db->group_start();
            // $this->db->where_in('provider_id', $provider_id);
            // $this->db->or_where_in('provider', $provider);
            // $this->db->group_end(); 
            $this->db->where('provider', $provider);
            $this->db->where('policy_status', 'In-force');
            $this->db->where('is_deleted', 0);
            $query = $this->db->get();
            $result = $query->result_array();
        } else {
            $this->db->select('total_premium');
            $this->db->from('tblpolicy');
            // $this->db->group_by('policy_number');
            // $this->db->group_start(); 
            // $this->db->where_in('provider_id', $provider_id);
            // $this->db->or_where_in('provider', $provider);
            // $this->db->group_end();
            // $this->db->where('provider_id', $provider_id);
            $this->db->where('provider', $provider);
            $this->db->where_in('customer', $cid);
            $this->db->where('policy_status', 'In-force');
            $this->db->where('is_deleted', 0);
            $query = $this->db->get();
            $result = $query->result_array();

        }
        $lapsed_api_total = 0;
        foreach ($result as $apibeinglapseds) {
            $apibeing = $apibeinglapseds['total_premium'];
            $dollerData = mb_substr(trim($apibeing), 0, 1);

            if ($dollerData == '$') {
                $numericdata = substr(trim($apibeing), 1);
                $sum_numeric_data = trim(str_replace(",", "", $numericdata));
            } else {
                $sum_numeric_data = $apibeing;
            }
            $lapsed_api_total += $sum_numeric_data;
        }
        // print_r($lapsed_api_total);

        $lapsed_Api_total = '$' . number_format($lapsed_api_total, 2) . '';
        return $lapsed_Api_total;
    }

    #Client group api report
// public function client_group_api()
// {
//     $this->db->select('customer');
//     $this->db->group_by('customer');
//     $this->db->from('tblpolicy');

    //     $this->db->join('tblclients','tblpolicy.customer=tblclients.userid');
//     $this->db->where('tblclients.active',1);
//     $this->db->where('policy_status_id',2);

    //     $query  = $this->db->get();
//     $result = $query->result_array();

    //     $i = 0;
//     foreach($result as $results){
//        $customer = $results['customer'];

    //        $data[$i] = [
//             'customer_id'     => $customer,
//             'customer_name'   => $this->clients_model->customer_name($customer),
//             'individual_name' => $this->clients_model->individual_name($customer),
//             'count_policy' => $this->clients_model->count_policy($customer),

    //             'api'             => $this->clients_model->total_premium_per_customer($customer),
//         ];
//         $i++;
//     }
//     return $data;
// }

    public function client_group_api($cleck_is_admin)
    {
        // $individualFirstName = $this->session->userdata('firstNameClientdashboard');
        // $individualLastName = $this->session->userdata('lastNameClientdashboard');
        // if (isset($individualFirstName) || isset($individualLastName)) 
        // {
        //     $this->db->select('userid');
        //     $this->db->from('tblcontacts');
        //     if ($individualFirstName != '') 
        //     {
        //         $this->db->where('firstname' , $individualFirstName);
        //     }
        //     if ($individualLastName != '') 
        //     {
        //         $this->db->where('lastname' , $individualLastName);
        //     }
        //     $query  = $this->db->get();
        //     $customerIds = $query->result_array();
        //     $customerIds2 = [];
        //     $data = [];
        //     if(!empty($customerIds))
        //     {
        //         foreach($customerIds as $row)
        //         {
        //             $customerIds2[] = $row['userid'];
        //         }
        //     } 
        //     else 
        //     {
        //         return $data;
        //     }
        if ($cleck_is_admin == 0) {
            $staff_id = get_staff_user_id();
            $this->db->select("tblcustomer_admins.customer_id, tblpolicy.customer");
            $this->db->from("tblcustomer_admins");
            $this->db->join("tblpolicy", "tblcustomer_admins.customer_id = tblpolicy.customer");
            $this->db->where("tblcustomer_admins.staff_id", $staff_id);
            $this->db->where('tblpolicy.policy_status', 'In-force');
            $this->db->where('tblpolicy.is_deleted', 0);
            $query = $this->db->get();

            $customerdetails = $query->result_array();

            // neW eNDED

            foreach ($customerdetails as $customerdetail) {
                // $cids[] = $customerdetail['customer_id'];
                $cids[] = $customerdetail['customer'];
            }

            $cids = array_unique($cids);

            foreach ($cids as $cid) {
                $this->db->select('customer');
                $this->db->group_by('customer');
                $this->db->from('tblpolicy');
                $this->db->join('tblclients', 'tblpolicy.customer=tblclients.userid');
                $this->db->where('tblclients.active', 1);
                // $this->db->where('policy_status_id',2);
                $this->db->where('tblpolicy.policy_status', 'In-force');
                $this->db->where('tblpolicy.is_deleted', 0);
                $this->db->where('tblpolicy.customer', $cid);
                // $this->db->where_in('tblpolicy.customer',$customerIds2);

                $query = $this->db->get();
                $result[] = $query->result_array();

            }

            $i = 0;
            foreach ($result as $result_one) {
                foreach ($result_one as $results) {
                    $customer = $results['customer'];

                    $data[$i] = [
                        'customer_id' => $customer,
                        'customer_name' => $this->clients_model->customer_name($customer),
                        'individual_name' => $this->clients_model->individual_name($customer),
                        'count_policy' => $this->clients_model->count_policy($customer),
                        'api' => $this->clients_model->total_premium_per_customer($customer),
                    ];
                    $i++;
                }
            }
            return $data;
        }
        if ($cleck_is_admin == 1) {
            $this->db->select('customer');
            $this->db->group_by('customer');
            $this->db->from('tblpolicy');
            $this->db->join('tblclients', 'tblpolicy.customer=tblclients.userid');
            // $this->db->where_in('tblclients.userid',$customerIds2);
            $this->db->where('tblclients.active', 1);
            // $this->db->where('policy_status_id',2);
            $this->db->where('tblpolicy.policy_status', 'In-force');
            $this->db->where('tblpolicy.is_deleted', 0);
            $query = $this->db->get();
            $result = $query->result_array();

            $i = 0;
            foreach ($result as $results) {
                $customer = $results['customer'];

                $data[$i] = [
                    'customer_id' => $customer,
                    'customer_name' => $this->clients_model->customer_name($customer),
                    'individual_name' => $this->clients_model->individual_name($customer),
                    'count_policy' => $this->clients_model->count_policy($customer),
                    'api' => $this->clients_model->total_premium_per_customer($customer),
                ];
                $i++;
            }
            return $data;
        }
        // }
    }

    public function count_policy($customer)
    {
        $this->db->select('id');
        $this->db->from('tblpolicy');
        $this->db->where_in('customer', $customer);
        $this->db->where('policy_status', 'In-force');
        $this->db->where('is_deleted', 0);
        $query = $this->db->get();
        $result = $query->result_array();
        return count($result);
    }

    public function individual_name($customer)
    {
        // $this->db->select('*');
        // $this->db->from('tblcontacts');
        // $this->db->where_in('userid' , $customer);
        // $this->db->where('active' , 1);
        // $query  = $this->db->get();
        // $result = $query->result_array();
        // print_r($result);
        $this->db->select('life_assured');
        $this->db->from('tblpolicy');
        $this->db->where_in('customer', $customer);
        $this->db->where('policy_status', 'In-force');
        $this->db->where('is_deleted', 0);
        $query = $this->db->get();
        $results = $query->result_array();
        $life_assureds = [];
        foreach ($results as $customerdetail) {
            if ($customerdetail['life_assured'] != "") {
                $unserialized_data = unserialize($customerdetail['life_assured']);
                foreach ($unserialized_data as $index => $value) {
                    if (!empty($value)) {
                        $life_assureds[] = $value;
                    }
                }
            }

        }
        $life_assureds = array_unique($life_assureds);
        if (!empty($life_assureds)) {
            $this->db->select('*');
            $this->db->from('tblcontacts');
            $this->db->where_in('id', $life_assureds);
            $this->db->where('active', 1);
            $query1 = $this->db->get();
            $result = $query1->result_array();
        }
        return count($result);
    }

    public function customer_name($customer)
    {
        $this->db->select('company');
        $this->db->from('tblclients');
        $this->db->where_in('userid', $customer);
        $this->db->where('active', 1);
        $query = $this->db->get();
        $result = $query->row();
        return $result->company;
    }

    public function total_premium_per_customer($customer)
    {
        $this->db->select('total_premium');
        $this->db->from('tblpolicy');
        $this->db->group_by('policy_number');
        $this->db->where_in('customer', $customer);
        $this->db->where('policy_status', 'In-force');
        $this->db->where('is_deleted', 0);
        $query = $this->db->get();
        // echo $this->db->last_query();
        // echo ";<br>";
        $result = $query->result_array();

        $lapsed_api_total = 0;
        foreach ($result as $apibeinglapseds) {
            $apibeing = $apibeinglapseds['total_premium'];
            $dollerData = mb_substr(trim($apibeing), 0, 1);
            if ($dollerData == '$') {
                $numericdata = substr(trim($apibeing), 1);
                $sum_numeric_data = trim(str_replace(",", "", $numericdata));
            } else {
                $sum_numeric_data = $apibeing;
            }
            $lapsed_api_total += $sum_numeric_data;
        }
        $lapsed_Api_total = '$' . number_format($lapsed_api_total, 2) . '';

        return $lapsed_Api_total;
    }

    #Age Profile report
// public function ageProfile()
// {
//     $this->db->select('*');
//     $this->db->from('tblcontacts');
//     $query  = $this->db->get();
//     $result = $query->result_array();

    //     $ageRanges = array(
//         '0-10'  => 0,'10-20' => 0 , '20-30' => 0 , '30-40' => 0,'40-50' => 0 ,'50-60'=> 0,
//         '60-70' => 0,'70-80' => 0,'80-90'   => 0,'90-100'  => 0,
//     );

    //     foreach ($result as $entry) {
//         if (isset($entry['age'])) {
//             $age = (int)$entry['age'];

    //             if ($age >= 0 && $age <= 10) {
//                 $ageRanges['0-10']++;
//             } elseif ($age > 10 && $age <= 20) {
//                 $ageRanges['10-20']++;
//             } elseif ($age > 20 && $age <= 30) {
//                 $ageRanges['20-30']++;
//             } elseif ($age > 30 && $age <= 40) {
//                 $ageRanges['30-40']++;
//             } elseif ($age > 40 && $age <= 50) {
//                 $ageRanges['40-50']++;
//             } elseif ($age > 50 && $age <= 60) {
//                 $ageRanges['50-60']++;
//             } elseif ($age > 60 && $age <= 70) {
//                 $ageRanges['60-70']++;
//             } elseif ($age > 70 && $age <= 80) {
//                 $ageRanges['70-80']++;
//             } elseif ($age > 80 && $age <= 90) {
//                 $ageRanges['80-90']++;
//             } elseif ($age > 90 && $age <= 100) {
//                 $ageRanges['90-100']++;
//             }
//         }
//     }
//     $i=0;
//     foreach ($ageRanges as $range => $count) {
//         $data[$i] = [
//             'age_range'   => $range,
//             'no_of_count' => $count,
//         ];
//         $i++;
//     }  
//     return $data;
// }
    public function ageProfile($cleck_is_admin)
    {
        // $individualFirstName = $this->session->userdata('firstNameClientdashboard');
        // $individualLastName = $this->session->userdata('lastNameClientdashboard');
        // if (isset($individualFirstName) || isset($individualLastName)) 
        // {
        //     $this->db->select('userid');
        //     $this->db->from('tblcontacts');
        //     if ($individualFirstName != '') 
        //     {
        //         $this->db->where('firstname' , $individualFirstName);
        //     }
        //     if ($individualLastName != '') 
        //     {
        //         $this->db->where('lastname' , $individualLastName);
        //     }
        //     $query  = $this->db->get();
        //     $customerIds = $query->result_array();
        //     $customerIds2 = [];
        //     $data = [];
        //     if(!empty($customerIds))
        //     {
        //         foreach($customerIds as $row)
        //         {
        //             $customerIds2[] = $row['userid'];
        //         }
        //     } 
        //     else 
        //     {
        //         return $data;
        //     }

        if ($cleck_is_admin == 0) {

            $staff_id = get_staff_user_id();

            $this->db->select("tblcustomer_admins.customer_id, tblpolicy.life_assured");
            $this->db->from("tblcustomer_admins");
            $this->db->join("tblpolicy", "tblcustomer_admins.customer_id = tblpolicy.customer");
            $this->db->where("tblcustomer_admins.staff_id", $staff_id);
            $this->db->where('policy.policy_status', 'In-force');
            $this->db->where('policy.is_deleted', 0);
            $querycustomer = $this->db->get();
            $customerdetails = $querycustomer->result_array();
            $life_assureds = [];

            foreach ($customerdetails as $customerdetail) {
                if ($customerdetail['life_assured'] != "") {
                    $unserialized_data = unserialize($customerdetail['life_assured']);
                    foreach ($unserialized_data as $index => $value) {
                        if (!empty($value)) {
                            $life_assureds[] = $value;
                        }
                    }
                }

            }
            $cids = array_unique($life_assureds);
            $result2 = [];

            foreach ($cids as $cid) {
                $this->db->select('*');
                $this->db->from('tblcontacts');
                $this->db->where('tblcontacts.id', $cid);
                $this->db->where('active', 1);
                $query = $this->db->get();
                $result = $query->result_array();
                if (!empty($result)) {
                    foreach ($result as $res) {
                        $result2[] = $res;
                    }
                }
            }

            $ageRanges = array(
                '0-10' => 0,
                '10-20' => 0,
                '20-30' => 0,
                '30-40' => 0,
                '40-50' => 0,
                '50-60' => 0,
                '60-70' => 0,
                '70-80' => 0,
                '80-90' => 0,
                '90-100' => 0,
                '100-110' => 0,
                '110+' => 0,
            );

            foreach ($result2 as $entry) {
                if (isset($entry['age'])) {
                    $age = (int) $entry['age'];

                    if ($age >= 0 && $age <= 10) {
                        $ageRanges['0-10']++;
                    } elseif ($age > 10 && $age <= 20) {
                        $ageRanges['10-20']++;
                    } elseif ($age > 20 && $age <= 30) {
                        $ageRanges['20-30']++;
                    } elseif ($age > 30 && $age <= 40) {
                        $ageRanges['30-40']++;
                    } elseif ($age > 40 && $age <= 50) {
                        $ageRanges['40-50']++;
                    } elseif ($age > 50 && $age <= 60) {
                        $ageRanges['50-60']++;
                    } elseif ($age > 60 && $age <= 70) {
                        $ageRanges['60-70']++;
                    } elseif ($age > 70 && $age <= 80) {
                        $ageRanges['70-80']++;
                    } elseif ($age > 80 && $age <= 90) {
                        $ageRanges['80-90']++;
                    } elseif ($age > 90 && $age <= 100) {
                        $ageRanges['90-100']++;
                    } elseif ($age > 100 && $age <= 110) {
                        $ageRanges['100-110']++;
                    } elseif ($age > 110) {
                        $ageRanges['110+']++;
                    }
                }
            }

            $i = 0;
            foreach ($ageRanges as $range => $count) {
                $data[$i] = [
                    'age_range' => $range,
                    'no_of_count' => $count,
                ];
                $i++;
            }
            // echo"<pre>";
            // print_r($ageRanges['30-40']);
            // exit;
            return $data;
        }

        if ($cleck_is_admin == 1) {
            $this->db->select('*');
            $this->db->from('tblcontacts');
            // $this->db->where_in('tblcontacts.userid',$customerIds2);//new condtion
            $query = $this->db->get();
            $result = $query->result_array();

            $ageRanges = array(
                '0-10' => 0,
                '10-20' => 0,
                '20-30' => 0,
                '30-40' => 0,
                '40-50' => 0,
                '50-60' => 0,
                '60-70' => 0,
                '70-80' => 0,
                '80-90' => 0,
                '90-100' => 0,
                '100-110' => 0,
                '110+' => 0,
            );
            foreach ($result as $entry) {
                if (isset($entry['age'])) {
                    $age = (int) $entry['age'];

                    if ($age >= 0 && $age <= 10) {
                        $ageRanges['0-10']++;
                    } elseif ($age > 10 && $age <= 20) {
                        $ageRanges['10-20']++;
                    } elseif ($age > 20 && $age <= 30) {
                        $ageRanges['20-30']++;
                    } elseif ($age > 30 && $age <= 40) {
                        $ageRanges['30-40']++;
                    } elseif ($age > 40 && $age <= 50) {
                        $ageRanges['40-50']++;
                    } elseif ($age > 50 && $age <= 60) {
                        $ageRanges['50-60']++;
                    } elseif ($age > 60 && $age <= 70) {
                        $ageRanges['60-70']++;
                    } elseif ($age > 70 && $age <= 80) {
                        $ageRanges['70-80']++;
                    } elseif ($age > 80 && $age <= 90) {
                        $ageRanges['80-90']++;
                    } elseif ($age > 90 && $age <= 100) {
                        $ageRanges['90-100']++;
                    } elseif ($age > 100 && $age <= 110) {
                        $ageRanges['100-110']++;
                    } elseif ($age > 110) {
                        $ageRanges['100+']++;
                    }
                }
            }
            $i = 0;
            foreach ($ageRanges as $range => $count) {
                $data[$i] = [
                    'age_range' => $range,
                    'no_of_count' => $count,
                ];
                $i++;
            }
            return $data;

        }
        // }
    }
    // #Client Group Type report
// public function clientGroupType(){
//     $this->db->select('userid,client_type');
//     $this->db->from('tblclients');
//     $this->db->where('tblclients.active',1);
//     $query  = $this->db->get();
//     $result = $query->result_array();
//     $clientTypesToCount = array(4, 5, 6, 7);
//     $userIDCounts       = array_fill_keys($clientTypesToCount, array());

    //     foreach ($result as $item) {
//         $clientType      = $item['client_type'];
//         $clientType_name = $item['userid'];
//         $userID          = $item['userid'];
//         if (in_array($clientType, $clientTypesToCount) && $userID !== '') {
//             $userIDCounts[$clientType][] = $userID;
//         }
//     }
//     $i=0;
//     foreach ($userIDCounts as $clientType => $userIDs) {
//         $total_premium    = $this->clients_model->getcollection_total_premium($userIDs);
//         $lapsed_api_total = 0;
//         foreach ($total_premium as $innerArrays) {
//             foreach($innerArrays as $innerArray){
//                 $apibeing   = $innerArray['total_premium'];
//                 $dollerData = mb_substr(trim($apibeing), 0, 1);
//                 if($dollerData == '$'){
//                     $numericdata      = substr(trim($apibeing),1);
//                     $sum_numeric_data = trim(str_replace(",", "", $numericdata));
//                 }
//                 else{
//                     $sum_numeric_data = $apibeing;
//                 }
//                 $lapsed_api_total += $sum_numeric_data;
//             }

    //         }
//         $total_primium_Api_total = '$'.number_format($lapsed_api_total ,2).'';

    //         $data[$i] = [
//             #'clientType'   => $clientType,
//             'client_type'   => $this->clients_model->client_type($clientType),
//             #'user_id'      => $userIDs,
//             'count'         => count($userIDs),
//             'total_primium_added' => $total_primium_Api_total,
//         ];
//         $i++;
//     }
//     return $data;
// }


    #Client Group Type report
    public function clientGroupType($cleck_is_admin)
    {
        /*$individualFirstName = $this->session->userdata('firstNameClientdashboard');
        $individualLastName = $this->session->userdata('lastNameClientdashboard');
        if (isset($individualFirstName) || isset($individualLastName)) 
        {
            $this->db->select('userid');
            $this->db->from('tblcontacts');
            if ($individualFirstName != '') 
            {
                $this->db->where('firstname' , $individualFirstName);
            }
            if ($individualLastName != '') 
            {
                $this->db->where('lastname' , $individualLastName);
            }
            $query  = $this->db->get();
            $customerIds = $query->result_array();
            $customerIds2 = [];
            $data = [];
            if(!empty($customerIds))
            {
                foreach($customerIds as $row)
                {
                    $customerIds2[] = $row['userid'];
                }
            } 
            else 
            {
                return $data;
            }*/
        if ($cleck_is_admin == 0) {
            $staff_id = get_staff_user_id();
            // //NEW ADDED

            // $this->db->select("customer_id");
            // // $this->db->from("tblcustomer_adviser");
            // $this->db->from("tblcustomer_admins");
            // $this->db->where("staff_id",$staff_id);
            // $this->db->select("tblcustomer_admins.customer_id, tblpolicy.customer");
            $this->db->select("*");
            $this->db->from("tblcustomer_admins");
            $this->db->join("tblpolicy", "tblcustomer_admins.customer_id = tblpolicy.customer");
            $this->db->where("tblcustomer_admins.staff_id", $staff_id);
            $this->db->where('policy.policy_status', 'In-force');
            $this->db->where('policy.is_deleted', 0);
            $querycustomer = $this->db->get();
            $customerdetails = $querycustomer->result_array();

            foreach ($customerdetails as $customerdetail) {
                // $cids[] = $customerdetail['customer_id'];
                $cids[] = $customerdetail['customer'];
            }

            $cids = array_unique($cids);


            $result2 = [];

            foreach ($cids as $cid) {

                $this->db->select('userid,client_type');
                $this->db->from('tblclients');
                $this->db->where('tblclients.active', 1);

                $this->db->where('tblclients.userid', $cid);
                // $this->db->where_in('tblclients.userid',$customerIds2);//added new condtion
                $query = $this->db->get();
                $result = $query->result_array();
                if (!empty($result)) {
                    foreach ($result as $res) {
                        $result2[] = $res;
                    }
                }

            }
            $clientTypesToCount = array(3, 4, 5, 6, 7, 8, 9);
            $userIDCounts = array_fill_keys($clientTypesToCount, array());

            foreach ($result2 as $item) {
                $clientType = $item['client_type'];
                $clientType_name = $item['userid'];
                $userID = $item['userid'];
                if (in_array($clientType, $clientTypesToCount) && $userID !== '') {
                    $userIDCounts[$clientType][] = $userID;
                }
            }

            $i = 0;
            foreach ($userIDCounts as $clientType => $userIDs) {
                $data[$i] = [
                    'client_type' => $this->clients_model->client_type($clientType),
                    'client_group' => count($userIDs),
                    'count' => $this->clients_model->policiesCount($userIDs),
                    'total_primium_added' => $this->clients_model->getcollection_total_premium($userIDs),
                ];
                $i++;
            }
            // exit;
            return $data;
        }
        if ($cleck_is_admin == 1) {

            $this->db->select('userid,client_type');
            $this->db->from('tblclients');
            $this->db->where('tblclients.active', 1);
            // $this->db->where_in('tblclients.userid',$customerIds2);//added new condtion
            $query = $this->db->get();
            $result = $query->result_array();
            $clientTypesToCount = array(3, 4, 5, 6, 7, 8, 9);
            $userIDCounts = array_fill_keys($clientTypesToCount, array());

            foreach ($result as $item) {
                $clientType = $item['client_type'];
                $clientType_name = $item['userid'];
                $userID = $item['userid'];
                if (in_array($clientType, $clientTypesToCount) && $userID !== '') {
                    $userIDCounts[$clientType][] = $userID;
                }
            }
            $i = 0;
            foreach ($userIDCounts as $clientType => $userIDs) {

                $data[$i] = [
                    'client_type' => $this->clients_model->client_type($clientType),
                    'client_group' => count($userIDs),
                    'count' => $this->clients_model->policiesCount($userIDs),
                    'total_primium_added' => $this->clients_model->getcollection_total_premium($userIDs)
                ];
                $i++;
            }

            return $data;
        }
        // }
    }

    public function getcollection_total_premium($userIDs)
    {
        $i = 0;
        foreach ($userIDs as $user_ids) {
            $this->db->select('total_premium');
            $this->db->from('tblpolicy');
            // $this->db->where('policy_status_id',2);
            $this->db->where('policy_status', 'In-force');
            $this->db->where_in('customer', $user_ids);
            $this->db->where('is_deleted', 0);
            $query = $this->db->get();
            $result[$i] = $query->result_array();
            $i++;
        }
        $lapsed_api_total = 0;
        foreach ($result as $innerArrays) {
            foreach ($innerArrays as $innerArray) {
                $apibeing = $innerArray['total_premium'];
                $dollerData = mb_substr(trim($apibeing), 0, 1);
                if ($dollerData == '$') {
                    $numericdata = substr(trim($apibeing), 1);
                    $sum_numeric_data = trim(str_replace(",", "", $numericdata));
                } else {
                    $sum_numeric_data = $apibeing;
                }
                $lapsed_api_total += $sum_numeric_data;
            }
        }
        $total_primium_Api_total = '$' . number_format($lapsed_api_total, 2) . '';
        return $total_primium_Api_total;
    }

    public function client_type($clientType_id)
    {
        $this->db->select('client_type');
        $this->db->from('tblcustomer_type');
        $this->db->where_in('id', $clientType_id);
        $query = $this->db->get();
        $result = $query->row();
        return $result->client_type;
    }

    public function policiesCount($userIds)
    {
        if (empty($userIds) || !is_array($userIds)) {
            return 0;
        }

        $result = [];
        $i = 0;
        foreach ($userIds as $user_ids) {
            if (empty($user_ids)) {
                continue;
            }
            $this->db->select('*');
            $this->db->from('tblpolicy');
            // $this->db->where('policy_status_id',2);
            $this->db->where('policy_status', 'In-force');
            $this->db->where_in('customer', $user_ids);
            $this->db->where('is_deleted', 0);
            $query = $this->db->get();
            $result[$i] = $query->result_array();
            $i++;
        }

        $totalPolicies = array_reduce($result, function ($policies, $item) {
            return $policies + count((array) $item);
        }, 0);
        return $totalPolicies;
    }



    // public function update_data_id($status_type,$id)
// {
//     $this->db->where('policy_status' , $status_type);
//     $this->db->set('policy_status_id', $id);
//     $this->db->update('tblpolicy');
//     return $result;
// }

    // public function get_data()
// {
//     $this->db->select('*');
//     $this->db->from('tblpolicystatus');
//     $query  = $this->db->get();
//     $result = $query->result_array();
//     return $result;
// }

    public function update_data_id($providername, $id)
    {
        $this->db->where('provider', $providername);
        $this->db->set('provider_id', $id);
        $this->db->update('tblpolicy');
        return $result;
    }

    public function get_data()
    {
        $this->db->select('*');
        $this->db->from('tblproviders_details');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    // March 1
    public function fetch_firstname()
    {

        if (is_admin()) {
            $this->db->select('firstname');
            $this->db->from('tblcontacts');
            $query = $this->db->get();
            $result = $query->result_array();
            return $result;
        } else {

            $staffId = $this->session->userdata('staff_user_id');
            $this->db->select('*');
            $this->db->from('tblstaff_permissions');
            $this->db->where('staff_id', $staffId);
            $this->db->where('feature', 'customers');
            $this->db->where('capability', 'view');
            $query = $this->db->get();
            $role = $query->row();
            // $roleArray = $query->result_array();
            if ($role == 1) {
                $this->db->select('firstname');
                $this->db->from('tblcontacts');
                $query = $this->db->get();
                $result = $query->result_array();
                return $result;
            } else {
                $staffId = $this->session->userdata('staff_user_id');
                $this->db->select('tblcontacts.firstname');
                $this->db->from('tblcontacts');
                $this->db->join('tblcustomer_admins', 'tblcontacts.userid = tblcustomer_admins.customer_id');
                $this->db->where('tblcustomer_admins.staff_id', $staffId);
                $query = $this->db->get();
                $result = $query->result_array();
                return $result;
            }
        }

    }
    public function fetch_lastname()
    {
        if (is_admin()) {
            $this->db->select('lastname');
            $this->db->from('tblcontacts');
            $query = $this->db->get();
            $query = $query->result_array();
            return $query;
        } else {
            $staffId = $this->session->userdata('staff_user_id');
            $this->db->select('*');
            $this->db->from('tblstaff_permissions');
            $this->db->where('staff_id', $staffId);
            $this->db->where('feature', 'customers');
            $this->db->where('capability', 'view');
            $query = $this->db->get();
            $role = $query->row();
            // echo"<pre>";
            // print_r($role);
            // exit;
            if ($role == 1) {
                $this->db->select('lastname');
                $this->db->from('tblcontacts');
                $query = $this->db->get();
                $result = $query->result_array();
                return $result;
            } else {
                $staffId = $this->session->userdata('staff_user_id');
                $this->db->select('tblcontacts.lastname');
                $this->db->from('tblcontacts');
                $this->db->join('tblcustomer_admins', 'tblcontacts.userid = tblcustomer_admins.customer_id');
                $this->db->where('tblcustomer_admins.staff_id', $staffId);
                $query = $this->db->get();
                $result = $query->result_array();
                return $result;
            }

        }

    }

    public function getContact($userid)
    {
        $this->db->from('tblcontacts');
        $this->db->where('userid', $userid);
        $count = $this->db->count_all_results();
        $this->db->from('tblcontacts');
        $this->db->where('userid', $userid);
        $result = $this->db->get()->result_array();
        $count_results[] = [
            'userid' => $userid,
            'contact_count' => $count
        ];
        foreach ($count_results as $contact) {
            if ($contact['contact_count'] == 1) {
                $this->db->set('contact_key', 1);
                $this->db->where('userid', $contact['userid']);
                $this->db->update('tblcontacts');
            } else {
                $this->db->select_max('age');
                $this->db->from('tblcontacts');
                $this->db->where('userid', $contact['userid']);
                $this->db->where('contact_key', 1);
                $max_age_query = $this->db->get()->row_array();
                if ($max_age_query) {
                    $max_age = $max_age_query['age'];
                    $this->db->from('tblcontacts');
                    $this->db->where('userid', $contact['userid']);
                    $this->db->where('age', $max_age);
                    $this->db->where('contact_key', 1);
                    $result = $this->db->get()->result_array();
                }
            }
        }
        return $result;
    }


    public function updateContact()
    {
        $this->db->select('userid');
        $this->db->from('tblclients');
        $cquery = $this->db->get();
        $cresult = $cquery->result_array();
        foreach ($cresult as $res) {
            // Get the count of contacts for each user
            $this->db->from('tblcontacts');
            $this->db->where('userid', $res['userid']);
            $count = $this->db->count_all_results();
            if ($count == 1) {
                // If only one contact exists, set contact_key = 1 for that specific contact
                $this->db->set('contact_key', 1);
                $this->db->where('userid', $res['userid']);
                $this->db->where('(contact_key IS NULL OR contact_key = 0)');
                $this->db->limit(1);  // Important: Add limit to ensure only one record is updated
                $this->db->update('tblcontacts');
            } else {
                // Check if any contact has contact_key = 1
                $this->db->select('id');
                $this->db->from('tblcontacts');
                $this->db->where('userid', $res['userid']);
                $this->db->where('contact_key', 1);
                $existing_key_contact = $this->db->get()->result_array();
                if (empty($existing_key_contact)) {
                    // Find the oldest contact and set its contact_key = 1
                    $this->db->select('id');
                    $this->db->from('tblcontacts');
                    $this->db->where('userid', $res['userid']);
                    $this->db->where('(contact_key IS NULL OR contact_key = 0)');
                    $this->db->order_by('age', 'DESC');
                    $this->db->limit(1);
                    $oldest_contact = $this->db->get()->row_array();
                    if ($oldest_contact) {
                        // First, reset all contact_keys to 0
                        $this->db->set('contact_key', 0);
                        $this->db->where('userid', $res['userid']);
                        $this->db->update('tblcontacts');
                        // Then set contact_key = 1 for the oldest contact
                        $this->db->set('contact_key', 1);
                        $this->db->where('id', $oldest_contact['id']);
                        $this->db->where('userid', $res['userid']);
                        $this->db->update('tblcontacts');
                    }
                } else if (count($existing_key_contact) > 1) {
                    // Get the oldest contact among those with contact_key = 1
                    $this->db->select('id');
                    $this->db->from('tblcontacts');
                    $this->db->where('userid', $res['userid']);
                    $this->db->where('contact_key', 1);
                    $this->db->order_by('age', 'DESC');
                    $this->db->limit(1);
                    $oldest_contact_with_key_1 = $this->db->get()->row_array();
                    if ($oldest_contact_with_key_1) {
                        // First, reset all contact_keys to 0
                        $this->db->set('contact_key', 0);
                        $this->db->where('userid', $res['userid']);
                        $this->db->update('tblcontacts');
                        // Then set contact_key = 1 only for the oldest contact
                        $this->db->set('contact_key', 1);
                        $this->db->where('id', $oldest_contact_with_key_1['id']);
                        $this->db->where('userid', $res['userid']);
                        $this->db->update('tblcontacts');
                    }
                }
            }
        }
        return true;
    }
    // public function updateContact() {
//     $this->db->select('userid');
//     $this->db->from('tblclients');
//     $cquery = $this->db->get();
//     $cresult = $cquery->result_array();
//     $count_results = [];
//     foreach($cresult as $res) {
//         $this->db->from('tblcontacts');
//         $this->db->where('userid', $res['userid']);
//         $this->db->where('contact_key', null);
//         $this->db->or_where('contact_key', 0);
//         $count = $this->db->count_all_results();
//         $count_results[] = [
//             'userid' => $res['userid'],
//             'contact_count' => $count
//         ];
//     }
//     foreach($count_results as $contact){
//         if($contact['contact_count'] == 1){
//             $this->db->set('contact_key', 1);
//             $this->db->where('userid', $contact['userid']);
//             $this->db->update('tblcontacts');
//         }
//     }
//     return true;
// }
    function updateResidentilaAddressClientReview($customer_id, $data)
    {
        $this->db->select('short_name');
        $this->db->from('tblcountries');
        $this->db->where('country_id', $data['residential_country']);
        $query1 = $this->db->get();
        $result1 = $query1->result_array();
        $individual_residential_address = '';
        if (!empty($data['contact_key'])) {
            $address_parts = array_filter([
                $data['residential_address'] ?? '',
                $data['residential_state'] ?? '',
                $data['residential_city'] ?? '',
                $data['residential_zipcode'] ?? '',
                $result1[0]['short_name'] ?? ''
            ]);
            $individual_residential_address = implode(', ', $address_parts);
        }
        if (empty($data['dependent']) && empty($data['business'])) {
            $this->db->where('userid', $customer_id);
            $this->db->set('individual_residential_address', $individual_residential_address);
            $success = $this->db->update('tblclients');
        } else {
            $this->db->where('userid', $customer_id);
            $this->db->set('individual_residential_address', '');
            $success = $this->db->update('tblclients');
        }
        return true;
    }
    function updateResidentilaAddress()
    {
        $this->db->select('*');
        $this->db->from('tblcontacts');
        $this->db->where('contact_key', 1);
        $query1 = $this->db->get();
        $result1 = $query1->result_array();
        foreach ($result1 as $res) {
            $this->db->select('short_name');
            $this->db->from('tblcountries');
            $this->db->where('country_id', $res['residential_country']);
            $query2 = $this->db->get();
            $result2 = $query2->result_array();
            $address_parts = array_filter([
                $res['residential_address'] ?? '',
                $res['residential_state'] ?? '',
                $res['residential_city'] ?? '',
                $res['residential_zipcode'] ?? '',
                $result2[0]['short_name'] ?? ''
            ]);
            $individual_residential_address = implode(', ', $address_parts);

            $this->db->where('userid', $res['userid']);
            $this->db->set('individual_residential_address', $individual_residential_address);
            $success = $this->db->update('tblclients');
        }


        return true;
    }
    public function get_unique_email()
    {
        // Step 1: Get all valid mtg emails that match the format mtg[100000+]@mtgonline.com
        $this->db->select('email');
        $this->db->from('tblcontacts');
        $this->db->where("email REGEXP", "^mtg[0-9]{6,}@mtgonline\\.com$");
        $query = $this->db->get();

        $maxNumber = 99999; // So it starts from 100000

        foreach ($query->result() as $row) {
            if (preg_match('/^mtg(\d+)@mtgonline\.com$/', $row->email, $matches)) {
                $num = (int) $matches[1];
                if ($num > $maxNumber) {
                    $maxNumber = $num;
                }
            }
        }

        // Step 2: Generate next number
        $nextNumber = $maxNumber + 1;
        $email = 'mtg' . $nextNumber . '@mtgonline.com';
        return $email;
    }


}
