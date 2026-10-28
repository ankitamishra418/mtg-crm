<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="mtop40">
   <div class="col-md-4 col-md-offset-4 text-center">
      <h1 class="text-uppercase mbot20 login-heading">
        Please choose a company
      </h1>
   </div>
   <div class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2">
      
      <div class="panel_s">
      <?php if($this->session->flashdata('invalid')){ ?>
            <div class="alert alert-primary text-center mt-2" id="invalid" role="alert">
                <?php echo $this->session->flashdata('invalid'); ?>
            </div>
    <?php } ?> 
         <div class="panel-body" style="height: 389px; padding:90px;">
         <?php echo form_open("authentication/afterChooseCompany"); ?>
              <div class="form-group">
                <label for="email">Company</label>
                <select name="selectCompany" id="selectCompany">
                  <option value="0">Choose Company</option>
                  <?php
                  foreach ($allCompany as $company) { ?>
                    <option value="<?php echo $company['userid'] ?>"><?php echo $company['company'] ?></option>
                  <?php } ?>
                </select>
                <input type="hidden" name="email" id="email" value="<?php echo $email; ?>"/>
                <input type="hidden" name="password" id="email" value="<?php echo $password; ?>"/>
                <input type="hidden" name="remember" id="remember" value="<?php echo $remember; ?>"/>
                <?php echo form_error('email'); ?>
              </div>
              <?php if (show_recaptcha_in_customers_area()) { ?>
                <div class="g-recaptcha mbot15" data-sitekey="<?php echo get_option('recaptcha_site_key'); ?>"></div>
                <?php echo form_error('g-recaptcha-response'); ?>
              <?php } ?>
              <div class="form-group">
                <button type="submit" class="btn btn-info btn-block">Submit</button>
                <?php if (get_option('allow_registration') == 1) { ?>
                    <a href="" class="btn btn-success btn-block"><?php echo _l('clients_register_string'); ?>
                    </a>
                <?php } ?>
              </div>
          <?php echo form_close(); ?>
         </div>
      </div>
   </div>
</div>

<script>
  $(document).ready(function () {
    $('#invalid').text();
        $("#invalid").show();
        $("#invalid").fadeOut(8000);
        $("#invalid").css('color','red');
  });
</script>

