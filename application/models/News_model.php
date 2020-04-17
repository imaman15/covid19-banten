<?php

defined('BASEPATH') or exit('No direct script access allowed');

class News_model extends CI_Model
{

    private $_table = 'news';

    var $column_order = array('title', 'slug', null, 'kategori', 'tgl_update', 'tgl_publish', 'name', null);
    var $column_search = array('title', 'slug', 'kategori', 'tgl_update', 'tgl_publish', 'name');
    var $order = array('tgl_publish' => 'desc');

    private function _get_datatables_query()
    {
        $this->db->select('*');
        $this->db->select('news.*, users.name');
        $this->db->from($this->_table);
        // Join Database
        $this->db->join('users', 'users.id_users = news.id_users', 'left');
        // end join

        $i = 0;
        foreach ($this->column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->select('*');
        $this->db->select('news.*, users.name');
        $this->db->from($this->_table);
        // Join Database
        $this->db->join('users', 'users.id_users = news.id_users', 'left');
        // end join
        return $this->db->count_all_results();
    }
    //=======================================================

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
        $this->db->where('slug', $data);
        $this->db->delete($this->_table);
    }
}

/* End of file News_model.php */
