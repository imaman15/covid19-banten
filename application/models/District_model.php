<?php

defined('BASEPATH') or exit('No direct script access allowed');

class District_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
        $this->load->database();
    
    }

    private $_table = 'district';

     // Listing all user
     public function listing(){
        $this->db->select('*');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result();
    }

     // Listing all user
     public function detail($id_kabupaten){
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('id_district', $id_kabupaten);
        $query = $this->db->get();
        return $query->result();
    }
}

/* End of file District_model.php */
