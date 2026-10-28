<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<nav class="navbar navbar-default header">
   <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#theme-navbar-collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
         </button>
               </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="theme-navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="http://3.111.164.22/mtgonline/perfex_crm/knowledge-base">
                     Knowledge Base                  </a>
               </li>
                <li class="customers-nav-item-login">
                  <a href="http://3.111.164.22/mtgonline/perfex_crm/authentication/login">
                     Login                 
                </a>
               </li>
        </ul>
      </div>
      <!-- /.navbar-collapse -->
   </div>
   <!-- /.container-fluid -->
</nav>

<div class="mtop40">
   <div class="col-md-4 col-md-offset-4 text-center">
      <h1 class="text-uppercase mbot20 login-heading">
        OTP Send your Email
      </h1>
   </div>
   <div class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2">
      
      <div class="panel_s">
         <div class="panel-body" style="height: 389px; padding:90px;">
            <form action="<?php echo base_url(); ?>authentication/checkotp" method="get">
              <div class="form-group">
                <label for="email">Enter OTP</label>
                <input type="text" autofocus="true" class="form-control" name="otp" id="otp">
                <?php echo form_error('email'); ?>
              </div>
              <?php if (show_recaptcha_in_customers_area()) { ?>
                <div class="g-recaptcha mbot15" data-sitekey="<?php echo get_option('recaptcha_site_key'); ?>"></div>
                <?php echo form_error('g-recaptcha-response'); ?>
              <?php } ?>
              <div class="checkbox">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">
                    <?php echo _l('clients_login_remember'); ?>
                </label>
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-info btn-block">Submit</button>
                <?php if (get_option('allow_registration') == 1) { ?>
                    <a href="<?php echo base_url(); ?>authentication/checkotp" class="btn btn-success btn-block"><?php echo _l('clients_register_string'); ?>
                    </a>
                <?php } ?>
              </div>
            </form>
         </div>
      </div>
   </div>
</div>
