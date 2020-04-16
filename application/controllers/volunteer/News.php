<?php

defined('BASEPATH') or exit('No direct script access allowed');

class News extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        not_login(1);
        $this->load->model(['news_model']);
    }

    public function index()
    {
        $page = 'news/list';
        if (!file_exists(APPPATH . 'views/volunteer/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $data['news']   = $this->news_model->listing();
        $data['title'] = 'Info & Tips Kesehatan';
        $data['page'] = $page;
        $this->load->view('volunteer/templates', $data, FALSE);
    }

    public function add()
    {

        $valid = $this->form_validation;

        $valid->set_rules('title', 'Judul Berita', 'required');

        $valid->set_rules('content', 'Content', 'required');


        if ($valid->run()) {
            $config['upload_path']         = base_url('assets/images/');
            $config['allowed_types']     = 'gif|jpg|png|jpeg';
            $config['max_size']          = '2400'; // kilobye
            $config['max_width']          = '2024';
            $config['max_height']          = '2024';

            $this->load->library('upload', $config);

            $upload_gambar = array('upload_data' => $this->upload->data());

            // create thumbnail gambar
            $config['image_library']     = 'gd2';
            $config['source_image']     = base_url('assets/img/news/') . $upload_gambar['upload_data']['file_name'];
            // lokasi folder thumbail
            $config['new_image']        = base_url('assets/img/news/');
            $config['create_thumb']     = TRUE;
            $config['maintain_ratio']     = TRUE;
            $config['width']             = 250; // ukuran pixel
            $config['height']           = 250; // ukuran pixel
            $config['thumb_marker']        = '';

            $this->load->library('image_lib', $config);

            $this->image_lib->resize();

            $error = $this->upload->display_errors();

            $i = $this->input;
            $user_session = $this->session->userdata('code_users');
            $content = [
                'title'             => ucwords($i->post('title')),
                'slug'             => generate_url_slug($i->post('title'), 'news'),
                'kategori'          => $i->post('kategori'),
                'content'           => $i->post('content'),
                'img'               => $upload_gambar['upload_data']['file_name'],
                'tgl_publish'       => date('Y-m-d H:i:s'),
                'tgl_update'        => date('Y-m-d H:i;s'),
                'id_users'          => $user_session
            ];
            $this->news_model->tambah($content);
            redirect(site_url(M_NEWS), 'refresh');
        } else {
            $page = 'news/add_news';
            if (!file_exists(APPPATH . 'views/volunteer/' . $page . '.php')) {
                // Whoops, we don't have a page for that!
                show_404();
            }
            $data['title'] = 'Tambah Berita Covid';
            $data['url']    = 'add';
            $data['berita'] = $this->news_model->listing();
            $data['page'] = $page;

            $this->load->view('volunteer/templates', $data, FALSE);
        }
    }

    public function edit($id_news)
    {
        $config['upload_path']         = base_url('assets/images/');
        $config['allowed_types']     = 'gif|jpg|png|jpeg';
        $config['max_size']          = '2400'; // kilobye
        $config['max_width']          = '2024';
        $config['max_height']          = '2024';

        $this->load->library('upload', $config);

        $upload_gambar = array('upload_data' => $this->upload->data());

        $valid = $this->form_validation;
        $valid->set_rules(
            'title',
            'Judul',
            'required',
            array('required' => '%s harus di isi')
        );
        $valid->set_rules(
            'content',
            'Content',
            'required',
            array('required' => '%s harus di isi')
        );

        if ($valid->run()) {
            $config['upload_path']         = base_url('assets/images/');
            $config['allowed_types']     = 'gif|jpg|png|jpeg';
            $config['max_size']          = '2400'; // kilobye
            $config['max_width']          = '2024';
            $config['max_height']          = '2024';

            $this->load->library('upload', $config);

            $upload_gambar = array('upload_data' => $this->upload->data());

            // create thumbnail gambar
            $config['image_library']     = 'gd2';
            $config['source_image']     = base_url('assets/img/news/') . $upload_gambar['upload_data']['file_name'];
            // lokasi folder thumbail
            $config['new_image']        = base_url('assets/img/news/');
            $config['create_thumb']     = TRUE;
            $config['maintain_ratio']     = TRUE;
            $config['width']             = 250; // ukuran pixel
            $config['height']           = 250; // ukuran pixel
            $config['thumb_marker']        = '';

            $this->load->library('image_lib', $config);

            $this->image_lib->resize();

            $error = $this->upload->display_errors();

            $i = $this->input;
            $user_session = $this->session->userdata('code_users');
            $content = [
                'id_news'          => $id_news,
                'title'            => $i->post('title'),
                'kategori'         => $i->post('kategori'),
                'content'          => $i->post('content'),
                'img'              => $upload_gambar['upload_data']['file_name'],
                'tgl_publish'      => date('Y-m-d H:i:s'),
                'tgl_update'       => date('Y-m-d H:i;s'),
                'id_users'         => $user_session
            ];
            $this->news_model->edit($content);
            redirect(site_url(M_NEWS), 'refresh');
        } else {
            $page = 'news/add_news';
            if (!file_exists(APPPATH . 'views/volunteer/' . $page . '.php')) {
                // Whoops, we don't have a page for that!
                show_404();
            }
            $data['title']      = 'Edit Berita';
            $data['url']        = 'edit';
            $data['news']     = $this->news_model->detail($id_news);
            $data['page']       = $page;

            $this->load->view('volunteer/templates', $data, FALSE);
        }
    }

    public function delete($id_news)
    {
        $data = $this->news_model->delete($id_news);
        echo '1';
    }

    //Upload image summernote
    function upload_image()
    {
        if (isset($_FILES["image"]["name"])) {
            $config['upload_path'] = './assets/images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('image')) {
                $this->upload->display_errors();
                return FALSE;
            } else {
                $data = $this->upload->data();
                //Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/images/' . $data['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['quality'] = '60%';
                $config['width'] = 800;
                $config['height'] = 800;
                $config['new_image'] = './assets/images/' . $data['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                echo base_url() . 'assets/images/' . $data['file_name'];
            }
        }
    }

    //Delete image summernote
    function delete_image()
    {
        $src = $this->input->post('src');
        $file_name = str_replace(base_url(), '', $src);
        if (unlink($file_name)) {
            echo 'File Delete Successfully';
        }
    }
}

/* End of file News.php */
