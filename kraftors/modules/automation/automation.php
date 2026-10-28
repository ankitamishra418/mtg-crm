<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: Automation
Description: Default module for defining automation
Version: 2.3.0
Requires at least: 2.3.*
*/

define('AUTOMATION_MODULE_NAME', 'automation');
 
hooks()->add_action('admin_init', 'automation_module_init_menu_items'); 
hooks()->add_action('admin_init', 'automation_permissions');



function automation_permissions()
{
    $capabilities = [];

    $capabilities['capabilities'] = [
            'view'   => _l('permission_view') . '(' . _l('permission_global') . ')',
            'create' => _l('permission_create'),
            'edit'   => _l('permission_edit'),
            'delete' => _l('permission_delete'),
    ];

    register_staff_capabilities('automation', $capabilities, _l('automation'));
}


/**
* Register activation module hook
*/
register_activation_hook(AUTOMATION_MODULE_NAME, 'automation_module_activation_hook');

function automation_module_activation_hook()
{
    $CI = &get_instance();
    require_once(__DIR__ . '/install.php');
}

/**
* Register language files, must be registered if the module is using languages
*/
register_language_files(AUTOMATION_MODULE_NAME, [AUTOMATION_MODULE_NAME]);

/**
 * Init automation module menu items in setup in admin_init hook
 * @return null
 */
function automation_module_init_menu_items()
{
    $CI = &get_instance();

    if (has_permission('automation', '', 'view')) {
        $CI->app_menu->add_sidebar_menu_item('automation',[
            'name'    => _l('Automation'),
            'href'    => admin_url('automation/rule'), // Indicates that this item will have submitems 
            'icon'    => 'fa fa-repeat', // Font awesome icon 
        ]);
    }
}

 