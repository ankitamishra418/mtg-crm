<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
   <div class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="panel_s">
               <div class="panel-body">
                 <h3>Add Benefit Group</h3>
                 <?php
        // echo '<pre>';
        // print_r($grouping_benefitData);
        // exit;
        ?>
                <form method="post" action="<?php echo base_url(); ?>admin/policy/saveBenefitGrouping">
                    <div class="row">
                        <div class="col-md-4">
                            <input type ="text"  class="form-control" value="" placeholder="Enter Input" name="benefit_grouping" required>
                        </div>
                        <div class="col-md-2">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                            <button type ="submit"  class="btn btn-info">Add</button>
                        </div>
                    </div>
                </form>
               </div>
            </div>
            <div class="panel_s">
               <div class="panel-body">
                  <table class="table mt-5">
                     <thead class="thead-dark">
                        <tr>
                           <th scope="col">Sr.No</th>
                           <th scope="col">Benefit Group</th>
                           <?php if(has_permission('policy','','delete')) {?>
                           <th scope="col">Action</th>
                           <?php }?>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           $i=1;
                           foreach($grouping_benefitData as $val) {
                        ?>
                        <tr>
                              <td><?php echo $i ?></td>
                              <td><?php echo $val['benefit_grouping'] ?></td>
                              <td>
                              <?php if(has_permission('policy','','delete')) {?>
                              <a class="btn btn-danger btn-sm" onclick="return(myConfirm())" href="<?php echo base_url('admin/policy/deleteBenefitGrouping/'.$val['id']) ?>"><i class="iconFontSize fa fa-trash-o"></i></a>
                              <?php }?>
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
<?php init_tail(); ?>
<?php $this->load->view('admin/clients/choose_contacts_list_js');?>
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
</html>