<?php

namespace app\modules\exports\services;

use CI_DB_mysqli_driver;

class FilesCSVExport extends CSVExport
{
    private array $excludedFields = [
        // 'id',
        // 'rel_id',
        // 'file_name',
        // 'filename_Notencript',
        // 'client_file_discription',
        // 'filetype',
        // 'visible_to_customer',
        // 'external',
        // 'external_link',
        // 'thumbnail_link',
        // 'staffid',
        // 'dateadded',
        // 'category_name',
        // 'compliance_name',
    ];

    public function __construct(?string $fromDate, ?string $toDate)
    {
        parent::__construct($fromDate, $toDate);
        $this->ci->load->model('Clients_model');
    }
    
    public function queryData(): CI_DB_mysqli_driver
    {
        $this->ci->db->select('*');
        return $this->ci->db->from(db_prefix() . 'files');

       
    }
   

    protected function formatHeading(string $header): string
    {
        return parent::formatHeading($header);
    }

    protected function formatRow(string $name, $value, array $row)
    {   
        return parent::formatRow($name, $value, $row);
    }

    public function excludedFields() : array
    {
        return $this->excludedFields;
    }
}
