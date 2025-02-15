<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>

    <?php echo $this->session->flashdata('message'); ?>

    <div class="row animated zoomIn fast">
        <div class="col-md-6">
            <div class="card shadow mb-3 ">
                <img src="<?php echo base_url('assets/img/bg-profil.png') ?>" class="card-img-top" alt="..." style="height: 100%; max-height: 150px; background-position: center; background-repeat: no-repeat; background-size: cover;">
                <div class="card-body text-center">
                    <img src="<?php echo base_url('assets/img/profile/' . dUsers()->photo) ?>" class="card-img img-thumbnail rounded-circle" alt="<?php echo ucwords(dUsers()->name); ?>" style="width: 128px; margin-top: -85px;">
                    <h4 class="card-title text-primary font-weight-bold mt-3"><?php secho(ucwords(dUsers()->name)) ?></h4>
                    <ul class="fa-ul text-left">
                        <li class="mb-2">
                            <span class="fa-li text-primary"><i class="far fa-clock"></i></span>
                            Anggota sejak <?php echo strftime("%d %B %Y", dUsers()->date_created) ?>
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
                    Terakhir di perbarui : <?php echo timeInfo(dUsers()->date_update) ?>
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
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count[0]->tot_odp ?></div>
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
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count[0]->tot_pdp ?></div>
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
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count[0]->tot_positif ?></div>
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
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count[0]->tot_sembuh ?></div>
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
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count[0]->tot_meninggal ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-ambulance  text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow text-center">
                        <div class="card-header">
                            Aktivitas Relawan
                        </div>
                        <div class="card-body">
                            <table class="table table-striped small" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Tanggal <br> Publish(P) / Update(U)</th>
                                        <th>Nama Relawan</th>
                                        <th>Wilayah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($covid) {

                                        foreach ($covid as $c) {
                                            $tgl_update = $c->tgl_update;
                                            $tgl_publish = $c->tgl_publish;
                                            if ($tgl_publish == $tgl_update) {
                                                $tgl = "P - " . DateTime($c->tgl_publish);
                                            } else {
                                                $tgl = "P - " . DateTime($c->tgl_publish) . " <br> U - " . DateTime($c->tgl_update);
                                            }
                                    ?>
                                            <tr>
                                                <td><?php echo $tgl ?></td>
                                                <td><?php echo $c->name ?></td>
                                                <td><?php echo $c->kecamatan . ' - ' . $c->kabupaten ?></td>
                                            <?php };
                                    } else { ?>
                                            <tr>
                                                <td colspan="4" class="dataTables_empty">Tidak ada data.</td>
                                            </tr>
                                        <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>