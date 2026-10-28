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
  $(document).ready(function () {
    $.ajax({
        url: '<?php echo admin_url("projects/report_underwriting_data") ?>',
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            var adviserOp = '';
            var dataAdviser = <?php echo json_encode($this->session->userdata('adviser') ?? []); ?>;
            var providerOp = '<option value="">Select All</option>';
            var memberOp = '<option value="">Select All</option>';
            var under_statusOp = '<option value="">Select All</option>';
            var underStatusData =
                <?php echo json_encode($this->session->userdata('under_status') ?? []); ?>;
            $.each(response.adviser, function(index, row) {
                adviserOp += '<option value="' + row.staffid + '" ' +
                    (dataAdviser.includes(row.staffid) ? 'selected' : '') +
                    '>' + row.firstname + ' ' + row.lastname + '</option>';
            });
            $.each(response.provider, function(index, row) {
                providerOp += '<option value="' + row.id + '" ' +
                    (row.id == "<?php echo $this->session->userdata('provider') ?>" ?
                        'selected' : '') +
                    '>' + row.providername + '</option>';
            });
            $.each(response.member, function(index, row) {
                memberOp += '<option value="' + row.staffid + '" ' +
                    (row.staffid == "<?php echo $this->session->userdata('member') ?>" ?
                        'selected' : '') +
                    '>' + row.firstname + ' ' + row.lastname + '</option>';
            });
            $.each(response.under_status, function(index, row) {
                under_statusOp += '<option value="' + row.id + '" ' +
                    (underStatusData.includes(row.id) ? 'selected' : '') +
                    '>' + row.under_status + '</option>';
            });
            $("#advis").html(adviserOp);
            $("#provider").html(providerOp);
            $("#member").html(memberOp);
            $("#under_status").html(under_statusOp);
            $('#advis, #provider, #member, #under_status').selectpicker('refresh');
            getData();
        }
    });

    function getData(){
      $('#processing-loader').show();
      var adviser = $("#advis").val();
      var provider = $("#provider").val();
      var status = $("#status").val();
      var member = $("#member").val();
      var under_status = $("#under_status").val();
      $.ajax({
          url: '<?php echo admin_url("projects/report_underwriting_data") ?>',
          type: 'POST',
          data: {
              adviser: adviser,
              provider: provider,
              status: status,
              member: member,
              under_status: under_status
          },
          dataType: 'json',
          success: function(response) {
              var tbody = $("#choose_contact_table tbody");
              tbody.empty();
              var tr = '';
              $.each(response.data, function(index, row) {
                  tr += '<tr>';
                  tr += '<th>' + row.id + '</th>';
                  tr += '<td><a href="<?php echo site_url() ?>admin/projects/view/' + (row.id !== null ? row.id : '') + '">' + (row.name !== null ? row.name : '') + '</a></td>'; 
                  tr += '<td>' + (row.projecttype !== null ? row.projecttype : '') + '</td>'; 
                  tr += '<td>' + (row.status !== null ? row.status : '') + '</td>'; 
                  tr += '<td>' + (row.client_group !== null ? row.client_group : '') + '</td>'; 
                  tr += '<td>' + (row.advisor !== null ? row.advisor : '') + '</td>'; 
                  tr += '<td>' + (row.member !== null ? row.member : '') + '</td>'; 
                  tr += '<td>' + (row.policy_number !== null ? row.policy_number : '') + '</td>'; 
                  tr += '<td>' + (row.provider !== null ? row.provider : '') + '</td>'; 
                  tr += '<td>' + (row.ownership !== null ? row.ownership : '') + '</td>';
                  tr += '<td>' + (row.project_created !== null ? row.project_created : '') + '</td>'; 
                  tr += '<td>' + (row.days_elapsed !== null ? row.days_elapsed : '') + '</td>'; 
                  tr += '<td>' + (row.under_status !== null ? row.under_status : '') + '</td>'; 
                  tr += '<td>' + (row.subbmited_api !== null ? row.subbmited_api : '') + '</td>'; 
                  tr += '<td>' + (row.subbmited_date !== null ? row.subbmited_date : '') + '</td>'; 
                  tr += '<td>' + (row.requested_api !== null ? row.requested_api : '') + '</td>';
                  tr += '<td>' + (row.issue_date !== null ? row.issue_date : '') + '</td>'; 
                  tr += '<td>' + (row.final_status !== null ? row.final_status : '') + '</td>'; 
                  tr += '<td>' + (row.issue_policy !== null ? row.issue_policy : '') + '</td>'; 
                  tr += '</tr>';
              });
              tbody.html(tr);
              initializeDataTable();
              $('#processing-loader').hide();
          }
      });
    }
    function initializeDataTable() {
        if ($.fn.DataTable.isDataTable('#choose_contact_table')) {
            $('#choose_contact_table').DataTable().destroy();
        }
        var d = new Date();
        var month = d.getMonth() + 1;
        var day = d.getDate();
        var output = '-' + (day < 10 ? '0' : '') + day + '.' + (month < 10 ? '0' : '') + month + '.' + d
            .getFullYear();
        $('#choose_contact_table').DataTable({
            dom: 'Bfrtip',
            pageLength: 25,
            buttons: [{
                    extend: 'excelHtml5',
                    text: 'Excel',
                    title: 'Underwriting Report' + output
                },
                {
                    extend: 'csvHtml5',
                    text: 'CSV',
                    title: 'Underwriting Report' + output
                }
            ]
        });
    }

    var totalContacts = $('#total_contacts').val();
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


    // var d = new Date();
    // var month = d.getMonth()+1;
    // var day = d.getDate();
    // var output = '-' + (day<10 ? '0' : '') + day + '.' + (month<10 ? '0' : '') + month + '.' + d.getFullYear();

    // $('#choose_contact_table').DataTable( {
    //   dom: 'Bfrtip',
 
    //   buttons: [
    //     {
    //     extend:    'excelHtml5',
    //     text:      'excel',
    //     title: 'Underwriting Report' + output
    //     },
    //     {
    //     extend:    'csvHtml5',
    //     text:      'csv',
    //     title: 'Underwriting Report' + output
    //     },
    //   ]
    // });
    
  });
  
</script>