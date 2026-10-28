<?php

use app\services\projects\AllProjectsGantt;
use app\services\projects\Gantt;
use app\services\projects\HoursOverviewChart;

defined('BASEPATH') or exit('No direct script access allowed');

class Provider extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('projects_model');
        $this->load->model('currencies_model');
        $this->load->helper('date');
    }

    public function addprovider()
    {
        $this->load->view('admin/provider/addprovider');
    }

    public function saveprovider()
    {
        $providername = $this->input->post('providername');
        $email = $this->input->post('email');
        $mobilenumber= $this->input->post('mobilenumber');
        $bdmname = $this->input->post('bdm_name');
        $bdmemail = $this->input->post('bdm_email');
        $accountsname= $this->input->post('accounts_name');
        $accountsemail = $this->input->post('accounts_email');
        $accountsphone = $this->input->post('accounts_phone');
        $data = [
            'providername' =>  $providername,
            'email' =>  $email,
            'mobilenumber' =>  $mobilenumber,
            'bdm_name' =>  $accountsname,
            'bdm_email' =>  $bdmemail,
            'accounts_name' =>  $accountsname,
            'accounts_email' =>  $accountsemail,
            'accounts_phone' =>  $accountsphone,
        ];
        set_alert('success', 'Provider Added Successfully');
        $this->load->model('Policy_model');
        $this->Policy_model->addproviderdetails($data);
         redirect(admin_url('Provider/showproviders'));
    }
    public function showproviders()
    {
        $this->load->model('Policy_model');
        $data ['data'] = $this->Policy_model->fetch_providers();
        $this->load->view('admin/provider/showproviders',$data);
    }

    public function delete()
    {
        $data = [
            'is_deleted' =>  1,
        ];
        $id = $this->uri->segment(4);
        set_alert('success', 'Provider Deleted Successfully');
        $this->load->model('Policy_model');
        $this->Policy_model->delete_providerdetails($data,$id);
         redirect(admin_url('Provider/showproviders'));
    }

    public function edit()
    {
       $id = $this->uri->segment(4);
       $this->load->model('Policy_model');
       $data ['data'] = $this->Policy_model->fetch_providerdata($id);
       $this->load->view('admin/provider/editprovider',$data);
    }

    public function updateprovider()
    {
        $id = $this->uri->segment(4);
        $providername = $this->input->post('providername');
        $email = $this->input->post('email');
        $mobilenumber= $this->input->post('mobilenumber');
        $bdmname = $this->input->post('bdm_name');
        $bdmemail = $this->input->post('bdm_email');
        $accountsname= $this->input->post('accounts_name');
        $accountsemail = $this->input->post('accounts_email');
        $accountsphone = $this->input->post('accounts_phone');
        $data = [
            'providername' =>  $providername,
            'email' =>  $email,
            'mobilenumber' =>  $mobilenumber,
            'bdm_name' =>  $accountsname,
            'bdm_email' =>  $bdmemail,
            'accounts_name' =>  $accountsname,
            'accounts_email' =>  $accountsemail,
            'accounts_phone' =>  $accountsphone,
        ];
        $this->load->model('Policy_model');
        $this->Policy_model->update_providerdetails($data,$id);
        redirect(admin_url('Provider/showproviders'));
    }
}