<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Team extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('users_model');
    }

    public function index()
    {
        $data     = array(
            'title'    => 'Relawan',
            'content'    => 'team/list',
            'dev' => $this->users_model->getData(NULL, 'id_users <= 2')->result(),
            'volunteer' => $this->users_model->dataNot([1, 2, 3])->result(),
            'tektime' => 'Diperbarui'
        );
        $this->load->view('layout/index', $data, FALSE);
    }
}

/* End of file Team.php */
