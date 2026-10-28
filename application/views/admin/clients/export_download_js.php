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
<style href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"></style>
<style href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css"></style> 
<script>
  $(document).ready(function () {
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
    $('#choose_contact_table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            // 'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            // 'pdfHtml5'
        ]
    } );
  });
  
</script>