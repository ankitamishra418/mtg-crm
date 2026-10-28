<?php

namespace app\modules\exports\services;

use CI_DB_mysqli_driver;

class PolicyCSVExport extends CSVExport
{
    private array $excludedFields = [
        // 'policy_number',
        // 'provider',
        // 'start_date',
        // 'policy_free',
        // 'total_premium',
        // 'cover_type',
        // 'policy_status',
    ];

    public function __construct(?string $fromDate, ?string $toDate)
    {
        parent::__construct($fromDate, $toDate);
        $this->ci->load->model('Policy_model');
    }
    
    public function queryData(): CI_DB_mysqli_driver
    {
        $this->ci->db->select('*');
        return $this->ci->db->from(db_prefix() . 'policy');
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
