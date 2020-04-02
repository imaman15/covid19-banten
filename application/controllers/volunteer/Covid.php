<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Covid extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        not_login(1);
    }
    public function index()
    {
        $page = 'covid';
        if (!file_exists(APPPATH . 'views/volunteer/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $data['title'] = 'Data Covid';
        $data['page'] = $page;
        $this->load->view('volunteer/templates', $data, FALSE);
    }
}

/* End of file Covid.php */
