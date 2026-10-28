<?php defined('BASEPATH') or exit('No direct script access allowed'); ?> 
<?php init_head(); ?>
<div id="wrapper"> 
   <div class="content">
      <div class="row">
         <div class="col-lg-12">
            <div class="panel_s mtop30">
              <div class="panel-body announcement mbot15 tc-content">
                <p class="maintitlehead">Call Logs - Filterable call history with recordings.</p>

                <div class="row">
                  <div class="col-lg-3 col-sm-4 col-12">
                    <div class="form-group">
                      <label><?= _l('staff'); ?></label>
                        <select name="staff" class="selectpicker" id="staff" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">  
                               <option value=""></option>        
                              <?php foreach($staff as $s){ ?> 
                              <option value="<?php echo htmlspecialchars($s['staffid']); ?>"  <?php if(isset($contracts) && $contracts[0]['staff'] == $s['staffid'] ){echo 'selected';} ?>> <?php echo htmlspecialchars($s['firstname']).' '.htmlspecialchars($s['lastname']); ?></option>                   

                              <?php }?>

                            </select>
                    </div>
                  </div>

                  <div class="col-lg-3 col-sm-4 col-12">
                    <div class="form-group">
                      <label>Date</label>
                      <input type="date" id="filter__date" name="filter_date" value="" class="form-control">
                    </div>
                  </div>

                  <div class="col-lg-3 col-sm-4 col-12" style="margin-top: 26px;">
                    <div class="form-group">
                     <button type="button" class="btn btn-info" id="filter__call">Filter</button>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-4 col-12" style="margin-top: 26px;">
                    <div class="form-group">
                    <a class="btn btn-success" id="call__log" href="<?= admin_url('twilio/twilio_menu/getTwilioLog') ?>">Sync Call History</a>
                    </div>
                  </div>

                  <!-- <div class="col-lg-2 col-sm-3 col-12">
                    <div class="form-group">
                      <button class="btn btn-info mt-2 btn-block">Search</button>
                    </div>
                  </div> -->
                </div>
                <div class="row">
               <div class="col-md-12" id="small-table">
                  <div class="panel_s">
                     <div class="panel-body"> 
                         <?php

                        $table_data = array(
                              _l('id') . ' #',
                              _l('From'),
                              _l('Duration'),
                              _l('Date'),
                              _l('Contact/Lead/Company'),
                              _l('User'),
                              _l('Recording'), 
                            ); 

                        // $custom_fields = get_custom_fields('staff',array('show_on_table'=>1));

                        // foreach($custom_fields as $field){ 
                        //   array_push($table_data,$field['name']); 
                        // }

                        render_datatable($table_data,'table_staff');

                        ?>
                     </div>
                  </div>
               </div> 
            </div>
               
              </div>
               <!-- <div class="panel-body announcement mbot15 tc-content">
                  <div class="call-sidebar"> 
                     <hr class="callsidebar-hr">
                     <div id="result__log__content"></div> 
                  </div> 
                  <div class="dialpad-container">
                    <div class="pad" id="controls">
                      <div id="info" style="display:none;">
                          <p class="instructions">Twilio Client</p>
                          <div id="client-name"></div>
                          <div id="output-selection">
                            <label>Ringtone Devices</label>
                            <select id="ringtone-devices" multiple></select>
                            <label>Speaker Devices</label>
                            <select id="speaker-devices" multiple></select><br/>
                            <a id="get-devices">Seeing unknown devices?</a>
                          </div>
                        </div>
                      <form id="phone__call" method="post" > 
                     <div class="dial-pad">
                     
                      <br>
                        <div class="phoneString">
                           <input type="text" name="phone-number" id="phone-number" value="+" maxlength="16">
                           <input type="hidden" name="caller__id" id="caller__id" value="+" maxlength="16">
                        </div>
                       
                     </div>
                     <div id="controls">
                        <div id="call-controls" style="display: block;">
                          <input id="phone-number" type="hidden" placeholder="Enter a phone # or client name"> 
                           <button id="button-call" class="btn btn-info">
                           <- <img src="https://cdn2.iconfinder.com/data/icons/font-awesome/1792/phone-512.png" class="callImg"> --
                           <i class="fa fa-phone callImg"></i>
                           </button>
                           <button type="button" id="button-hangup" class="btn btn-danger" style="display:none;">
                           <!- <img src="https://cdn2.iconfinder.com/data/icons/font-awesome/1792/phone-512.png" class="callImg"> --
                           <i class="fa fa-phone callImg"></i>
                           </button>
                        </div>
                         <div id="volume-indicators" style="display: none;">
                            <label>Mic Volume</label>
                            <div id="input-volume"></div><br/><br/>
                            <label>Speaker Volume</label>
                            <div id="output-volume"></div>
                          </div>
                         <div id="log" style="display: none;"></div>
                     </div>
                   <!-</form>  -- 
                  </div>
                  </div>
               </div> -->
            </div>
         </div>
        
      </div>
   </div>
</div>
<?php $this->load->view('partials/player_audio') ?>
<?php init_tail(); ?> 
<script type="text/javascript">  
 
     var StaffServerParams = { 
        "staff": "select[name='staff']", 
        "fdate": "input[name='filter_date']", 
    }; 
    table_staff = $('table.table-table_staff'); 
    initDataTable(table_staff,admin_url+'twilio/twilio_menu/table', '','', StaffServerParams);
   
 // initDataTable('.table-proposals', admin_url+'twilio/twilio_menu/table', ['undefined'], ['undefined'], '', [7, 'desc']);
   $('.number-dig').click(function(){
     //add animation
     addAnimationToButton(this);
     //add number
     var currentValue = $('.phoneString input').val();
     var valueToAppend = $(this).attr('name');
     $('.phoneString input').val(currentValue + valueToAppend);
     
     // checkNumber();
   });
   
   
   var timeoutTimer = true;
   var timeCounter = 0;
   var timeCounterCounting = true;
   
   $('.action-dig').click(function(){
     //add animation
     addAnimationToButton(this);
     if($(this).hasClass('goBack')){
       var currentValue = $('.phoneString input').val();
       var newValue = currentValue.substring(0, currentValue.length - 1);
       $('.phoneString input').val(newValue);
        
     } 
   }); 
   
   var addAnimationToButton = function(thisButton){
     //add animation
     $(thisButton).removeClass('clicked');
     var _this = thisButton;
     setTimeout(function(){
       $(_this).addClass('clicked');
     },1);
   };
   
   
   
</script>
<script>
   $(".contactnumbername").click(function(){
   	var callno = $(this).find(".namevalue").text();
   	$(".phoneString input").val(callno);
   })
   
   // $("#button-call").click(function(){
   // 	$("#button-hangup").show();
   // 	$("#button-call").hide();
   // })
   
  $("#button-hangup").click(function(){
   	$(this).hide();
   	$("#button-call").show(); 
  })
 // Twilio Call log

 // $(document).on('click','#call__log',function(){
 //      call_number = 0;
 //      url = "<?= admin_url('dashboard/getTwilioLog') ?>";
 //      // Send the data using post
 //      var posting = $.post( url, { phoneNumber: call_number } );
     
 //      // Put the results in a div
 //      posting.done(function( data ) {
 //        // var content = $( data ).find( "#content" );
 //        $( "#result__log__content" ).empty().append( data );
 //      });
 // })


</script>
 
<!-- <script type="text/javascript" src="<?= base_url('assets/twl/')?>twilio.min.js"></script>  
<script src="<?= base_url('assets/twl/')?>quickstart.js"></script> -->
<script type="text/javascript">
  // Desimal Number Allowed start

   // $(function () {
   //    $('#credit_value').on('input', function(e) {
   //        if (/^(\d+(\.\d{0,2})?)?$/.test($(this).val())) {
   //            // Input is OK. Remember this value
   //            $(this).data('prevValue', $(this).val());
   //        } else {
   //            // Input is not OK. Restore previous value
   //            $(this).val($(this).data('prevValue') || '');
   //        }
   //    }).trigger('input'); // Initialise the `prevValue` data properties
   // });
   //Charactor allow
   $('.phoneString input').bind('input', function() {
   var c = this.selectionStart,
   r = /[^+0-9 .]/gi,
   v = $(this).val();
   if(r.test(v)) {
   $(this).val(v.replace(r, ''));
   c--;
   }
   this.setSelectionRange(c, c);
   });

$(function(){
  $('#selected__caller__id').on('change', function(){
    var id= $(this).val();
    $('#caller__id').val(id);
  });
  var id= $('#selected__caller__id').val();
  $('#caller__id').val(id);

  $('#download_button').click(function(){
    var url = "https://api.twilio.com/2010-04-01/Accounts/AC08aa55c8388025012e24ab6daa80c46d/Recordings/"+sid+".mp3"
    top.location.href = filepath;
  });

  $('#filter__call').on('click',function(){ 
   
    table_staff.DataTable().ajax.reload() 
          .columns.adjust() 
          .responsive.recalc()
          .order([3, 'desc']);
          
    // $('#filter__date').val('0');
  })
})

function playRecording(sid,id ) {
  var url = "https://api.twilio.com/2010-04-01/Accounts/AC08aa55c8388025012e24ab6daa80c46d/Recordings/"+sid+".mp3"
  $('#player__frame').modal('show');
  $('#player_frame').attr('src', url);
}

function getRecording(sid ) {
  var url = "https://api.twilio.com/2010-04-01/Accounts/AC08aa55c8388025012e24ab6daa80c46d/Recordings/"+sid+".mp3"
  top.location.href = url;
}


</script>
</body>
</html>