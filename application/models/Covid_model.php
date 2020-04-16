<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Covid_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private $_table = 'covid';
    // Listing all covid
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
        $this->db->where('covid.slug', $slug);
        $this->db->order_by('tgl_publish');
        $query = $this->db->get();
        return $query->result();
    }
}

/* End of file Covid_model.php */
