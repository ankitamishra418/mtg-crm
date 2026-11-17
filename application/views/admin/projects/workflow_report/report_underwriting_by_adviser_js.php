<!-- <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script> -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<!-- <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --> -->
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
        url: '<?php echo admin_url("projects/report_underwriting_by_adviser_data") ?>',
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            var providerOp = '<option value="">Select All</option>';
            $.each(response.provider, function(index, row) {
                providerOp += '<option value="' + row.id + '" ' +
                    (row.id == "<?php echo $this->session->userdata('provider') ?>" ?
                        'selected' : '') +
                    '>' + row.providername + '</option>';
            });
            $("#provider").html(providerOp);
            $('#provider').selectpicker('refresh');
            getData();
        }
    });
    function getData() {
        var provider = $("#provider").val();
        $("#proccessing-loader").show();
        $.ajax({
            url: '<?php echo admin_url("projects/report_underwriting_by_adviser_data") ?>',
            type: 'POST',
            data: {
                provider: provider
            },
            dataType: 'json',
            success: function(response) {
                var tbody = $("#choose_contact_table tbody");
                var tfoot = $("#choose_contact_table tfoot");
                tbody.empty();
                tfoot.empty();
                var totalOfTotal = 0;
                var inprogressRow = 0;
                var outOfTermRow = 0;
                var requestedToIssueRow = 0;
                var i = 1;
                $.each(response.amountPerAdviser, function(user, userData) {
                    var columns = userData;
                    var tr = '<tr>';
                    tr += '<td>' + i + '</td>';
                    tr += '<td>' + user + '</td>';
                    var total = 0,
                        k = 0;
                    $.each(columns, function(colIndex, value) {
                        var amount = parseFloat(value.toString().replace('$', '')
                            .replace(',', '')) || 0;
                        total += amount;
                        totalOfTotal += amount;
                        if (k == 0) {
                            inprogressRow += amount;
                        } else if (k == 1) {
                            outOfTermRow += amount;
                        } else if (k == 2) {
                            requestedToIssueRow += amount;
                        }
                        k++;
                        tr += '<td style="text-align:right;">$' + formatNumber(
                            amount
                            .toFixed(
                                2)) + '</td>';
                    });
                    tr += '<td style="text-align:right;">$' + formatNumber(total.toFixed(
                            2)) +
                        '</td>';
                    tr += '</tr>';
                    i++;
                    tbody.append(tr);
                });
                var totalRow = '<tr>';
                totalRow += '<td></td>';
                totalRow += '<th>Grand Total</th>';
                totalRow += '<th style="text-align:right;">$' + formatNumber(inprogressRow.toFixed(
                        2)) +
                    '</th>';
                totalRow += '<th style="text-align:right;">$' + formatNumber(outOfTermRow.toFixed(
                        2)) +
                    '</th>';
                totalRow += '<th style="text-align:right;">$' + formatNumber(requestedToIssueRow
                        .toFixed(2)) +
                    '</th>';
                totalRow += '<th style="text-align:right;">$' + formatNumber(totalOfTotal.toFixed(
                        2)) +
                    '</th>';
                totalRow += '</tr>';
                tfoot.html(totalRow);
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
            "pageLength": 50,
            paging: false,
            buttons: [{
                    extend: 'excelHtml5',
                    text: 'excel',
                    title: 'Arrears Report' + output
                },
                {
                    extend: 'csvHtml5',
                    text: 'csv',
                    title: 'Underwriting by Adviser' + output
                },
            ]
        });
    }
    function formatNumber(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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
        //     "pageLength":50,
        //     buttons: [
        //     {
        //     extend:    'excelHtml5',
        //     text:      'excel',
        //     title: 'Underwriting By Adviser Report' + output
        //     },
        //     {
        //     extend:    'csvHtml5',
        //     text:      'csv',
        //     title: 'Underwriting By Adviser Report' + output
        //     },
        //     ]
        // });

    });
  
</script>