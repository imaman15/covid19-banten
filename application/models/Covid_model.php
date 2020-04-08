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

    // Listing all user
    public function listing(){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('id_covid');
        $query = $this->db->get();
        return $query->result();
    }

      // Listing all user
      public function listing_kabupaten_detail($id_kabupaten){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id_district', $id_kabupaten);
        $this->db->order_by('id_covid');
        $query = $this->db->get();
        return $query->result();
    }

    // listing all produk
	public function listing_kabupaten_all(){

		$this->db->select('covid.*,
						district.nama_district,
						');
		$this->db->from('covid');

		// Join Database
		$this->db->join('district', 'district.id_district = covid.id_district', 'left');
		// end join
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
