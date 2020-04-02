<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function already_login()
{
    $CI = &get_instance();
    $user_session = $CI->session->userdata('code_users');
    if ($user_session) {
        redirect(site_url(M_ADMIN));
    }
}

function not_login($status = NULL)
{
    $CI = &get_instance();
    $user_session = $CI->session->userdata('code_users');
    $user_db = $CI->db->get_where('users', ['id_users' => $user_session])->row();
    if (!$user_db) {
        $CI->session->unset_userdata('code_users');
        redirect(M_ADMIN . '/login');
    } else {
        if ($user_db->status == $status) {
            // redirect('/404_override');
            show_404();
        }
    }
}

function dUsers()
{
    $CI = &get_instance();
    $CI->load->model('users_model');
    $id = $CI->session->userdata('code_users');
    return $CI->users_model->getData(NULL, ['id_users' => $id])->row();
}

function cr()
{
    $year = 2020;
    $yearnow = date('Y');
    if ($yearnow == $year) {
        echo $yearnow;
    } else {
        echo $year . ' - ' . $yearnow;
    }
}
