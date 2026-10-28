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
        $this->load->model('currencies_model');
        $this->load->helper('date');
    }
    public function index()
    {
        //$this->load->view('admin/policy/addpolicy');
    }
    public function addPolicy($client_id=null)
    {
        $this->load->model('Policy_model');
        $data['secondycontact']  = $this->Policy_model->fetchSecondaryContact();
        $data['companey']  = $this->Policy_model->fetchCompaney();
        $data['providers']  = $this->Policy_model->fetch_providers();
        $data['premiumfrequency']  = $this->Policy_model->fetchPremiumFrequency();
        $data['covertype']  = $this->Policy_model->fetchcovertype();
        $data['policystatus']  = $this->Policy_model->fetchpolicystatus();
        if($client_id){
            $data['client_id'] = $client_id;
        }
        $this->load->view('admin/policy/addpolicy',$data);
    }
    
    public function savepolicy($client_id=null)
    {
        $target = serialize($this->input->post('life_assured'));
        $targets = serialize($this->input->post('policy_owner'));
        $data = [
            'customer' =>  $this->input->post('customer'),
            'policy_number' =>  $this->input->post('policy_number'),
            'provider' =>  $this->input->post('provider'),
            'start_date' =>  $this->input->post('start_date'),
            'policy_fee' =>  $this->input->post('policy_fee'),
            'total_premium' =>  $this->input->post('total_premium'),
            'premium_frequency' =>  $this->input->post('premium_frequency'),
            'cover_type' =>  $this->input->post('cover_type'),
            'life_assured' =>  $target,
            'policy_owner' =>  $targets,
            'renewal_date' => $this->input->post('renewal_date'),
            'policy_status' => $this->input->post('policy_status'),
            'key_contact' => $this->input->post('key_contact'),
            'contact_email' => $this->input->post('contact_email'),
            'contact_phone' => $this->input->post('contact_phone')
        ];
        $this->load->model('Policy_model');
        $lastid = $this->Policy_model->addpolicy($data);
        if($client_id){
            redirect(admin_url('Policy/showmulticontact/'.$lastid.'/'.$client_id));
        }
        redirect(admin_url('Policy/showmulticontact/'.$lastid));
    }

    public function showmulticontact($lastid,$client_id=null)
    {
        $client_id = $this->uri->segment(5);
        if($client_id){
          $data['client_id'] = $client_id;
        }
        $this->load->model('Policy_model');
        $data['data']= $this->Policy_model->fetch_multicontactdata($lastid);
        $data['benefits']= $this->Policy_model->fetch_add_policy_field();
        $data['selectedbenefits'] = $this->Policy_model->fetch_policybenefit($lastid);
        $data['lastid'] = $lastid;
        $this->load->view('admin/policy/multicontact',$data);
    }
    
    public function policyBenefits()
    {
        $this->load->view('admin/policy/addpolicybenefits');
    }

    public function addPolicyBenefitsfield()
    {
        $form_fields = $this->input->post();
        $benefits_title = $this->input->post('benefits_title');
        $inputdropdowncount = $this->input->post('inputdropdowncount');
        $inputmultiselectcount = $this->input->post('inputmultiselectcount');
        $inputcheckcount = $this->input->post('inputcheckcount');
        $inputradiocount = $this->input->post('inputradiocount');
        $count = [
            'inputtextcount'  => $form_fields['inputtextcount'],
            'inputcheckcount' => $form_fields['inputcheckcount'],
            'inputradiocount' => $form_fields['inputradiocount'],
            'inputdropdowncount' => $form_fields['inputdropdowncount'],
            'inputmultiselectcount' =>$form_fields['inputmultiselectcount'],
            'inputtextareacount' =>$form_fields['inputtextareacount'],
            'inputcurrencycount' =>$form_fields['inputcurrencycount'],
            'inputdatecount' =>$form_fields['inputdatecount']
        ];
        for($i=1; $i<=$inputdropdowncount; $i++ ){
        $count['count_dropdown_option'.$i] =  $form_fields['count_option'.$i];
        unset($form_fields['count_option'.$i],$form_fields['number_option'.$i]);
        }
        for($i=1; $i<=$inputmultiselectcount; $i++ ){
            $count['count_multi_option'.$i] =  $form_fields['multicount_option'.$i];
            unset($form_fields['multicount_option'.$i],$form_fields['number_moption'.$i]);
        }
        for($i=1; $i<=$inputcheckcount; $i++ ){
            $count['count_check_option'.$i] =  $form_fields['checkboxcount_option'.$i];
            unset($form_fields['checkboxcount_option'.$i],$form_fields['number_check_option'.$i]);
        }
        for($i=1; $i<=$inputradiocount; $i++ ){
            $count['count_radio_option'.$i] =  $form_fields['radio_count_option'.$i];
            unset($form_fields['radio_count_option'.$i],$form_fields['number_radio_option'.$i]);
        }
        unset($form_fields['benefits_title'],$form_fields['inputtextcount'],$form_fields['inputcheckcount'],$form_fields['inputradiocount'],$form_fields['inputdropdowncount'],$form_fields['inputmultiselectcount'],$form_fields['inputtextareacount'],$form_fields['inputcurrencycount'],$form_fields['inputdatecount']);
        $form_fields = serialize(array($form_fields));
        $count = serialize(array($count));
        $data = array(
            'beneifits_field' => $form_fields,
            'form_title' => $benefits_title,
            'count' => $count
        );
        $this->load->model('Policy_model');
        $this->Policy_model->insert_add_policy_field($data);
        redirect(admin_url('Policy/showpolicyBenefits/'));
    }

    public function showpolicyBenefits()
    {
        $this->load->model('Policy_model');
        $data = $this->Policy_model->fetch_add_policy_field();
        $this->load->view('admin/policy/showpolicyfeild',$data);
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
            'is_deleted' =>  1,
        ];
        $id = $this->uri->segment(4);
        set_alert('success', 'Benefit Deleted Successfully');
        $this->load->model('Policy_model');
        $this->Policy_model->delete_policybenefit($data,$id);
        redirect(admin_url('policy/showpolicyBenefits'));
    }

    public function savepolicydetails($client_id=null)
    {   
        $policy_id = $this->input->post('policy_id');
        $title = $this->input->post('title');
        $contact_id = $this->input->post('contact_id');
        $postdata = $this->input->post();
        unset($postdata['contact_id'],$postdata['title'],$postdata['policy_id']);
        $data = array(
            'policy_id' => $policy_id,
            'contact_id' => $contact_id,
            'title' => $title,
            'policy_benefits' =>serialize(array($postdata))
        );
        $this->load->model('Policy_model');
        $this->Policy_model->save_policydetails($data);
        set_alert('success', 'Benefit Added Successfully');
        if($client_id){
            redirect(admin_url('Policy/showmulticontact/'.$policy_id.'/'.$client_id));
        }
        redirect(admin_url('Policy/showmulticontact/'.$policy_id));
    }
    public function updatesavepolicydetails()
    {   
        $id = $this->uri->segment(4);
        $client_id ='';
        $client_id = $this->uri->segment(5);
        $policy_id = $this->input->post('policy_id');
        $postdata = $this->input->post();
        unset($postdata['policy_id']);
        $data = array(
            'policy_benefits' =>serialize(array($postdata))
        );
        $this->load->model('Policy_model');
        $this->Policy_model->update_policydetails($data,$id);
        set_alert('success', 'update Successfully');
        if($client_id){
            redirect(admin_url('Policy/Policies/'.$policy_id.'/'.$client_id));
        }
        redirect(admin_url('Policy/Policies/'.$policy_id));
    }

    public function addpremiumfrequency()
    {   
        $this->load->model('Policy_model');
        $data['data'] = $this->Policy_model->fetchPremiumFrequency();
        $this->load->view('admin/policy/addpremiumfrequency',$data);
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
            'is_deleted' =>  1,
        ];
        $id = $this->uri->segment(4);
        set_alert('success', 'Deleted Successfully');
        $this->load->model('Policy_model');
        $this->Policy_model->delete_premiumFrequency($data,$id);
        redirect(admin_url('policy/addpremiumfrequency'));
    }

    public function addCovertype()
    {   
        $this->load->model('Policy_model');
        $data['data'] = $this->Policy_model->fetchcovertype();
        $this->load->view('admin/policy/addcovertype',$data);
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
            'is_deleted' =>  1,
        ];
        $id = $this->uri->segment(4);
        set_alert('success', 'Deleted Successfully');
        $this->load->model('Policy_model');
        $this->Policy_model->delete_covertype($data,$id);
        redirect(admin_url('policy/addCovertype'));
    }

    public function Policies()
    { 
        $policy_id = $this->uri->segment(4);
        $client_id ='';
        $client_id = $this->uri->segment(5);
        if($client_id){
            $data['client_id'] = $client_id;
        }
        $this->load->model('Policy_model');
        $data['data'] = $this->Policy_model->fetch_policies($policy_id);
        $data['benefits'] = $this->Policy_model->fetch_policybenefit($policy_id);
        $this->load->view('admin/policy/policies',$data);
    }

    public function showPolicyData()
    {
        $policy_id = $this->uri->segment(4);
        $this->load->model('Policy_model');
        $data['data'] = $this->Policy_model->show_PolicyData();
        $this->load->view('admin/policy/policyview',$data);
    }

    public function deletePolicyData()
    { 
        $data = [
            'is_deleted' =>  1,
        ];
        $id = $this->uri->segment(4);
        $client_id ='';
        $client_id = $this->uri->segment(5);
        set_alert('success', 'Deleted Successfully');
        $this->load->model('Policy_model');
        $this->Policy_model->delete_PolicyData($data,$id);
        $this->Policy_model->delete_Benefit($data,$id);
        if($client_id != ''){
            redirect(admin_url('clients/client/' . $client_id . '?group=policies'));    
        }
        redirect(admin_url('policy/showPolicyData'));
    }
    
    public function editSelectedBenefit(){

       $id = $this->uri->segment(4);
       $client_id ='';
       $client_id = $this->uri->segment(5);
       $this->load->model('Policy_model');
       $data['data'] = $this->Policy_model->edit_SelectedBenefit($id);
       $data['benefit'] = $this->Policy_model->fetch_selected_benefit($id);
       if($client_id){
        $data['client_id'] = $client_id;
       }
       $this->load->view('admin/policy/benefitedit',$data);
    }

    public function updateSelectedBenefit(){
        $id = $this->uri->segment(4);
        $policyid = $this->input->post('policy_id');
        $postdata = $this->input->post();
        unset($postdata['policy_id']);
        $data = array(
            'policy_benefits' =>serialize(array($postdata))
        );
        $this->load->model('Policy_model');
        $this->Policy_model->update_SelectedBenefit($data,$id);
        redirect(admin_url('policy/Policies/'.$policyid));
    }

    public function editpolicy(){
       $id = $this->uri->segment(4);
       $client_id ='';
       $client_id= $this->uri->segment(5);
       $this->load->model('Policy_model');
       $data['data'] = $this->Policy_model->edit_policy($id);
       $data['secondycontact']  = $this->Policy_model->fetchSecondaryContact();
       $data['companey']  = $this->Policy_model->fetchCompaney();
       $data['providers']  = $this->Policy_model->fetch_providers();
       $data['premiumfrequency']  = $this->Policy_model->fetchPremiumFrequency();
       $data['covertype']  = $this->Policy_model->fetchcovertype();
       if($client_id){
        $data['client_id'] = $client_id;
       }
       $this->load->view('admin/policy/policyedit',$data);
    }

    public function updatepolicy(){
        $id = $this->uri->segment(4);
        $client_id ='';
        $client_id = $this->uri->segment(5);
        $life_assureds = serialize($this->input->post('life_assured'));
        $policy_owners = serialize($this->input->post('policy_owner'));
        $data = [
            'customer' =>  $this->input->post('customer'),
            'policy_number' =>  $this->input->post('policy_number'),
            'provider' =>  $this->input->post('provider'),
            'start_date' =>  $this->input->post('start_date'),
            'policy_fee' =>  $this->input->post('policy_fee'),
            'total_premium' =>  $this->input->post('total_premium'),
            'premium_frequency' =>  $this->input->post('premium_frequency'),
            'life_assured' =>  $life_assureds,
            'policy_owner' =>  $policy_owners,
            'cover_type' =>  $this->input->post('cover_type'),
            'renewal_date' => $this->input->post('renewal_date'),
            'policy_status' => $this->input->post('policy_status'),
            'key_contact' => $this->input->post('key_contact'),
            'contact_email' => $this->input->post('contact_email'),
            'contact_phone' => $this->input->post('contact_phone')
        ];
        $this->load->model('Policy_model');
        $this->Policy_model->update_policy($data,$id);
        if($client_id){
            redirect(admin_url('policy/Policies/'.$id.'/'.$client_id));
        }
        redirect(admin_url('policy/Policies/'.$id));
    }

    public function deleteSelectedBenefit(){
        $id = $this->uri->segment(4);
        $policyid = $this->uri->segment(5);
        $client_id ='';
        $client_id = $this->uri->segment(6);
        $this->load->model('Policy_model');
        $data = [
            'is_deleted' =>  1,
        ];
        $this->Policy_model->delete_SelectedBenefit($data,$id);
        if($client_id){
            redirect(admin_url('policy/Policies/'.$policyid.'/'.$client_id));
        }
        redirect(admin_url('policy/Policies/'.$policyid));
    }

    public function testing(){
        $policy_id = $this->uri->segment(4);
        $this->load->model('Policy_model');
        $data['data'] = $this->Policy_model->fetch_policies($policy_id);
        $data['benefits'] = $this->Policy_model->fetch_policybenefit($policy_id);
        $this->load->view('admin/policy/policypdf',$data);
    }
    public function downloadpolicy(){
        $policy_id = $this->uri->segment(4);
        $this->load->model('Policy_model');
        $data['data'] = $this->Policy_model->fetch_policies($policy_id);
        $data['benefits'] = $this->Policy_model->fetch_policybenefit($policy_id);
        $this->load->library('pdf');
        $html = $this->load->view('admin/policy/policypdf' ,$data, true);
        $pdf_title = "policies";
        $dompdf = new Dompdf\Dompdf();
        $dompdf->set_option('isRemoteEnabled', TRUE);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4','landscape');
        $dompdf->render();
        $dompdf->stream("".$pdf_title."",array("Attachment"=>0));
    }
   
    public function addPolicystatus()
    {
        $this->load->model('Policy_model');
        $data['datat']= $this->Policy_model->fetchpolicystatus();
        $this->load->view('admin/policy/addpolicystatus',$data);
       
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
       $this->Policy_model->delete_policyststus($data , $id);
       redirect(admin_url('policy/addpolicystatus'));
   }

    public function report()
    { 
        if ($this->input->post('policy_status') == '' && $this->input->post('contact_email') == '' && $this->input->post('adviser') == '' && $this->input->post('startDate') == '' && $this->input->post('endDate') == '') {
            $filter = [
                'policy_status' => "",
                // 'contact_email' => "",
                'customer'=> "",
                'start_date'=> "",
                'endDate'=>""
            ];
            $this->session->set_userdata($filter);
            $data['data'] = $this->Policy_model->show_PolicyData();
            $data['datat']= $this->Policy_model->fetchpolicystatus();
            $data['datatt']=$this->Policy_model->fetchadvisordata();
        }
        else {
           $data['datat']= $this->Policy_model->fetchpolicystatus();
            $data['datatt']=$this->Policy_model->fetchadvisordata();
            $filter = [
                'policy_status' => $this->input->post('policy_status'),
                //'contact_email' => $this->input->post('contact_email'),
                'customer'=> $this->input->post('adviser'),
                'start_date'=> $this->input->post('startDate'),
                'endDate'=>$this->input->post('endDate')
            ];
            $this->session->set_userdata($filter);
            $data['data'] = $this->Policy_model->filterdata($filter);
        }
        $this->load->view('admin/policy/report',$data);
    }
    
}