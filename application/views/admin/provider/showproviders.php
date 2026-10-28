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
                <th scope="col">Sr.n</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <!-- <th scope="col">Phone</th> -->
                <th scope="col">BDM Name</th>
                <th scope="col">BDM Email</th>
                <th scope="col">Accounts Name</th>
                <th scope="col">Accounts Email</th>
                <!-- <th scope="col">Accounts Phone</th> -->
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
              $i = 1; 
              sort($data);
              foreach($data as $row){
              if($row['is_deleted']==0){
            ?>
                <tr>
                <th scope="row"><?php echo $i ?></th>
                <td><?php echo $row['providername']?></td>
                <td><?php echo $row['email'] ?></td>
                <!-- <td><?php //echo $row['mobilenumber'] ?></td> -->
                <td><?php echo $row['bdm_name']?></td>
                <td><?php echo $row['bdm_email'] ?></td>
                <td><?php echo $row['accounts_name'] ?></td>
                <td><?php echo $row['accounts_email']?></td>
                <!-- <td><?php //echo $row['accounts_phone'] ?></td> -->
                <td>
                <a class="btn btn-info btn-sm" href="<?php echo base_url('admin/Provider/edit/'.$row['id']) ?>"><i class=" iconFontSize fa fa-edit"></i></a>
                <a class="btn btn-danger btn-sm" href="<?php echo base_url('admin/Provider/delete/'.$row['id']) ?>"><i class="iconFontSize fa fa-trash-o"></i></a>
                </td>
                </tr>
                <?php $i++; } } ?>
            </tbody>
        </table>
</div>
<?php init_tail();?>
<?php $this->load->view('admin/clients/choose_contacts_list_js'); ?>
</body>
</html>
