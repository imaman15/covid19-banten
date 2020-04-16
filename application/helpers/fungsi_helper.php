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

function secho($str)
{
    echo htmlentities($str, ENT_QUOTES, 'UTF-8');
}

function phoneNumber($number)
{
    // situs http://agussaputra.com/read-article-40-mengubah+62+menjadi+0+dan+0+menjadi+62++sms.html

    $hp = "";
    // kadang ada penulisan no hp 0811 239 345
    $number = str_replace(" ", "", $number);
    // kadang ada penulisan no hp (0274) 778787
    $number = str_replace("(", "", $number);
    // kadang ada penulisan no hp (0274) 778787
    $number = str_replace(")", "", $number);
    // kadang ada penulisan no hp 0811.239.345
    $number = str_replace(".", "", $number);
    // kadang ada penulisan no hp 0811-239-345
    $number = str_replace("-", "", $number);

    // cek apakah no hp mengandung karakter + dan 0-9
    if (!preg_match('/[^+0-9]/', trim($number))) {
        // cek apakah no hp karakter 1-3 adalah +62
        if (substr(trim($number), 0, 3) == '+62') {
            $hp = trim($number);
        }
        // cek apakah no hp karakter 1 adalah 0
        elseif (substr(trim($number), 0, 1) == '0') {
            $hp = '+62' . substr(trim($number), 1);
        }
        // cek apakah no hp karakter 1 adalah 62
        elseif (substr(trim($number), 0, 2) == '62') {
            $hp = '+' . trim($number);
        }
    }
    return $hp;
    // Dan berikut untuk menampilkan kembali "+62" menjadi "0":
    // $hp0 = substr_replace($hp,'0',0,3);
}

function get_random_password($chars_min, $chars_max, $use_upper_case, $include_numbers, $include_special_chars)
{
    $length = rand($chars_min, $chars_max);
    $selection = 'aeuoyibcdfghjklmnpqrstvwxz';
    if ($include_numbers) {
        $selection .= "1234567890";
    }
    if ($include_special_chars) {
        $selection .= '/[!@#$%^&*()\-_=+{};:,<.>~]/';
    }

    $password = "";
    for ($i = 0; $i < $length; $i++) {
        $current_letter = $use_upper_case ? (rand(0, 1) ? strtoupper($selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))];
        $password .=  $current_letter;
    }

    return $password;
}

// Function Keterangan Waktu
function timeInfo($timestamp)
{
    $selisih = time() - strtotime($timestamp);
    $detik = $selisih;
    $menit = round($selisih / 60);
    $jam = round($selisih / 3600);
    $hari = round($selisih / 86400);
    $minggu = round($selisih / 604800);
    $bulan = round($selisih / 2419200);
    $tahun = round($selisih / 29030400);

    if ($detik <= 60) {
        $waktu = $detik . ' detik yang lalu';
    } else if ($menit <= 60) {
        $waktu = $menit . ' menit yang lalu';
    } else if ($jam <= 24) {
        $waktu = $jam . ' jam yang lalu';
    } else if ($hari <= 7) {
        $waktu = $hari . ' hari yang lalu';
    } else if ($minggu <= 4) {
        $waktu = $minggu . ' minggu yang lalu';
    } else if ($bulan <= 12) {
        $waktu = $bulan . ' bulan yang lalu';
    } else {
        $waktu = $tahun . ' tahun yang lalu';
    }

    return $waktu;
}

function status($data)
{
    if ($data == 1) {
        return "Administrator";
    } elseif ($data == 2) {
        return "Relawan";
    } else {
        return "-";
    }
}

function tgl_indo($tanggal)
{

    $tgl_new = date("Y-m-d", strtotime($tanggal));
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $date = explode('-', $tgl_new);

    return $date[2] . ' ' . $bulan[(int) $date[1]] . ' ' . $date[0];
}

function base64_encode_url($string)
{
    return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($string));
}

function base64_decode_url($string)
{
    return base64_decode(str_replace(['-', '_'], ['+', '/'], $string));
}

function generate_url_slug($string, $table, $field = 'slug', $key = NULL, $value = NULL)
{
    $t = &get_instance();
    $slug = url_title($string);
    $slug = strtolower($slug);
    $i = 0;
    $params = array();
    $params[$field] = $slug;

    if ($key) $params["$key !="] = $value;

    while ($t->db->where($params)->get($table)->num_rows()) {
        if (!preg_match('/-{1}[0-9]+$/', $slug))
            $slug .= '-' . ++$i;
        else
            $slug = preg_replace('/[0-9]+$/', ++$i, $slug);

        $params[$field] = $slug;
    }
    return $slug . '.html';
}
