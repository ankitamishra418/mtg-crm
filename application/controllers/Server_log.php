<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Server_log extends App_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('emails_model');
        $this->load->library('email');
    }
    public function server_log_mail()
    {
        $this->email->from('service@mauricetrapp.com');
        // $this->email->to("desh@mauricetrapp.com");
        
        $this->email->to("info@visibi.co.nz");
        $this->email->subject('Server Log');
        $this->email->message("Server log file");

        $log_path  = APPPATH . 'logs/syslog';
        $txt_path = APPPATH . 'logs/syslog.txt';
        $log_contents = file_get_contents($log_path);
        file_put_contents($txt_path, $log_contents);

        $syslog_path = APPPATH . 'logs/syslog';
        if (!empty($syslog_path) && file_exists($syslog_path)) {
            $this->email->attach($syslog_path);
        }
   
        $smb_log_path = APPPATH .'logs/smblog/smblog.txt';
        if (!empty($smb_log_path) && file_exists($smb_log_path)) {
            $this->email->attach($smb_log_path);
        }

        $cron_log_path = APPPATH .'logs/cron_logs.txt';
        if (!empty($cron_log_path) && file_exists($cron_log_path)) {
            $this->email->attach($cron_log_path);
        }
        
        if ($this->email->send()) {
            echo 'Email sent successfully!';

            // $cron_log_open = fopen($cron_log_path,'w');

            // if($cron_log_open){
            //     fclose($cron_log_open);
            // }
            return true;
        } else {
            echo $this->email->print_debugger();
            $error_message = $this->email->print_debugger();
            log_message('error', 'Email failed to send: ' . $error_message);
            show_error('Email could not be sent. Please try again later.');
            return false;
        }
    }
}
