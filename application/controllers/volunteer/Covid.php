<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Covid extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        not_login(1);
        $this->load->model(['district_model', 'subdistrict_model', 'covid_model']);
    }
    public function index()
    {
        $page = 'covid/list';
        if (!file_exists(APPPATH . 'views/volunteer/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $data['title'] = 'Data Covid';
        //$data['covid'] = $this->covid_model->listing();
        $data['page'] = $page;
        $this->load->view('volunteer/templates', $data, FALSE);
    }


    public function add()
    {

        $valid = $this->form_validation;

        $valid->set_rules(
            'odp',
            'ODP',
            'required',
            array('required' => '%s harus di isi')
        );

        $valid->set_rules(
            'pdp',
            'PDP',
            'required',
            array('required' => '%s harus di isi')
        );

        $valid->set_rules(
            'sembuh',
            'Sembuh',
            'required',
            array('required' => '%s harus di isi')
        );

        $valid->set_rules(
            'positif',
            'Positif',
            'required',
            array('required' => '%s harus di isi')
        );

        $valid->set_rules(
            'meninggal',
            'Meninggal',
            'required',
            array('required' => '%s harus di isi')
        );


        if ($valid->run()) {
            $i = $this->input;
            $user_session = $this->session->userdata('code_users');
            $content = [
                'odp'               => $i->post('odp'),
                'pdp'               => $i->post('pdp'),
                'positif'           => $i->post('positif'),
                'sembuh'            => $i->post('sembuh'),
                'meninggal'         => $i->post('meninggal'),
                'tgl_publish'       => $i->post('tgl_publish'),
                'id_district'       => $i->post('id_district'),
                'id_subdistrict'    => $i->post('id_subdistrict'),
                'id_users'          => $user_session
            ];
            $this->covid_model->tambah($content);
            redirect(site_url(M_COVID), 'refresh');
        } else {
            $page = 'covid/add_covid';
            if (!file_exists(APPPATH . 'views/volunteer/' . $page . '.php')) {
                // Whoops, we don't have a page for that!
                show_404();
            }
            $data['title'] = 'Tambah Data Covid';
            $data['url']    = 'add';
            $data['kabupaten'] = $this->district_model->listing();
            $data['page'] = $page;

            $this->load->view('volunteer/templates', $data, FALSE);
        }
    }

    public function edit($id_covid)
    {

        $valid = $this->form_validation;


        $valid->set_rules(
            'id_district',
            'Data Kabupaten',
            'required',
            array('required' => '%s harus di isi')
        );

        $valid->set_rules(
            'odp',
            'Data ODP',
            'required',
            array('required' => '%s harus di isi')
        );

        $valid->set_rules(
            'pdp',
            'Data PDP',
            'required',
            array('required' => '%s harus di isi')
        );

        $valid->set_rules(
            'sembuh',
            'Data Sembuh',
            'required',
            array('required' => '%s harus di isi')
        );

        $valid->set_rules(
            'positif',
            'Data Positif',
            'required',
            array('required' => '%s harus di isi')
        );

        $valid->set_rules(
            'meninggal',
            'Data Meninggal',
            'required',
            array('required' => '%s harus di isi')
        );

        if ($valid->run()) {
            $i = $this->input;
            $user_session = $this->session->userdata('code_users');
            $content = [
                'id_covid'          => $id_covid,
                'odp'               => $i->post('odp'),
                'pdp'               => $i->post('pdp'),
                'positif'           => $i->post('positif'),
                'sembuh'            => $i->post('sembuh'),
                'meninggal'         => $i->post('meninggal'),
                'tgl_publish'       => $i->post('tgl_publish'),
                'id_district'       => $i->post('id_district'),
                'id_subdistrict'    => $i->post('id_subdistrict'),
                'id_users'          => $user_session
            ];
            $this->covid_model->edit($content);
            redirect(site_url(M_COVID), 'refresh');
        } else {
            $page = 'covid/add_covid';
            if (!file_exists(APPPATH . 'views/volunteer/' . $page . '.php')) {
                // Whoops, we don't have a page for that!
                show_404();
            }
            $data['title']      = 'Tambah Data Covid';
            $data['url']        = 'edit';
            $data['covid']      = $this->covid_model->detail($id_covid);
            $data['kabupaten']  = $this->district_model->listing();
            $data['page']       = $page;

            $this->load->view('volunteer/templates', $data, FALSE);
        }
    }

    public function delete($id_covid)
    {
        $data = $this->covid_model->delete($id_covid);

        echo '1';
    }

    public function getSubdistrict()
    {

        $id_district = $this->input->post('id_district');
        $data = $this->subdistrict_model->getSubdistrict($id_district);

        echo json_encode($data);
    }

    public function myList()
    {
        $list = $this->covid_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $c) {
            $no++;
            $row = array();
            // $row[] = $no . ".";
            $row[] = tgl_indo($c->tgl_publish);
            $row[] = $c->nama_district;
            $row[] = $c->nama_subdistrict;
            $row[] = $c->odp;
            $row[] = $c->pdp;
            $row[] = $c->positif;
            $row[] = $c->sembuh;
            $row[] = $c->meninggal;

            $row[] = '
            <a title="Edit Data" class="btn btn-warning btn-circle btn-sm mb-1" href="' . site_url(M_COVID_EDIT) . $c->id_covid . '"><i class="fas fa-edit"></i></a>

            <a title="Hapus Data" class="btn btn-danger btn-circle btn-sm mb-1" href="javascript:void(0)" onclick="btn_delete(' . "'" . $c->id_covid . "'" . ')"><i class="fas fa-trash"></i></a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->covid_model->count_all(),
            "recordsFiltered" => $this->covid_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}

/* End of file Covid.php */
