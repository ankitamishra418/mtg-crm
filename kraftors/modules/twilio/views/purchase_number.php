<?php defined('BASEPATH') or exit('No direct script access allowed'); ?> 
<?php init_head(); 
$curencySymbol='$'; 
$TWILIO_COST_INR  = TWILIO_COST; 
$TWILIO_CALL_COST  = TWILIO_CALL_COST; 
if (isIndian() && isIndian()=='IN') { 
  $curencySymbol='Rs.';//'रु';  
  $TWILIO_COST_INR  = TWILIO_COST_INR;
  $TWILIO_CALL_COST  = TWILIO_CALL_COST_INR;
}
?>
<style>
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<div id="wrapper"> 
   <div class="content">
      <div class="row">
         <div class="col-lg-12">
            <div class="panel_s mtop30">
               <div class="panel-body announcement mbot15 tc-content">
               	<p class="maintitlehead">Purchase a phone number for your current project or sub-account.2</p>

               	<div class="row">
               		<div class="col-lg-3 col-sm-4 col-12">
               			<div class="form-group">
               				<label>Select Country</label>
               				<select class="form-control" id="available__country">
               					<option value="">Select Country</option> 
               				</select>
               			</div>
               		</div>

               		<div class="col-lg-3 col-sm-4 col-12">
               			<div class="form-group">
               				<label>Select Type</label>
               				<select class="form-control" id="number__type">
               					<option value="tollFree">Tollfree</option> 
               					<option value="local">Local</option>
               				</select>
               			</div>
               		</div>

               		<div class="col-lg-2 col-sm-3 col-12">
               			<div class="form-group">
               				<a href="javascript:void(0);" class="btn btn-info mt-2 btn-block" id="search__number">Search</a>
               			</div>
               		</div>
               	</div>
               	<div class="row">
               		<div class="col-lg-8 col-sm-8 col-12">
               			<div class="num-table-sel">
			         		<div class="table-responsive">
			         			<table class="table table-bordered" id="result__number__content">
			         				<thead>
			         					<tr>
			         						<th class="table-numselecthead">Number</th>
			         						<th class="table-numselecthead">Type</th>
			         						<th class="table-numselecthead">Capabilities</th>
			         						<th class="table-numselecthead">Monthly fee</th>
                          <th class="table-numselecthead">Calling fee</th>
			         						<th class="table-numselecthead">Select</th>
			         					</tr>
			         				</thead>
			         				<tbody>
			         					 <tr>
                          <td colspan="4" style="text-align: center;">
                            <div class="loader"></div>
                          </td>       
                         </tr>
			         				</tbody>
			         			</table>
			         		</div>
			         	</div>
               		</div>

               		<div class="col-lg-4 col-sm-4 col-12">
               			<div class="buying-class-phone">
               				<h4>Buying Phone Number</h4>
               				<p>To start using the phone number, you need to purchase them.</p>
               				<p>You can purchase mutiple local numbers from various countries, and make and receive calls from anywhere in the world.</p>
               				<p>While Purchasing phone numbers of few countries, you will we prompted to enter a local address.</p>
               				<p>You can purchase toll-free numbers for US, UK or Canada.</p>
               				<p>After purchasing phone-number, you can assign them to multiple sales reps.</p>
               			</div>
               		</div>
               	</div>
                	<!-- <a class="btn btn-success" id="buy__number" href="javascript:void(0);">Buy a Number</a> -->
                	
               </div>
            </div>
         </div>
        
      </div>
   </div>
</div>

<?php init_tail(); ?> 

<div class="modal modalallcallconfirm" tabindex="-1" role="dialog" id="buyconfirm">
  <div class="modal-dialog" role="document">
  	<form action="<?= admin_url('twilio/twilio_menu/purchaseNumber') ?>" method="post">
  		<input type="hidden" name="phoneNumber" id="phoneNumber" value="">
  		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>" />
	    <div class="modal-content">
	      <div class="modal-header bg-modaltitle">
	        <h6 class="modal-title">Your select phone number: +<span id="confirm__number">123</span></h6>
	      </div>
	      <div class="modal-body">
	        <p class="confirm-content">This phone number will cost you <?= $curencySymbol.$TWILIO_COST_INR ?>/month from your available credits.</p>
          <p class="confirm-content">Calling cost <?= $curencySymbol.$TWILIO_CALL_COST ?>/min from your available credits.</p>
	      </div>
	      <div class="modal-footer">
           <?php 
            if ($userData->wallet_total >= $TWILIO_COST_INR) { ?>
      	      	<span class="avaprice">Available credit : <?= $curencySymbol.' '.$userData->wallet_total ?></span>
      	        <div class="modal-btnconfirm"> 
      	        	<button type="submit" class="btn btn-primary">Confirm</button>
      	        	<button type="button" class="btn btn-cancel-modal" data-dismiss="modal">Cancel</button>
      	        </div>
            <?php }else{ ?>
              <span class="avaprice" style="color: red"><b >Note:</b> Insufficient credit please buy credit first </span>
              <br>
              <span class="avaprice">Available credit :<?= $curencySymbol.' '.$userData->wallet_total ?></span>
              <div class="modal-btnconfirm"> 
                <a href="<?= base_url('twilio/twilio_menu/calling_credit') ?>" class="btn btn-warning">Buy</a>
                <button type="button" class="btn btn-cancel-modal" data-dismiss="modal">Cancel</button>
              </div>
            <?php } ?>
	      </div> 
	    </div>
    </form>
  </div>
</div>
 <script type="text/javascript">
 	 // Get Twilio Available Phone number
$(function(){
  $(document).on('click','#search__number',function(){ 
      country = $('#available__country').val(); 
	  
      type    = $('#number__type').val();  
      url = "<?= admin_url('twilio/twilio_menu/getTwilioAvailabeNumber/') ?>"+country+'/'+type; 
      getNumber(url); 
  });
})
$(document).on('click','#buy__number',function(){ 
      url = "<?= admin_url('twilio/twilio_menu/getTwilioAvailabeNumber') ?>"; 
     getNumber(url); 
})

function confirmNumber(argument) { 
 	$('#confirm__number').html(argument);
 	$('#phoneNumber').val(argument);
 	$('#buyconfirm').modal('show');

 }

function getNumber(url) {
 	var posting = $.get( url);  
    posting.done(function( data ) {
       // var content = $( data ).find( "#content" );
    	$( "#result__number__content tbody" ).empty().append( data ); 
    });
}
$(window).on('load', function () {

    url = "<?= admin_url('twilio/twilio_menu/getTwilioAvailabeNumber') ?>"; 
    
    getNumber(url);
  urlC = "<?= admin_url('twilio/twilio_menu/availableCountry') ?>"; 
  var posting = $.get( urlC);  
    posting.done(function( data ) { 
		console.log(data);
      $( "#available__country" ).empty().append( data ); 
    });
 });
 
 
   
 </script>
</body>
</html>