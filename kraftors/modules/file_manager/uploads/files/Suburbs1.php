<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suburbs extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
	}

	// Frontend User CRUD
	public function index()
	{
		$crud = $this->generate_suburb_crud('suburbs');
		$crud->columns('id', 'name', 'suburb_set_name' ,'images', 'videos','created_at','updated_at');//

		// disable direct create / delete Frontend User
		$crud->unset_read();
		$crud->unset_edit();
		$crud->unset_add();

        $this->mPageTitle = 'Suburbs Mangement';
		$this->render_suburb_crud();
	}

	protected function generate_suburb_crud($table,$subject='')
	{
        // create CRUD object
        $this->load->library('Grocery_CRUD');
        $this->load->library('Grocery_Suburb_CRUD');

        $crud = new grocery_Suburb_CRUD();
        $crud->set_table($table);

        // auto-generate subject
        if ( empty($subject) )
        {
            $crud->set_subject(humanize(singular($table)));
        }

        // load settings from: application/config/grocery_crud.php
        $this->load->config('grocery_crud');
        $this->mCrudUnsetFields = $this->config->item('grocery_crud_unset_fields');

        if ($this->config->item('grocery_crud_unset_jquery'))
            $crud->unset_jquery();

        if ($this->config->item('grocery_crud_unset_jquery_ui'))
            $crud->unset_jquery_ui();

        if ($this->config->item('grocery_crud_unset_print'))
            $crud->unset_print();

        if ($this->config->item('grocery_crud_unset_export'))
            $crud->unset_export();

        if ($this->config->item('grocery_crud_unset_read'))
            $crud->unset_read();

        foreach ($this->config->item('grocery_crud_display_as') as $key => $value)
            $crud->display_as($key, $value);

        // other custom logic to be done outside
        $this->mCrud = $crud;
        return $crud;
	}

	protected function render_suburb_crud()
	{
		$crud_obj_name = strtolower(get_class($this->mCrud));
        if ($crud_obj_name==='grocery_suburb_crud')
        {
            $this->mCrud->unset_fields($this->mCrudUnsetFields);
        }
        // render CRUD
        $crud_data = $this->mCrud->render();

        // append scripts
        $this->add_stylesheet($crud_data->css_files, FALSE);
        $this->add_script($crud_data->js_files, TRUE, 'head');

        // display view
        $this->mViewData['crud_output'] = $crud_data->output;
        $this->render('crud');
	}

    public function add()
    {
		$this->load->model('Suburb_set_model','suburb_set');
		$this->mPageTitle = 'Add New Suburb ';
		$suburb_set = $this->suburb_set->getall();
		$this->mViewData['suburb_set'] = $suburb_set;
		$this->mViewData['initial_title'] = '';
		$this->mViewData['initial_content'] = '';
		$this->mViewData['inital_suburb_id']  = 0;
        $this->render('suburbs/add');
	}
	public function view()
	{
			$view_id = $this->input->get('id');

			$this->load->model('Suburb_model','suburbs');
			$this->load->model('Suburb_set_model','suburb_set');
			$this->load->model('Suburb_image_model','suburb_image');
			$this->load->model('Suburb_video_model','suburb_video');
			$this->load->model('Suburb_content_model','suburb_content');

			//Load Suburb data based on $view_id
			$suburb_set = $this->suburb_set->getall();
			$suburb_level1_data = $this->suburbs->getdata_by_id($view_id);
			$suburb_contents =$this->suburb_content->getdata_by_id($view_id);
			$suburb_level2_data = $this->suburb_image->getdata_by_id($view_id);
			$suburb_level3_data = $this->suburb_video->getdata_by_id($view_id);

			$this->mViewData['initial_title'] = $suburb_level1_data[0]->name;
			$this->mViewData['initial_contents'] = $suburb_contents;
			$this->mViewData['initial_suburb_set'] = $suburb_level1_data[0]->set_id;
			$this->mViewData['initial_suburb_level2'] = $suburb_level2_data;
			$this->mViewData['initial_suburb_level3'] = $suburb_level3_data;
			$this->mViewData['suburb_set'] = $suburb_set;
			$this->mViewData['inital_suburb_id']  = $view_id;
			$this->mPageTitle = 'View Suburb ';
			$this->render('suburbs/view');
	}
	public function setsuburb()
	{
		$this->load->model('Suburb_model','suburbs');
		$this->load->model('Suburb_set_model','suburb_set');
		$suburb_set = $this->suburb_set->getall();
		$suburbs_amount = array();
		foreach($suburb_set as $key=>$one) {
			$suburbs_amount[$key] = $this->load->suburbs->get_suburbs_amount_by_setid($one->id)[0]->count;
		}

		$this->mViewData['suburb_set'] = $suburb_set;
		$this->mViewData['suburbs_amount'] = $suburbs_amount;

		$this->mPageTitle = 'Add / List Suburbs Set ';

		$this->render('suburbs/package');
	}

	public function suburbset_action()
	{
		$action = $this->input->post('action');
		$set_id = $this->input->post('setid');
		$this->load->model('Suburb_set_model','suburb_set');
		if ($action == 'edit') {
			$set_name = $this->input->post('setname');
			$id = $this->suburb_set->update_set($set_id, array('name'=>$set_name));

			echo json_encode(array('res'=>1,'id'=>$id));

		} else if ($action == 'delete') {
			$this->suburb_set->delete_set($set_id);
			echo json_encode(array('res'=>1,'id'=>0));
		}
	}
	/* Ajax Add suburb set */
	public function add_set()
	{
		$this->load->model('Suburb_set_model','suburb_set');

        $setname = $this->input->post('setname');
        $religion = $this->input->post('religion');
        $close_to_city = $this->input->post('close_to_city');
        $data = array('name'=>$setname,'religion'=>$religion,'close_to_city'=>$close_to_city);  
        //console.log($data);
		if (count($this->suburb_set->getset($setname)) == 0) {
			$id = $this->suburb_set->addset($data);
			echo json_encode(array('id'=>$id , 'res'=>'success'));
		} else {
			echo json_encode(array('id'=>0 , 'res'=>'fail'));
		}

	}
	/* Form Submit */
	public function reArrayFiles(&$file_post) {

			$file_ary = array();
			$file_count = count($file_post['name']);
			$file_keys = array_keys($file_post);

			for ($i=0; $i<$file_count; $i++) {
				foreach ($file_keys as $key) {
					$file_ary[$i][$key] = $file_post[$key][$i];
				}
			}

			return $file_ary;
	}
	public function uploadSuburbFile($sub_id , $level, $desc, $files)
	{
		$this->load->model('Suburb_image_model','suburb_image');
		$this->load->model('Suburb_video_model','suburb_video');
		for( $i=0 ; $i < count($files) ; $i++ ) {
			  //Get the temp file path
			  $tmpFilePath = $files[$i]['tmp_name'];

			  //Make sure we have a file path
			  if ($tmpFilePath != ""){
				//Setup our new file path
				$newFilePath = "./assets/uploads/suburbs/". $level . '/' . $sub_id . '_' . $files[$i]['name'];
				$full_path_resized = "./assets/uploads/suburbs/". $level . '/thumb/' . $sub_id . '_' . $files[$i]['name'];
				//Upload the file into the temp dir
				if(move_uploaded_file($tmpFilePath, $newFilePath)) {
					if ($level == 'image') {
						$this->correctImageOrientation($newFilePath);
						$im_config['image_library'] = 'gd2';
						$im_config['create_thumb'] = TRUE;
						$im_config['thumb_marker'] = '';
						$im_config['maintain_ratio'] = TRUE;
						$im_config['width']	= 800;
						$im_config['height']	= 800;
						$im_config['quality']	= '70%';
						$im_config['source_image']	= $newFilePath;
						$im_config['new_image']	= $full_path_resized;
						$this->load->library('image_lib', $im_config);
						if ( ! $this->image_lib->resize())
						{
							error_log($this->image_lib->display_errors());
						}
					}

				  //Handle other code here
					$input_data = array(
						'sub_id' 	=> $sub_id,
						'filename' 	=> $sub_id . '_' . $files[$i]['name'],
						'description' => $desc[$i],
						'index'  	=> $i+1,
					);

					if ($level == 'image')
						$this->suburb_image->add_suburb_image($input_data);

					if ($level == 'video') {
						$input_data1 = array(
							'sub_id' 	=> $sub_id,
							'filename' 	=> $files,
							'description' => $desc[$i],
							'index'  	=> $i+1,
						);

						$this->suburb_video->add_suburb_video($input_data1);
					}

				}
			}
		}
	}

	public function correctImageOrientation($filename) {
		if (function_exists('exif_read_data')) {
			$exif = exif_read_data($filename);
			if($exif && isset($exif['Orientation'])) {
				$orientation = $exif['Orientation'];
				if($orientation != 1){
					$img = imagecreatefromjpeg($filename);
					$deg = 0;
					switch ($orientation) {
					case 3:
						$deg = 180;
						break;
					case 6:
						$deg = 270;
						break;
					case 8:
						$deg = 90;
						break;
					}
					if ($deg) {
					$img = imagerotate($img, $deg, 0);
					}
					// then rewrite the rotated image back to the disk as $filename
					imagejpeg($img, $filename, 95);
				} // if there is some rotation necessary
			} // if have the exif orientation info
		} // if function exists
	}

	public function suburb_upload()
	{	
		$video=$this->input->post('mytext');
		$vid_desc=$this->input->post('mydesc');
		
		$data = array();
	
		$initial_id = $this->input->post('inital_suburb_id');
		$title = $this->input->post('suburb_title');
		$section_titles = $this->input->post('suburb_section_title');
		$section_contents = $this->input->post('suburb_content');
		$set = $this->input->post('hidden_suburb_set');

		$hidden_level2_img_files = $this->input->post('myname');
	
	//	$hidden_level3_vid_files = $this->input->post('hidden_level3_vid_files');
		$level = 1;
		//Add to  suburbs table
		$this->load->model('Suburb_model','suburbs');
		$this->load->model('Suburb_image_model','suburb_image');
		$this->load->model('Suburb_video_model','suburb_video');
		$this->load->model('Suburb_content_model','suburb_content');

		$sub_id = 0;
		if ($initial_id != 0) {
			//Update
			$input_data = array(
				'name' 		=> $title,
 				// 'content' 	=> $content,
				'level' 	=> $level,
				'set_id'	=> $set,
				'updated_at'=> strtotime(date('Y-m-d H:i:s')),
			);
			$sub_id = $this->suburbs->update_suburb($initial_id,$input_data);
		} else {
			//Insert
			$input_data = array(
				'name' 		=> $title,
 				// 'content' 	=> $content,
				'level' 	=> $level,
				'set_id'	=> $set,
				'created_at'=> strtotime(date('Y-m-d H:i:s')),
			);
			$sub_id = $this->suburbs->add_suburb($input_data);
		}
		
		if ($sub_id != 0) {
			if ($initial_id != 0 ) {
				//Delete all suburbs related files.
				$this->delete_all_suburb_files($initial_id);

				//Upload Hidden Hidden Level2, 3 Image and Video
				if (isset($hidden_level2_img_files)) {
					$desc = $this->input->post('hidden_suburb_img_desc');
					foreach($hidden_level2_img_files as $key=>$one_level2_img) {
						$input_data = array(
							'sub_id' 	=> $sub_id,
							'filename' 	=> $one_level2_img,
							'description' => $desc[$key],
							'index'  	=> ($key+1),
						);
						$this->suburb_image->add_suburb_image($input_data);
					}
				}

				if($video!='') {
					$index=0;
					for($i=0;$i< count($video);$i++){
						$input_data = array(
							'sub_id' 	=> $sub_id,
							'filename' 	=>$video[$i],
							'description' => $vid_desc[$i],
							'index'  	=> ($index+1),
						);
		
						$this->suburb_video->add_suburb_video($input_data);
					}
				}
			}
			
			//Add to  suburb_image table
			/* Upload File and insert table */
			if (isset($_FILES['suburb_imgfiles']) && count($_FILES['suburb_imgfiles'])>0 ) {
				$level2_file = $this->reArrayFiles($_FILES['suburb_imgfiles']);
				$level2_desc = $this->input->post('hidden_suburb_img_desc');
				$level = 2;
				$this->uploadSuburbFile($sub_id, 'image',$level2_desc,$level2_file);
			}
			//Add to  suburb_video table
				/* Upload File and insert table */
			if (isset($_FILES['suburb_vidfiles']) && count($_FILES['suburb_vidfiles'])>0) {
				$level3_file = $this->input->post('mytext');
				$level3_desc = $this->input->post('mydesc');
				$level = 3;
				$this->uploadSuburbFile($sub_id, 'video',$level3_desc,$level3_file);
			}

			/* Add Suburb Content to table */
			foreach ($section_titles as $key=>$title) {
				$input_data = array(
					'sub_id'=>$sub_id,
					'title'	=>$title,
					'content'=>$section_contents[$key],
					'index'=>($key+1)
				);
				$this->suburb_content->addcontent($input_data);
			}

			$data['res'] = 1;
			$data['level'] = $level;
		} else {
			$data['res'] = 0;
			$data['level'] = $level;
		}

        redirect('admin/suburbs');
		//echo json_encode($data);
	}
	public function delete_all_suburb_files($id) {
		$this->load->model('Suburb_image_model','suburb_image');
		$this->load->model('Suburb_video_model','suburb_video');
		$this->load->model('Suburb_content_model','suburb_content');
		$this->suburb_image->delete_by_sub_id($id);
		$this->suburb_video->delete_by_sub_id($id);
		$this->suburb_content->delete_by_sub_id($id);
	}
}