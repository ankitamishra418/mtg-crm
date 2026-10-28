<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); 
 $currencySymbol='$';  
  if (isIndian() && isIndian()=='IN') { 
      $currencySymbol='Rs.';  
  }
$productinfo =  'Buy credit';
$txnid         = time();
$surl          = admin_url('wallet_recharge/success');
$furl          = admin_url('wallet_recharge/failed');;        
$key_id        = RAZOR_KEY_ID; 
$currency_code = RAZOR_CURENCY_CODE; 
$total         = ($_POST['credit_value']* 100);  
$amount        = $_POST['credit_value'];  
$merchant_order_id= $this->session->userdata('staff_user_id').'__'.rand(100000,999999);
$card_holder_name = $userDetails->firstname.' '.$userDetails->lastname; 
$email            = $userDetails->email;
$phone            = $userDetails->phonenumber;
$name = APPLICATION_NAME;
$return_url = admin_url('wallet_recharge/callback');
?>
<div id="wrapper"> 
  <?php
    // $this->load->view('partials/razorpay_form');
  ?>
  <style type="text/css">
    .dt-table-loading.table, .table-loading .dataTables_filter, .table-loading .dataTables_length, .table-loading .dt-buttons, .table-loading table tbody tr, .table-loading table thead th {
        opacity: 1!important;
    }
  </style>
  <div class="pricingall">
  <form name="razorpay-form" id="razorpay-form" action="<?= $return_url; ?>" method="POST">
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
    <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?= $merchant_order_id; ?>"/>

    <input type="hidden" name="merchant_phone" id="merchant_phone" value="<?= $phone; ?>"/>
    <input type="hidden" name="merchant_email" id="merchant_email" value="<?= $email; ?>"/>

    <input type="hidden" name="merchant_fullname" id="merchant_fullname" value="<?= $card_holder_name; ?>"/>
    <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?= $txnid; ?>"/>
    <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?= $productinfo; ?>"/>
    <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?= $surl; ?>"/>
    <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?= $furl; ?>"/>
    <input type="hidden" name="card_holder_name_id" id="card_holder_name_id" value="<?= $card_holder_name; ?>"/>
    <input type="hidden" name="merchant_total" id="merchant_total" value="<?= $total; ?>"/>
    <input type="hidden" name="merchant_amount" id="merchant_amount" value="<?= $amount; ?>"/>
  </form>
</div>
   <div class="content">
      <div class="row">
         <div class="col-lg-12">
            <div class="panel_s mtop30">
               <div class="panel-body announcement mbot15 tc-content">
                
                   <div class="row">
                   	  <div class="col-lg-9 col-sm-9 col-12">
                   	  	<div class="bycred-flex">
                         <h4>Buy  Now</h4>
                      
                         <form method="post" action="<?= admin_url('wallet_recharge')?>" > 
                          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                            <div class="form-group">
                               <label>Enter Amount</label>
                               <div class="d-flex123" style="display: flex;">
                                <div class="bflex-basis1" style="margin-right: 10px;">
                                  <input type="number" name="credit_value" id="credit_value" placeholder="Enter value..." required class="form-control">
                                </div>

                                <div class="bflex-basis1">
                              <?php if ($currencySymbol=='$') { ?>
                               <a href="javascript::void(0)" class="btn btn-primary" onclick="openPriceModal()">Buy Credit</a>
                               <?php }else{ ?>
                                <!-- <button type="submit" class="btn btn-primary" >Buy Credit</button> -->
                                <input  id="submit-pay" type="button" onclick="razorpaySubmit(this);" value="Buy Credit" class="btn btn-primary" /> 
                              <?php } ?>
                            </div>
                               </div>
                            </div>

                            
                         </form> 
                        </div>
                      </div>

                      <div class="col-lg-3 col-sm-3 col-12">
                      	<div style="border:1px solid; text-align: center; border-radius: 4px; padding: 10px;">
                      		<h4>Credits Remaining</h4>
                      		<p><?= $currencySymbol?> <?= $userData->wallet_total ?? '0' ?></p>
                      	</div>
                      </div>
                   </div>
               </div>

               <div class="panel-body announcement mbot15 tc-content">
                <div style="display: flex;">
                  <p class="maintitlehead">Wallet Log</p>
                  
                </div>
                
                  <!-- <a class="btn btn-success" id="buy__number" href="javascript:void(0);">Buy a Number</a> -->
                  <div class="num-table-sel">
                <div class="table-responsive">
                  <table class="table table-bordered" id="result__number__content">
                    <thead>
                      <tr>
                        <th class="table-numselecthead">Tx.ID</th>
                        <th class="table-numselecthead">Type</th>
                        <th class="table-numselecthead">Payment Mode</th>
                        <th class="table-numselecthead">Total Amount</th>
                        <th class="table-numselecthead">Description</th>
                        <th class="table-numselecthead">Date</th>
                      </tr>
                    </thead>
                    
                  </table>
                </div>
              </div>
               </div>
            </div>
         </div> 
      </div>
   </div>
</div>
<?php
  $this->load->view('partials/strip_form');
?>
<!-- <div class="modal" tabindex="-1" role="dialog" id="price-confirm">
  <div class="modal-dialog buymodalwidth modalwidth modal-dialog-centered" role="document">
    <div class="modal-content p-0"> 
      <div class="modal-body p-0">
         <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close"> 
          <img src="<?= base_url('pricing/') ?>closeimg.png">
        </button>
        <div class="modal-top text-center">
           <img src="<?= base_url('pricing/') ?>logo.png" class="logomodal-img">
           <h5 class="modal-name">TeamifyMe</h5>
           <p class="modaltitleprice m-0">Starter [Annual] at $468</p>
           <hr class="modaldevider">
           <p class="modal-contact m-0">contact@zoomcraft.in</p>
        </div>
        <div class="modal-bottom p-4">
           <form id="credit__value" method="post" action="<?= admin_url('wallet_recharge')?>">
              <div class="form-group m-0">
                 <input type="text" class="form-control border-nonerd" placeholder="Card number">

                 <div class="d-flex">
                    <input type="text" class="form-control firstnoneborder" placeholder="MM/YY">
                    <input type="text" class="form-control secondnoneborder" placeholder="CVC"> 
                 </div>
              </div>

              <div class="form-group checkout-btn mb-0">
                 <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="payreminder">
                    <label class="form-check-label" for="payreminder">
                      Remember me
                    </label>
                  </div>
              </div> 
              <button type="submit" class="paybtnmodal">Pay</button>
           </form>
        </div>
      </div> 
    </div>
  </div>
</div> -->
<?php init_tail(); ?>   
<script type="text/javascript">
     
    $(document).ready(function(){  
         $('#result__number__content').dataTable({
          
            "bProcessing": true,
            "sAjaxSource": "<?= base_url('twilio/twilio_menu/get_wallet_log_data')?>",
            "aoColumns": [
                  { mData: 'tx_id' } ,
                  { mData: 'payment_type' },
                  { mData: 'payment_by' },
                  { mData: 'total_amount' },
                  { mData: 'payment_description' },
                  { mData: 'created_at' }

                ],
                "order":[5, 'desc']
          });   
          
   });  
    </script>
<script type="text/javascript">
function openPriceModal() { 
  var prc = $('#credit_value').val();  
  if (prc == '' || parseInt(prc) <= 0 || prc == 'e') {
    alert('Please enter a valid amount');
  }else{
    $('#pricing__amount').html(prc); 
    $('#total_amount').val(prc); 
    $('#price-confirm').modal({
      backdrop:false, 
      keyboard: false,
      show:true,
    }); 
  }   
  
}
</script>
<!-- Stripe JavaScript library -->
<script src="https://js.stripe.com/v3/"></script>
 <!-- <script src="<?= base_url('pricing/') ?>strp.js"></script> -->
<script type="text/javascript">
   
 // Create an instance of the Stripe object
 // Set your publishable API key
 var stripe = Stripe("<?php echo $this->config->item('stripe_publishable_key'); ?>");
 
 // Create an instance of elements
 var elements = stripe.elements();
 
 var style = {
     base: {
         fontWeight: 400,
         fontFamily: 'Roboto, Open Sans, Segoe UI, sans-serif',
         fontSize: '16px',
         lineHeight: '1.4',
         color: '#555',
         backgroundColor: '#fff',
         '::placeholder': {
             color: '#888',
         },
     },
     invalid: {
         color: '#eb1c26',
     }
 };
 
 var cardElement = elements.create('cardNumber', {
     style: style
 });
 cardElement.focus();
 cardElement.mount('#card_number');
 
 
 var exp = elements.create('cardExpiry', {
     'style': style
 });
 exp.mount('#card_expiry');
 
 var cvc = elements.create('cardCvc', {
     'style': style
 });
 cvc.mount('#card_cvc');
 
 // Validate input of the card elements
 var resultContainer = document.getElementById('paymentResponse');
 cardElement.addEventListener('change', function(event) {
     if (event.error) {
         resultContainer.innerHTML = '<p>'+event.error.message+'</p>';
     } else {
         resultContainer.innerHTML = '';
     }
 });
 
 // Get payment form element
 var form = document.getElementById('paymentFrm');
 
 // Create a token when the form is submitted.
 form.addEventListener('submit', function(e) {
     e.preventDefault();
     createToken();
 });
 
 // Create single-use token to charge the user
 function createToken() {
     stripe.createToken(cardElement).then(function(result) {
         if (result.error) {
             // Inform the user if there was an error
             resultContainer.innerHTML = '<p>'+result.error.message+'</p>';
         } else {
             // Send the token to your server
             stripeTokenHandler(result.token);
         }
     });
 }
 
 // Callback to handle the response from stripe
 function stripeTokenHandler(token) {
     // Insert the token ID into the form so it gets submitted to the server
     var hiddenInput = document.createElement('input');
     hiddenInput.setAttribute('type', 'hidden');
     hiddenInput.setAttribute('name', 'stripeToken');
     hiddenInput.setAttribute('value', token.id);
     form.appendChild(hiddenInput);
    
     // Submit the form
     form.submit();
 }
 
</script>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script> 
  var razorpay_options,razorpay_submit_btn, razorpay_instance;
  var name="<?= $name; ?>";
  var email="<?= $email; ?>";
  var phone="<?= $phone; ?>";
  var cardHolderName="<?= $card_holder_name; ?>";
  $('#credit_value').keyup(function(){
    $('#merchant_total').val($('#credit_value').val() * 100);
    $('#merchant_amount').val($('#credit_value').val() * 100);
    razorpay_options = {
      key: "<?= $key_id; ?>",
      amount: $('#credit_value').val() * 100,
      name: name,
      description: "Order # <?= $merchant_order_id; ?>",
      netbanking: true,
      currency: "<?= $currency_code; ?>",
      prefill: {
        name:cardHolderName,
        email: email,
        contact: phone
      },
      notes: {
        soolegal_order_id: "<?= $merchant_order_id; ?>",
      },
      handler: function (transaction) {
          document.getElementById('razorpay_payment_id').value = transaction.razorpay_payment_id;
          document.getElementById('razorpay-form').submit();
      },
      "modal": {
          "ondismiss": function(){
              window.location.href="<?= admin_url('twilio/twilio_menu/calling_credit') ?>"
          }
      }
    }; 
  }) 
 
  function razorpaySubmit(el){ 
    if(typeof Razorpay == 'undefined'){
      setTimeout(razorpaySubmit, 200);
      if(!razorpay_submit_btn && el){
        razorpay_submit_btn = el;
        el.disabled = true;
        el.value = 'Please wait...';  
      }
    } else {
      if(!razorpay_instance){
        razorpay_instance = new Razorpay(razorpay_options);
        if(razorpay_submit_btn){
          razorpay_submit_btn.disabled = false;
          razorpay_submit_btn.value = "Pay Now";
        }
      }
      razorpay_instance.open();
    }
  }  
</script>
</body>
</html>