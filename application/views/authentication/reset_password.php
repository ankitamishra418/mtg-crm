<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $this->load->view('authentication/includes/head.php'); ?>

<style>
::placeholder {
  color: #686767 !important;
  opacity: 1 !important; /* Firefox */
  font-size:15px;
}
  </style>
<body class="authentication reset-password">
 <div class="container">
  <div class="row">
   <div class="col-md-4 col-md-offset-4 authentication-form-wrapper">
    <div class="company-logo">
     <?php echo get_company_logo(); ?>
   </div>
   <div class="mtop40 authentication-form">
    <h1><?php echo _l('admin_auth_reset_password_heading'); ?></h1>
    <?php echo form_open($this->uri->uri_string()); ?>
    <?php echo validation_errors('<div class="alert alert-danger text-center">', '</div>'); ?>
    <?php $this->load->view('authentication/includes/alerts'); ?>
    <?php echo render_input('password','admin_auth_reset_password','','password'); ?>
    <?php echo render_input('passwordr','admin_auth_reset_password_repeat','','password'); ?>
    <div class="form-group">
      <button type="submit" class="btn btn-info btn-block" style="max-width: 150px !important;"><?php echo _l('auth_reset_password_submit'); ?></button>
    </div>
    <?php echo form_close(); ?>
  </div>
</div>
</div>
</div>
</body>
<script>
  document.getElementById("password").placeholder = "Enter New Password";
  document.getElementById("passwordr").placeholder = "Re-enter New Password";
</script>
</html>