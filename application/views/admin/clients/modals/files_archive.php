<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
   <div class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="panel_s">
               <div class="panel-body">
                <h3><?php echo _l('add_archive_file'); ?></h3>
                <form method="post" action="<?php echo base_url(); ?>admin/clients/save_files_archive">
                    <div class="row">
                        <div class="col-md-4">
                            <label><small class="req text-danger">* </small>Client Group</label>
                            <select class=" selectpicker form-control form-control-lg" data-live-search="true"
                                id="customer" name="customer" required>
                                <option value>Select</option>
                                <?php foreach ($companey as $val) {?>
                                <option value="<?php echo $val['userid']?>">
                                    <?php echo $val['company']?>
                                </option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label><small class="req text-danger">* </small><?php echo _l('archive_link'); ?></label>
                            <input type ="text"  class="form-control" value="" placeholder="Enter Input" name="hyper_link" id="hyper_link" required>
                        </div>
                        <input type="hidden" id="archive_id" name="archive_name" value="">
                        <div class="col-md-2">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                            <button type="submit"  class="btn btn-info">Add</button>
                        </div>
                    </div>
                </form>
               </div>
            </div>
            <div class="panel_s">
                <div class="panel-body">
                    <table class="table mt-5" >
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col"><?php echo _l('srno'); ?></th>
                                <th scope="col"><?php echo _l('customer'); ?></th>
                                <th scope="col"><?php echo _l('staff_name'); ?></th>
                                <th scope="col"><?php echo _l('hyper_link'); ?></th>
                                <th scope="col"><?php echo _l('date_created'); ?></th>
                                <th scope="col"><?php echo _l('action'); ?></th>
                            </tr>
                        </thead>
                     <tbody>
                        <?php
                           $i=1;
                           foreach($fetch_ArchiveFiles as $val) {
                        ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $val['company'] ?></td>
                            <td><?php echo $val['firstname']. ' ' . $val['lastname']; ?></td>
                            <td><a href="<?php echo $val['hyper_link']; ?>" target="blank"><?php echo $val['hyper_link']; ?></a></td>
                            <td><?php echo $val['date_created'] ?></td>
                            <td><a class="btn btn-danger btn-sm" onclick="return(myConfirm())" href="<?php echo base_url('admin/clients/delete_archive_file/'.$val['id']) ?>"><i class="iconFontSize fa fa-trash-o"></i></a>
                            <span class="btn btn-info btn-sm" onclick="myPrimaryContact(<?php echo $val['id'] ?>)" href="<?php //echo base_url('admin/clients/edit_archive_file/'.$val['id']) ?>"><i class="iconFontSize fa fa-edit"></i></span>
                        </td>
                        </tr>
                     <?php $i++; }  ?>
                    </tbody>
                </table>
<!-- <input type="text" id="edhit_data"> -->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php init_tail(); ?>
<?php //$this->load->view('admin/clients/modals/client_review_report_js');?>
</body>
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
<script>
    function myPrimaryContact(id) {
        var actionURL = "<?php echo base_url('admin/clients/edit_archive_file')?>";
        // alert(actionURL);
        var edit_archive_id = id;
        $.ajax({
            type: 'POST',
            url: actionURL,
            data: {
                edit_archive_id: edit_archive_id,
            },
            datatype: "json",
            success: function(datas) {
                // console.log(data);
                var data = JSON.parse(datas);
                console.log(data);
                // console.log(data[0].hyper_link);
                document.getElementById("customer").value   = data[0].customer;
                document.getElementById("hyper_link").value = data[0].hyper_link;
                document.getElementById("archive_id").value = data[0].id;
                $("#customer").selectpicker("refresh");
            }
        })
    };
</script>
</html>