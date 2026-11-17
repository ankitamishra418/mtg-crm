<?php

use app\services\projects\AllProjectsGantt;
use app\services\projects\Gantt;
use app\services\projects\HoursOverviewChart;

defined('BASEPATH') or exit('No direct script access allowed');

class Policy extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('projects_model');
        $this->load->model('Policy_model');
        $this->load->model('currencies_model');
        $this->load->helper('date');
        $this->load->library('session');
    }
    public function index()
    {
        //$this->load->view('admin/policy/addpolicy');
    }
    public function addPolicy($client_id = null)
    {
        $this->load->model('Policy_model');
        $data['secondycontact'] = $this->Policy_model->fetchSecondaryContact();
        $data['companey'] = $this->Policy_model->fetchCompaney();
        $data['providers'] = $this->Policy_model->fetch_providers();
        $data['premiumfrequency'] = $this->Policy_model->fetchPremiumFrequency();
        $data['covertype'] = $this->Policy_model->fetchcovertype();
        $data['policystatus'] = $this->Policy_model->fetchpolicystatus();
        $data['customer_groups'] = $this->Policy_model->get_customer_groups();

        if ($client_id) {
            $data['client_id'] = $client_id;
        }
        $this->load->view('admin/policy/addpolicy', $data);
    }

    public function savepolicy($client_id = null)
    {
        $target = serialize($this->input->post('life_assured'));
        $targets = serialize($this->input->post('policy_owner'));
        $data = [
            'customer' => $this->input->post('customer'),
            'policy_number' => $this->input->post('policy_number'),
            'provider' => $this->input->post('provider'),
            'start_date' => $this->input->post('start_date'),
            'policy_fee' => $this->input->post('policy_fee'),
            'total_premium' => $this->input->post('total_premium'),
            'premium_frequency' => $this->input->post('premium_frequency'),
            'cover_type' => $this->input->post('cover_type'),
            'life_assured' => $target,
            'policy_owner' => $targets,
            'renewal_date' => $this->input->post('renewal_date'),
            'policy_status' => $this->input->post('policy_status'),
            'key_contact' => $this->input->post('key_contact'),
            'contact_email' => $this->input->post('contact_email'),
            'contact_phone' => $this->input->post('contact_phone'),
            'lastpolicy_update' => $this->input->post('lastpolicy_update'),
            'tagg' => $this->input->post('tagg'),
            'created_staff_id' => get_staff_user_id(),
            'total_frequency_premium' => $this->input->post('total_frequency_premium'),
            'ird_number' => $this->input->post('ird_number'),
            'pir' => $this->input->post('pir')

        ];
        $this->load->model('Policy_model');
        $lastid = $this->Policy_model->addpolicy($data);
        log_activity('New Policy Created [ID: ' . $lastid . ']');
        set_alert('success', 'Policy Added Successfully');
        if ($client_id) {
            redirect(admin_url('Policy/showmulticontact/' . $lastid . '/' . $client_id));
        }
        redirect(admin_url('Policy/showmulticontact/' . $lastid));
    }

    public function showmulticontact($lastid, $client_id = null)
    {
        $client_id = $this->uri->segment(5);

        $benifitss = $this->Policy_model->fetch_multicontactdata($lastid);
        $benifitId = $benifitss[0]['customer'];

        if ($client_id) {
            $data['client_id'] = $client_id;
        }
        $this->load->model('Policy_model');
        $data['data'] = $benifitss; // $this->Policy_model->fetch_multicontactdata($lastid);
        $data['benefits'] = $this->Policy_model->fetch_add_policy_field();
        $data['selectedbenefits'] = $this->Policy_model->fetch_policybenefit($lastid);
        $data['lastid'] = $lastid;
        $data['benifitsID'] = $benifitId;
        $this->load->view('admin/policy/multicontact', $data);
    }

    public function policyBenefits()
    {
        $data['grouping_benefitData'] = $this->Policy_model->fetchBenefitGrouping();
        $this->load->view('admin/policy/addpolicybenefits', $data);
    }

    public function addPolicyBenefitsfield()
    {

        $form_fields = $this->input->post();
        $benefit_group = $this->input->post('benefit_group');
        $sorted_number = $this->input->post('sorted_number');
        $benefits_title = $this->input->post('benefits_title');
        $inputdropdowncount = $this->input->post('inputdropdowncount');
        $inputmultiselectcount = $this->input->post('inputmultiselectcount');
        $inputcheckcount = $this->input->post('inputcheckcount');
        $inputradiocount = $this->input->post('inputradiocount');
        $count = [
            'inputtextcount' => $form_fields['inputtextcount'],
            'inputcheckcount' => $form_fields['inputcheckcount'],
            'inputradiocount' => $form_fields['inputradiocount'],
            'inputdropdowncount' => $form_fields['inputdropdowncount'],
            'inputmultiselectcount' => $form_fields['inputmultiselectcount'],
            'inputtextareacount' => $form_fields['inputtextareacount'],
            'inputcurrencycount' => $form_fields['inputcurrencycount'],
            'inputdatecount' => $form_fields['inputdatecount']

        ];
        for ($i = 1; $i <= $inputdropdowncount; $i++) {
            $count['count_dropdown_option' . $i] = $form_fields['count_option' . $i];
            unset($form_fields['count_option' . $i], $form_fields['number_option' . $i]);
        }
        for ($i = 1; $i <= $inputmultiselectcount; $i++) {
            $count['count_multi_option' . $i] = $form_fields['multicount_option' . $i];
            unset($form_fields['multicount_option' . $i], $form_fields['number_moption' . $i]);
        }
        for ($i = 1; $i <= $inputcheckcount; $i++) {
            $count['count_check_option' . $i] = $form_fields['checkboxcount_option' . $i];
            unset($form_fields['checkboxcount_option' . $i], $form_fields['number_check_option' . $i]);
        }
        for ($i = 1; $i <= $inputradiocount; $i++) {
            $count['count_radio_option' . $i] = $form_fields['radio_count_option' . $i];
            unset($form_fields['radio_count_option' . $i], $form_fields['number_radio_option' . $i]);
        }
        unset($form_fields['benefits_title'], $form_fields['inputtextcount'], $form_fields['inputcheckcount'], $form_fields['inputradiocount'], $form_fields['inputdropdowncount'], $form_fields['inputmultiselectcount'], $form_fields['inputtextareacount'], $form_fields['inputcurrencycount'], $form_fields['inputdatecount'], $form_fields['sorted_number']);
        $form_fields = serialize(array($form_fields));
        $count = serialize(array($count));
        $data = array(
            'beneifits_field' => $form_fields,
            'form_title' => $benefits_title,
            'count' => $count,
            'sort_order' => $sorted_number,
            'benefit_group' => $benefit_group
        );

        $this->load->model('Policy_model');
        $insert_id = $this->Policy_model->insert_add_policy_field($data);
        log_activity('New Benefit Created [ID: ' . $insert_id . ']');
        redirect(admin_url('Policy/showpolicyBenefits/'));
    }

    public function showpolicyBenefits()
    {
        $this->load->model('Policy_model');
        $data = $this->Policy_model->fetch_add_policy_field();
        $this->load->view('admin/policy/showpolicyfeild', $data);
    }

    public function fetchcustomerContact()
    {
        $customer = $this->input->post('customer');
        $this->load->model('Policy_model');
        $data = $this->Policy_model->fetchContact($customer);
        print_r(json_encode($data));
    }

    public function fetchBenefitfield()
    {
        $title = $this->input->post('title');
        $this->load->model('Policy_model');
        $data = $this->Policy_model->fetchBenefitfieldBytitle($title);
        echo json_encode($data);
    }

    public function deletePolicybenefit()
    {
        $data = [
            'is_deleted' => 1,
        ];
        $id = $this->uri->segment(4);
        set_alert('success', 'Benefit Deleted Successfully');
        $this->load->model('Policy_model');
        $this->Policy_model->delete_policybenefit($data, $id);
        redirect(admin_url('policy/showpolicyBenefits'));
    }

    public function savepolicydetails($client_id = null)
    {
        $policy_id = $this->input->post('policy_id');
        $sortedNumber = $this->input->post('sortednumber');
        $title = $this->input->post('title');
        $contact_id = $this->input->post('contact_id');
        $benefit_id = $this->input->post('benefit_id');
        $postdata = $this->input->post();
        unset($postdata['benefit_id'], $postdata['contact_id'], $postdata['title'], $postdata['policy_id'], $postdata['sortednumber']);
        $sortedArray = [];
        foreach ($postdata as $key => $val) {
            $keycheck = mb_substr($key, 0, 5, "UTF-8");
            if ($keycheck == 'sort-') {
                $sendkey = (explode("-", $key)[1]);
                $sortedArray[$sendkey] = $val;
            }
        }
        asort($sortedArray);
        $arrayToSend = [];
        foreach ($sortedArray as $key => $val) {
            $arrayToSend[$key] = $postdata[$key];
        }
        $data = array(
            'policy_id' => $policy_id,
            'contact_id' => $contact_id,
            'benefit_id' => $benefit_id,
            'title' => $title,
            'policy_benefits' => serialize(array($arrayToSend)),
            'sort_order' => $sortedNumber
        );
        $this->load->model('Policy_model');
        $this->Policy_model->save_policydetails($data);
        log_activity('Add Benefit In Policy [POLICYID: ' . $policy_id . ']');
        set_alert('success', 'Benefit Added Successfully');
        if ($client_id) {
            redirect(admin_url('Policy/showmulticontact/' . $policy_id . '/' . $client_id));
        }
        redirect(admin_url('Policy/showmulticontact/' . $policy_id));
    }

    public function editPolicybenefit()
    {

        $id = $this->uri->segment(4);
        $this->load->model('Policy_model');

        $benefitDetail = $this->Policy_model->edit_policybenefit($id);
        $data['grouping_benefitData'] = $this->Policy_model->fetchBenefitGrouping();
        $unsBenefitFields = unserialize($benefitDetail->beneifits_field);
        $unsBenefitCount = unserialize($benefitDetail->count);
        // echo "<pre>";
        // print_r($unsBenefitFields);
        // exit;
        $data['id'] = $id;
        $data['form_title'] = $benefitDetail->form_title;
        $data['sort_order'] = $benefitDetail->sort_order;
        $data['benefits_group'] = $benefitDetail->benefit_group;
        $textArray = [];
        $checkboxArray = [];
        $radioArray = [];
        $dropdownArray = [];
        $multiSelectArray = [];
        $textareaArray = [];
        $currencyArray = [];
        $dateArray = [];
        foreach ($unsBenefitCount[0] as $key => $unsBenefitKey) {
            if ($key == 'inputtextcount') {
                $i = 1;
                $j = 1;
                $thirdIndex = 1;
                while ($i <= $unsBenefitKey) {
                    $valueOfSortOrder = $unsBenefitFields[0]['sortOrder_' . $j];
                    $textArray[$thirdIndex]['textLabel'][$valueOfSortOrder] = $unsBenefitFields[0]['text_' . $i];
                    $i++;
                    $j++;
                    $thirdIndex++;
                }
            }
            if ($key == 'inputcheckcount') {
                $i = 1;
                $thirdIndex = 1;
                while ($i <= $unsBenefitKey) {
                    $valueOfSortOrder = $unsBenefitFields[0]['sortOrder_' . $j];
                    $checkboxArray[$thirdIndex]['check'][$valueOfSortOrder]['checkLabel'] = $unsBenefitFields[0]['check_' . $i];
                    $checkboxArray[$thirdIndex]['check'][$valueOfSortOrder]['checkOp'] = [];
                    if (isset($unsBenefitCount[0]['count_check_option' . $i])) {
                        $check_op_count = $unsBenefitCount[0]['count_check_option' . $i];
                        for ($k = 1; $k <= $check_op_count; $k++) {
                            $checkboxArray[$thirdIndex]['check'][$valueOfSortOrder]['checkOp']['checkbox' . $i . '_op_' . $k] = $unsBenefitFields[0]['checkbox' . $i . '_op_' . $k];
                            $data['count_check_option'][$i] = $unsBenefitCount[0]['count_check_option' . $i];
                        }
                    }
                    $i++;
                    $j++;
                    $thirdIndex++;
                }
            }
            if ($key == 'inputradiocount') {
                $i = 1;
                $thirdIndex = 1;
                while ($i <= $unsBenefitKey) {
                    $valueOfSortOrder = $unsBenefitFields[0]['sortOrder_' . $j];
                    $radioArray[$thirdIndex]['radio'][$valueOfSortOrder]['radioLabel'] = $unsBenefitFields[0]['radio_' . $i];
                    $radioArray[$thirdIndex]['radio'][$valueOfSortOrder]['radioOp'] = [];
                    if (isset($unsBenefitCount[0]['count_radio_option' . $i])) {
                        $radio_op_count = $unsBenefitCount[0]['count_radio_option' . $i];
                        for ($k = 1; $k <= $radio_op_count; $k++) {
                            $radioArray[$thirdIndex]['radio'][$valueOfSortOrder]['radioOp']['radio' . $i . '_op_' . $k] = $unsBenefitFields[0]['radio' . $i . '_op_' . $k];
                            $data['count_radio_option'][$i] = $unsBenefitCount[0]['count_radio_option' . $i];
                        }
                    }
                    $i++;
                    $j++;
                    $thirdIndex++;
                }
            }
            if ($key == 'inputdropdowncount') {
                $i = 1;
                $thirdIndex = 1;
                while ($i <= $unsBenefitKey) {
                    $valueOfSortOrder = $unsBenefitFields[0]['sortOrder_' . $j];
                    $dropdownArray[$thirdIndex]['dropdown'][$valueOfSortOrder]['dropdownLabel'] = $unsBenefitFields[0]['dropdown_' . $i];
                    $dropdownArray[$thirdIndex]['dropdown'][$valueOfSortOrder]['dropdownOp'] = [];
                    if (isset($unsBenefitCount[0]['count_dropdown_option' . $i])) {
                        $dropdown_op_count = $unsBenefitCount[0]['count_dropdown_option' . $i];
                        for ($k = 1; $k <= $dropdown_op_count; $k++) {
                            $dropdownArray[$thirdIndex]['dropdown'][$valueOfSortOrder]['dropdownOp']['dropdown_' . $i . '_op_' . $k] = $unsBenefitFields[0]['dropdown_' . $i . '_op_' . $k];
                            $data['count_dropdown_option'][$i] = $unsBenefitCount[0]['count_dropdown_option' . $i];
                        }
                    }
                    $i++;
                    $j++;
                    $thirdIndex++;
                }
            }
            if ($key == 'inputmultiselectcount') {
                $i = 1;
                $thirdIndex = 1;
                while ($i <= $unsBenefitKey) {
                    $valueOfSortOrder = $unsBenefitFields[0]['sortOrder_' . $j];
                    $multiSelectArray[$thirdIndex]['multiSelect'][$valueOfSortOrder]['multiSelectLabel'] = $unsBenefitFields[0]['multiselect_' . $i];
                    $multiSelectArray[$thirdIndex]['multiSelect'][$valueOfSortOrder]['multiSelectOp'] = [];
                    if (isset($unsBenefitCount[0]['count_multi_option' . $i])) {
                        $multiSelect_op_count = $unsBenefitCount[0]['count_multi_option' . $i];
                        for ($k = 1; $k <= $multiSelect_op_count; $k++) {
                            $multiSelectArray[$thirdIndex]['multiSelect'][$valueOfSortOrder]['multiSelectOp']['multiselect' . $i . '_op_' . $k] = $unsBenefitFields[0]['multiselect' . $i . '_op_' . $k];
                            $data['count_multi_option'][$i] = $unsBenefitCount[0]['count_multi_option' . $i];
                        }
                    }
                    $i++;
                    $j++;
                    $thirdIndex++;
                }
            }
            if ($key == 'inputtextareacount') {
                $i = 1;
                $thirdIndex = 1;
                while ($i <= $unsBenefitKey) {
                    $valueOfSortOrder = $unsBenefitFields[0]['sortOrder_' . $j];
                    $textareaArray[$thirdIndex]['textareaLabel'][$valueOfSortOrder] = $unsBenefitFields[0]['textarea_' . $i];
                    $i++;
                    $j++;
                    $thirdIndex++;
                }
            }
            if ($key == 'inputcurrencycount') {
                $i = 1;
                $thirdIndex = 1;
                while ($i <= $unsBenefitKey) {
                    $valueOfSortOrder = $unsBenefitFields[0]['sortOrder_' . $j];
                    $currencyArray[$thirdIndex]['currencyLabel'][$valueOfSortOrder] = $unsBenefitFields[0]['currencyarea_' . $i];
                    $i++;
                    $j++;
                    $thirdIndex++;
                }
            }
            if ($key == 'inputdatecount') {
                $i = 1;
                $thirdIndex = 1;
                while ($i <= $unsBenefitKey) {
                    $valueOfSortOrder = $unsBenefitFields[0]['sortOrder_' . $j];
                    $dateArray[$thirdIndex]['dateLabel'][$valueOfSortOrder] = $unsBenefitFields[0]['datearea_' . $i];
                    $i++;
                    $j++;
                    $thirdIndex++;
                }
            }
        }

        $data['text'] = $textArray;
        $data['check'] = $checkboxArray;
        $data['radio'] = $radioArray;
        $data['dropdown'] = $dropdownArray;
        $data['multiselect'] = $multiSelectArray;
        $data['textarea'] = $textareaArray;
        $data['currency'] = $currencyArray;
        $data['date'] = $dateArray;
        $data['inputtextcount'] = $unsBenefitCount[0]['inputtextcount'];
        $data['inputcheckcount'] = $unsBenefitCount[0]['inputcheckcount'];
        $data['inputradiocount'] = $unsBenefitCount[0]['inputradiocount'];
        $data['inputdropdowncount'] = $unsBenefitCount[0]['inputdropdowncount'];
        $data['inputmultiselectcount'] = $unsBenefitCount[0]['inputmultiselectcount'];
        $data['inputtextareacount'] = $unsBenefitCount[0]['inputtextareacount'];
        $data['inputcurrencycount'] = $unsBenefitCount[0]['inputcurrencycount'];
        $data['inputdatecount'] = $unsBenefitCount[0]['inputdatecount'];

        $this->load->view('admin/policy/editpolicybenefits', $data);
    }
    public function updatePolicyBenefitsfiled()
    {
        $form_fields = $this->input->post();
        // foreach ($form_fields as $key => $value) {
        //     if ($value == null) {
        //         unset($form_fields[$key]);
        //     }
        // }
        $id = $form_fields['id'];
        unset($form_fields['id']);
        $newSortOrder = array();
        $sortOrdercount = count($form_fields['sortOrder']);
        for ($i = 0; $i < $sortOrdercount; $i++) {
            $newKey = 'sortOrder_' . ($i + 1);
            $newSortOrder[$newKey] = $form_fields['sortOrder'][$i];
        }
        unset($form_fields['sortOrder']);

        $benefit_group = $this->input->post('benefit_group');
        $sorted_number = $this->input->post('sorted_number');
        $benefits_title = $this->input->post('benefits_title');
        $inputdropdowncount = $this->input->post('inputdropdowncount');
        $inputmultiselectcount = $this->input->post('inputmultiselectcount');
        $inputcheckcount = $this->input->post('inputcheckcount');
        $inputradiocount = $this->input->post('inputradiocount');

        $count = [
            'inputtextcount' => $form_fields['inputtextcount'],
            'inputcheckcount' => $form_fields['inputcheckcount'],
            'inputradiocount' => $form_fields['inputradiocount'],
            'inputdropdowncount' => $form_fields['inputdropdowncount'],
            'inputmultiselectcount' => $form_fields['inputmultiselectcount'],
            'inputtextareacount' => $form_fields['inputtextareacount'],
            'inputcurrencycount' => $form_fields['inputcurrencycount'],
            'inputdatecount' => $form_fields['inputdatecount']

        ];


        for ($i = 1; $i <= $inputdropdowncount; $i++) {
            $count['count_dropdown_option' . $i] = $form_fields['number_option' . $i];
            unset($form_fields['number_option' . $i]);
        }
        for ($i = 1; $i <= $inputmultiselectcount; $i++) {
            $count['count_multi_option' . $i] = $form_fields['number_moption' . $i];
            unset($form_fields['number_moption' . $i]);
        }
        for ($i = 1; $i <= $inputcheckcount; $i++) {
            $count['count_check_option' . $i] = $form_fields['number_check_option' . $i];
            unset($form_fields['number_check_option' . $i]);
        }
        for ($i = 1; $i <= $inputradiocount; $i++) {
            $count['count_radio_option' . $i] = $form_fields['number_radio_option' . $i];
            unset($form_fields['number_radio_option' . $i]);
        }
        unset($form_fields['benefits_title'], $form_fields['inputtextcount'], $form_fields['inputcheckcount'], $form_fields['inputradiocount'], $form_fields['inputdropdowncount'], $form_fields['inputmultiselectcount'], $form_fields['inputtextareacount'], $form_fields['inputcurrencycount'], $form_fields['inputdatecount'], $form_fields['sorted_number']);

        $insertIndex = 1;
        $result = array();

        $i = 0;
        foreach ($form_fields as $Key => $Value) {
            $result[$Key] = $Value;
            $explodedKey = explode('_', $Key);
            if ($explodedKey[0] == 'text') {
                if (isset($newSortOrder['sortOrder_' . $insertIndex])) {
                    $result['sortOrder_' . ($insertIndex + $i)] = $newSortOrder['sortOrder_' . $insertIndex];
                }
                $insertIndex++;
            }
            if ($explodedKey[0] == 'check') {
                if (isset($newSortOrder['sortOrder_' . $insertIndex])) {
                    $result['sortOrder_' . ($insertIndex + $i)] = $newSortOrder['sortOrder_' . $insertIndex];
                }
                $insertIndex++;
            }
            if ($explodedKey[0] == 'radio') {
                if (isset($newSortOrder['sortOrder_' . $insertIndex])) {
                    $result['sortOrder_' . ($insertIndex + $i)] = $newSortOrder['sortOrder_' . $insertIndex];
                }
                $insertIndex++;
            }
            if ($explodedKey[0] == 'dropdown' && count($explodedKey) == 2) {
                if (isset($newSortOrder['sortOrder_' . $insertIndex])) {
                    $result['sortOrder_' . ($insertIndex + $i)] = $newSortOrder['sortOrder_' . $insertIndex];
                }
                $insertIndex++;
            }
            if ($explodedKey[0] == 'multiselect') {
                if (isset($newSortOrder['sortOrder_' . $insertIndex])) {
                    $result['sortOrder_' . ($insertIndex + $i)] = $newSortOrder['sortOrder_' . $insertIndex];
                }
                $insertIndex++;
            }
            if ($explodedKey[0] == 'textarea') {
                if (isset($newSortOrder['sortOrder_' . $insertIndex])) {
                    $result['sortOrder_' . ($insertIndex + $i)] = $newSortOrder['sortOrder_' . $insertIndex];
                }
                $insertIndex++;
            }
            if ($explodedKey[0] == 'currencyarea') {
                if (isset($newSortOrder['sortOrder_' . $insertIndex])) {
                    $result['sortOrder_' . ($insertIndex + $i)] = $newSortOrder['sortOrder_' . $insertIndex];
                }
                $insertIndex++;
            }
            if ($explodedKey[0] == 'datearea') {
                if (isset($newSortOrder['sortOrder_' . $insertIndex])) {
                    $result['sortOrder_' . ($insertIndex + $i)] = $newSortOrder['sortOrder_' . $insertIndex];
                }
                $insertIndex++;
            }

        }
        ;
        $result = serialize(array($result));
        $count = serialize(array($count));
        $data = array(
            'beneifits_field' => $result,
            'form_title' => $benefits_title,
            'count' => $count,
            'sort_order' => $sorted_number,
            'benefit_group' => $benefit_group
        );

        $this->load->model('Policy_model');
        $id = $this->Policy_model->update_policy_field($id, $data);
        if (isset($id)) {
            set_alert('success', 'Benefit Update Successfully');
            redirect(admin_url('policy/editPolicybenefit/' . $id));
        }
    }
    // public function updatesavepolicydetails()
    // {   
    //     $id = $this->uri->segment(4);
    //     $client_id ='';
    //     $client_id = $this->uri->segment(5);
    //     $policy_id = $this->input->post('policy_id');
    //     $postdata = $this->input->post();
    //     unset($postdata['policy_id']);
    //     $data = array(
    //         'policy_benefits' =>serialize(array($postdata))
    //     );
    //     $this->load->model('Policy_model');
    //     $this->Policy_model->update_policydetails($data,$id);
    //     log_activity('Update Benefit In Policy [POLICYID: ' . $policy_id . ']');
    //     set_alert('success', 'update Successfully');
    //     if($client_id){
    //         redirect(admin_url('Policy/Policies/'.$policy_id.'/'.$client_id));
    //     }
    //     redirect(admin_url('Policy/Policies/'.$policy_id));
    // }

    public function updatesavepolicydetails()
    {
        $id = $this->uri->segment(4);
        $client_id = '';
        //$sortedNumber = $this->input->post('sortednumber');
        $client_id = $this->uri->segment(5);
        $policy_id = $this->input->post('policy_id');
        $postdata = $this->input->post();
        $JsonEncode = $this->input->post('sortednumber');
        $JsonDecode = json_decode($JsonEncode);
        /* convert object to array  */
        $array = (array) $JsonDecode;
        asort($array);
        foreach ($array as $arrkey => $arrval) {
            $array_key = str_replace(' ', '_', $arrkey);
            $data[$array_key] = $postdata[$array_key];
        }
        unset($postdata['policy_id']);
        $data = array(
            'policy_benefits' => serialize(array($data))
        );
        $data['updated_at'] = date('Y/m/d');
        $this->load->model('Policy_model');
        $this->Policy_model->update_policydetails($data, $id);
        log_activity('Update Benefit In Policy [POLICYID: ' . $policy_id . ']');
        set_alert('success', 'update Successfully');
        if ($client_id) {
            redirect(admin_url('Policy/Policies/' . $policy_id . '/' . $client_id));
        }
        redirect(admin_url('Policy/Policies/' . $policy_id));
    }

    public function addpremiumfrequency()
    {
        $this->load->model('Policy_model');
        $data['data'] = $this->Policy_model->fetchPremiumFrequency();
        $this->load->view('admin/policy/addpremiumfrequency', $data);
    }

    public function savePremiumFrequency()
    {
        $data = [
            'premium_frequency' => $this->input->post('premiumfrequency'),
        ];
        $this->load->model('Policy_model');
        $this->Policy_model->save_PremiumFrequency($data);
        redirect(admin_url('policy/addpremiumfrequency'));
    }

    public function deletePremiumFrequency()
    {
        $data = [
            'is_deleted' => 1,
        ];
        $id = $this->uri->segment(4);
        set_alert('success', 'Deleted Successfully');
        $this->load->model('Policy_model');
        $this->Policy_model->delete_premiumFrequency($data, $id);
        redirect(admin_url('policy/addpremiumfrequency'));
    }

    public function addCovertype()
    {
        $this->load->model('Policy_model');
        $data['data'] = $this->Policy_model->fetchcovertype();
        $this->load->view('admin/policy/addcovertype', $data);
    }

    public function saveCoverType()
    {
        $data = [
            'cover_type' => $this->input->post('covertype'),
        ];
        $this->load->model('Policy_model');
        $this->Policy_model->save_covertype($data);
        redirect(admin_url('policy/addCovertype'));
    }

    public function deleteCoverType()
    {
        $data = [
            'is_deleted' => 1,
        ];
        $id = $this->uri->segment(4);
        set_alert('success', 'Deleted Successfully');
        $this->load->model('Policy_model');
        $this->Policy_model->delete_covertype($data, $id);
        redirect(admin_url('policy/addCovertype'));
    }

    public function Policies()
    {
        $policy_id = $this->uri->segment(4);
        $client_id = '';
        $client_id = $this->uri->segment(5);
        if ($client_id) {
            $data['client_id'] = $client_id;
        }
        $this->load->model('Policy_model');
        $data['data'] = $this->Policy_model->fetch_policies($policy_id);
        $data['benefits'] = $this->Policy_model->fetch_policybenefit($policy_id);
        $this->load->view('admin/policy/policies', $data);
    }

    // public function showPolicyData()
    // {
    //     $policy_id = $this->uri->segment(4);
    //     $this->load->model('Policy_model');
    //     $data['data'] = $this->Policy_model->show_PolicyData();
    //     if(!is_admin()) {
    //         $data['data'] = $this->Policy_model->show_Policy_Data();
    //     }
    //     $this->load->view('admin/policy/policyview',$data); 
    // }

    public function showPolicyData()
    {
        // $policy_id = $this->uri->segment(4);
        // // $this->load->model('Policy_model');
        // $data['data'] = $this->Policy_model->show_PolicyData();
        // if(!is_admin()) 
        // {
        //     // $data['count'] = count($this->Policy_model->show_Policy_Data());
        //     $data['data'] = $this->Policy_model->show_Policy_Data();
        // }
        // if (!has_permission('customers', '', 'view')) {
        //     if (!is_customer_admin($id)) {
        //         // $data['count'] = count($this->Policy_model->show_Policy_Data());
        //         $data['data'] = $this->Policy_model->show_Policy_Data();
        //     }
        // }else{
        //     // $data['count'] = count($this->Policy_model->show_Policy_Data());
        //     $data['data'] = $this->Policy_model->show_PolicyData();
        // }

        // $this->load->view('admin/policy/policyview',$data); 

        $policyNumber = $this->Policy_model->fetch_policyNumber();
        $policyNum = [];
        foreach ($policyNumber as $policyDatanum) {
            $policyNum[] = $policyDatanum['policy_number'];
        }

        //$policyAdviser = $this->Policy_model->fetch_policyAdvider();

        $data['policyNumberData'] = array_unique($policyNum);
        //$data['policyAdviserName']= $policyAdviser;

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
        $searchedPolicyNo = $this->input->post('policyNumberSearch');
        //$searchedAdvisor = $this->input->post('advisersearch');
        $firstNamePolicy = $this->input->post('firstNamePolicy');
        $lastNamePolicy = $this->input->post('lastNamePolicy');
        $filter = [
            'policyNumberSearch' => $this->input->post('policyNumberSearch'),
            //'advisersearch' =>$this->input->post('advisersearch') 
            'firstNamePolicy' => $this->input->post('firstNamePolicy'),
            'lastNamePolicy' => $this->input->post('lastNamePolicy')
        ];

        if (!empty($filter)) {
            $this->session->set_userdata($filter);
        }
        $policyNumberArray1 = [];
        $policyNumberArray2;
        if ($searchedPolicyNo != '' && $firstNamePolicy == '' && $lastNamePolicy == '') {
            $policyNumberArray1[] = $searchedPolicyNo;
        }
        if ($searchedPolicyNo == '' && $firstNamePolicy != '' && $lastNamePolicy == '') {
            $firstnamePolicyData = $this->Policy_model->fetchfirstcustomerid($firstNamePolicy);
            foreach ($firstnamePolicyData as $rowdata) {
                $policyNumberArray1[] = $rowdata['policy_number'];
            }
        }
        if ($searchedPolicyNo != '' && $firstNamePolicy != '' && $lastNamePolicy == '') {
            $firstnamePolicyData = $this->Policy_model->fetchfirstcustomerid($firstNamePolicy);
            foreach ($firstnamePolicyData as $rowdata) {
                $policyNumberArray1[] = $rowdata['policy_number'];
            }
            $policyNumberArray1[] = $searchedPolicyNo;
        }
        if ($searchedPolicyNo == '' && $firstNamePolicy == '' && $lastNamePolicy != '') {
            $lastnamePolicyData = $this->Policy_model->fetchlastcustomerid($lastNamePolicy);
            foreach ($lastnamePolicyData as $rowdata) {
                $policyNumberArray1[] = $rowdata['policy_number'];
            }
        }
        if ($searchedPolicyNo != '' && $firstNamePolicy == '' && $lastNamePolicy != '') {
            $lastnamePolicyData = $this->Policy_model->fetchlastcustomerid($lastNamePolicy);
            foreach ($lastnamePolicyData as $rowdata) {
                $policyNumberArray1[] = $rowdata['policy_number'];
            }
            $policyNumberArray1[] = $searchedPolicyNo;
        }
        if ($searchedPolicyNo == '' && $firstNamePolicy != '' && $lastNamePolicy != '') {
            $firstnamePolicyData = $this->Policy_model->fetchfirst_lastcustomerid($firstNamePolicy, $lastNamePolicy);

            foreach ($firstnamePolicyData as $rowdata) {
                $policyNumberArray1[] = $rowdata['policy_number'];
            }
        }
        if ($searchedPolicyNo != '' && $firstNamePolicy != '' && $lastNamePolicy != '') {
            $firstnamePolicyData = $this->Policy_model->fetchfirst_lastcustomerid($firstNamePolicy, $lastNamePolicy);

            foreach ($firstnamePolicyData as $rowdata) {
                $policyNumberArray1[] = $rowdata['policy_number'];
            }
            $policyNumberArray1[] = $searchedPolicyNo;
        }
        $policyNumberArray2 = array_unique($policyNumberArray1);

        if (!empty($policyNumberArray2)) {
            $this->load->model('Policy_model');
            $data['data'] = $this->Policy_model->show_PolicyDatanew($policyNumberArray2);
            if (!is_admin()) {

                $data['data'] = $this->Policy_model->show_Policy_Data_new($policyNumberArray2);
            }
            if (!has_permission('customers', '', 'view')) {
                if (!is_customer_admin($id)) {
                    $data['data'] = $this->Policy_model->show_Policy_Data_new($policyNumberArray2);
                }
            } else {
                $data['data'] = $this->Policy_model->show_PolicyDatanew($policyNumberArray2);
            }
        }


        $this->load->view('admin/policy/policyview', $data);
    }

    public function deletePolicyData()
    {
        $data = [
            'is_deleted' => 1,
        ];
        $id = $this->uri->segment(4);
        $client_id = '';
        $client_id = $this->uri->segment(5);
        set_alert('success', 'Deleted Successfully');
        $this->load->model('Policy_model');
        $this->Policy_model->delete_PolicyData($data, $id);
        $this->Policy_model->delete_Benefit($data, $id);
        log_activity('Policy Deleted [POLICYID: ' . $id . ']');
        if ($client_id != '') {
            redirect(admin_url('clients/client/' . $client_id . '?group=policies'));
        }
        redirect(admin_url('policy/showPolicyData'));
    }

    public function editSelectedBenefit()
    {

        $id = $this->uri->segment(4);
        $client_id = '';
        $client_id = $this->uri->segment(5);
        $this->load->model('Policy_model');
        $data['data'] = $this->Policy_model->edit_SelectedBenefit($id);
        $data['benefit'] = $this->Policy_model->fetch_selected_benefit($id);
        if ($client_id) {
            $data['client_id'] = $client_id;
        }
        $this->load->view('admin/policy/benefitedit', $data);
    }

    public function updateSelectedBenefit()
    {
        $id = $this->uri->segment(4);
        $policyid = $this->input->post('policy_id');
        $postdata = $this->input->post();
        unset($postdata['policy_id']);
        $data = array(
            'policy_benefits' => serialize(array($postdata))
        );
        $this->load->model('Policy_model');
        $this->Policy_model->update_SelectedBenefit($data, $id);
        redirect(admin_url('policy/Policies/' . $policyid));
    }

    public function editpolicy()
    {
        $id = $this->uri->segment(4);
        $client_id = '';
        $client_id = $this->uri->segment(5);
        $this->load->model('Policy_model');
        $data['data'] = $this->Policy_model->edit_policy($id);
        $data['secondycontact'] = $this->Policy_model->fetchSecondaryContact();
        $data['companey'] = $this->Policy_model->fetchCompaney();
        $data['providers'] = $this->Policy_model->fetch_providers();
        $data['premiumfrequency'] = $this->Policy_model->fetchPremiumFrequency();
        $data['covertype'] = $this->Policy_model->fetchcovertype();
        $data['customer_groups'] = $this->Policy_model->get_customer_groups();
        $data['policystatus'] = $this->Policy_model->fetchpolicystatus();
        if ($client_id) {
            $data['client_id'] = $client_id;
        }
        $this->load->view('admin/policy/policyedit', $data);
    }

    public function updatepolicy()
    {
        $id = $this->uri->segment(4);
        $client_id = '';
        $client_id = $this->uri->segment(5);
        $life_assureds = serialize($this->input->post('life_assured'));
        $policy_owners = serialize($this->input->post('policy_owner'));
        $lastpolicy_update = date('Y/m/d');
        $data = [
            'customer' => $this->input->post('customer'),
            'policy_number' => $this->input->post('policy_number'),
            'provider' => $this->input->post('provider'),
            'start_date' => $this->input->post('start_date'),
            'policy_fee' => $this->input->post('policy_fee'),
            'total_premium' => $this->input->post('total_premium'),
            'premium_frequency' => $this->input->post('premium_frequency'),
            'life_assured' => $life_assureds,
            'policy_owner' => $policy_owners,
            'cover_type' => $this->input->post('cover_type'),
            'renewal_date' => $this->input->post('renewal_date'),
            'lastpolicy_update' => $lastpolicy_update,
            'policy_status' => $this->input->post('policy_status'),
            'key_contact' => $this->input->post('key_contact'),
            'contact_email' => $this->input->post('contact_email'),
            'tagg' => $this->input->post('tagg'),
            'contact_phone' => $this->input->post('contact_phone'),
            'total_frequency_premium' => $this->input->post('total_frequency_premium'),
            'ird_number' => $this->input->post('ird_number'),
            'pir' => $this->input->post('pir')
        ];

        $this->load->model('Policy_model');
        $this->Policy_model->update_policy($data, $id);
        log_activity('Policy Updated [ID: ' . $id . ']');
        if ($client_id) {
            redirect(admin_url('policy/Policies/' . $id . '/' . $client_id));
        }
        redirect(admin_url('policy/Policies/' . $id));
    }

    public function deleteSelectedBenefit()
    {
        $id = $this->uri->segment(4);
        $policyid = $this->uri->segment(5);
        $client_id = '';
        $client_id = $this->uri->segment(6);
        $this->load->model('Policy_model');
        $data = [
            'is_deleted' => 1,
        ];
        $this->Policy_model->delete_SelectedBenefit($data, $id);
        log_activity('Policy Benefit Deleted [POLICYID: ' . $policyid . ']');
        if ($client_id) {
            redirect(admin_url('policy/Policies/' . $policyid . '/' . $client_id));
        }
        redirect(admin_url('policy/Policies/' . $policyid));
    }

    public function testing()
    {
        $policy_id = $this->uri->segment(4);
        $this->load->model('Policy_model');
        $data['data'] = $this->Policy_model->fetch_policies($policy_id);
        $data['benefits'] = $this->Policy_model->fetch_policybenefit($policy_id);
        $this->load->view('admin/policy/policypdf', $data);
    }
    public function downloadpolicy()
    {
        $policy_id = $this->uri->segment(4);
        $this->load->model('Policy_model');
        $data['data'] = $this->Policy_model->fetch_policies($policy_id);
        $data['benefits'] = $this->Policy_model->fetch_policybenefit($policy_id);
        $this->load->library('pdf');
        $html = $this->load->view('admin/policy/policypdf', $data, true);
        $pdf_title = "policies";
        $dompdf = new Dompdf\Dompdf();
        $dompdf->set_option('isRemoteEnabled', TRUE);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("" . $pdf_title . "", array("Attachment" => 0));

    }

    public function addPolicystatus()
    {
        $this->load->model('Policy_model');
        $data['datat'] = $this->Policy_model->fetchpolicystatus();
        $this->load->view('admin/policy/addpolicystatus', $data);

    }

    public function savePolicystatus()
    {
        $data = [
            'status_type' => $this->input->post('policystatus'),
        ];
        $this->load->model('Policy_model');
        $this->Policy_model->save_policyststus($data);
        redirect(admin_url('policy/addpolicystatus'));
    }

    public function deletepolilystatus()
    {
        $data = [
            'is_deleted' => 1,
        ];
        $id = $this->uri->segment(4);
        set_alert('success', 'Deleted Successfully');
        $this->load->model('Policy_model');
        $this->Policy_model->delete_policyststus($data, $id);
        redirect(admin_url('policy/addpolicystatus'));
    }

    public function report()
    {
        //    if ($this->input->post('provider') == '' && $this->input->post('policy_status') == '' && $this->input->post('contact_email') == '' && $this->input->post('adviser') == '' /*&& $this->input->post('startDate') == '' && $this->input->post('endDate') == ''*/)
        //    {
        //        $filter = [
        //            'policy_status' => "",
        //            'customer'      => "",
        //         //    'start_date'    => "",
        //         //    'endDate'       => "",
        //            'provider'      => ""
        //        ];

        //        $this->session->set_userdata($filter);

        //        if(!is_admin()) 
        //        {
        //            $cleck_is_admin = 0;
        //            $data['data']   = $this->Policy_model->policyData($cleck_is_admin);
        //        }
        //        if (!has_permission('customers', '', 'view'))
        //        {
        //            if (!is_customer_admin($id)) 
        //            {
        //                $cleck_is_admin = 0;
        //                $data['data']   = $this->Policy_model->policyData($cleck_is_admin);
        //            }
        //        }
        //        else
        //        {
        //            $cleck_is_admin = 1;
        //            $data['data']   = $this->Policy_model->policyData($cleck_is_admin);
        //        }

        //        $data['datat']  = $this->Policy_model->fetchpolicystatus();
        //        $data['datatt'] = $this->Policy_model->fetchadvisordata();
        //     //    $data['provider']     = $this->projects_model->providers_detail();//fetch_providers
        //        $data['provider']     = $this->Policy_model->fetch_providersdata();//fetch_providers


        //    }
        //    else
        //    {
        $data['datat'] = $this->Policy_model->fetchpolicystatus();
        $data['datatt'] = $this->Policy_model->fetchadvisordata();
        // $data['provider']     = $this->projects_model->providers_detail();
        $data['provider'] = $this->Policy_model->fetch_providersdata();

        $filter = [
            'policy_status' => $this->input->post('policy_status'),
            'customer' => $this->input->post('adviser'),
            // 'start_date'    => $this->input->post('startDate'),
            // 'endDate'       => $this->input->post('endDate'),
            'provider' => $this->input->post('provider')
        ];


        $this->session->set_userdata($filter);
        //     if(!is_admin()) 
        //     {
        //         $cleck_is_admin = 0;
        //         $data['data']   = $this->Policy_model->filterdata($filter, $cleck_is_admin);
        //     }
        //     if (!has_permission('customers', '', 'view')) 
        //     {
        //         if (!is_customer_admin($id)) 
        //         {
        //             $cleck_is_admin = 0;
        //             $data['data']   = $this->Policy_model->filterdata($filter, $cleck_is_admin);
        //         }
        //     }
        //     else
        //     {
        //         $cleck_is_admin = 1;
        //         $data['data']   = $this->Policy_model->filterdata($filter, $cleck_is_admin);
        //     }
        // }
        $this->load->view('admin/policy/report');
    }

    public function report_data()
    {
        if ($this->input->post('provider') == '' && $this->input->post('policy_status') == '' && $this->input->post('contact_email') == '' && $this->input->post('adviser') == '' /*&& $this->input->post('startDate') == '' && $this->input->post('endDate') == ''*/) {
            $filter = [
                'policy_status' => "",
                'customer' => "",
                //    'start_date'    => "",
                //    'endDate'       => "",
                'provider' => ""
            ];

            $this->session->set_userdata($filter);

            if (!is_admin()) {
                $cleck_is_admin = 0;
                $data['data'] = $this->Policy_model->policyData($cleck_is_admin);
            }
            if (!has_permission('customers', '', 'view')) {
                if (!is_customer_admin($id)) {
                    $cleck_is_admin = 0;
                    $data['data'] = $this->Policy_model->policyData($cleck_is_admin);
                }
            } else {
                $cleck_is_admin = 1;
                $data['data'] = $this->Policy_model->policyData($cleck_is_admin);
            }

            $data['datat'] = $this->Policy_model->fetchpolicystatus();
            $data['datatt'] = $this->Policy_model->fetchadvisordata();
            //    $data['provider']     = $this->projects_model->providers_detail();//fetch_providers
            $data['provider'] = $this->Policy_model->fetch_providersdata();//fetch_providers
            //    echo 

        } else {
            $data['datat'] = $this->Policy_model->fetchpolicystatus();
            $data['datatt'] = $this->Policy_model->fetchadvisordata();
            // $data['provider']     = $this->projects_model->providers_detail();
            $data['provider'] = $this->Policy_model->fetch_providersdata();

            $filter = [
                'policy_status' => $this->input->post('policy_status'),
                'customer' => $this->input->post('adviser'),
                // 'start_date'    => $this->input->post('startDate'),
                // 'endDate'       => $this->input->post('endDate'),
                'provider' => $this->input->post('provider')
            ];

            $this->session->set_userdata($filter);
            if (!is_admin()) {
                $cleck_is_admin = 0;
                $data['data'] = $this->Policy_model->filterdata($filter, $cleck_is_admin);
            }
            if (!has_permission('customers', '', 'view')) {
                if (!is_customer_admin($id)) {
                    $cleck_is_admin = 0;
                    $data['data'] = $this->Policy_model->filterdata($filter, $cleck_is_admin);
                }
            } else {
                $cleck_is_admin = 1;
                $data['data'] = $this->Policy_model->filterdata($filter, $cleck_is_admin);
            }
        }

        echo json_encode($data);
        exit;
    }

    public function sortedOrderbytitle()
    {
        $data['sort_order'] = $this->input->post('sortorderNumber');
        $id = $this->input->post('id');
        $this->Policy_model->update_sortedOrderbytitle($data, $id);
    }

    public function policyNumber_exists()
    {
        $policy_number = $this->input->post('policyNumber');
        $exists = $this->Policy_model->policyNumberExists($policy_number);
        $count = count($exists);
        if ($count == 0) {
            echo 0;
        } else {
            echo 1;
        }
    }

    public function schedulePdf()
    {
        $company_id = $this->uri->segment(4);
        $data['companyData'] = $this->Policy_model->fetch_customerData($company_id);
        $data['adviserData'] = $this->Policy_model->getAdviser($company_id);

        $companyPolicies = $this->Policy_model->clients_policy($company_id);

        $assuredID = [];
        $policyData = [];
        $assured_members = [];
        $i = 0;

        foreach ($companyPolicies as $companyPolicy) {
            $assuredID[$i] = $companyPolicy['life_assuredid'];
            $policyData[$i]['policy'] = $companyPolicy;
            $lifeAssured = explode(',', $companyPolicy['life_assured']);
            foreach ($lifeAssured as $lifeAss) {
                $assured_members[] = $lifeAss;
            }
            $benefits = $this->Policy_model->fetch_policybenefits($companyPolicy['id']);
            $benefitsCollection = [];
            $j = 0;
            foreach ($benefits as $benefit) {
                $benefitsCollection[$j] = $benefit;
                $j++;
            }
            $policyData[$i]['benefits'] = $benefitsCollection;
            $i++;
        }

        $data['companyPolicies'] = $policyData;
        $data['lifeAsuredCustomerData'] = $assured_members;
        $single = array_merge(...$assuredID);
        $assuredMember = (array_unique($single));
        $data['currentDate'] = date('d /m /Y');
        $data['title'] = 'Welcome to Nicesnippets.com';
        foreach ($assuredMember as $memberlife_assured) {
            $assured[] = $this->Policy_model->lifeAssuredCustomerData($memberlife_assured);
        }

        $data['lifeAsuredMembers'] = $assured;
        $currentDateTime = new DateTime('now');
        $currentDate = $currentDateTime->format('d.m.y');
        $currentDate = date('d.m.Y', strtotime($currentDate));
        $downloadName = $data['companyPolicies'][0]['policy']['customer'] . " - Schedule - " . $currentDate;

        $this->load->library('pdf');
        $html = $this->load->view('admin/policy/policyschedule_pdf', $data, true);
        $pdf_title = "policies";
        $dompdf = new Dompdf\Dompdf();
        $dompdf = new Dompdf\Dompdf();
        $dompdf->set_option('isRemoteEnabled', TRUE);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("" . $downloadName . "", array("Attachment" => 0));
    }
    public function formatted_policyschedule()
    {
        $company_id = $this->uri->segment(4);
        $data['companyData'] = $this->Policy_model->fetch_customerData($company_id);
        $data['adviserData'] = $this->Policy_model->getAdviser($company_id);

        $companyPolicies = $this->Policy_model->clients_policy($company_id);

        $assuredID = [];
        $policyData = [];
        $assured_members = [];
        $i = 0;

        foreach ($companyPolicies as $companyPolicy) {
            $assuredID[$i] = $companyPolicy['life_assuredid'];
            $policyData[$i]['policy'] = $companyPolicy;
            $lifeAssured = explode(',', $companyPolicy['life_assured']);
            foreach ($lifeAssured as $lifeAss) {
                $assured_members[] = $lifeAss;
            }
            $benefits = $this->Policy_model->fetch_policybenefits($companyPolicy['id']);
            $benefitsCollection = [];
            $j = 0;
            foreach ($benefits as $benefit) {
                $benefitsCollection[$j] = $benefit;
                $j++;
            }
            // $policyData[$i]['benefits'] = $benefitsCollection;
            if (!empty($benefitsCollection)) {
                $policyData[$i]['benefits'] = $benefitsCollection;
            } else {
                $policyData[$i]['benefits'][0] = [
                    'id' => null,
                    'policy_id' => null,
                    'contact_id' => null,
                    'title' => null,
                    'policy_benefits' => [
                        [
                            'Premium_Instalment' => null,
                            'Loadings' => null,
                            'Exclusions' => null,
                            'Inflation_Adjustment' => null,
                            'Premium_Structure' => null,
                            'Future_Insurability_Option' => [
                                null
                            ],
                            'Continuation_Option' => [
                                null
                            ],
                            'Partners_Life_Hybrid_Cover' => [
                                null
                            ],
                            'Expiry_Date' => [
                                null
                            ],
                        ],
                    ],
                    'sort_order' => null
                ];
            }
            $i++;
        }

        $data['companyPolicies'] = $policyData;
        $data['lifeAsuredCustomerData'] = $assured_members;
        $single = array_merge(...$assuredID);
        $assuredMember = (array_unique($single));
        $data['currentDate'] = date('d /m /Y');
        $data['title'] = 'Welcome to Nicesnippets.com';
        foreach ($assuredMember as $memberlife_assured) {
            $assured[] = $this->Policy_model->lifeAssuredCustomerData($memberlife_assured);
        }
        $data['lifeAsuredMembers'] = $assured;
        $currentDateTime = new DateTime('now');
        $currentDate = $currentDateTime->format('d.m.y');
        $currentDate = date('d.m.Y', strtotime($currentDate));
        $downloadName = $data['companyPolicies'][0]['policy']['customer'] . " - Schedule - " . $currentDate;

        $this->load->library('pdf');
        $html = $this->load->view('admin/policy/formatted_policyschedule_pdf', $data, true);
        $pdf_title = "policies";
        $dompdf = new Dompdf\Dompdf();
        $dompdf = new Dompdf\Dompdf();
        $dompdf->set_option('isRemoteEnabled', TRUE);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("" . $downloadName . "", array("Attachment" => 0));
    }

    public function addBenefitGrouping()
    {
        $this->load->model('Policy_model');
        $data['grouping_benefitData'] = $this->Policy_model->fetchBenefitGrouping();
        $this->load->view('admin/policy/addbenefit_grouping', $data);
    }

    public function saveBenefitGrouping()
    {
        $data = [
            'benefit_grouping' => $this->input->post('benefit_grouping'),
        ];
        $this->load->model('Policy_model');
        $this->Policy_model->save_BenefitGrouping($data);
        redirect(admin_url('policy/addBenefitGrouping'));
    }

    public function deleteBenefitGrouping()
    {
        $data = [
            'is_deleted' => 1,
        ];

        $id = $this->uri->segment(4);
        set_alert('success', 'Deleted Successfully');
        $this->load->model('Policy_model');
        $this->Policy_model->delete_BenefitGrouping($data, $id);
        redirect(admin_url('policy/addBenefitGrouping'));
    }

    public function importPolicy()
    {
        $this->load->view('admin/policy/import_policy');
    }

    public function importPolicyExcel()
    {

        if ($this->input->post('upload') != NULL) {
            $data = array();
            if (!empty($_FILES['policy_file']['name'])) {

                $config['upload_path'] = 'assets/policy_import/';
                $config['allowed_types'] = 'csv';
                $config['max_size'] = '1000'; // max_size in kb 
                $config['file_name'] = $_FILES['policy_file']['name'];

                $this->load->library('upload', $config);

                if (($this->upload->do_upload('policy_file'))) {
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];
                    $file = fopen("assets/policy_import/" . $filename, "r");

                    $i = 0;
                    $NoOfFields = 17; // Total number of fields
                    $importData = array();
                    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                        $num = count($filedata);
                        if ($NoOfFields == $num) {
                            for ($x = 0; $x < $num; $x++) {
                                $importData[$i][] = $filedata[$x];
                            }
                        }
                        $i++;
                    }
                    fclose($file);
                    $skip = 0;
                    foreach ($importData as $policyImportrecord) {
                        if ($skip != 0) {
                            $result = $this->Policy_model->insertPolicyRecord($policyImportrecord);
                        }
                        $skip++;
                    }
                    // if($result == 2){
                    // set_alert('danger', 'This Records EXIST in table');
                    // log_activity('Record Exist in table');
                    // }
                    // if($result == 1){
                    // set_alert('success', 'Records Imported Successfully');
                    // }
                    // if($result == 0){
                    // set_alert('danger', 'Records Not Imported due to Blank Column');
                    // }
                } else {
                    $data['response'] = 'failed';
                }
                redirect(admin_url('policy/showPolicyData', $data));
            }
        } else {
            redirect(admin_url('policy/showPolicyData', $data));
        }
    }

    public function PlogActivity()
    {
        $Plog_Activity['P_log_Activity'] = $this->Policy_model->activity_log_policy();
        $this->load->view('admin/policy/policy_log_activity', $Plog_Activity);
    }


}
