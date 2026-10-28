<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php if(has_permission('policy','','create')){ ?>
<a href="<?php echo admin_url('Policy/addPolicy'.'/'.$client->userid)?>" class="btn btn-info mbot25<?php if($client->active == 0){echo ' disabled';} ?>">Add Policy</a>
<?php } ?>
<a href="<?php echo admin_url('Policy/schedulePdf'.'/'.$client->userid) ?> " target="_blank" class="btn btn-info mbot25">Schedule</a>
<a href="<?php echo admin_url('Policy/formatted_policyschedule'.'/'.$client->userid) ?> " target="_blank" class="btn btn-info mbot25">Formatted Schedule</a>

<?php if(isset($client)){
  $data = get_policyDAta($client->userid);
 ?>
<h4 class="customer-profile-group-heading">Policy</h4>
<div class="clearfix"></div>
<div class="mtop15">
    <table class="table dt-table" data-order-col="2" data-order-type="desc" >
        <thead>
            <tr>
            <tr>
                <th scope="col">Sr.n</th>
                <th scope="col">Policy</th>
                <th scope="col">Adviser</th>
                <th scope="col">Client Name</th>
                <th scope="col">Provider</th>
                <th scope="col">Life Assured</th>
                <th scope="col">Policy Owner</th>
                <th scope="col">IRD No</th>
                <th scope="col">PIR</th>
                <th scope="col">Annual Premium</th>
                <th scope="col">Policy Status</th>
                <th scope="col">Policy Start Date</th>
                <th scope="col">Action</th>
                </tr>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;  foreach($data as $row){ 
             
              ?>
            <tr>
            <th scope="row"><?php echo $i ?></th>
                <td><?php echo $row['policy_number']?></td>
                <td><?php  if($row['adviser']==''){echo '-';} echo $row['adviser']?></td>
                <td><?php echo $row['customer']?></td>
                <td><?php echo $row['provider']?></td>
                <td><?php echo $row['life_assured']?></td>
                <td><?php  echo $row['policy_owner']?></td>
                <td><?php  echo $row['ird_number']?></td>
                <td><?php  echo $row['pir']?></td>
                <td><?php $dataRowValue = $row['total_premium'];
                  $dollerData = mb_substr($dataRowValue, 0, 1);
                  if($dollerData == '$'){
                  echo $row['total_premium'];
                  }else{
                  echo '$'.number_format($row['total_premium'] ,2).'';
                  }

                  ?>
                  </td>

                <td><?php  echo $row['policy_status']?></td>
                <td><?php if($row['start_date']==00-00-0000 && $row['start_date']==Null){ echo '-';} else{ echo $startdate =date("d-m-Y", strtotime($row['start_date']));} ?> </td>
                <td class="d-flex justify-content-between">
                <a class="btn btn-info btn-md" href="<?php echo base_url('admin/policy/Policies/'.$row['id'].'/'.$client->userid) ?>" title="view"><i class="iconFontSize fa fa-eye" ></i></a>
               <?php if(is_admin()){ ?>
                <a class="btn btn-danger btn-md" href="<?php echo base_url('admin/policy/deletePolicyData/'.$row['id'].'/'.$client->userid)?>" style="margin-left: 12px;" title="delete"><i class="iconFontSize fa fa-trash-o" onclick="return myConfirm();" ></i></a>
                <?php } ?>
                </td>
                </tr>
                <?php $i++; }  ?>
</tbody>
</table>
</div>
<script>
function myConfirm() {
  var result = confirm("Want to delete?");
  if (result==true) {
   return true;
  } else {
   return false;
  }
}
</script>
<?php } ?>

