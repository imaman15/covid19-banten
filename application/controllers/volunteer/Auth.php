<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->library(['form_validation', 'encryption']);
        $this->load->model('users_model', 'users');
    }

    public function register()
    {
        $param = ENCURL;
        $var_enc = base64_encode_url($param);
        // echo $var_enc . "<br>";
        $var_dec = base64_decode_url($this->input->get_post('d'));
        $urlRegis = M_REGISTER . '?d=' . $var_enc;

        if ($this->form_validation->run('register') == FALSE) {
            if ($var_dec ==  $param) {
                $data['url'] = $urlRegis;
                $data['title'] = 'Daftar Relawan';
                $this->load->view('volunteer/register', $data, FALSE);
            } else {
                show_404();
            }
        } else {
            $post = $this->input->post(NULL, TRUE);
            $this->users->add($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Registrasi berhasil dilakukan. Admin akan memberitahukan informasi keaktifan akun melalui whatsapp/sms/email. <small class="pl-3 font-weight-bold d-block text-muted">(Pastikan no hp atau email anda aktif)</small></div>');
                redirect(site_url() . $urlRegis);
            }
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Registrasi gagal. Silahkan coba kembali. <small class="pl-3 font-weight-bold d-block text-muted">(Hubungi admin jika registrasi masih gagal)</small></div>');
            redirect(site_url() . $urlRegis);
        }
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
