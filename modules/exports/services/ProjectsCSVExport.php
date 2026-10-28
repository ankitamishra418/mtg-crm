<?php

namespace app\modules\exports\services;

use CI_DB_mysqli_driver;

class ProjectsCSVExport extends CSVExport
{
    private array $excludedFields = [
        // 'name',
        // 'description',
        // 'status',
        // 'clientid',
        // 'total_premium',
        // 'billing_type',
        // 'start_date',
        // 'deadline',
        // 'project_created',
        // 'date_finished',
        // 'progress',
        // 'progres_from_tasks',
    ];

    public function __construct(?string $fromDate, ?string $toDate)
    {
        parent::__construct($fromDate, $toDate);
        $this->ci->load->model('Projects_model');
    }

    public function queryData(): CI_DB_mysqli_driver
    {
        $this->ci->db->select('*');
        return $this->ci->db->from(db_prefix() . 'projects');

       
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
