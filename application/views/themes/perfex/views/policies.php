<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="panel_s section-heading section-proposals">
  <div class="panel-body">
    <h4 class="no-margin section-text"> Policies </h4>
  </div>
</div>
<div class="panel_s">
  <div class="panel-body">
  <table class="table mt-5" id="choose_contact_table">
            <thead class="thead-dark">
                <tr  class="d-flex justify-content-around">
                <th scope="col">Sr.n</th>
                <th scope="col">Policy</th>
                <th scope="col">Adviser</th>
                <th scope="col">Client Name</th>
                <th scope="col">Provider</th>
                <th scope="col">Life Assured</th>
                <th scope="col">Policy Owner</th>
                <th scope="col">Premium</th>
                <th scope="col">Policy Status</th>
                <th scope="col">Policy Review Date</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                  $i = 1; 
                  foreach($policydata as $row){
                ?>
                <tr>
                <th scope="row"><?php echo $i ?></th>
                <td><?php echo $row['policy_number']?></td>
                <td><?php  if($row['adviser']==''){echo '-';} echo $row['adviser']?></td>
                <td><?php echo $row['customer']?></td>
                <td><?php echo $row['provider']?></td>
                <td><?php echo $row['life_assured']?></td>
                <td><?php echo $row['policy_owner']?></td>
                <td><?php echo $row['premium_frequency']?></td>
                <td><?php echo $row['policy_status']?></td>
                <td><?php echo $row['renewal_date']?></td>
                <td class="d-flex justify-content-around">
                <a class="btn btn-info btn-md" href="<?php echo site_url('clients/policy/'.$row['id']) ?>"><i class="iconFontSize fa fa-eye" title="view"></i></a>                </td>
                </tr>
                <?php $i++; }  ?>
            </tbody>
        </table>
   </div>
   <?php $this->load->view('admin/clients/choose_contacts_list_js'); ?>
 </div>