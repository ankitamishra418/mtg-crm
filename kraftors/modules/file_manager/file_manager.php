<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: File Manager
Description: The primary function of File manager for file management system (Beta version)
Version: 1.0.0
Requires at least: 2.3.*
Author: Amit verma
Author URI: https://amit.com
*/

define('FILE_MANAGER_MODULE_NAME', 'file_manager');
define('FILE_MANAGER_MODULE_UPLOAD_FOLDER', module_dir_path(FILE_MANAGER_MODULE_NAME, 'uploads'));
define('FILE_MANAGER_ATTACHMENTS_UPLOAD_FOLDER', module_dir_path(FILE_MANAGER_MODULE_NAME, 'uploads/files/'));



//hooks()->add_action('admin_init', 'file_manager_permissions');
hooks()->add_action('app_admin_head', 'file_manager_add_head_components');
//hooks()->add_action('app_admin_footer', 'file_manager_load_js');
//hooks()->add_action('app_search', 'file_manager_load_search');
hooks()->add_action('admin_init', 'file_manager_module_init_menu_items');
//add hook render profile icon on header menu
//hooks()->add_action('at', 'render_my_profile_icon');

define('VERSION_FILE_MANAGER', 1000);

/**
* Register activation module hook
*/
register_activation_hook(FILE_MANAGER_MODULE_NAME, 'file_manager_module_activation_hook');

function file_manager_module_activation_hook()
{
	$CI = &get_instance();
	require_once(__DIR__ . '/install.php');
}

/**
* Register language files, must be registered if the module is using languages
*/
register_language_files(FILE_MANAGER_MODULE_NAME, [FILE_MANAGER_MODULE_NAME]);


$CI = & get_instance();
$CI->load->helper(FILE_MANAGER_MODULE_NAME . '/file_manager');

/**
 * Init goals module menu items in setup in admin_init hook
 * @return null
 */
function file_manager_module_init_menu_items()
{   
	 $CI = &get_instance();

	// if(has_permission('hrm_dashboard','','view') || has_permission('staffmanage_orgchart','','view') || has_permission('hrm_reception_staff','','view') || has_permission('hrm_hr_records','','view') || has_permission('staffmanage_job_position','','view') || has_permission('staffmanage_training','','view') || has_permission('hr_manage_q_a','','view') || has_permission('hrm_contract','','view') || has_permission('hrm_dependent_person','','view') || has_permission('hrm_procedures_for_quitting_work','','view') || has_permission('hrm_report','','view') || has_permission('hrm_setting','','view')|| has_permission('staffmanage_orgchart','','view_own') || has_permission('staffmanage_job_position','','view_own') || has_permission('hrm_reception_staff','','view_own') || has_permission('hrm_hr_records','','view_own') || has_permission('staffmanage_training','','view_own')  || has_permission('hrm_contract','','view_own') || has_permission('hrm_dependent_person','','view_own') || has_permission('hrm_procedures_for_quitting_work','','view_own')){
	 	
	 	if (has_permission('file_manager','','view')) {
	 	$CI->app_menu->add_sidebar_menu_item('file_manager', [
	 		'name'     => _l('file_manager'),
	 		'icon'     => 'fa fa-files-o', 
	 		'position' => 0,
	 	]);
	 }

	 //if(has_permission('hrm_dashboard','','view')){
		 $CI->app_menu->add_sidebar_children_item('file_manager', [
			'slug'     => 'file_categories',
			'name'     => _l('file_category'),
			'icon'     => 'fa fa-dashboard',
			'href'     => admin_url('file_manager/categories'),
			'position' => 1,
		]);

		$CI->app_menu->add_sidebar_children_item('file_manager', [
			'slug'     => 'file_subcategory',
			'name'     => _l('file_subcategory'),
			'icon'     => 'fa fa-dashboard',
			'href'     => admin_url('file_manager/subcategory'),
			'position' => 1,
		]);

		$CI->app_menu->add_sidebar_children_item('file_manager', [
			'slug'     => 'file_category',
			'name'     => _l('file_manager'),
			'icon'     => 'fa fa-dashboard',
			'href'     => admin_url('file_manager'),
			'position' => 1,
		]);


	 //}


	//  if(has_permission('staffmanage_orgchart','','view') || has_permission('staffmanage_orgchart','','view_own')){
	// 	 $CI->app_menu->add_sidebar_children_item('hr_profile', [
	// 		'slug'     => 'hr_profile_organizational_chart',
	// 		'name'     => _l('hr_organizational_chart'),
	// 		'icon'     => 'fa fa-th-list',
	// 		'href'     => admin_url('hr_profile/organizational_chart'),
	// 		'position' => 3,
	// 	]);
	//  }
}
/**
 * hr profile load js
 */
// function hr_profile_load_js(){    
// 	$CI = &get_instance();    
// 	$viewuri = $_SERVER['REQUEST_URI'];
// 	if(!(strpos($viewuri,'admin/hr_profile/dashboard') === false)){

// 		echo '<script src="'.module_dir_url(HR_PROFILE_MODULE_NAME, 'assets/plugins/highcharts/highcharts.js').'?v=' . VERSION_HR_PROFILE.'"></script>';
// 	}

// 	if(!(strpos($viewuri,'admin/hr_profile/reports') === false)){

// 		echo '<script src="'.module_dir_url(HR_PROFILE_MODULE_NAME, 'assets/plugins/highcharts/highcharts.js').'?v=' . VERSION_HR_PROFILE.'"></script>';
// 	}


// 	//settings
// 	if(!(strpos($viewuri,'admin/hr_profile/setting?group=contract_type') === false)){
// 		echo '<script src="'.module_dir_url(HR_PROFILE_MODULE_NAME, 'assets/js/setting/contract_type.js').'?v=' . VERSION_HR_PROFILE.'"></script>';
// 	}


// }


	/**
	 * hr profile add head components
	 */
	function file_manager_add_head_components(){    

		$CI = &get_instance();
		$viewuri = $_SERVER['REQUEST_URI'];

		echo '<script src="'.module_dir_url(FILE_MANAGER_MODULE_NAME, 'assets/js/manage.js').'?v=' . VERSION_FILE_MANAGER.'"></script>';
		
		if(!(strpos($viewuri,'admin/file_manager') === false)){
			echo '<link href="' . module_dir_url(FILE_MANAGER_MODULE_NAME, 'assets/css/style.css') . '?v=' . VERSION_FILE_MANAGER. '"  rel="stylesheet" type="text/css" />';
		}

	 }

	/**
	 * hr profile permissions
	 */
	// function hr_profile_permissions()
	// {

	// 	$capabilities = [];
	// 	$capabilities_2 = [];
	// 	$capabilities_3 = [];
	// 	$dashboard = [];

	// 	$capabilities['capabilities'] = [
	// 			'view'   => _l('permission_view') . '(' . _l('permission_global') . ')',
	// 			'create' => _l('permission_create'),
	// 			'edit'   => _l('permission_edit'),
	// 			'delete' => _l('permission_delete'),
	// 	];

	// 	$capabilities_2['capabilities'] = [
	// 			// 'view_own'   => _l('permission_view'),
	// 			'view'   => _l('permission_view') . '(' . _l('permission_global') . ')',
	// 			'create' => _l('permission_create'),
	// 			'edit'   => _l('permission_edit'),
	// 			'delete' => _l('permission_delete'),
	// 	];

	// 	$capabilities_3['capabilities'] = [
	// 			'view_own'   => _l('permission_view_own'),
	// 			'view'   => _l('permission_view') . '(' . _l('permission_global') . ')',
	// 			'create' => _l('permission_create'),
	// 			'edit'   => _l('permission_edit'),
	// 			'delete' => _l('permission_delete'),
	// 	];

	// 	$dashboard['capabilities'] = [
	// 			'view'   => _l('permission_view') . '(' . _l('permission_global') . ')',
				
	// 	];

	// 	//Dashboard
	// 	register_staff_capabilities('hrm_dashboard', $dashboard, _l('HR_dashboard'));
	// 	//Orgranization
	// 	register_staff_capabilities('staffmanage_orgchart', $capabilities_3, _l('HR_organizational_chart'));
	// 	//Onboarding Process
	// 	register_staff_capabilities('hrm_reception_staff', $capabilities_3, _l('HR_reception_staff'));
	// 	//Hr Profile
	// 	register_staff_capabilities('hrm_hr_records', $capabilities_3, _l('hr_hr_records'));
	// 	//Job Description
	// 	register_staff_capabilities('staffmanage_job_position', $capabilities_3, _l('HR_job_escription'));
	// 	//Training
	// 	register_staff_capabilities('staffmanage_training', $capabilities_3, _l('HR_training'));
	// 	//Q&A
	// 	register_staff_capabilities('hr_manage_q_a', $capabilities_2, _l('HR_q&a'));
	// 	//Contracts
	// 	register_staff_capabilities('hrm_contract', $capabilities_3, _l('HR_contract'));
	// 	//Dependent Persons
	// 	register_staff_capabilities('hrm_dependent_person', $capabilities_3, _l('HR_dependent_persons'));
	// 	//Resignation procedures
	// 	register_staff_capabilities('hrm_procedures_for_quitting_work', $capabilities_3, _l('HR_resignation_procedures'));
	// 	//Reports
	// 	register_staff_capabilities('hrm_report', $dashboard, _l('HR_report'));
	// 	//Settings
	// 	register_staff_capabilities('hrm_setting', $capabilities, _l('HR_setting'));

	// }


	/**
	 * render my profile icon
	 * @return [type] 
	 */
	// function render_my_profile_icon(){
	// 	$CI = &get_instance();
	// 		echo '<li class="dropdown">
	// 		<a href="' . admin_url('hr_profile/member/' . get_staff_user_id()) . '" class="check_in_out_timesheet" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="'._l('hr_my_profile').'"><i class="fa fa-address-card"></i>
	// 		</a>' ;
	// 		echo '</li>';
	// }
