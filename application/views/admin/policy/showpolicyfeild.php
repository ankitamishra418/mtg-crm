<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
// print_r($data);
// exit;
// print_r($data[][11]['form_title']);
?>
<?php init_head(); ?>
<div id="wrapper">
  <div class="content">
    <div class="row mt-5">
      <div class="col-md-12">
        <div class="panel_s">
          <div class="panel-body">
          <h3>Benefits</h3></br>
        <table class="table mt-5" id="choose_contact_table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">Title</th>
                <th scope="col">Short Order</th>
                <th scope="col">Text</th>
                <th scope="col">CheckBOX</th>
                <th scope="col">Radio Button</th>
                <th scope="col">Dropdown</th>
                <th scope="col">Multiselect</th>
                <th scope="col">TextArea</th>
                <th scope="col">Currency</th>
                <th scope="col">Date</th>
                <?php if(is_admin()) {?>
                <th scope="col">Edit</th>
                <th scope="col">Action</th>
                <?php }?>
                </tr>
            </thead>
            <tbody>
            <?php
               $i = 0;
              // echo "<pre>";print_r($data); exit;
              foreach($data as $row){
                if($row['is_deleted']==0){
                  $inputtextcount = $row['count'][0]['inputtextcount'];
                  $inputcheckcount = $row['count'][0]['inputcheckcount'];
                  $inputradiocount = $row['count'][0]['inputradiocount'];
                  $inputdropdowncount  = $row['count'][0]['inputdropdowncount'];
                  $inputtextareacount  = $row['count'][0]['inputtextareacount'];
                  $inputmultiselectcount  = $row['count'][0]['inputmultiselectcount'];
                  $inputcurrencycount = $row['count'][0]['inputcurrencycount'];
                  $inputdatecount = $row['count'][0]['inputdatecount'];
                  $inputallarray1 =[];
                  for ($count = 1; $count <= $inputtextcount; $count++) {
                    $inputallarray =  $row['beneifits_field'][0]['text_'.$count];
                      array_push($inputallarray1,$inputallarray);
                    }
                    $inputallarray2 =[];
                  for ($count = 1; $count <= $inputcheckcount; $count++) {
                      $inputallarray =  $row['beneifits_field'][0]['check_'.$count];
                      array_push( $inputallarray2,$inputallarray);
                    }
                    $inputallarray3 =[];
                  for ($count = 1; $count <= $inputradiocount; $count++) {
                      $inputallarray  =  $row['beneifits_field'][0]['radio_'.$count];
                      array_push( $inputallarray3,$inputallarray);
                    }
                    $inputallarray4 =[];
                  for ($count = 1; $count <= $inputdropdowncount; $count++) {
                      $inputallarray  =  $row['beneifits_field'][0]['dropdown_'.$count];
                      array_push( $inputallarray4,$inputallarray);
                    }
                    $inputallarray5 =[];
                  for ($count = 1; $count <= $inputmultiselectcount; $count++) {
                      $inputallarray=  $row['beneifits_field'][0]['multiselect_'.$count];
                      array_push( $inputallarray5,$inputallarray);
                    }
                    $inputallarray6 =[];
                  for ($count = 1; $count <= $inputtextareacount; $count++) {
                      $inputallarray  =  $row['beneifits_field'][0]['textarea_'.$count];
                      array_push( $inputallarray6,$inputallarray);
                    }
                  $inputallarray7 =[];
                  for ($count = 1; $count <= $inputcurrencycount; $count++) {
                        $inputallarray  =  $row['beneifits_field'][0]['currencyarea_'.$count];
                        array_push( $inputallarray7,$inputallarray);
                      }
                  $inputallarray8 =[];
                  for ($count = 1; $count <= $inputdatecount; $count++) {
                          $inputallarray  =  $row['beneifits_field'][0]['datearea_'.$count];
                          array_push( $inputallarray8,$inputallarray);
                  }
                    $inputallstring1 = implode(" ,",$inputallarray1);
                    $inputallstring2 = implode(" ,",$inputallarray2);
                    $inputallstring3 = implode(" ,",$inputallarray3);
                    $inputallstring4 = implode(" ,",$inputallarray4);
                    $inputallstring5 = implode(" ,",$inputallarray5);
                    $inputallstring6 = implode(" ,",$inputallarray6);
                    $inputallstring7 = implode(" ,",$inputallarray7);
                    $inputallstring8 = implode(" ,",$inputallarray8);
                   ?>
                  <tr>
                  <td><?php  echo $row['form_title']?></td>
                  <td><?php  echo $row['sort_order']?></td>
                  <td><?php  echo $inputallstring1?></td>
                  <td><?php  echo $inputallstring2?></td>
                  <td><?php  echo $inputallstring3?></td>
                  <td><?php  echo $inputallstring4?></td>
                  <td><?php  echo $inputallstring5?></td>
                  <td><?php  echo $inputallstring6?></td>
                  <td><?php  echo $inputallstring7?></td>
                  <td><?php  echo $inputallstring8?></td>
                  <td>
                  <?php if(is_admin()) {?>
                  <a class="btn btn-primary btn-md" href="<?php echo base_url('admin/policy/editPolicybenefit/'.$row['id']) ?>"><i class="iconFontSize fa fa-edit"></i></a>
                  <?php }?>
                  </td>
                  <td>
                  <?php if(is_admin()) {?>
                  <a class="btn btn-danger btn-md" href="<?php echo base_url('admin/policy/deletePolicybenefit/'.$row['id']) ?>"><i class="iconFontSize fa fa-trash-o"></i></a>
                  <?php }?>
                  </tr>
                  <?php  $i++; } } ?>
            </tbody>
        </table>
</div>
<?php init_tail();?>
<?php $this->load->view('admin/clients/choose_contacts_list_js'); ?>
</body>
</html>