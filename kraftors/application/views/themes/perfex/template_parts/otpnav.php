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
                <li class="customers-nav-item-knowledge-base" >
                  <a href="<?php echo base_url(); ?>/knowledge-base">
                     Knowledge Base                  </a>
               </li>
                <li class="customers-nav-item-login">
                  <a href="<?php echo base_url(); ?>/authentication/login">
                     Login                 
                </a>
               </li>
        </ul>
      </div>
      <!-- /.navbar-collapse -->
   </div>
   <!-- /.container-fluid -->
</nav>