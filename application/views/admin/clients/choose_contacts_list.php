<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
  <div class="content">
    <div class="row mt-5">
      <div class="col-md-12">
        <div class="panel_s">
          <div class="panel-body">
        <table class="table mt-5" id="choose_contact_table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">S.no</th>
                <th scope="col">Fullname</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
              $i = 0; 
              foreach($data as $row){
              $i++;
            ?>
                <tr>
                <th scope="row"><?php echo $i?></th>
                <td><?php echo $row['firstname']." ".$row['lastname']?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['phonenumber'] ?></td>
                <td> <input class="form-check-input" type="checkbox" value="<?php echo $row['id'] ?>" id="send_choose_contact_<?php echo $i ?>" ></td>
                </tr>
                <?php  } ?>
            </tbody>
        </table>
          <div class="row mbot15">
              <div class="col-md-3 contacts-filter-column">
              <form method="post" action="<?php echo base_url(); ?>admin/clients/choose_contacts_insert">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                <input type="hidden" id="selected_contacts" name="selected_contacts" value ="" />
                <input type="hidden" id="for_company" name="for_company" value ="<?php echo $company_id ?>" />
                <input type="hidden" id="total_contacts" name="total_contacts" value ="<?php echo count($data) ?>" />
                <button type="submit" class="btn btn-info" id="choose_submit">Submit</button>
              </form>
          <div>
           </div>
</div>
<?php init_tail();?>
<?php $this->load->view('admin/clients/choose_contacts_list_js'); ?>
</body>
</html>
