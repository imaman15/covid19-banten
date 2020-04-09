<?php

defined('BASEPATH') or exit('No direct script access allowed');

class News_model extends CI_Model
{

    private $_table = 'news';

    // List berita
    public function listing(){
        $this->db->select('*');
        $this->db->from($this->_table);
        $query = $this->db->get();
        return $query->result();
    }

     // Detail berita
     public function detail($id_news){
        $this->db->select('news.*, users.name');
        $this->db->from($this->_table);
        // Join Database
		$this->db->join('users', 'users.id_users = news.id_users', 'left');
        // end join
        $this->db->where('news.id_news', $id_news);
        $query = $this->db->get();
        return $query->result();
    }
}

/* End of file News_model.php */
