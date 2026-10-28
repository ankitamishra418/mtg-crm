<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
function getRecord($table='',$where=array())
{
	$CI = $CI = & get_instance();
	if (!empty($where)) {
		$CI->db->where($where);
	}
	return $CI->db->get($table)->row();
}
 

function convert_seconds($seconds) 
{
	$dt1 = new DateTime("@0");
	$dt2 = new DateTime("@$seconds");
	if ($seconds <= 60) {
		return $seconds.' sec';
	}if ($seconds > 60 && $seconds <= 3600) {
		return $dt1->diff($dt2)->format('%i min %s sec');
	}
	return $dt1->diff($dt2)->format('%h hours, %i min %s sec');
}

function availableBalance($id='')
{
	$CI = $CI = & get_instance();
	if (!empty($where)) {
		$CI->db->where($where);
	}
	$query = $CI->db->select('wallet_total')->from('tblstaff')->get()->row();
	return $query->wallet_total;
}
 