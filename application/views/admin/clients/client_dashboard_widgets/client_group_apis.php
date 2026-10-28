<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<style>


.divRec {provider_summary_data
    cursor: move;
    padding: 10px 10px;
    border-color: #ff0000;
    box-shadow: 0 0 5px #333;
    grid-area: span 2/span 3;
}

.ghost {
    border: 1px dashed #000;
    background-color: #fff;
}

.custom-drag-ghost {
    /* The original cloned element must not take place up in the page and must not be visible */
    position: absolute;
    top: -99999px;
    left: -99999px;
    background-color: #edb458;
    border: 1px solid #e8871e;
}

.hidden-drag-ghost {
    opacity: 0;
}

.transition {
    transition: all 2s ease-out .5s;
    top: 0;
}
.dt-table-loading.table, .table-loading .dataTables_filter, .table-loading .dataTables_length, .table-loading .dt-buttons, .table-loading table tbody tr, .table-loading table thead th {
  {
    opacity: 1 !important;
}
.table-loading{

    opacity: 0 !important;
}
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

<!------------------------------------------------------------------------------------------------->

<div class="row">
    <form method="post" action="<?php echo base_url();?>admin/clients/client_group_apis" class="filterform">
      <div id="wrapper">
        <div class="content">
          <div class="row mt-5">
            <div class="col-md-12">
           
              <div class="panel_s">
                    <div class="panel-body" id="panel">
                        
                        <div class="row " style="margin-top:10px;">
                        </div>
                        <div class="table" style=" padding: 1rem; margin-bottom: 3rem; background-color: #fff; border-radius: 0.25rem;">
                            
                            <!-- <div class="col-md-12"> -->
                                <h3 style="font-weight: 900; text-align: center;">Client Group Summary</h3>
                                <h4 style="color: #FD7277; text-align: center;">In-force Policies</h4>
                            <!-- </div> -->
                            <br> <br>
                            <div id="processing-loader" class="loader-container" style="position:absolute;width:100%;top:350px;">
                                <div class="spinner-border text-primary loading" role="status">
                                    <h3 class="loader-text text-center" style="text-align: center;color: #5D78FF;">Loading...</h3><br><br><br>
                                    <div class="visually-hidden dt-loader" style="left: 49%;"></div>
                                </div>
                            </div>
                    
                    <table class="table mt-5 choose_contact_table" id="choose_contact_table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Client Group</th>
                                <th scope="col">Policies</th>
                                <th scope="col" style="text-align: right;">Lives Assured</th>
                                <th scope="col" style="text-align: right;">API</th>
                            </tr>
                        </thead>
                        <tbody id="client_group_api">
                        </tbody>
                        <tfoot>
                            <tr class="total-row">
                                <th>Total</th>
                                <th id="total-policies"></th>
                                <th style="text-align: right;" id="total-individuals"></th>
                                <th style="text-align: right;" id="total-api"></th>
                            </tr>
                        </tfoot>
                    </table>
                        </div>
                    </div>
                </div>

           </div>
         </div>
       </div>
     </div>
   </form>
  </div>
<?php init_tail();?>
</body>


<?php 
    unset($_SESSION['firstNameClientdashboard']);//destroying specific session 
    unset($_SESSION['lastNameClientdashboard']);
?>  


<script>
/* still in progress */

    function sortable(section, onUpdate) {
    var dragEl, nextEl, newPos, dragGhost;

    let oldPos = [...section.children].map(item => {
        item.draggable = true
        let pos = document.getElementById(item.id).getBoundingClientRect();
        return pos;
    });

    function _onDragOver(e) {
        e.preventDefault();
        e.dataTransfer.dropEffect = 'move';

        var target = e.target;
        if (target && target !== dragEl && target.nodeName == 'DIV') {
            if (target.classList.contains('inside')) {
                e.stopPropagation();
            } else {
                //getBoundinClientRect contains location-info about the element (relative to the viewport)
                var targetPos = target.getBoundingClientRect();
                //checking that dragEl is dragged over half the target y-axis or x-axis. (therefor the .5)
                var next = (e.clientY - targetPos.top) / (targetPos.bottom - targetPos.top) > .5 || (e.clientX -
                    targetPos.left) / (targetPos.right - targetPos.left) > .5;
                section.insertBefore(dragEl, next && target.nextSibling || target);

                /*  console.log("oldPos:" + JSON.stringify(oldPos));
                 console.log("newPos:" + JSON.stringify(newPos)); */
                /* console.log(newPos.top === oldPos.top ? 'They are the same' : 'Not the same'); */
                console.log(oldPos);
            }
        }
    }

    function _onDragEnd(evt) {
        evt.preventDefault();
        newPos = [...section.children].map(child => {
            let pos = document.getElementById(child.id).getBoundingClientRect();
            return pos;
        });
        console.log(newPos);
        dragEl.classList.remove('ghost');
        section.removeEventListener('dragover', _onDragOver, false);
        section.removeEventListener('dragend', _onDragEnd, false);

        nextEl !== dragEl.nextSibling ? onUpdate(dragEl) : false;
    }

    section.addEventListener('dragstart', function(e) {
        dragEl = e.target;
        nextEl = dragEl.nextSibling;
        /* dragGhost = dragEl.cloneNode(true);
        dragGhost.classList.add('hidden-drag-ghost'); */

        /*  document.body.appendChild(dragGhost);
         e.dataTransfer.setDragImage(dragGhost, 0, 0); */

        e.dataTransfer.effectAllowed = 'move';
        e.dataTransfer.setData('Text', dragEl.textContent);

        section.addEventListener('dragover', _onDragOver, false);
        section.addEventListener('dragend', _onDragEnd, false);

        setTimeout(function() {
            dragEl.classList.add('ghost');
        }, 0)

    });
}

sortable(document.getElementById('list'), function(item) {
    /* console.log(item); */
});
</script>

<script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
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
$(document).ready(function() {
    function fetchData() {
        var $tbody = $('#choose_contact_table tbody');
        $('#processing-loader').show();
        $.ajax({
            url: "<?php echo admin_url('clients/client_group_apis_data'); ?>",
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                var totaPolicies = 0;
                var totalIndividuals = 0;
                var lapsedApiTotal = 0;
                $.each(response.client_group_api, function(index, row) {
                    var count_policy = parseInt(row.count_policy) || 0;
                    var individual = parseInt(row.individual_name) || 0;
                    var apibeingLapsed = row.api.trim();
                    var dollarData = apibeingLapsed.charAt(0);
                    var numericData = 0;
                    if (dollarData === '$') {
                        numericData = parseFloat(apibeingLapsed.substring(1).replace(
                            /,/g, ''));
                        lapsedApiTotal += numericData;
                    }
                    totaPolicies += count_policy;
                    totalIndividuals += individual;
                    $tbody.append(
                        '<tr>' +
                        '<td>' + row.customer_name + '</td>' +
                        '<td>' + row.count_policy +
                        '</td>' +
                        '<td style="text-align: right;">' + row.individual_name +
                        '</td>' +
                        '<td style="text-align: right;">' + row.api + '</td>' +
                        '</tr>'
                    );
                });
                $('#total-policies').text(totaPolicies);
                $('#total-individuals').text(totalIndividuals);
                $('#total-api').text('$' + lapsedApiTotal.toFixed(2).replace(
                    /\d(?=(\d{3})+\.)/g, '$&,'));
                initializeDataTable();
                $('#processing-loader').hide();
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                $('#processing-loader').show();
            }
        });
    }
    fetchData();
    function initializeDataTable() {
        if ($.fn.DataTable.isDataTable('#choose_contact_table')) {
            $('#choose_contact_table').DataTable().destroy();
        }
        $('#choose_contact_table').DataTable({
            "order": [],
            "pageLength": 25,
            "processing": true,
            "dom": 'Bfrtip',
            "buttons": [{
                    extend: 'excelHtml5',
                    text: 'Excel',
                    title: 'Client Dashboard ' + new Date().toISOString().slice(0, 10)
                },
                {
                    extend: 'csvHtml5',
                    text: 'CSV',
                    title: 'Client Dashboard ' + new Date().toISOString().slice(0, 10)
                }
            ],
        }).on('search.dt', function() {
            var table = $('#choose_contact_table').DataTable();
            var searchTerm = table.search();
            if (searchTerm) {
                $('.total-row').hide();
            } else {
                $('.total-row').show();
            }
        });
    }

    var totalContacts = $('#total_contacts').val();
    var selectedContacts = [];
    for (var z = 1; z <= totalContacts; z++) {
        $('#send_choose_contact_' + z).on('click', function() {
            if ($(this).prop("checked") == true) {
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

    var d = new Date();
    var month = d.getMonth() + 1;
    var day = d.getDate();
    var output = '-' + (day < 10 ? '0' : '') + day + '.' + (month < 10 ? '0' : '') + month + '.' + d
        .getFullYear();

    // $('.choose_contact_table').DataTable({

    //     "order": [],
    //     dom: 'Bfrtip',
    //     "pageLength": 25,
    //     buttons: [{
    //             extend: 'excelHtml5',
    //             text: 'excel',
    //             title: 'Client Group API' + output
    //         },
    //         {
    //             extend: 'csvHtml5',
    //             text: 'csv',
    //             title: 'Client Group API' + output
    //         },
    //     ]
    // });
    
});
</script>

</html>