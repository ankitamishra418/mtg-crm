<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Choose_contacts_model extends App_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Get consent purposes
     * @param  mixed $user_id contact id or lead id
     * @param  string $for     contact or lead
     * @return array
     */
    

    public function get_consents($id)
    {
        $this->db->select('email');
        $this->db->from('contacts');
        $this->db->where('userid=',$id);
        $queryN = $this->db->get();
        $queryN = $queryN->result_array();
        $this->db->select('*');
        $this->db->from('contacts');
        $this->db->where('userid!=',$id);
        $this->db->group_by('email');
        $query1 = $this->db->get();
        $query1 = $query1->result_array();
        $contactCollection = [];
        foreach ($query1 as $row1) {
            if (!in_array($row1['email'], $queryN[0])) {
                $this->db->select('*');
                $this->db->from('contact_company_link');
                $this->db->where('contact_id=', $row1['id']);
                $this->db->where('company_id=', $id);
                $query2 = $this->db->get();
                $query2 = $query2->result_array();
                if (empty($query2)) {
                    $contactCollection[] = $row1;
                }
            }
        }
        return $contactCollection;
    }

    public function insertcontact($data)
    {
        $result=$this->db->insert('contact_company_link',$data);
        $lastid=$this->db->insert_id();
        return $lastid;
    }

    public function get_selectdata($selected_contacts)
    {
        $id =$selected_contacts;
        $this->db->select('*');
        $this->db->from('contacts');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query = $query->result_array();
    }

    public function get_selectdata_insert($data)
    {
        $result=$this->db->insert('contacts',$data);
        $lastid=$this->db->insert_id();
        
        return $lastid;
    }

    public function get_allCompanies($email)
    {
        $this->db->select('userid');
        $this->db->from('contacts');
        $this->db->where('email',$email);
        $contacts = $this->db->get();
        $userIds = $contacts->result_array();
        $companyCollection = [];
        foreach ($userIds as $userId) {
            $companyCollection[] = $userId['userid'];
        }
        $this->db->select('*');
        $this->db->from('clients');
        $this->db->where_in('userid',$companyCollection);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function permissions_insert($data)
    {
        $result=$this->db->insert('contact_permissions',$data);
        $lastid=$this->db->insert_id();
        return $lastid;
    }
    
}
