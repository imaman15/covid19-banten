<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?php echo $title ?></title>

    <!-- favicon -->
    <link rel="shortcut icon" href="<?php echo base_url('assets'); ?>/img/covid.ico" type="image/x-icon">
    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url('assets'); ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('assets'); ?>/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
    <!-- Begin Page Content -->
    <div class="container-fluid mt-5">

        <!-- 404 Error Text -->
        <div class="text-center">
            <div class="error mx-auto" data-text="404">404</div>
            <p class="lead text-gray-800 mb-5">Page Not Found</p>
            <p class="text-gray-500 mb-0">Halaman situs yang Anda cari tidak dapat ditemukan...</p>
            <a href="<?php echo base_url() . $url; ?>">&larr; Kembali ke Halaman Utama</a>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Page Wrapper -->
</body>

</html>