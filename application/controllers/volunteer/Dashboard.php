<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        not_login();
        $this->load->model('covid_model');
    }

    public function index()
    {
        $page = 'dashboard';
        if (!file_exists(APPPATH . 'views/volunteer/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $data['title'] = 'Dashboard';
        $data['page'] = $page;
        $data['count'] = $this->covid_model->jumlah();
        $this->load->view('volunteer/templates', $data, FALSE);
    }
}

/* End of file Dashboard.php */
