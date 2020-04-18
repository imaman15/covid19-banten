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
        $this->load->library('upload');
    }

    public function index()
    {
        $page = 'news/list';
        if (!file_exists(APPPATH . 'views/volunteer/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        // $data['news']   = $this->news_model->listing();
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
            $config['upload_path']         = './assets/img/news/';
            $config['allowed_types']     = 'gif|jpg|png|jpeg';
            $config['max_size']          = '2400'; // kilobye
            $config['max_width']          = '2024';
            $config['max_height']          = '2024';

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('gambar')) {

                $page = 'news/add_news';
                if (!file_exists(APPPATH . 'views/volunteer/' . $page . '.php')) {
                    // Whoops, we don't have a page for that!
                    show_404();
                }
                $error = $this->upload->display_errors();

                $data['title']  = 'Tambah Berita Covid';
                $data['url']    = 'add';
                $data['error']  = $error;
                $data['berita'] = $this->news_model->listing();
                $data['page']   = $page;

                $this->load->view('volunteer/templates', $data, FALSE);

                // masuk data base
            } else {

                $upload_gambar = array('upload_data' => $this->upload->data());
                // create thumbnail gambar
                $config['image_library']     = 'gd2';
                $config['source_image']     = './assets/img/news/' . $upload_gambar['upload_data']['file_name'];
                // lokasi folder thumbail
                $config['new_image']        = './assets/img/news/thumbs/';
                $config['create_thumb']     = TRUE;
                $config['maintain_ratio']     = TRUE;
                $config['width']             = 250; // ukuran pixel
                $config['height']           = 250; // ukuran pixel
                $config['thumb_marker']        = '';

                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $i = $this->input;
                $user_session = $this->session->userdata('code_users');
                $content = [
                    'title'             => ucwords($i->post('title')),
                    'kategori'          => $i->post('kategori'),
                    'slug'              => generate_url_slug($i->post('title'), 'news'),
                    'content'           => $i->post('content'),
                    'img'               => $upload_gambar['upload_data']['file_name'],
                    'tgl_publish'       => $i->post('tgl_publish'),
                    'id_users'          => $user_session
                ];
                $this->news_model->tambah($content);
                redirect(site_url(M_NEWS), 'refresh');
            }
        } else {
            $page = 'news/add_news';
            if (!file_exists(APPPATH . 'views/volunteer/' . $page . '.php')) {
                // Whoops, we don't have a page for that!
                show_404();
            }
            $data['title'] = 'Tambah Berita Covid';
            $data['url']    = 'add';
            $data['error']  = '';
            $data['berita'] = $this->news_model->listing();
            $data['page'] = $page;

            $this->load->view('volunteer/templates', $data, FALSE);
        }
    }

    public function edit($id_news)
    {

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
            // Check jika gambar di gantii
            if (!empty($_FILES['gambar']['name'])) {

                $config['upload_path']         = './assets/img/news/';
                $config['allowed_types']     = 'gif|jpg|png|jpeg';
                $config['max_size']          = '2400'; // kilobye
                $config['max_width']          = '2024';
                $config['max_height']          = '2024';

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('gambar')) {

                    $page = 'news/add_news';
                    if (!file_exists(APPPATH . 'views/volunteer/' . $page . '.php')) {
                        // Whoops, we don't have a page for that!
                        show_404();
                    }
                    $error = $this->upload->display_errors();

                    $data['title']      = 'Edit Berita';
                    $data['url']        = 'edit';
                    $data['error']      = $error;
                    $data['news']       = $this->news_model->detail($id_news);
                    $data['page']       = $page;

                    $this->load->view('volunteer/templates', $data, FALSE);
                } else {
                    $upload_gambar = array('upload_data' => $this->upload->data());
                    // create thumbnail gambar
                    $config['image_library']     = 'gd2';
                    $config['source_image']     = './assets/img/news/' . $upload_gambar['upload_data']['file_name'];
                    // lokasi folder thumbail
                    $config['new_image']        = './assets/img/news/thumbs/';
                    $config['create_thumb']     = TRUE;
                    $config['maintain_ratio']     = TRUE;
                    $config['width']             = 250; // ukuran pixel
                    $config['height']           = 250; // ukuran pixel
                    $config['thumb_marker']        = '';

                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $i = $this->input;
                    $user_session = $this->session->userdata('code_users');
                    $content = [
                        'id_news'          => $i->post('id_news'),
                        'title'            => ucwords($i->post('title')),
                        'slug'             => generate_url_slug($i->post('title'), 'news'),
                        'kategori'         => $i->post('kategori'),
                        'content'          => $i->post('content'),
                        'img'              => $upload_gambar['upload_data']['file_name'],
                        'tgl_publish'       => $i->post('tgl_publish'),
                        'id_users'         => $user_session
                    ];
                    $this->news_model->edit($content);
                    $this->session->set_flashdata('sukses', 'Data berhasil di edit');
                    redirect(site_url(M_NEWS), 'refresh');
                }
            } else {
                $i = $this->input;
                $user_session = $this->session->userdata('code_users');
                $content = [
                    'id_news'          => $i->post('id_news'),
                    'slug'             => generate_url_slug($i->post('title'), 'news'),
                    'title'            => $i->post('title'),
                    'kategori'         => $i->post('kategori'),
                    'content'          => $i->post('content'),
                    'tgl_publish'      => $i->post('tgl_publish'),
                    'id_users'         => $user_session
                ];

                $this->news_model->edit($content);
                $this->session->set_flashdata('sukses', 'Data berhasil di edit');
                redirect(site_url(M_NEWS), 'refresh');
            }
        } else {
            $page = 'news/add_news';
            if (!file_exists(APPPATH . 'views/volunteer/' . $page . '.php')) {
                // Whoops, we don't have a page for that!
                show_404();
            }
            $data['title']      = 'Edit Berita';
            $data['url']        = 'edit';
            $data['error']      = '';
            $data['news']       = $this->news_model->detail($id_news);
            $data['page']       = $page;
            $this->load->view('volunteer/templates', $data, FALSE);
        }
    }

    public function delete($slug)
    {
        $data = $this->news_model->detail($slug);

        unlink('./assets/img/news/' . $data[0]->img);
        unlink('./assets/img/news/thumbs/' . $data[0]->img);

        $data = $this->news_model->delete($slug);
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
                $upload_gambar = array('upload_data' => $this->upload->data());
                $config['image_library']    = 'gd2';
                $config['source_image']     = './assets/images/' . $upload_gambar['upload_data']['file_name'];
                $config['create_thumb']     = FALSE;
                $config['maintain_ratio']   = TRUE;
                $config['quality']          = '60%';
                $config['width']            = 800;
                $config['height']           = 800;
                $config['new_image']        = './assets/images/';
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                echo base_url() . '/assets/images/' . $upload_gambar['upload_data']['file_name'];
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

    public function myList()
    {
        $list = $this->news_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $n) {
            $no++;
            $row = array();
            // $row[] = $no . ".";
            $row[] = $n->title;
            $row[] = $n->slug;
            $row[] = '<img src="' . base_url("assets/img/news/thumbs/") . $n->img . '" alt="thumbnail" width="100">';
            $row[] = ($n->kategori == 1) ? "Info Kesehatan" : "Berita";
            $row[] = tgl_indo($n->tgl_publish);
            $row[] = tgl_indo($n->tgl_update);
            $row[] = $n->name;

            $row[] = '
            <a title="Edit Data" class="btn btn-warning btn-circle btn-sm mb-lg-0 mb-1" href="' . site_url(M_NEWS_EDIT) . $n->slug . '"><i class="fas fa-edit"></i></a>

            <a title="Hapus Data" class="btn btn-danger btn-circle btn-sm mb-lg-0 mb-1" href="javascript:void(0)" onclick="btn_delete(' . "'" . $n->slug . "'" . ')"><i class="fas fa-trash"></i></a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->news_model->count_all(),
            "recordsFiltered" => $this->news_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}

/* End of file News.php */
