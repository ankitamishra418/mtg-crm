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