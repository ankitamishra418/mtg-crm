<?php



defined('BASEPATH') or exit('No direct script access allowed');



$aColumns = [

    'id',

    db_prefix() .'automation_rule.name as name',

    db_prefix() .'tickets_status.name as status',

    'statuscolor',

    'start_date',

    'end_date',
    'module_name',
    'duration',
    'duration_type',

    'description',
    'created_at',

];



$sIndexColumn = 'id';

$sTable       = db_prefix() . 'automation_rule';



$join = ['LEFT JOIN ' . db_prefix() . 'tickets_status ON ' . db_prefix() . 'tickets_status.ticketstatusid = ' . db_prefix() . 'automation_rule.status_id',];

 



$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, [], ['id']);



$output  = $result['output'];

$rResult = $result['rResult'];



foreach ($rResult as $key => $aRow) {

    $row = [];

    $_data = '<a href="' . admin_url('automation/rule/add/' . $aRow['id']) . '">' . $aRow['name'] . '</a>';

    $_data .= '<div class="row-options">';

    $_data .= '<a href="' . admin_url('automation/rule/add/' . $aRow['id']) . '">' . _l('view') . '</a>';



    if (has_permission('automation', '', 'delete')) {

        $_data .= ' | <a href="' . admin_url('automation/rule/delete/' . $aRow['id']) . '" class="text-danger _delete">' . _l('delete') . '</a>';

    }


    $_data .= '</div>';

    $row[]=  $key + 1;

    $row[]=  $_data; 

    $row[]=  $aRow['description'] ?? '-';
    $row[]=  strtoupper($aRow['module_name']);
    $dtype='Days';
    if ($aRow['duration_type']=='1') {
        $dtype='Hourly';
    } 
    $row[]=  $dtype;
    $row[]=  $aRow['duration'];
    // $row[]= _d($aRow['start_date']); 

    

    $_data = '<span class="label inline-block ticket-status-' . $aRow['status'] . '" style="border:1px solid ' . $aRow['statuscolor'] . '; color:' . $aRow['statuscolor'] . '">' . $aRow['status']. '</span>';

    $row[]=  $_data; 
    $row[]= _d($aRow['created_at']); 
    // $_data = ticket_priority_translate($aRow['priority_id']);

    $row[]=  $_data; 

    $output['aaData'][] = $row;

}

