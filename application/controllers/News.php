<?php

defined('BASEPATH') or exit('No direct script access allowed');

class News extends CI_Controller
{

    public function index()
    {
        $data 	= array( 'title'    => 'Berita Covid 19',
                        'content'	=> 'news/list'
                );
        $this->load->view('layout/index', $data, FALSE);
    }
    public function detail(){
        $data   = array ('title'    => 'Judul Berita',
                        'content'   => 'news/detail'
                );
        $this->load->view('layout/index', $data, FALSE);

    }
}

/* End of file News.php */
