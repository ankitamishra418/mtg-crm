<style>
.loader-container {
    position: absolute !important;
    width: 100%;
    top: 350px;
}
.loader-container .loader-text {
    position: relative !important;
    color: #5D78FF;
    text-align: center;
}
</style>
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <!-- <p class="filter">Filter</p> -->
                        <div class="col-md-12">
                                    <!-- <div class="col-md-6" style=" text-align: right;"> -->
                        <h4 style="font-weight: 900; text-align: center;">Arrears Report</h4>
                     </div><br> <br>
                        <div class="row " style="margin-top:30px;">
                            <form method="post" action="<?php echo base_url(); ?>admin/projects/report_arears" class="filterform">
                            <!-- <div class="row"> -->
                               <!-- // <div class="col-md-2 ">   -->
                                <!-- <lable>Arrear</lable> -->
                                    <!-- <select class=" selectpicker form-control form-control-lg" data-live-search="true"
                                        id="projectType" name="projectType">
                                        <option value="">Select All</option> -->
                                        <?php// foreach($projectType as $row){ ?>
                                        <!-- <option value="<1?php echo $row['id']?>"
                                            <1?php if($row['id']==$this->session->userdata('projectType')){?>
                                            selected <1?php }?>> <1?php echo $row['project_type']?>
                                        </option> -->
                                        <?php // if ($row['project_type'] == 'Arrears') {
                                                  //  echo '<input type="text" name="projectType" value="' . $row['project_type'] . '">';
                                               // } ?>
                                        <?php // }  ?>
                                    <!-- </select> -->
                                <!-- </div> -->
                                <div class="col-md-2">
                                <lable style="font-weight: 900;">Adviser</lable>
                                    <select class=" selectpicker form-control form-control-lg" data-live-search="true"
                                        id="advis" name="adviser">
                                        <!-- <option value="">Select All</option> -->
                                        <?php /* foreach($adviser as $row){ ?>
                                        <option value="<?php echo $row['staffid']?>"
                                            <?php if($row['staffid']==$this->session->userdata('adviser')){?> selected <?php }?>> <?php echo $row['firstname'].' '.$row['lastname']?>
                                        </option>
                                        <?php  } */ ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                <lable style="font-weight: 900;">Provider</lable>
                                    <select class=" selectpicker form-control form-control-lg" data-live-search="true"
                                        id="provider" name="provider">
                                        <!-- <option value="">Select All</option> -->
                                        <?php /* foreach($provider as $row){ ?>
                                        <option value="<?php echo $row['id']?>"
                                            <?php if($row['id'] == $this->session->userdata('provider')){?> selected <?php }?>> <?php echo $row['providername']?>
                                        </option>
                                        <?php  } */ ?>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                <lable style="font-weight: 900;">Activity Status</lable>
                                    <select class=" selectpicker form-control form-control-lg" data-live-search="true"
                                        id="status" name="status">
                                        <option value="">Select All</option>
                                        <option value="1" <?php  if($this->session->userdata('status') == "1") {?> <?php echo 'selected'; ?><?php }?>><?php echo _l('project_status_1')?></option>
                                        <option value="2" <?php  if($this->session->userdata('status') == "2") {?> <?php echo 'selected'; ?><?php }?>><?php echo _l('project_status_2')?></option>
                                        <option value="3" <?php  if($this->session->userdata('status') == "3") {?> <?php echo 'selected'; ?><?php }?>><?php echo _l('project_status_3')?></option>
                                        <option value="4" <?php  if($this->session->userdata('status') == "4") {?> <?php echo 'selected'; ?><?php }?>><?php echo _l('project_status_4')?></option>
                                        <option value="5" <?php  if($this->session->userdata('status') == "5") {?> <?php echo 'selected'; ?><?php }?>><?php echo _l('project_status_5')?></option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                
                                <lable style="font-weight: 900;">Member</lable>
                                    <select class=" selectpicker form-control form-control-lg" data-live-search="true"
                                    id="member" name="member">
                                        <!-- <option value="">Select All</option> -->
                                        <?php /* foreach($member as $row){ ?>
                                            <option value="<?php echo $row['staffid']?>"
                                            <?php if($row['staffid']==$this->session->userdata('member')){?> selected <?php }?>> <?php echo $row['firstname'].' '.$row['lastname']?>
                                        </option>
                                        <?php  } */ ?>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <lable style="font-weight: 900;">Arrears Status</lable>
                                    <select class=" selectpicker form-control form-control-lg" data-live-search="true"
                                        id="arrears_status" name="arrears_status" >
                                        <!-- <option value="">Select All</option> -->
                                        <?php /* foreach($arrears_status as $row){ ?>
                                            <option value="<?php echo $row['id']?>"
                                            <?php if($row['id']==$this->session->userdata('arrears_status')){?> selected <?php }?>> <?php echo $row['arrears_status']?>
                                        </option>
                                        <?php  } */ ?>
                                    </select>
                                </div>
                                <br>
                                <div class="col-md-2" style=" text-align: right;">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                <button type="submit" class="btn btn-primary">Apply</button>
                                </div>
                                <br><br>    
                                <div class="row">
                                    <div class="col-md-12" style=" margin-top:30px; text-align: center;">
                                        <p>Lapsed API : <span><?php echo $lapsed_api_total; ?></span></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="processing-loader" class="loader-container">
                            <div class="spinner-border text-primary loading" role="status">
                                <h3 class="loader-text">Loading...</h3><br><br><br>
                                <div class="visually-hidden dt-loader" style="left: 49%;"></div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table mt-5 choose_contact_table" id="choose_contact_table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Number</th>
                                        <th scope="col">Activity Name</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Client Group</th>
                                        <th scope="col">Adviser</th>
                                        <th scope="col">Members</th>
                                        <th scope="col">Policy</th>
                                        <th scope="col">Provider</th>
                                        <th scope="col">Date Created</th>
                                        <th scope="col">Days Elapsed</th>
                                        <th scope="col">Arrears Status</th>
                                        <th scope="col">Lapsed API $</th>
                                    </tr>
                                </thead>
                                <tbody id="choose_contact_table_body">
                                    <?php
                                        // $i = 1; 
                                        // print
                                       // foreach($data as $row){
                                    ?>
                                    <!-- <tr>
                                        <th scope="row"><?php  //echo $row['id'] ?></th>
                                        <td>
                                    <a href="<?php //echo site_url() ?>admin/projects/view/<?php //echo $row['id'] ?>"><?php //echo $row['name']; ?></a>
                                    </td> -->
                                        <!-- <td><1?php echo $row['name']  ?></td> -->
                                        <!-- <td><?php //echo $row['projecttype']  ?></td>
                                        <td><?php //echo $row['status']?></td>
                                        <td><?php //echo $row['client_group']?></td>
                                        <td><?php //echo $row['advisor']?></td>
                                        <td><?php //echo $row['member'] ?></td>
                                        <td><?php //echo $row['policy_number']?></td>
                                        <td><?php //echo $row['provider']?></td>
                                        <td><?php //echo $row['project_created']?></td>
                                        <td><?php //echo $row['days_elapsed']?></td>
                                        <td><?php //echo $row['arrears_status']?></td>
                                        <td><?php //echo $row['lapsed_api']?></td>
                                    </tr> -->
                                    <?php
                                // }  ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail();?>
<?php $this->load->view('admin/projects/workflow_report/report_arrears_js'); ?>
<script>
function myConfirm() {
    var result = confirm("Want to delete?");
    if (result == true) {
        return true;
    } else {
        return false;
    }
}
</script>
</body>

</html>