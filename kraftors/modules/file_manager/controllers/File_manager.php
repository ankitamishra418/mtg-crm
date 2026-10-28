<?php

defined('BASEPATH') or exit('No direct script access allowed');

class File_manager extends AdminController
{
	public function __construct()
    {
        parent::__construct();
        $this->load->model('file_model');
      
    }

    /* List all files */
	public function index()
	{
	//   if (!has_permission('hrm_dashboard', '', 'view')) {
	// 	access_denied('hr_profile');
	//   }
	//   $this->app_scripts->add('circle-progress-js','assets/plugins/jquery-circle-progress/circle-progress.min.js');
	  $data['title']                 = 'File Manager';
	  $data['category'] = $this->file_model->get_categoryata();
	  $data['subcategory'] = $this->file_model->get_subcategorydata();
	  $data['groups']         = $this->file_model->get_groups();
	  $data['job_p_id']      = $this->file_model->get_job_p();
	 
	  $this->load->view('manage', $data);


	}


	public function categories()
	{
	//   if (!has_permission('hrm_dashboard', '', 'view')) {
	// 	access_denied('hr_profile');
	//   }
	//   $this->app_scripts->add('circle-progress-js','assets/plugins/jquery-circle-progress/circle-progress.min.js');
	  $data['title']                 = 'File category';
	  $this->load->view('categories', $data);
	}

	
	/**
	* add or update files Category
	* @param  integer $id 
	*/
	public function add_edit_file_category($id = '')
	{
		
		if ($this->input->post()) {
			$message          = '';
			$data             = $this->input->post();
			
			if (!$this->input->post('id')) {
				$id = $this->file_model->add_new_file_category($data);
				
				if ($id) {
					$message = _l('added_successfully', _l('file'));
					set_alert('success', $message);
				}else{
					$message = _l('added_failed', _l('file'));
					set_alert('warning', $message);
				}

				redirect(admin_url('file_manager/categories'));
			} else {
				
				$id = $data['id'];
				unset($data['id']);
				$success = $this->file_model->update_category($data, $id);

				if ($success) {
					$message = _l('updated_successfully', _l('Category'));
					set_alert('success', $message);
				}else{
					$message = _l('updated_failed', _l('Category'));
					set_alert('warning', $message);
				}
				redirect(admin_url('file_manager/categories'));
			}
			die;
		}
	}

/**
 * delete files category of file manager
 * @param  integer $id       
*/
  public function delete_category($id)
  {
	  if (!$id) {
		redirect(admin_url('file_manager'));
	  }
	  $response = $this->file_model->delete_category($id);

	  if (is_array($response) && isset($response['referenced'])) {
		set_alert('warning', _l('hr_is_referenced', _l('hr_hr_job_position')));
	  } elseif ($response == true) {
		set_alert('success', _l('hr_deleted'));
	  } else {
		set_alert('warning', _l('problem_deleting'));
	  }
	  redirect(admin_url('file_manager/categories'));
  }


  public function table_category()
  {
	  $this->app->get_table_data(module_views_path('file_manager', 'table_category'));
  }

    public function subcategory()
	{
		 $data['title']                 = 'File subcategory';
		 //$data['category'] = $this->file_model->get_categoryata();
		$this->load->view('subcategory', $data);
	// 	echo"<pre>";
	// echo"hello";
	// 	print_r($data);
	// 	exit;

	}

	// public function table_subcategory()
	// {
	// 	 $this->app->get_table_data(module_views_path('file_manager','table_subcategory'));
	// }

	public function table_subcategory()
	{
		$this->app->get_table_data(module_views_path('file_manager', 'table_subcategory'));
	}


	public function add_edit_file_subcategory($id = '')
	{
		
		if ($this->input->post()) {
			$message          = '';
			$data             = $this->input->post();
			
			if (!$this->input->post('id')) {
				$id = $this->file_model->add_new_file_subcategory($data);
				
				if ($id) {
					$message = _l('added_successfully', _l('subcategory'));
					set_alert('success', $message);
				}else{
					$message = _l('added_failed', _l('subcategory'));
					set_alert('warning', $message);
				}

				redirect(admin_url('file_manager/subcategory'));
			} else {
				
				$id = $data['id'];
				unset($data['id']);
				$success = $this->file_model->update_subcategory($data, $id);

				if ($success) {
					$message = _l('updated_successfully', _l('subcategory'));
					set_alert('success', $message);
				}else{
					$message = _l('updated_failed', _l('subcategory'));
					set_alert('warning', $message);
				}
				redirect(admin_url('file_manager/subcategory'));
			}
			die;
		}
	}

	public function delete_subcategory($id)
	{
		if (!$id) {
			redirect(admin_url('file_manager/subcategory'));
		}
		$response = $this->file_model->delete_subcategory($id);

		if (is_array($response) && isset($response['referenced'])) {
			set_alert('warning', _l('hr_is_referenced', _l('hr_hr_job_position')));
		} elseif ($response == true) {
			set_alert('success', _l('deleted'));
		} else {
			set_alert('warning', _l('problem_deleting'));
		}
		redirect(admin_url('file_manager/subcategory'));
	}


	/**
	* Show all the file data
	* @return view
	*/

	public function table_file()
	{
		$this->app->get_table_data(module_views_path('file_manager', 'file_table'));
	}
	
	public function view_file($id = '')
	{
		$staff = get_staff_user_id();

		$res = $this->db->select('*')->where('file',$id)->where('staff',$staff)->get('tblfile_auditflow')->result_array();

		if(!$res){
			$data['file'] = $id;
			$data['staff'] = get_staff_user_id();
			$insert_id = $this->db->insert(db_prefix() . 'file_auditflow', $data);
		}
	   	
		$data['title']                 = 'View file';
		$data['file'] = $this->db->where('id',$id)->get('tblfilemanager')->result_array();


		$this->load->view('view_file', $data);
	}

	/**
	* add or update files
	* @param  integer $id 
	*/
	public function add_edit_file($id = '')
	{ 
		 // print_r($_FILES['file']['name']);
	   // exit;
	    
		if ($this->input->post()) {
			$message          = '';
			$data             = $this->input->post();
			
			if (!$this->input->post('id')) {
		////////	    
				$id = $this->file_model->add_new_file($data);

				//$uploadedFiles = handle_file_manager_attachments_array($id,'file');

				$config['upload_path']   = get_file_manager_upload_path_by_type('attachment'); 
				$config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx|xls|xlsx|eml|msg|jpeg|jfif|php'; 
				$config['max_size']      = 100000; 
				$config['max_width']     = 100024; 
				$config['max_height']    = 7680;  

				
				$this->load->library('upload', $config);
				   
				if ( ! $this->upload->do_upload('file')) {
				   $error = array('error' => $this->upload->display_errors());
				}
				   
				else { 
				   $dd = array('upload_data' => $this->upload->data()); 
				} 

				if ($id) {
					$message = _l('added_successfully', _l('file'));
					set_alert('success', $message);
				}else{
					$message = _l('added_failed', _l('file'));
					set_alert('warning', $message);
				}

				redirect(admin_url('file_manager'));
			} else {
				
				$id = $data['id'];
				unset($data['id']);
				
				$success = $this->file_model->update_file($data, $id);

			//upload file
				if ($id) {
				    
					$_id           = $id;
					$message       = _l('added_successfully', _l('job_position'));
					if($_FILES['file']['name']){
						$config['upload_path']   = get_file_manager_upload_path_by_type('attachment'); 
						$config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx|xls|xlsx|eml|msg|jpeg|jfif|php'; 
						$config['max_size']      = 100000; 
						$config['max_width']     = 100024; 
						$config['max_height']    = 7680;  

						
						$this->load->library('upload', $config);
						
						if ( ! $this->upload->do_upload('file')) {
						$error = array('error' => $this->upload->display_errors());
						}
						
						else { 
						$dd = array('upload_data' => $this->upload->data()); 
						} 

					}
				}

				if ($success) {
					$message = _l('updated_successfully', _l('file'));
					set_alert('success', $message);
				}else{
					$message = _l('updated_failed', _l('file'));
					set_alert('warning', $message);
				}
				redirect(admin_url('file_manager'));
			}
			die;
		}
	}

   /**
   * File view edit
   * @param  string $id 
   * @return view     
   */
  public function file_view_edit($id='', $parent_id=''){

	if (!has_permission('staffmanage_job_position', '', 'view') && !has_permission('staffmanage_job_position', '', 'view_own')) {
	  access_denied('job_position');
	}
	if ($id == '') {
	  $title = _l('add_new', _l('hr_training'));
		} else {

		  $data['job_position_general'] = $this->hr_profile_model->get_job_position($id);
		  $data['job_position_tag'] = $this->hr_profile_model->get_job_position_tag($id);
		  $data['job_position_id'] = $id;

		  $data_salary_scale = $this->hr_profile_model->get_job_position_salary_scale($id);
		  $data['salary_insurance'] = $data_salary_scale['insurance'] ;
		  $data['salary_form_edit']      = $data_salary_scale['salary']    ;
		  $data['salary_allowance'] = $data_salary_scale['allowance'] ;

		  $data['count_salary_form']      = count($data_salary_scale['salary']);
		  $data['count_salary_allowance'] = count($data_salary_scale['allowance']);

		  $data['job_position_attachment'] = $this->hr_profile_model->get_hr_profile_attachments_file($id, 'job_position');

		}


	$data['list_job_p'] = $this->hr_profile_model->get_job_p();
	$data['list_staff'] = $this->staff_model->get();

	$data['allowance_type'] = $this->hr_profile_model->get_allowance_type();
	$data['salary_form'] = $this->hr_profile_model->get_salary_form();
	$data['parent_id'] = $parent_id;
	$data['hr_profile_get_department_name'] = $this->departments_model->get();
	
	$this->load->view('hr_profile/job_position_manage/view_edit_jobposition', $data);
}


/**
   * delete files of file manager
   * @param  integer $id       
   */
  public function delete_file($id)
  {
	  if (!$id) {
		redirect(admin_url('file_manager'));
	  }
	  $response = $this->file_model->delete_file($id);

	  if (is_array($response) && isset($response['referenced'])) {
		set_alert('warning', _l('hr_is_referenced', _l('hr_hr_job_position')));
	  } elseif ($response == true) {
		set_alert('success', _l('hr_deleted'));
	  } else {
		set_alert('warning', _l('problem_deleting'));
	  }
	  redirect(admin_url('file_manager'));
  }


  public function get_filedata($id){
	
	$filedata = $this->file_model->get_filedata($id);

	if(isset($filedata)){
		$id = $filedata->id;
		$description = $filedata->file_description;
	}else{
		$description = '';
		$id = 0;

	}
	echo json_encode([ 
		'file_description' => $description,
		'id' => $id
	]);
}



}