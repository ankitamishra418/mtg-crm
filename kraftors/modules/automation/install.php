<?php



defined('BASEPATH') or exit('No direct script access allowed');



if (!$CI->db->table_exists(db_prefix() . 'automation_rule')) {

    $CI->db->query('CREATE TABLE `' . db_prefix() . "automation_rule` (

  `id` int(11) NOT NULL AUTO_INCREMENT,

  `name` varchar(30) DEFAULT NULL,

  `from_department_id` int(11) DEFAULT NULL,

  `to_department_id` int(11) DEFAULT NULL,

  `module_name` varchar(30) DEFAULT NULL,

  `status_id` int(11) DEFAULT NULL,
  
  `to_status_id` int(11) DEFAULT NULL,

  `priority_id` int(11) DEFAULT NULL,

  `to_priority_id` int(11) DEFAULT NULL,

  `start_date` date DEFAULT NULL,

  `end_date` date DEFAULT NULL,

  `description` text DEFAULT NULL,

  `duration_type` varchar(5) DEFAULT NULL,

  `duration` varchar(5) DEFAULT NULL,

  `service_id` int(11) DEFAULT NULL,

  `from_lead_status_id` int(11) DEFAULT NULL,

  `to_lead_status_id` int(11) DEFAULT NULL,

  `from_lead_source_id` int(11) DEFAULT NULL,

  `to_lead_source_id` int(11) DEFAULT NULL,

  `from_role_id` int(11) DEFAULT NULL,

  `to_role_id` int(11) DEFAULT NULL,

  `created_at` timestamp NULL DEFAULT current_timestamp(),

  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),

  PRIMARY KEY (`id`)

) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';'); 

    

}

