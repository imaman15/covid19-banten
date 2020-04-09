<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Subdistrict_model extends CI_Model
{

    private $_table = 'subdistrict';
    var $column_order = array(null, 'nama_district', 'nama_subdistrict', null);
    var $column_search = array('nama_district', 'nama_subdistrict');
    var $order = array('id_subdistrict' => 'desc');

    private function _get_datatables_query()
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join('district', $this->_table . '.id_district = district.id_district');

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
        $this->db->from($this->_table);
        return $this->db->count_all_results();
    }
    //=======================================================

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
            $this->db->join('district', $this->_table . '.id_district = district.id_district');
        }

        $this->db->from($this->_table);
        return $this->db->get();
    }

    public function add()
    {
        $post = $this->input->post(NULL, TRUE);
        $data['nama_subdistrict'] = ucwords($post['nama_subdistrict']);
        $data['id_district'] = $post['id_district'];
        $this->db->insert($this->_table, $data);
    }

    public function update()
    {
        $post = $this->input->post(NULL, TRUE);
        $data['nama_subdistrict'] = ucwords($post['nama_subdistrict']);
        $data['id_district'] = $post['id_district'];
        $this->db->where('id_subdistrict', $post["id_subdistrict"]);
        $this->db->update($this->_table, $data);
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, ["id_subdistrict" => $id]);
    }
}

/* End of file Subdistrict_model.php */
