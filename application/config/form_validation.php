<?php

defined('BASEPATH') or exit('No direct script access allowed');

$name = array(
    'field' => 'name',
    'label' => '<strong>Nama Lengkap</strong>',
    'rules' => 'trim|required'
);
$email = array(
    'field' => 'email',
    'label' => '<strong>Email</strong>',
    'rules' => 'trim|required|valid_email',
);
$email2 = array(
    'field' => 'email',
    'label' => '<strong>Email</strong>',
    'rules' => 'trim|required|valid_email|is_unique[users.email]',
    'errors' => [
        'is_unique' => '%s sudah terdaftar.'
    ]
);
$email3 = array(
    'field' => 'email',
    'label' => '<strong>Email</strong>',
    'rules' => 'trim|required|valid_email|callback_change_email',
);
$password = array(
    'field' => 'password',
    'label' => '<strong>Password</strong>',
    'rules' => 'required|trim'
);
$phone = array(
    'field' => 'phone',
    'label' => '<strong>Nomor Handphone</strong>',
    'rules' => 'trim|required|max_length[15]|min_length[9]|numeric',
);

$currentPass = array(
    'field' => 'currentPassword',
    'label' => '<strong>Kata Sandi</strong>',
    'rules' => 'trim|required'
);
$confirmPass = array(
    'field' => 'confirmPassword',
    'label' => '<strong>Konfirmasi Kata Sandi</strong>',
    'rules' => 'trim|required|matches[password]'
);

//=======================================================
// Set Rules
$config = array(
    'login' => array(
        $email, $password
    ),
    'editprofile' => [
        $name, $phone, $email3
    ],
    'changepassword' => [$currentPass, $password, $confirmPass],
    'register' => [$name, $phone, $email2, $password, $confirmPass],
);

$config['error_prefix'] = '<small class="text-danger mt-1 pl-3 d-block">';
$config['error_suffix'] = '</small>';

/* End of file form_validation.php */
