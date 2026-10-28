

<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $this->load->view('authentication/includes/head.php'); ?>
<body class="login_admin"<?php if(is_rtl()){ echo ' dir="rtl"'; } ?>>
 <div class="container">
  <div class="row">
   <div class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2 authentication-form-wrapper">
    <div class="company-logo">
      <?php get_company_logo(); ?>
    </div>
    <div class="mtop40 authentication-form" style="text-align: center;">
    <h2 class="text-center mt-4" style="font-size: 30px; width:unset !important; font-family: sans-serif !important; font-weight: bold;">One Time Passsword</br>(OTP) has been sent to your email</h2>
     
      <?php $this->load->view('authentication/includes/alerts'); ?>
      <?php echo form_open("admin/authentication/checkotp"); ?>
      <?php echo validation_errors('<div class="alert alert-danger text-center">', '</div>'); ?>
      <?php hooks()->do_action('after_admin_login_form_start'); ?>
      <div class="form-group">
        <label for="email" class="ms-5" style="color:white;">Enter OTP code below</label>
        <input type="text" id="email" placeholder="Enter OTP " name="otp" class="form-control" autofocus="1">
        <input type="hidden" name="email" id="email" value="<?php echo $email; ?>"/>
        <input type="hidden" name="password" id="email" value="<?php echo $password; ?>"/>
        <input type="hidden" name="remember" id="remember" value="<?php echo $remember; ?>"/>
      </div>
      <div class="form-group">
       <div class="form-group">
        <button type="submit" class="btn btn-info btn-block"><?php echo _l('admin_auth_login_button'); ?></button>
      </div>

      <p style="color: #fff;">If you have not received your OTP within 2 minutes:<br>1. Check your Junk Folder<br>2. If not in Junk Folder then contact the system<br>administrator</p>
      <!-- <p style="color: #fff;">1. Check your Junk Folder</p>
      <p style="color: #fff;">2. If not in Junk Folder then contact the system</p>
      <p style="color: #fff;">administrater</p> -->

      <?php hooks()->do_action('before_admin_login_form_close'); ?>
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
</body>
</html>



