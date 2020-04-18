<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('covid_model');
        $this->load->model('district_model');
    }

    public function index()
    {
        $sum    = $this->covid_model->jumlah();
        $covid  = $this->covid_model->listing();
        $detail = $this->input->post('id_kabupaten');
        $kabupaten = $this->district_model->listing();

        $data     = array(
            'title'    => 'Covid 19 Provinsi Banten',
            'jumlah'    => $sum,
            'covid'     => $covid,
            'detail'    => $detail,
            'kabupaten' => $kabupaten,
            'content'    => 'home/list'
        );
        $this->load->view('layout/index', $data, FALSE);
    }

    public function detail($slug)
    {
        $kabupaten_detail    = $this->covid_model->jumlah_perkabupaten($slug);
        $kabupaten           = $this->district_model->listing();
        $kabupaten_name      = $this->district_model->detail($slug);

        $data     = array(
            'title'            => 'Detail 19 Provinsi Banten',
            'kabupaten'        => $kabupaten,
            'kabupaten_name'   => $kabupaten_name,
            'kabupaten_detail' => $kabupaten_detail,
            'content'          => 'home/detail'
        );
        $this->load->view('layout/index', $data, FALSE);
    }
    
    // data grafik provinsi
    public function data()
    {
        $covid = $this->covid_model->listing_chart();

        $value =  json_encode($covid);
        echo $value;
    }

    // data grafik per kabupaten
    public function data_kabupaten($id_kabupaten)
    {
        $covid = $this->covid_model->listing_kabupaten_detail($id_kabupaten);
        $value =  json_encode($covid);

        echo $value;
    }

}

/* End of file Home.php */
