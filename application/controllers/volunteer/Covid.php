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
        $data['covid'] = $this->covid_model->listing();
        $data['page'] = $page;
        $this->load->view('volunteer/templates', $data, FALSE);
    }


    public function add(){

        $valid = $this->form_validation;

        $valid->set_rules('odp', 'ODP', 'required',
			array('required' => '%s harus di isi'));

		$valid->set_rules('pdp', 'PDP', 'required',
            array('required' => '%s harus di isi'));
            
		$valid->set_rules('sembuh', 'Sembuh', 'required',
            array('required' => '%s harus di isi'));

		$valid->set_rules('positif', 'Positif', 'required',
            array('required' => '%s harus di isi'));
            
		$valid->set_rules('meninggal', 'Meninggal', 'required',
            array('required' => '%s harus di isi'));
            

        if ($valid->run()){
            $i = $this->input;
            $user_session = $this->session->userdata('code_users');
            $content = [
                'odp'               => $i->post('odp'),
                'pdp'               => $i->post('pdp'),
                'positif'           => $i->post('positif'),
                'sembuh'            => $i->post('sembuh'),
                'meninggal'         => $i->post('meninggal'),
                'slug'              => generate_url_slug($i->post('name_district'), 'covid'),
                'tgl_publish'       => date('Y-m-d H:i:s'),
                'id_district'       => $i->post('id_district'),
                'id_subdistrict'    => $i->post('id_subdistrict'),
                'id_users'          => $user_session
            ];
            $this->covid_model->tambah($content);
			redirect(site_url('volunteer/covid'),'refresh');

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

    public function edit($id_covid){

        $valid = $this->form_validation;


        $valid->set_rules('id_district', 'Data Kabupaten', 'required',
            array('required' => '%s harus di isi'));
            
        $valid->set_rules('odp', 'Data ODP', 'required',
			array('required' => '%s harus di isi'));

		$valid->set_rules('pdp', 'Data PDP', 'required',
            array('required' => '%s harus di isi'));
            
		$valid->set_rules('sembuh', 'Data Sembuh', 'required',
            array('required' => '%s harus di isi'));

		$valid->set_rules('positif', 'Data Positif', 'required',
            array('required' => '%s harus di isi'));
            
		$valid->set_rules('meninggal', 'Data Meninggal', 'required',
            array('required' => '%s harus di isi'));

        if ($valid->run()){
            $i = $this->input;
            $user_session = $this->session->userdata('code_users');
            $content = [
                'id_covid'          => $id_covid,
                'odp'               => $i->post('odp'),
                'pdp'               => $i->post('pdp'),
                'positif'           => $i->post('positif'),
                'sembuh'            => $i->post('sembuh'),
                'meninggal'         => $i->post('meninggal'),
                'slug'              => generate_url_slug($i->post('name_district'), 'covid'),
                'tgl_publish'       => date('Y-m-d H:i:s'),
                'id_district'       => $i->post('id_district'),
                'id_subdistrict'    => $i->post('id_subdistrict'),
                'id_users'          => $user_session
            ];
            $this->covid_model->edit($content);
            redirect(site_url('volunteer/covid'),'refresh');

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

    public function delete($id_covid){
        $data = $this->covid_model->delete($id_covid);

        echo '1';
    }

    public function getSubdistrict(){

        $id_district = $this->input->post('id_district');
        $data = $this->subdistrict_model->getSubdistrict($id_district);

        echo json_encode($data);
    }
}

/* End of file Covid.php */
