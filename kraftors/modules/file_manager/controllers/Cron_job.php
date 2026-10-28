<?php


// defined('BASEPATH') or exit('No direct script access allowed');

class Cron_job extends App_Controller
{
	public function __construct()
    {
        parent::__construct();
        print_r('fdg');
        exit;
        $this->load->model('file_model');
        // $se = send_mail_template('staff_reminder', 'amit.verma@nbgspl.com','1', 'fdsfdsgfgdu');
        //   if($se){
        //       echo'success';
        //   }else{
        //       echo'failed';
        //   }
      
    }

	public function index()
	{
	 echo "helloqqqqqqqqqq 123445465";die;
	   $se = send_mail_template('staff_reminder', 'amit.verma@nbgspl.com','1', 'fdsfdsgfgdu');
       if($se){
           echo'hello123';
       }else{
           echo'failed';
       }
	 die();
	}
	
	
}