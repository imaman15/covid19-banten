<?php

defined('BASEPATH') or exit('No direct script access allowed');

class News_model extends CI_Model
{

    private $_table = 'news';

    // List berita
    public function listing()
    {
        $this->db->select('*');
        $this->db->select('news.*, users.name');
        $this->db->from($this->_table);
        // Join Database
        $this->db->join('users', 'users.id_users = news.id_users', 'left');
        // end join
        $query = $this->db->get();
        return $query->result();
    }

    // Detail berita
    public function detail($slug)
    {
        $this->db->select('news.*, users.name');
        $this->db->from($this->_table);
        // Join Database
        $this->db->join('users', 'users.id_users = news.id_users', 'left');
        // end join
        $this->db->where('news.slug', $slug);
        $query = $this->db->get();
        return $query->result();
    }

    // tambah data
    public function tambah($data)
    {
        $this->db->insert($this->_table, $data);
    }

    public function edit($data)
    {
        $this->db->where('id_news', $data['id_news']);
        $this->db->update($this->_table, $data);
    }

    public function delete($data)
    {
        $this->db->where('id_news', $data);
        $this->db->delete($this->_table);
    }
}

/* End of file News_model.php */
