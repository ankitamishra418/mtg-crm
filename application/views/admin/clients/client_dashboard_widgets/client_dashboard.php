<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<style>
    section {
  /* margin: 0;
  padding: 0; */
  list-style: none;
  -webkit-user-select: none;
  -moz-user-select: none;
  user-select: none;
  display: grid;
  grid-gap: 15px;
 /* grid-template-rows: repeat(6, 200px); */
  grid-template-columns: repeat(6, 1fr);
/*   grid-template-columns: repeat(auto-fit, minmax(300px, 300px));
  grid-template-rows: repeat(5, 200px); */
  grid-auto-flow: row dense;
  min-height: 100vh;
}

.inside {
  background-color: #fff;
}

.divRec {
  box-shadow: 0 0 5px #333;

    cursor: move;
    padding: 5px 5px; 
    /* font-size: 20px; */
    /* background-color: #ff0000; */
    
    grid-area: span 2/span 3;
    /* overflow: scroll; */
   /* overflow-y: scroll !important; */
}

/* .divQuad {
    cursor: move;
    padding: 35px 20px;
    font-size: 20px;
    background-color: #fff333;
   
    grid-area: span 1/span 2;
} */

/* .divCard {
    cursor: move;
    padding: 35px 20px;
    font-size: 20px;
    background-color: #00ff00;
  
    grid-area: span 2/span 1;
} */

.ghost {
  border: 1px dashed #000;
  background-color: #fff;
}

.custom-drag-ghost {
  /* The original cloned element must not take place up in the page and must not be visible */
  position: absolute;
  top: -99999px;
  left: -99999px;
  /* Just for appearance */
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
.num_right_align{
  float:right !important;
}

</style>


<!------------------------------------------------------------------------------------------------->
<div class="row">
    <div class="inline-block col-md-8  text-center"style="margin-top: 20px;margin-left: 400px;">
        <form method="post" action="<?php echo base_url();?>admin/clients/client_dashboard" class="filterform">
            <div class="col-md-3"></div>
            <div class="col-md-3">
              <select class=" selectpicker form-control form-control-lg" title="SELECT DASHBOARD" data-live-search="true" id="OpenClientdashboard" name="OpenClientdashboard">
                <option value="" >SELECT DASHBOARD</option>
                <option value="1" <?php echo ($this->session->userdata('sessionDataOptionValue') == '1') ? 'selected' : ''; ?>>Provider Summary</option>
                <option value="2" <?php echo ($this->session->userdata('sessionDataOptionValue') == '2') ? 'selected' : ''; ?>>Client Group API</option>
                <option value="3" <?php echo ($this->session->userdata('sessionDataOptionValue') == '3') ? 'selected' : ''; ?>>Client Group Type</option>
                <option value="4" <?php echo ($this->session->userdata('sessionDataOptionValue') == '4') ? 'selected' : ''; ?>>Age Profile</option>
              </select>
            </div>
           
            <div class="col-md-3">
                <input type="hidden" name="<?php  echo $this->security->get_csrf_token_name();?>"value="<?php echo $this->security->get_csrf_hash();?>">
                <button type="submit" class="btn btn-primary" >Search</button>
            </div>
        </form>
    </div>
</div>
<!------------------------------------------------------------------------------------------------->

<div id="wrapper">
    <div class="content">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                    <section id="list">
                    <div id='div4' class='divRec'><div class='inside'>
                        <?php $this->load->view('admin/clients/client_dashboard_widgets/provider_summary'); ?>

                        </div></div>

                        <div id='div2' class='divRec'><div class='inside'>
                            <?php
                            $this->load->view('admin/clients/client_dashboard_widgets/client_group_api');  
                            ?>
                        </div></div>


                        <div id='div3' class='divRec'><div class='inside'><?php
                            $this->load->view('admin/clients/client_dashboard_widgets/client_group_type');  
                            ?></div></div>

                        <div id='div1' class='divRec'><div class='inside'>
                            <?php
                        
                        $this->load->view('admin/clients/client_dashboard_widgets/age_profile');  
                        //$this->load->view('admin/clients/modals/client_review_report'); ?>
                        <!-- /var/www/html/perfex_crm/application/views/admin/dashboard/widgets/leads_chart.php -->
                        </div></div>
                        
                        
                       
                    </section>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail();?>
<?php //$this->load->view('admin/projects/workflow_report/report_adviser_js'); ?>
</body>
<?php
    unset($_SESSION['firstNameClientdashboard']);//destroying specific session
    unset($_SESSION['lastNameClientdashboard']);
?>
<script>
    /* still in progress */

function sortable(section, onUpdate){
    var dragEl, nextEl, newPos, dragGhost;
 
    let oldPos = [...section.children].map(item => {
      item.draggable = true
      let pos = document.getElementById(item.id).getBoundingClientRect();
      return pos;
    });
   
    function _onDragOver(e){
        e.preventDefault();
        e.dataTransfer.dropEffect = 'move';
        
        var target = e.target;
        if( target && target !== dragEl && target.nodeName == 'DIV' ){
          if(target.classList.contains('inside')) {
            e.stopPropagation();
          } else {
      //getBoundinClientRect contains location-info about the element (relative to the viewport)
          var targetPos = target.getBoundingClientRect();
           //checking that dragEl is dragged over half the target y-axis or x-axis. (therefor the .5)
          var next = (e.clientY - targetPos.top) / (targetPos.bottom - targetPos.top) > .5 || (e.clientX - targetPos.left) / (targetPos.right - targetPos.left) > .5;    
            section.insertBefore(dragEl, next && target.nextSibling || target);
             
            /*  console.log("oldPos:" + JSON.stringify(oldPos));
             console.log("newPos:" + JSON.stringify(newPos)); */
             /* console.log(newPos.top === oldPos.top ? 'They are the same' : 'Not the same'); */
           console.log(oldPos);
            }
        }   
    }
    
    function _onDragEnd(evt){
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
       
      section.addEventListener('dragstart', function(e){     
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
         
        setTimeout(function (){
            dragEl.classList.add('ghost');
        }, 0)
       
    });
}
                                          
sortable( document.getElementById('list'), function (item){
    /* console.log(item); */
});

/* The setData() method is used to add an item to the drag data, as shown in the following example.

function dragstart_handler(ev) {
  // Add the drag data
  ev.dataTransfer.setData("text/plain", ev.target.id);
  ev.dataTransfer.setData("text/html", "<p>Example paragraph</p>");
  ev.dataTransfer.setData("text/uri-list", "http://developer.mozilla.org"); */


/* you may succeed this a hacky solution. The native draggability doesn't allow CSS styles like: opacity:0;, visibility:hidden or display:none.
But you can do it using: transform:translateX(-9999px).
I've updated your JSFiddle with the solution. */
</script>

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

    var d = new Date();
    var month = d.getMonth()+1;
    var day = d.getDate();
    var output = '-' + (day<10 ? '0' : '') + day + '.' + (month<10 ? '0' : '') + month + '.' + d.getFullYear();

    $('.choose_contact_table').DataTable( {
      "order": [],
      dom: 'Bfrtip',
      "pageLength": 5,
      buttons: [
        {
        extend:    'excelHtml5',
        text:      'excel',
        title: 'Client Dashboard' + output
        },
        {
        extend:    'csvHtml5',
        text:      'csv',
        title: 'Client Dashboard' + output
        },
      ]
    });
    
  });
  
</script>
</html>