<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<link rel="stylesheet" href="<?php echo site_url('assets/css/customcss.css');?>">
<style>
   /* th{
  border-style:solid;
  border-color: black;
  } */
</style>
<div id="wrapper">
  <div class="content">
    <div class="row mt-5">
      <div class="col-md-12">
        <div class="panel_s">
          <div class="panel-body">
              
        <table class="table mt-5" id="choose_contact_table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">Description</th>
                <th scope="col">Date</th>
                <th scope="col">Staff</th>
                </tr>
            </thead>
            <tbody>
                <?php
                 
                  foreach($P_log_Activity as $row){
                ?>
                <tr>
                <td><?php echo $row['description']?></td>
                <td><?php echo $row['date']?></td>
                <td><?php echo $row['firstname'] .' '. $row['lastname']?></td>
                </tr>
                <?php }  ?>
            </tbody>
        </table>
</div>
<?php init_tail();?>
<?php $this->load->view('admin/clients/export_download_js'); ?>
<script>
// function myConfirm() {
//   var result = confirm("Want to delete?");
//   if (result==true) {
//    return true;
//   } else {
//    return false;
//   }
// }


// $(document).ready(function() {
    
//     $('#choose_contact_table').DataTable( {
//         dom: 'Bfrtip',
//         buttons: [
//             'copyHtml5',
//             'excelHtml5',
//             'csvHtml5',
//             'pdfHtml5'
//         ]
//     } );
// } );


</script>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<style href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"></style>
<style href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css"></style> -->
</body>
</html>
