<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
       
    }

    public function index()
    {
        $data 	= array( 'title'	=> 'Covid 19 Provinsi Banten',
						 'content'	=> 'home/list'
					);
		$this->load->view('layout/index', $data, FALSE);
    }
}

/* End of file Home.php */
