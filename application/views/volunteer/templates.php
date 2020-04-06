<!DOCTYPE html>
<html lang="en">

<?php $this->load->view('volunteer/head'); ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo site_url(M_ADMIN) ?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <img src="<?php echo base_url() ?>assets/img/covid-64p.png" alt="Covid-19" class="img-fluid border-0" width="52">
                </div>
                <div class="sidebar-brand-text my-auto">
                    <div class="mx-2">Covid <sup>19</sup></div>
                    <!-- <div class="text-capitalize font-weight-normal" style="font-size:11px">Provinsi Banten</div> -->
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->

            <li class="nav-item <?php echo ($this->uri->uri_string() ==  M_ADMIN) ? "active" : NULL; ?>">
                <a class="nav-link hvr-wobble-horizontal" href="<?php echo site_url(M_ADMIN) ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <?php if (dUsers()->status == 2) : ?>
                <li class="nav-item <?php echo ($this->uri->uri_string() ==  M_COVID) ? "active" : NULL; ?>">
                    <a class="nav-link hvr-wobble-horizontal" href="<?php echo site_url(M_COVID) ?>">
                        <i class="fas fa-fw fa-virus"></i>
                        <span>Data Covid</span></a>
                </li>
                <li class="nav-item <?php echo ($this->uri->uri_string() ==  M_NEWS) ? "active" : NULL; ?>">
                    <a class="nav-link hvr-wobble-horizontal" href="<?php echo site_url(M_NEWS) ?>">
                        <i class="fas fa-fw fa-info-circle"></i>
                        <span>Info & Tips</span></a>
                </li>
            <?php endif; ?>

            <?php if (dUsers()->status == 1) : ?>
                <li class="nav-item <?php echo ($this->uri->uri_string() ==  M_DISTRICT) ? "active" : NULL; ?>">
                    <a class="nav-link hvr-wobble-horizontal" href="<?php echo site_url(M_DISTRICT) ?>">
                        <i class="fas fa-fw fa-building"></i>
                        <span>Data Kabupaten</span></a>
                </li>

                <li class="nav-item <?php echo ($this->uri->uri_string() ==  M_SUBDISTRICT) ? "active" : NULL; ?>">
                    <a class="nav-link hvr-wobble-horizontal" href="<?php echo site_url(M_SUBDISTRICT) ?>">
                        <i class="far fa-fw fa-building"></i>
                        <span>Data Kecamatan</span></a>
                </li>

                <li class="nav-item <?php echo ($this->uri->uri_string() ==  M_USERS) ? "active" : NULL; ?>">
                    <a class="nav-link hvr-wobble-horizontal" href="<?php echo site_url(M_USERS) ?>">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Data Pengguna</span></a>
                </li>

                <li class="nav-item <?php echo ($this->uri->uri_string() ==  M_CONFIG) ? "active" : NULL; ?>">
                    <a class="nav-link hvr-wobble-horizontal" href="<?php echo site_url(M_CONFIG) ?>">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Konfigurasi</span></a>
                </li>
            <?php endif; ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <div class="ml-auto d-none d-lg-inline">
                        <img src="<?php echo base_url() ?>assets/img/logo-banten.png" alt="Covid-19" class="img-fluid border-0" width="46">
                        <span class="ml-2 text-gray-800 font-weight-bold text-lg"> PUSAT INFORMASI COVID-19 PROVINSI BANTEN </span>
                    </div>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo (isset(dUsers()->name)) ? ucwords(dUsers()->name) : "Tidak ada data"; ?></span>
                                <img class="img-profile rounded-circle" src="
                                <?php
                                $url = base_url('assets/img/profile/');
                                echo (isset(dUsers()->photo)) ? $url . dUsers()->photo : $url . 'default.jpg';
                                ?>
                                ">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item <?php echo ($this->uri->uri_string() ==  M_PROFILE) ? "active" : NULL; ?>" href="<?php echo site_url(M_PROFILE) ?>">
                                    <i class="fas fa-user-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Edit Profil
                                </a>
                                <a class="dropdown-item <?php echo ($this->uri->uri_string() ==  M_PASSWORD) ? "active" : NULL; ?>" href="<?php echo site_url(M_PASSWORD) ?>">
                                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Ganti Sandi
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <?php $this->load->view('volunteer/' . $page); ?>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Pusat Informasi Covid-19 Banten <?php echo cr() ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Logout" di bawah ini jika Anda ingin mengakhiri sesi Anda saat ini.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?php echo site_url(M_ADMIN . '/logout') ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('volunteer/jsutama');
    ?>
    <!-- Page level plugins -->
    <script src="<?php echo base_url('assets'); ?>/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url('assets'); ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

</body>

</html>