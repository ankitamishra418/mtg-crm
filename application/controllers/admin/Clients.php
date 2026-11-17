<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Clients extends AdminController
{
    /* List all clients */
    public function index()
    {
        $this->load->library('session');
        $staffid = $this->session->get_userdata();
        $data['staff_id'] = $staffid['staff_user_id'];

        if (!has_permission('customers', '', 'view')) {
            if (!have_assigned_customers() && !has_permission('customers', '', 'create')) {
                access_denied('customers');
            }
        }

        $this->load->model('contracts_model');
        $data['contract_types'] = $this->contracts_model->get_contract_types();
        $data['groups'] = $this->clients_model->get_groups();
        $data['title'] = _l('clients');

        $this->load->model('proposals_model');
        $data['proposal_statuses'] = $this->proposals_model->get_statuses();

        $this->load->model('invoices_model');
        $data['invoice_statuses'] = $this->invoices_model->get_statuses();

        $this->load->model('estimates_model');
        $data['estimate_statuses'] = $this->estimates_model->get_statuses();

        $this->load->model('projects_model');
        $data['project_statuses'] = $this->projects_model->get_project_statuses();

        $data['customer_admins'] = $this->clients_model->get_customers_admin_unique_ids();

        $whereContactsLoggedIn = '';
        if (!has_permission('customers', '', 'view')) {
            $whereContactsLoggedIn = ' AND userid IN (SELECT customer_id FROM ' . db_prefix() . 'customer_admins WHERE staff_id=' . get_staff_user_id() . ')';
        }

        $data['contacts_logged_in_today'] = $this->clients_model->get_contacts('', 'last_login LIKE "' . date('Y-m-d') . '%"' . $whereContactsLoggedIn);
        $data['active_contacts'] = $this->clients_model->get_active_contacts();
        $data['countries'] = $this->clients_model->get_clients_distinct_countries();
        $this->load->view('admin/clients/manage', $data);
    }

    public function table()
    {
        if (!has_permission('customers', '', 'view')) {
            if (!have_assigned_customers() && !has_permission('customers', '', 'create')) {
                ajax_access_denied();
            }
        }

        $this->app->get_table_data('clients');
    }

    public function all_contacts()
    {
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('all_contacts');
        }

        if (is_gdpr() && get_option('gdpr_enable_consent_for_contacts') == '1') {
            $this->load->model('gdpr_model');

            $data['consent_purposes'] = $this->gdpr_model->get_consent_purposes();
        }

        //added march 1  -----------------------------------------
        $sortFirstName = $this->clients_model->fetch_firstname();
        $sortKeyFirstName = [];
        foreach ($sortFirstName as $sortFname) {
            $sortKeyFirstName[] = $sortFname['firstname'];
        }
        $sortlastName = $this->clients_model->fetch_lastname();
        $sortKeylastName = [];
        foreach ($sortlastName as $sortLname) {
            $sortKeylastName[] = $sortLname['lastname'];
        }
        $data['firstname'] = array_unique($sortKeyFirstName);
        $data['lastname'] = array_unique($sortKeylastName);
        // filter
        if ($this->input->post('firstnameindividual') != '' || $this->input->post('lastnameindividual') != '') {
            $data['firstname'] = array_unique($sortKeyFirstName);
            $data['lastname'] = array_unique($sortKeylastName);
            $filter = [
                'firstNameIndividual' => $this->input->post('firstnameindividual'),
                'lastNameIndividual' => $this->input->post('lastnameindividual')
            ];
            $this->session->set_userdata($filter);
        }
        //end-------------------------------------------------------------------
        $data['title'] = _l('customer_contacts');
        $this->load->view('admin/clients/all_contacts', $data);
    }

    public function choose_contacts($client_id)
    {
        $currentCompany = $this->uri->segment(4);
        $this->load->model('choose_contacts_model');
        $data['data'] = $this->choose_contacts_model->get_consents($currentCompany);
        $data['company_id'] = $currentCompany;
        $this->load->view('admin/clients/choose_contacts_list', $data);
    }

    public function choose_contacts_insert()
    {
        $for_company = $this->input->post('for_company');
        $selected_contacts = $this->input->post('selected_contacts');
        $total_contacts = $this->input->post('total_contacts');
        $selected_contacts_array = explode(",", $selected_contacts);
        foreach ($selected_contacts_array as $selected_contacts_ar) {
            $data = array(
                'company_id' => $for_company,
                'contact_id' => $selected_contacts_ar
            );
            $this->load->model('Choose_contacts_model');
            $this->Choose_contacts_model->insertcontact($data);
            $old_contact = $this->Choose_contacts_model->get_selectdata($selected_contacts_ar);
            $dataContact = array(
                'userid' => $for_company,
                'is_primary' => $old_contact[0]['is_primary'],
                'datecreated' => $old_contact[0]['datecreated'],
                'firstname' => $old_contact[0]['firstname'],
                'lastname' => $old_contact[0]['lastname'],
                'email' => $old_contact[0]['email'],
                'phonenumber' => $old_contact[0]['phonenumber'],
                'title' => $old_contact[0]['title'],
                'password' => $old_contact[0]['password'],
                'new_pass_key' => $old_contact[0]['new_pass_key'],
                'new_pass_key_requested' => $old_contact[0]['new_pass_key_requested'],
                'email_verified_at' => $old_contact[0]['email_verified_at'],
                'email_verification_key' => $old_contact[0]['email_verification_key'],
                'email_verification_sent_at' => $old_contact[0]['email_verification_sent_at'],
                'last_ip	' => $old_contact[0]['last_ip	'],
                'last_login' => $old_contact[0]['last_login'],
                'last_password_change' => $old_contact[0]['last_password_change'],
                'active' => $old_contact[0]['active'],
                'profile_image' => $old_contact[0]['profile_image'],
                'direction' => $old_contact[0]['direction'],
                'invoice_emails' => $old_contact[0]['invoice_emails'],
                'estimate_emails' => $old_contact[0]['estimate_emails'],
                'credit_note_emails' => $old_contact[0]['credit_note_emails'],
                'contract_emails' => $old_contact[0]['contract_emails'],
                'task_emails' => $old_contact[0]['task_emails'],
                'project_emails' => $old_contact[0]['project_emails'],
                'ticket_emails' => $old_contact[0]['ticket_emails'],
                'otp' => $old_contact[0]['otp'],
                'homephone' => $old_contact[0]['homephone'],
                'gender' => $old_contact[0]['gender'],
                'vulnerable_client' => $old_contact[0]['vulnerable_client'],
                'client_type' => $old_contact[0]['client_type'],
                'custom_occupation' => $old_contact[0]['custom_occupation'],
                'smoker' => $old_contact[0]['smoker'],
                'residential_address' => $old_contact[0]['residential_address'],
                'residential_city' => $old_contact[0]['residential_city'],
                'residential_state' => $old_contact[0]['residential_state'],
                'residential_zipcode' => $old_contact[0]['residential_zipcode'],
                'residential_country' => $old_contact[0]['residential_country'],
                'postal_address' => $old_contact[0]['postal_address'],
                'postal_city' => $old_contact[0]['postal_city'],
                'postal_state' => $old_contact[0]['postal_state'],
                'postal_zipcode' => $old_contact[0]['postal_zipcode'],
                'postal_country' => $old_contact[0]['postal_country'],
                'additional_note' => $old_contact[0]['additional_note'],
                'dob' => $old_contact[0]['dob'],
                'age' => $old_contact[0]['age'],
                'occupation_name' => $old_contact[0]['occupation_name'],
                'imported_date' => $old_contact[0]['imported_date'],
                'vulnerable_note' => $old_contact[0]['vulnerable_note'],
                'occupation' => $old_contact[0]['occupation']
            );
            $lastId = $this->Choose_contacts_model->get_selectdata_insert($dataContact);
            $permissions = [1, 2, 3, 4, 5, 6];
            foreach ($permissions as $permission) {
                $data2 = array(
                    'permission_id' => $permission,
                    'userid' => $lastId
                );
                $this->Choose_contacts_model->permissions_insert($data2);
            }

        }
        if ($lastId) {
            set_alert('success', 'Contact Added Successfully');
            redirect(admin_url('clients/client/' . $for_company . '?group=contacts'));
        } else {
            redirect(admin_url('clients/choose_contacts/' . $for_company));
        }

        // redirect(admin_url('clients/choose_contacts/' . $for_company));
    }

    /* Edit client or add new client*/
    public function client($id = '')
    {


        if (!has_permission('customers', '', 'view')) {
            if ($id != '' && !is_customer_admin($id)) {
                access_denied('customers');
            }
        }
        if ($this->input->post() && !$this->input->is_ajax_request()) {

            if ($id == '') {
                if (!has_permission('customers', '', 'create')) {
                    access_denied('customers');
                }

                $data = $this->input->post();


                // if($data['client_review_month']){
                //     $client_review_month = $data['client_review_month'];
                //     $review_month = $this->clients_model->review_month($client_review_month);
                //     $data['review_month_name'] = $review_month[0]['month_name'];
                // }


                if (empty($data['client_review_month'])) {
                    $data['client_review_month'] = (int) date('m');
                }

                $client_review_month = $data['client_review_month'];
                $review_month = $this->clients_model->review_month($client_review_month);

                if (!empty($review_month)) {
                    $data['review_month_name'] = $review_month[0]['month_name'];
                }

                if (isset($data['client_review_date'])) {
                    $exploadedDate = (explode('/', $data['client_review_date']));
                    $newDate = $exploadedDate[2] . '-' . $exploadedDate[1] . '-' . $exploadedDate[0];
                    $data['client_review_date'] = $newDate;

                }
                $adviser_data = $data['customer_advisor'];
                $data['adviser_data'] = $adviser_data;

                $save_and_add_contact = false;
                if (isset($data['save_and_add_contact'])) {
                    unset($data['save_and_add_contact']);
                    $save_and_add_contact = true;
                }
                $assigndataCondistion = false;
                if (isset($data['customer_advisor'])) {
                    $assigndata['customerAdvisor'] = $data['customer_advisor'];
                    // $assigndata['customer_admins'] = $updatedata['customer_admins'];
                    unset($data['customer_advisor']);
                    $assigndataCondistion = true;
                }
                $id = $this->clients_model->add($data);
                if ($assigndataCondistion) {
                    $this->clients_model->assign_adviser($assigndata, $id);
                    //$this->clients_model->assign_admins($assigndata, $id);
                }

                if (!has_permission('customers', '', 'view')) {
                    $assign['customer_admins'] = [];
                    $assign['customer_admins'][] = get_staff_user_id();
                    $this->clients_model->assign_admins($assign, $id);
                }

                if ($id) {
                    set_alert('success', _l('added_successfully', _l('client')));
                    if ($save_and_add_contact == false) {
                        redirect(admin_url('clients/client/' . $id));
                    } else {
                        redirect(admin_url('clients/client/' . $id . '?group=contacts&new_contact=true'));
                    }
                }
            } else {
                if (!has_permission('customers', '', 'edit')) {
                    if (!is_customer_admin($id)) {
                        access_denied('customers');
                    }
                }

                $updatedata = $this->input->post();
                // if($updatedata['client_review_month']){
                //     $client_review_month = $updatedata['client_review_month'];
                //     $review_month = $this->clients_model->review_month($client_review_month);
                //     $updatedata['review_month_name'] = $review_month[0]['month_name'];
                // }


                if (empty($updatedata['client_review_month'])) {
                    $updatedata['client_review_month'] = (int) date('m');
                }

                $client_review_month = $updatedata['client_review_month'];
                $review_month = $this->clients_model->review_month($client_review_month);

                if (!empty($review_month)) {
                    $updatedata['review_month_name'] = $review_month[0]['month_name'];
                }

                if (isset($updatedata['client_review_date'])) {
                    $exploadedDate = (explode('/', $updatedata['client_review_date']));
                    $newDate = $exploadedDate[2] . '-' . $exploadedDate[1] . '-' . $exploadedDate[0];
                    $updatedata['client_review_date'] = $newDate;
                }
                $adviser_data = $updatedata['customer_advisor'];
                $updatedata['adviser_data'] = $adviser_data;
                $assigndataCondistion = false;
                if (isset($updatedata['customer_advisor'])) {
                    $assigndata['customerAdvisor'] = $updatedata['customer_advisor'];
                    // $assigndata['customer_admins'] = $updatedata['customer_admins'];
                    unset($updatedata['customer_advisor']);
                    $assigndataCondistion = true;
                }
                if ($assigndataCondistion) {
                    $this->clients_model->assign_adviser($assigndata, $id);
                    // $this->clients_model->assign_admins($assigndata, $id);
                }

                $success = $this->clients_model->update($updatedata, $id);
                if ($success || $assigndataCondistion == true) {
                    set_alert('success', _l('updated_successfully', _l('client')));
                }
                redirect(admin_url('clients/client/' . $id));
            }
        }
        $group = !$this->input->get('group') ? 'profile' : $this->input->get('group');
        $data['group'] = $group;

        if ($group != 'contacts' && $contact_id = $this->input->get('contactid')) {
            redirect(admin_url('clients/client/' . $id . '?group=contacts&contactid=' . $contact_id));
        }
        // Customer groups
        $data['groups'] = $this->clients_model->get_groups();

        if ($id == '') {
            $title = _l('add_new', _l('client_lowercase'));
            $data['staff'] = $this->staff_model->get('', ['active' => 1]);
        } else {
            $client = $this->clients_model->get($id);
            $data['customer_tabs'] = get_customer_profile_tabs($id);
            if (!$client) {
                show_404();
            }
            $data['contacts'] = $this->clients_model->get_contacts($id);
            $data['tab'] = isset($data['customer_tabs'][$group]) ? $data['customer_tabs'][$group] : null;

            if (!$data['tab']) {
                show_404();
            }
            // Fetch data based on groups
            if ($group == 'profile') {
                $data['customer_groups'] = $this->clients_model->get_customer_groups($id);
                $data['customer_admins'] = $this->clients_model->get_admins($id);
                $data['customer_advisor'] = $this->clients_model->get_adviser($id);
            } elseif ($group == 'attachments') {
                $data['attachments'] = get_all_customer_attachments($id);

                $data['staff'] = $this->projects_model->staffName();
                //print_r($data['staff']);
                // exit;
                $data['category'] = $this->projects_model->fetchCategory();
                $data['complience'] = $this->projects_model->fetchComplience();
                $data['archive_file'] = $this->clients_model->archive_file($id);


            } elseif ($group == 'vault') {
                $data['vault_entries'] = hooks()->apply_filters('check_vault_entries_visibility', $this->clients_model->get_vault_entries($id));

                if ($data['vault_entries'] === -1) {
                    $data['vault_entries'] = [];
                }
            } elseif ($group == 'estimates') {
                $this->load->model('estimates_model');
                $data['estimate_statuses'] = $this->estimates_model->get_statuses();
            } elseif ($group == 'invoices') {
                $this->load->model('invoices_model');
                $data['invoice_statuses'] = $this->invoices_model->get_statuses();
            } elseif ($group == 'credit_notes') {
                $this->load->model('credit_notes_model');
                $data['credit_notes_statuses'] = $this->credit_notes_model->get_statuses();
                $data['credits_available'] = $this->credit_notes_model->total_remaining_credits_by_customer($id);
            } elseif ($group == 'payments') {
                $this->load->model('payment_modes_model');
                $data['payment_modes'] = $this->payment_modes_model->get();
            } elseif ($group == 'notes') {
                $data['user_notes'] = $this->misc_model->get_notes($id, 'customer');
            } elseif ($group == 'projects') {
                $this->load->model('projects_model');
                $data['project_statuses'] = $this->projects_model->get_project_statuses();
            } elseif ($group == 'statement') {
                if (!has_permission('invoices', '', 'view') && !has_permission('payments', '', 'view')) {
                    set_alert('danger', _l('access_denied'));
                    redirect(admin_url('clients/client/' . $id));
                }
                $data = array_merge($data, prepare_mail_preview_data('customer_statement', $id));
            } elseif ($group == 'map') {
                if (get_option('google_api_key') != '' && !empty($client->latitude) && !empty($client->longitude)) {
                    $this->app_scripts->add('map-js', base_url($this->app_scripts->core_file('assets/js', 'map.js')) . '?v=' . $this->app_css->core_version());

                    $this->app_scripts->add('google-maps-api-js', [
                        'path' => 'https://maps.googleapis.com/maps/api/js?key=' . get_option('google_api_key') . '&callback=initMap',
                        'attributes' => [
                            'async',
                            'defer',
                            'latitude' => "$client->latitude",
                            'longitude' => "$client->longitude",
                            'mapMarkerTitle' => "$client->company",
                        ],
                    ]);
                }
            }

            $data['staff'] = $this->staff_model->get('', ['active' => 1]);

            $data['client'] = $client;
            $keycontact = $this->clients_model->getKeyContact($client->userid);
            $data['client']->keycontact = $keycontact[0];
            $title = $client->company;

            // Get all active staff members (used to add reminder)
            $data['members'] = $data['staff'];
            if (!empty($data['client']->company)) {
                // Check if is realy empty client company so we can set this field to empty
                // The query where fetch the client auto populate firstname and lastname if company is empty
                if (is_empty_customer_company($data['client']->userid)) {
                    $data['client']->company = '';
                }
            }
        }
        $this->load->model('currencies_model');
        $data['currencies'] = $this->currencies_model->get();

        if ($id != '') {
            $customer_currency = $data['client']->default_currency;

            foreach ($data['currencies'] as $currency) {
                if ($customer_currency != 0) {
                    if ($currency['id'] == $customer_currency) {
                        $customer_currency = $currency;

                        break;
                    }
                } else {
                    if ($currency['isdefault'] == 1) {
                        $customer_currency = $currency;

                        break;
                    }
                }
            }
            if (is_array($customer_currency)) {
                $customer_currency = (object) $customer_currency;
            }

            $data['customer_currency'] = $customer_currency;

            $slug_zip_folder = (
                $client->company != ''
                ? $client->company
                : get_contact_full_name(get_primary_contact_user_id($client->userid))
            );

            $data['zip_in_folder'] = slug_it($slug_zip_folder);
        }
        $data['review_month'] = $this->clients_model->review_month();
        $data['clientTypedata'] = $this->clients_model->fetchtype();
        $data['client_icon'] = $this->clients_model->fetchclient_type($client->client_type);
        $data['projecttemplates'] = $this->projects_model->fetchprojecttemplate();
        $data['bodyclass'] = 'customer-profile dynamic-create-groups';
        $data['title'] = $title;
        $choose = $this->input->get('choose');
        if (isset($choose)) {
            $data['choose'] = $choose;
        }
        $this->load->view('admin/clients/client', $data);
    }

    public function checkKeyContact()
    {
        $userId = $this->input->post('userid');
        $data = $this->clients_model->check_key_contact($userId);
        echo $data;
        exit;
    }
    public function KeyContactAddress()
    {
        $userId = $this->input->post('userid');
        $data = $this->clients_model->key_contact_address($userId);
        echo json_encode($data);
        exit;
    }

    public function export($contact_id)
    {
        if (is_admin()) {
            $this->load->library('gdpr/gdpr_contact');
            $this->gdpr_contact->export($contact_id);
        }
    }

    // Used to give a tip to the user if the company exists when new company is created
    public function check_duplicate_customer_name()
    {
        if (has_permission('customers', '', 'create')) {
            $companyName = trim($this->input->post('company'));
            $response = [
                'exists' => (bool) total_rows(db_prefix() . 'clients', ['company' => $companyName]) > 0,
                'message' => _l('company_exists_info', '<b>' . $companyName . '</b>'),
            ];
            echo json_encode($response);
        }
    }

    public function save_longitude_and_latitude($client_id)
    {
        if (!has_permission('customers', '', 'edit')) {
            if (!is_customer_admin($client_id)) {
                ajax_access_denied();
            }
        }

        $this->db->where('userid', $client_id);
        $this->db->update(db_prefix() . 'clients', [
            'longitude' => $this->input->post('longitude'),
            'latitude' => $this->input->post('latitude'),
        ]);
        if ($this->db->affected_rows() > 0) {
            echo 'success';
        } else {
            echo 'false';
        }
    }

    public function form_contact($customer_id, $contact_id = '')
    {

        if (!has_permission('customers', '', 'view')) {
            if (!is_customer_admin($customer_id)) {
                echo _l('access_denied');
                die;
            }
        }
        $data['customer_id'] = $customer_id;
        $data['contactid'] = $contact_id;

        if (is_automatic_calling_codes_enabled()) {
            $clientCountryId = $this->db->select('country')
                ->where('userid', $customer_id)
                ->get('clients')->row()->country ?? null;

            $clientCountry = get_country($clientCountryId);
            $callingCode = $clientCountry ? '+' . ltrim($clientCountry->calling_code, '+') : null;
        } else {
            $callingCode = null;
        }

        if ($this->input->post()) {
            $data = $this->input->post();
            if (!isset($data['contact_key'])) {
                array_push($data['contact_key'], '');
            }
            if (!isset($data['dependent'])) {
                array_push($data['dependent'], '');
            }
            if (!isset($data['deceased'])) {
                array_push($data['deceased'], '');
            }
            if (!isset($data['business'])) {
                array_push($data['business'], '');
            }
            if (!isset($data['contactkey_address'])) {
                array_push($data['contactkey_address'], '');
            }
            $this->clients_model->updateResidentilaAddressClientReview($customer_id, $data);

            if ($data['email'] == '') {
                // $content = "mtg";
                // $rand = (mt_rand(1000,10000));
                // $mtgonline = '@mtgonline.com';
                // $data['email'] = $content.$rand.$mtgonline;
                $data['email'] = $this->clients_model->get_unique_email();
            }
            if ($data['occupation']) {
                $a = $data['occupation'];
                $stringarr = explode(',', $a);
                $data['occupation'] = $stringarr[0];
                $data['occupation_name'] = $stringarr[1];
            }

            if (isset($data['dob'])) {

                // $exploadedDate = (explode('/',$data['dob'])); 
                // $newDate = $exploadedDate[2] .'-'. $exploadedDate[1] .'-'. $exploadedDate[0];
                $newDate = $data['dob'];


                // $from = $newDate;
                // $to   = new DateTime('today');
                # procedural
                $data['age'] = date_diff(date_create($newDate), date_create('today'))->y;
            }

            // if(isset($data['dob'])){
            //     $from = new DateTime('1970-02-01');
            //     $to   = new DateTime('today');
            //     echo $from->diff($to)->y;

            //     # procedural
            //     echo date_diff(date_create('1970-02-01'), date_create('today'))->y;
            //         exit;
            // }

            $data['vulnerable_client'] = serialize($this->input->post('vulnerable_client'));
            $data['password'] = $this->input->post('password', false);

            if ($callingCode && !empty($data['phonenumber']) && $data['phonenumber'] == $callingCode) {
                $data['phonenumber'] = '';
            }

            unset($data['contactid']);

            if ($contact_id == '') {
                if (!has_permission('customers', '', 'create')) {
                    if (!is_customer_admin($customer_id)) {
                        header($_SERVER['SERVER_PROTOCOL'] . '400 Bad error');
                        echo json_encode([
                            'success' => false,
                            'message' => _l('access_denied'),
                        ]);
                        die;
                    }
                }
                $id = $this->clients_model->add_contact($data, $customer_id);
                $message = '';
                $success = false;
                if ($id) {
                    handle_contact_profile_image_upload($id);
                    $success = true;
                    $message = _l('added_successfully', _l('contact'));
                }
                echo json_encode([
                    'success' => $success,
                    'message' => $message,
                    'has_primary_contact' => (total_rows(db_prefix() . 'contacts', ['userid' => $customer_id, 'is_primary' => 1]) > 0 ? true : false),
                    'is_individual' => is_empty_customer_company($customer_id) && total_rows(db_prefix() . 'contacts', ['userid' => $customer_id]) == 1,
                ]);
                die;
            }
            if (!has_permission('customers', '', 'edit')) {
                if (!is_customer_admin($customer_id)) {
                    header($_SERVER['SERVER_PROTOCOL'] . '400 Bad error');
                    echo json_encode([
                        'success' => false,
                        'message' => _l('access_denied'),
                    ]);
                    die;
                }
            }
            $original_contact = $this->clients_model->get_contact($contact_id);
            $success = $this->clients_model->update_contact_email($data, $contact_id);
            $message = '';
            $proposal_warning = false;
            $original_email = '';
            $updated = false;
            //email
            $email = $original_contact->email;
            if (is_array($success)) {
                if (isset($success['set_password_email_sent'])) {
                    $message = _l('set_password_email_sent_to_client');
                } elseif (isset($success['set_password_email_sent_and_profile_updated'])) {
                    $updated = true;
                    $message = _l('set_password_email_sent_to_client_and_profile_updated');
                }
            } else {
                if ($success == true) {
                    $updated = true;
                    $message = _l('updated_successfully', _l('contact'));
                }
            }
            if (handle_contact_profile_image_upload($contact_id, $email) && !$updated) {
                $message = _l('updated_successfully', _l('contact'));
                $success = true;
            }
            if ($updated == true) {
                $contact = $this->clients_model->get_contact($contact_id);
                if (
                    total_rows(db_prefix() . 'proposals', [
                        'rel_type' => 'customer',
                        'rel_id' => $contact->userid,
                        'email' => $original_contact->email,
                    ]) > 0 && ($original_contact->email != $contact->email)
                ) {
                    $proposal_warning = true;
                    $original_email = $original_contact->email;
                }
            }
            echo json_encode([
                'success' => $success,
                'proposal_warning' => $proposal_warning,
                'message' => $message,
                'original_email' => $original_email,
                'has_primary_contact' => (total_rows(db_prefix() . 'contacts', ['userid' => $customer_id, 'is_primary' => 1]) > 0 ? true : false),
            ]);
            die;
        }


        $data['calling_code'] = $callingCode;

        if ($contact_id == '') {
            $title = _l('add_new', _l('contact_lowercase'));
        } else {
            $data['contact'] = $this->clients_model->get_contact($contact_id);

            if (!$data['contact']) {
                header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad error');
                echo json_encode([
                    'success' => false,
                    'message' => 'Contact Not Found',
                ]);
                die;
            }
            $title = $data['contact']->firstname . ' ' . $data['contact']->lastname;
        }
        $data['data'] = $this->clients_model->fetchOccupationClass();
        $data['vulnerableClient'] = $this->clients_model->fetchvulnerableClient();
        $data['smokerdata'] = $this->clients_model->fetchSmoker();
        $data['customer_permissions'] = get_contact_permissions();
        $data['title'] = $title;
        $this->load->view('admin/clients/modals/contact', $data);
    }

    public function confirm_registration($client_id)
    {
        if (!is_admin()) {
            access_denied('Customer Confirm Registration, ID: ' . $client_id);
        }
        $this->clients_model->confirm_registration($client_id);
        set_alert('success', _l('customer_registration_successfully_confirmed'));
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function update_file_share_visibility()
    {
        if ($this->input->post()) {
            $file_id = $this->input->post('file_id');
            $share_contacts_id = [];

            if ($this->input->post('share_contacts_id')) {
                $share_contacts_id = $this->input->post('share_contacts_id');
            }

            $this->db->where('file_id', $file_id);
            $this->db->delete(db_prefix() . 'shared_customer_files');

            foreach ($share_contacts_id as $share_contact_id) {
                $this->db->insert(db_prefix() . 'shared_customer_files', [
                    'file_id' => $file_id,
                    'contact_id' => $share_contact_id,
                ]);
            }
        }
    }

    public function delete_contact_profile_image($contact_id)
    {
        $this->clients_model->delete_contact_profile_image($contact_id);
    }

    public function mark_as_active($id)
    {
        $this->db->where('userid', $id);
        $this->db->update(db_prefix() . 'clients', [
            'active' => 1,
        ]);
        redirect(admin_url('clients/client/' . $id));
    }

    public function consents($id)
    {
        if (!has_permission('customers', '', 'view')) {
            if (!is_customer_admin(get_user_id_by_contact_id($id))) {
                echo _l('access_denied');
                die;
            }
        }

        $this->load->model('gdpr_model');
        $data['purposes'] = $this->gdpr_model->get_consent_purposes($id, 'contact');
        $data['consents'] = $this->gdpr_model->get_consents(['contact_id' => $id]);
        $data['contact_id'] = $id;
        $this->load->view('admin/gdpr/contact_consent', $data);
    }

    public function update_all_proposal_emails_linked_to_customer($contact_id)
    {
        $success = false;
        $email = '';
        if ($this->input->post('update')) {
            $this->load->model('proposals_model');

            $this->db->select('email,userid');
            $this->db->where('id', $contact_id);
            $contact = $this->db->get(db_prefix() . 'contacts')->row();

            $proposals = $this->proposals_model->get('', [
                'rel_type' => 'customer',
                'rel_id' => $contact->userid,
                'email' => $this->input->post('original_email'),
            ]);
            $affected_rows = 0;

            foreach ($proposals as $proposal) {
                $this->db->where('id', $proposal['id']);
                $this->db->update(db_prefix() . 'proposals', [
                    'email' => $contact->email,
                ]);
                if ($this->db->affected_rows() > 0) {
                    $affected_rows++;
                }
            }

            if ($affected_rows > 0) {
                $success = true;
            }
        }
        echo json_encode([
            'success' => $success,
            'message' => _l('proposals_emails_updated', [
                _l('contact_lowercase'),
                $contact->email,
            ]),
        ]);
    }

    public function assign_admins($id)
    {
        if (!has_permission('customers', '', 'create') && !has_permission('customers', '', 'edit')) {
            access_denied('customers');
        }
        $success = $this->clients_model->assign_admins($this->input->post(), $id);
        if ($success == true) {
            set_alert('success', _l('updated_successfully', _l('client')));
        }

        redirect(admin_url('clients/client/' . $id . '?tab=customer_admins'));
    }

    public function delete_customer_admin($customer_id, $staff_id)
    {
        if (!has_permission('customers', '', 'create') && !has_permission('customers', '', 'edit')) {
            access_denied('customers');
        }

        $this->db->where('customer_id', $customer_id);
        $this->db->where('staff_id', $staff_id);
        $this->db->delete(db_prefix() . 'customer_admins');
        redirect(admin_url('clients/client/' . $customer_id) . '?tab=customer_admins');
    }

    public function delete_contact($customer_id, $id)
    {
        if (!has_permission('customers', '', 'delete')) {
            if (!is_customer_admin($customer_id)) {
                access_denied('customers');
            }
        }
        $contact = $this->clients_model->get_contact($id);
        $hasProposals = false;
        if ($contact && is_gdpr()) {
            if (total_rows(db_prefix() . 'proposals', ['email' => $contact->email]) > 0) {
                $hasProposals = true;
            }
        }

        $this->clients_model->delete_contact($id);
        if ($hasProposals) {
            $this->session->set_flashdata('gdpr_delete_warning', true);
        }
        redirect(admin_url('clients/client/' . $customer_id . '?group=contacts'));
    }

    public function contacts($client_id)
    {
        $this->app->get_table_data('contacts', [
            'client_id' => $client_id,
        ]);
    }

    public function upload_attachment($id)
    {
        handle_client_attachments_upload($id);
    }

    public function add_external_attachment()
    {
        if ($this->input->post()) {
            $this->misc_model->add_attachment_to_database($this->input->post('clientid'), 'customer', $this->input->post('files'), $this->input->post('external'));
        }
    }

    public function delete_attachment($customer_id, $id)
    {
        // if (has_permission('customers', '', 'delete') || is_customer_admin($customer_id)) {
        $this->clients_model->delete_attachment($id);
        // }
        redirect($_SERVER['HTTP_REFERER']);
    }

    /* Delete client */
    public function delete($id)
    {
        if (!has_permission('customers', '', 'delete')) {
            access_denied('customers');
        }
        if (!$id) {
            redirect(admin_url('clients'));
        }
        $response = $this->clients_model->delete($id);
        if (is_array($response) && isset($response['referenced'])) {
            set_alert('warning', _l('customer_delete_transactions_warning', _l('invoices') . ', ' . _l('estimates') . ', ' . _l('credit_notes')));
        } elseif ($response == true) {
            set_alert('success', _l('deleted', _l('client')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('client_lowercase')));
        }
        redirect(admin_url('clients'));
    }

    /* Staff can login as client */
    public function login_as_client($id)
    {
        if (is_admin()) {
            login_as_client($id);
        }
        hooks()->do_action('after_contact_login');
        redirect(site_url());
    }

    public function get_customer_billing_and_shipping_details($id)
    {
        echo json_encode($this->clients_model->get_customer_billing_and_shipping_details($id));
    }

    /* Change client status / active / inactive */
    public function change_contact_status($id, $status)
    {
        if (has_permission('customers', '', 'edit') || is_customer_admin(get_user_id_by_contact_id($id))) {
            if ($this->input->is_ajax_request()) {
                $this->clients_model->change_contact_status($id, $status);
            }
        }
    }

    /* Change client status / active / inactive */
    public function change_client_status($id, $status)
    {
        if ($this->input->is_ajax_request()) {
            $this->clients_model->change_client_status($id, $status);
        }
    }

    /* Zip function for credit notes */
    public function zip_credit_notes($id)
    {
        $has_permission_view = has_permission('credit_notes', '', 'view');

        if (!$has_permission_view && !has_permission('credit_notes', '', 'view_own')) {
            access_denied('Zip Customer Credit Notes');
        }

        if ($this->input->post()) {
            $this->load->library('app_bulk_pdf_export', [
                'export_type' => 'credit_notes',
                'status' => $this->input->post('credit_note_zip_status'),
                'date_from' => $this->input->post('zip-from'),
                'date_to' => $this->input->post('zip-to'),
                'redirect_on_error' => admin_url('clients/client/' . $id . '?group=credit_notes'),
            ]);

            $this->app_bulk_pdf_export->set_client_id($id);
            $this->app_bulk_pdf_export->in_folder($this->input->post('file_name'));
            $this->app_bulk_pdf_export->export();
        }
    }

    public function zip_invoices($id)
    {
        $has_permission_view = has_permission('invoices', '', 'view');
        if (
            !$has_permission_view && !has_permission('invoices', '', 'view_own')
            && get_option('allow_staff_view_invoices_assigned') == '0'
        ) {
            access_denied('Zip Customer Invoices');
        }

        if ($this->input->post()) {
            $this->load->library('app_bulk_pdf_export', [
                'export_type' => 'invoices',
                'status' => $this->input->post('invoice_zip_status'),
                'date_from' => $this->input->post('zip-from'),
                'date_to' => $this->input->post('zip-to'),
                'redirect_on_error' => admin_url('clients/client/' . $id . '?group=invoices'),
            ]);

            $this->app_bulk_pdf_export->set_client_id($id);
            $this->app_bulk_pdf_export->in_folder($this->input->post('file_name'));
            $this->app_bulk_pdf_export->export();
        }
    }

    /* Since version 1.0.2 zip client estimates */
    public function zip_estimates($id)
    {
        $has_permission_view = has_permission('estimates', '', 'view');
        if (
            !$has_permission_view && !has_permission('estimates', '', 'view_own')
            && get_option('allow_staff_view_estimates_assigned') == '0'
        ) {
            access_denied('Zip Customer Estimates');
        }

        if ($this->input->post()) {
            $this->load->library('app_bulk_pdf_export', [
                'export_type' => 'estimates',
                'status' => $this->input->post('estimate_zip_status'),
                'date_from' => $this->input->post('zip-from'),
                'date_to' => $this->input->post('zip-to'),
                'redirect_on_error' => admin_url('clients/client/' . $id . '?group=estimates'),
            ]);

            $this->app_bulk_pdf_export->set_client_id($id);
            $this->app_bulk_pdf_export->in_folder($this->input->post('file_name'));
            $this->app_bulk_pdf_export->export();
        }
    }

    public function zip_payments($id)
    {
        $has_permission_view = has_permission('payments', '', 'view');

        if (
            !$has_permission_view && !has_permission('invoices', '', 'view_own')
            && get_option('allow_staff_view_invoices_assigned') == '0'
        ) {
            access_denied('Zip Customer Payments');
        }

        $this->load->library('app_bulk_pdf_export', [
            'export_type' => 'payments',
            'payment_mode' => $this->input->post('paymentmode'),
            'date_from' => $this->input->post('zip-from'),
            'date_to' => $this->input->post('zip-to'),
            'redirect_on_error' => admin_url('clients/client/' . $id . '?group=payments'),
        ]);

        $this->app_bulk_pdf_export->set_client_id($id);
        $this->app_bulk_pdf_export->set_client_id_column(db_prefix() . 'clients.userid');
        $this->app_bulk_pdf_export->in_folder($this->input->post('file_name'));
        $this->app_bulk_pdf_export->export();
    }

    public function import()
    {
        if (!has_permission('customers', '', 'create')) {
            access_denied('customers');
        }

        $dbFields = $this->db->list_fields(db_prefix() . 'contacts');
        foreach ($dbFields as $key => $contactField) {
            if ($contactField == 'phonenumber') {
                $dbFields[$key] = 'contact_phonenumber';
            }
        }

        $dbFields = array_merge($dbFields, $this->db->list_fields(db_prefix() . 'clients'));

        $this->load->library('import/import_customers', [], 'import');

        $this->import->setDatabaseFields($dbFields)
            ->setCustomFields(get_custom_fields('customers'));

        if ($this->input->post('download_sample') === 'true') {
            $this->import->downloadSample();
        }

        if (
            $this->input->post()
            && isset($_FILES['file_csv']['name']) && $_FILES['file_csv']['name'] != ''
        ) {
            $this->import->setSimulation($this->input->post('simulate'))
                ->setTemporaryFileLocation($_FILES['file_csv']['tmp_name'])
                ->setFilename($_FILES['file_csv']['name'])
                ->perform();


            $data['total_rows_post'] = $this->import->totalRows();

            if (!$this->import->isSimulation()) {
                set_alert('success', _l('import_total_imported', $this->import->totalImported()));
            }
        }

        $data['groups'] = $this->clients_model->get_groups();
        $data['title'] = _l('import');
        $data['bodyclass'] = 'dynamic-create-groups';
        $this->load->view('admin/clients/import', $data);
    }

    public function groups()
    {
        if (!is_admin()) {
            access_denied('Customer Groups');
        }
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('customers_groups');
        }
        $data['title'] = _l('customer_groups');
        $this->load->view('admin/clients/groups_manage', $data);
    }

    public function group()
    {
        if (!is_admin() && get_option('staff_members_create_inline_customer_groups') == '0') {
            access_denied('Customer Groups');
        }

        if ($this->input->is_ajax_request()) {
            $data = $this->input->post();
            if ($data['id'] == '') {
                $id = $this->clients_model->add_group($data);
                $message = $id ? _l('added_successfully', _l('customer_group')) : '';
                echo json_encode([
                    'success' => $id ? true : false,
                    'message' => $message,
                    'id' => $id,
                    'name' => $data['name'],
                ]);
            } else {
                $success = $this->clients_model->edit_group($data);
                $message = '';
                if ($success == true) {
                    $message = _l('updated_successfully', _l('customer_group'));
                }
                echo json_encode([
                    'success' => $success,
                    'message' => $message,
                ]);
            }
        }
    }

    public function delete_group($id)
    {
        if (!is_admin()) {
            access_denied('Delete Customer Group');
        }
        if (!$id) {
            redirect(admin_url('clients/groups'));
        }
        $response = $this->clients_model->delete_group($id);
        if ($response == true) {
            set_alert('success', _l('deleted', _l('customer_group')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('customer_group_lowercase')));
        }
        redirect(admin_url('clients/groups'));
    }

    public function bulk_action()
    {
        hooks()->do_action('before_do_bulk_action_for_customers');
        $total_deleted = 0;
        if ($this->input->post()) {
            $ids = $this->input->post('ids');
            $groups = $this->input->post('groups');

            if (is_array($ids)) {
                foreach ($ids as $id) {
                    if ($this->input->post('mass_delete')) {
                        if ($this->clients_model->delete($id)) {
                            $total_deleted++;
                        }
                    } else {
                        if (!is_array($groups)) {
                            $groups = false;
                        }
                        $this->client_groups_model->sync_customer_groups($id, $groups);
                    }
                }
            }
        }

        if ($this->input->post('mass_delete')) {
            set_alert('success', _l('total_clients_deleted', $total_deleted));
        }
    }

    public function vault_entry_create($customer_id)
    {
        $data = $this->input->post();

        if (isset($data['fakeusernameremembered'])) {
            unset($data['fakeusernameremembered']);
        }

        if (isset($data['fakepasswordremembered'])) {
            unset($data['fakepasswordremembered']);
        }

        unset($data['id']);
        $data['creator'] = get_staff_user_id();
        $data['creator_name'] = get_staff_full_name($data['creator']);
        $data['description'] = nl2br($data['description']);
        $data['password'] = $this->encryption->encrypt($this->input->post('password', false));

        if (empty($data['port'])) {
            unset($data['port']);
        }

        $this->clients_model->vault_entry_create($data, $customer_id);
        set_alert('success', _l('added_successfully', _l('vault_entry')));
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function vault_entry_update($entry_id)
    {
        $entry = $this->clients_model->get_vault_entry($entry_id);

        if ($entry->creator == get_staff_user_id() || is_admin()) {
            $data = $this->input->post();

            if (isset($data['fakeusernameremembered'])) {
                unset($data['fakeusernameremembered']);
            }
            if (isset($data['fakepasswordremembered'])) {
                unset($data['fakepasswordremembered']);
            }

            $data['last_updated_from'] = get_staff_full_name(get_staff_user_id());
            $data['description'] = nl2br($data['description']);

            if (!empty($data['password'])) {
                $data['password'] = $this->encryption->encrypt($this->input->post('password', false));
            } else {
                unset($data['password']);
            }

            if (empty($data['port'])) {
                unset($data['port']);
            }

            $this->clients_model->vault_entry_update($entry_id, $data);
            set_alert('success', _l('updated_successfully', _l('vault_entry')));
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function vault_entry_delete($id)
    {
        $entry = $this->clients_model->get_vault_entry($id);
        if ($entry->creator == get_staff_user_id() || is_admin()) {
            $this->clients_model->vault_entry_delete($id);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function vault_encrypt_password()
    {
        $id = $this->input->post('id');
        $user_password = $this->input->post('user_password', false);
        $user = $this->staff_model->get(get_staff_user_id());

        if (!app_hasher()->CheckPassword($user_password, $user->password)) {
            header('HTTP/1.1 401 Unauthorized');
            echo json_encode(['error_msg' => _l('vault_password_user_not_correct')]);
            die;
        }

        $vault = $this->clients_model->get_vault_entry($id);
        $password = $this->encryption->decrypt($vault->password);

        $password = html_escape($password);

        // Failed to decrypt
        if (!$password) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad error');
            echo json_encode(['error_msg' => _l('failed_to_decrypt_password')]);
            die;
        }

        echo json_encode(['password' => $password]);
    }

    public function get_vault_entry($id)
    {
        $entry = $this->clients_model->get_vault_entry($id);
        unset($entry->password);
        $entry->description = clear_textarea_breaks($entry->description);
        echo json_encode($entry);
    }

    public function statement_pdf()
    {
        $customer_id = $this->input->get('customer_id');

        if (!has_permission('invoices', '', 'view') && !has_permission('payments', '', 'view')) {
            set_alert('danger', _l('access_denied'));
            redirect(admin_url('clients/client/' . $customer_id));
        }

        $from = $this->input->get('from');
        $to = $this->input->get('to');

        $data['statement'] = $this->clients_model->get_statement($customer_id, to_sql_date($from), to_sql_date($to));

        try {
            $pdf = statement_pdf($data['statement']);
        } catch (Exception $e) {
            $message = $e->getMessage();
            echo $message;
            if (strpos($message, 'Unable to get the size of the image') !== false) {
                show_pdf_unable_to_get_image_size_error();
            }
            die;
        }

        $type = 'D';
        if ($this->input->get('print')) {
            $type = 'I';
        }

        $pdf->Output(slug_it(_l('customer_statement') . '-' . $data['statement']['client']->company) . '.pdf', $type);
    }

    public function send_statement()
    {
        $customer_id = $this->input->get('customer_id');

        if (!has_permission('invoices', '', 'view') && !has_permission('payments', '', 'view')) {
            set_alert('danger', _l('access_denied'));
            redirect(admin_url('clients/client/' . $customer_id));
        }

        $from = $this->input->get('from');
        $to = $this->input->get('to');

        $send_to = $this->input->post('send_to');
        $cc = $this->input->post('cc');

        $success = $this->clients_model->send_statement_to_email($customer_id, $send_to, $from, $to, $cc);
        // In case client use another language
        load_admin_language();
        if ($success) {
            set_alert('success', _l('statement_sent_to_client_success'));
        } else {
            set_alert('danger', _l('statement_sent_to_client_fail'));
        }

        redirect(admin_url('clients/client/' . $customer_id . '?group=statement'));
    }

    public function statement()
    {
        if (!has_permission('invoices', '', 'view') && !has_permission('payments', '', 'view')) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad error');
            echo _l('access_denied');
            die;
        }

        $customer_id = $this->input->get('customer_id');
        $from = $this->input->get('from');
        $to = $this->input->get('to');

        $data['statement'] = $this->clients_model->get_statement($customer_id, to_sql_date($from), to_sql_date($to));

        $data['from'] = $from;
        $data['to'] = $to;

        $viewData['html'] = $this->load->view('admin/clients/groups/_statement', $data, true);

        echo json_encode($viewData);
    }

    public function occupationClass()
    {
        $data['data'] = $this->clients_model->fetchOccupationClass();
        $this->load->view('admin/clients/occupation', $data);
    }

    public function saveOccupationClass()
    {
        $data = [
            'occupation' => $this->input->post('occupation'),
        ];
        $this->clients_model->save_Occupation_Class($data);
        redirect(admin_url('Clients/occupationClass'));
    }

    public function deleteOccupationClass()
    {
        $data = [
            'is_deleted' => 1,
        ];
        $id = $this->uri->segment(4);
        set_alert('success', 'Deleted Successfully');
        $this->clients_model->delete_OccupationClass($data, $id);
        redirect(admin_url('Clients/occupationClass'));
    }

    public function smoker()
    {
        $data['data'] = $this->clients_model->fetchSmoker();
        $this->load->view('admin/clients/smoker', $data);
    }

    public function saveSmoker()
    {
        $data = [
            'smoker' => $this->input->post('smoker'),
        ];
        $this->clients_model->save_Smoker($data);
        redirect(admin_url('Clients/smoker'));
    }

    public function deleteSmoker()
    {
        $data = [
            'is_deleted' => 1,
        ];
        $id = $this->uri->segment(4);
        set_alert('success', 'Deleted Successfully');
        $this->clients_model->delete_Smoker($data, $id);
        redirect(admin_url('Clients/smoker'));
    }

    // public function updatecategory(){
    //     $data['category_id'] = $this->input->post('id');
    //     $attachementId = $this->input->post('attachementId');
    //     $this->clients_model->updateCategory($data,$attachementId);
    // }

    // public function updateCompliance(){
    //     $complian['compliance_id'] = $this->input->post('id'); 
    //     $attachementId = $this->input->post('attachementId');
    //     $this->clients_model->updateCompliancez($complian, $attachementId);
    // }

    public function import_view()
    {
        $this->load->view('admin/clients/import_customer_data');
    }

    public function importExcel()
    {
        if ($this->input->post('upload') != NULL) {
            $data = array();

            if (!empty($_FILES['file']['name'])) {

                $config['upload_path'] = 'assets/images/';
                $config['allowed_types'] = 'csv';
                $config['max_size'] = '1000'; // max_size in kb 
                $config['file_name'] = $_FILES['file']['name'];
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file')) {
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];
                    $file = fopen("assets/images/" . $filename, "r");

                    $i = 0;
                    $numberOfFields = 26; // Total number of fields
                    $importData_arr = array();

                    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                        $num = count($filedata);

                        if ($numberOfFields == $num) {

                            for ($c = 0; $c < $num; $c++) {
                                $importData_arr[$i][] = $filedata[$c];
                            }
                        }
                        $i++;
                    }
                    fclose($file);
                    $skip = 0;
                    foreach ($importData_arr as $userdata) {
                        if ($skip != 0) {
                            $result = $this->clients_model->insertRecord($userdata);
                        }
                        $skip++;
                    }

                    if ($result == 2) {
                        // set_alert('danger', 'This Records EXIST in table');
                        // log_activity('Record Exist in table');
                    }
                    if ($result == 1) {
                        // $data['response'] = 'O-YES '.$filename; 
                        // set_alert('success', 'Records Imported Successfully');
                    }
                    if ($result == 0) {
                        // $data['response'] = 'O-NO'; 
                        // set_alert('danger', 'Records Not Imported due to Blank Column');
                    }
                } else {
                    $data['response'] = 'failed';
                }
            } else {
                $data['response'] = 'failed';
            }
            redirect(admin_url('Clients/all_contacts'));
        } else {
            $this->load->view('admin/clients/all_contacts');
            redirect(admin_url('Clients/all_contacts'));
        }
    }

    public function InActivityLog()
    {
        $In_ActivityLog['InActivity_Log'] = $this->clients_model->activity_log_Individuals();
        $this->load->view('admin/clients/individual_log_activity', $In_ActivityLog);
    }

    // public function vulnerableCheckData_tbl(){
    //     $vulnerable_checkValue['checkBox_vulnerable'] = $this->input->post('vulnerable_checkValue');
    //     $individeal_id = $this->input->post('individeal_id');
    //     $this->clients_model->change_Status_Vul_Check($vulnerable_checkValue , $individeal_id);
    // }

    public function vulnerableCheckData_tbl()
    {
        $vulnerable_checkValue['checkBox_vulnerable'] = $this->input->post('vulnerable_checkValue');
        $individeal_id = $this->input->post('individeal_id');
        $this->clients_model->change_Status_Vul_Check($vulnerable_checkValue, $individeal_id);
    }

    // public function primaryContact(){
    //     $primary_checkVal['is_primary'] = $this->input->post('primary_checkVal');
    //     $individeal = $this->input->post('individeal');
    //     $this->clients_model->change_Status_primary_Check($primary_checkVal , $individeal);
    // }

    public function primaryContact()
    {
        $primary_checkVal['contract_emails'] = $this->input->post('primary_checkVal');
        $individeal = $this->input->post('individeal');
        $this->clients_model->change_Status_primary_Check($primary_checkVal, $individeal);
    }

    public function DeceasedContact()
    {
        $deceased_checkVal = $this->input->post('deceased_checkVal');
        $email_checkVal = $this->input->post('email_checkVal');
        $deceased = $this->input->post('deceased');
        $data = [
            'contract_emails' => $email_checkVal,
            'deceased' => $deceased_checkVal
        ];
        $this->clients_model->change_Status_deceaed_Check($data, $deceased);
    }
    public function email_reciever()
    {
        $email_checkVal = $this->input->post('email_checkVal');
        $id = $this->input->post('id');
        $data = [
            'contract_emails' => $email_checkVal
        ];
        $this->clients_model->change_email_reciever_Check($data, $id);
    }

    public function vulnerableDrivers()
    {
        $id = $this->uri->segment(4);
        if (!$id) {
            if ($this->input->post()) {
                $this->clients_model->save_vulnerableClient('', $this->input->post());
            }
            $data['data'] = $this->clients_model->fetchvulnerableClient();
            $this->load->view('admin/clients/vulnerabledivers', $data);
        } else {
            $data = [
                'is_deleted' => 1,
            ];
            $result = $this->clients_model->save_vulnerableClient($id, $data);
            if ($result == 'yes') {
                set_alert('success', 'Deleted Successfully');
            }
            redirect(admin_url('clients/vulnerableDrivers'));
        }
    }


    public function get_contact_details()
    {
        $contact_id_under_client = $this->input->post('contact_id');
        $userid = $this->input->post('userid');

        $fetch_client_related_data = $this->clients_model->clientRelatedData($contact_id_under_client, $userid);
        echo json_encode($fetch_client_related_data);
    }

    public function type()
    {
        $id = $this->uri->segment(4);
        if (!$id) {
            if ($this->input->post()) {
                $this->clients_model->save_type('', $this->input->post());
            }
            $data['data'] = $this->clients_model->fetchtype();
            $this->load->view('admin/clients/client_type', $data);
        } else {
            $data = [
                'is_deleted' => 1,
            ];
            $result = $this->clients_model->save_type($id, $data);
            if ($result == 'yes') {
                set_alert('success', 'Deleted Successfully');
            }
            redirect(admin_url('clients/type'));
        }
    }


    public function firstNameExists()
    {
        $firstname = $this->input->post('firstname');
        $lastname = $this->input->post('lastname');
        $dob = $this->input->post('dob');
        $exists = $this->clients_model->firstNameExists($firstname, $lastname, $dob);
        $count = count($exists);
        if ($count == 0) {
            echo 0;
        } else {
            echo 1;
        }
    }
    // public function lastnameExists(){
    //     $lastname = $this->input->post('lastname');
    //     $exists = $this->clients_model->lastname_Exists($lastname);
    //     $count = count($exists);
    //     if ($count == 0) {
    //         echo 0;
    //     } else {
    //         echo 1;
    //     }
    // }
    // public function dobExists(){
    //     $dob = $this->input->post('dob');
    //     $exists = $this->clients_model->dob_Exists($dob);
    //     $count = count($exists);
    //     if ($count == 0) {
    //         echo 0;
    //     } else {
    //         echo 1;
    //     }
    // }

    public function updateCompliance()
    {
        $complianId = $this->input->post('id');
        if ($complianId) {
            $compliance_name = $this->clients_model->compliance_name($complianId);
        }
        $data = [
            'compliance_id' => $complianId,
            'compliance_name' => $compliance_name,
        ];
        $file_id = $this->input->post('attachementId');
        $this->clients_model->updateCompliancez($data, $file_id);
    }

    public function updatecategory()
    {
        $data['category_id'] = $this->input->post('id');
        $file_id = $this->input->post('attachementId');
        $data['category_name'] = $this->clients_model->getCategory_Name($data['category_id']);
        $this->clients_model->saveupdatecat($data, $file_id, );
    }

    public function reason_of_disable()
    {
        if ($this->input->post()) {
            $data = $this->input->post();
        }
        $exists = $this->clients_model->is_exist_userId($data['user_id']);
        $count = count($exists);
        if ($count == 0) {
            $not_exists = $this->clients_model->reasonOfDisable_not_exist($data);
        } else {
            $exist = $this->clients_model->reasonOfDisable_exist($data, $data['user_id']);
        }
        redirect(admin_url('clients'));
    }
    public function checkedData()
    {
        $active = $this->input->post('active');
        $inputcheckId = $this->input->post('inputcheckId');
        $exists = $this->clients_model->save_active_one($active, $inputcheckId);
        $count = count($exists);
        if ($count == 0) {
            echo 0;
        } else {
            echo 1;
        }
    }
    public function get_reason_of_disable()
    {
        $clientGridId = $this->input->post('clientGridId');
        $exists = $this->clients_model->getReasonOfDisable($clientGridId);
        echo ($exists);
    }
    public function update_file_data()
    {
        $rowid = $this->input->post('rowid');
        $clientId = $this->input->post('clientId');
        $data = [
            'client_file_discription' => $this->input->post('client_file_discription'),
            'filename_Notencript' => $this->input->post('filename_Notencript'),
        ];
        $exists = $this->clients_model->update_fileData($rowid, $clientId, $data);
    }

    public function report_client_reviews()
    {
        $this->clients_model->updateResidentilaAddress();
        if ($this->input->post('adviser') == '' && $this->input->post('client_review_month') == '' && $this->input->post('type') == '') {
            $get_project_data['adviser'] = $this->projects_model->fetchadvisordata();
            $get_project_data['type'] = $this->clients_model->fetchtype();
            $get_project_data['review_month'] = $this->clients_model->review_month();
            // $get_project_data['client_review_data'] = $this->clients_model->fetchClient_review_data();
            if (!is_admin()) {
                $cleck_is_admin = 0;
                $get_project_data['client_review_data'] = $this->clients_model->fetchClient_review_data($cleck_is_admin);
            }
            if (!has_permission('customers', '', 'view')) {
                if (!is_customer_admin($id)) {
                    $cleck_is_admin = 0;
                    $get_project_data['client_review_data'] = $this->clients_model->fetchClient_review_data($cleck_is_admin);
                }
            } else {
                $cleck_is_admin = 1;
                $get_project_data['client_review_data'] = $this->clients_model->fetchClient_review_data($cleck_is_admin);
            }
            $filter = [
                'adviser' => '',
                'type' => '',
                'client_review_month' => '',
            ];
            $this->session->set_userdata($filter);
        } else {
            $get_project_data['adviser'] = $this->projects_model->fetchadvisordata();
            $get_project_data['type'] = $this->clients_model->fetchtype();
            $get_project_data['review_month'] = $this->clients_model->review_month();
            $filter = [
                'adviser' => $this->input->post('adviser'),
                'type' => $this->input->post('type'),
                'client_review_month' => $this->input->post('client_review_month'),
            ];
            $this->session->set_userdata($filter);
            if (!is_admin()) {
                $cleck_is_admin = 0;
                $get_project_data['client_review_data'] = $this->clients_model->fetchClient_filter_review_data($filter, $cleck_is_admin);
            }
            if (!has_permission('customers', '', 'view')) {
                if (!is_customer_admin($id)) {
                    $cleck_is_admin = 0;
                    $get_project_data['client_review_data'] = $this->clients_model->fetchClient_filter_review_data($filter, $cleck_is_admin);
                }
            } else {
                $cleck_is_admin = 1;
                $get_project_data['client_review_data'] = $this->clients_model->fetchClient_filter_review_data($filter, $cleck_is_admin);
            }
        }
        $this->load->view('admin/clients/modals/client_review_report', $get_project_data);
    }

    public function files_archive()
    {
        $this->load->model('policy_model');
        $data['companey'] = $this->policy_model->fetchCompaney();
        $data['fetch_ArchiveFiles'] = $this->clients_model->fetchArchiveFiles($data);
        $this->load->view('admin/clients/modals/files_archive', $data);
    }
    public function save_files_archive()
    {
        $staff_id = get_staff_user_id();
        $archive_id = $this->input->post('archive_name');
        if ($archive_id == '') {
            $data = [
                'customer' => $this->input->post('customer'),
                'hyper_link' => $this->input->post('hyper_link'),
                'staff_id' => $staff_id,
            ];
            $saveArchiveFiles = $this->clients_model->saveArchiveFiles($data);
        } else {
            $data = [
                'customer' => $this->input->post('customer'),
                'hyper_link' => $this->input->post('hyper_link'),
                'staff_id' => $staff_id,
            ];
            $updateArchiveFiles = $this->clients_model->updateArchiveFiles($archive_id, $data);
        }
        redirect(admin_url('Clients/files_archive'));
    }
    public function delete_archive_file()
    {
        $data = [
            'is_deleted' => 1,
        ];
        $id = $this->uri->segment(4);
        set_alert('success', 'Deleted Successfully');
        $this->clients_model->deleteArchive_file($data, $id);
        redirect(admin_url('Clients/files_archive'));
    }
    public function edit_archive_file()
    {
        $edit_archive_id = $this->input->post('edit_archive_id');
        $fetch_edit_archive_id = $this->clients_model->edit_archive_file($edit_archive_id);
        echo json_encode($fetch_edit_archive_id);
    }
    public function update_dob()
    {
        $dateOfBirth = $this->clients_model->date_of_birth();
    }

    // public function client_dashboard()
    // {


    //     $OpenClientDashboard = $this->input->post('OpenClientdashboard');
    //     $this->session->set_userdata('sessionDataOptionValue', $OpenClientDashboard);
    //     $SessionValue = $this->session->userdata('sessionDataOptionValue');

    //     if(!is_admin()) 
    //     {
    //         $cleck_is_admin = 0;
    //         // $get_project_data['provider_summary']  = $this->clients_model->provider_summary_data($cleck_is_admin);
    //         // $get_project_data['client_group_api']  = $this->clients_model->client_group_api($cleck_is_admin);
    //         // $get_project_data['ageProfile']        = $this->clients_model->ageProfile($cleck_is_admin);
    //         // $get_project_data['client_group_type'] = $this->clients_model->clientGroupType($cleck_is_admin);
    //         if($OpenClientDashboard==1)
    //         {
    //             $get_project_data['provider_summary']  = $this->clients_model->provider_summary_data($cleck_is_admin);
    //         }
    //         else if($OpenClientDashboard==2)
    //         {
    //             $get_project_data['client_group_api']  = $this->clients_model->client_group_api($cleck_is_admin);
    //         }
    //         else if($OpenClientDashboard==3)
    //         {
    //             $get_project_data['client_group_type'] = $this->clients_model->clientGroupType($cleck_is_admin);
    //         }
    //         else if($OpenClientDashboard==4)
    //         {
    //             $get_project_data['ageProfile']        = $this->clients_model->ageProfile($cleck_is_admin);
    //         }
    //     }
    //     if (!has_permission('customers', '', 'view')) 
    //     {
    //         if (!is_customer_admin($id)) 
    //         {
    //             $cleck_is_admin = 0;
    //             // $get_project_data['provider_summary']  = $this->clients_model->provider_summary_data($cleck_is_admin);
    //             // $get_project_data['client_group_api']  = $this->clients_model->client_group_api($cleck_is_admin);
    //             // $get_project_data['ageProfile']        = $this->clients_model->ageProfile($cleck_is_admin);
    //             // $get_project_data['client_group_type'] = $this->clients_model->clientGroupType($cleck_is_admin);
    //             if($OpenClientDashboard==1)
    //             {
    //                 $get_project_data['provider_summary']  = $this->clients_model->provider_summary_data($cleck_is_admin);
    //             }
    //             else if($OpenClientDashboard==2)
    //             {
    //                 $get_project_data['client_group_api']  = $this->clients_model->client_group_api($cleck_is_admin);

    //             }
    //             else if($OpenClientDashboard==3)
    //             {
    //                 $get_project_data['client_group_type'] = $this->clients_model->clientGroupType($cleck_is_admin);

    //             }
    //             else if($OpenClientDashboard==4)
    //             {
    //                 $get_project_data['ageProfile']        = $this->clients_model->ageProfile($cleck_is_admin);
    //             }
    //         }
    //     }
    //     else
    //     {
    //         $cleck_is_admin = 1;
    //         if($OpenClientDashboard==1)
    //         {
    //             $get_project_data['provider_summary']  = $this->clients_model->provider_summary_data($cleck_is_admin);
    //         }
    //         else if($OpenClientDashboard==2)
    //         {
    //             $get_project_data['client_group_api']  = $this->clients_model->client_group_api($cleck_is_admin);

    //         }
    //         else if($OpenClientDashboard==3)
    //         {
    //             $get_project_data['client_group_type'] = $this->clients_model->clientGroupType($cleck_is_admin);

    //         }
    //         else if($OpenClientDashboard==4)
    //         {
    //             $get_project_data['ageProfile']        = $this->clients_model->ageProfile($cleck_is_admin);
    //         }

    //     }

    //     $this->load->view('admin/clients/client_dashboard_widgets/client_dashboard', $get_project_data);

    // }

    public function to_update_id()
    {
        $update_data_ids = $this->clients_model->update_data_ids();
    }

    #inter_id_dynamic_by_name
    // public function insert_record()
    // {
    //     $get_data = $this->clients_model->get_data();
    //     foreach($get_data as $get_datas)
    //     {
    //         $status_type =  $get_datas['status_type'];
    //         $id =  $get_datas['id'];
    //         $update_data_id = $this->clients_model->update_data_id($status_type,$id);
    //     }
    // }
    public function insert_record()
    {
        $get_data = $this->clients_model->get_data();
        foreach ($get_data as $get_datas) {
            $providername = $get_datas['providername'];
            $id = $get_datas['id'];
            $update_data_id = $this->clients_model->update_data_id($providername, $id);
        }
    }




    // public function provider_apis()
// {

    //     if(!is_admin())
//     {
//         $cleck_is_admin = 0;
//         $get_project_data['provider_summary']  = $this->clients_model->provider_summary_data($cleck_is_admin);
//     }
//     if (!has_permission('customers', '', 'view'))
//     {
//         if (!is_customer_admin($id))
//         {
//             $cleck_is_admin = 0;
//             $get_project_data['provider_summary']  = $this->clients_model->provider_summary_data($cleck_is_admin);
//         }
//     }
//     else
//     {
//         $cleck_is_admin = 1;
//         $get_project_data['provider_summary']  = $this->clients_model->provider_summary_data($cleck_is_admin);

    //     }
//     $this->load->view('admin/clients/client_dashboard_widgets/provider_apis', $get_project_data);
//     // $this->load->view('admin/clients/client_dashboard_widgets/provider_apis', $get_project_data);
// }


    public function provider_apis()
    {
        // Default value for non-admin users
        // if(!is_admin())
        // {
        //      $cleck_is_admin = 0;
        //     $get_project_data['provider_summary']  = $this->clients_model->provider_summary_data($cleck_is_admin);
        // }
        // elseif (!has_permission('customers', '', 'view'))
        // {
        //     if (!is_customer_admin($id))
        //     {
        //          $cleck_is_admin = 0;
        //         $get_project_data['provider_summary']  = $this->clients_model->provider_summary_data($cleck_is_admin);
        //     }
        // }
        // else
        // {
        //     $cleck_is_admin = 1; // Set to 1 for admin users
        //     $get_project_data['provider_summary']  = $this->clients_model->provider_summary_data($cleck_is_admin);
        // }
        $this->load->view('admin/clients/client_dashboard_widgets/provider_apis');
    }
    function provider_apis_data()
    {
        if (!is_admin()) {
            $cleck_is_admin = 0;
            $get_project_data['provider_summary'] = $this->clients_model->provider_summary_data($cleck_is_admin);
        }
        if (!has_permission('customers', '', 'view')) {
            if (!is_customer_admin($id)) {
                $cleck_is_admin = 0;
                $get_project_data['provider_summary'] = $this->clients_model->provider_summary_data($cleck_is_admin);
            }
        } else {
            $cleck_is_admin = 1;
            $get_project_data['provider_summary'] = $this->clients_model->provider_summary_data($cleck_is_admin);
        }

        echo json_encode($get_project_data);
    }

    public function client_group_apis()
    {
        // if(!is_admin())
        // {
        //     $cleck_is_admin = 0;
        //     $get_project_data['client_group_api']  = $this->clients_model->client_group_api($cleck_is_admin);
        // }
        // if (!has_permission('customers', '', 'view'))
        // {
        //     if (!is_customer_admin($id))
        //     {
        //         $cleck_is_admin = 0;
        //         $get_project_data['client_group_api']  = $this->clients_model->client_group_api($cleck_is_admin);
        //     }
        // }
        // else
        // {
        //     $cleck_is_admin = 1;
        //     $get_project_data['client_group_api']  = $this->clients_model->client_group_api($cleck_is_admin);
        // }
        $this->load->view('admin/clients/client_dashboard_widgets/client_group_apis');
    }
    public function client_group_apis_data()
    {
        if (!is_admin()) {
            $cleck_is_admin = 0;
            $get_project_data['client_group_api'] = $this->clients_model->client_group_api($cleck_is_admin);
        }
        if (!has_permission('customers', '', 'view')) {
            if (!is_customer_admin($id)) {
                $cleck_is_admin = 0;
                $get_project_data['client_group_api'] = $this->clients_model->client_group_api($cleck_is_admin);
            }
        } else {
            $cleck_is_admin = 1;
            $get_project_data['client_group_api'] = $this->clients_model->client_group_api($cleck_is_admin);
        }
        echo json_encode($get_project_data);

    }

    public function client_group_types()
    {
        // if(!is_admin())
        // {
        //     $cleck_is_admin = 0;
        //     $get_project_data['client_group_type'] = $this->clients_model->clientGroupType($cleck_is_admin);
        // }
        // if (!has_permission('customers', '', 'view'))
        // {
        //     if (!is_customer_admin($id))
        //     {
        //         $cleck_is_admin = 0;
        //         $get_project_data['client_group_type'] = $this->clients_model->clientGroupType($cleck_is_admin);
        //     }
        // }
        // else
        // {
        //     $cleck_is_admin = 1;
        //     $get_project_data['client_group_type'] = $this->clients_model->clientGroupType($cleck_is_admin);
        // }
        $this->load->view('admin/clients/client_dashboard_widgets/client_group_types');
    }
    public function client_group_types_data()
    {
        if (!is_admin()) {
            $cleck_is_admin = 0;
            $get_project_data['client_group_type'] = $this->clients_model->clientGroupType($cleck_is_admin);
        }
        if (!has_permission('customers', '', 'view')) {
            if (!is_customer_admin($id)) {
                $cleck_is_admin = 0;
                $get_project_data['client_group_type'] = $this->clients_model->clientGroupType($cleck_is_admin);
            }
        } else {
            $cleck_is_admin = 1;
            $get_project_data['client_group_type'] = $this->clients_model->clientGroupType($cleck_is_admin);
        }
        echo json_encode($get_project_data);
    }
    public function age_profiles()
    {
        // if(!is_admin())
        // {
        //     $cleck_is_admin = 0;
        //     $get_project_data['ageProfile']        = $this->clients_model->ageProfile($cleck_is_admin);
        // }
        // if (!has_permission('customers', '', 'view'))
        // {
        //     if (!is_customer_admin($id))
        //     {
        //         $cleck_is_admin = 0;
        //          $get_project_data['ageProfile']        = $this->clients_model->ageProfile($cleck_is_admin);
        //     }
        // }
        // else
        // {
        //     $cleck_is_admin = 1;
        //     $get_project_data['ageProfile']        = $this->clients_model->ageProfile($cleck_is_admin);
        // }
        $this->load->view('admin/clients/client_dashboard_widgets/age_profiles');
    }
    public function age_profiles_data()
    {
        if (!is_admin()) {
            $cleck_is_admin = 0;
            $get_project_data['ageProfile'] = $this->clients_model->ageProfile($cleck_is_admin);
        }
        if (!has_permission('customers', '', 'view')) {
            if (!is_customer_admin($id)) {
                $cleck_is_admin = 0;
                $get_project_data['ageProfile'] = $this->clients_model->ageProfile($cleck_is_admin);
            }
        } else {
            $cleck_is_admin = 1;
            $get_project_data['ageProfile'] = $this->clients_model->ageProfile($cleck_is_admin);
        }
        echo json_encode($get_project_data);
    }


}
