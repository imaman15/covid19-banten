<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->library('form_validation');
        $this->load->model('users_model', 'users');
    }

    public function registration()
    {
        echo 'registration';
    }

    public function login()
    {
        already_login();
        if ($this->form_validation->run('login') == FALSE) {
            $data['title'] = 'Login';
            $this->load->view('volunteer/login', $data, FALSE);
        } else {
            $email = $this->input->post('email', TRUE);
            $password = $this->input->post('password', TRUE);
            $user = $this->users->getData(NULL, ["email" => $email])->row();
            //jika user ada
            if ($user) {
                if ($user->active == 1) {
                    if (password_verify($password, $user->password)) {
                        $data = [
                            'code_users' => $user->id_users
                        ];
                        $this->session->set_userdata($data);
                        redirect(site_url(M_ADMIN));
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        <strong>Kata Sandi</strong> yang anda masukkan salah! </div>');
                        redirect(site_url(M_ADMIN . '/login'));
                    }
                } else if ($user->active == 0) {
                    // User Belum Aktif
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    <strong>Email</strong> anda belum diaktifkan! </div>');
                    redirect(site_url(M_ADMIN . '/login'));
                } else if ($user->active == 2) {
                    // User diblokir
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    <strong>Email</strong> anda telah diblokir, Silahkan hubungi Admin </div>');
                    redirect(site_url(M_ADMIN . '/login'));
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                <strong>Email</strong> tidak terdaftar! </div>');
                redirect(site_url(M_ADMIN . '/login'));
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('code_users');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Anda telah keluar! </div>');
        redirect(site_url(M_ADMIN . '/login'));
    }
}

/* End of file Auth.php */
