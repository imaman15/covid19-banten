<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function index()
    {
        not_login(2);
        $page = 'users';
        if (!file_exists(APPPATH . 'views/volunteer/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $data['title'] = 'Data Pengguna';
        $data['page'] = $page;
        $this->load->view('volunteer/templates', $data, FALSE);
    }

    public function editprofile()
    {
        $page = 'editprofile';
        if (!file_exists(APPPATH . 'views/volunteer/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $data['title'] = 'Edit Profil';
        $data['page'] = $page;
        $this->load->view('volunteer/templates', $data, FALSE);
    }

    public function changepassword()
    {
        $page = 'changepassword';
        if (!file_exists(APPPATH . 'views/volunteer/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $data['title'] = 'Edit Profil';
        $data['page'] = $page;
        $this->load->view('volunteer/templates', $data, FALSE);
    }
}

/* End of file Users.php */
