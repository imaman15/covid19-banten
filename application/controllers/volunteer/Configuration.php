<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Configuration extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        not_login(2);
    }

    public function index()
    {
        $page = 'configuration';
        if (!file_exists(APPPATH . 'views/volunteer/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $data['title'] = 'Konfigurasi';
        $data['page'] = $page;
        $this->load->view('volunteer/templates', $data, FALSE);
    }
}

/* End of file Configuration.php */
