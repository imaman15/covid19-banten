<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
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
}

/* End of file Users.php */
