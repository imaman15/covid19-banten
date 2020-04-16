<?php

defined('BASEPATH') or exit('No direct script access allowed');

class News extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('news_model');
    }

    public function index()
    {
        $berita = $this->news_model->listing();
        $data     = array(
            'title'    => 'Berita Covid 19',
            'berita'    => $berita,
            'content'    => 'news/list'
        );
        $this->load->view('layout/index', $data, FALSE);
    }
    public function detail($slug)
    {
        $berita_detail  = $this->news_model->detail($slug);
        $data           = array(
            'title'    => 'Judul Berita',
            'detail'    => $berita_detail,
            'content'   => 'news/detail'
        );
        $this->load->view('layout/index', $data, FALSE);
    }
}

/* End of file News.php */
