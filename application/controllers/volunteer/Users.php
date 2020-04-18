<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->library(['form_validation']);
        $this->load->model('users_model');
    }

    public function index()
    {
        not_login(2);
        $page = 'users';
        if (!file_exists(APPPATH . 'views/volunteer/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $param = ENCURL;
        $var_enc = base64_encode_url($param);
        $data['url'] = site_url(M_REGISTER . '?d=') . $var_enc;
        $data['title'] = 'Data Pengguna';
        $data['page'] = $page;
        $this->load->view('volunteer/templates', $data, FALSE);
    }

    public function editprofile()
    {
        not_login();
        $page = 'editprofile';
        if (!file_exists(APPPATH . 'views/volunteer/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }

        if ($this->form_validation->run('editprofile') == FALSE) {
            $data['user'] = dUsers();
            $data['title'] = 'Edit Profil';
            $data['page'] = $page;
            $this->load->view('volunteer/templates', $data, FALSE);
        } else {
            $emailNow = dUsers()->email;
            $emailForm = $this->input->post('email');
            if ($emailNow !== $emailForm) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger animated zoomIn" role="alert">Profil gagal diperbarui. Email anda tidak sesuai.</div>');
                redirect(M_PROFILE);
            } else {
                $post = $this->input->post(null, TRUE);
                $this->users_model->update($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success animated zoomIn fast" role="alert">Profil Anda telah diperbarui.</div>');
                    redirect(M_ADMIN);
                }
                $this->session->set_flashdata('message', '<div class="alert alert-danger animated zoomIn" role="alert">Profil gagal diperbarui. Silahkan coba lagi nanti.</div>');
                redirect(M_PROFILE);
            }
        }
    }

    public function changepassword()
    {
        not_login();
        $page = 'changepassword';
        if (!file_exists(APPPATH . 'views/volunteer/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }


        if ($this->form_validation->run('changepassword') == FALSE) {
            $data['title'] = 'Edit Profil';
            $data['page'] = $page;
            $this->load->view('volunteer/templates', $data, FALSE);
        } else {
            $post = $this->input->post(null, TRUE);

            $currentPassword = $post['currentPassword'];
            $newPassword = $post['password'];

            if (!password_verify($currentPassword, dUsers()->password)) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger animated zoomIn" role="alert">
            Kata sandi lama Anda salah.</div>');
                redirect(M_PASSWORD);
            } else {
                if ($currentPassword == $newPassword) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger animated zoomIn" role="alert">
                Kata sandi baru tidak boleh sama dengan kata sandi lama.</div>');
                    redirect(M_PASSWORD);
                } else {
                    $this->users_model->changepassword($newPassword);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('message', '<div class="alert alert-success animated zoomIn fast" role="alert">Kata sandi Anda berhasil diubah.</div>');
                        redirect(M_ADMIN);
                    }
                    $this->session->set_flashdata('message', '<div class="alert alert-danger animated zoomIn" role="alert">Kata sandi Anda gagal diubah.</div>');
                    redirect(M_PASSWORD);
                }
            }
        }
    }


    public function change_email($email = '')
    {
        not_login();
        //Regex merupakan singkatan dari Regular Expression, yaitu sebuah metode untuk mencari suatu pola dalam sebuah string.
        //Fungsi yang digunakan untuk Regex dalam php adalah preg_match($regex, $string), di mana $regex adalah pola yang akan dicari dan $string adalah variabel yang akan dicari apakah ada pola $regex di dalamnya.

        $email = trim($email);
        $userCheck = $this->users_model->checkEmail($email)->row();

        if ($userCheck->email && $userCheck->email !== dUsers()->email) {
            $this->form_validation->set_message('change_email', '<strong>' . $userCheck->email . '</strong> sudah digunakan. Silahkan gunakan email lain');
            return FALSE;
        }

        return TRUE;
    }

    public function mylist($check = NULL)
    {
        not_login(2);
        $list = $this->users_model->get_datatables($check);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $l) {
            $no++;
            $row = array();

            if ($l->status == 1) {
                $status = 'Administrator';
            } else if ($l->status == 2) {
                $status = 'Relawan';
            } else {
                $status = '-';
            }

            $row[] = '<img src="' . base_url('assets/img/profile/' . $l->photo) . '" alt="" class="card-img img-thumbnail rounded-circle" style="width: 100px">';
            $row[] = '<p class="font-weight-bold">' . ucwords($l->name) . ' <sup>(' . $status . ')</sup></p><div class="mt-n3"><small><i class="fas fa-envelope"></i> ' . $l->email . '</small> &#8286; <small><i class="fas fa-phone"></i> ' . $l->phone . '</small> &#8286; <small><i class="far fa-clock"></i> ' . strftime("%d %B %Y", $l->date_created) . '</small></div><p class="small mb-n3">' . $l->desc . '</p><hr><p class="small mt-n3">Terakhir di perbarui : ' . timeInfo($l->date_update) . '</p>';

            if ($check == 'active') {
                $btnAction = '<a data-toggle="tooltip" data-placement="top" title="Ganti Role Akun" class="btn btn-primary btn-circle btn-sm mb-1" href="javascript:void(0)" onclick="status_users(' . "'" . $l->id_users . "'"  . ',' . "'" . $l->status . "'" . ')"><i class="fas fa-exchange-alt"></i></a><a data-toggle="tooltip" data-placement="top" title="Blokir Akun" class="btn btn-danger btn-circle btn-sm mb-1" href="javascript:void(0)" onclick="active_users(' . "'" . $l->id_users  . "','blocked'" . ')"><i class="fas fa-ban"></i></a>';
            } elseif ($check == 'notactive') {
                $btnAction = '<a data-toggle="tooltip" data-placement="top" title="Aktifkan Akun" class="btn btn-success btn-circle mb-lg-0 btn-sm mb-1" href="javascript:void(0)" onclick="active_users(' . "'" . $l->id_users  . "','active'" . ')"><i class="fas fa-user-check"></i></a> <a data-toggle="tooltip" data-placement="top" title="Blokir Akun" class="btn btn-danger btn-circle btn-sm mb-lg-0 mb-1" href="javascript:void(0)" onclick="active_users(' . "'" . $l->id_users  . "','blocked'" . ')"><i class="fas fa-ban"></i></a>';
            } elseif ($check == 'blocked') {
                $btnAction = '<a data-toggle="tooltip" data-placement="top" title="Aktifkan Akun" class="btn btn-success btn-circle mb-lg-0 btn-sm mb-1" href="javascript:void(0)" onclick="active_users(' . "'" . $l->id_users  . "','active'" . ')"><i class="fas fa-user-check"></i></a>';
            }

            $row[] = $btnAction;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->users_model->count_all($check),
            "recordsFiltered" => $this->users_model->count_filtered($check),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function update_status()
    {
        not_login(2);
        $this->users_model->update_status();
        echo json_encode(array("status" => TRUE));
    }
    public function update_active()
    {
        not_login(2);
        $this->users_model->update_active();
        echo json_encode(array("status" => TRUE));
    }
    public function notif()
    {
        not_login(2);
        $data['active'] = $this->users_model->count_all('active');
        $data['notactive'] = $this->users_model->count_all('notactive');
        $data['blocked'] = $this->users_model->count_all('blocked');
        $data['status'] = TRUE;
        echo json_encode($data);
    }
}

/* End of file Users.php */
