<?php

defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = ['id','send_to','subject','created_at'];

$sIndexColumn = 'id';
$sTable       = db_prefix().'custom_sms_log';
$CI = &get_instance();
$idW= $CI->uri->segment(5); 
$where = ['AND staff_id=' . $idW];
$result  = data_tables_init($aColumns, $sIndexColumn, $sTable, [], $where, ['id']);
$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $key=> $aRow) {
    $row = [];
    // $row[] = $key + 1;
    for ($i = 0 ; $i < count($aColumns) ; $i++) {
        // $_data = '<a href="#" data-toggle="modal" data-target="#add_edit_template" data-id="' . $aRow['id'] . '">' . $aRow[$aColumns[$i]] . '</a>';
        if ($aColumns[$i] == 'created_at') {
        	 $row[] = _d($aRow['created_at']);
        }else{
            $row[] = $aRow[$aColumns[$i]];
        }
    } 
    $options = icon_btn('#', 'eye', 'btn-default', ['data-toggle' => 'modal', 'data-target' => '#add_edit_template', 'data-id' => $aRow['id']]);
    $row[]   = $options .= icon_btn('custom_email_and_sms_notifications/template/sms_delete/' . $aRow['id'], 'remove', 'btn-danger confirm_delete');
    // $row[]   =  '<button class="btn btn-danger confirm_delete btn-icon">
    // <i class="fa fa-remove"></i>
    // </button>';

    $output['aaData'][] = $row;
}
