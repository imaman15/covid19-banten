<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Team extends CI_Controller
{

    public function index()
    {
        $data 	= array( 'title'	=> 'Relawan',
                        'content'	=> 'team/list'
                );
        $this->load->view('layout/index', $data, FALSE);
    }
}

/* End of file Team.php */
