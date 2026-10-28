<?php

use app\services\projects\AllProjectsGantt;
use app\services\projects\Gantt;
use app\services\projects\HoursOverviewChart;

defined('BASEPATH') or exit('No direct script access allowed');

class Projects extends AdminController
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

        close_setup_menu();
        $data['statuses'] = $this->projects_model->get_project_statuses();
        $data['title']    = _l('projects');
        $data['projecttemplates'] = $this->projects_model->fetchprojecttemplate();
        $this->load->view('admin/projects/manage', $data);
    }

    public function table($clientid = '')
    {
        // echo 'hello';
        // exit;
        $this->app->get_table_data('projects', [
            'clientid' => $clientid,
        ]);
    }

    public function staff_projects()
    {
        $this->app->get_table_data('staff_projects');
    }

    public function expenses($id)
    {
        $this->load->model('expenses_model');
        $this->load->model('payment_modes_model');
        $data['payment_modes'] = $this->payment_modes_model->get('', [], true);
        $this->app->get_table_data('project_expenses', [
            'project_id' => $id,
            'data'       => $data,
        ]);
    }

    public function add_expense()
    {
        if ($this->input->post()) {
            $this->load->model('expenses_model');
            $id = $this->expenses_model->add($this->input->post());
            if ($id) {
                set_alert('success', _l('added_successfully', _l('expense')));
                echo json_encode([
                    'url'       => admin_url('projects/view/' . $this->input->post('project_id') . '/?group=project_expenses'),
                    'expenseid' => $id,
                ]);
                die;
            }
            echo json_encode([
                'url' => admin_url('projects/view/' . $this->input->post('project_id') . '/?group=project_expenses'),
            ]);
            die;
        }
    }

    public function project($id = '')
    { 

        if (!staff_can('edit', 'projects') && !staff_can('create', 'projects')) {
            access_denied('Projects');
        }
        if ($this->input->post()) {
            $data     = $this->input->post();

            // if(isset($data['policy_number'])){
            //    $policyNumber = $this->projects_model->getAlldata_Rele_to_policyNo($data['policy_number']);
            //    $single_array = array_merge(...$policyNumber);

            //    $data['total_premium'] = $single_array['total_premium'];
            //    $data['start_date_policy'] = $single_array['start_date'];
            //    $data['life_assured'] = $single_array['life_assured'];
            //    $data['policy_owner'] = $single_array['policy_owner'];
            // }

            $data['created_staff_id']        = get_staff_user_id();
            
            $data['description'] = html_purify($this->input->post('description', false));
          
            if ($id == '') {
                if (!staff_can('create', 'projects')) {
                    access_denied('Projects');
                }

                $id = $this->projects_model->add($data);
                // echo $id;
                // exit;
                // $project_arrears_id = $this->projects_model->save_Arrears($id);

                if ($id) {
                    set_alert('success', _l('added_successfully', _l('project')));
                    redirect(admin_url('projects/view/' . $id));
                }
            } else {
                if (!staff_can('edit', 'projects')) {
                    access_denied('Projects');
                }
                $success = $this->projects_model->update($data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('project')));
                }
                redirect(admin_url('projects/view/' . $id));
            }
        }
        if ($id == '') {
            $title                            = _l('add_new', _l('project_lowercase'));
            $data['auto_select_billing_type'] = $this->projects_model->get_most_used_billing_type();

            if ($this->input->get('via_estimate_id')) {
                $this->load->model('estimates_model');
                $data['estimate'] = $this->estimates_model->get($this->input->get('via_estimate_id'));
            }
        } else {
            $data['project']                               = $this->projects_model->get($id);

            $data['project']->settings->available_features = unserialize($data['project']->settings->available_features);   

            $data['project_members'] = $this->projects_model->get_project_members($id);
            $title                   = _l('edit', _l('project_lowercase'));
           
        }
        if ($this->input->get('customer_id')) {
            $data['customer_id'] = $this->input->get('customer_id');
        }

        $data['last_project_settings'] = $this->projects_model->get_last_project_settings();

        if (count($data['last_project_settings'])) {
            $key                                          = array_search('available_features', array_column($data['last_project_settings'], 'name'));
            $data['last_project_settings'][$key]['value'] = unserialize($data['last_project_settings'][$key]['value']);
        }
        $data['settings'] = $this->projects_model->get_settings();
        $data['statuses'] = $this->projects_model->get_project_statuses();
        $data['staff']    = $this->staff_model->get('', ['active' => 1]);
        $data['title'] = $title;
        $data['providers']  = $this->projects_model->fetch_providers();
        $data['projecttype'] = $this->projects_model->fetchprojecttype();
        $this->load->view('admin/projects/project', $data);
    }

    public function gantt()
    {
        
        $data['title'] = _l('project_gant');

        $selected_statuses = [];
        $selectedMember    = null;
        $data['statuses']  = $this->projects_model->get_project_statuses();

        $appliedStatuses = $this->input->get('status');
        $appliedMember   = $this->input->get('member');

        $allStatusesIds = [];
        foreach ($data['statuses'] as $status) {
            if (
                !isset($status['filter_default'])
                || (isset($status['filter_default']) && $status['filter_default'])
                && !$appliedStatuses
            ) {
                $selected_statuses[] = $status['id'];
            } elseif ($appliedStatuses) {
                if (in_array($status['id'], $appliedStatuses)) {
                    $selected_statuses[] = $status['id'];
                }
            } else {
                // All statuses
                $allStatusesIds[] = $status['id'];
            }
        }

        if (count($selected_statuses) == 0) {
            $selected_statuses = $allStatusesIds;
        }


        $data['selected_statuses'] = $selected_statuses;

        if (staff_can('view', 'projects')) {
            $selectedMember          = $appliedMember;
            $data['selectedMember']  = $selectedMember;
            $data['project_members'] = $this->projects_model->get_distinct_projects_members();
        }

        $data['gantt_data'] = (new AllProjectsGantt([
            'status' => $selected_statuses,
            'member' => $selectedMember,
        ]))->get();
        

        $this->load->view('admin/projects/gantt', $data);
    }

    public function view($id)
    {
        // if($this->input->post()){
       
        // print_r($data);
        // exit;
        // }
        //app_init_project_tabs is a helper function which is define in projects_helper file this is due to get the id,
        app_init_project_tabs($id);

        if (staff_can('view', 'projects') || $this->projects_model->is_member($id)) {
            close_setup_menu();
            $project = $this->projects_model->get($id);
            if (!$project) {
                blank_page(_l('project_not_found'));
            }
            $project->settings->available_features = unserialize($project->settings->available_features);
            $data['statuses']                      = $this->projects_model->get_project_statuses();
            $group = !$this->input->get('group') ? 'project_overview' : $this->input->get('group');
            // Unable to load the requested file: admin/projects/project_tasks#.php - FIX
            if (strpos($group, '#') !== false) {
                $group = str_replace('#', '', $group);
            }

            $data['tabs'] = get_project_tabs_admin();
            
            $data['tab']  = $this->app_tabs->filter_tab($data['tabs'], $group);

            if (!$data['tab']) {
                show_404();
            }
            $this->load->model('payment_modes_model');

            $data['payment_modes']              = $this->payment_modes_model->get('', [], true);
            $data['project']                    = $project;
            $data['currency']                   = $this->projects_model->get_currency($id);
            $data['project_total_logged_time']  = $this->projects_model->total_logged_time($id);
            $data['staff']                      = $this->staff_model->get('', ['active' => 1]);
            $percent                            = $this->projects_model->calc_progress($id);
            $data['bodyclass']                  = '';
            $data['provider']                   = $this->projects_model->fetch_provider($id);
            $data['policy_number']              = $this->projects_model->policy_number($id);
            $data['project_type']               = $this->projects_model->project_type($id);
            $data['adviser']                    = $this->projects_model->getAdviser($project->clientid);
            // print_r($data['adviser']);
            // exit;
            $single_array         = $this->projects_model->policydata($id);
            $data['policydata']= array_merge(...$single_array);


            // $data['policy_start_date']          = $this->projects_model->policy_start_date($id);

            

            // echo '<pre>';
            // print_r($data['policydata']);
            // exit;

            // $data['totalPremium']               = $this->projects_model->totalPremium($id);
            // $data['lifeAssured']                = $this->projects_model->lifeAssured($id);
            // $data['policyOwner']                = $this->projects_model->policyOwner($id);
          
            $this->app_scripts->add(
                'projects-js',
                base_url($this->app_scripts->core_file('assets/js', 'projects.js')) . '?v=' . $this->app_scripts->core_version(),
                'admin',
                ['app-js', 'jquery-comments-js', 'frappe-gantt-js', 'circle-progress-js']
            );

            if ($group == 'claims') {
                $data['projectid']              = $id;
                $data['contacts']               = $this->projects_model->getContact($project->clientid);
                $data['benefits']               = $this->projects_model->getBenefit();
                $data['outcome']                = $this->projects_model->fetch_outcome();
                $data['conditionalgroup']       = $this->projects_model->fetch_conditionalgroup();
                $data['reasonNoclaim']          = $this->projects_model->fetch_reasonNoclaim();
                $data['claimDetails']           = $this->projects_model->fetch_claim_saprately($id);
                $data['claimPaymentDetails']    = $this->projects_model->fetch_claim_payment($id);
            }

            if ($group == 'underwriting') {
                $data['projectid']                  = $id;
                $data['Notissuepolicy']             = $this->projects_model->fetch_Notissuepolicy();
                $data['commisionsplit']             = $this->projects_model->fetch_commisionsplit();
                $data['finalstatus']                = $this->projects_model->fetch_finalstatus();
                $data['fetchUnderwrittingStatus']   = $this->projects_model->fetchunderwrittingStatus($id);
                $data['underwritingDetails']        = $this->projects_model->fetchUnderwriting($id);
            }
            if ($group == 'cancellations') {
                $data['projectid']                  = $id;
                $data['source']                     = $this->projects_model->fetch_source();
                $data['cancellationOutcome']        = $this->projects_model->fetch_cancellationOutcome();
                $data['replacebusiness']            = $this->projects_model->fetch_replacebusiness();
                $data['replaceReason']              = $this->projects_model->fetch_replaceReason();
                $data['PolicyCommission']           = $this->projects_model->fetch_newPolicyCommission();
                $data['ReasonforCancellation']      = $this->projects_model->fetch_ReasonforCancellation();
                $data['cancellationDetails']        = $this->projects_model->fetchCancellations($id);
                $data['fetchCancellationStatus']    = $this->projects_model->fetchCancellationStatus();
                $data['benefitChange']              = $this->projects_model->fetchBenefitChange();

            }

            if ($group == 'arrears') {
                $data['projectid'] = $id;
                $data['reasonForArreas'] = $this->projects_model->fetch_reasonForArreas();
                $data['arreasStatus'] = $this->projects_model->fetch_arreasStatus();
                $data['save_Arrears'] = $this->projects_model->fetchsave_Arrears($id);
            }

            if ($group == 'group_compliances'){
                $filter = $this->input->get('filter'); // filter group_compliances  
               $data['projectid'] = $id;
               $adviser= $this->projects_model->getAdviser($project->clientid);
               $progress = $project->progress;
               $Workfelow_name= $project->name;
                // $stages = $this->projects_model->stages();
                $stages = $this->projects_model->projects_stages($id);
                  //$stages = [];
                foreach($stages as $str_data){
                        $complianceCategory =  $this->projects_model->fetchComplianceCategory($str_data['stage_id']);
                        //print_r($complianceCategory); exit;
                        foreach ($complianceCategory as $key => $value) {
                            $files = $this->projects_model->fetchFilesBasedOnStageCategory($id, $str_data['stage_id'], $value['id']);
                            if($files){
                                // echo 'testing';
                                // echo '<pre>';
                                // print_r($complianceCategory);
                            
                                $combinedArray[] =[
                                    'pid' => $id,
                                    'str_id' => $str_data['stage_id'],
                                    'adviser' =>$adviser,
                                    'progress' =>$progress,
                                    'workfelow_name'=> $Workfelow_name,
                                    'stage' => $str_data['stage_name'],
                                    'category'=> $value['compliance'],
                                    // 'category'=> $files[0]['category'],
                                    'file_id' => $files[0]['id'],
                                    'file_name_org'=>$files[0]['original_file_name'],
                                    'file_name'=>$files[0]['file_name'],
                                    'file_description' =>$files[0]['description'],
                                    'file_link' => $files[0]['filetype'],
                                    'updated_date'=> $files[0]['dateadded'],
                                    'uploaded_by'=> $files[0]['staff_name'],
                                    'workflow_status' => '',
                                    'categories_data' => $value['id']
                                ];
                             } else{
                                $combinedArray[] =[
                                    'pid' => $id,
                                    'str_id' => $str_data['stage_id'],
                                    'adviser' =>$adviser,
                                    'progress' =>$progress,
                                    'workfelow_name'=> $Workfelow_name,
                                    'stage' => $str_data['stage_name'],
                                    'category'=>  $value['compliance'],
                                    'file_id'=> '',
                                    'file_name'=>'',
                                    'file_name_org'=>'',
                                    // 'category'=> $files['category'],
                                    'file_description' =>'',
                                    'file_link' => '',
                                    'updated_date'=> '',
                                    'uploaded_by'=> '',
                                    'workflow_status' => '',
                                    'categories_data' => $value['id']
                                ];
                            }
                        } 
                        // exit;
                        $i++;
            } 
            foreach($combinedArray as $val){
                if ($val['file_id'] == ''){
                    $combinedfilterArray[] =[
                                'pid' => $id,
                                'adviser' =>$val['adviser'],
                                'progress' =>$val['progress'],
                                'workfelow_name'=> $val['workfelow_name'],
                                'stage' => $val['stage'],
                                'category'=> $val['category'],
                                'file_name_org'=>'',
                                'file_name'=>'',
                                'file_id'=>'',
                                'file_description' =>'',
                                'file_link' => '',
                                'updated_date'=> '',
                                'uploaded_by'=> '',
                                'workflow_status' => '',
                    ];
                  }
                }
                if($filter){
                     $data['combinedArray'] = $combinedfilterArray;
                     $data['filter'] = 1;
                }else{
                $data['combinedArray'] = $combinedArray;
                }

               //echo "<pre>";print_r($combinedArray); exit;



        //    echo "<pre>"; print_r($data['combinedArray']);
          

        //   echo "<pre>"; print_r($filter_array); 
          //exit;

             //echo "<pre>"; print_r($combinedArray); exit;
                // $combinedArray = [];
                // $i = 0;
                // foreach($stages as $stages_data) {
                //     foreach ($categories as $categories_data) {
                //         $files = $this->projects_model->fetchFilesBasedOnStageCategory($id, $stages_data['id'], $categories_data['id']);
                //         if (!empty($files)) {
                //             $combinedArray[$i]['stage'] = $stages_data['stage'];
                //             $combinedArray[$i]['category'] = $categories_data['category'];
                //             $combinedArray[$i]['files'] = $files;
                //             $i++;
                //         }
                //     }
                // }
                // $data['combinedArray'] = $combinedArray;
            }

            // if ($group == 'group_compliances'){
            //     $data['projectid'] = $id;
            //     $fileStages = $this->projects_model->fetchFilesStages($id);
            //     $stagesArray = [];
            //     $categoryArrayUnique = [];
            //     $category = [];
            //     foreach ($fileStages as $rowStage) {
            //         $stagesArray[] = $rowStage['stage_id'];
            //         $fileCategories = $this->projects_model->fetchFilesCategories($id, $rowStage['stage_id']);
            //         $categoryArray = [];
            //         foreach ($fileCategories as $rowCategory) {
            //             $categoryArray[] = $rowCategory['category_id'];
            //         }
            //         $uniqueCategoryArray = array_unique($categoryArray);
            //         $categoryArrayUnique[] = $uniqueCategoryArray;
            //     }
            //     $uniqueStageArray = array_unique($stagesArray);
            //     foreach ($uniqueStageArray as $uniqueStageRow) {
            //         foreach ($categoryArrayUnique as $uniqueCategoryRow) {
            //             echo $uniqueStageRow.'='.$uniqueCategoryRow.'<br>';
            //             //$category[] = $this->projects_model->fetchFilesData($uniqueStageRow, $uniqueCategoryRow);
            //         }
            //     }
                // foreach($fileData as $fileDatas){
                //     $category[] = $this->projects_model->fetch_Group_Stage($stage_id);
                // }
                //     $single = array_merge(...$category);
                // $data['unique_arrayStage'] = array_unique($single, SORT_REGULAR);

                // echo '<pre>';
                // print_r($category);
                // exit;


                //==========================================================================================

                // $filedata = $data['fileData'];
                // foreach($filedata as $filesdata){
                //     $stages[] = $this->projects_model->fetchGroupStage($filesdata['compliance_id']);
                // }


                // $single = array_merge(...$stages);
                // $data['unique_arrayStage'] = array_unique($single, SORT_REGULAR);
                // $unique_array_stage = $data['unique_arrayStage'];

                // $i=0;
                // $j=0;
                // $cat_group = [];
                // foreach($unique_array_stage as $unique_array_stages){
                //     $cat_group[$i] = $this->projects_model->fetchCategory_group($unique_array_stages['id']);
                //     // $singleCategory[] = array_merge(...$cat_group[$i]);
                //     $cat_group[$i] = array_unique($cat_group[$i], SORT_REGULAR);
                //     // $categoryId = $data['unique_arrayCategory'];
                    
                //     // print_r($cat_group[0][0]['category_id']) ;
                //     // exit;
                  
                //     foreach($cat_group[$i][$j] as $categoryIds[$i][$j]['category_id']){
                      
                //     //    print_r($cat_group[$i][$j]);
                //         $fetchCategory_groupAllData[$i][$j]= $this->projects_model->fetchCategory_groupAllData($categoryIds[$i][$j]['category_id'],$id);
                //         $j++;
                //     }
                //     $i++;
                // }
                // echo '<pre>';
                // print_r( $fetchCategory_groupAllData );
                // exit;
                
                    
                // foreach($categoryId as $categoryIds){
                //     $fetchCategory_groupAllData[] = $this->projects_model->fetchCategory_groupAllData($categoryIds['category_id'],$id);
                // }
                
                // $singleCategory = array_merge(...$fetchCategory_groupAllData);
                // $data['fetchCategory_groupAllData'] = array_unique($singleCategory, SORT_REGULAR);
               

                // $data['fetchCategory_groupAllData'] = $fetchCategory_groupAllData;

                // foreach($filedata as $filesdata){
                //     $groupcategory[] = $this->projects_model->fetchGroupcategory($filesdata['compliance_id']);
                // }
                // $singleCategory = array_merge(...$groupcategory);
                // $data['unique_arrayCategory'] = array_unique($singleCategory, SORT_REGULAR);

                // $data['allData'] = array_merge($unique_array_stage,$categoryId,$singleCategory);

                // echo '<pre>';
                // print_r( $singleCategory );
                // exit;
               
            // }


            // if ($group == 'group_compliances'){
            //     $data['projectid'] = $id;
            //     $data['fileData'] = $this->projects_model->fetchFilesData($id);
            //     $filedata = $data['fileData'];
            //     foreach($filedata as $filesdata){
            //         $stages[] = $this->projects_model->fetchGroupStage($filesdata['compliance_id']);
            //     }

            //     $single = array_merge(...$stages);
            //     $data['unique_arrayStage'] = array_unique($single, SORT_REGULAR);
            //     $unique_array_stage = $data['unique_arrayStage'];
            //     $i=0;
            //     $j=0;
            //     $cat_group = [];
            //     foreach($unique_array_stage as $unique_array_stages){
            //         $cat_group[$i] = $this->projects_model->fetchCategory_group($unique_array_stages['id']);
            //         // $singleCategory[] = array_merge(...$cat_group[$i]);
            //         $cat_group[$i] = array_unique($cat_group[$i], SORT_REGULAR);
            //         // $categoryId = $data['unique_arrayCategory'];
                    
            //         // print_r($cat_group[0][0]['category_id']) ;
            //         // exit;
                  
            //         foreach($cat_group[$i][$j] as $categoryIds[$i][$j]['category_id']){
                      
            //         //    print_r($cat_group[$i][$j]);
            //             $fetchCategory_groupAllData[$i][$j]= $this->projects_model->fetchCategory_groupAllData($categoryIds[$i][$j]['category_id'],$id);
            //             $j++;
            //         }
            //         $i++;
            //     }
            //     // echo '<pre>';
            //     // print_r( $fetchCategory_groupAllData );
            //     // exit;
                
                    
            //     foreach($categoryId as $categoryIds){
            //         $fetchCategory_groupAllData[] = $this->projects_model->fetchCategory_groupAllData($categoryIds['category_id'],$id);
            //     }
                
            //     $singleCategory = array_merge(...$fetchCategory_groupAllData);
            //     $data['fetchCategory_groupAllData'] = array_unique($singleCategory, SORT_REGULAR);
               

            //     $data['fetchCategory_groupAllData'] = $fetchCategory_groupAllData;

            //     foreach($filedata as $filesdata){
            //         $groupcategory[] = $this->projects_model->fetchGroupcategory($filesdata['compliance_id']);
            //     }
            //     $singleCategory = array_merge(...$groupcategory);
            //     $data['unique_arrayCategory'] = array_unique($singleCategory, SORT_REGULAR);

            //     $data['allData'] = array_merge($unique_array_stage,$categoryId,$singleCategory);

            //     // echo '<pre>';
            //     // print_r( $singleCategory );
            //     // exit;
               
            // }


            // if ($group == 'group_compliances'){
            //     $data['projectid'] = $id;
            //     $data['fileData'] = $this->projects_model->fetchFilesData($id);
            //     $filedata = $data['fileData'];
                
            //     foreach($filedata as $filesdata){
            //         $stages[] = $this->projects_model->fetchGroupStage($filesdata['compliance_id']);
            //     }
            //     $single = array_merge(...$stages);
            //     $data['unique_arrayStage'] = array_unique($single, SORT_REGULAR);
            //     $unique_array_stage = $data['unique_arrayStage'];

            //     foreach($unique_array_stage as $unique_array_stages){
            //         $cat_group[] = $this->projects_model->fetchCategory_group($unique_array_stages['id']);
            //     }

            //     $singleCategory = array_merge(...$cat_group);
            //     $data['unique_arrayCategory'] = array_unique($singleCategory, SORT_REGULAR);
            //     $categoryId = $data['unique_arrayCategory'];

            //     // foreach($categoryId as $categoryIds){
            //     //     $fetchCategory_groupAllData[] = $this->projects_model->fetchCategory_groupAllData($categoryIds['category_id'],$id);
            //     // }

            //     foreach($categoryId as $categoryIds){
            //         $fetchCategory_groupAllData[] = $this->projects_model->fetchCategory_groupAllData($categoryIds['category_id'],$id);
            //     }
                
            //     $singleCategory = array_merge(...$fetchCategory_groupAllData);
            //     $data['fetchCategory_groupAllData'] = array_unique($singleCategory, SORT_REGULAR);
               

                // $data['fetchCategory_groupAllData'] = $fetchCategory_groupAllData;

                // foreach($filedata as $filesdata){
                //     $groupcategory[] = $this->projects_model->fetchGroupcategory($filesdata['compliance_id']);
                // }
                // $singleCategory = array_merge(...$groupcategory);
                // $data['unique_arrayCategory'] = array_unique($singleCategory, SORT_REGULAR);

                // echo '<pre>';
                // print_r($unique_array_stage);
                // exit;
               
            // }



            // if ($group == 'group_compliances'){
            //     $data['projectid'] = $id;
            //     $data['fileData'] = $this->projects_model->fetchFilesData($id);
            //     $filedata = $data['fileData'];
                
            //     foreach($filedata as $filesdata){
            //         $stages[] = $this->projects_model->fetchGroupStage($filesdata['compliance_id']);
                   
            //     }
            //     $single = array_merge(...$stages);
            //     $data['unique_arrayStage'] = array_unique($single, SORT_REGULAR);
            //     $unique_array_stage = $data['unique_arrayStage'];

            //     // echo '<pre>';
            //     // print_r($unique_array_stage);
            //     // exit;
            // }
          
            if ($group == 'project_overview') {
                $data['members'] = $this->projects_model->get_project_members($id);
                foreach ($data['members'] as $key => $member) {
                    $data['members'][$key]['total_logged_time'] = 0;
                    $member_timesheets                          = $this->tasks_model->get_unique_member_logged_task_ids($member['staff_id'], ' AND task_id IN (SELECT id FROM ' . db_prefix() . 'tasks WHERE rel_type="project" AND rel_id="' . $this->db->escape_str($id) . '")');

                    foreach ($member_timesheets as $member_task) {
                        $data['members'][$key]['total_logged_time'] += $this->tasks_model->calc_task_total_time($member_task->task_id, ' AND staff_id=' . $member['staff_id']);
                    }
                }
                $data['project_total_days']        = round((human_to_unix($data['project']->deadline . ' 00:00') - human_to_unix($data['project']->start_date . ' 00:00')) / 3600 / 24);
                $data['project_days_left']         = $data['project_total_days'];
                $data['project_time_left_percent'] = 100;
                if ($data['project']->deadline) {
                    if (human_to_unix($data['project']->start_date . ' 00:00') < time() && human_to_unix($data['project']->deadline . ' 00:00') > time()) {
                        $data['project_days_left']         = round((human_to_unix($data['project']->deadline . ' 00:00') - time()) / 3600 / 24);
                        $data['project_time_left_percent'] = $data['project_days_left'] / $data['project_total_days'] * 100;
                        $data['project_time_left_percent'] = round($data['project_time_left_percent'], 2);
                    }
                    if (human_to_unix($data['project']->deadline . ' 00:00') < time()) {
                        $data['project_days_left']         = 0;
                        $data['project_time_left_percent'] = 0;
                    }
                }

                $__total_where_tasks = 'rel_type = "project" AND rel_id=' . $this->db->escape_str($id);
                if (!staff_can('view', 'tasks')) {
                    $__total_where_tasks .= ' AND ' . db_prefix() . 'tasks.id IN (SELECT taskid FROM ' . db_prefix() . 'task_assigned WHERE staffid = ' . get_staff_user_id() . ')';

                    if (get_option('show_all_tasks_for_project_member') == 1) {
                        $__total_where_tasks .= ' AND (rel_type="project" AND rel_id IN (SELECT project_id FROM ' . db_prefix() . 'project_members WHERE staff_id=' . get_staff_user_id() . '))';
                    }
                }
                $__total_where_tasks = hooks()->apply_filters('admin_total_project_tasks_where', $__total_where_tasks, $id);

                $where = ($__total_where_tasks == '' ? '' : $__total_where_tasks . ' AND ') . 'status != ' . Tasks_model::STATUS_COMPLETE;

                $data['tasks_not_completed'] = total_rows(db_prefix() . 'tasks', $where);
                $total_tasks                 = total_rows(db_prefix() . 'tasks', $__total_where_tasks);
                $data['total_tasks']         = $total_tasks;

                $where = ($__total_where_tasks == '' ? '' : $__total_where_tasks . ' AND ') . 'status = ' . Tasks_model::STATUS_COMPLETE . ' AND rel_type="project" AND rel_id="' . $id . '"';

                $data['tasks_completed'] = total_rows(db_prefix() . 'tasks', $where);

                $data['tasks_not_completed_progress'] = ($total_tasks > 0 ? number_format(($data['tasks_completed'] * 100) / $total_tasks, 2) : 0);
                $data['tasks_not_completed_progress'] = round($data['tasks_not_completed_progress'], 2);

                @$percent_circle        = $percent / 100;
                $data['percent_circle'] = $percent_circle;

                $data['project_overview_chart'] = (new HoursOverviewChart(
                    $id,
                    ($this->input->get('overview_chart') ? $this->input->get('overview_chart') : 'this_week')
                ))->get();
            } elseif ($group == 'project_invoices') {
                $this->load->model('invoices_model');

                $data['invoiceid']   = '';
                $data['status']      = '';
                $data['custom_view'] = '';
                $data['invoices_years']       = $this->invoices_model->get_invoices_years();
                $data['invoices_sale_agents'] = $this->invoices_model->get_sale_agents();
                $data['invoices_statuses']    = $this->invoices_model->get_statuses();
            } elseif ($group == 'project_gantt') {
                $gantt_type         = (!$this->input->get('gantt_type') ? 'milestones' : $this->input->get('gantt_type'));
                $taskStatus         = (!$this->input->get('gantt_task_status') ? null : $this->input->get('gantt_task_status'));
                $data['gantt_data'] = (new Gantt($id, $gantt_type))->forTaskStatus($taskStatus)->get();
            } elseif ($group == 'project_milestones') {
                $data['bodyclass'] .= 'project-milestones ';
                $data['milestones_exclude_completed_tasks'] = $this->input->get('exclude_completed') && $this->input->get('exclude_completed') == 'yes' || !$this->input->get('exclude_completed');
                $data['total_milestones'] = total_rows(db_prefix() . 'milestones', ['project_id' => $id]);
                $data['milestones_found'] = $data['total_milestones'] > 0 || (!$data['total_milestones'] && total_rows(db_prefix() . 'tasks', ['rel_id' => $id, 'rel_type' => 'project', 'milestone' => 0]) > 0);
            } elseif ($group == 'project_files') {
                ini_set('display_errors', 1);
                $data['files'] = $this->projects_model->get_files($id);
                $data['ctegory'] = $this->projects_model->fetchCategory();
                $data['complience'] = $this->projects_model->fetchComplience();
            } elseif ($group == 'project_expenses') {
                $this->load->model('taxes_model');
                $this->load->model('expenses_model');
                $data['taxes']              = $this->taxes_model->get();
                $data['expense_categories'] = $this->expenses_model->get_category();
                $data['currencies']         = $this->currencies_model->get();
            } elseif ($group == 'project_activity') {
                $data['activity'] = $this->projects_model->get_activity($id);
            } elseif ($group == 'project_notes') {
                $data['staff_notes'] = $this->projects_model->get_staff_notes($id);
            } elseif ($group == 'project_contracts') {
                $this->load->model('contracts_model');
                $data['contract_types'] = $this->contracts_model->get_contract_types();
                $data['years']          = $this->contracts_model->get_contracts_years();
            } elseif ($group == 'project_estimates') {
                $this->load->model('estimates_model');
                $data['estimates_years'] = $this->estimates_model->get_estimates_years();
                $data['estimates_sale_agents'] = $this->estimates_model->get_sale_agents();
                $data['estimate_statuses'] = $this->estimates_model->get_statuses();
                $data['estimateid'] = '';
                $data['switch_pipeline'] = '';
            } elseif ($group == 'project_proposals') {
                $this->load->model('proposals_model');
                $data['proposal_statuses'] = $this->proposals_model->get_statuses();
                $data['proposals_sale_agents'] = $this->proposals_model->get_sale_agents();
                $data['years'] = $this->proposals_model->get_proposals_years();
                $data['proposal_id'] = '';
                $data['switch_pipeline'] = '';
            } elseif ($group == 'project_tickets') {
                $data['chosen_ticket_status'] = '';
                $this->load->model('tickets_model');
                $data['ticket_assignees'] = $this->tickets_model->get_tickets_assignes_disctinct();
                $this->load->model('departments_model');
                $data['staff_deparments_ids']          = $this->departments_model->get_staff_departments(get_staff_user_id(), true);
                $data['default_tickets_list_statuses'] = hooks()->apply_filters('default_tickets_list_statuses', [1, 2, 4]);
            } elseif ($group == 'project_timesheets') {
                // Tasks are used in the timesheet dropdown
                // Completed tasks are excluded from this list because you can't add timesheet on completed task.
                $data['tasks']                = $this->projects_model->get_tasks($id, 'status != ' . Tasks_model::STATUS_COMPLETE . ' AND billed=0');
                $data['timesheets_staff_ids'] = $this->projects_model->get_distinct_tasks_timesheets_staff($id);
            }

            // Discussions
            if ($this->input->get('discussion_id')) {
                $data['discussion_user_profile_image_url'] = staff_profile_image_url(get_staff_user_id());
                $data['discussion']                        = $this->projects_model->get_discussion($this->input->get('discussion_id'), $id);
                $data['current_user_is_admin']             = is_admin();
            }

            $data['percent'] = $percent;

            $this->app_scripts->add('circle-progress-js', 'assets/plugins/jquery-circle-progress/circle-progress.min.js');

            $other_projects       = [];
            $other_projects_where = 'id != ' . $id;

            $statuses = $this->projects_model->get_project_statuses();

            $other_projects_where .= ' AND (';
            foreach ($statuses as $status) {
                if (isset($status['filter_default']) && $status['filter_default']) {
                    $other_projects_where .= 'status = ' . $status['id'] . ' OR ';
                }
            }
            $other_projects_where = rtrim($other_projects_where, ' OR ');

            $other_projects_where .= ')';

            if (!staff_can('view', 'projects')) {
                $other_projects_where .= ' AND ' . db_prefix() . 'projects.id IN (SELECT project_id FROM ' . db_prefix() . 'project_members WHERE staff_id=' . get_staff_user_id() . ')';
            }
            $data['other_projects'] = $this->projects_model->get('', $other_projects_where);
            $data['title']          = $data['project']->name;
            $data['bodyclass'] .= 'project invoices-total-manual estimates-total-manual';
            $data['project_status'] = get_project_status_by_id($project->status);
            $data['project_type'] = $this->projects_model->project_type($id);
            $this->load->view('admin/projects/view', $data);
        } else {
            access_denied('Project View');
        }
    }
  
    public function projectype(){
        $this->load->model('projects_model');
        $data['data'] = $this->projects_model->fetchprojecttype();
        $this->load->view('admin/projects/project_type',$data);
    }

    public function saveProjectType(){
        $data = [
            'project_type' => $this->input->post('projecttype'),
        ];
        $this->load->model('Projects_model');
        $this->projects_model->save_projecttype($data);
        redirect(admin_url('projects/projectype'));
    }

    public function deleteProjectType(){
        $data = [
            'is_deleted' =>  1,
        ];
        $id = $this->uri->segment(4);
        set_alert('success', 'Deleted Successfully');
        $this->load->model('projects_model');
        $this->projects_model->delete_covertype($data,$id);
        redirect(admin_url('projects/projectype'));
    }

    public function projectOutcome(){
        $this->load->model('projects_model');
        $data['data'] = $this->projects_model->fetch_outcome();
        $this->load->view('admin/projects/outcome', $data);
    }

    public function saveprojectOutcome(){
        $data = [
        'outcome' => $this->input->post('outcome'),
    ];
        $this->projects_model->saveproject_outcome($data);
        redirect(admin_url('projects/projectOutcome'));
    }

    public function deleteProjectoutcome(){
        $data = [
            'is_deleted' => 1,
        ];
        $id = $this->uri->segment(4);
        set_alert('success', 'Deleted Successfully');
        $this->projects_model->delete_projectOutcome($data,$id);
        redirect(admin_url('projects/projectOutcome'));
    }

    public function reasonforCancellation(){
        $this->load->model('projects_model');
        $data['data'] = $this->projects_model->fetch_ReasonforCancellation();
        $this->load->view('admin/projects/reason_cancellation', $data);
    }

    public function saveReasonforCancellation(){
        $data = [
        'reason_for_cancelletion' => $this->input->post('reason_for_cancelletion'),
    ];
        $this->projects_model->savereasonforCancellation($data);
        redirect(admin_url('projects/reasonforCancellation'));
    }

    public function deleteReasonforCancellation(){
        $data = [
            'is_deleted' => 1,
        ];
        $id = $this->uri->segment(4);
        set_alert('success', 'Deleted Successfully');
        $this->projects_model->delete_ReasonforCancellation($data,$id);
        redirect(admin_url('projects/reasonforCancellation'));
    }

    public function reasonNoClaim(){
        $this->load->model('projects_model');
        $data['data'] = $this->projects_model->fetch_reasonNoclaim();
        $this->load->view('admin/projects/reason_noclaim', $data);
    }

    public function saveclaimreason(){
       $data = [
        'reason_noclaim' => $this->input->post('reason_noclaim'),
    ];
       $this->projects_model->saveclaimReason($data);
       redirect(admin_url('projects/reasonNoClaim'));
    }

    public function deleteclaimReason(){
        $data = [
            'is_deleted' => 1,
        ];
        $id = $this->uri->segment(4);
        set_alert('success', 'Deleted Successfully');
        $this->projects_model->delete_claimreason($data,$id);
        redirect(admin_url('projects/reasonNoClaim'));
    }

    public function conditionalgroup(){
        $this->load->model('projects_model');
        $data['data'] = $this->projects_model->fetch_conditionalgroup();
        $this->load->view('admin/projects/Condition_Groups', $data);
    }

    public function saveconditionalgroup(){
        $data = [
        'condition_qroups' => $this->input->post('condition_qroups'),
    ];
       $this->projects_model->saveconditionalGroup($data);
       redirect(admin_url('projects/conditionalgroup'));
    }

    public function deleteconditionalgroup(){
        $data = [
            'is_deleted' => 1,
        ];
        $id = $this->uri->segment(4);
        set_alert('success', 'Deleted Successfully');
        $this->projects_model->delete_conditionalgroup($data,$id);
        redirect(admin_url('projects/conditionalgroup'));
    }

    public function finalstatus(){
        $this->load->model('projects_model');
        $data['data'] = $this->projects_model->fetch_finalstatus();
        $this->load->view('admin/projects/final_status', $data);
    }

    public function savefinalstatus(){
        $data = [
            'final_status' => $this->input->post('final_status'),
        ];
        $this->projects_model->savefinalStatus($data);
        redirect(admin_url('projects/finalstatus'));
    }

    public function deletefinalstatus(){
        $data = [
            'is_deleted' => 1,
        ];
        $id = $this->uri->segment(4);
        set_alert('success', 'Deleted Successfully');
        $this->projects_model->delete_finalstatus($data,$id);
        redirect(admin_url('projects/finalstatus'));
    }

   public function daterequestIssue(){
        $this->load->model('projects_model');
        $data['data'] = $this->projects_model->fetch_DateIssue();
        $this->load->view('admin/projects/Date_Requested_Issue', $data);
    }

    public function savedateissue(){
        $data = [
            'date_request_Issue' => $this->input->post('date_request_Issue'),
        ];
        $this->projects_model->saveDateissue($data);
        redirect(admin_url('projects/daterequestIssue'));
    }

    public function deletedateissue(){
        $data = [
            'is_deleted' => 1,
        ];
        $id = $this->uri->segment(4);
        set_alert('success', 'Deleted Successfully');
        $this->projects_model->delete_dateIssue($data,$id);
        redirect(admin_url('projects/daterequestIssue'));
    }

    public function reasonNotissuepolicy(){
        $this->load->model('projects_model');
        $data['data'] = $this->projects_model->fetch_Notissuepolicy();
        $this->load->view('admin/projects/reason_notIssuePolicy', $data);
        }

    public function saveNotissuepolicy(){
        $data = [
            'issue_policy' => $this->input->post('issue_policy'),
        ];
        $this->projects_model->saveNotissuePolicy($data);
        redirect(admin_url('projects/reasonNotissuepolicy'));
    }

    public function deleteNotissuepolicy(){
        $data = [
            'is_deleted' => 1,
        ];
        $id = $this->uri->segment(4);
        set_alert('success', 'Deleted Successfully');
        $this->projects_model->delete_Notissuepolicy($data,$id);
        redirect(admin_url('projects/reasonNotissuepolicy'));
    }

   
    public function source(){

        $this->load->model('projects_model');
        $data['data'] = $this->projects_model->fetch_source();
        $this->load->view('admin/projects/source', $data);
        }

    public function savesource(){
        $data = [
            'source' => $this->input->post('source'),
        ];
        $this->projects_model->saveSource($data);
        redirect(admin_url('projects/source'));
    }

    public function deletesource(){
        $data = [
            'is_deleted' => 1,
        ];
        $id = $this->uri->segment(4);
        set_alert('success', 'Deleted Successfully');
        $this->projects_model->delete_Source($data,$id);
        redirect(admin_url('projects/source'));
    }

    public function replaceBusiness(){

        $this->load->model('projects_model');
        $data['data'] = $this->projects_model->fetch_replacebusiness();
        $this->load->view('admin/projects/replacement_business', $data);
        }

    public function saveReplaceBusiness(){
        $data = [
            'replacement_business' => $this->input->post('replacement_business'),
        ];
        $this->projects_model->saveReplacebusines($data);
        redirect(admin_url('projects/replaceBusiness'));
    }

    public function deleteReplaceBusiness(){
        $data = [
            'is_deleted' => 1,
        ];
        $id = $this->uri->segment(4);
        set_alert('success', 'Deleted Successfully');
        $this->projects_model->delete_replacebusiness($data,$id);
        redirect(admin_url('projects/replaceBusiness'));
    }

    public function replaceReason(){
        $this->load->model('projects_model');
        $data['data'] = $this->projects_model->fetch_replaceReason();
        $this->load->view('admin/projects/replacement_reason', $data);
        }

    public function saveReplaceReason(){
        $data = [
            'replacement_reason' => $this->input->post('replacement_reason'),
        ];
        $this->projects_model->savereplaceReason($data);
        redirect(admin_url('projects/replaceReason'));
    }

    public function deleteReplaceReason(){
        $data = [
            'is_deleted' => 1,
        ];
        $id = $this->uri->segment(4);
        set_alert('success', 'Deleted Successfully');
        $this->projects_model->delete_replaceReason($data,$id);
        redirect(admin_url('projects/replaceReason'));
    }

    public function cancellationOutcome(){
        $this->load->model('projects_model');
        $data['data'] = $this->projects_model->fetch_cancellationOutcome();
        $this->load->view('admin/projects/cancellation_outcome', $data);
        }

    public function savecancellationOutcome(){
        $data = [
            'outcome_cancellation' => $this->input->post('outcome_cancellation'),
        ];
        $this->projects_model->save_cancellationOutcome($data);
        redirect(admin_url('projects/cancellationOutcome'));
    }

    public function deletecancellationOutcome(){
        $data = [
            'is_deleted' => 1,
        ];
        $id = $this->uri->segment(4);
        set_alert('success', 'Deleted Successfully');
        $this->projects_model->delete_cancellationOutcome($data,$id);
        redirect(admin_url('projects/cancellationOutcome'));
    }

    public function newPolicyCommission(){
        $this->load->model('projects_model');
        $data['data'] = $this->projects_model->fetch_newPolicyCommission();
        $this->load->view('admin/projects/newpolicy_commission', $data);
        }

    public function savenewPolicyCommission(){
        $data = [
            'new_policy_commission' => $this->input->post('new_policy_commission'),
        ];
        $this->projects_model->save_newPolicyCommission($data);
        redirect(admin_url('projects/newPolicyCommission'));
    }

    public function deletenewPolicyCommission(){
        $data = [
            'is_deleted' => 1,
        ];
        $id = $this->uri->segment(4);
        set_alert('success', 'Deleted Successfully');
        $this->projects_model->delete_newPolicyCommission($data,$id);
        redirect(admin_url('projects/newPolicyCommission'));
    }

    public function category(){
        $this->load->model('projects_model');
        $data['data'] = $this->projects_model->fetchCategory();
        $this->load->view('admin/projects/project_category',$data);
    }

    public function saveCategory(){
        $data = [
            'category' => $this->input->post('category'),
        ];
        $this->load->model('Projects_model');
        $this->projects_model->save_Category($data);
        redirect(admin_url('projects/category'));
    }



    public function deleteCategory(){
        $data = [
            'is_deleted' =>  1,
        ];
        $id = $this->uri->segment(4);
        set_alert('success', 'Deleted Successfully');
        $this->load->model('projects_model');
        $this->projects_model->delete_Category($data,$id);
        redirect(admin_url('projects/category'));
    }

    public function mark_as()
    {
        // $data = $this->input->post();
        // print_r($data);
        // exit;
        $success = false;
        $message = '';
        if ($this->input->is_ajax_request()) {
            // $data = $this->input->is_ajax_request();
            // echo($data);
            // exit;
            if (staff_can('create', 'projects') || staff_can('edit', 'projects')) {
                $status = get_project_status_by_id($this->input->post('status_id'));

                $message = _l('project_marked_as_failed', $status['name']);
                $success = $this->projects_model->mark_as($this->input->post());

                if ($success) {
                    $message = _l('project_marked_as_success', $status['name']);
                }
            }
        }
        echo json_encode([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function file($id, $project_id)
    {
        $data['discussion_user_profile_image_url'] = staff_profile_image_url(get_staff_user_id());
        $data['current_user_is_admin']             = is_admin();

        $data['file'] = $this->projects_model->get_file($id, $project_id);

        if (!$data['file']) {
            header('HTTP/1.0 404 Not Found');
            die;
        }

        $this->load->view('admin/projects/_file', $data);
    }

    public function update_file_data()
    {
        if ($this->input->post()) {
            $this->projects_model->update_file_data($this->input->post());
        }
    }

    public function add_external_file()
    {
        if ($this->input->post()) {
            $data                        = [];
            $data['project_id']          = $this->input->post('project_id');
            $data['files']               = $this->input->post('files');
            $data['external']            = $this->input->post('external');
            $data['visible_to_customer'] = ($this->input->post('visible_to_customer') == 'true' ? 1 : 0);
            $data['staffid']             = get_staff_user_id();
            $this->projects_model->add_external_file($data);
        }
    }

    public function download_all_files($id)
    {
        if ($this->projects_model->is_member($id) || staff_can('view', 'projects')) {
            $files = $this->projects_model->get_files($id);
            if (count($files) == 0) {
                set_alert('warning', _l('no_files_found'));
                redirect(admin_url('projects/view/' . $id . '?group=project_files'));
            }
            $path = get_upload_path_by_type('project') . $id;
            $this->load->library('zip');
            foreach ($files as $file) {
                if ($file['original_file_name'] != '') {
                    $this->zip->read_file($path . '/' . $file['file_name'], $path . '/' . $file['original_file_name']);
                } else {
                    $this->zip->read_file($path . '/' . $file['file_name']);
                }
            }
            $this->zip->download(slug_it(get_project_name_by_id($id)) . '-files.zip');
            $this->zip->clear_data();
        }
    }

    public function export_project_data($id)
    {
        if (staff_can('create', 'projects')) {
            app_pdf('project-data', LIBSPATH . 'pdf/Project_data_pdf', $id);
        }
    }

    public function update_task_milestone()
    {
        if ($this->input->post()) {
            $this->projects_model->update_task_milestone($this->input->post());
        }
    }

    public function update_milestones_order()
    {
        if ($post_data = $this->input->post()) {
            $this->projects_model->update_milestones_order($post_data);
        }
    }

    public function pin_action($project_id)
    {
        $this->projects_model->pin_action($project_id);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function add_edit_members($project_id)
    {
        if (staff_can('edit', 'projects')) {
            $this->projects_model->add_edit_members($this->input->post(), $project_id);
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function discussions($project_id)
    {
        if ($this->projects_model->is_member($project_id) || staff_can('view', 'projects')) {
            if ($this->input->is_ajax_request()) {
                $this->app->get_table_data('project_discussions', [
                    'project_id' => $project_id,
                ]);
            }
        }
    }

    public function discussion($id = '')
    {
        if ($this->input->post()) {
            $message = '';
            $success = false;
            if (!$this->input->post('id')) {
                $id = $this->projects_model->add_discussion($this->input->post());
                if ($id) {
                    $success = true;
                    $message = _l('added_successfully', _l('project_discussion'));
                }
                echo json_encode([
                    'success' => $success,
                    'message' => $message,
                ]);
            } else {
                $data = $this->input->post();
                $id   = $data['id'];
                unset($data['id']);
                $success = $this->projects_model->edit_discussion($data, $id);
                if ($success) {
                    $message = _l('updated_successfully', _l('project_discussion'));
                }
                echo json_encode([
                    'success' => $success,
                    'message' => $message,
                ]);
            }
            die;
        }
    }

    public function get_discussion_comments($id, $type)
    {
        echo json_encode($this->projects_model->get_discussion_comments($id, $type));
    }

    public function add_discussion_comment($discussion_id, $type)
    {
        echo json_encode($this->projects_model->add_discussion_comment(
            $this->input->post(null, false),
            $discussion_id,
            $type
        ));
    }

    public function update_discussion_comment()
    {
        echo json_encode($this->projects_model->update_discussion_comment($this->input->post(null, false)));
    }

    public function delete_discussion_comment($id)
    {
        echo json_encode($this->projects_model->delete_discussion_comment($id));
    }

    public function delete_discussion($id)
    {
        $success = false;
        if (staff_can('delete', 'projects')) {
            $success = $this->projects_model->delete_discussion($id);
        }
        $alert_type = 'warning';
        $message    = _l('project_discussion_failed_to_delete');
        if ($success) {
            $alert_type = 'success';
            $message    = _l('project_discussion_deleted');
        }
        echo json_encode([
            'alert_type' => $alert_type,
            'message'    => $message,
        ]);
    }

    public function change_milestone_color()
    {
        if ($this->input->post()) {
            $this->projects_model->update_milestone_color($this->input->post());
        }
    }

    public function upload_file($project_id)
    {
        handle_project_file_uploads($project_id);
    }

    public function change_file_visibility($id, $visible)
    {
        if ($this->input->is_ajax_request()) {
            $this->projects_model->change_file_visibility($id, $visible);
        }
    }

    public function change_activity_visibility($id, $visible)
    {
        if (staff_can('create', 'projects')) {
            if ($this->input->is_ajax_request()) {
                $this->projects_model->change_activity_visibility($id, $visible);
            }
        }
    }

    public function remove_file($project_id, $id)
    {
        $this->projects_model->remove_file($id);
        redirect(admin_url('projects/view/' . $project_id . '?group=project_files'));
    }

    public function milestones_kanban()
    {
        $data['milestones_exclude_completed_tasks'] = $this->input->get('exclude_completed_tasks') && $this->input->get('exclude_completed_tasks') == 'yes';

        $data['project_id'] = $this->input->get('project_id');
        $data['milestones'] = [];

        $data['milestones'][] = [
            'name'              => _l('milestones_uncategorized'),
            'id'                => 0,
            'total_logged_time' => $this->projects_model->calc_milestone_logged_time($data['project_id'], 0),
            'color'             => null,
        ];

        $_milestones = $this->projects_model->get_milestones($data['project_id']);

        foreach ($_milestones as $m) {
            $data['milestones'][] = $m;
        }

        echo $this->load->view('admin/projects/milestones_kan_ban', $data, true);
    }

    public function milestones_kanban_load_more()
    {
        $milestones_exclude_completed_tasks = $this->input->get('exclude_completed_tasks') && $this->input->get('exclude_completed_tasks') == 'yes';

        $status     = $this->input->get('status');
        $page       = $this->input->get('page');
        $project_id = $this->input->get('project_id');
        $where      = [];
        if ($milestones_exclude_completed_tasks) {
            $where['status !='] = Tasks_model::STATUS_COMPLETE;
        }
        $tasks = $this->projects_model->do_milestones_kanban_query($status, $project_id, $page, $where);
        foreach ($tasks as $task) {
            $this->load->view('admin/projects/_milestone_kanban_card', ['task' => $task, 'milestone' => $status]);
        }
    }

    public function milestones($project_id)
    {
        if ($this->projects_model->is_member($project_id) || staff_can('view', 'projects')) {
            if ($this->input->is_ajax_request()) {
                $this->app->get_table_data('milestones', [
                    'project_id' => $project_id,
                ]);
            }
        }
    }

    public function milestone($id = '')
    {
        if ($this->input->post()) {
            $message = '';
            $success = false;
            if (!$this->input->post('id')) {
                if (!staff_can('create_milestones', 'projects')) {
                    access_denied();
                }

                $id = $this->projects_model->add_milestone($this->input->post());
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('project_milestone')));
                }
            } else {
                if (!staff_can('edit_milestones', 'projects')) {
                    access_denied();
                }

                $data = $this->input->post();
                $id   = $data['id'];
                unset($data['id']);
                $success = $this->projects_model->update_milestone($data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('project_milestone')));
                }
            }
        }

        redirect(admin_url('projects/view/' . $this->input->post('project_id') . '?group=project_milestones'));
    }

    public function delete_milestone($project_id, $id)
    {
        if (staff_can('delete_milestones', 'projects')) {
            if ($this->projects_model->delete_milestone($id)) {
                set_alert('deleted', 'project_milestone');
            }
        }
        redirect(admin_url('projects/view/' . $project_id . '?group=project_milestones'));
    }

    public function bulk_action_files()
    {
        hooks()->do_action('before_do_bulk_action_for_project_files');
        $total_deleted       = 0;
        $hasPermissionDelete = staff_can('delete', 'projects');
        // bulk action for projects currently only have delete button
        if ($this->input->post()) {
            $fVisibility = $this->input->post('visible_to_customer') == 'true' ? 1 : 0;
            $ids         = $this->input->post('ids');
            if (is_array($ids)) {
                foreach ($ids as $id) {
                    if ($hasPermissionDelete && $this->input->post('mass_delete') && $this->projects_model->remove_file($id)) {
                        $total_deleted++;
                    } else {
                        $this->projects_model->change_file_visibility($id, $fVisibility);
                    }
                }
            }
        }
        if ($this->input->post('mass_delete')) {
            set_alert('success', _l('total_files_deleted', $total_deleted));
        }
    }

    public function timesheets($project_id)
    {
        if ($this->projects_model->is_member($project_id) || staff_can('view', 'projects')) {
            if ($this->input->is_ajax_request()) {
                $this->app->get_table_data('timesheets', [
                    'project_id' => $project_id,
                ]);
            }
        }
    }

    public function timesheet()
    {
        if ($this->input->post()) {
            if (
                $this->input->post('timer_id') &&
                !(staff_can('edit_timesheet', 'tasks') || (staff_can('edit_own_timesheet', 'tasks') && total_rows(db_prefix() . 'taskstimers', ['staff_id' => get_staff_user_id(), 'id' => $this->input->post('timer_id')]) > 0))
            ) {
                echo json_encode([
                    'success' => false,
                    'message' => _l('access_denied'),
                ]);
                die;
            }
            $message = '';
            $success = false;
            $success = $this->tasks_model->timesheet($this->input->post());
            if ($success === true) {
                $langKey = $this->input->post('timer_id') ? 'updated_successfully' : 'added_successfully';
                $message = _l($langKey, _l('project_timesheet'));
            } elseif (is_array($success) && isset($success['end_time_smaller'])) {
                $message = _l('failed_to_add_project_timesheet_end_time_smaller');
            } else {
                $message = _l('project_timesheet_not_updated');
            }
            echo json_encode([
                'success' => $success,
                'message' => $message,
            ]);
            die;
        }
    }

    public function timesheet_task_assignees($task_id, $project_id, $staff_id = 'undefined')
    {
        $assignees             = $this->tasks_model->get_task_assignees($task_id);
        $data                  = '';
        $has_permission_edit   = staff_can('edit', 'projects');
        $has_permission_create = staff_can('edit', 'projects');
        // The second condition if staff member edit their own timesheet
        if ($staff_id == 'undefined' || $staff_id != 'undefined' && (!$has_permission_edit || !$has_permission_create)) {
            $staff_id     = get_staff_user_id();
            $current_user = true;
        }
        foreach ($assignees as $staff) {
            $selected = '';
            // maybe is admin and not project member
            if ($staff['assigneeid'] == $staff_id && $this->projects_model->is_member($project_id, $staff_id)) {
                $selected = ' selected';
            }
            if ((!$has_permission_edit || !$has_permission_create) && isset($current_user)) {
                if ($staff['assigneeid'] != $staff_id) {
                    continue;
                }
            }
            $data .= '<option value="' . $staff['assigneeid'] . '"' . $selected . '>' . get_staff_full_name($staff['assigneeid']) . '</option>';
        }
        echo $data;
    }

    public function remove_team_member($project_id, $staff_id)
    {
        if (staff_can('edit', 'projects')) {
            if ($this->projects_model->remove_team_member($project_id, $staff_id)) {
                set_alert('success', _l('project_member_removed'));
            }
        }

        redirect(admin_url('projects/view/' . $project_id));
    }

    public function save_note($project_id)
    {
        if ($this->input->post()) {
            $success = $this->projects_model->save_note($this->input->post(null, false), $project_id);
            if ($success) {
                set_alert('success', _l('updated_successfully', _l('project_note')));
            }
            redirect(admin_url('projects/view/' . $project_id . '?group=project_notes'));
        }
    }

    public function delete($project_id)
    {
        if (staff_can('delete', 'projects')) {
            $project = $this->projects_model->get($project_id);
            $success = $this->projects_model->delete($project_id);
            if ($success) {
                set_alert('success', _l('deleted', _l('project')));
                if (strpos($_SERVER['HTTP_REFERER'], 'clients/') !== false) {
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    redirect(admin_url('projects'));
                }
            } else {
                set_alert('warning', _l('problem_deleting', _l('project_lowercase')));
                redirect(admin_url('projects/view/' . $project_id));
            }
        }
    }

    public function copy($project_id)
    {
        if (staff_can('create', 'projects')) {

            // $data_project['created_staff_id'] = get_staff_user_id();
           
            $data_project = $this->input->post();
            // echo '<pre>';
            // print_r($data_project);
            // exit;
            $id = $this->projects_model->copy($project_id, $data_project);
// ----15-10
            $_data = [
                'project_id'        => $id,
                'staff_id'          => get_staff_user_id(),
                'recieve_date'      => '',
                'reason_arrears'    => '',
                'apibeinglapsed'    => '',
                'advisercontacted'  => '',
                'arrears_status'    => '',
            ];
            $id_save_Arrears = $this->projects_model->save_Arrears($_data);
// 15-10


            if ($id) {
                set_alert('success', _l('project_copied_successfully'));
                redirect(admin_url('projects/view/' . $id));
            } else {
                set_alert('danger', _l('failed_to_copy_project'));
                redirect(admin_url('projects/view/' . $project_id));
            }
        }
    }

    public function mass_stop_timers($project_id, $billable = 'false')
    {
        if (staff_can('create', 'invoices')) {
            $where = [
                'billed'       => 0,
                'startdate <=' => date('Y-m-d'),
            ];
            if ($billable == 'true') {
                $where['billable'] = true;
            }
            $tasks                = $this->projects_model->get_tasks($project_id, $where);
            $total_timers_stopped = 0;
            foreach ($tasks as $task) {
                $this->db->where('task_id', $task['id']);
                $this->db->where('end_time IS NULL');
                $this->db->update(db_prefix() . 'taskstimers', [
                    'end_time' => time(),
                ]);
                $total_timers_stopped += $this->db->affected_rows();
            }
            $message = _l('project_tasks_total_timers_stopped', $total_timers_stopped);
            $type    = 'success';
            if ($total_timers_stopped == 0) {
                $type = 'warning';
            }
            echo json_encode([
                'type'    => $type,
                'message' => $message,
            ]);
        }
    }

    public function get_pre_invoice_project_info($project_id)
    {
        if (staff_can('create', 'invoices')) {
            $data['billable_tasks'] = $this->projects_model->get_tasks($project_id, [
                'billable'     => 1,
                'billed'       => 0,
                'startdate <=' => date('Y-m-d'),
            ]);

            $data['not_billable_tasks'] = $this->projects_model->get_tasks($project_id, [
                'billable'    => 1,
                'billed'      => 0,
                'startdate >' => date('Y-m-d'),
            ]);

            $data['project_id']   = $project_id;
            $data['billing_type'] = get_project_billing_type($project_id);

            $this->load->model('expenses_model');
            $this->db->where('invoiceid IS NULL');
            $data['expenses'] = $this->expenses_model->get('', [
                'project_id' => $project_id,
                'billable'   => 1,
            ]);

            $this->load->view('admin/projects/project_pre_invoice_settings', $data);
        }
    }

    public function get_invoice_project_data()
    {
        if (staff_can('create', 'invoices')) {
            $type       = $this->input->post('type');
            $project_id = $this->input->post('project_id');
            // Check for all cases
            if ($type == '') {
                $type == 'single_line';
            }
            $this->load->model('payment_modes_model');
            $data['payment_modes'] = $this->payment_modes_model->get('', [
                'expenses_only !=' => 1,
            ]);
            $this->load->model('taxes_model');
            $data['taxes']         = $this->taxes_model->get();
            $data['currencies']    = $this->currencies_model->get();
            $data['base_currency'] = $this->currencies_model->get_base_currency();
            $this->load->model('invoice_items_model');

            $data['ajaxItems'] = false;
            if (total_rows(db_prefix() . 'items') <= ajax_on_total_items()) {
                $data['items'] = $this->invoice_items_model->get_grouped();
            } else {
                $data['items']     = [];
                $data['ajaxItems'] = true;
            }

            $data['items_groups'] = $this->invoice_items_model->get_groups();
            $data['staff']        = $this->staff_model->get('', ['active' => 1]);
            $project              = $this->projects_model->get($project_id);
            $data['project']      = $project;
            $items                = [];

            $project    = $this->projects_model->get($project_id);
            $item['id'] = 0;

            $default_tax     = unserialize(get_option('default_tax'));
            $item['taxname'] = $default_tax;

            $tasks = $this->input->post('tasks');
            if ($tasks) {
                $item['long_description'] = '';
                $item['qty']              = 0;
                $item['task_id']          = [];
                if ($type == 'single_line') {
                    $item['description'] = $project->name;
                    foreach ($tasks as $task_id) {
                        $task = $this->tasks_model->get($task_id);
                        $sec  = $this->tasks_model->calc_task_total_time($task_id);
                        $item['long_description'] .= $task->name . ' - ' . seconds_to_time_format(task_timer_round($sec)) . ' ' . _l('hours') . "\r\n";
                        $item['task_id'][] = $task_id;
                        if ($project->billing_type == 2) {
                            if ($sec < 60) {
                                $sec = 0;
                            }
                            $item['qty'] += sec2qty(task_timer_round($sec));
                        }
                    }
                    if ($project->billing_type == 1) {
                        $item['qty']  = 1;
                        $item['rate'] = $project->project_cost;
                    } elseif ($project->billing_type == 2) {
                        $item['rate'] = $project->project_rate_per_hour;
                    }
                    $item['unit'] = '';
                    $items[]      = $item;
                } elseif ($type == 'task_per_item') {
                    foreach ($tasks as $task_id) {
                        $task                     = $this->tasks_model->get($task_id);
                        $sec                      = $this->tasks_model->calc_task_total_time($task_id);
                        $item['description']      = $project->name . ' - ' . $task->name;
                        $item['qty']              = floatVal(sec2qty(task_timer_round($sec)));
                        $item['long_description'] = seconds_to_time_format(task_timer_round($sec)) . ' ' . _l('hours');
                        if ($project->billing_type == 2) {
                            $item['rate'] = $project->project_rate_per_hour;
                        } elseif ($project->billing_type == 3) {
                            $item['rate'] = $task->hourly_rate;
                        }
                        $item['task_id'] = $task_id;
                        $item['unit']    = '';
                        $items[]         = $item;
                    }
                } elseif ($type == 'timesheets_individualy') {
                    $timesheets     = $this->projects_model->get_timesheets($project_id, $tasks);
                    $added_task_ids = [];
                    foreach ($timesheets as $timesheet) {
                        if ($timesheet['task_data']->billed == 0 && $timesheet['task_data']->billable == 1) {
                            $item['description'] = $project->name . ' - ' . $timesheet['task_data']->name;
                            if (!in_array($timesheet['task_id'], $added_task_ids)) {
                                $item['task_id'] = $timesheet['task_id'];
                            }

                            array_push($added_task_ids, $timesheet['task_id']);

                            $item['qty']              = floatVal(sec2qty(task_timer_round($timesheet['total_spent'])));
                            $item['long_description'] = _l('project_invoice_timesheet_start_time', _dt($timesheet['start_time'], true)) . "\r\n" . _l('project_invoice_timesheet_end_time', _dt($timesheet['end_time'], true)) . "\r\n" . _l('project_invoice_timesheet_total_logged_time', seconds_to_time_format(task_timer_round($timesheet['total_spent']))) . ' ' . _l('hours');

                            if ($this->input->post('timesheets_include_notes') && $timesheet['note']) {
                                $item['long_description'] .= "\r\n\r\n" . _l('note') . ': ' . $timesheet['note'];
                            }

                            if ($project->billing_type == 2) {
                                $item['rate'] = $project->project_rate_per_hour;
                            } elseif ($project->billing_type == 3) {
                                $item['rate'] = $timesheet['task_data']->hourly_rate;
                            }
                            $item['unit'] = '';
                            $items[]      = $item;
                        }
                    }
                }
            }
            if ($project->billing_type != 1) {
                $data['hours_quantity'] = true;
            }
            if ($this->input->post('expenses')) {
                if (isset($data['hours_quantity'])) {
                    unset($data['hours_quantity']);
                }
                if (count($tasks) > 0) {
                    $data['qty_hrs_quantity'] = true;
                }
                $expenses       = $this->input->post('expenses');
                $addExpenseNote = $this->input->post('expenses_add_note');
                $addExpenseName = $this->input->post('expenses_add_name');

                if (!$addExpenseNote) {
                    $addExpenseNote = [];
                }

                if (!$addExpenseName) {
                    $addExpenseName = [];
                }

                $this->load->model('expenses_model');
                foreach ($expenses as $expense_id) {
                    // reset item array
                    $item                     = [];
                    $item['id']               = 0;
                    $expense                  = $this->expenses_model->get($expense_id);
                    $item['expense_id']       = $expense->expenseid;
                    $item['description']      = _l('item_as_expense') . ' ' . $expense->name;
                    $item['long_description'] = $expense->description;

                    if (in_array($expense_id, $addExpenseNote) && !empty($expense->note)) {
                        $item['long_description'] .= PHP_EOL . $expense->note;
                    }

                    if (in_array($expense_id, $addExpenseName) && !empty($expense->expense_name)) {
                        $item['long_description'] .= PHP_EOL . $expense->expense_name;
                    }

                    $item['qty'] = 1;

                    $item['taxname'] = [];
                    if ($expense->tax != 0) {
                        array_push($item['taxname'], $expense->tax_name . '|' . $expense->taxrate);
                    }
                    if ($expense->tax2 != 0) {
                        array_push($item['taxname'], $expense->tax_name2 . '|' . $expense->taxrate2);
                    }
                    $item['rate']  = $expense->amount;
                    $item['order'] = 1;
                    $item['unit']  = '';
                    $items[]       = $item;
                }
            }
            $data['customer_id']          = $project->clientid;
            $data['invoice_from_project'] = true;
            $data['add_items']            = $items;
            $this->load->view('admin/projects/invoice_project', $data);
        }
    }

    public function get_rel_project_data($id, $task_id = '')
    {
        if ($this->input->is_ajax_request()) {
            $selected_milestone = '';
            $assigned           = '';
            if ($task_id != '' && $task_id != 'undefined') {
                $task               = $this->tasks_model->get($task_id);
                $selected_milestone = $task->milestone;
                $assigned           = array_map(function ($member) {
                    return $member['assigneeid'];
                }, $this->tasks_model->get_task_assignees($task_id));
            }

            $allow_to_view_tasks = 0;
            $this->db->where('project_id', $id);
            $this->db->where('name', 'view_tasks');
            $project_settings = $this->db->get(db_prefix() . 'project_settings')->row();
            if ($project_settings) {
                $allow_to_view_tasks = $project_settings->value;
            }

            $deadline = get_project_deadline($id);

            echo json_encode([
                'deadline'            => $deadline,
                'deadline_formatted'  => $deadline ? _d($deadline) : null,
                'allow_to_view_tasks' => $allow_to_view_tasks,
                'billing_type'        => get_project_billing_type($id),
                'milestones'          => render_select('milestone', $this->projects_model->get_milestones($id), [
                    'id',
                    'name',
                ], 'task_milestone', $selected_milestone),
                'assignees' => render_select('assignees[]', $this->projects_model->get_project_members($id, true), [
                    'staff_id', ['firstname', 'lastname'],
                ], 'task_single_assignees', $assigned, ['multiple' => true], [], '', '', false),
            ]);
        }
    }

    public function invoice_project($project_id)
    {
        if (staff_can('create', 'invoices')) {
            $this->load->model('invoices_model');
            $data               = $this->input->post();
            $data['project_id'] = $project_id;
            $invoice_id         = $this->invoices_model->add($data);
            if ($invoice_id) {
                $this->projects_model->log_activity($project_id, 'project_activity_invoiced_project', format_invoice_number($invoice_id));
                set_alert('success', _l('project_invoiced_successfully'));
            }
            redirect(admin_url('projects/view/' . $project_id . '?group=project_invoices'));
        }
    }

    public function view_project_as_client($id, $clientid)
    {
        if (is_admin()) {
            login_as_client($clientid);
            redirect(site_url('clients/project/' . $id));
        }
    }

    public function get_staff_names_for_mentions($projectId)
    {
        if ($this->input->is_ajax_request()) {
            $projectId = $this->db->escape_str($projectId);

            $members = $this->projects_model->get_project_members($projectId);
            $members = array_map(function ($member) {
                $staff = $this->staff_model->get($member['staff_id']);

                $_member['id'] = $member['staff_id'];
                $_member['name'] = $staff->firstname . ' ' . $staff->lastname;

                return $_member;
            }, $members);

            echo json_encode($members);
        }
    }

    public function saveCalim()
    {
        $project_id = $this->input->post('projectid');
        $CalimDetails = $this->projects_model->fetch_claim_saprately($project_id);
        $Calim_payment_Details = $this->projects_model->fetch_claim_payment($project_id);
        if(empty($CalimDetails)){
            $data = [
                'project_id' => $project_id,
                'staff_id' => get_staff_user_id(),
                'contact' =>  serialize($this->input->post('contact')),
                'benefit' =>  $this->input->post('benefit'),
                'condition' =>  $this->input->post('condition'),
                'condition_groups' =>  $this->input->post('conditiongroup'),
                'specialist' =>  $this->input->post('specialist'),
                'outcome' =>  $this->input->post('outcome'),
                'reason_noclaim' =>  $this->input->post('reason_noclaim'),
                'additional_info' => $this->input->post('additional_info'),
            ];

            $lastid = $this->projects_model->addClaim($data);

            $arrayCount = count($this->input->post('invoice'));
            $invoice = $this->input->post('invoice');
            $paymentDate   = $this->input->post('payment_date');
            $amount   = $this->input->post('amount');
            for($i=0; $i<$arrayCount; $i++){
                $claimPayment = [
                    'project_id' =>$project_id,
                    'claim_id' => $lastid,
                    'Invoice' =>  $invoice[$i],
                    'payment_date' =>  $paymentDate[$i],
                    'amount' =>  $amount[$i],
                    'total_amount' =>  $this->input->post('total_amount'),
                ];
                $claim_lastid = $this->projects_model->addpaymetClaim($claimPayment);
            }
            set_alert('success','successfully');
        }

        if($CalimDetails){
            $data = [
                'project_id' => $project_id,
                'staff_id' => get_staff_user_id(),
                'contact' =>  serialize($this->input->post('contact')),
                'benefit' =>  $this->input->post('benefit'),
                'condition' =>  $this->input->post('condition'),
                'condition_groups' =>  $this->input->post('conditiongroup'),
                'specialist' =>  $this->input->post('specialist'),
                'outcome' =>  $this->input->post('outcome'),
                'reason_noclaim' =>  $this->input->post('reason_noclaim'),
                'additional_info' => $this->input->post('additional_info'),
            ];
            $this->projects_model->update_Claim($data, $CalimDetails[0]['id']);
            $lastid = $CalimDetails[0]['id'];
            $arrayCount = count($this->input->post('invoice'));
            $invoice = $this->input->post('invoice');
            $paymentDate   = $this->input->post('payment_date');
            $amount   = $this->input->post('amount');
            $deleteClaimPayment = $this->projects_model->deleteClaimPayment($lastid);
            for($i=0; $i<$arrayCount; $i++){
                $claimPayment = [
                    'project_id' =>$project_id,
                    'claim_id' => $lastid,
                    'Invoice' =>  $invoice[$i],
                    'payment_date' =>  $paymentDate[$i],
                    'amount' =>  $amount[$i],
                    'total_amount' =>  $this->input->post('total_amount'),
                ];
                $claim_lastid = $this->projects_model->addpaymetClaim($claimPayment);
            }
            set_alert('success','Updated successfully');
        }
        redirect(admin_url('projects/view/' . $project_id . '?group=claims'));
    }

    public function saveUnderwriting()
    {
        $project_id = $this->input->post('projectid');
        $underwritingDetails = $this->projects_model->fetchUnderwriting($project_id);
        if (empty($underwritingDetails)) {
            $data = [
                'project_id' => $project_id,
                'staff_id' => get_staff_user_id(),
                'final_status' =>  $this->input->post('final_status'),
                'reason_policynotissued' =>  $this->input->post('reason_policy_notissued'),
                'requested_api' =>  $this->input->post('requested_api'),
                'commission_split' =>  $this->input->post('commission_split'),
                'issue_date' =>  $this->input->post('issue_date'),
                'submitted_api' => $this->input->post('submitted_api'),
                'related_project_id' => $this->input->post('related_project_id'),
                'submitted_date' => $this->input->post('submitted_date'),
                'under_status' => $this->input->post('under_status',)
            ];
            $this->projects_model->save_underwriting($data);
            set_alert('success','successfully');
        } else {
            $data = [
                'project_id' => $project_id,
                'staff_id' => get_staff_user_id(),
                'final_status' =>  $this->input->post('final_status'),
                'reason_policynotissued' =>  $this->input->post('reason_policy_notissued'),
                'requested_api' =>  $this->input->post('requested_api'),
                'commission_split' =>  $this->input->post('commission_split'),
                'issue_date' =>  $this->input->post('issue_date'),
                'submitted_api' => $this->input->post('submitted_api'),
                'related_project_id' => $this->input->post('related_project_id'),
                'submitted_date' => $this->input->post('submitted_date'),
                'under_status' => $this->input->post('under_status',)
            ];
            $this->projects_model->update_underwriting($data, $underwritingDetails[0]['id']);
            set_alert('success','Updated successfully');
        }
        redirect(admin_url('projects/view/' . $project_id . '?group=underwriting'));
    }

    public function saveCancellations()
    {
        $project_id = $this->input->post('projectid');
        $cancellationDetails = $this->projects_model->fetchCancellations($project_id);
        if (empty($cancellationDetails)) {
            $data = [
                'project_id' => $project_id,
                'staff_id' => get_staff_user_id(),
                'source' =>  $this->input->post('source'),
                'api_being_cancelled' =>  $this->input->post('api_being_cancelled'),
                'date_received' =>  $this->input->post('date_received'),
                'clawback_period' =>  $this->input->post('clawback_period'),
                'reason_for_cancellation' =>  $this->input->post('reason_for_cancellation'),
                'clawback_amount' => $this->input->post('clawback_amount'),
                'claim_identified' => $this->input->post('claim_Identified'),
                'outcome_of_cancellation' => $this->input->post('outcome_cancellation'),
                'replacement_business' => $this->input->post('replacement_business'),
                'policy_commission' => $this->input->post('policy_commission'),
                'replacement_reason' => $this->input->post('replacement_reason'),
                'life_cover'=>$this->input->post('life_cover'),
                'truma_cover'=>$this->input->post('truma_cover'),
                'total_and_permanent_disablement_cover'=>$this->input->post('total_and_permanent_disablement_cover'),
                'monthly_disability_cover'=>$this->input->post('monthly_disability_cover'),
                'medical_cover'=>$this->input->post('medical_cover'),
                'whole_life_endowment_cover'=>$this->input->post('whole_life_endowment_cover'),
                'accidental_death_cover'=>$this->input->post('accidental_death_cover'),
                'funeral_cover'=>$this->input->post('funeral_cover'),
                'other'=>$this->input->post('other'),
                'cancel_status' => $this->input->post('cancel_status'),
                'number_of_days_calculation_c_p'            =>  $this->input->post('number_of_days_calculation_c_p'),
            ];
            $this->projects_model->save_cancellations($data);
            set_alert('success','successfully');
        } else {
            $data = [
                'project_id' => $project_id,
                'staff_id' => get_staff_user_id(),
                'source' =>  $this->input->post('source'),
                'api_being_cancelled' =>  $this->input->post('api_being_cancelled'),
                'date_received' =>  $this->input->post('date_received'),
                'clawback_period' =>  $this->input->post('clawback_period'),
                'reason_for_cancellation' =>  $this->input->post('reason_for_cancellation'),
                'clawback_amount' => $this->input->post('clawback_amount'),
                'claim_identified' => $this->input->post('claim_Identified'),
                'outcome_of_cancellation' => $this->input->post('outcome_cancellation'),
                'replacement_business' => $this->input->post('replacement_business'),
                'policy_commission' => $this->input->post('policy_commission'),
                'replacement_reason' => $this->input->post('replacement_reason'),
                'truma_cover'=>$this->input->post('life_cover'),
                'life_cover'=>$this->input->post('truma_cover'),
                'total_and_permanent_disablement_cover'=>$this->input->post('total_and_permanent_disablement_cover'),
                'monthly_disability_cover'=>$this->input->post('monthly_disability_cover'),
                'medical_cover'=>$this->input->post('medical_cover'),
                'whole_life_endowment_cover'=>$this->input->post('whole_life_endowment_cover'),
                'accidental_death_cover'=>$this->input->post('accidental_death_cover'),
                'funeral_cover'=>$this->input->post('funeral_cover'),
                'other'=>$this->input->post('other'),
                'cancel_status' => $this->input->post('cancel_status'),
                'number_of_days_calculation_c_p'            =>  $this->input->post('number_of_days_calculation_c_p'),
            ];
            $this->projects_model->update_cancellations($data, $cancellationDetails[0]['id']);
            set_alert('success','Updated successfully');
        }
        redirect(admin_url('projects/view/' . $project_id . '?group=cancellations'));
    }

    public function getpolicy()
    {
        $customer = $this->input->post('customer');
        $data = $this->projects_model->fetchpolicy($customer);
        print_r(json_encode($data));
    }

    // public function updatecat()
    // {
    //     $data['category_id'] = $this->input->post('id');
    //     $file_id = $this->input->post('file_id');
    //     $this->projects_model->saveupdatecat($data,$file_id);
    // }

    public function updatecat()
    {
        $data['category_id'] = $this->input->post('id');
        $file_id = $this->input->post('file_id');
        $data['category_name'] = $this->projects_model->getCategory_Name($data['category_id']);
        $this->projects_model->saveupdatecat($data,$file_id,);
    }
    
    // public function discription()
    // {
    //     $data['description'] = $this->input->post('description');
    //     $file_id = $this->input->post('file_idd');
    //     $this->projects_model->savediscription($data,$file_id);
    // }
    public function addprojecttemplate()
    {   
        $data['data'] = $this->projects_model->fetchprojecttemplate();
        $this->load->view('admin/policy/projecttemplate',$data);
    }
    public function saveprojecttemplate()
    {    
        $data = [
            'template_id' => $this->input->post('ptemplateid'),
            'template_name' => $this->input->post('ptemplatename'),
        ];
        $this->projects_model->save_projecttemplate($data);
        redirect(admin_url('projects/addprojecttemplate'));
    }
    public function deleteprojecttemplate()
    {
        $data = [
            'is_deleted' =>  1,
        ];
        $id = $this->uri->segment(4);
        set_alert('success', 'Deleted Successfully');
        $this->projects_model->delete_projecttemplate($data,$id);
        redirect(admin_url('projects/addprojecttemplate'));
    }

    public function commisionsplit(){
        $this->load->model('projects_model');
        $data['data'] = $this->projects_model->fetch_commisionsplit();
        $this->load->view('admin/projects/commission_split', $data);
        }

    public function savecommisionsplit(){
        $data = [
            'commission_split' => $this->input->post('commission_split'),
        ];
        $this->projects_model->saveCommisionsplit($data);
        redirect(admin_url('projects/commisionsplit'));
    }

    public function deletecommisionsplit(){
        $data = [
            'is_deleted' => 1,
        ];
        $id = $this->uri->segment(4);
        set_alert('success', 'Deleted Successfully');
        $this->projects_model->delete_Commisionsplit($data,$id);
        redirect(admin_url('projects/commisionsplit'));
    }

    // public function addCompliences(){
      
    //     $this->load->model('projects_model');
    //     $data['complience']     = $this->projects_model->fetchComplience();
    //     $data['stages']         = $this->projects_model->fetchstage();
    //     $this->load->view('admin/projects/compliences', $data);
    // }

    public function addCompliences(){
      
        $data['complience']     = $this->projects_model->fetchComplience();
        $data['stages']         = $this->projects_model->fetchstage();
        // echo '<pre>';
        // print_r($data['complience']);
        // exit;
        $this->load->view('admin/projects/compliences', $data);
    }

    public function saveCompliance(){
        $data = [
            'compliance' => $this->input->post('compliance'),
            'stage' => $this->input->post('stage'),

        ];
        $this->projects_model->save_compliance($data);
        redirect(admin_url('projects/addCompliences'));
    }

    

    public function deleteCompliance(){
        $data = [
            'is_deleted' => 1,
        ];
        $id = $this->uri->segment(4);
     
        set_alert('success', 'Deleted Successfully');
        $this->projects_model->deleteComplianceData($data, $id);
        redirect(admin_url('projects/addCompliences'));
    }

    // public function updateCompliance(){
    //     $complian['compliance_id'] = $this->input->post('id'); 

    //     $file_id = $this->input->post('file_id');
    //     $this->projects_model->updateCompliancez($complian, $file_id);
    // }

    // public function updateCompliance(){
    //     $complianId = $this->input->post('id'); 
    //     if($complianId){
    //        $dadada =  $this->projects_model->getstageId($complianId);
    //     }
    //     $data = [
    //         'compliance_id'=> $complianId,
    //         'stage_id' => $dadada[0][stage],
    //     ];
    //     // echo '<pre>';
    //     // print_r($data ); exit;
    //     $file_id = $this->input->post('file_id');
    //     $this->projects_model->updateCompliancez($data, $file_id);
    // }


    public function reasonForArrears(){
        $data['data'] = $this->projects_model->fetch_reasonForArreas();
        $this->load->view('admin/projects/reason_arreas', $data);
        }

    public function savereasonForArreas(){
        $data = [
            'reason_arrears' => $this->input->post('reason_arrears'),
        ];
        $this->projects_model->savereasonFor_arreas($data);
        redirect(admin_url('projects/reasonForArreas'));
    }

    public function deletereasonForArreas(){
        $data = [
            'is_deleted' => 1,
        ];
        $id = $this->uri->segment(4);
        set_alert('success', 'Deleted Successfully');
        $this->projects_model->delete_reasonForArreas($data,$id);
        redirect(admin_url('projects/reasonForArreas'));
    }

    public function arreasStatus(){
        $this->load->model('projects_model');
        $data['data'] = $this->projects_model->fetch_arreasStatus();
        $this->load->view('admin/projects/arreasStatus', $data);
        }

    public function savearreasStatus(){
        $data = [
            'arrears_status' => $this->input->post('arrears_status'),
        ];
        $this->projects_model->saveArreasStatus($data);
        redirect(admin_url('projects/arreasStatus'));
    }

    public function deleteArreasStatus(){
        $data = [
            'is_deleted' => 1,
        ];
        $id = $this->uri->segment(4);
        set_alert('success', 'Deleted Successfully');
        $this->projects_model->delete_ArreasStatus($data,$id);
        redirect(admin_url('projects/arreasStatus'));
    }

    public function saveArrears()
    {
        $project_id = $this->input->post('projectid');
        $save_Arrears = $this->projects_model->fetchsave_Arrears($project_id);
        if(empty($save_Arrears)){
            $data = [
                'project_id' => $project_id,
                'staff_id' => get_staff_user_id(),
                'recieve_date'=> $this->input->post('recieve_date'),
                'reason_arrears'=> $this->input->post('reason_arrears'),
                'apibeinglapsed'=> $this->input->post('apibeinglapsed'),
                'advisercontacted'=> $this->input->post('advisercontacted'),
                'arrears_status'=> $this->input->post('arrears_status'),
            ];
            $this->projects_model->save_Arrears($data);
            set_alert('success','successfully');
        } else{
            $data = [
                'project_id' => $project_id,
                'staff_id' => get_staff_user_id(),
                'recieve_date'=> $this->input->post('recieve_date'),
                'reason_arrears'=> $this->input->post('reason_arrears'),
                'apibeinglapsed'=> $this->input->post('apibeinglapsed'),
                'advisercontacted'=> $this->input->post('advisercontacted'),
                'arrears_status'=> $this->input->post('arrears_status'),
            ];

            $this->projects_model->update_Arrears($data, $save_Arrears[0]['id']);
            set_alert('success','Updated successfully');
        }
        redirect(admin_url('projects/view/' . $project_id . '?group=arrears'));
    }


    // public function commisionsplit(){
    //     $this->load->model('projects_model');
    //     $data['data'] = $this->projects_model->fetch_commisionsplit();
    //     $this->load->view('admin/projects/commission_split', $data);
    //     }

    // public function savecommisionsplit(){
    //     $data = [
    //         'commission_split' => $this->input->post('commission_split'),
    //     ];
    //     $this->projects_model->saveCommisionsplit($data);
    //     redirect(admin_url('projects/commisionsplit'));
    // }

    // public function deletecommisionsplit(){
    //     $data = [
    //         'is_deleted' => 1,
    //     ];
    //     $id = $this->uri->segment(4);
    //     set_alert('success', 'Deleted Successfully');
    //     $this->projects_model->delete_Commisionsplit($data,$id);
    //     redirect(admin_url('projects/commisionsplit'));
    // }

    public function underwrittingStatus(){
        $this->load->model('projects_model');
        $data['data'] = $this->projects_model->fetchunderwrittingStatus();
        $this->load->view('admin/projects/underwritting_status', $data);
    }

    public function saveUnderwrittingStatus(){
        $data['under_status'] = $this->input->post('under_status');
        
        $this->projects_model->save_UnderwrittingStatus($data);
        redirect (admin_url('projects/underwrittingStatus'));
    }

    public function deteleunderwrittingStatus(){
        $id = $this->uri->segment(4);
        $data = [
            'is_deleted' => 1,
        ];
        // print_r($data);
        // exit;
        set_alert('success', 'Deleted Successfully');
        $this->projects_model->daleteunderwrittingStatus($id , $data);
        redirect (admin_url('projects/underwrittingStatus'));
    }

    public function cancellationStatus(){
        $this->load->model('projects_model');
        $data['data'] = $this->projects_model->fetchCancellationStatus();
        $this->load->view('admin/projects/cancellation_status', $data);
    }

    public function saveCancellationStatus(){
        $data['cancel_status'] = $this->input->post('cancel_status');
        $this->projects_model->save_Cancellation_status($data);
        redirect(admin_url('projects/cancellationStatus'));
    }

    public function deleteCancellationStatus(){
        $id = $this->uri->segment(4);
        $data = [
            'is_deleted' => 1,
        ];
        set_alert('success' , 'Deleted Successfully' );
        $this->projects_model->dalete_CancellationStatus($id , $data);
        redirect(admin_url('projects/cancellationStatus'));
    }

    public function benefitsBeingChange()
    {
        $id = $this->uri->segment(4);
        if(!$id){
        if(!$id){
                $this->projects_model->save_benefitsBeingChange($id= '' , $this->input->post());
                }
                $data['data'] =  $this->projects_model->fetchBenefitChange();
                $this->load->view('admin/projects/benefit_being_change', $data);
            }
            else{
            if($id){
                $data = [
                    'is_deleted' => 1,
                ];
                $result = $this->projects_model->save_benefitsBeingChange($id , $data);
                if($result==yes){
                    set_alert('success', 'Deleted Successfully');
                }

                redirect(admin_url('projects/benefitsBeingChange'));
            }
        }
    }

    public function Stage()
    {
        $id = $this->uri->segment(4);
        if(!$id){
        if(!$id){
                $this->projects_model->save_stage($id= '' , $this->input->post());
                }
                $data['data'] =  $this->projects_model->fetchstage();
                $this->load->view('admin/projects/stage', $data);
            }
            else{
            if($id){
                $data = [
                    'is_deleted' => 1,
                ];
                $result = $this->projects_model->save_stage($id , $data);
                if($result==yes){
                    set_alert('success', 'Deleted Successfully');
                }

                redirect(admin_url('projects/Stage'));
            }
        }
    }
    public function filetr(){
        $project_id = $this->input->post('project_id');
        $url_redirect = $this->input->post('url_redirect');
       if($url_redirect ==1){
        redirect(admin_url('projects/view/' . $project_id . '?group=group_compliances'));
       }
       redirect(admin_url('projects/view/' . $project_id . '?group=group_compliances&&filter=filter'));
    }

    public function getCalculate(){
      
        $cancellation_date   = $this->input->post('cancellation_date'); 
        $policy_start_date   = $this->input->post('policy_start_date');
        $datetime1 = strtotime($cancellation_date);
        $datetime2 = strtotime($policy_start_date);

        $secs = $datetime1 - $datetime2;// == <seconds between the two times>
        $days = $secs / 86400;
        echo $days;
    }


    public function updateCompliance(){
        $complianId = $this->input->post('id');
        if($complianId){
           $dadada =  $this->projects_model->getstageId($complianId);
           $compliance_name =  $this->projects_model->compliance_name($complianId);
        }
        $data = [
            'compliance_id'     => $complianId,
            'stage_id'          => $dadada[0]['stage'],
            'compliance_name'   => $compliance_name,
        ];
       
        $file_id = $this->input->post('file_id');
        $this->projects_model->updateCompliancez($data, $file_id);
    }

    public function report_arears(){
        if($this->input->post('projectType') == '' && $this->input->post('adviser') == '' && $this->input->post('provider') == '' && $this->input->post('status') == '' && $this->input->post('member') == '' && $this->input->post('arrears_status') == ''){
            


            // if (has_permission('customers', '', 'view')) {
            //     if (!is_customer_admin($id)) {
                    // $get_project_data['data'] = $this->projects_model->get_project_data();
            //     }
            // }else{
            //     $get_project_data['data'] = "";
            // }

            if(!is_admin()) {
                $get_project_data['data'] = $this->projects_model->get_project_arrears_data();

            }
            if (!has_permission('customers', '', 'view')) {
                if (!is_customer_admin($id)) {
                    $get_project_data['data'] = $this->projects_model->get_project_arrears_data();

                }
            }else{
                $get_project_data['data'] = $this->projects_model->get_project_data();
            }


            $get_project_data['adviser']        = $this->projects_model->fetchadvisordata();
            $get_project_data['projectType']    = $this->projects_model->project_type_data();
            $get_project_data['provider']       = $this->projects_model->providers_detail();
            $get_project_data['status']         = $this->projects_model->providers_detail();
            $get_project_data['arrears_status'] = $this->projects_model->arrears_status_detail();
            $get_project_data['member']         = $this->projects_model->fetchadvisordata();
           
            $apibeinglapsed = $get_project_data['data'];
            $lapsed_api_total = 0;
            foreach($apibeinglapsed as $apibeinglapseds){
                $apibeing_lapsed = $apibeinglapseds['lapsed_api'];
                $dollerData      = mb_substr(trim($apibeing_lapsed), 0, 1);
                if($dollerData == '$'){
                    $numericdata = substr(trim($apibeing_lapsed),1);
                    $lapsed_api_total += str_replace(",", "", $numericdata);
                }
            }
            $lapsed_Api_total                     = '$'.number_format($lapsed_api_total ,2).'';
            $get_project_data['lapsed_api_total'] = $lapsed_Api_total;

            $filter = [
                'projectType'    => "",
                'adviser'        => "",
                'provider'       => "",
                'status'         => "",
                'member'         => "",
                'arrears_status' => "",
            ];
            $this->session->set_userdata($filter);
        }
        else{
            $get_project_data['adviser']        = $this->projects_model->fetchadvisordata();
            $get_project_data['projectType']    = $this->projects_model->project_type_data();
            $get_project_data['provider']       = $this->projects_model->providers_detail();
            $get_project_data['status']         = $this->projects_model->providers_detail();
            $get_project_data['arrears_status'] = $this->projects_model->arrears_status_detail();
            $get_project_data['member']         = $this->projects_model->fetchadvisordata();
            $filter = [
                'projectType'    => $this->input->post('projectType'),
                'adviser'        => $this->input->post('adviser'),
                'provider'       => $this->input->post('provider'),
                'status'         => $this->input->post('status'),
                'member'         => $this->input->post('member'),
                'arrears_status' => $this->input->post('arrears_status'),
            ];
           
            $this->session->set_userdata($filter);

            if(!is_admin()) {
                $cleck_is_admin = 0;
                $get_project_data['data'] = $this->projects_model->get_filtered_project_data($filter, $cleck_is_admin);
            }
            if (!has_permission('customers', '', 'view')) {
                if (!is_customer_admin($id)) {
                    $cleck_is_admin = 0;
                    $get_project_data['data'] = $this->projects_model->get_filtered_project_data($filter, $cleck_is_admin);
                }
            }else{
                $cleck_is_admin = 1;
                $get_project_data['data'] = $this->projects_model->get_filtered_project_data($filter, $cleck_is_admin);

            }

            // $get_project_data['data'] = $this->projects_model->get_filtered_project_data($filter);
            $apibeinglapsed           = $get_project_data['data'];
            $lapsed_api_total         = 0;
            foreach($apibeinglapsed as $apibeinglapseds){
                $apibeing_lapsed = $apibeinglapseds['lapsed_api'];
                $dollerData      = mb_substr(trim($apibeing_lapsed), 0, 1);
                if($dollerData == '$'){
                    $numericdata = substr(trim($apibeing_lapsed),1);
                    $lapsed_api_total += str_replace(",", "", $numericdata);
                }
            }
            $lapsed_Api_total                     = '$'.number_format($lapsed_api_total ,2).'';
            $get_project_data['lapsed_api_total'] = $lapsed_Api_total;
        }
        $this->load->view('admin/projects/workflow_report/report_arrears',$get_project_data );
    }


    //multiselect add =====================================================================

    public function report_underwriting(){
        if($this->input->post('projectType') == '' && $this->input->post('adviser') == '' && $this->input->post('provider') == '' && $this->input->post('status') == '' && $this->input->post('member') == '' && $this->input->post('under_status') == ''){
          

            if(!is_admin()) {
                $cleck_is_admin = 0;
                $get_project_data['data'] = $this->projects_model->get_underwriting_project_data($cleck_is_admin);
            }
            if (!has_permission('customers', '', 'view')) {
                if (!is_customer_admin($id)) {
                    $cleck_is_admin = 0;
                    $get_project_data['data'] = $this->projects_model->get_underwriting_project_data($cleck_is_admin);
                }
            }else{
                $cleck_is_admin = 1;
                $get_project_data['data'] = $this->projects_model->get_underwriting_project_data($cleck_is_admin);
            }

            $get_project_data['adviser']      = $this->projects_model->fetchadvisordata();
            $get_project_data['projectType']  = $this->projects_model->project_type_data();
            $get_project_data['provider']     = $this->projects_model->providers_detail();
            $get_project_data['status']       = $this->projects_model->providers_detail();
            $get_project_data['under_status'] = $this->projects_model->underwriting_status_detail();
            $get_project_data['member']       = $this->projects_model->fetchadvisordata();
            $apibeinglapsed                   = $get_project_data['data'];
            $submitted_api_total = 0;
            foreach($apibeinglapsed as $apibeinglapseds){
                $apibeing_lapsed = $apibeinglapseds['subbmited_api'];
                $dollerData      = mb_substr(trim($apibeing_lapsed), 0, 1);
                if($dollerData == '$'){
                    $numericdata = substr(trim($apibeing_lapsed),1);
                    $lapsed_api_total += str_replace(",", "", $numericdata);
                }
            }
            $lapsed_Api_total                     = '$'.number_format($lapsed_api_total ,2).'';
            $get_project_data['lapsed_api_total'] = $lapsed_Api_total;
            $filter = [
                'projectType'  => "",
                'adviser'      => "",
                'provider'     => "",
                'status'       => "",
                'member'       => "",
                'under_status' => "",
            ];
            $this->session->set_userdata($filter);
        }
        else{
            $get_project_data['adviser']      = $this->projects_model->fetchadvisordata();
            $get_project_data['projectType']  = $this->projects_model->project_type_data();
            $get_project_data['provider']     = $this->projects_model->providers_detail();
            $get_project_data['status']       = $this->projects_model->providers_detail();
            $get_project_data['under_status'] = $this->projects_model->underwriting_status_detail();
            $get_project_data['member']       = $this->projects_model->fetchadvisordata();
            $filter = [
                'projectType'  => $this->input->post('projectType'),
                'adviser'      => $this->input->post('adviser'),
                'provider'     => $this->input->post('provider'),
                'status'       => $this->input->post('status'),
                'member'       => $this->input->post('member'),
                'under_status' => $this->input->post('under_status'),
            ];
            // print_r($filter);
            // exit;
            $this->session->set_userdata($filter);

            if(!is_admin()) {
                $cleck_is_admin = 0;
                $get_project_data['data'] = $this->projects_model->get_filtered_underwriting_project_data($filter , $cleck_is_admin);
            }
            if (!has_permission('customers', '', 'view')) {
                if (!is_customer_admin($id)) {
                    $cleck_is_admin = 0;
                    $get_project_data['data'] = $this->projects_model->get_filtered_underwriting_project_data($filter , $cleck_is_admin);
                }
            }else{
                $cleck_is_admin = 1;
                $get_project_data['data'] = $this->projects_model->get_filtered_underwriting_project_data($filter , $cleck_is_admin);
            }

            $apibeinglapsed           = $get_project_data['data'];
            $lapsed_api_total         = 0;
            foreach($apibeinglapsed as $apibeinglapseds){
                $apibeing_lapsed = $apibeinglapseds['subbmited_api'];
                $dollerData      = mb_substr(trim($apibeing_lapsed), 0, 1);
                if($dollerData == '$'){
                    $numericdata = substr(trim($apibeing_lapsed),1);
                    $lapsed_api_total += str_replace(",", "", $numericdata);
                }
            }
            $lapsed_Api_total                     
            = '$'.number_format($lapsed_api_total ,2).'';
            $get_project_data['lapsed_api_total'] = $lapsed_Api_total;
        }
        $this->load->view('admin/projects/workflow_report/report_underwriting',$get_project_data );
    }
    //multiselect add =====================================================================

    public function report_adviser(){

        if($this->input->post('projectType') == '' && $this->input->post('adviser') == '' && $this->input->post('provider') == '' && $this->input->post('status') == '' && $this->input->post('member') == '' && $this->input->post('under_status') == ''){
          
            if(!is_admin()) {
                $cleck_is_admin = 0;
                $get_project_data['data'] = $this->projects_model->get_adviser_project_data($cleck_is_admin);
            }
            if (!has_permission('customers', '', 'view')) {
                if (!is_customer_admin($id)) {
                    $cleck_is_admin = 0;
                    $get_project_data['data'] = $this->projects_model->get_adviser_project_data($cleck_is_admin);
                }
            }else{
                $cleck_is_admin = 1;
                $get_project_data['data'] = $this->projects_model->get_adviser_project_data($cleck_is_admin);
            }

            $get_project_data['adviser']      = $this->projects_model->fetchadvisordata();
            $get_project_data['projectType']  = $this->projects_model->project_type_data();
            // print_r($get_project_data['projectType']);
            // exit;
            $get_project_data['provider']     = $this->projects_model->providers_detail();
            $get_project_data['status']       = $this->projects_model->providers_detail();
            $get_project_data['under_status'] = $this->projects_model->underwriting_status_detail();
            $get_project_data['member']       = $this->projects_model->fetchadvisordata();
            $apibeinglapsed                   = $get_project_data['data'];
            $submitted_api_total = 0;
            foreach($apibeinglapsed as $apibeinglapseds){
                $apibeing_lapsed = $apibeinglapseds['subbmited_api'];
                $dollerData      = mb_substr(trim($apibeing_lapsed), 0, 1);
                if($dollerData == '$'){
                    $numericdata = substr(trim($apibeing_lapsed),1);
                    $lapsed_api_total += str_replace(",", "", $numericdata);
                }
            }
            $lapsed_Api_total                     = '$'.number_format($lapsed_api_total ,2).'';
            $get_project_data['lapsed_api_total'] = $lapsed_Api_total;
            $filter = [
                'projectType'  => "",
                'adviser'      => "",
                'provider'     => "",
                'status'       => "",
                'member'       => "",
                'under_status' => "",
            ];
            $this->session->set_userdata($filter);
        }
        else{
            $get_project_data['adviser']      = $this->projects_model->fetchadvisordata();
            $get_project_data['projectType']  = $this->projects_model->project_type_data();
            $get_project_data['provider']     = $this->projects_model->providers_detail();
            $get_project_data['status']       = $this->projects_model->providers_detail();
            $get_project_data['under_status'] = $this->projects_model->underwriting_status_detail();
            $get_project_data['member']       = $this->projects_model->fetchadvisordata();
            $filter = [
                'projectType'  => $this->input->post('projectType'),
                'adviser'      => $this->input->post('adviser'),
                'provider'     => $this->input->post('provider'),
                'status'       => $this->input->post('status'),
                'member'       => $this->input->post('member'),
                'under_status' => $this->input->post('under_status'),
            ];
            $this->session->set_userdata($filter);

            if(!is_admin()) {
                $cleck_is_admin = 0;
                $get_project_data['data'] = $this->projects_model->get_filtered_adviser_project_data($filter , $cleck_is_admin);
            }
            if (!has_permission('customers', '', 'view')) {
                if (!is_customer_admin($id)) {
                    $cleck_is_admin = 0;
                    $get_project_data['data'] = $this->projects_model->get_filtered_adviser_project_data($filter , $cleck_is_admin);
                }
            }else{
                $cleck_is_admin = 1;
                $get_project_data['data'] = $this->projects_model->get_filtered_adviser_project_data($filter , $cleck_is_admin);
            }

            $apibeinglapsed           = $get_project_data['data'];
            $lapsed_api_total         = 0;
            foreach($apibeinglapsed as $apibeinglapseds){
                $apibeing_lapsed = $apibeinglapseds['subbmited_api'];
                $dollerData      = mb_substr(trim($apibeing_lapsed), 0, 1);
                if($dollerData == '$'){
                    $numericdata = substr(trim($apibeing_lapsed),1);
                    $lapsed_api_total += str_replace(",", "", $numericdata);
                }
            }
            $lapsed_Api_total                     
            = '$'.number_format($lapsed_api_total ,2).'';
            $get_project_data['lapsed_api_total'] = $lapsed_Api_total;
        }
        $this->load->view('admin/projects/workflow_report/report_adviser',$get_project_data );
    }

}
