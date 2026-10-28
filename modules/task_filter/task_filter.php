<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: Task filter
Description: Module of status management, work issues
Version: 1.0.0
Requires at least: 2.3.*
*/

define('TASK_FILTER_MODULE_NAME', 'task_filter');

hooks()->add_action('admin_init', 'task_filter_permissions');
hooks()->add_action('admin_init', 'task_filter_module_init_menu_items');
hooks()->add_filter('get_dashboard_widgets', 'task_filter_add_dashboard_widget');



/**
* Register activation module hook
*/
register_activation_hook(TASK_FILTER_MODULE_NAME, 'task_filter_module_activation_hook');

function task_filter_module_activation_hook()
{
    $CI = &get_instance();
    require_once(__DIR__ . '/install.php');
}

function task_filter_add_dashboard_widget($widgets)
{
    $widgets[] = [
            'path'      => 'task_filter/task_filter_widget',
            'container' => 'top-12',
        ];

    return $widgets;
}
/**
* Register language files, must be registered if the module is using languages
*/
register_language_files(TASK_FILTER_MODULE_NAME, [TASK_FILTER_MODULE_NAME]);


$CI = & get_instance();
/*$CI->load->helper(TASK_FILTER_MODULE_NAME . '/task_filter');*/

/**
 * Init goals module menu items in setup in admin_init hook
 * @return null
 */
function task_filter_module_init_menu_items()
{
    $CI = &get_instance();
    $staff_id = $CI->session->userdata('staff_user_id');
    if ($staff_id == 1) {
        if (has_permission('task_filter', '', 'view')) {
            $CI->app_menu->add_sidebar_menu_item('task_filter', [
                'name'     =>_l('task_filter'),
                'href'     => admin_url('task_filter'),
                'icon'     => 'fa fa-fa',
                'position' => 6,
            ]);
        }
    }
}

function task_filter_permissions()
{
    $capabilities = [];

    $capabilities['capabilities'] = [
            'view'   => _l('permission_view'),
    ];

    register_staff_capabilities('task_filter', $capabilities, _l('task_filter'));
}

hooks()->add_action('app_init',TASK_FILTER_MODULE_NAME.'_actLib');
function task_filter_actLib()
{
    // $CI = & get_instance();
    // $CI->load->library(TASK_FILTER_MODULE_NAME.'/Envapi');
    // $envato_res = $CI->envapi->validatePurchase(TASK_FILTER_MODULE_NAME);
    // if (!$envato_res) {
    //     set_alert('danger', "One of your modules failed its verification and got deactivated. Please reactivate or contact support.");
    //     redirect(admin_url('modules'));
    // }
}

hooks()->add_action('pre_activate_module', TASK_FILTER_MODULE_NAME.'_sidecheck');
function task_filter_sidecheck($module_name)
{
    if ($module_name['system_name'] == TASK_FILTER_MODULE_NAME) {
        if (!option_exists(TASK_FILTER_MODULE_NAME.'_verified') && empty(get_option(TASK_FILTER_MODULE_NAME.'_verified')) && !option_exists(TASK_FILTER_MODULE_NAME.'_verification_id') && empty(get_option(TASK_FILTER_MODULE_NAME.'_verification_id'))) {
            $CI = & get_instance();
            $data['submit_url'] = $module_name['system_name'].'/env_ver/activate'; 
            $data['original_url'] = admin_url('modules/activate/'.TASK_FILTER_MODULE_NAME); 
            $data['module_name'] = TASK_FILTER_MODULE_NAME; 
            $data['title'] = "Module activation"; 
            echo $CI->load->view($module_name['system_name'].'/activate', $data, true);
            exit();
        }
    }
}

hooks()->add_action('pre_deactivate_module', TASK_FILTER_MODULE_NAME.'_deregister');
function task_filter_deregister($module_name)
{
    if ($module_name['system_name'] == TASK_FILTER_MODULE_NAME) {
        delete_option(TASK_FILTER_MODULE_NAME."_verified");
        delete_option(TASK_FILTER_MODULE_NAME."_verification_id");
        delete_option(TASK_FILTER_MODULE_NAME."_last_verification");
        if(file_exists(__DIR__."/config/token.php")){
            unlink(__DIR__."/config/token.php");
        }
    }
}