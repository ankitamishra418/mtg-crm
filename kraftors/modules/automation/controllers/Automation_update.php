<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Automation_update extends CI_Controller
{
     public function support_automate($value='')
    { 
        $ruleSet = $this->getRule('support');  
        if (!empty($ruleSet)) {
            foreach ($ruleSet as $key => $rule) {
                // $date1 = date_create('2019-12-12 09:00:00');
                // $crDate= date('Y-m-d');
                // $date2 = date_create($crDate); 
                // $diff  = date_diff($date1,$date2); 
                // $hours = $hours + ($diff->days*24);
                $whereSet=$setData=''; 
                if (!empty($rule->from_department_id) && !empty($rule->to_department_id)) { 
                    $whereSet .= 'department='.$rule->from_department_id.' AND ';
                    $setData  .= 'department='.$rule->to_department_id.',';
                }if (!empty($rule->status_id) && !empty($rule->to_status_id)) {
                    $whereSet .= 'status='.$rule->status_id.' AND ';
                    $setData  .= 'status='.$rule->to_status_id.',';
                }if (!empty($rule->priority_id) && !empty($rule->to_priority_id)) {
                    $whereSet .= 'priority='.$rule->priority_id.' AND ';
                    $setData  .= 'priority='.$rule->to_priority_id.',';
                }
                if (!empty($whereSet) && !empty($setData)) { 
                    if (!empty($rule->duration) && $rule->duration_type=='1') {
                        $otherCond = ' AND created_at = DATE_SUB(NOW(),INTERVAL '.$rule->duration.' HOUR)';
                    }if (!empty($rule->duration) && $rule->duration_type=='2') {
                        $otherCond = ' AND created_at > DATE_SUB(CURDATE(), INTERVAL '.$rule->duration.' DAY)';
                    }
                    $whereSet = substr_replace($whereSet, '', -4);
                    $setData  = substr_replace($setData, '', -1);
                    $query    ="UPDATE tbltickets SET $setData WHERE $whereSet".$otherCond;
                    $result   = $this->db->query($query); 
                    log_activity('Ticket/Support updated');
                }
                 
            } 
            if ($result) { 
                // echo $this->db->last_query();
                return true;
            }else{ 
                return false;
            }
        }
    }
    public function lead_automate($value='')
    {
        $ruleSet = $this->getRule('lead');
        if (!empty($ruleSet)) {
            foreach ($ruleSet as $key => $rule) {
                $whereSet=$setData=''; 
                if (!empty($rule->from_lead_source_id) && !empty($rule->to_lead_source_id)) {  
                    $whereSet .= 'source='.$rule->from_lead_source_id.' AND ';
                    $setData  .= 'source='.$rule->to_lead_source_id.',';
                }if (!empty($rule->from_lead_status_id) && !empty($rule->to_lead_status_id)) {
                    $whereSet .= 'status='.$rule->from_lead_status_id.' AND ';
                    $setData  .= 'status='.$rule->to_lead_status_id.',';
                } 
                if (!empty($whereSet) && !empty($setData)) { 
                    if (!empty($rule->duration) && $rule->duration_type=='1') {
                        $otherCond = ' AND created_at = DATE_SUB(NOW(),INTERVAL '.$rule->duration.' HOUR)';
                    }if (!empty($rule->duration) && $rule->duration_type=='2') {
                        $otherCond = ' AND created_at > DATE_SUB(CURDATE(), INTERVAL '.$rule->duration.' DAY)';
                    }
                    $whereSet = substr_replace($whereSet, '', -4);
                    $setData  = substr_replace($setData, '', -1);
                    $query    ="UPDATE tblleads SET $setData WHERE $whereSet".$otherCond;
                    $result   = $this->db->query($query); 
                    log_activity('Lead updated');
                } 
            }
            if ($result) { 
                return true;
            }else{ 
                return false;
            }
        }
    } 
    private function getRule($module='')
    {
        return $this->db->where('module_name',$module)->get('tblautomation_rule')->result();
    }
}
