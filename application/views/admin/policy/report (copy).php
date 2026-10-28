<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?php echo site_url('assets/css/customcss.css');?>">
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row ">
                            <form method="post" action="<?php echo base_url(); ?>admin/policy/report" class="filterform">
                            <div class="col-md-1 filter">Filter</div>
                                <div class="col-md-2 ">
                                    <select class=" selectpicker form-control form-control-lg" data-live-search="true"
                                        id="policystatus" name="policy_status">
                                        <option value="">Choose Status</option>
                                        <?php foreach($datat as $row){ ?>
                                        <option value="<?php echo $row['status_type']?>"
                                            <?php if($row['status_type']==$this->session->userdata('policy_status')){?>
                                            selected <?php }?>> <?php echo $row['status_type']?>
                                        </option>
                                        <?php  }  ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select class=" selectpicker form-control form-control-lg" data-live-search="true"
                                        id="advis" name="adviser">
                                        <option value="">Choose Adviser</option>
                                        <?php foreach($datatt as $row){ ?>
                                        <option value="<?php echo $row['staffid']?>"
                                            <?php if($row['staffid']==$this->session->userdata('customer')){?>
                                            selected <?php }?>> <?php echo $row['firstname'].' '.$row['lastname']?>
                                        </option>
                                        <?php  }  ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="date" class="form-control" id="startDate" data-date-split-input="true"
                                        name="startDate"
                                        value="<?php print_r($this->session->userdata('start_date'))?>">
                                </div>
                                <div class="col-md-2">
                                    <input type="date" class="form-control" id="endDate" data-date-split-input="true"
                                        name="endDate" value="<?php print_r($this->session->userdata('endDate'))?>">
                                </div>
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>"
                                    value="<?php echo $this->security->get_csrf_hash();?>">
                                <button type="submit" class="btn btn-primary">Apply</button>
                            </form>
                        </div>
                        <?php  //echo"<pre>"; print_r($data); exit;?>
                        <table class="table mt-5 choose_contact_table" id="choose_contact_table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Sr.n</th>
                                    <th scope="col">Policy</th>
                                    <th scope="col">Adviser</th>
                                    <th scope="col">Client Name</th>
                                    <th scope="col">Provider</th>
                                    <th scope="col">Life Assured</th>
                                    <th scope="col">Policy Owner</th>
                                    <th scope="col">Premium</th>
                                    <th scope="col">Policy Status</th>
                                    <th scope="col">Client Review Date</th>
                                    <th scope="col">Email</th>
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
                                    <td><?php  if($row['adviser']=='')
                                    {echo '-';} 
                                    echo $row['adviser']?></td>
                                    <td><?php echo $row['customer']?></td>
                                    <td><?php echo $row['provider']?></td>
                                    <td><?php echo $row['life_assured']?></td>
                                    <td><?php echo $row['policy_owner']?></td>
                                    <td><?php echo $row['premium_frequency']?></td>
                                    <td><?php echo $row['policy_status']?></td>
                                    <td><?php echo $row['client_review_date']?></td>
                                    <td><?php echo $row['contact_email']?></td>
                                    <td class="d-flex justify-content-around">
                                        <a class="btn btn-info btn-md"
                                            href="<?php echo base_url('admin/policy/Policies/'.$row['id']) ?>"><i
                                                class="iconFontSize fa fa-eye" title="view"></i></a>
                                        <a class="btn btn-danger btn-md" onclick="return myConfirm();"
                                            href="<?php echo base_url('admin/policy/deletePolicyData/'.$row['id'])?>"><i
                                                class="iconFontSize fa fa-trash-o" title="Delete"></i></a>
                                    </td>
                                </tr>
                                <?php $i++; }  ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail();?>
<?php $this->load->view('admin/clients/choose_contacts_list_js'); ?>
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