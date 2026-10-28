<div class="modal modal-credit" tabindex="-1" role="dialog" id="price-confirm">
   <div class="modal-dialog modalwidth modal-dialog-centered" role="document">
      <div class="modal-content p-0">
         <div class="modal-body p-0">
            <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
               <!-- <span aria-hidden="true">&times;</span> -->
               <!-- <img src="closeimg.png"> -->
               <img src="<?= base_url('pricing/') ?>closeimg.png">
            </button>
            <div class="modal-top text-center">
               <!-- <img src="logo.png" class="logomodal-img"> -->
               <img src="<?= base_url('assets/images/logo.png') ?>" class="logomodal-img">
               <!-- <h5 class="modal-name">Teamifyme</h5> -->
               <p class="modaltitleprice m-0"><span id="plan__type">Buy credit</span> at <?= $currencySymbol ?><span id="pricing__amount">468</span> </p>
               <hr class="modaldevider">
               <p class="modal-contact m-0">info@teamifyme.com</p>
            </div>
            <div class="modal-bottom p-4">
              <form method="POST" id="paymentFrm" action="<?= admin_url('wallet_recharge/stripe_recharge')?>"> 
                <input type="hidden" name="total_amount" id="total_amount" value="">
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>" /> 
                     <input type="hidden" name="name" id="name" class="field form-control" placeholder="Enter name" required="" value="<?=  $card_holder_name ?>"> 
                     <input type="hidden" name="email" id="email" class="field form-control" placeholder="Enter email" required=""  value="<?=  $email ?>"> 
                  <!-- <div class="form-group mb-1">
                     <label class="mb-0"><small>Card Number</small></label>
                     <div id="card_number" class="field form-control"></div>
                  </div>
                  <div class="row">
                     <div class="col-lg-6">
                        <div class="form-group mb-1">
                           <label class="mb-0"><small>Expiry Date</small></label>
                           <div id="card_expiry" class="field form-control"></div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="form-group mb-1">
                           <label class="mb-0"><small>CVC Code</small></label>
                           <div id="card_cvc" class="field form-control"></div>
                        </div>
                     </div>
                  </div> -->

                  <div class="input-group mb-0">
                          <div class="input-group-prepend">
                            <span class="input-group-text rounded-bottom-left-0" id="basic-addon1"><i class="fa fa-credit-card"></i></span>
                          </div>
                          <div id="card_number" class="field form-control rounded-0 pl-0"></div>
                        </div>
                        <div class="row">
                           <div class="col-lg-6 col-sm-6 col-xs-6 pr-0">
                              

                              <div class="input-group mb-0">
                                <div class="input-group-prepend">
                                  <span class="input-group-text rounded-bottom-top-0" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                </div>
                                <div id="card_expiry" class="field form-control rounded-0 pl-0"></div>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-6 col-xs-6 pl-0">
                              
                              <div class="input-group mb-0">
                                <div class="input-group-prepend">
                                  <span class="input-group-text rounded-0" id="basic-addon1"><i class="fa fa-lock"></i></span>
                                </div>
                                <div id="card_cvc" class="field form-control rounded-0 pl-0"></div>
                              </div>
                           </div>
                        </div>
                  <div id="paymentResponse"></div>

                 <!--  <div class="form-group checkout-btn mb-0">
                     <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="payreminder">
                        <label class="form-check-label" for="payreminder">
                        Remember me
                        </label>
                     </div>
                  </div> -->
                  <button type="submit" id="payBtn" class="paybtnmodal">Pay</button>
               </form>
            </div>
         </div>
      </div>
   </div>
   <img src="<?= base_url('pricing/') ?>powerd.png" class="powerdby">
</div>