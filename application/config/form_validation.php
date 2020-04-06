<?php

defined('BASEPATH') or exit('No direct script access allowed');

$required = '%s tidak boleh kosong.';
$nin_unique = '%s sudah terdaftar. jika anda merasa belum pernah mendaftarkan Nomor Identitas (KTP) di aplikasi ini silahkan <a href="' . site_url() . '">hubungi kami!</a>';
$valid_email = '%s harus berupa alamat surel yang valid.';

$email = array(
    'field' => 'email',
    'label' => '<strong>Email</strong>',
    'rules' => 'trim|required|valid_email',
    // 'errors' => [
    //     'required' => $required,
    //     'valid_email' => $valid_email
    // ]
);
$password = array(
    'field' => 'password',
    'label' => '<strong>Password</strong>',
    'rules' => 'required|trim',
    // 'errors' => [
    //     'required' => $required,
    // ]
);

//=======================================================
// Set Rules
$config = array(
    'login' => array(
        $email, $password
    )
);

$config['error_prefix'] = '<small class="text-danger mt-1 pl-3 d-block">';
$config['error_suffix'] = '</small>';

/* End of file form_validation.php */
