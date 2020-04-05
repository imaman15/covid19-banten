<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>

    <?php echo $this->session->flashdata('message'); ?>

    <div class="row animated zoomIn fast">
        <div class="col-md-6">
            <div class="card shadow mb-3 ">
                <img src="<?= base_url('assets/img/bg-profil.png') ?>" class="card-img-top" alt="..." style="height: 100%; max-height: 150px; background-position: center; background-repeat: no-repeat; background-size: cover;">
                <div class="card-body text-center">
                    <img src="<?= base_url('assets/img/profile/' . dUsers()->photo) ?>" class="card-img img-thumbnail rounded-circle" alt="<?php echo ucwords(dUsers()->name); ?>" style="width: 128px; height: 128px; margin-top: -85px;">
                    <h4 class="card-title text-primary font-weight-bold mt-3"><?php secho(ucwords(dUsers()->name)) ?></h4>
                    <ul class="fa-ul text-left">
                        <li class="mb-2">
                            <span class="fa-li text-primary"><i class="far fa-clock"></i></span>
                            Anggota sejak <?= date('d F Y', dUsers()->date_created) ?>
                        </li>
                        <li class="mb-2">
                            <span class="fa-li text-primary"><i class="fas fa-envelope"></i></span>
                            <?php secho(dUsers()->email) ?>
                        </li>
                        <li class="mb-2">
                            <span class="fa-li text-primary"><i class="fas fa-phone"></i></span>
                            <?php secho(dUsers()->phone) ?>
                        </li>
                        <li class="mb-2">
                            <span class="fa-li text-primary"><i class="fas fa-user-lock"></i></span>
                            <?php secho(status(dUsers()->status)) ?>
                        </li>
                    </ul>
                    <hr>
                    <?php
                    if (dUsers()->desc !== NULL) {
                        secho(dUsers()->desc);
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Deskripsi anda belum disi. Silahkan isi deskripsi anda untuk memberikan informasi mengenai Ana.</div>';
                    }
                    ?>
                </div>
                <div class="card-footer text-muted mt-n2 small">
                    Terakhir di perbarui : <?= timeInfo(dUsers()->date_update) ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">ODP</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">450</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-diagnoses fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">PDP</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">570</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-procedures fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Positif</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">2</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user-injured  text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Sembuh</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">56</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clinic-medical  text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Meninggal</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">2</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-ambulance  text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>