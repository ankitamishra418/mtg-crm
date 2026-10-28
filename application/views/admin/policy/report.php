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
                                        <!-- <option value="">Choose Status</option> -->
                                        <?php /* foreach($datat as $row){ ?>
                                        <option value="<?php echo $row['status_type']?>"
                                            <?php if($row['status_type']==$this->session->userdata('policy_status')){?>
                                            selected <?php }?>> <?php echo $row['status_type']?>
                                        </option>
                                        <?php  } */ ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select class=" selectpicker form-control form-control-lg" data-live-search="true"
                                        id="advis" name="adviser">
                                        <!-- <option value="">Choose Adviser</option> -->
                                        <?php /* foreach($datatt as $row){ ?>
                                        <option value="<?php echo $row['staffid']?>"
                                            <?php if($row['staffid']==$this->session->userdata('customer')){ ?>
                                            selected <?php }?>> <?php echo $row['firstname'].' '.$row['lastname'] ?>
                                        </option>
                                        <?php } */ ?>
                                    </select>
                                </div>
                                <!-- <div class="col-md-2">
                                    <input type="date" class="form-control" id="startDate" data-date-split-input="true"
                                        name="startDate"
                                        value="<?php// print_r($this->session->userdata('start_date'))?>">
                                </div>
                                <div class="col-md-2">
                                    <input type="date" class="form-control" id="endDate" data-date-split-input="true"
                                        name="endDate" value="<?php //print_r($this->session->userdata('endDate'))?>">
                                </div> -->
                                <div class="col-md-2">
                                    <select class=" selectpicker form-control form-control-lg" data-live-search="true"
                                        id="provider" name="provider">
                                        <!-- <option value="">Choose Provider</option> -->
                                        <?php /* foreach($provider as $row)
                                        { ?>
                                        <option value="<?php echo $row['providername']?>"
                                            <?php if($row['providername'] == $this->session->userdata('provider')){?> selected <?php }?>> <?php echo $row['providername']?>
                                        </option>
                                        <?php  } */ ?>
                                    </select>
                                </div>
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>"
                                    value="<?php echo $this->security->get_csrf_hash();?>">
                                <button type="submit" class="btn btn-primary">Apply</button>
                            </form>
                        </div>
                        <?php  //echo"<pre>"; print_r($data); exit;?>
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
                                    <th scope="col">Sr.n</th>
                                    <th scope="col">Policy</th>
                                    <th scope="col">Adviser</th>
                                    <th scope="col">Client Group</th>
                                    <th scope="col">Provider</th>
                                    <th scope="col">Life Assured</th>
                                    <th scope="col">Policy Owner</th>
                                    <th scope="col">IRD No</th>
                                    <th scope="col">PIR</th>
                                    <th scope="col">Total Premium</th>
                                    <th scope="col">Policy Status</th>
                                    <th scope="col">Policy Start Date</th>
                                    <!-- <th scope="col">Email</th> -->
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                /*
                                    $i = 1; 
                                    foreach($data as $row)
                                    { 
                                    // echo"<pre>";
                                    // print_r($data);
                                    // echo"<br>";
                                    // print_r($row['id']);
                                    // exit;
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
                                    <td><?php echo $row['ird_number']?></td>
                                    <td><?php echo $row['pir']?></td>
                                    <!-- <td><?php //echo '$'.number_format($row['total_premium'] ,2).'';?></td> -->
                                    <td><?php $dataRowValue = $row['total_premium'];
                                        $dollerData = mb_substr($dataRowValue, 0, 1);
                                        if($dollerData == '$')
                                        {
                                            echo $row['total_premium'] . '';
                                        }
                                        else
                                        {
                                            echo '$'.number_format($row['total_premium'] ,2).'';
                                        }

                                        ?>
                                        </td>
                                    <td><?php echo $row['policy_status']?></td>
                                    <td><?php if($row['start_date']==00-00-0000 && $row['start_date']==Null){ echo '-';} else{ echo $startdate =date("d-m-Y", strtotime($row['start_date']));} ?> </td>
                                    <!-- <td><?php //echo $row['contact_email']?></td> -->
                                    <td class="d-flex justify-content-around">
                                        
                                        <a class="btn btn-info btn-md"
                                            href="<?php echo base_url('admin/policy/Policies/'.$row['id']) ?>" target="_blank" >
                                            <i class="iconFontSize fa fa-eye" title="view"></i></a>


                                                
                                        <a class="btn btn-danger btn-md" onclick="return myConfirm();"
                                            href="<?php echo base_url('admin/policy/deletePolicyData/'.$row['id'])?>"><i
                                                class="iconFontSize fa fa-trash-o" title="Delete"></i></a>
                                    </td>
                                </tr>
                                <?php $i++; } */ ?>
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
<?php // $this->load->view('admin/clients/choose_contacts_list_js'); ?>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<!-- <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script> -->
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script href="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<style href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"></style>
<style href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css"></style> 
<script>
function myConfirm() {
    var result = confirm("Want to delete?");
    if (result == true) {
        return true;
    } else {
        return false;
    }
}
$(document).ready(function(){
    $.ajax({
        url: '<?php echo admin_url("policy/report_data") ?>',
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            var statusOP = '<option value="">Choose Status</option>';
            var adviserOP = '<option value="">Choose Adviser</option>';
            var providerOp = '<option value="">Choose Provider</option>';
            $.each(response.datat, function(index, row) {
                statusOP += '<option value="' + row.status_type + '"' + (row.status_type ==
                    "<?php echo $this->session->userdata('policy_status') ?>" ?
                    'selected' : '') + '>' + row.status_type + '</option>';
            });
            $.each(response.datatt, function(index, row) {
                adviserOP += '<option value="' + row.staffid + '"' + (row.staffid ==
                    "<?php echo $this->session->userdata('customer') ?>" ?
                    'selected' : '') + '>' + row.firstname + row.lastname + '</option>';
            });
            $.each(response.provider, function(index, row) {
                console.log(row);
                providerOp += '<option value="' + row.providername + '"' + (row.providername ==
                    "<?php echo $this->session->userdata('provider') ?>" ?
                    'selected' : '') + '>' + row.providername + '</option>';
            });
            // console.log(statusOP);
            $("#policystatus").html(statusOP);
            $("#advis").html(adviserOP);
            $("#provider").html(providerOp);
            $("#policystatus , #advis, #provider").selectpicker("refresh");
            getData();
        }
    });
    function getData() {
        var policy_status = $("#policystatus").val();
        var adviser = $("#advis").val();
        var provider = $("#provider").val();
        $('#processing-loader').show();
        $.ajax({
            url: '<?php echo admin_url("policy/report_data") ?>',
            type: 'POST',
            data: {
                policy_status: policy_status,
                adviser: adviser,
                provider: provider
            },
            dataType: 'json',
            success: function(response) {
                var tableBody = $('#choose_contact_table tbody');
                tableBody.empty();
                var i = 1;
                var tr = '';
                $.each(response.data, function(index, row) {
                    var adviser = row.adviser ? row.adviser : '-';
                    var totalPremium = row.total_premium;
                    if (!totalPremium.startsWith('$')) {
                        let cleanedPremium = totalPremium.replace(/[^0-9.-]/g, '').trim();
                        totalPremium = '$' + parseFloat(cleanedPremium).toFixed(2);
                    }
                    console.log(totalPremium);
                    var startDate = row.start_date && row.start_date !== '00-00-0000' ?
                        new Date(row.start_date).toLocaleDateString('en-GB') : '-';
                    tr += '<tr>';
                    tr += '<th scope="row">' + i + '</th>';
                    tr += '<td>' + (row.policy_number !== null ? row.policy_number : '') +
                        '</td>';
                    tr += '<td>' + (adviser !== null ? adviser : '') + '</td>';
                    tr += '<td><a href="' + admin_url + 'clients/client/' + row.userid + '">' + (row.customer !== null ? row.customer : '') + '</a></td>';
                    tr += '<td>' + (row.provider !== null ? row.provider : '') + '</td>';
                    tr += '<td>' + (row.life_assured !== null ? row.life_assured : '') +
                        '</td>';
                    tr += '<td>' + (row.policy_owner !== null ? row.policy_owner : '') +
                        '</td>';
                    tr += '<td>' + (row.ird_number !== null ? row.ird_number : '') +
                        '</td>';
                    tr += '<td>' + (row.pir !== null ? row.pir : '') + '</td>';
                    tr += '<td>' + (totalPremium !== null ? totalPremium : '') + '</td>';
                    tr += '<td>' + (row.policy_status !== null ? row.policy_status : '') +
                        '</td>';
                    tr += '<td>' + (startDate !== null ? startDate : '') + '</td>';
                    tr +=
                        '<td class="d-flex justify-content-around"><a class="btn btn-info btn-md" href="<?php echo base_url("admin/policy/Policies/") ?>' +
                        row.id +
                        '" target="_blank"><i class="iconFontSize fa fa-eye" title="view"></i></a>' +
                        '<a class="btn btn-danger btn-md" onclick="return myConfirm();" href="<?php echo base_url("admin/policy/deletePolicyData/") ?>' +
                        row.id +
                        '"><i class="iconFontSize fa fa-trash-o" title="Delete"></i></a></td>';
                    tr += '</tr>';
                    i++;
                });
                tableBody.html(tr);
                $('#processing-loader').hide();
                initializeDataTable();
            }
        });
    }
    function initializeDataTable(){
      var d = new Date();
      var month = d.getMonth()+1;
      var day = d.getDate();
      var output = '-' + (day<10 ? '0' : '') + day + '.' + (month<10 ? '0' : '') + month + '.' + d.getFullYear();
  
      $('#choose_contact_table').DataTable( {
        dom: 'Bfrtip',
        paging: true,
        buttons: [
          {
          extend:    'excelHtml5',
          text:      'excel',
          title: 'Client Review' + output
          },
          {
          extend:    'csvHtml5',
          text:      'csv',
          title: 'Client Review' + output
          },
  
        ]
      });
    }

    var totalContacts = $('#total_contacts').val();
    if (totalContacts != "") 
    {
      var selectedContacts = [];
      for (var z=1;z<=totalContacts;z++) {
        $('#send_choose_contact_'+z).on('click', function() {
          if ($(this).prop( "checked" ) == true) {
            var a = $(this).val();
            selectedContacts.push(a);
          } else {
              var a = $(this).val();
              var removeItem = a;
              selectedContacts = jQuery.grep(selectedContacts, function(value) {
                return value != removeItem;
              });
          }
          $("#selected_contacts").val(selectedContacts);
        });
      }
    }
});
</script>
</body>

</html>
