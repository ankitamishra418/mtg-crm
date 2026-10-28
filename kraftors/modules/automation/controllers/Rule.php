<?php

ob_start();

defined('BASEPATH') or exit('No direct script access allowed');



class Rule extends AdminController

{

    public function __construct()

    {

        parent::__construct();

        $this->load->model('automations_model');

        $this->load->model('tickets_model');

        $this->load->helper('tickets_helper');

    }



    /* List all announcements */

    public function index()

    {

        if (!has_permission('automation', '', 'view')) {

            access_denied('automation');

        }

        if ($this->input->is_ajax_request()) {

            $this->app->get_table_data(module_views_path('automation', 'table'));

        } 

        $data['title']                 = _l('automation_rule');

        $this->load->view('manage', $data);

    }



    public function add($id = '')

    {

        if (!has_permission('automation', '', 'view')) {

            access_denied('automation');

        }

        if ($this->input->post()) {

        	$dataSet = $this->input->post();

        	$dataSet['module_name']=$dataSet['module_name'];

            if ($id == '') {

                if (!has_permission('automation', '', 'create')) {

                    access_denied('automation');

                }

                $id = $this->automations_model->add($dataSet);

                if ($id) {

                    set_alert('success', _l('added_successfully', _l('automation'))); 

                    redirect(admin_url('automation/rule'));

                }

            } else {

                if (!has_permission('automation', '', 'edit')) {

                    access_denied('automation');

                }

                $success = $this->automations_model->update($dataSet, $id);

                if ($success) {

                    set_alert('success', _l('updated_successfully', _l('automation')));

                }

                redirect(admin_url('automation/rule/add/' . $id));

            }

        }

        if ($id == '') {

            $title = _l('add_new', _l('automation'));

        } else {

            $data['automationRule']        = $this->automations_model->get($id);

            $data['achievement'] = $this->automations_model->calculate_goal_achievement($id);



            $title = _l('edit', _l('automation'));

        }



        $this->load->model('staff_model');

        $data['members'] = $this->staff_model->get('', ['is_not_staff' => 0, 'active'=>1]);



        $this->load->model('contracts_model');

        $data['contract_types']        = $this->contracts_model->get_contract_types();

        $data['title']                 = $title;

        $this->load->model('departments_model'); 
        $this->load->model('leads_model'); 
        $this->load->model('roles_model'); 

        $data['departments'] = $this->departments_model->get();

        // $this->app_scripts->add('circle-progress-js','assets/plugins/jquery-circle-progress/circle-progress.min.js'); 
        $data['statuses']    = $this->tickets_model->get_ticket_status(); 
        $data['priorities']  = $this->tickets_model->get_priority(); 
        $data['services']    = $this->tickets_model->get_service();
        $data['leadstatuses']= $this->leads_model->get_status();
        $data['sources']     = $this->leads_model->get_source();
        $data['roles']       = $this->roles_model->get();
        $this->load->view('rule', $data);

    }



    /* Delete announcement from database */

    public function delete($id)

    {

        if (!has_permission('automation', '', 'delete')) {

            access_denied('automation');

        }

        if (!$id) {

            redirect(admin_url('automation/rule'));

        }

        $response = $this->automations_model->delete($id);

        if ($response == true) {

            set_alert('success', _l('deleted', _l('automation')));

        } else {

            set_alert('warning', _l('problem_deleting', _l('automation_lowercase')));

        }

        redirect(admin_url('automation/rule'));

    }



    public function notify($id, $notify_type)

    {

        if (!has_permission('automation', '', 'edit') && !has_permission('automation', '', 'create')) {

            access_denied('automation');

        }

        if (!$id) {

            redirect(admin_url('automation'));

        }

        $success = $this->automations_model->notify_staff_members($id, $notify_type);

        if ($success) {

            set_alert('success', _l('goal_notify_staff_notified_manually_success'));

        } else {

            set_alert('warning', _l('goal_notify_staff_notified_manually_fail'));

        }

        redirect(admin_url('goals/goal/' . $id));

    }

    public function support_automate($value='')
    { 
        $ruleSet = $this->getRule('support');  
        if (!empty($ruleSet)) {
            foreach ($ruleSet as $key => $rule) {
                // $date1 = date_create('2019-12-12 09:00:00');
                // $crDate= date('Y-m-d');
                // $date2 = date_create($crDate); 
                // $diff  = date_diff($date1,$date2); 
                // $hours = $hours + ($diff->days*24);
                $whereSet=$setData=''; 
                if (!empty($rule->from_department_id) && !empty($rule->to_department_id)) { 
                    $whereSet .= 'department='.$rule->from_department_id.' AND ';
                    $setData  .= 'department='.$rule->to_department_id.',';
                }if (!empty($rule->status_id) && !empty($rule->to_status_id)) {
                    $whereSet .= 'status='.$rule->status_id.' AND ';
                    $setData  .= 'status='.$rule->to_status_id.',';
                }if (!empty($rule->priority_id) && !empty($rule->to_priority_id)) {
                    $whereSet .= 'priority='.$rule->priority_id.' AND ';
                    $setData  .= 'priority='.$rule->to_priority_id.',';
                }
                if (!empty($whereSet) && !empty($setData)) { 
                    if (!empty($rule->duration) && $rule->duration_type=='1') {
                        $otherCond = ' AND created_at = DATE_SUB(NOW(),INTERVAL '.$rule->duration.' HOUR)';
                    }if (!empty($rule->duration) && $rule->duration_type=='2') {
                        $otherCond = ' AND created_at > DATE_SUB(CURDATE(), INTERVAL '.$rule->duration.' DAY)';
                    }
                    $whereSet = substr_replace($whereSet, '', -4);
                    $setData  = substr_replace($setData, '', -1);
                    $query    ="UPDATE tbltickets SET $setData WHERE $whereSet".$otherCond;
                    $result   = $this->db->query($query); 
                    log_activity('Ticket/Support updated');
                }
                 
            }
            if ($result) {
                echo $this->db->last_query();
                die("welcome");
            }else{
                echo $this->db->last_query();
                die('OPPS !!!!');
            }
        }
    }
    public function lead_automate($value='')
    {
        $ruleSet = $this->getRule('lead');
        if (!empty($ruleSet)) {
            foreach ($ruleSet as $key => $rule) {
                $whereSet=$setData=''; 
                if (!empty($rule->from_lead_source_id) && !empty($rule->to_lead_source_id)) { 
                    $log .= 'From '.$rule->from_lead_source_id.' TO '.$rule->to_lead_source_id.'';
                    $whereSet .= 'source='.$rule->from_lead_source_id.' AND ';
                    $setData  .= 'source='.$rule->to_lead_source_id.',';
                }if (!empty($rule->from_lead_status_id) && !empty($rule->to_lead_status_id)) {
                    $whereSet .= 'status='.$rule->from_lead_status_id.' AND ';
                    $setData  .= 'status='.$rule->to_lead_status_id.',';
                } 
                if (!empty($whereSet) && !empty($setData)) { 
                    if (!empty($rule->duration) && $rule->duration_type=='1') {
                        $otherCond = ' AND created_at = DATE_SUB(NOW(),INTERVAL '.$rule->duration.' HOUR)';
                    }if (!empty($rule->duration) && $rule->duration_type=='2') {
                        $otherCond = ' AND created_at > DATE_SUB(CURDATE(), INTERVAL '.$rule->duration.' DAY)';
                    }
                    $whereSet = substr_replace($whereSet, '', -4);
                    $setData  = substr_replace($setData, '', -1);
                    $query    ="UPDATE tblleads SET $setData WHERE $whereSet".$otherCond;
                    $result   = $this->db->query($query); 
                    log_activity('Lead updated');
                } 
            }
            if ($result) {
                echo $this->db->last_query();
                die("welcome");
            }else{
                echo $this->db->last_query();
                die('OPPS !!!!');
            }
        }
    }
   


    private function getRule($module='')
    {
        return $this->db->where('module_name',$module)->get('tblautomation_rule')->result();
    }

}

