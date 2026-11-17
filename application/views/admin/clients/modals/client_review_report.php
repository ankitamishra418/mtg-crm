<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="col-md-12">
                        <h4 style="font-weight: 900; text-align: center;">Client Review Report</h4>
                     </div><br> <br>
                        <div class="row " style="margin-top:30px;">
                            <form method="post" action="<?php echo base_url(); ?>admin/clients/report_client_reviews" class="filterform">
                           <?php $data_adviser = ($this->session->userdata('adviser')); ?>
                                <div class="col-md-2">
                                    <lable style="font-weight: 900;">Adviser</lable>
                                    <select class=" selectpicker form-control form-control-lg" title="Select All" data-live-search="true"
                                        id="advis" name="adviser[]" multiple>
                                        <?php foreach($adviser as $row){ ?>
                                        <option value="<?php echo $row['staffid']?>"
                                            <?php if (in_array($row['staffid'], (array) $this->session->userdata('adviser'))) {
                                                echo 'selected';
                                            } ?>> <?php echo $row['firstname'].' '.$row['lastname']?>


                                            

                                        </option>
                                        <?php  }  ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <lable style="font-weight: 900;">Review Month</lable>
                                    <select class=" selectpicker form-control form-control-lg" data-live-search="true"
                                        id="client_review_month" name="client_review_month">
                                        <option value="" >Select All</option>
                                        <?php  foreach($review_month as $row){ ?>
                                        <option value="<?php echo $row['id']; ?>"
                                            <?php if($row['id'] == $this->session->userdata('client_review_month')){?> selected <?php }?>> <?php echo $row['month_name']?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <lable style="font-weight: 900;">Type</lable>
                                    <select class=" selectpicker form-control form-control-lg" title="Select All"
                                        data-live-search="true" id="type" name="type[]" multiple>
                                        <?php foreach($type as $row){ ?>
                                        <option value="<?php echo $row['id']?>"
                                            <?php if (in_array($row['id'], (array) $this->session->userdata('type'))) {
                                                echo 'selected';
                                            } ?>
>
                                            <?php echo $row['client_type']?>
                                        </option>
                                        <?php  }  ?>
                                    </select>
                                </div><br>
                                <div class="col-md-2" style=" text-align: right;">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                <button type="submit" class="btn btn-primary">Apply</button>
                                </div>
                                <br><br>
                                <div class="row">
                                    <div class="col-md-12" style=" margin-top:30px; text-align: center;">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                        <table class="table mt-5 choose_contact_table " id="choose_contact_table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Client Group</th>
                                    <th scope="col">Review Month</th>
                                    <th scope="col">Adviser</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Vulnerable Client</th>
                                    <th scope="col">Key Contact Address</th>
                                    <th scope="col">Ownership</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php foreach($client_review_data as $row): ?>
                                <tr>
                                    <td><a href="<?php echo base_url() ?>admin/clients/client/<?php echo $row['userid']; ?>"><?php echo $row['company']  ?></a></td>
                                    <td><?php echo $row['review_month_name']?></td>
                                    <td><?php echo $row['adviser_data_contact']?></td>
                                    <td><?php echo $row['individual_name']?></td>
                                    <td><?php echo $row['individual_phonenumber']?></td>
                                    <td><?php echo $row['individual_email']?></td>
                                    <td><?php echo $row['client_type']?></td>
                                    <td><?php echo($row['vulnerable'])?></td>
                                    <td><?php echo($row['residential_address'])?></td>
                                    <td><?php echo($row['ownership'])?></td>
                                </tr>
                                <?php endforeach; ?>
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
<?php $this->load->view('admin/clients/modals/client_review_report_js'); ?>
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