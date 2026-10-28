<?php

defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = ['id','send_to','subject','created_at','others'];

$sIndexColumn = 'id';
$sTable       = db_prefix().'custom_mail_log';
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
        }elseif($aColumns[$i]=='others'){ 
            if ($aRow[$aColumns[$i]]) {
                $row[] = '<a href="'.admin_url('custom_email_and_sms_notifications/template/push_file/'.$aRow['id']).'" data-id="' . $aRow['id'] . '"><i class="fa fa-download"></i></a>';
            }else{
                $row[] ='-';
            }
        	
        }else{
            $row[] = $aRow[$aColumns[$i]];
        }
    } 
    $options = icon_btn('#', 'eye', 'btn-default', ['data-toggle' => 'modal', 'data-target' => '#add_edit_template', 'data-id' => $aRow['id']]);
    $row[]   = $options .= icon_btn('custom_email_and_sms_notifications/template/mail_delete/' . $aRow['id'], 'remove', 'btn-danger confirm_delete');
    // $row[]   =  '<button class="btn btn-danger confirm_delete btn-icon">
    // <i class="fa fa-remove"></i>
    // </button>';

    $output['aaData'][] = $row;
}
