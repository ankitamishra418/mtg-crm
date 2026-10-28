<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<link rel="stylesheet" href="<?php echo site_url('assets/css/customcss.css');?>">

<div id="wrapper">
  <div class="content">
    <div class="row mt-5">
      <div class="col-md-12">
        <div class="panel_s">
          <div class="panel-body">


            <div class="row">
              <div class="col-md-3 col-3 text-center">
                <?php // if(is_admin()){ ?>
                <a class="btn btn-info" href=<?php echo base_url('admin/Policy/importPolicy'); ?>>Import Policy</a></br><br>
                <?php// } ?>
              </div>

              <div class="inline-block col-md-6 col-6 text-center">
                <form method="post" action="<?php echo base_url();?>admin/Policy/showPolicyData" class="filterform">
                  <!-- for first name and last name -->
                  <div class="col-md-3">
                    <select class="selectpicker form-control form-control-lg" data-live-search="true" id="policyNumberSearch" name="policyNumberSearch">
                      <option value="" >Policy No.</option>
                      <?php foreach($policyNumberData as $policyNum)
                      {?>
                        <option value="<?php echo $policyNum;?>"
                          <?php if($policyNum == $this->session->userdata('policyNumberSearch'))
                          {
                          ?>
                            selected
                          <?php
                          }?>>
                          <?php echo $policyNum;?>
                        </option>
                      <?php
                      } ?>
                    </select>
                  </div>

                  <!--div class="col-md-4">
                    <select class="selectpicker form-control form-control-lg" data-live-search="true" id="advisersearch" name="advisersearch">
                      <option value="">Adviser</option>
                      <?php /*foreach($policyAdviserName as $policyAdviserNm)
                      { ?>
                        <option value="<?php echo $policyAdviserNm['id'];?>"
                          <?php if($policyAdviserNm['id'] == $this->session->userdata('advisersearch'))
                          {?>
                            selected
                            <?php
                          }?>>
                          <?php echo $policyAdviserNm['name'];?>
                        </option>
                      <?php
                      }*/ ?>
                    </select>
                  </div-->

                <div class="col-md-3">
                  <select class=" selectpicker form-control form-control-lg" title="First Name" data-live-search="true" id="firstNamePolicy" name="firstNamePolicy">
                    <option value="">First Name</option>
                    <?php foreach($firstname as $firstdata)
                    {?>
                      <option value="<?php echo $firstdata;?>"
                        <?php if($firstdata == $this->session->userdata('firstNamePolicy'))
                        {
                          ?>
                          selected 
                          <?php 
                        }?>>
                        <?php echo $firstdata;?>
                      </option>
                      <?php 
                    }  ?>
                  </select>
                </div>
                <div class="col-md-3">
                  <select class="selectpicker form-control form-control-lg" title="Last Name" data-live-search="true" id="lastNamePolicy" name="lastNamePolicy">
                    <option value="">Last Name</option>
                    <?php foreach($lastname as $lastData)
                    {?>
                      <option value="<?php echo $lastData;?>"
                        <?php if($lastData == $this->session->userdata('lastNamePolicy'))
                        {?>
                          selected
                        <?php
                        }?>>
                        <?php echo $lastData;?>
                      </option>
                    <?php
                    }?>
                  </select>
                </div>

                  <div class="col-md-3">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>"value="<?php echo $this->security->get_csrf_hash();?>">
                    <button type="submit" class="btn btn-primary" >Search</button>
                  </div>
                </form>
                <!-- end -->
              </div>
              <div class="col-md-3 col-sm-3 text-center" >
                <a class="btn btn-info" style="float: right;" href=<?php echo base_url('admin/Policy/PlogActivity'); ?>>Export policy log</a></br><br>
              </div>
            </div>


            <div class="table-responsive">
              <table class="table mt-5 " id="choose_contact_table"> 
                <thead class="thead-dark">
                  <tr>
                  <th scope="col">Sr.n</th>
                  <th scope="col">Policy</th>
                  <th scope="col">Adviser</th>
                  <th scope="col">Client Group</th>
                  <th scope="col">Provider</th>
                  <th scope="col">Life Assured</th>
                  <th scope="col">Policy Owner</th>
                  <th scope="col">Annual Premium</th>
                  <th scope="col">Policy Status</th>
                  <th scope="col">Policy Start Date</th>
                  <th scope="col">Action</th>
                  </tr>
                </thead> 
                <tbody>
                  <?php 
                    $i = 1; 
                    foreach($data as $row){
                  ?>
                  <tr>
                  <th scope="row"><?php echo $i ?></th>
                  <td><?php echo $row['policy_number']?></td>
                  <td><?php  if($row['adviser']==''){echo '-';} echo $row['adviser']?></td>
                  <td><a href="<?php echo base_url().'admin/clients/client/'.$row['customer_id'] ?>" target="_blank"><?php echo $row['customer'] ?></a></td>
                  <td><?php echo $row['provider']?></td>
                  <td><?php echo $row['life_assured']?></td>
                  <td><?php echo $row['policy_owner']?></td>
                  <!-- <td><?php //echo '$'.number_format($row['total_premium'] ,2).'';?></td> -->
                  <!-- <td><?php// $dataRowValue = $row['total_premium'];
                    // $dollerData = mb_substr($dataRowValue, 0, 1);
                    // if($dollerData == '$'){
                    // echo $row['total_premium'];
                    // }else{
                    // echo '$'.number_format($row['total_premium'] ,2).'';
                    // }

                    ?>
                    </td> -->

                    <td><?php $dataRowValue = $row['total_premium'];
                  $dollerData = mb_substr($dataRowValue, 0, 1);
                  if($dollerData == '$'){
                    //  $row['total_premium'];
                    echo ($row['total_premium']);
                  }else{
                    echo '$'.number_format($row['total_premium'] ,2).'';
                  }
                  ?></td>
                  <td><?php echo $row['policy_status']?></td>
                  <td><?php if($row['start_date']==00-00-0000 && $row['start_date']==Null){ echo '-';} else{ echo $startdate =date("d-m-Y", strtotime($row['start_date']));} ?> </td>
                
                  <!-- <td><?php //echo $row['renewal_date']?></td> -->
                  <td class="d-flex justify-content-around">
                  <a class="btn btn-info btn-md" href="<?php echo base_url('admin/policy/Policies/'.$row['id']) ?>"><i class="iconFontSize fa fa-eye" title="view"></i></a>
                  <?php if(has_permission('policy','','delete')) {?>
                  <a class="btn btn-danger btn-md" onclick="return myConfirm();" href="<?php echo base_url('admin/policy/deletePolicyData/'.$row['id'])?>" ><i class="iconFontSize fa fa-trash-o" title="Delete"></i></a>
                  <?php }?>
                  </td>
                  </tr>
                  <?php $i++; }  ?>
                </tbody>
              </table> 
            </div>
</div>
<?php init_tail();?>
<?php $this->load->view('admin/clients/choose_contacts_list_js'); ?>
<?php unset($_SESSION['policyNumberSearch']);
      unset($_SESSION['advisersearch']); ?>
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
</body>
</html>
