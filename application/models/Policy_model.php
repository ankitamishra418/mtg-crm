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
    public function fetchadvisordata(){
        $this->db->select('*');
        $this->db->from('tblstaff');
        $this->db->order_by('firstname','ASC');
        $query = $this->db->get();
        return $query = $query->result_array();
    }
    public function insert_add_policy_field($data)
    {
        $result = $this->db->insert('tblpolicy_benefits_field', $data);
        $lastid = $this->db->insert_id();
        return $lastid;
    }

    public function update_policy_field($id, $data)
    {
        $this->db->where('id', $id);
        $res = $this->db->update('tblpolicy_benefits_field', $data);
        if($res){ 
            
            $title = $data['form_title'];
            $sort_order = $data['sort_order'];
            $this->db->where('benefit_id', $id);
            $this->db->set('title', $title);
            $this->db->set('sort_order', $sort_order);
            $this->db->update('tblpolicy_contact_benefits');
        }
        return $id;
    }
    
    public function edit_policybenefit($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('tblpolicy_benefits_field');
        return $query->row();
    }

    public function fetch_add_policy_field()
    {
        $this->db->select('*');
        $this->db->from('tblpolicy_benefits_field');
        $this->db->where('is_deleted', 0);
        // $this->db->order_by("id", "desc");
        $this->db->order_by("sort_order", "asc");
        $query = $this->db->get();
        $query = $query->result_array();
        $data = [];
        foreach ($query as $val) {
            $data[] = [
                'id' => $val['id'],
                'is_deleted' => $val['is_deleted'],
                'form_title' => $val['form_title'],
                'sort_order' => $val['sort_order'],
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
                'beneifits_field' => unserialize($val['beneifits_field']),
                'sort_number'=> $val['sort_order']
            ];
        }
        $p = 1;
        foreach ($data as $row) {
            $sortnumber = $row['sort_number'];
            $inputtextcount = $row['count'][0]['inputtextcount'];
            $inputcheckcount = $row['count'][0]['inputcheckcount'];
            $inputradiocount = $row['count'][0]['inputradiocount'];
            $inputdropdowncount = $row['count'][0]['inputdropdowncount'];
            $inputtextareacount = $row['count'][0]['inputtextareacount'];
            $inputmultiselectcount = $row['count'][0]['inputmultiselectcount'];

            $inputcurrencycount = $row['count'][0]['inputcurrencycount'];
            $inputdatecount = $row['count'][0]['inputdatecount'];
            $inputallarray1 = [];
            $fieldSortOrder = [];
            for ($count = 1; $count <= $inputtextcount; $count++) {
                $inputallarray = $row['beneifits_field'][0]['text_' . $count];
                array_push($inputallarray1, $inputallarray);
                $fieldSortOrder[$inputallarray] = $row['beneifits_field'][0]['sortOrder_' . $p];
                $p++;
            }
            $inputallarray2 = [];
            for ($count = 1; $count <= $inputcheckcount; $count++) {
                $inputallarray = $row['beneifits_field'][0]['check_' . $count];
                array_push($inputallarray2, $inputallarray);
                $fieldSortOrder[$inputallarray] = $row['beneifits_field'][0]['sortOrder_' . $p];
                $p++;
            }
            $inputallarray3 = [];
            for ($count = 1; $count <= $inputradiocount; $count++) {
                $inputallarray = $row['beneifits_field'][0]['radio_' . $count];
                array_push($inputallarray3, $inputallarray);
                $fieldSortOrder[$inputallarray] = $row['beneifits_field'][0]['sortOrder_' . $p];
                $p++;
            }
            $inputallarray4 = [];
            for ($count = 1; $count <= $inputdropdowncount; $count++) {
                $inputallarray = $row['beneifits_field'][0]['dropdown_' . $count];
                array_push($inputallarray4, $inputallarray);
                $fieldSortOrder[$inputallarray] = $row['beneifits_field'][0]['sortOrder_' . $p]; 
                $p++;               
            }
            $inputallarray5 = [];
            for ($count = 1; $count <= $inputmultiselectcount; $count++) {
                $inputallarray = $row['beneifits_field'][0]['multiselect_' . $count];
                array_push($inputallarray5, $inputallarray);
                $fieldSortOrder[$inputallarray] = $row['beneifits_field'][0]['sortOrder_' . $p];
                $p++;
            }
            $inputallarray6 = [];
            for ($count = 1; $count <= $inputtextareacount; $count++) {
                $inputallarray = $row['beneifits_field'][0]['textarea_' . $count];
                array_push($inputallarray6, $inputallarray);
                $fieldSortOrder[$inputallarray] = $row['beneifits_field'][0]['sortOrder_' . $p];
                $p++;
            }
            $inputallarray7 = [];
            for ($count = 1; $count <= $inputcurrencycount; $count++) {
                $inputallarray = $row['beneifits_field'][0]['currencyarea_' . $count];
                array_push($inputallarray7, $inputallarray);
                $fieldSortOrder[$inputallarray] = $row['beneifits_field'][0]['sortOrder_' . $p];
                $p++;
            }
            $inputallarray8 = [];
            for ($count = 1; $count <= $inputdatecount; $count++) {
                $inputallarray = $row['beneifits_field'][0]['datearea_' . $count];
                array_push($inputallarray8, $inputallarray);
                $fieldSortOrder[$inputallarray] = $row['beneifits_field'][0]['sortOrder_' . $p];
                $p++;
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
                'fieldSortOrder' => $fieldSortOrder,
                'sortnumber' => $sortnumber,
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

    public function fetch_providersdata()
    {
        $this->db->select('*');
        $this->db->from('tblproviders_details');
        $this->db->where('is_deleted', 0);
        $this->db->order_by("providername", "ASC");
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
            $original_date = $val['lastpolicy_update'];
            if($original_date == 0000-00-00 || $original_date == NULL){
            $new_date = NULL;
            }
            else {
                $timestamp = strtotime($original_date);
                $new_date = date("d-m-Y", $timestamp);
            }
           
            $data[] = [
                'id'                            => $val['id'],
                'policy_number'                 => $val['policy_number'],
                'customer'                      => $this->getcompanyName($val['customer']),
                'provider'                      => $val['provider'],
                'start_date'                    => $val['start_date'],
                'policy_fee'                    => $val['policy_fee'],
                'total_premium'                 => $val['total_premium'],
                'premium_frequency'             => $val['premium_frequency'],
                'cover_type'                    => $val['cover_type'],
                'life_assured'                  => $demolifeassured,
                'policy_owner'                  => $demopolicyOwner,
                'policy_status'                 => $val['policy_status'],
                'renewal_date'                  => $val['renewal_date'],
                'lastpolicy_update'             => $new_date,
                'key_contact'                   => $val['key_contact'],
                'contact_phone'                 => $val['contact_phone'],
                'contact_email'                 => $val['contact_email'],
                'tagg'                          => $val['tagg'],
                'total_frequency_premium'       => $val['total_frequency_premium']
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
            $life_assured = [];
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
            $policyOwner = [];
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
            $original_date =$this->Policy_model->fetchcustomerdata($val['customer']);
            if($original_date == 0000-00-00 || $original_date == NULL){
            $new_date = NULL;
            }
            else {
                $timestamp = strtotime($original_date);
                $new_date = date("d-m-Y", $timestamp);
            }

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
                'contact_email' => $val['contact_email'],
                'renewal_date' => $val['renewal_date'],
                'client_review_date' => $new_date,
                'adviser' =>$this->Policy_model->getAdviser($val['customer'])
            ];
           
        }
        return $data;
    }
    
    public function policyData_contact($id)
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
            if(in_array($id, $policyOwnerid)){
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
                'customer' => $this->getcompanyName($val['customer']),
                'provider' => $val['provider'],
                'start_date' => $val['start_date'],
                'policy_fee' => $val['policy_fee'],
                'total_premium' => $val['total_premium'],
                'premium_frequency' => $val['premium_frequency'],
                'cover_type' => $val['cover_type'],
                'life_assured' => $demolifeassured,
                'policy_owner' => $demopolicyOwner,
                'policy_status' => $val['policy_status'],
                'contact_email' => $val['contact_email'],
                'renewal_date' => $val['renewal_date'],
                'client_review_date' => $this->fetchcustomerdata($val['customer']),
                'adviser' =>$this->getAdviser($val['customer'])
            ];
           
        }
    }    
        return $data;
    }

    public function show_Policy_Data()
    {
        $staff_id = get_staff_user_id();

        //NEW ADDED

        $this->db->select("customer_id");
        $this->db->from("tblcustomer_admins");
        $this->db->where("staff_id",$staff_id);
        $this->db->get(); 
        $query1 = $this->db->last_query();

        $this->db->select("customer");
        $this->db->from("tblpolicy");
        $this->db->where('is_deleted',0);
        $this->db->where("created_staff_id",$staff_id);
        $this->db->get(); 
        $query2 = $this->db->last_query();
        $querycustomer = $this->db->query($query1." UNION ".$query2);
        $customerdetails = $querycustomer->result_array();

        // neW eNDED
        
        foreach ($customerdetails as $customerdetail) {
            $cids[] = $customerdetail['customer_id'];
            $cids[] = $customerdetail['customer'];
        }
        $cids = array_unique($cids);
        
        foreach($cids as $cid){
        $this->db->select('*');
        $this->db->from('tblpolicy');
        $this->db->where('is_deleted', 0);
        $this->db->where('customer',$cid);
        $this->db->order_by("id", "desc");
        $custquery = $this->db->get();
        $custdataquery[] = $custquery->result_array();

        }

        foreach ($custdataquery as $query) {
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
                    'contact_email' => $val['contact_email'],
                    'renewal_date' => $val['renewal_date'],
                    'client_review_date' => $this->Policy_model->fetchcustomerdata($val['customer']),
                    'adviser' =>$this->Policy_model->getAdviser($val['customer'])
                ];
                
            }
        }
        return $data;
    }

    public function fetchcustomerdata($customer){    
        $this->db->select('client_review_date');
        $this->db->from('tblclients');
        $this->db->where('userid', $customer);
        $query = $this->db->get();
        $customerdata = $query->row();
        $client_review_date = $customerdata->client_review_date;
        return $client_review_date;
    }

    public function filterdata($filter,$check_is_admin) 
    {
        if($check_is_admin == 0)
        {
            $staff_id = get_staff_user_id();
            //NEW ADDED
            $this->db->select("customer_id");
            // $this->db->from("tblcustomer_adviser");
            $this->db->from("tblcustomer_admins");
            $this->db->where("staff_id",$staff_id);
            $query = $this->db->get(); 
            // $query1 = $this->db->last_query();
    
            // $this->db->select("customer");
            // $this->db->from("tblpolicy");
            // $this->db->where('is_deleted',0);
            // $this->db->where("created_staff_id",$staff_id);
            // $this->db->get(); 
            // $query2          = $this->db->last_query();

            // $querycustomer   = $this->db->query($query1." UNION ".$query2);
            $customerdetails = $query->result_array();
            // neW eNDED
           
            foreach ($customerdetails as $customerdetail) 
            {
                $cids[] = $customerdetail['customer_id'];
                $cids[] = $customerdetail['customer'];
            }
    
            $cids = array_unique($cids);
            foreach($cids as $cid){
                $this->db->select('*');
                $this->db->from('tblpolicy');
    
                if ($filter['customer'] != '') {
                    $this->db->join('tblcustomer_adviser', 'tblcustomer_adviser.customer_id = tblpolicy.customer');
                    $this->db->where('tblcustomer_adviser.staff_id',$filter['customer']);
                }
                if ($filter['policy_status'] != '') {
                    $this->db->where('policy_status', $filter['policy_status']);
                }
                if ($filter['contact_email'] != '') {
                    $this->db->where('contact_email', $filter['contact_email']);
                }
                if ($filter['start_date'] != '' && $filter['endDate'] != ''){ 
                    $this->db->join('tblclients', 'tblclients.userid = tblpolicy.customer');
                    $this->db->where('client_review_date >=', $filter['start_date']);
                    $this->db->where('client_review_date <=', $filter['endDate']);
                }
                if($filter['start_date'] != '' && $filter['endDate'] == ''){
                    $this->db->join('tblclients', 'tblclients.userid = tblpolicy.customer');
                    $this->db->where('client_review_date >=', $filter['start_date']);
                    $this->db->where('client_review_date <=', date('Y-m-d'));
                }
                if($filter['provider'] != ''){
                    // $this->db->join('tblproviders_details', 'tblproviders_details.providername = tblpolicy.provider');

                    $this->db->where('tblpolicy.provider',$filter['provider']);
                }
    
                $this->db->where('tblpolicy.is_deleted', 0);
                $this->db->where('tblpolicy.customer',$cid);
                $this->db->order_by("tblpolicy.id", "desc");
                $custquery       = $this->db->get();
              
                $custdataquery[] = $custquery->result_array();
                
            }
            
            
            foreach ($custdataquery as $query) 
            {
               
                foreach ($query as $val) {
                    
                     $i = 0;
                    $j = 0;
                    $life_assured = [];
                    $policyOwner = [];
                    $contatctids   = unserialize($val['life_assured']);
                    $policyOwnerid = unserialize($val['policy_owner']);

                    foreach ($contatctids as $contatctid) {
                        $this->db->select('firstname,lastname,id');
                        $this->db->from('contacts');
                        $this->db->where('id', $contatctid);
                        $query            = $this->db->get();
                        $ret              = $query->row();
                        $firstname        = $ret->firstname;
                        $lastname         = $ret->lastname;
                        $name             = $firstname . " " . $lastname;
                        $life_assured[$i] = $name;
                        $i++;
                    }
                   
                    foreach ($policyOwnerid as $policyOwners) {
                        $this->db->select('firstname,lastname,id');
                        $this->db->from('contacts');
                        $this->db->where('id', $policyOwners);
                        $query           = $this->db->get();
                        $ret             = $query->row();
                        $firstname       = $ret->firstname;
                        $lastname        = $ret->lastname;
                        $name            = $firstname . " " . $lastname;
                        $policyOwner[$j] = $name;
                        $j++;
                     
                    }
                    $demolifeassured = implode(",", $life_assured);
                    $demopolicyOwner = implode(",", $policyOwner);
                  
                    $data[] = [
                        'id'                 => $val['id'],
                        'policy_number'      => $val['policy_number'],
                        'userid'             => $val['customer'],
                        'customer'           => $this->Policy_model->getcompanyName($val['customer']),
                      
                        'provider'           => $val['provider'],
                        'start_date'         => $val['start_date'],
                        'policy_fee'         => $val['policy_fee'],
                        'total_premium'      => $val['total_premium'],
                        'premium_frequency'  => $val['premium_frequency'],
                        'cover_type'         => $val['cover_type'],
                        'life_assured'       => $demolifeassured,
                        'policy_owner'       => $demopolicyOwner,
                        'ird_number'         => $val['ird_number'],
                        'pir'                => $val['pir'],
                        'policy_status'      => $val['policy_status'],
                        'contact_email'      => $val['contact_email'],
                        'renewal_date'       => $val['renewal_date'],
                        'client_review_date' => $new_date,
                        'adviser'            => $this->Policy_model->getAdviser($val['customer'])
                    ];
                }
            }
           
            return $data;
        }
    
        if($check_is_admin == 1)
        {
            $this->db->select('*');
            $this->db->from('tblpolicy');
            if ($filter['customer'] != '') 
            {
                $this->db->join('tblcustomer_adviser', 'tblcustomer_adviser.customer_id = tblpolicy.customer');
                $this->db->where('tblcustomer_adviser.staff_id',$filter['customer']);
            }
            if ($filter['policy_status'] != '') 
            {
                $this->db->where('tblpolicy.policy_status', $filter['policy_status']);
            }
            if ($filter['contact_email'] != '') {
                $this->db->where('contact_email', $filter['contact_email']);
            }
            // if ($filter['start_date'] != '' && $filter['endDate'] != ''){ 
            //    $this->db->join('tblclients', 'tblclients.userid = tblpolicy.customer');
            //     $this->db->where('client_review_date >=', $filter['start_date']);
            //     $this->db->where('client_review_date <=', $filter['endDate']);
            // }
            // if($filter['start_date'] != '' && $filter['endDate'] == ''){
            //     $this->db->join('tblclients', 'tblclients.userid = tblpolicy.customer');
            //     $this->db->where('client_review_date >=', $filter['start_date']);
            //     $this->db->where('client_review_date <=', date('Y-m-d'));
            // }
            if($filter['provider'] != ''){
                $this->db->where('provider',$filter['provider']);
            }
        
            $this->db->where('is_deleted', 0);
            $query = $this->db->get();
            $query = $query->result_array();

            foreach ($query as $val) {
                $i = 0;
                $j = 0;
                $life_assured = [];
                $policyOwner = [];
                $contatctids = unserialize($val['life_assured']);
                $policyOwnerid = unserialize($val['policy_owner']);
                foreach ($contatctids as $contatctid) 
                {
                    $this->db->select('firstname,lastname,id');
                    $this->db->from('contacts');
                    $this->db->where('id', $contatctid);
                    $query            = $this->db->get();
                    $ret              = $query->row();
                    $firstname        = $ret->firstname;
                    $lastname         = $ret->lastname;
                    $name             = $firstname . " " . $lastname;
                    $life_assured[$i] = $name;
                    $i++;
                }
                foreach ($policyOwnerid as $policyOwners) 
                {
                    $this->db->select('firstname,lastname,id');
                    $this->db->from('contacts');
                    $this->db->where('id', $policyOwners);
                    $query           = $this->db->get();
                    $ret             = $query->row();
                    $firstname       = $ret->firstname;
                    $lastname        = $ret->lastname;
                    $name            = $firstname . " " . $lastname;
                    $policyOwner[$j] = $name;
                    $j++;
                }
                $demolifeassured = implode(",", $life_assured);
                $demopolicyOwner = implode(",", $policyOwner);
                $data[] = [
                    'id'                 => $val['id'],
                    'policy_number'      => $val['policy_number'],
                    'userid'             => $val['customer'],
                    'customer'           => $this->Policy_model->getcompanyName($val['customer']),
                    'provider'           => $val['provider'],
                    'start_date'         => $val['start_date'],
                    'policy_fee'         => $val['policy_fee'],
                    'total_premium'      => $val['total_premium'],
                    'premium_frequency'  => $val['premium_frequency'],
                    'cover_type'         => $val['cover_type'],
                    'life_assured'       => $demolifeassured,
                    'policy_owner'       => $demopolicyOwner,
                    'ird_number'         => $val['ird_number'],
                    'pir'                => $val['pir'],
                    'policy_status'      => $val['policy_status'],
                    'contact_email'      => $val['contact_email'],
                    'renewal_date'       => $val['renewal_date'],
                    'client_review_date' => $this->Policy_model->fetchcustomerdata($val['customer']),
                    'adviser'            => $this->Policy_model->getAdviser($val['customer'])
                ];
            }
            return $data;
        }
    }

    public function policyData($check_is_admin)
    {

        if($check_is_admin == 0){
            $staff_id = get_staff_user_id();
            //NEW ADDED

            $this->db->select("customer_id");
            // $this->db->from("tblcustomer_adviser");
            $this->db->from("tblcustomer_admins");
            $this->db->where("staff_id",$staff_id);
            $query = $this->db->get(); 
            // $query1 = $this->db->last_query();

            // $this->db->select("customer");
            // $this->db->from("tblpolicy");
            // $this->db->where('is_deleted',0);
            // $this->db->where("created_staff_id",$staff_id);
            // $this->db->get(); 
            // $query2 = $this->db->last_query();
            
            // $querycustomer = $this->db->query($query1." UNION ".$query2);

            $customerdetails = $query->result_array();
            // neW eNDED
            // echo $this->db->last_query();
            // exit;
            foreach ($customerdetails as $customerdetail) {
                $cids[] = $customerdetail['customer_id'];
                // $cids[] = $customerdetail['customer'];
            }

            $cids = array_unique($cids);
            foreach($cids as $cid){
                $this->db->select('*');
                $this->db->from('tblpolicy');
                $this->db->where('is_deleted', 0);
                $this->db->where('customer',$cid);
                $this->db->order_by("id", "desc");
                $custquery = $this->db->get();
                $custdataquery[] = $custquery->result_array();
            }
            
            foreach ($custdataquery as $query) {
                foreach ($query as $val) {
                    $i = 0;
                    $j = 0;
                    $contatctids = unserialize($val['life_assured']);
                    $policyOwnerid = unserialize($val['policy_owner']);
                   $life_assured = [] ;
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
                   
                    $policyOwner = [];
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
                        'id'                 => $val['id'],
                        'policy_number'      => $val['policy_number'],
                        'userid'             => $val['customer'],
                        'customer'           => $this->Policy_model->getcompanyName($val['customer']),
                        'provider'           => $val['provider'],
                        'start_date'         => $val['start_date'],
                        'policy_fee'         => $val['policy_fee'],
                        'total_premium'      => $val['total_premium'],
                        'premium_frequency'  => $val['premium_frequency'],
                        'ird_number'         => $val['ird_number'],
                        'pir'                => $val['pir'],
                        'cover_type'         => $val['cover_type'],
                        'life_assured'       => $demolifeassured,
                        'policy_owner'       => $demopolicyOwner,
                        'ird_number'         => $val['ird_number'],
                        'pir'                => $val['pir'],
                        'policy_status'      => $val['policy_status'],
                        'contact_email'      => $val['contact_email'],
                        'renewal_date'       => $val['renewal_date'],
                        'client_review_date' => $new_date,
                        // 'client_review_date' => $new_date,
                        'adviser'            => $this->Policy_model->getAdviser($val['customer'])
                    ];
                }
            }
            return $data;
        }

        if($check_is_admin == 1){
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

            $life_assured = [];
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
            $policyOwner = [];
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

            $original_date =$this->Policy_model->fetchcustomerdata($val['customer']);
            if($original_date == 0000-00-00 || $original_date == NULL){
            $new_date = NULL;
            }
            else {
                $timestamp = strtotime($original_date);
                $new_date = date("d-m-Y", $timestamp);
            }
          
            $data[] = [
                'id'                 => $val['id'],
                'policy_number'      => $val['policy_number'],
                'userid'             => $val['customer'],
                'customer'           => $this->Policy_model->getcompanyName($val['customer']),
                'provider'           => $val['provider'],
                'start_date'         => $val['start_date'],
                'policy_fee'         => $val['policy_fee'],
                'total_premium'      => $val['total_premium'],
                'premium_frequency'  => $val['premium_frequency'],
                'cover_type'         => $val['cover_type'],
                'life_assured'       => $demolifeassured,
                'policy_owner'       => $demopolicyOwner,
                'ird_number'         => $val['ird_number'],
                'pir'                => $val['pir'],
                'policy_status'      => $val['policy_status'],
                'contact_email'      => $val['contact_email'],
                'renewal_date'       => $val['renewal_date'],
                'client_review_date' => $new_date,
                'adviser'            => $this->Policy_model->getAdviser($val['customer'])
            ];
        }
        return $data;
        }
        
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
        $this->db->order_by('sort_order', 'asc');
        $query = $this->db->get();
        $query = $query->result_array();
        foreach ($query as $val) {
            $data[] = [
                'id' => $val['id'],
                'policy_id' => $val['policy_id'],
                'contact_id' => $this->getContactName($val['contact_id']),
                'title' => $val['title'],
                'policy_benefits' => unserialize($val['policy_benefits']),
                'sort_order' => $val['sort_order'],
                'updated_at' => $val['updated_at']
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
        $this->db->from('tblcustomer_adviser');
        $this->db->where('customer_id', $id);
        $query = $this->db->get();
        $query  = $query->result_array();
        for($i=0; $i<count($query); $i++){
            $data[] = $this->getStafName($query[$i]['staff_id']);
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
        $data = $this->Policy_model->fetchBenefitfieldBytitle($query[0]['title']);
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
            $contatctid_id   = implode(",", $contatctids);
            $policyOwner_id  = implode(",", $policyOwnerid);
            $data = [
                'id'                            => $val['id'],
                'policy_number'                 => $val['policy_number'],
                'customer'                      => $this->Policy_model->getcompanyName($val['customer']),
                'customerid'                    => $val['customer'],
                'provider'                      => $val['provider'],
                'start_date'                    => $val['start_date'],
                'policy_fee'                    => $val['policy_fee'],
                'total_premium'                 => $val['total_premium'],
                'premium_frequency'             => $val['premium_frequency'],
                'cover_type'                    => $val['cover_type'],
                'life_assured'                  => $demolifeassured,
                'policy_owner'                  => $demopolicyOwner,
                'lifeassuredid'                 => $contatctid_id,
                'policyownerid'                 => $policyOwner_id,
                'policy_status'                 => $val['policy_status'],
                'key_contact'                   => $val['key_contact'],
                'contact_phone'                 => $val['contact_phone'],
                'contact_email'                 => $val['contact_email'],
                'renewal_date'                  => $val['renewal_date'],
                'lastpolicy_update'             => $val['lastpolicy_update'],
                'tagg'                          => $val['tagg'],
                'total_frequency_premium'       => $val['total_frequency_premium'],
                'ird_number'                    => $val['ird_number'],
                'pir'                           => $val['pir'],
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
            $life_assured = [];
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
            $policyOwner = [];
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
                'ird_number' => $val['ird_number'],
                'pir' => $val['pir'],
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

     public function update_sortedOrderbytitle($data,$id)
     {
        
        $this->db->where('id',$id);
        $this->db->update('tblpolicy_contact_benefits',$data);
     }
     
     public function policyNumberExists($policy_number)
     {
         $this->db->select('*'); 
         $this->db->from('tblpolicy');
         $this->db->where('policy_number',$policy_number);
         $this->db->where('is_deleted',0);
         $query = $this->db->get();
         $result = $query->result_array();
         return $result;
     }

     public function fetch_customerData($id)
    {
        $this->db->select('*');
        $this->db->from('tblclients');
        $this->db->where('userid' , $id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result ;
    }

    public function clients_policy($client)
    {
       
        $this->db->select('*');
        $this->db->from('tblpolicy');
        $this->db->where('policy_status','In-force');
        $this->db->where('is_deleted', 0);
        $this->db->where('customer',$client);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        $query = $query->result_array();

        
        foreach ($query as $val) {
            $i = 0;
            $j = 0;
            $life_assured = [];
            $life_assureds = [];
            $policyOwner = [];
            $contatctids = unserialize($val['life_assured']);
            sort($contatctids); 
            $policyOwnerid = unserialize($val['policy_owner']);
            foreach ($contatctids as $contatctid) {
                $this->db->select('firstname,lastname,id,age');
                $this->db->from('contacts');
                $this->db->where('id', $contatctid);
                $query = $this->db->get();
                $ret = $query->row();
                // $firstname = $ret->firstname;
                // $lastname = $ret->lastname;
                // $name = $firstname . " " . $lastname;
                // $life_assured[$i] = $name;
                $contact['id'] = $ret->id;
                $contact['firstname'] = $ret->firstname;
                $contact['lastname'] = $ret->lastname;
                $contact['age']     = $ret->age;
                $life_assureds[$i] = $contact;
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
            usort($life_assureds, function($a, $b) {
                return $b['age'] - $a['age'];
            });

            $life_assured =[];
            $contactid = [];
            foreach ($life_assureds as $lifeassured) {
                $contactid[] =  $lifeassured['id'];
                $life_assured[] = $lifeassured['firstname']." ".$lifeassured['lastname'];
            }

            $demolifeassured = implode(",", $life_assured);
            $demopolicyOwner = implode(",", $policyOwner);

            // echo $demolifeassured;
            $data[] = [
                'id' => $val['id'],
                'policy_number' => $val['policy_number'],
                'customer' => $this->Policy_model->getcompanyName($val['customer']),
                'provider' => $val['provider'],
                'start_date' => $val['start_date'],
                'policy_fee' => $val['policy_fee'],
                'total_premium' => $val['total_premium'],
                'premium_amount' => $val['total_frequency_premium'],

                'premium_frequency' => $val['premium_frequency'],
                'cover_type' => $val['cover_type'],
                'life_assured' => $demolifeassured,
                // 'life_assuredid' => $contatctids,
                'life_assuredid' => $contactid,
                'policy_owner' => $demopolicyOwner,
                'policy_status' => $val['policy_status'],
                'renewal_date' => $val['renewal_date'],
                'adviser' =>$this->Policy_model->getAdviser($val['customer'])
            ];
        }
 
        return $data;
    }

    public function fetch_policybenefits($policy_id)
    {
        $this->db->select('*');
        $this->db->from('tblpolicy_contact_benefits');
        $this->db->where('is_deleted', 0);
        $this->db->where('policy_id', $policy_id);
        // $this->db->order_by('contact_id', 'asc');
        // $this->db->order_by('id', 'DESC'); //added march 29
        $this->db->order_by('sort_order', 'ASC');
        $query = $this->db->get();
        $query = $query->result_array();
        foreach ($query as $val) 
        {
            $data[] = [
                'id' => $val['id'],
                'policy_id' => $val['policy_id'],
                'contact_id' => $this->getContactName($val['contact_id']),
                'title' => $val['title'],
                'policy_benefits' => unserialize($val['policy_benefits']),
                'sort_order' => $val['sort_order']
            ];
        }
        return $data;
    }

    public function getLife_assured($id){
        $this->db->select('life_assured,id');
        $this->db->from('tblpolicy');
        $this->db->where('is_deleted' , 0);
        $this->db->where('customer' , $id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result ;
    }

    public function lifeAssuredCustomerData($data){
        $this->db->select('dob,firstname, lastname, email, phonenumber, smoker, residential_address , residential_city, residential_state, residential_zipcode, residential_country, dependent');
        $this->db->from('tblcontacts');
        $this->db->where('id' , $data);
        $query = $this->db->get();
        $result = $query->result_array();
        foreach ($result as $country){
            
            $data = [
                'dob' => $country['dob'],
                'firstname' => $country['firstname'],
                'lastname' => $country['lastname'],
                'email' => $country['email'],
                'phonenumber' => $country['phonenumber'],
                'smoker' => $country['smoker'],
                'residential_address' => $country['residential_address'],
                'residential_city' => $country['residential_city'],
                'residential_state' => $country['residential_state'],
                'residential_zipcode' => $country['residential_zipcode'],
                'residential_country' =>$this->Policy_model->assuredMemberCountry($country['residential_country']),
                'dependent'=>$country['dependent']
            ];
        }
       
        return $data ;
    }

    public function assuredMemberCountry($country_id){
        $this->db->select('short_name');
        $this->db->from('tblcountries');
        $this->db->where('country_id',$country_id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function fetchBenefitGrouping(){
        $this->db->select('*');
        $this->db->from('tblpolicy_benefitgrouping');
        $this->db->where("is_deleted" , 0);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function save_BenefitGrouping($data)
    {
        $this->db->insert('tblpolicy_benefitgrouping',$data);
        $lastID = $this->db->insert_id();
        return $lastID ;
    }

    public function delete_BenefitGrouping($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('tblpolicy_benefitgrouping', $data);
    }

    public function insertPolicyRecord($policyRecord){
       
        if($policyRecord > 0){

            $this->db->select('*');
            $this->db->where('policy_number', trim($policyRecord[1]));
            $query = $this->db->get('tblpolicy');
            $response = $query->result_array();

           if($response[0]['policy_number']== trim($policyRecord[1])){
            policyLogActivity($response[0]['policy_number'] . ": Exist in table");
           }

            if(count($response)==0){

                if( !empty(trim($policyRecord[0]))   &&  !empty(trim($policyRecord[1]))   &&  !empty(trim($policyRecord[2])) 
                &&  !empty(trim($policyRecord[3]))   &&  !empty(trim($policyRecord[4]))   &&  !empty(trim($policyRecord[5])) 
                &&  !empty(trim($policyRecord[6]))   &&  !empty(trim($policyRecord[7]))   &&  !empty(trim($policyRecord[8])) 
                &&  !empty(trim($policyRecord[9]))   &&  !empty(trim($policyRecord[10]))  &&  !empty(trim($policyRecord[11]))
                &&  !empty(trim($policyRecord[12]))  &&  !empty(trim($policyRecord[13]))  &&  !empty(trim($policyRecord[14])) 
                &&  !empty(trim($policyRecord[15]))
                ){

                    if($response[0]['policy_number'] != trim($policyRecord[1])){
                    
                        if(strtolower(trim($policyRecord[6])) == 'monthly'){
                            $frequency = 12;
                            $total = trim($policyRecord[4]) + trim($policyRecord[5]);
                            $totalPpremium = $total * $frequency;
                        }

                        if(strtolower(trim($policyRecord[6])) == 'weekly'){
                            $frequency = 52;
                            $total = trim($policyRecord[4]) + trim($policyRecord[5]);
                            $totalPpremium = $total * $frequency;
                        }

                        if(strtolower(trim($policyRecord[6])) == 'half yearly'){
                            $frequency = 2;
                            $total = trim($policyRecord[4]) + trim($policyRecord[5]);
                            $totalPpremium = $total * $frequency;
                        }

                        if(strtolower(trim($policyRecord[6])) == 'quarterly'){
                            $frequency = 3;
                            $total = trim($policyRecord[4]) + trim($policyRecord[5]);
                            $totalPpremium = $total * $frequency;
                        }
                    
                        $importDated=date('y-m-d');
                        $data = array(
                            'customer'                  => trim($policyRecord[0]),
                            'policy_number'             => trim($policyRecord[1]),
                            'provider'                  => trim($policyRecord[2]),
                            'start_date'                => trim($policyRecord[3]),
                            'policy_fee'                => trim($policyRecord[4]),
                            'total_premium'             => $totalPpremium,
                            'total_frequency_premium'   => trim($policyRecord[5]),
                            'premium_frequency'         => trim($policyRecord[6]),
                            'cover_type'                => trim($policyRecord[7]),
                            'life_assured'              => $this->Policy_model->getcontactId(trim($policyRecord[8])),
                            'policy_owner'              => $this->Policy_model->getcontactIdOwner(trim($policyRecord[9])),
                            'renewal_date'              => trim($policyRecord[10]),
                            'policy_status'             => trim($policyRecord[11]),
                            'key_contact'               => trim($policyRecord[12]),
                            'contact_email'             => trim($policyRecord[13]),
                            'contact_phone'             => trim($policyRecord[14]),
                            'created_staff_id'          => trim($policyRecord[15]),
                            'data_import_date'          => $importDated,
                        );
                  
                        $result =  $this->db->insert('tblpolicy', $data);
                        if($result){
                            policyLogActivity($data['policy_number'] . ": Policy imported successfully");
                        }
                    }
                }
                else{
                    policyLogActivity(trim($policyRecord[1]) .': Policy not imported successfully due to empty column');
                }
            }
        }
    }

    public function getcontactId($assName){
        $expAssured = (explode(",",$assName));
        $dataAss = [];
        $i = 0;
        foreach($expAssured as $expAssureds){
            $dataAss[$i] = (explode(" ",$expAssureds));
            
            $name['firstname'] = trim($dataAss[$i][0]);
            $name['lastname'] = trim($dataAss[$i][1]);

            $i++;

            $this->db->select('id');
            $this->db->from('tblcontacts');
            $this->db->where("firstname" ,$name['firstname']);
            $this->db->where("lastname" ,$name['lastname']);
            $query = $this->db->get();
            $result= $query->result_array();
            $id= $result[0];     

            foreach($id as $ids){
                $sendid [] = $ids;
            }
        }
       $data_Assured = serialize($sendid);       
       return $data_Assured;
    }

    public function getcontactIdOwner($assOwnerName){
        $expAssuredOwner = (explode(",",$assOwnerName));
        $dataAss = [];
        $i = 0;
        foreach($expAssuredOwner as $expAssureds){
            $dataAss[$i] = (explode(" ",$expAssureds));
            
            $name['firstname'] = trim($dataAss[$i][0]);
            $name['lastname'] = trim($dataAss[$i][1]);

            $i++;

            $this->db->select('id');
            $this->db->from('tblcontacts');
            $this->db->where("firstname" ,$name['firstname']);
            $this->db->where("lastname" ,$name['lastname']);
            $query = $this->db->get();
            $result= $query->result_array();
            $id= $result[0];     

            foreach($id as $ids){
                $sendid [] = $ids;
            }
        }
       $data_AssuredOwner = serialize($sendid);       
       return $data_AssuredOwner;
    }

    public function policyLog_Activity($message){
        $staff_id = get_staff_user_id();
        $data = [
            'description'   => $message,
            'staffid'       => $staff_id,
        ];
        $this->db->insert('tblactivity_log_policy',$data);
        $lastID = $this->db->insert_id();
        return $lastID ;
    }

    public function activity_log_policy(){
        $this->db->select('firstname,lastname,description,date');
        $this->db->from('tblactivity_log_policy');
        $this->db->join('tblstaff', 'tblstaff.staffid = tblactivity_log_policy.staffid', 'inner');
        $query  = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function get_customer_groups()
    {
        $this->db->select('*');
        $this->db->from('tblcustomers_groups');
        $query  = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function provider_name($provider_id){
        $this->db->select('providername');
        $this->db->from('tblproviders_details');
        $this->db->where('id' , $provider_id);
        $query = $this->db->get();
        $result = $query->row();
        return $result->providername;
    }
    //march 11
    public function fetch_policyNumber()
    {
        $this->db->select('policy_number,');
        $this->db->from('tblpolicy');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function fetch_policyAdvider()
    {
        $this->db->select('customer');
        $this->db->from('tblpolicy');
        $query = $this->db->get();
        $result = $query->result_array();
        $result2 = [];
        $result3 = [];
        foreach($result as $policyDatanum)
        {
            $result2[] = $policyDatanum['customer'];
        }
        $result3 = array_unique($result2);
        $advisor = [];

        $k = 0;
        foreach($result3 as $advisorResult)
        {
            $advisor[$k]['name'] = $this->Policy_model->getAdviser($advisorResult);
            $advisor[$k]['id'] = $advisorResult;
            $k++;
        }
        return $advisor;
    }

    public function fetchPolicyNumberFromAdvider($searchedAdvisor)
    {
        $this->db->select('policy_number');
        $this->db->from('tblpolicy');
        $this->db->where('customer', $searchedAdvisor);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }


    public function show_PolicyDatanew($policyNumberArray)
    {
        $this->db->select('*');
        $this->db->from('tblpolicy');
        $this->db->where('is_deleted', 0);
        $this->db->where_in('policy_number',$policyNumberArray);// extra where condition for search
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        $query = $query->result_array();
        foreach ($query as $val)
        {
            $i = 0;
            $j = 0;
            $contatctids = unserialize($val['life_assured']);
            $policyOwnerid = unserialize($val['policy_owner']);
            $life_assured = [];
            foreach ($contatctids as $contatctid)
            {
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
            $policyOwner = [];
            foreach ($policyOwnerid as $policyOwners)
            {
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
            $original_date =$this->Policy_model->fetchcustomerdata($val['customer']);
            if($original_date == 0000-00-00 || $original_date == NULL)
            {
                $new_date = NULL;
            }
            else
            {
                $timestamp = strtotime($original_date);
                $new_date = date("d-m-Y", $timestamp);
            }

            $data[] = [
            'id' => $val['id'],
            'policy_number' => $val['policy_number'],
            'customer' => $this->Policy_model->getcompanyName($val['customer']),
            'customer_id' => $val['customer'],
            'provider' => $val['provider'],
            'start_date' => $val['start_date'],
            'policy_fee' => $val['policy_fee'],
            'total_premium' => $val['total_premium'],
            'premium_frequency' => $val['premium_frequency'],
            'cover_type' => $val['cover_type'],
            'life_assured' => $demolifeassured,
            'policy_owner' => $demopolicyOwner,
            'policy_status' => $val['policy_status'],
            'contact_email' => $val['contact_email'],
            'renewal_date' => $val['renewal_date'],
            'client_review_date' => $new_date,
            'adviser' =>$this->Policy_model->getAdviser($val['customer'])
            ];
        }
        return $data;
    }


    public function show_Policy_Data_new($policyNumberArray)// when permission own
    {
        $staff_id = get_staff_user_id();
        //NEW ADDED
        $this->db->select("customer_id");
        $this->db->from("tblcustomer_admins");
        $this->db->where("staff_id",$staff_id);
        $this->db->get();
        $query1 = $this->db->last_query();

        $this->db->select("customer");
        $this->db->from("tblpolicy");
        $this->db->where('is_deleted',0);
        $this->db->where("created_staff_id",$staff_id);

        $this->db->get();
        $query2 = $this->db->last_query();
        $querycustomer = $this->db->query($query1." UNION ".$query2);
        $customerdetails = $querycustomer->result_array();

        // neW eNDED
        foreach ($customerdetails as $customerdetail)
        {
            $cids[] = $customerdetail['customer_id'];
            $cids[] = $customerdetail['customer'];
        }
        $cids = array_unique($cids);

        foreach($cids as $cid)
        {
            $this->db->select('*');
            $this->db->from('tblpolicy');
            $this->db->where('is_deleted', 0);
            $this->db->where('customer',$cid);
            $this->db->where_in('policy_number',$policyNumberArray);
            $this->db->order_by("id", "desc");
            $custquery = $this->db->get();
            $custdataquery[] = $custquery->result_array();
        }

        foreach ($custdataquery as $query)
        {
            foreach ($query as $val)
            {
                $i = 0;
                $j = 0;
                $contatctids = unserialize($val['life_assured']);
                $policyOwnerid = unserialize($val['policy_owner']);
                foreach ($contatctids as $contatctid)
                {
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
                foreach ($policyOwnerid as $policyOwners)
                {
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
                'customer' => $val['customer'],
                'provider' => $val['provider'],
                'start_date' => $val['start_date'],
                'policy_fee' => $val['policy_fee'],
                'total_premium' => $val['total_premium'],
                'premium_frequency' => $val['premium_frequency'],
                'cover_type' => $val['cover_type'],
                'life_assured' => $demolifeassured,
                'policy_owner' => $demopolicyOwner,
                'policy_status' => $val['policy_status'],
                'contact_email' => $val['contact_email'],
                'renewal_date' => $val['renewal_date'],
                'client_review_date' => $this->Policy_model->fetchcustomerdata($val['customer']),
                'adviser' =>$this->Policy_model->getAdviser($val['customer'])
                ];
            }
        }
        return $data;
    }
    public function fetchfirstcustomerid($firstNamePolicy)
    {
        $this->db->select('userid');
        $this->db->from('tblcontacts');
        $this->db->like('firstname', $firstNamePolicy);
        $query = $this->db->get();
        $result1 = $query->result_array();
        $result2 = [];
        foreach ($result1 as $row) {
            $result2[] = $row['userid'];
        }
        $result = [];
        if (!empty($result2)) {
            $this->db->select('policy_number');
            $this->db->from('tblpolicy');
            $this->db->where_in('customer', $result2); 
            $query = $this->db->get();
            $result = $query->result_array();
        }
        return $result;
    }
    
    public function fetchlastcustomerid($lastNamepolicy)
    {
        $this->db->select('userid');
        $this->db->from('tblcontacts');
        $this->db->like('lastname',$lastNamepolicy);
        $query = $this->db->get();
        $result1 = $query->result_array();
        $result2 = [];
        foreach ($result1 as $row) {
            $result2[] = $row['userid'];
        }
        $result = [];
        if (!empty($result2)) {
            $this->db->select('policy_number');
            $this->db->from('tblpolicy');
            $this->db->where_in('customer', $result2); 
            $query = $this->db->get();
            $result = $query->result_array();
        }
        return $result;
    }
    
    
    public function fetchfirst_lastcustomerid($firstNamePolicy,$lastNamePolicy)
    {
        $this->db->select('userid');
        $this->db->from('tblcontacts');
        $this->db->where("firstname LIKE '%$firstNamePolicy%' AND lastname LIKE '%$lastNamePolicy%'");
        $query = $this->db->get();
        $result1 = $query->result_array();
        $result2 = [];
        foreach ($result1 as $row) {
            $result2[] = $row['userid'];
        }
        $result = [];
        if (!empty($result2)) {
            $this->db->select('policy_number');
            $this->db->from('tblpolicy');
            $this->db->where_in('customer', $result2); 
            $query = $this->db->get();
            $result = $query->result_array();
        }
        return $result;
    }
}
