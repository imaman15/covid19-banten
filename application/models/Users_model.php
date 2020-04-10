<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Users_model extends CI_Model
{

    private $_table = 'users';

    // getData('select1,select2', ['field1' => var1, 'field2' => var2])
    public function getData($select = NULL, $where = NULL)
    {
        if ($select != NULL) {
            $this->db->select($select);
        } else {
            $this->db->select('*');
        }

        if ($where != NULL) {
            $this->db->where($where);
        }

        $this->db->from($this->_table);
        return $this->db->get();
    }

    public function dataNot($names)
    {
        $this->db->where('active', 1);
        $this->db->where_not_in('id_users', $names);
        $this->db->from($this->_table);
        return $this->db->get();
    }
}

/* End of file Users_model.php */
