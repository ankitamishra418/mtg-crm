<?php

defined('BASEPATH') or exit('No direct script access allowed');

$base_currency = get_base_currency();

$aColumns = [
    'filename',
    'category_id',
    'subcategory_id',
    'addfrom',
    'file',
    'file_description',
    'groupid',
    'review_date',
    'review_by',
    'datecreated',
    ];

$sIndexColumn = 'id ';
$sTable       = db_prefix() . 'filemanager';

$join = [];

$where  = [];
$filter = [];
//load deparment by manager
// if(!is_admin() && !has_permission('staffmanage_job_position','','view')){
 
//       //View own
//   $array_department = $this->ci->hr_profile_model->get_department_by_manager();
//   if (count($array_department) > 0) {
//     $department_m_where = '';
//     foreach ($array_department as $department_id_m) {
//       if ($department_id_m != '') {

//         if ($department_m_where == '') {
//           $department_m_where .= ' AND (find_in_set('.$department_id_m.', '.db_prefix().'hr_job_position.department_id) ';

//         } else {
//           $department_m_where .= ' OR find_in_set('.$department_id_m.', '.db_prefix().'hr_job_position.department_id) ';
//         }
//       }
//     }

//     if ($department_m_where != '') {
//       $department_m_where .= ')';

//       $where[] = $department_m_where;
//     }

//   }else{
//     $where[] = 'AND 1=2';
//   }
// }

$category = $this->ci->input->post('category');
$subcategory = $this->ci->input->post('subcategory');

// print_r($category);
// exit;
if(isset($category)){

    $category_where = '';
        if ($category != '') {

            if ($category_where == '') {
                $category_where .= ' AND (find_in_set('.$category.', '.db_prefix().'filemanager.category) ';

            } else {
                $category_where .= ' OR find_in_set('.$category.', '.db_prefix().'filemanager.category) ';
            }

        }
  

    if ($category_where != '') {
        $category_where .= ')';

        $where[] = $category_where;
    }

}

// if(isset($subcategory)){
//     $subcategory_where = '';
//         if ($subcategory != '') {

//             if ($subcategory_where == '') {
//                 $subcategory_where .= ' AND (( '.db_prefix().'filemanager.subcategory) = '.$subcategory;

//             } else {
//                 $subcategory_where .= ' OR ('.db_prefix().'filemanager.subcategory = '.$subcategory.') ';
//             }

//         }

//     if ($subcategory_where != '') {
//         $subcategory_where .= ')';

//         $where[] = $subcategory_where;
//     }


// }



$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, ['id', 'category_id']);

$output  = $result['output'];
$rResult = $result['rResult'];


// if(is_admin(get_staff_user_id())){
//     $file = $this->ci->file_model->get_filedata();
// }else{
//     $file = $this->ci->file_model->get_filedata();
// }

//$file = $this->ci->file_model->get_filedata();
// print_r($file);
// exit;
// echo'<pre>';
// print_r($file);
// exit;


//$rResult = $file;
foreach ($rResult as $aRow) {
    
    //For permission to show the file to users
    $groupId = $aRow['groupid'];
    $where_in_GroupId = explode(',',$groupId);
   
   
    $jobPositions = $this->ci->db->where_in('job_p_id',$where_in_GroupId)->get('tblhr_job_position')->result_array();
    
    
    $jobPositionId = [];
    foreach($jobPositions as $key => $value){
      $jobPositionId[] = $value['position_id'];
    }
  
    
     $where_in_jobPositionId = $jobPositionId;
     
     $totalStaffToDisplay = $this->ci->db->where_in('job_position',$where_in_jobPositionId)->get('tblstaff')->result_array();
    
    $sId = [];
    foreach($totalStaffToDisplay as $staffId){
        $sId[] = $staffId['staffid'];
    }
    $staffarray = array_unique($sId);
                              
    if(is_admin() || in_array(get_staff_user_id(),$staffarray) || get_staff_user_id() ==$aRow['addfrom']  ){
    
    $row = [];

    $row[] = '<div class="checkbox"><input type="checkbox" value="' . $aRow['id'] . '"><label></label></div>';
    //$row[] = $aRow['id'];
    
    $auditsflow = $this->ci->db->select('*')->where('file',$aRow['id'])->get('tblfile_auditflow')->result_array();
     $flow = '';
     $flow .= '<div class="popDawn"><ul>';
     	foreach($auditsflow as $key =>$value){
 		  $staffname = $this->ci->db->select('firstname,lastname')->where('staffid',$value['staff'])->get('tblstaff')->result_array();
 		    foreach($staffname as $staffkey=>$staffvalue){
 		        $flow .='<li>'.$staffvalue['firstname'].' '.$staffvalue['lastname'].'</li>';
 		    }
  		}
    $flow .='</ul></div>';
 	
     $subjectOutput ='';

      if (has_permission('file_manager', '', 'view') || is_admin()){ 

          $subjectOutput .= '<a class="nameT" href="'.admin_url('file_manager/view_file/'.$aRow['id']).'">'. $aRow['filename'].' '.$flow.'</a>';
      }


     $subjectOutput .= '<div class="row-options">';

     if (has_permission('file_manager', '', 'view') || has_permission('staffmanage_job_position', '', 'view_own' ) || is_admin()){
          $subjectOutput .=' <a href="'.admin_url('file_manager/view_file/'.$aRow['id']).'" data-document_file="'. $aRow['file'].'"  data-toggle="sidebar-right" >'._l('View').'</a>';
     }

     if (has_permission('file_manager', '', 'create') || is_admin()){
          $subjectOutput .=' | <a href="#" onclick="edit_file(this,'.$aRow['id'].'); return false" data-name="'. $aRow['filename'].'" data-category_id="'. $aRow['category_id'].'" data-subcategory_id="'. $aRow['subcategory_id'].'" data-review_date="'. $aRow['review_date'].'" data-file_description="'. $aRow['file_description'].'" data-document_file="'. $aRow['file'].'" data-groupid="'. $aRow['groupid'].'"  data-toggle="sidebar-right" >'._l('hr_edit').'</a>';
     }

     if (has_permission('file_manager', '', 'delete') || is_admin()){
         $subjectOutput .=' | <a href="'.admin_url('file_manager/delete_file/'.$aRow['id']).'" class="text-danger _delete" >'. _l('delete').'</a>';
     }

    $subjectOutput .= '</div>';
    $row[] = $subjectOutput;

    //$row[] = $aRow['filename'];

    if($aRow['category_id']){
        $cat_name = $this->ci->file_model->get_categoryname_by_id($aRow['category_id']);
    }else{
        $cat_name = '';
    }
    
    $row[] = $cat_name;

    if($aRow['category_id']){
        $subcat_name = $this->ci->file_model->get_subcategoryname_by_id($aRow['subcategory_id']);
    }else{
        $subcat_name = '';
    }
    
    $row[] = $subcat_name;

    /*get frist 100 character */
    //  if(strlen($aRow['job_position_description']) > 200){
    //     $pos=strpos($aRow['job_position_description'], ' ', 200);
    //     $description_sub = substr($aRow['job_position_description'],0,$pos ); 
    //   }else{
    //     $description_sub = $aRow['job_position_description'];
    //   }

    $description_sub =  $aRow['file_description'];
    $row[] = $description_sub;

    $row[] = $aRow['review_date'];

	// get department
    // if($aRow['department_id'] != null && $aRow['department_id'] != ''){
    //           $members       = explode(',', $aRow['department_id']);
    //           $str = '';
    //           $j = 0;
    //           foreach ($members as $key => $member_id) {
    //             $member   = $this->ci->hr_profile_model->hr_profile_get_department_name($member_id);

    //             $j++;
    //             $str .= '<span class="label label-tag tag-id-1"><span class="tag">'.$member->name.'</span><span class="hide">, </span></span>&nbsp';

    //             if($j%2 == 0){
    //              $str .= '<br><br/>';
    //            }

    //          }
    //          $_data = $str;
    //        }
    //        else{
    //         $_data = '';
    //       }

    //$row[] = $_data;

    //get parent name
    // $job_p = $this->ci->hr_profile_model->get_job_p($aRow['job_p_id']) ; 
    // $row[] = isset($job_p) ? $job_p->job_name :'';

    $output['aaData'][] = $row;
    }
}

?>
