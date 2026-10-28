<?php

defined('BASEPATH') or exit('No direct script access allowed');

function app_init_admin_sidebar_menu_items()
{
    $CI = &get_instance();
    $staff_id = $CI->session->userdata('staff_user_id');

    $CI->app_menu->add_sidebar_menu_item('dashboard', [
        'name'     => _l('als_dashboard'),
        'href'     => admin_url(),
        'position' => 1,
        'icon'     => 'fa fa-home',
        'badge'    => [],
    ]);


    if (has_permission('customers', '', 'view')
        || (have_assigned_customers()
            || (!have_assigned_customers() && has_permission('customers', '', 'create')))) {
       
        $CI->app_menu->add_sidebar_menu_item('customers', [
            'name'     => _l('Clients'),
            'href'     => admin_url('clients'),
            'position' => 5,
            'icon'     => 'fa fa-user-o',
            'badge'    => [],
        ]);

    }

    $CI->app_menu->add_sidebar_children_item('customers', [
        'slug'     => 'customers_clients',
        'name'     => _l('als_clients'),
        'href'     => admin_url('clients'),
        'badge'    => [],
    ]);

    $CI->app_menu->add_sidebar_children_item('customers', [
        'slug'     => 'all_contacts',
        'name'     => 'Individuals',
        'href'     => admin_url('clients/all_contacts'),
        'badge'    => [],
    ]);

    $CI->app_menu->add_sidebar_children_item('customers', [
        'slug'     => 'client_reviews',
        'name'     => 'Client Reviews',
        'href'     => admin_url('clients/report_client_reviews'),
        'badge'    => [],
    ]);


    if(is_admin()){
        $CI->app_menu->add_sidebar_children_item('customers', [
            'slug'     => 'occupation',
            'name'     => 'Occupation Class',
            'href'     => admin_url('clients/occupationClass'),
            'badge'    => [],
        ]);

        $CI->app_menu->add_sidebar_children_item('customers', [
            'slug'     => 'vulnerableDrivers',
            'name'     => 'Vulnerable Drivers',
            'href'     => admin_url('clients/vulnerableDrivers'),
            'badge'    => [],
        ]);

         $CI->app_menu->add_sidebar_children_item('customers', [
            'slug'     => 'client_type',
            'name'     => 'Type',
            'href'     => admin_url('clients/type'),
            'badge'    => [],
        ]);

        $CI->app_menu->add_sidebar_children_item('customers', [
            'slug'     => 'files_archive',
            'name'     => 'Files Archive',
            'href'     => admin_url('clients/files_archive'),
            'badge'    => [],
        ]);

        $CI->app_menu->add_sidebar_children_item('customers', [
            'slug'     => 'smoker',
            'name'     => 'Smoker',
            'href'     => admin_url('clients/smoker'),
            'badge'    => [],
        ]);


        if($staff_id == 1) {
            $CI->app_menu->add_sidebar_menu_item('sales', [
                'collapse' => true,
                'name'     => _l('als_sales'),
                'position' => 10,
                'icon'     => 'fa fa-balance-scale',
                'badge'    => [],
            ]);
        }
    }

    if (has_permission('policy', '', 'view') || has_permission('policy', '', 'view_own')) {
        $CI->app_menu->add_sidebar_menu_item('Policy', [
            'collapse' => true,
            'name'     => 'Policy',
            'position' => 11,
            'icon'     => 'fa fa-tasks',
            'badge'    => [],
        ]);
        
        $CI->app_menu->add_sidebar_children_item('Policy', [
                'slug'     => 'addpolicy',
                'name'     => 'New Policy',
                'href'     => admin_url('Policy/addPolicy'),
                'badge'    => [],
        ]);

        $CI->app_menu->add_sidebar_children_item('Policy', [
            'slug'     => 'policies',
            'name'     => 'Policy Search',
            'href'     => admin_url('Policy/showPolicyData'),
            'badge'    => [],
        ]);
        
        $CI->app_menu->add_sidebar_children_item('Policy', [
            'slug'     => 'viewreport_policy',
            'name'     => 'Policy Report',
            'href'     => admin_url('policy/report'),
            'badge'    => [],
        ]);

        if (has_permission('policy', '', 'create')) {
           
            if(is_admin()){
                $CI->app_menu->add_sidebar_children_item('Policy', [
                    'slug'     => 'addpolicybenefits',
                    'name'     => 'Add Benefit',
                    'href'     => admin_url('Policy/policyBenefits'),
                    'badge'    => [],
                ]);
            
                $CI->app_menu->add_sidebar_children_item('Policy', [
                    'slug'     => 'PolicyBenefits',
                    'name'     => 'Benefits',
                    'href'     => admin_url('Policy/showpolicyBenefits'),
                    'badge'    => [],
                ]);
                $CI->app_menu->add_sidebar_children_item('Policy', [
                    'slug'     => 'addprovider',
                    'name'     => 'Add Provider',
                    'href'     => admin_url('Provider/addprovider'),
                    'badge'    => [],
                ]);
            
                $CI->app_menu->add_sidebar_children_item('Policy', [
                    'slug'     => 'showproviders',
                    'name'     => 'Providers',
                    'href'     => admin_url('Provider/showproviders'),
                    'badge'    => [],
                ]);
                
                $CI->app_menu->add_sidebar_children_item('Policy', [
                    'slug'     => 'addpremiunfrequency',
                    'name'     => 'Premiun Frequency',
                    'href'     => admin_url('policy/addpremiumfrequency'),
                    'badge'    => [],
                ]);
                
                $CI->app_menu->add_sidebar_children_item('Policy', [
                    'slug'     => 'addcovetype',
                    'name'     => 'Cover Type',
                    'href'     => admin_url('policy/addCovertype'),
                    'badge'    => [],
                ]);
            
                $CI->app_menu->add_sidebar_children_item('Policy', [
                    'slug'     => 'addpolicystatus',
                    'name'     => 'Policy Status',
                    'href'     => admin_url('policy/addPolicystatus'),
                    'badge'    => [],
                ]);

                $CI->app_menu->add_sidebar_children_item('Policy', [
                    'slug'     => 'addbenefitgrouping',
                    'name'     => 'Benefit Grouping',
                    'href'     => admin_url('policy/addBenefitGrouping'),
                    'badge'    => [],
                ]);
            }
        }
    }


    $CI->app_menu->add_sidebar_children_item('my_business', [
        'slug'     => 'viewreportPolicy',
        'name'     => 'Policy Report',
        'href'     => admin_url('policy/report'),
        'badge'    => [],
    ]);

    $CI->app_menu->add_sidebar_children_item('my_business', [
        'slug'     => 'client_reviews',
        'name'     => 'Client Reviews',
        'icon'     => 'fa fa-database',
        'href'     => admin_url('clients/report_client_reviews'),
        'badge'    => [],
    ]);


    if(is_staff_member()){
        $CI->app_menu->add_sidebar_children_item('my_business', [
            'slug'     => 'als_leads',
            'name'     => 'als_leads',
            'icon'     => 'fa fa-tty',
            'href'     => admin_url('leads'),
            'badge'    => [],
        ]);
        
        $CI->app_menu->add_sidebar_menu_item('als_leads', [
            'slug'     => 'als_leads',
            'name'     => 'als_leads',
            'icon'     => 'fa fa-tty',
            'href'     => admin_url('leads'),
            'position' => 85,
            'badge'    => [],
        ]);
    }

    //Complaints
    $CI->app_menu->add_sidebar_menu_item('proposals', [
        'slug'     => 'proposals',
        'name'     => _l('proposals'),
        'href'     => admin_url('proposals'),
        'position' => 5,
        'badge'    => [],
    ]);

    $CI->app_menu->add_sidebar_children_item('proposals', [
        'slug'     => 'proposals',
        'name'     => _l('proposals'),
        'href'     => admin_url('proposals'),
        'badge'    => [],
    ]);


    if(is_admin()) {

        $CI->app_menu->add_sidebar_children_item('proposals', [
            'slug'     => 'outcome_category',
            'name'     => 'Outcome Category',
            'href'     => admin_url('proposals/OutcomeCategory'),
            'badge'    => [],
        ]);
        $CI->app_menu->add_sidebar_children_item('proposals', [
            'slug'     => 'business_type',
            'name'     => 'business Type',
            'href'     => admin_url('proposals/BusinessType'),
            'badge'    => [],
        ]);
        $CI->app_menu->add_sidebar_children_item('proposals', [
            'slug'     => 'product_type',
            'name'     => _l('Product Type'),
            'href'     => admin_url('proposals/productType'),
            'position' => 6,
            'badge'    => [],
        ]);

        $CI->app_menu->add_sidebar_children_item('proposals', [
            'slug'     => 'medium',
            'name'     => _l('Medium'),
            'href'     => admin_url('proposals/medium'),
            'position' => 8,
            'badge'    => [],
        ]);
        $CI->app_menu->add_sidebar_children_item('proposals', [
            'slug'     => 'status',
            'name'     => _l('Status'),
            'href'     => admin_url('proposals/status'),
            'position' => 9,
            'badge'    => [],
        ]);
        $CI->app_menu->add_sidebar_children_item('proposals', [
            'slug'     => 'complaintsCategory',
            'name'     => _l('Complaints Category'),
            'href'     => admin_url('proposals/complaintsCategory'),
            'position' => 9,
            'badge'    => [],
        ]);
    }

    $CI->app_menu->add_sidebar_children_item('sales', [
        'slug'     => 'complaints',
        'name'     => _l('Complaint Against'),
        'href'     => admin_url('proposals/complaintAgainst'),
        'position' => 7,
        'badge'    => [],
    ]);

    if ((has_permission('estimates', '', 'view') || has_permission('estimates', '', 'view_own'))
        || (staff_has_assigned_estimates() && get_option('allow_staff_view_estimates_assigned') == 1) ) {
        $CI->app_menu->add_sidebar_children_item('sales', [
            'slug'     => 'estimates',
            'name'     => _l('estimates'),
            'href'     => admin_url('estimates'),
            'position' => 10,
            'badge'    => [],
        ]); 
    }

    if ((has_permission('invoices', '', 'view') || has_permission('invoices', '', 'view_own'))
        || (staff_has_assigned_invoices() && get_option('allow_staff_view_invoices_assigned') == 1) ) {
        $CI->app_menu->add_sidebar_children_item('sales', [
            'slug'     => 'invoices',
            'name'     => _l('invoices'),
            'href'     => admin_url('invoices'),
            'position' => 15,
            'badge'    => [],
        ]);
    }

    if (has_permission('payments', '', 'view') || has_permission('invoices', '', 'view_own')
        || (get_option('allow_staff_view_invoices_assigned') == 1 && staff_has_assigned_invoices()) ) {
        $CI->app_menu->add_sidebar_children_item('sales', [
            'slug'     => 'payments',
            'name'     => _l('payments'),
            'href'     => admin_url('payments'),
            'position' => 20,
            'badge'    => [],
        ]);
    }
        
    if (has_permission('credit_notes', '', 'view') || has_permission('credit_notes', '', 'view_own')) {
        $CI->app_menu->add_sidebar_children_item('sales', [
            'slug'     => 'credit_notes',
            'name'     => _l('credit_notes'),
            'href'     => admin_url('credit_notes'),
            'position' => 25,
            'badge'    => [],
        ]);
    }

    if (has_permission('items', '', 'view')) {
        $CI->app_menu->add_sidebar_children_item('sales', [
            'slug'     => 'items',
            'name'     => _l('items'),
            'href'     => admin_url('invoice_items'),
            'position' => 30,
            'badge'    => [],
        ]);
    }

    if ($staff_id == 1) {

        if ((has_permission('estimate_request', '', 'view') || has_permission('estimate_request', '', 'view_own'))) {
            $CI->app_menu->add_sidebar_menu_item('estimate_request', [
                'name'     => _l('estimate_request'),
                'href'     => admin_url('estimate_request'),
                'position' => 46,
                'icon'     => 'fa fa-list-alt',
                'badge'    => [],
            ]);
        }

        if (has_permission('subscriptions', '', 'view') || has_permission('subscriptions', '', 'view_own')) {
            $CI->app_menu->add_sidebar_menu_item('subscriptions', [
                'name'     => _l('subscriptions'),
                'href'     => admin_url('subscriptions'),
                'icon'     => 'fa fa-repeat',
                'position' => 15,
                'badge'    => [],
            ]);
        }

        if (has_permission('expenses', '', 'view') || has_permission('expenses', '', 'view_own')) {
            $CI->app_menu->add_sidebar_menu_item('expenses', [
                'name'     => _l('expenses'),
                'href'     => admin_url('expenses'),
                'icon'     => 'fa fa-file-text-o',
                'position' => 20,
                'badge'    => [],
            ]);
        }

        if (has_permission('contracts', '', 'view') || has_permission('contracts', '', 'view_own')) {
            $CI->app_menu->add_sidebar_menu_item('contracts', [
                'name'     => _l('contracts'),
                'href'     => admin_url('contracts'),
                'icon'     => 'fa fa-file',
                'position' => 25,
                'badge'    => [],
            ]);
        }
    }

    $CI->app_menu->add_sidebar_menu_item('workflow_report', [
        'name'     => _l('Activity Reports'),
        'href'     => admin_url('contracts'),
        'icon'     => 'fa fa-file',
        'position' => 31,
        'badge'    => [],
    ]);

    $CI->app_menu->add_sidebar_children_item('workflow_report', [
        'slug'     => 'report_arears',
        'name'     => _l('Arrears Report'),
        'href'     => admin_url('projects/report_arears'),
        'badge'    => [],
    ]);


    $CI->app_menu->add_sidebar_children_item('workflow_report', [
        'slug'     => 'report_underwriting',
        'name'     => _l('Underwriting Report'),
        'href'     => admin_url('projects/report_underwriting'),
        'badge'    => [],
    ]);
    
    $CI->app_menu->add_sidebar_children_item('workflow_report', [
        'slug'     => 'wip_report',
        'name'     => _l('WIP Report'),
        'href'     => admin_url('projects/report_adviser'),
        'badge'    => [],
    ]);

    $CI->app_menu->add_sidebar_children_item('workflow_report', [
        'slug'     => 'report_underwriting_by_adviser',
        // 'name'     => _l('Underwriting by Adviser'),
        'name'     => _l('Pipeline Report'),
        'href'     => admin_url('projects/report_underwriting_by_adviser'),
        'badge'    => [],
    ]);

    $CI->app_menu->add_sidebar_children_item('workflow_report', [
        'slug'     => 'activity_report',
        'name'     => _l('Activities Report'),
        'href'     => admin_url('projects/activity_report'),
        'badge'    => [],
    ]);
    

    $CI->app_menu->add_sidebar_menu_item('projects', [
        'name'     => _l('projects'),
        'href'     => admin_url('projects'),
        'icon'     => 'fa fa-bars',
        'position' => 30,
        'badge'    => [],
    ]);






    if (is_admin()) {

        $CI->app_menu->add_sidebar_children_item('projects', [
            'slug'  => 'claim_identified',
            'name'  => 'Claim Identified',
            'href'  => admin_url('projects/claimIdentified'),
            'badge' => [],
        ]);

        $CI->app_menu->add_sidebar_children_item('projects', [
            'name'     => _l('projects'),
            'href'     => admin_url('projects'),
            'badge'    => [],
        ]);  

        $CI->app_menu->add_sidebar_children_item('projects', [
            'slug'     => 'projedddcts',
            'name'     => 'Stage',
            'href'     => admin_url('projects/Stage'),
            'badge'    => [],
        ]);
        
        $CI->app_menu->add_sidebar_children_item('projects', [
            'slug'     => 'projectype',
            'name'     => 'Project Type',
            'href'     => admin_url('projects/projectype'),
            'badge'    => [],
        ]);

        $CI->app_menu->add_sidebar_children_item('projects', [
            'slug'     => 'outcome',
            'name'     => 'Outcome',
            'href'     => admin_url('projects/projectOutcome'),
            'badge'    => [],
        ]);

        $CI->app_menu->add_sidebar_children_item('projects', [
            'slug'     => 'Reason_For_No_Claim',
            'name'     => 'Reason For No Claim',
            'href'     => admin_url('projects/reasonNoClaim'),
            'badge'    => [],
        ]);

        $CI->app_menu->add_sidebar_children_item('projects', [
            'name'     => 'Condition Groups',
            'href'     => admin_url('projects/conditionalgroup'),
            'badge'    => [],
        ]);

        $CI->app_menu->add_sidebar_children_item('projects', [
            'name'     => 'Final Status',
            'href'     => admin_url('projects/finalstatus'),
            'badge'    => [],
        ]);

        $CI->app_menu->add_sidebar_children_item('projects', [
            'name'     => 'Date Requested to Issue',
            'href'     => admin_url('projects/daterequestIssue'),
            'badge'    => [],
        ]);

        $CI->app_menu->add_sidebar_children_item('projects', [
            'slug'     => 'policy_not_issued_reason',
            'name'     => 'Policy Not Issued Reason',
            'href'     => admin_url('projects/reasonNotissuepolicy'),
            'badge'    => [],
        ]);

        $CI->app_menu->add_sidebar_children_item('projects', [
            'slug'     => 'commission_split',
            'name'     => 'Commission Split',
            'href'     => admin_url('projects/commisionsplit'),
            'badge'    => [],
        ]);


                $CI->app_menu->add_sidebar_children_item('projects', [
            'slug'     => 'source',
            'name'     => 'Source',
            'href'     => admin_url('projects/source'),
            'badge'    => [],
        ]);
        
        $CI->app_menu->add_sidebar_children_item('projects', [
            'slug'     => 'replaceBusiness',
            'name'     => 'Replacement Business',
            'href'     => admin_url('projects/replaceBusiness'),
            'badge'    => [],
        ]);

        $CI->app_menu->add_sidebar_children_item('projects', [
            'slug'     => 'replaceReason',
            'name'     => 'Replacement Reason',
            'href'     => admin_url('projects/replaceReason'),
            'badge'    => [],
        ]);
    
        $CI->app_menu->add_sidebar_children_item('projects', [
            'slug'     => 'cancellationOutcome',
            'name'     => 'Outcome of Cancellation',
            'href'     => admin_url('projects/cancellationOutcome'),
            'badge'    => [],
        ]);
        
        $CI->app_menu->add_sidebar_children_item('projects', [
            'slug'     => 'newPolicyCommission',
            'name'     => 'New Policy Commission Type',
            'href'     => admin_url('projects/newPolicyCommission'),
            'badge'    => [],
        ]);
        
        $CI->app_menu->add_sidebar_children_item('projects', [
            'slug'     => 'reasonforCancellation',
            'name'     => 'Reason for Cancellation',
            'href'     => admin_url('projects/reasonforCancellation'),
            'badge'    => [],
        ]);

        $CI->app_menu->add_sidebar_children_item('projects', [
            'slug'     => 'compliances_data',
            'name'     => 'Compliances',
            'href'     => admin_url('projects/addCompliences'),
            'badge'    => [],
        ]);

        $CI->app_menu->add_sidebar_children_item('projects', [
            'slug'     => 'reason_arreas',
            'name'     => 'Reason for Arreas',
            'href'     => admin_url('projects/reasonForArrears'),
            'badge'    => [],
        ]);

        $CI->app_menu->add_sidebar_children_item('projects', [
            'slug'     => 'arreasStatus',
            'name'     => 'Arreas Status',
            'href'     => admin_url('projects/arreasStatus'),
            'badge'    => [],
        ]);

        $CI->app_menu->add_sidebar_children_item('projects', [
            'slug'     => 'underwrittingStatus',
            'name'     => 'Underwritting Status',
            'href'     => admin_url('projects/underwrittingStatus'),
            'badge'    => [],
        ]);

        $CI->app_menu->add_sidebar_children_item('projects', [
            'slug'     => 'cancellationStatus',
            'name'     => 'Cancellation Status',
            'href'     => admin_url('projects/cancellationStatus'),
            'badge'    => [],
        ]);

        $CI->app_menu->add_sidebar_children_item('projects', [
            'slug'     => 'benefitsBeingChange',
            'name'     => 'Benefit Being Change',
            'href'     => admin_url('projects/benefitsBeingChange'),
            'badge'    => [],
        ]);

        $CI->app_menu->add_sidebar_children_item('projects', [
            'slug'     => 'category',
            'name'     => 'Category',
            'href'     => admin_url('projects/category'),
            'badge'    => [],
        ]);

        $CI->app_menu->add_sidebar_children_item('projects', [
            'slug'     => 'add_project_template',
            'name'     => 'Add Project Template',
            'href'     => admin_url('projects/addprojecttemplate'),
            'badge'    => [],
        ]);

        $CI->app_menu->add_sidebar_children_item('projects', [
            'slug'     => 'add_project_template',
            'name'     => 'Add Project Template',
            'href'     => admin_url('projects/addprojecttemplate'),
            'badge'    => [],
        ]);

    }

    $CI->app_menu->add_sidebar_menu_item('tasks', [
        'name'     => _l('als_tasks'),
        'href'     => admin_url('tasks'),
        'icon'     => 'fa fa-tasks',
        'position' => 35,
        'badge'    => [],
    ]);


    if ((!is_staff_member() && get_option('access_tickets_to_none_staff_members') == 1) || is_staff_member()) {

        $enable_badge = get_option('enable_support_menu_badges');
        if(is_admin() && $staff_id == 1){
            $CI->app_menu->add_sidebar_menu_item('support', [
                'collapse' => $enable_badge,
                'name'     => _l('support'),
                'href'     => admin_url('tickets'),
                'icon'     => 'fa fa-ticket',
                'position' => 40,
                'badge'    => [],
            ]);
        }

        $CI->load->model('tickets_model');
        $statuses = $CI->tickets_model->get_ticket_status();

        if ($enable_badge) {
            foreach ($statuses as $status) {
                $CI->app_menu->add_sidebar_children_item('support', [
                    'slug'     => 'support-' . $status['ticketstatusid'],
                    'name'     => ticket_status_translate($status['ticketstatusid']),
                    'href'     => admin_url('tickets/index/' . $status['ticketstatusid']),
                    'position' => $status['statusorder'],
                    'badge'    => [
                        'value' => $CI->tickets_model->ticket_count($status['ticketstatusid']),
                        'color' => $status['statuscolor'],
                    ],
                ]);
            }
        }
    }

    if (has_permission('knowledge_base', '', 'view')) {
        if(is_admin() && $staff_id == 1){
            $CI->app_menu->add_sidebar_menu_item('knowledge-base', [
                'name'     => _l('als_kb'),
                'href'     => admin_url('knowledge_base'),
                'icon'     => 'fa fa-folder-open-o',
                'position' => 50,
                'badge'    => [],
            ]);
        }
    }
    

    if(is_admin()){
        // Utilities
        $CI->app_menu->add_sidebar_menu_item('utilities', [
            'collapse' => true,
            'name'     => _l('als_utilities'),
            'position' => 55,
            'icon'     => 'fa fa-cogs',
            'badge'    => [],
        ]);
    }

    $CI->app_menu->add_sidebar_children_item('utilities', [
        'slug'     => 'media',
        'name'     => _l('als_media'),
        'href'     => admin_url('utilities/media'),
        'position' => 5,
        'badge'    => [],
    ]);

    if (has_permission('bulk_pdf_exporter', '', 'view')) {
        $CI->app_menu->add_sidebar_children_item('utilities', [
            'slug'     => 'bulk-pdf-exporter',
            'name'     => _l('bulk_pdf_exporter'),
            'href'     => admin_url('utilities/bulk_pdf_exporter'),
            'position' => 10,
            'badge'    => [],
        ]);
    }

    $CI->app_menu->add_sidebar_children_item('utilities', [
        'slug'     => 'calendar',
        'name'     => _l('als_calendar_submenu'),
        'href'     => admin_url('utilities/calendar'),
        'position' => 15,
        'badge'    => [],
    ]);

    if (is_admin()) {
        $CI->app_menu->add_sidebar_children_item('utilities', [
            'slug'     => 'announcements',
            'name'     => _l('als_announcements_submenu'),
            'href'     => admin_url('announcements'),
            'position' => 20,
            'badge'    => [],
        ]);

        $CI->app_menu->add_sidebar_children_item('utilities', [
            'slug'     => 'activity-log',
            'name'     => _l('als_activity_log_submenu'),
            'href'     => admin_url('utilities/activity_log'),
            'position' => 25,
            'badge'    => [],
        ]);

        $CI->app_menu->add_sidebar_children_item('utilities', [
            'slug'     => 'ticket-pipe-log',
            'name'     => _l('ticket_pipe_log'),
            'href'     => admin_url('utilities/pipe_log'),
            'position' => 30,
            'badge'    => [],
        ]);
    }

    if (staff_can('view-timesheets', 'reports') || staff_can('view', 'reports')) {
        $CI->app_menu->add_sidebar_menu_item('reports', [
            'collapse' => true,
            'name'     => _l('als_reports'),
            'href'     => admin_url('reports'),
            'icon'     => 'fa fa-area-chart',
            'position' => 60,
            'badge'    => [],
        ]);
    }

    if (staff_can('view-timesheets', 'reports')) {
        $CI->app_menu->add_sidebar_children_item('reports', [
            'slug'     => 'timesheets-reports',
            'name'     => _l('timesheets_overview'),
            'href'     => admin_url('staff/timesheets?view=all'),
            'position' => 25,
            'badge'    => [],
        ]);
    }

    if (has_permission('reports', '', 'view')) {

        $CI->app_menu->add_sidebar_children_item('reports', [
            'slug'     => 'sales-reports',
            'name'     => _l('als_reports_sales_submenu'),
            'href'     => admin_url('reports/sales'),
            'position' => 5,
            'badge'    => [],
        ]);

        $CI->app_menu->add_sidebar_children_item('reports', [
            'slug'     => 'expenses-reports',
            'name'     => _l('als_reports_expenses'),
            'href'     => admin_url('reports/expenses'),
            'position' => 10,
            'badge'    => [],
        ]);

        $CI->app_menu->add_sidebar_children_item('reports', [
            'slug'     => 'expenses-vs-income-reports',
            'name'     => _l('als_expenses_vs_income'),
            'href'     => admin_url('reports/expenses_vs_income'),
            'position' => 15,
            'badge'    => [],
        ]);

        $CI->app_menu->add_sidebar_children_item('reports', [
            'slug'     => 'knowledge-base-reports',
            'name'     => _l('als_kb_articles_submenu'),
            'href'     => admin_url('reports/knowledge_base_articles'),
            'position' => 30,
            'badge'    => [],
        ]);
    }

    // Setup menu
    if (has_permission('staff', '', 'view')) {
        $CI->app_menu->add_setup_menu_item('staff', [
            'name'     => _l('als_staff'),
            'href'     => admin_url('staff'),
            'position' => 5,
            'badge'    => [],
        ]);
    }


    if (is_admin()) {

        $CI->app_menu->add_setup_menu_item('customers', [
            'collapse' => true,
            'name'     => _l('clients'),
            'position' => 10,
            'badge'    => [],
        ]);

        $CI->app_menu->add_setup_children_item('customers', [
            'slug'     => 'customer-groups',
            'name'     => _l('customer_groups'),
            'href'     => admin_url('clients/groups'),
            'position' => 5,
            'badge'    => [],
        ]);

        $CI->app_menu->add_setup_menu_item('support', [
            'collapse' => true,
            'name'     => _l('support'),
            'position' => 15,
            'badge'    => [],
        ]);

        $CI->app_menu->add_setup_children_item('support', [
            'slug'     => 'departments',
            'name'     => _l('acs_departments'),
            'href'     => admin_url('departments'),
            'position' => 5,
            'badge'    => [],
        ]);
        $CI->app_menu->add_setup_children_item('support', [
            'slug'     => 'tickets-predefined-replies',
            'name'     => _l('acs_ticket_predefined_replies_submenu'),
            'href'     => admin_url('tickets/predefined_replies'),
            'position' => 10,
            'badge'    => [],
        ]);
        $CI->app_menu->add_setup_children_item('support', [
            'slug'     => 'tickets-priorities',
            'name'     => _l('acs_ticket_priority_submenu'),
            'href'     => admin_url('tickets/priorities'),
            'position' => 15,
            'badge'    => [],
        ]);
        $CI->app_menu->add_setup_children_item('support', [
            'slug'     => 'tickets-statuses',
            'name'     => _l('acs_ticket_statuses_submenu'),
            'href'     => admin_url('tickets/statuses'),
            'position' => 20,
            'badge'    => [],
        ]);

        $CI->app_menu->add_setup_children_item('support', [
            'slug'     => 'tickets-services',
            'name'     => _l('acs_ticket_services_submenu'),
            'href'     => admin_url('tickets/services'),
            'position' => 25,
            'badge'    => [],
        ]);
        $CI->app_menu->add_setup_children_item('support', [
            'slug'     => 'tickets-spam-filters',
            'name'     => _l('spam_filters'),
            'href'     => admin_url('spam_filters/view/tickets'),
            'position' => 30,
            'badge'    => [],
        ]);

        $CI->app_menu->add_setup_menu_item('leads', [
            'collapse' => true,
            'name'     => _l('acs_leads'),
            'position' => 20,
            'badge'    => [],
        ]);
        
        $CI->app_menu->add_setup_children_item('leads', [
            'slug'     => 'leads-sources',
            'name'     => _l('acs_leads_sources_submenu'),
            'href'     => admin_url('leads/sources'),
            'position' => 5,
            'badge'    => [],
        ]);
        $CI->app_menu->add_setup_children_item('leads', [
            'slug'     => 'leads-statuses',
            'name'     => _l('acs_leads_statuses_submenu'),
            'href'     => admin_url('leads/statuses'),
            'position' => 10,
            'badge'    => [],
        ]);
        $CI->app_menu->add_setup_children_item('leads', [
            'slug'     => 'leads-email-integration',
            'name'     => _l('leads_email_integration'),
            'href'     => admin_url('leads/email_integration'),
            'position' => 15,
            'badge'    => [],
        ]);


            $CI->app_menu->add_setup_children_item('leads', [
            'slug'     => 'web-to-lead',
            'name'     => _l('web_to_lead'),
            'href'     => admin_url('leads/forms'),
            'position' => 20,
            'badge'    => [],
        ]);

        $CI->app_menu->add_setup_menu_item('finance', [
            'collapse' => true,
            'name'     => _l('acs_finance'),
            'position' => 25,
            'badge'    => [],
        ]);
        $CI->app_menu->add_setup_children_item('finance', [
            'slug'     => 'taxes',
            'name'     => _l('acs_sales_taxes_submenu'),
            'href'     => admin_url('taxes'),
            'position' => 5,
            'badge'    => [],
        ]);
        $CI->app_menu->add_setup_children_item('finance', [
            'slug'     => 'currencies',
            'name'     => _l('acs_sales_currencies_submenu'),
            'href'     => admin_url('currencies'),
            'position' => 10,
            'badge'    => [],
        ]);
        $CI->app_menu->add_setup_children_item('finance', [
            'slug'     => 'payment-modes',
            'name'     => _l('acs_sales_payment_modes_submenu'),
            'href'     => admin_url('paymentmodes'),
            'position' => 15,
            'badge'    => [],
        ]);
        $CI->app_menu->add_setup_children_item('finance', [
            'slug'     => 'expenses-categories',
            'name'     => _l('acs_expense_categories'),
            'href'     => admin_url('expenses/categories'),
            'position' => 20,
            'badge'    => [],
        ]);

        $CI->app_menu->add_setup_menu_item('contracts', [
            'collapse' => true,
            'name'     => _l('acs_contracts'),
            'position' => 30,
            'badge'    => [],
        ]);
        $CI->app_menu->add_setup_children_item('contracts', [
            'slug'     => 'contracts-types',
            'name'     => _l('acs_contract_types'),
            'href'     => admin_url('contracts/types'),
            'position' => 5,
            'badge'    => [],
        ]);

        $modules_name = _l('modules');

        if ($modulesNeedsUpgrade = $CI->app_modules->number_of_modules_that_require_database_upgrade()) {
            $modules_name .= '<span class="badge menu-badge bg-warning">' . $modulesNeedsUpgrade . '</span>';
        }

        $CI->app_menu->add_setup_menu_item('modules', [
            'href'     => admin_url('modules'),
            'name'     => $modules_name,
            'position' => 35,
            'badge'    => [],
        ]);

        $CI->app_menu->add_setup_menu_item('custom-fields', [
            'href'     => admin_url('custom_fields'),
            'name'     => _l('asc_custom_fields'),
            'position' => 45,
            'badge'    => [],
        ]);

        $CI->app_menu->add_setup_menu_item('gdpr', [
            'href'     => admin_url('gdpr'),
            'name'     => _l('gdpr_short'),
            'position' => 50,
            'badge'    => [],
        ]);

        $CI->app_menu->add_setup_menu_item('roles', [
            'href'     => admin_url('roles'),
            'name'     => _l('acs_roles'),
            'position' => 55,
            'badge'    => [],
        ]);

    }


    if (has_permission('settings', '', 'view')) {
        $CI->app_menu->add_setup_menu_item('settings', [
            'href'     => admin_url('settings'),
            'name'     => _l('acs_settings'),
            'position' => 200,
            'badge'    => [],
        ]);
    }

    if (has_permission('email_templates', '', 'view')) {
        $CI->app_menu->add_setup_menu_item('email-templates', [
            'href'     => admin_url('emails'),
            'name'     => _l('acs_email_templates'),
            'position' => 40,
            'badge'    => [],
        ]);
    }

    if (has_permission('settings', '', 'view')) {
        $CI->app_menu->add_setup_menu_item('estimate_request', [
            'collapse' => true,
            'name'     => _l('acs_estimate_request'),
            'position' => 34,
            'badge'    => [],
        ]);
    }

    $CI->app_menu->add_setup_children_item('estimate_request', [
        'slug'     => 'estimate-request-forms',
        'name'     => _l('acs_estimate_request_forms'),
        'href'     => admin_url('estimate_request/forms'),
        'position' => 5,
        'badge'    => [],
    ]);

    $CI->app_menu->add_setup_children_item('estimate_request', [
        'slug'     => 'estimate-request-statuses',
        'name'     => _l('acs_estimate_request_statuses_submenu'),
        'href'     => admin_url('estimate_request/statuses'),
        'position' => 10,
        'badge'    => [],
    ]);

     $CI->app_menu->add_sidebar_menu_item('my_reports', [
        'name'    => _l('My Reports'),
        'href'    => admin_url(''),
        'icon'    => 'fa fa-briefcase',
        'position' => 31,
        'badge'   => [],
    ]);
    $CI->app_menu->add_sidebar_children_item('my_reports', [
        'slug'    => 'Provider API',
        'name'    => 'Provider Summary',
        'href'    => admin_url('clients/provider_apis'),
        'badge'   => [],
    ]);
      $CI->app_menu->add_sidebar_children_item('my_reports', [
        'slug'    => 'Client Group API',
        'name'    => 'Client Group Summary',
        'href'    => admin_url('clients/client_group_apis'),
        'badge'   => [],
    ]);
      $CI->app_menu->add_sidebar_children_item('my_reports', [
        'slug'    => 'Client Group Type',
        'name'    => 'Type Summary',
        'href'    => admin_url('clients/client_group_types'),
        'badge'   => [],
    ]);
      $CI->app_menu->add_sidebar_children_item('my_reports', [
        'slug'    => 'Age Profile',
        'name'    => 'Age Profile',
        'href'    => admin_url('clients/age_profiles'),
        'badge'   => [],
    ]);
    $CI->app_menu->add_sidebar_children_item('my_reports', [
        'slug'     => 'leads-reports',
        'name'     => _l('als_reports_leads_submenu'),
        'href'     => admin_url('reports/leads'),
        // 'position' => 20,
        'badge'    => [],
    ]);




}