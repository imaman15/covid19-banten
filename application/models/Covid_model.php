<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Covid_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
        $this->load->database();
    
    }

    private $table = 'covid';

    // Listing all kabupaten
    public function listing(){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('id_covid');
        $query = $this->db->get();
        return $query->result();
    }

      // Listing detail kabupaten
      public function listing_kabupaten_detail($id_kabupaten){
        $this->db->select('covid.*, subdistrict.nama_subdistrict');
        $this->db->from($this->table);
        // Join Database
		$this->db->join('subdistrict', 'subdistrict.id_subdistrict = covid.id_subdistrict', 'left');
        // end join
        $this->db->where('covid.id_district', $id_kabupaten);
        $this->db->order_by('id_covid');
        $query = $this->db->get();
        return $query->result();
    }


    // Jumlah keseluruhan
	public function jumlah(){
        $this->db->select('*, 
            SUM(odp) AS tot_odp, 
            SUM(pdp) AS tot_pdp, 
            SUM(positif) AS tot_positif,
            SUM(sembuh) AS tot_sembuh,
            SUM(meninggal) AS tot_meninggal
            ');
		$this->db->from($this->table);
		$this->db->order_by('id_covid');
		$query = $this->db->get();
		return $query->result();
    }
}

/* End of file Covid_model.php */
