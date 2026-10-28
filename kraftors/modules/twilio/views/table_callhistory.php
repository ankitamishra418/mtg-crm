<?php

defined('BASEPATH') or exit('No direct script access allowed');
 

$aColumns = [
    'id',  
    'date_created', 
    'duration', 
    'call_to', 
    'call_from', 
    'recording', 
    'recording_sid', 
    'call_date', 
    db_prefix().'staff.firstname as firstname', 
    db_prefix().'staff.lastname as lastname', 
    // db_prefix().'twilio_number.id as nid', 
    // db_prefix().'twilio_number.sid as tn_sid', 
];

$sIndexColumn = 'id';
$sTable       = db_prefix() . 'twilio_call_log';

$where  = [];
$filter = []; 

// if ($this->ci->input->post('fdate')) {
//     $date = $this->ci->input->post('fdate');
//     // echo $date;die;
//     array_push($where, "and call_date='".$date."'");
// } 

if($this->ci->input->post('fdate')){ 
    $where_fdate = ''; 
    $date      = $this->ci->input->post('fdate');  
    if($where_fdate == ''){ 
        $where_fdate .= "( call_date = '".$date."'"; 
    }else{ 
        $where_fdate .= "call_date = '".$date."'"; 
    } 
    if($where_fdate != '')
    {
        $where_fdate .= ' )';
        if($where_fdate != ''){
            array_push($where, 'AND '. $where_fdate);
            }else{
            array_push($where, $where_fdate);
        }
    }
}
if($this->ci->input->post('staff')){ 
    $where_fdate = ''; 
    $staffD = $this->ci->db->where('staffid',$this->ci->input->post('staff'))->get(db_prefix().'staff')->row();
    $fN= $staffD->assign_number; 
    if($where_fdate == ''){ 
        $where_fdate .= "( call_from = '".$fN."'"; 
    }else{ 
        $where_fdate .= "call_from = '".$fN."'"; 
    } 
    if($where_fdate != '')
    {
        $where_fdate .= ' )';
        if($where_fdate != ''){
            array_push($where, 'AND '. $where_fdate);
            }else{
            array_push($where, $where_fdate);
        }
    }
}
 
$join=['LEFT JOIN '.db_prefix().'staff ON '.db_prefix().'staff.assign_number = '.db_prefix().'twilio_call_log.call_from'];
  // array_push($join, 'LEFT JOIN '.db_prefix().'customfieldsvalues as ctable_' . $i . ' ON '.db_prefix().'staff.staffid = ctable_' . $i . '.relid AND ctable_' . $i . '.fieldto="' . $field['fieldto'] . '" AND ctable_' . $i . '.fieldid=' . $field['id']);
// $aColumns = hooks()->apply_filters('proposals_table_sql_columns', $aColumns);

 
$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, ['call_from','call_to']);
// echo $this->ci->db->last_query();die;
$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];  
    $row[] =  $aRow['id'];
    $row[] =  $aRow['call_from'] ;
    $row[] =  convert_seconds($aRow['duration']);
    $row[] = _d($aRow['date_created']);
    $row[] =  $aRow['call_to'] ; 
    $row[] =  $aRow['firstname'] ?? $aRow['call_from'];
    $recording ='-';
    if (!empty($aRow['recording'])) {
        $recording .='<button class="btn btn-info btn-sm" id="recording_play_'.$aRow['id'].'" onclick=playRecording("'.$aRow['recording_sid'].'","'.$aRow['id'].'")><i class="fa fa-play"></i> Recording</button><span><a href="javascript:void(0)" onclick=getRecording("'.$aRow['recording_sid'].'")><i class="fa fa-download download-btn-icon"></i></a></span>';
    }
    $row[] = $recording;
     
    // $row['DT_RowClass'] = 'has-row-options';

    // $row = hooks()->apply_filters('proposals_table_row_data', $row, $aRow);

    $output['aaData'][] = $row;
}
