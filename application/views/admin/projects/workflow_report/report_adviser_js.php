<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<style href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"></style>
<style href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css"></style> 
<script>
  $(document).ready(function () {
    $.ajax({
        url: '<?php echo admin_url("projects/report_adviser_data") ?>',
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            var projectTypeOp = '';
            var projectTypeData =
                <?php echo json_encode($this->session->userdata('projectType') ?? []); ?>;
            var adviserOp = '';
            var dataAdviser = <?php echo json_encode($this->session->userdata('adviser') ?? []); ?>;
            var providerOp = '<option value="">Select All</option>';
            var memberOp = '<option value="">Select All</option>';
            $.each(response.projectType, function(index, row) {
                projectTypeOp += '<option value="' + row.id + '" ' +
                    (projectTypeData.includes(row.id) ? 'selected' : '') +
                    '>' + row.project_type + '</option>';
            });
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
            $("#projectType").html(projectTypeOp);
            $("#advis").html(adviserOp);
            $("#provider").html(providerOp);
            $("#member").html(memberOp);
            $('#projectType, #advis, #provider, #member').selectpicker('refresh');
            getData();
        }
    });
    function getData(){
      var projectType = $("#projectType").val();
      var adviser = $("#advis").val();
      var status = $("#status").val();
      var provider = $("#provider").val();
      var member = $("#member").val();
      $('#processing-loader').show();
      $.ajax({
          url: '<?php echo admin_url("projects/report_adviser_data") ?>',
          type: 'POST',
          data: {
              projectType: projectType,
              adviser: adviser,
              status: status,
              provider: provider,
              member: member
          },
          dataType: 'json',
          success: function(response) {
              var tbody = $("#choose_contact_table tbody");
              tbody.empty();
              var tr = '';
              $.each(response.data, function(index, row) {
                  tr += '<tr>';
                  tr += '<th>' + row.id + '</th>';
                  tr += '<td><a href="<?php echo site_url() ?>admin/projects/view/' + (row.id !== null ? row.id : '') + '">' + (row.client_group !== null ? row.client_group : '') + '</a></td>'; 
                  tr += '<td>' + (row.projecttype !== null ? row.projecttype : '') + '</td>'; 
                  tr += '<td>' + (row.provider !== null ? row.provider : '') + '</td>'; 
                  tr += '<td>' + (row.days_elapsed !== null ? row.days_elapsed : '') + '</td>'; 
                  tr += '<td>' + (row.milestone_name !== null ? row.milestone_name : '') + '</td>'; 
                  tr += '<td>' + (row.task_name !== null ? row.task_name : '') + '</td>'; 
                  tr += '<td>' + (row.latest_comment !== null ? row.latest_comment : '') + '</td>'; 
                  tr += '<td>' + (row.member !== null ? row.member : '') + '</td>'; 
                  tr += '<td>' + (row.advisor !== null ? row.advisor : '') + '</td>';
                  tr += '</tr>';
              });
              console.log(tr);
              tbody.html(tr);
              initializeDataTable();
              $('#processing-loader').hide();
          }
      });
    }
    function initializeDataTable() {
        var d = new Date();
        var month = d.getMonth() + 1;
        var day = d.getDate();
        var output = '-' + (day < 10 ? '0' : '') + day + '.' + (month < 10 ? '0' : '') + month + '.' + d
            .getFullYear();
        $('#choose_contact_table').DataTable({
            dom: 'Bfrtip',
            paging: true,
            buttons: [{
                    extend: 'excelHtml5',
                    text: 'excel',
                    title: 'Arrears Report' + output
                },
                {
                    extend: 'csvHtml5',
                    text: 'csv',
                    title: 'Adviser Report' + output,
                },
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
    //     dom: 'Bfrtip',
    //     paging:false,
    //     buttons: [
    //         {
    //         extend:    'excelHtml5',
    //         text:      'excel',
    //         title: 'Adviser Report' + output
    //         },
    //         {
    //         extend:    'csvHtml5',
    //         text:      'csv',
    //         title: 'Adviser Report' + output,
        
    //         },
    //     ]
    // });
});
  
</script>