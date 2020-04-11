<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Subdistrict extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        not_login(2);
        $this->load->library(['form_validation']);
        $this->load->model(['district_model', 'subdistrict_model', 'covid_model']);
    }

    public function index()
    {
        $page = 'subdistrict';
        if (!file_exists(APPPATH . 'views/volunteer/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $data['title'] = 'Data Kecamatan';
        $data['page'] = $page;
        $data['district'] = $this->district_model->getData();
        $this->load->view('volunteer/templates', $data, FALSE);
    }

    public function myList()
    {
        $list = $this->subdistrict_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $dis) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $dis->nama_subdistrict;
            $row[] = $dis->nama_district;

            $row[] = '
            <a title="Edit Data" class="btn btn-warning btn-circle btn-sm mb-lg-0 mb-1" href="javascript:void(0)" onclick="edit_subdistrict(' . "'" . $dis->id_subdistrict . "'" . ')"><i class="fas fa-edit"></i></a>

            <a title="Hapus Data" class="btn btn-danger btn-circle btn-sm mb-lg-0 mb-1" href="javascript:void(0)" onclick="delete_subdistrict(' . "'" . $dis->id_subdistrict . "'" . ')"><i class="fas fa-trash"></i></a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->subdistrict_model->count_all(),
            "recordsFiltered" => $this->subdistrict_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function view($id = NULL)
    {
        $data = $this->subdistrict_model->getData(NULL, ['id_subdistrict' => $id])->row();
        if ((!isset($id)) or (!$data)) redirect(site_url(M_ADMIN));
        echo json_encode($data);
    }

    public function add()
    {
        $this->_validate();
        $this->subdistrict_model->add();
        echo json_encode(["status" => TRUE]);
    }

    public function edit($id = NULL)
    {
        $this->_validate();
        $this->subdistrict_model->update();
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('nama_subdistrict') == '') {
            $data['inputerror'][] = 'nama_subdistrict';
            $data['error_string'][] = 'Kecamatan tidak boleh kosong.';
            $data['status'] = FALSE;
        }

        if ($this->input->post('id_district') == '') {
            $data['inputerror'][] = 'id_district';
            $data['error_string'][] = 'Kab/Kota tidak boleh kosong.';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    public function delete($id = NULL)
    {
        $check = $this->subdistrict_model->getData(NULL, ['id_subdistrict' => $id])->row();
        if ((!isset($id)) or (!$check)) redirect(site_url(M_ADMIN));
        //delete file
        $this->subdistrict_model->delete($id);
        echo json_encode(array("status" => TRUE));
    }

    public function viewdelete($id = NULL)
    {
        $check = $this->subdistrict_model->getData(NULL, ['id_subdistrict' => $id])->row();
        if ((!isset($id)) or (!$check)) redirect(site_url(M_ADMIN));

        $covid = $this->covid_model->getData(NULL, ['id_subdistrict' => $id])->num_rows();

        if ($covid > 0) {
            $message = "Data tidak dapat di hapus karena sudah digunakan";
            echo json_encode(array("status" => FALSE, "message" => $message));
        } else {
            $message = "Data yang dihapus tidak akan bisa dikembalikan.";
            //delete file
            echo json_encode(array("status" => TRUE, "message" => $message));
        }
    }
}

/* End of file Subdistrict.php */
