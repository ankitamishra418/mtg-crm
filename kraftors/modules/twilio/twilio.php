<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: Twilio
Description: Default module for defining Twilio
Version: 2.3.0
Requires at least: 2.3.*
*/

define('TWILIO_MODULE_NAME', 'twilio');
 
hooks()->add_action('admin_init', 'twilio_module_init_menu_items'); 
hooks()->add_action('admin_init', 'twilio_permissions');
 
 

/**
* Register activation module hook
*/
register_activation_hook(TWILIO_MODULE_NAME, 'twilio_module_activation_hook');

function twilio_module_activation_hook()
{
    $CI = &get_instance();
    require_once(__DIR__ . '/install.php');
}

/**
* Register language files, must be registered if the module is using languages
*/
register_language_files(TWILIO_MODULE_NAME, [TWILIO_MODULE_NAME]);




$CI = & get_instance();

$CI->load->helper(TWILIO_MODULE_NAME . '/twilio');

/**
 * Init twilio module menu items in setup in admin_init hook
 * @return null
 */
function twilio_module_init_menu_items()
{
    $CI = &get_instance();
   if (has_permission('twilio', '', 'view')) {
        $CI->app_menu->add_sidebar_menu_item('twilio',[
            'name'       => _l('calls_manager'),
            'href' => admin_url('#'), // Indicates that this item will have submitems 
            'icon'     => 'fa fa-phone', // Font awesome icon
            'position' => 3,
        ]);
        if (is_admin()) {
            $CI->app_menu->add_sidebar_children_item('twilio', [
                'slug'     => 'calling_numbers',
                'name'     => _l('calling_numbers'),
                'href'     => admin_url('twilio/twilio_menu/calling_numbers'), 
                'position' => 5,
            ]);
            $CI->app_menu->add_sidebar_children_item('twilio', [
                'slug'     => 'calling_pricing',
                'name'     => _l('calling_pricing'),
                'href'     => admin_url('twilio/twilio_menu/purchase_number') ,
                'position' => 10,
            ]);
            $CI->app_menu->add_sidebar_children_item('twilio', [
                'slug'     => 'calling_credit',
                'name'     => _l('calling_credit'),
                'href'     => admin_url('twilio/twilio_menu/calling_credit') ,
                'position' => 15,
            ]);

            $CI->app_menu->add_sidebar_children_item('twilio', [
                'slug'     => 'call_forword',
                'name'     => _l('call_forword'),
                'href'     => admin_url('twilio/twilio_menu/call_forword') ,
                'position' => 10,
            ]);

        }
        
        $CI->app_menu->add_sidebar_children_item('twilio', [
            'slug'     => 'calling_log',
            'name'     => _l('calling_log'),
            'href'     => admin_url('twilio/twilio_menu/dialer') ,
            'position' => 20,
        ]);
        // $CI->app_menu->add_sidebar_children_item('twilio', [
        //     'slug'     => 'help_section',
        //     'name'     => _l('help_section'),
        //     'href'     => admin_url('twilio/twilio_menu/help_section') ,
        //     'position' => 25,
        // ]); 
    } 
}

function twilio_permissions()

{

    $capabilities = [];



    $capabilities['capabilities'] = [

            'view'   => _l('permission_view') . '(' . _l('permission_global') . ')',

            'create' => _l('permission_create'),

            'edit'   => _l('permission_edit'),

            'delete' => _l('permission_delete'),

    ];



    register_staff_capabilities('twilio', $capabilities, _l('Twilio'));

}
 
 