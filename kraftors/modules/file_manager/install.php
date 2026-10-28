<?php

defined('BASEPATH') or exit('No direct script access allowed');


//add_option('acc_first_month_of_financial_year', 'January');


if (!$CI->db->table_exists(db_prefix() . 'filemanager')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . "filemanager` (
  	`id` INT(11) NOT NULL AUTO_INCREMENT,
	  `filename` VARCHAR(255) NOT NULL,
	  `category_id` INT(11) NULL,
    `subcategory_id` INT(11) NULL,
    `addfrom` INT(11) NULL,
	  `description` INT(11) TEXT NULL,
	  `file` VARCHAR(255) NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}

if (!$CI->db->table_exists(db_prefix() . 'file_category')) {
    $CI->db->query('CREATE TABLE `' . db_prefix() . "file_category` (
      `id` INT(11) NOT NULL AUTO_INCREMENT,
      `name` VARCHAR(100) NOT NULL,
      `description` TEXT NULL,
      `datecreated` DATETIME NULL,
      `addfrom` INT(11) NULL,
      `status` INT(11) NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}

if (!$CI->db->table_exists(db_prefix() . 'file_subcategory')) {
  $CI->db->query('CREATE TABLE `' . db_prefix() . "file_subcategory` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `category_id` VARCHAR(100) NOT NULL,
    `description` TEXT NULL,
    `addfrom` INT(11) NULL,
    `datecreated` DATETIME NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=" . $CI->db->char_set . ';');
}

// if (!$CI->db->field_exists('reconcile' ,db_prefix() . 'acc_account_history')) {
//   $CI->db->query('ALTER TABLE `' . db_prefix() . 'acc_account_history`
//     ADD COLUMN `reconcile` INT(11) NOT NULL DEFAULT 0;');
// }


// if (!$CI->db->field_exists('item' ,db_prefix() . 'acc_account_history')) {
//   $CI->db->query('ALTER TABLE `' . db_prefix() . 'acc_account_history`
//     ADD COLUMN `item` INT(11) NULL,
//     ADD COLUMN `paid` INT(1) NOT NULL DEFAULT 0;');
// }
