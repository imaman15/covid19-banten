<?php

defined('BASEPATH') or exit('No direct script access allowed');

class District extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('district_model');
       
    }

    public function index()
    {
        $id_kabupaten = $this->input->post('id_kabupaten');
        $kabupaten = $this->district_model->listing();

        $value =  json_encode( $kabupaten);
        echo $value;
        
    }

}

?>