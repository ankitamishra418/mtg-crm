<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Policy_model extends App_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Get consent purposes
     * @param  mixed $user_id contact id or lead id
     * @param  string $for     contact or lead
     * @return array
     */

    public function fetchContact($customer)
    {
       
        $this->db->select('firstname,lastname,id');
        $this->db->from('contacts');
        $this->db->where('userid', $customer);
        $this->db->group_by('email');
        $query = $this->db->get();
        return $query = $query->result_array();
    }

    public function fetchSecondaryContact()
    {
        $this->db->select('email');
        $this->db->from('contacts');
        $this->db->group_by('email');
        $this->db->where('is_primary', 0);
        $query = $this->db->get();
        return $query = $query->result_array();
    }

    public function fetchCompaney()
    {
        $this->db->select('company,userid');
        $this->db->from('clients');
        $query = $this->db->get();
        return $query = $query->result_array();
    }

    public function insert_add_policy_field($data)
    {
        $result = $this->db->insert('tblpolicy_benefits_field', $data);
        $lastid = $this->db->insert_id();
        return $lastid;
    }

    public function fetch_add_policy_field()
    {
        $this->db->select('*');
        $this->db->from('tblpolicy_benefits_field');
        $this->db->where('is_deleted', 0);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        $query = $query->result_array();
        $data = [];
        foreach ($query as $val) {
            $data[] = [
                'id' => $val['id'],
                'is_deleted' => $val['is_deleted'],
                'form_title' => $val['form_title'],
                'count' => unserialize($val['count']),
                'beneifits_field' => unserialize($val['beneifits_field'])
            ];
        }
        $arrayToSend = ['data' => $data];
        return $arrayToSend;
    }

    public function fetchBenefitfieldBytitle($title)
    {
        $this->db->select('*');
        $this->db->from('tblpolicy_benefits_field');
        $this->db->where('form_title', $title);
        $this->db->where('is_deleted', 0);
        $query = $this->db->get();
        $query = $query->result_array();
        $data = [];
        foreach ($query as $val) {
            $data[] = [
                'form_title' => $val['form_title'],
                'count' => unserialize($val['count']),
                'beneifits_field' => unserialize($val['beneifits_field'])
            ];
        }
        foreach ($data as $row) {
            $inputtextcount = $row['count'][0]['inputtextcount'];
            $inputcheckcount = $row['count'][0]['inputcheckcount'];
            $inputradiocount = $row['count'][0]['inputradiocount'];
            $inputdropdowncount = $row['count'][0]['inputdropdowncount'];
            $inputtextareacount = $row['count'][0]['inputtextareacount'];
            $inputmultiselectcount = $row['count'][0]['inputmultiselectcount'];

            $inputcurrencycount = $row['count'][0]['inputcurrencycount'];
            $inputdatecount = $row['count'][0]['inputdatecount'];
            $inputallarray1 = [];
            for ($count = 1; $count <= $inputtextcount; $count++) {
                $inputallarray = $row['beneifits_field'][0]['text_' . $count];
                array_push($inputallarray1, $inputallarray);
            }
            $inputallarray2 = [];
            for ($count = 1; $count <= $inputcheckcount; $count++) {
                $inputallarray = $row['beneifits_field'][0]['check_' . $count];
                array_push($inputallarray2, $inputallarray);
            }
            $inputallarray3 = [];
            for ($count = 1; $count <= $inputradiocount; $count++) {
                $inputallarray = $row['beneifits_field'][0]['radio_' . $count];
                array_push($inputallarray3, $inputallarray);
            }
            $inputallarray4 = [];
            for ($count = 1; $count <= $inputdropdowncount; $count++) {
                $inputallarray = $row['beneifits_field'][0]['dropdown_' . $count];
                array_push($inputallarray4, $inputallarray);
            }
            $inputallarray5 = [];
            for ($count = 1; $count <= $inputmultiselectcount; $count++) {
                $inputallarray = $row['beneifits_field'][0]['multiselect_' . $count];
                array_push($inputallarray5, $inputallarray);
            }
            $inputallarray6 = [];
            for ($count = 1; $count <= $inputtextareacount; $count++) {
                $inputallarray = $row['beneifits_field'][0]['textarea_' . $count];
                array_push($inputallarray6, $inputallarray);
            }
            $inputallarray7 = [];
            for ($count = 1; $count <= $inputcurrencycount; $count++) {
                $inputallarray = $row['beneifits_field'][0]['currencyarea_' . $count];
                array_push($inputallarray7, $inputallarray);
            }
            $inputallarray8 = [];
            for ($count = 1; $count <= $inputdatecount; $count++) {
                $inputallarray = $row['beneifits_field'][0]['datearea_' . $count];
                array_push($inputallarray8, $inputallarray);
            }

            $arraytosend = [
                'textcount' => $inputtextcount,
                'checkcount' => $inputcheckcount,
                'radiocount' => $inputradiocount,
                'dropdowncount' => $inputdropdowncount,
                'textareacount' => $inputtextareacount,
                'currencyareacount' => $inputcurrencycount,
                'dateareacount' => $inputdatecount,
                'multiselectcount' => $inputmultiselectcount,
                'textlabel' => $inputallarray1,
                'checklabel' => $inputallarray2,
                'radiolabel' => $inputallarray3,
                'droplabel' => $inputallarray4,
                'multiselectlabel' => $inputallarray5,
                'textarealabel' => $inputallarray6,
                'currencyarealabel' => $inputallarray7,
                'datearealabel' => $inputallarray8,
            ];
            for ($count = 1; $count <= $inputdropdowncount; $count++) {
               $arraytosend['count_dropdown_option'][] = $row['count'][0]['count_dropdown_option' .$count];
               $opstionarray = [];
               for ($j = 1; $j <=$row['count'][0]['count_dropdown_option' .$count]; $j++) {
                   $array = $row['beneifits_field'][0]['dropdown_'.$count.'_op_'.$j];
                $arraytosend['option'][$count-1][] =  $array;
               }
           }
           for ($count = 1; $count <= $inputmultiselectcount; $count++) {
                $arraytosend['count_multi_option'][] = $row['count'][0]['count_multi_option' .$count];
                $opstionarray = [];
                for ($j = 1; $j <=$row['count'][0]['count_multi_option' .$count]; $j++) {
                    $array = $row['beneifits_field'][0]['dropdown_mop_'.$count.'_op_'.$j];
                $arraytosend['multioption'][$count-1][] =  $array;
                }
            }
           for ($count = 1; $count <= $inputradiocount; $count++) {
            $arraytosend['count_radio_option'][] = $row['count'][0]['count_radio_option' .$count];
            $opstionarray = [];
            for ($j = 1; $j <=$row['count'][0]['count_radio_option' .$count]; $j++) {
                $array = $row['beneifits_field'][0]['radio'.$count.'_op_'.$j];
             $arraytosend['optionradio'][$count-1][] =  $array;
            }
        }
        for ($count = 1; $count <= $inputcheckcount; $count++) {
            $arraytosend['count_check_option'][] = $row['count'][0]['count_check_option' .$count];
            $opstionarray = [];
            for ($j = 1; $j <=$row['count'][0]['count_check_option' .$count]; $j++) {
                $array = $row['beneifits_field'][0]['checkbox'.$count.'_op_'.$j];
             $arraytosend['checkboxoption'][$count-1][] =  $array;
            }
        }
        for ($count = 1; $count <= $inputradiocount; $count++) {
            $arraytosend['count_radio_option'][] = $row['count'][0]['count_radio_option' .$count];
            $opstionarray = [];
            for ($j = 1; $j <=$row['count'][0]['count_radio_option' .$count]; $j++) {
                $array = $row['beneifits_field'][0]['radio'.$count.'_op_'.$j];
             $arraytosend['redio_option'][$count-1][] =  $array;
            }
        }
        }
         return $arraytosend;
    }
    public function addproviderdetails($data)
    {
        $result = $this->db->insert('tblproviders_details', $data);
        $lastid = $this->db->insert_id();
        return $lastid;
    }
    public function addpolicy($data)
    {
        $result = $this->db->insert('tblpolicy', $data);
        $lastid = $this->db->insert_id();
        return $lastid;
    }
    public function fetch_multicontactdata($lastid)
    {
        $this->db->select('*');
        $this->db->from('tblpolicy');
        $this->db->where('id', $lastid);
        $query = $this->db->get();
        $query = $query->result_array();
        $data = [];
        $i = 0;
        foreach ($query as $val) {
            $contatctids = unserialize($val['life_assured']);
            foreach ($contatctids as $contatctid) {
                $this->db->select('firstname,lastname,id');
                $this->db->from('contacts');
                $this->db->where('id', $contatctid);
                $query = $this->db->get();
                $ret = $query->row();
                $firstname = $ret->firstname;
                $lastname = $ret->lastname;
                $name = $firstname . " " . $lastname;
                $life_assured[] = $name;
            }
            $data[$i] = [
                'id' => $val['id'],
                'customer' => $val['customer'],
                'policy_number' => $val['policy_number'],
                'provider' => $val['provider'],
                'start_date' => $val['start_date'],
                'policy_fee' => $val['policy_fee'],
                'total_premium' => $val['total_premium'],
                'premium_frequency' => $val['premium_frequency'],
                'cover_type' => $val['cover_type'],
                'life_assured' => $life_assured,
                'policy_owner' => $life_assured,
                'contact_id' => unserialize($val['life_assured'])
            ];
            $i++;
        }
        return $data;
    }


    public function fetch_providers()
    {
        $this->db->select('*');
        $this->db->from('tblproviders_details');
        $this->db->where('is_deleted', 0);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query = $query->result_array();
    }
    public function fetch_providerdata($id)
    {
        $this->db->select('*');
        $this->db->from('tblproviders_details');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query = $query->result_array();
    }

    public function update_providerdetails($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('tblproviders_details', $data);
    }

    public function delete_providerdetails($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('tblproviders_details', $data);
    }
    public function delete_policybenefit($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('tblpolicy_benefits_field', $data);
    }

    public function save_PremiumFrequency($data)
    {
        $result = $this->db->insert('tblpremium_frequency', $data);
        $lastid = $this->db->insert_id();
        return $lastid;
    }

    public function fetchPremiumFrequency()
    {
        $this->db->select('*');
        $this->db->where('is_deleted', 0);
        $this->db->from('tblpremium_frequency');
        $query = $this->db->get();
        return $query = $query->result_array();
    }
    public function delete_premiumFrequency($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('tblpremium_frequency', $data);
    }

    public function save_covertype($data)
    {
        $result = $this->db->insert('tblcovertype', $data);
        $lastid = $this->db->insert_id();
        return $lastid;
    }

    public function fetchcovertype()
    {
        $this->db->select('*');
        $this->db->where('is_deleted', 0);
        $this->db->from('tblcovertype');
        $query = $this->db->get();
        return $query = $query->result_array();
    }

    public function delete_covertype($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('tblcovertype', $data);
    }

    public function save_policydetails($data)
    {
        $result = $this->db->insert('tblpolicy_contact_benefits', $data);
        $lastid = $this->db->insert_id();
        return $lastid;
    }


    public function fetch_policies($policy_id)
    {
        $this->db->select('*');
        $this->db->from('tblpolicy');
        $this->db->where('id', $policy_id);
        $query = $this->db->get();
        $query = $query->result_array();
        foreach ($query as $val) {
            $i = 0;
            $j = 0;
            $contatctids = unserialize($val['life_assured']);
            $policyOwnerid = unserialize($val['policy_owner']);
            foreach ($contatctids as $contatctid) {
                $this->db->select('firstname,lastname,id');
                $this->db->from('contacts');
                $this->db->where('id', $contatctid);
                $query = $this->db->get();
                $ret = $query->row();
                $firstname = $ret->firstname;
                $lastname = $ret->lastname;
                $name = $firstname . " " . $lastname;
                $life_assured[$i] = $name;
                $i++;
            }
            foreach ($policyOwnerid as $policyOwners) {
                $this->db->select('firstname,lastname,id');
                $this->db->from('contacts');
                $this->db->where('id', $policyOwners);
                $query = $this->db->get();
                $ret = $query->row();
                $firstname = $ret->firstname;
                $lastname = $ret->lastname;
                $name = $firstname . " " . $lastname;
                $policyOwner[$j] = $name;
                $j++;
            }
            $demolifeassured = implode(",", $life_assured);
            $demopolicyOwner = implode(",", $policyOwner);
           
            $data[] = [
                'id' => $val['id'],
                'policy_number' => $val['policy_number'],
                'customer' => $this->Policy_model->getcompanyName($val['customer']),
                'provider' => $val['provider'],
                'start_date' => $val['start_date'],
                'policy_fee' => $val['policy_fee'],
                'total_premium' => $val['total_premium'],
                'premium_frequency' => $val['premium_frequency'],
                'cover_type' => $val['cover_type'],
                'life_assured' => $demolifeassured,
                'policy_owner' => $demopolicyOwner,
                'policy_status' => $val['policy_status'],
                'renewal_date' => $val['renewal_date'],
                'key_contact' => $val['key_contact'],
                'contact_phone' => $val['contact_phone'],
                'contact_email' => $val['contact_email']
            ];
        }
        return $data;
    }

    public function show_PolicyData()
    {
        $this->db->select('*');
        $this->db->from('tblpolicy');
        $this->db->where('is_deleted', 0);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        $query = $query->result_array();
        foreach ($query as $val) {
            $i = 0;
            $j = 0;
            $contatctids = unserialize($val['life_assured']);
            $policyOwnerid = unserialize($val['policy_owner']);
            foreach ($contatctids as $contatctid) {
                $this->db->select('firstname,lastname,id');
                $this->db->from('contacts');
                $this->db->where('id', $contatctid);
                $query = $this->db->get();
                $ret = $query->row();
                $firstname = $ret->firstname;
                $lastname = $ret->lastname;
                $name = $firstname . " " . $lastname;
                $life_assured[$i] = $name;
                $i++;
            }
            foreach ($policyOwnerid as $policyOwners) {
                $this->db->select('firstname,lastname,id');
                $this->db->from('contacts');
                $this->db->where('id', $policyOwners);
                $query = $this->db->get();
                $ret = $query->row();
                $firstname = $ret->firstname;
                $lastname = $ret->lastname;
                $name = $firstname . " " . $lastname;
                $policyOwner[$j] = $name;
                $j++;
            }
            $demolifeassured = implode(",", $life_assured);
            $demopolicyOwner = implode(",", $policyOwner);
            unset($life_assured,$policyOwner);
            $data[] = [
                'id' => $val['id'],
                'policy_number' => $val['policy_number'],
                'customer' => $this->Policy_model->getcompanyName($val['customer']),
                'provider' => $val['provider'],
                'start_date' => $val['start_date'],
                'policy_fee' => $val['policy_fee'],
                'total_premium' => $val['total_premium'],
                'premium_frequency' => $val['premium_frequency'],
                'cover_type' => $val['cover_type'],
                'life_assured' => $demolifeassured,
                'policy_owner' => $demopolicyOwner,
                'policy_status' => $val['policy_status'],
                'renewal_date' => $val['renewal_date'],
                'adviser' =>$this->Policy_model->getAdviser($val['customer'])
            ];
        }
        return $data;
    }

    public function delete_PolicyData($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('tblpolicy', $data);
    }

    public function delete_Benefit($data, $id)
    {
        $this->db->where('policy_id', $id);
        return $this->db->update('tblpolicy_contact_benefits', $data);
    }

    public function fetch_policybenefit($policy_id)
    {
        $this->db->select('*');
        $this->db->from('tblpolicy_contact_benefits');
        $this->db->where('is_deleted', 0);
        $this->db->where('policy_id', $policy_id);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        $query = $query->result_array();
        foreach ($query as $val) {
            $data[] = [
                'id' => $val['id'],
                'policy_id' => $val['policy_id'],
                'contact_id' => $this->Policy_model->getContactName($val['contact_id']),
                'title' => $val['title'],
                'policy_benefits' => unserialize($val['policy_benefits'])
            ];
        }
        return $data;
    }

    public function getContactName($id)
    {
        $this->db->select('firstname,lastname,id');
        $this->db->from('contacts');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $ret = $query->row();
        $firstname = $ret->firstname;
        $lastname = $ret->lastname;
        return $name = $firstname . " " . $lastname;
    }
    public function getAdviser($id)
    {
        $this->db->select('staff_id');
        $this->db->from('tblcustomer_admins');
        $this->db->where('customer_id', $id);
        $query = $this->db->get();
        $query  = $query->result_array();
        for($i=0; $i<count($query); $i++){
            $data[] = $this->Policy_model->getStafName($query[$i]['staff_id']); 
        }
        $data = implode(",",$data);
        return $data;
    }
    
    public function getStafName($id){
        $this->db->select('firstname,lastname,staffid');
        $this->db->from('tblstaff');
        $this->db->where('staffid', $id);
        $query = $this->db->get();
        $ret = $query->row();
        $firstname = $ret->firstname;
        $lastname = $ret->lastname;
        return $name = $firstname . " " . $lastname;
    }

    public function getcompanyName($id)
    {
        $this->db->select('company');
        $this->db->from('tblclients');
        $this->db->where('userid', $id);
        $query = $this->db->get();
        $customer = $query->row();
        $customer = $customer->company;
        return $customer;
    }

    public function edit_SelectedBenefit($id)
    {
        $this->db->select('*');
        $this->db->from('tblpolicy_contact_benefits');
        $this->db->where('is_deleted', 0);
        $this->db->where('id', $id);
        $query = $this->db->get();
        $query = $query->result_array();
        //fetchBenefitfieldBytitle()
        //  echo "<pre>";
         $data = $this->Policy_model->fetchBenefitfieldBytitle($query[0]['title']);
        //  exit;

        // print_r($data);
        // echo "testing";
        // echo $query[0]['title'];
        // exit;
        // foreach ($query as $val) {
        //     $data = [
        //         'policy_id' => $val['policy_id'],
        //         'id' => $val['id'],
        //         'policy_benefits' => unserialize($val['policy_benefits'])
        //     ];
        // }
        return $data;
    }
    public function fetch_selected_benefit($id)
    {
        $this->db->select('*');
        $this->db->from('tblpolicy_contact_benefits');
        $this->db->where('is_deleted', 0);
        $this->db->where('id', $id);
        $query = $this->db->get();
        $query = $query->result_array();
        foreach ($query as $val) {
            $data = [
                'title' =>$val['title'],
                'contact_id' =>$val['contact_id'],
                'policy_id' => $val['policy_id'],
                'id' => $val['id'],
                'policy_benefits' => unserialize($val['policy_benefits'])
            ];
        }
        return $data;
    }
   
    public function update_SelectedBenefit($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('tblpolicy_contact_benefits', $data);
    }
    public function update_policydetails($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('tblpolicy_contact_benefits', $data);
    }

    public function edit_policy($id)
    {
        $this->db->select('*');
        $this->db->from('tblpolicy');
        $this->db->where('is_deleted', 0);
        $this->db->where("id", $id);
        $query = $this->db->get();
        $query = $query->result_array();
        foreach ($query as $val) {
            $i = 0;
            $j = 0;
            $contatctids = unserialize($val['life_assured']);
            $policyOwnerid = unserialize($val['policy_owner']);
            foreach ($contatctids as $contatctid) {
                $this->db->select('firstname,lastname,id');
                $this->db->from('contacts');
                $this->db->where('id', $contatctid);
                $query = $this->db->get();
                $ret = $query->row();
                $firstname = $ret->firstname;
                $lastname = $ret->lastname;
                $name = $firstname . " " . $lastname;
                $life_assured[$i] = $name;
                $i++;
            }
            foreach ($policyOwnerid as $policyOwners) {
                $this->db->select('firstname,lastname,id');
                $this->db->from('contacts');
                $this->db->where('id', $policyOwners);
                $query = $this->db->get();
                $ret = $query->row();
                $firstname = $ret->firstname;
                $lastname = $ret->lastname;
                $name = $firstname . " " . $lastname;
                $policyOwner[$j] = $name;
                $j++;
            }
            $demolifeassured = implode(",", $life_assured);
            $demopolicyOwner = implode(",", $policyOwner);
            $contatctid_id = implode(",", $contatctids);
            $policyOwner_id = implode(",", $policyOwnerid);
            $data = [
                'id' => $val['id'],
                'policy_number' => $val['policy_number'],
                'customer' => $this->Policy_model->getcompanyName($val['customer']),
                'customerid'=>$val['customer'],
                'provider' => $val['provider'],
                'start_date' => $val['start_date'],
                'policy_fee' => $val['policy_fee'],
                'total_premium' => $val['total_premium'],
                'premium_frequency' => $val['premium_frequency'],
                'cover_type' => $val['cover_type'],
                'life_assured' => $demolifeassured,
                'policy_owner' => $demopolicyOwner,
                'lifeassuredid' => $contatctid_id,
                'policyownerid' => $policyOwner_id,
                'policy_status' => $val['policy_status'],
                'key_contact' => $val['key_contact'],
                'contact_phone' => $val['contact_phone'],
                'contact_email' => $val['contact_email'],
                'renewal_date' => $val['renewal_date']
            ];
        }
        return $data;
    }

    public function update_policy($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('tblpolicy', $data);
    }

    public function delete_SelectedBenefit($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('tblpolicy_contact_benefits', $data);
    }

    public function client_policy($client)
    {
        $this->db->select('*');
        $this->db->from('tblpolicy');
        $this->db->where('is_deleted', 0);
        $this->db->where('customer',$client);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        $query = $query->result_array();
        foreach ($query as $val) {
            $i = 0;
            $j = 0;
            $contatctids = unserialize($val['life_assured']);
            $policyOwnerid = unserialize($val['policy_owner']);
            foreach ($contatctids as $contatctid) {
                $this->db->select('firstname,lastname,id');
                $this->db->from('contacts');
                $this->db->where('id', $contatctid);
                $query = $this->db->get();
                $ret = $query->row();
                $firstname = $ret->firstname;
                $lastname = $ret->lastname;
                $name = $firstname . " " . $lastname;
                $life_assured[$i] = $name;
                $i++;
            }
            foreach ($policyOwnerid as $policyOwners) {
                $this->db->select('firstname,lastname,id');
                $this->db->from('contacts');
                $this->db->where('id', $policyOwners);
                $query = $this->db->get();
                $ret = $query->row();
                $firstname = $ret->firstname;
                $lastname = $ret->lastname;
                $name = $firstname . " " . $lastname;
                $policyOwner[$j] = $name;
                $j++;
            }
            $demolifeassured = implode(",", $life_assured);
            $demopolicyOwner = implode(",", $policyOwner);
            $data[] = [
                'id' => $val['id'],
                'policy_number' => $val['policy_number'],
                'customer' => $this->Policy_model->getcompanyName($val['customer']),
                'provider' => $val['provider'],
                'start_date' => $val['start_date'],
                'policy_fee' => $val['policy_fee'],
                'total_premium' => $val['total_premium'],
                'premium_frequency' => $val['premium_frequency'],
                'cover_type' => $val['cover_type'],
                'life_assured' => $demolifeassured,
                'policy_owner' => $demopolicyOwner,
                'policy_status' => $val['policy_status'],
                'renewal_date' => $val['renewal_date'],
                'adviser' =>$this->Policy_model->getAdviser($val['customer'])
            ];
        }
        return $data;
    }

    public function fetchpolicystatus()
    {
        $this->db->select('*');
        $this->db->where('is_deleted',0);
        $this->db->from('tblpolicystatus');
        $query = $this->db->get();
        return $query = $query->result_array();
    }

    public function save_policyststus($data){
        $result = $this->db->insert('tblpolicystatus' , $data);
         $plastid = $this->db->insert_id();
         return $plastid;
     }

     public function delete_policyststus($data , $id)
     {
         $this->db->where('id',$id);
         return $this->db->update('tblpolicystatus' , $data);
     }
    
}