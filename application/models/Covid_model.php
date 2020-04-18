<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Covid_model extends CI_Model
{

    private $_table = 'covid';
    // Listing all covid

    var $column_order = array('tgl_publish', 'nama_district', 'nama_subdistrict', 'odp', 'pdp', 'positif', 'sembuh', 'meninggal', null);
    var $column_search = array('tgl_publish', 'nama_district', 'nama_subdistrict', 'odp', 'pdp', 'positif', 'sembuh', 'meninggal');
    var $order = array('tgl_publish' => 'desc');

    private function _get_datatables_query()
    {
        $this->db->select('covid.*, district.nama_district, subdistrict.nama_subdistrict');
        $this->db->from($this->_table);
        // Join Database
        $this->db->join('district', 'district.id_district = covid.id_district', 'left');
        $this->db->join('subdistrict', 'subdistrict.id_subdistrict = covid.id_subdistrict', 'left');
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
        $this->db->select('covid.*, district.nama_district, subdistrict.nama_subdistrict');
        $this->db->from($this->_table);
        // Join Database
        $this->db->join('district', 'district.id_district = covid.id_district', 'left');
        $this->db->join('subdistrict', 'subdistrict.id_subdistrict = covid.id_subdistrict', 'left');
        // end join
        return $this->db->count_all_results();
    }
    //=======================================================

    public function listing()
    {
        $this->db->select('covid.*, district.nama_district, subdistrict.nama_subdistrict');
        $this->db->from($this->_table);
        // Join Database
        $this->db->join('district', 'district.id_district = covid.id_district', 'left');
        $this->db->join('subdistrict', 'subdistrict.id_subdistrict = covid.id_subdistrict', 'left');
        // end join
        $this->db->order_by('tgl_publish');
        $query = $this->db->get();
        return $query->result();
    }

    public function listing_chart()
    {
        $this->db->select('covid.*, 
                LEFT(tgl_publish, 10) AS today, 
                SUM(odp) AS tot_odp, 
                SUM(pdp) AS tot_pdp, 
                SUM(positif) AS tot_positif,
                SUM(sembuh) AS tot_sembuh,
                SUM(meninggal) AS tot_meninggal,
                subdistrict.nama_subdistrict');
        $this->db->query("SELECT LEFT(tgl_publish, 10) FROM covid ");
        $this->db->from($this->_table);
        // Join Database
        $this->db->join('district', 'district.id_district = covid.id_district', 'left');
        $this->db->join('subdistrict', 'subdistrict.id_subdistrict = covid.id_subdistrict', 'left');
        // end join
        $this->db->group_by('today');
        $this->db->order_by('tgl_publish');
        $this->db->limit(30);
        $query = $this->db->get();
        return $query->result();
    }


    public function detail($id_covid)
    {
        $this->db->select('covid.*, district.nama_district, subdistrict.nama_subdistrict');
        $this->db->from($this->_table);
        // Join Database
        $this->db->join('district', 'district.id_district = covid.id_district', 'left');
        $this->db->join('subdistrict', 'subdistrict.id_subdistrict = covid.id_subdistrict', 'left');
        // end join
        $this->db->where('id_covid', $id_covid);
        $this->db->order_by('tgl_publish');
        $query = $this->db->get();
        return $query->result();
    }


    // Listing detail kabupaten
    public function listing_kabupaten_detail($id_kabupaten)
    {
        $this->db->select('covid.*, 
            LEFT(tgl_publish, 10) AS today, 
            SUM(odp) AS tot_odp, 
            SUM(pdp) AS tot_pdp, 
            SUM(positif) AS tot_positif,
            SUM(sembuh) AS tot_sembuh,
            SUM(meninggal) AS tot_meninggal,
            subdistrict.nama_subdistrict');
        $this->db->query("SELECT LEFT(tgl_publish, 10) FROM covid ");
        $this->db->from($this->_table);
        // Join Database
        $this->db->join('subdistrict', 'subdistrict.id_subdistrict = covid.id_subdistrict', 'left');
        // end join
        $this->db->where('covid.id_district', $id_kabupaten);
        $this->db->group_by('today');
        $this->db->order_by('tgl_publish');
        $this->db->limit(30);
        $query = $this->db->get();
        return $query->result();
    }

    public function tambah($data)
    {
        $this->db->insert($this->_table, $data);
    }

    public function edit($data)
    {
        $this->db->where('id_covid', $data['id_covid']);
        $this->db->update($this->_table, $data);
    }

    public function delete($data)
    {
        $this->db->where('id_covid', $data);
        $this->db->delete($this->_table);
    }

    // Jumlah keseluruhan
    public function jumlah()
    {
        $this->db->select('*, 
            SUM(odp) AS tot_odp, 
            SUM(pdp) AS tot_pdp, 
            SUM(positif) AS tot_positif,
            SUM(sembuh) AS tot_sembuh,
            SUM(meninggal) AS tot_meninggal
            ');
        $this->db->from($this->_table);
        $this->db->order_by('id_covid');
        $query = $this->db->get();
        return $query->result();
    }


    // Jumlah keseluruhan
    public function jumlah_perkabupaten($slug)
    {
        $this->db->select('*, 
            SUM(odp) AS tot_odp, 
            SUM(pdp) AS tot_pdp, 
            SUM(positif) AS tot_positif,
            SUM(sembuh) AS tot_sembuh,
            SUM(meninggal) AS tot_meninggal,
            district.id_district,
            district.nama_district
            ');
        $this->db->from($this->_table);
        // join database
        $this->db->join('district', 'district.id_district = covid.id_district', 'left');
        // end join
        $this->db->where('district.slug', $slug);
        $this->db->order_by('tgl_publish');
        $query = $this->db->get();
        return $query->result();
    }

    public function activity()
    {
        $this->db->select('covid.tgl_publish,district.nama_district as kabupaten, subdistrict.nama_subdistrict as kecamatan, users.name ');
        $this->db->from($this->_table);
        // Join Database

        $this->db->join('users', 'users.id_users = covid.id_users', 'left');
        $this->db->join('district', 'district.id_district = covid.id_district', 'left');
        $this->db->join('subdistrict', 'subdistrict.id_subdistrict = covid.id_subdistrict', 'left');
        // end join
        $this->db->order_by('tgl_publish', 'desc');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result();
    }
}

/* End of file Covid_model.php */
