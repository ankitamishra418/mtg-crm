<?php
defined('BASEPATH') or exit('No direct script access allowed');

	/**
	 * handle file manager attachments array
	 * @param  [type] $attachment_id 
	 * @param  string $index_name      
	 * @return [type]                  
	 */
	function handle_file_manager_attachments_array($id, $index_name = 'file')
	{
       
		$uploaded_files = [];
		$path           = get_file_manager_upload_path_by_type('attachment').$id .'/';
        
		$CI             = &get_instance();
		if (isset($_FILES[$index_name]['name'])
			&& ($_FILES[$index_name]['name'] != '' || is_array($_FILES[$index_name]['name']) && count($_FILES[$index_name]['name']) > 0)) {
			if (!is_array($_FILES[$index_name]['name'])) {
				$_FILES[$index_name]['name']     = [$_FILES[$index_name]['name']];
				$_FILES[$index_name]['type']     = [$_FILES[$index_name]['type']];
				$_FILES[$index_name]['tmp_name'] = [$_FILES[$index_name]['tmp_name']];
				$_FILES[$index_name]['error']    = [$_FILES[$index_name]['error']];
				$_FILES[$index_name]['size']     = [$_FILES[$index_name]['size']];
			}

				_file_attachments_index_fix($index_name);
				for ($i = 0; $i < count($_FILES[$index_name]['name']); $i++) {
					$tmpFilePath = $_FILES[$index_name]['tmp_name'][$i];
					if (!empty($tmpFilePath) && $tmpFilePath != '') {
						if (_perfex_upload_error($_FILES[$index_name]['error'][$i])
							|| !_upload_extension_allowed($_FILES[$index_name]['name'][$i])) {
							continue;
					}

					_maybe_create_upload_path($path);
					$filename    = unique_filename($path, $_FILES[$index_name]['name'][$i]);
					$newFilePath = $path . $filename;
					if (move_uploaded_file($tmpFilePath, $newFilePath)) {
						array_push($uploaded_files, [
							'file_name' => $filename,
							'filetype'  => $_FILES[$index_name]['type'][$i],
						]);
						if (is_image($newFilePath)) {
							create_img_thumb($path, $filename);
						}
					}
				}
			}
		}
		if (count($uploaded_files) > 0) {
			return $uploaded_files;
		}
		return false;
	}


/**
 * get hr profile upload path by type
 * @param  string $type 
 */
function get_file_manager_upload_path_by_type($type)
{
	$path = '';
	switch ($type) {
		case 'attachment':
		$path = FILE_MANAGER_ATTACHMENTS_UPLOAD_FOLDER;

		break;

		case 'job_position':
		$path = HR_PROFILE_JOB_POSIITON_ATTACHMENTS_UPLOAD_FOLDER;

		break;
		
	}

	return hooks()->apply_filters('get_file_manager_upload_path_by_type', $path, $type);
}
