<!-- MEMBER LIST -->
<section id="member-list" class="py-2 bg-light text-center">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <p class="h3 text-dark">Tim Relawan</p>
                <hr class="w-25 mb-3">
            </div>
        </div>


        <?php
        if ($volunteer) {
            echo '<div class="card-columns">';
            foreach ($volunteer as $v) :
        ?>
                <div class="card">
                    <img class="card-img-top" src="<?php echo base_url('assets/img/bg-profil.png') ?>">
                    <div class="card-body">
                        <img src="<?php echo base_url('assets/img/profile/') . $v->photo ?>" class="rounded-circle img-thumbnail">
                        <h5 class="card-title text-primary font-weight-bold mt-2"><?php echo ucwords($v->name) ?></h5>
                        <ul class="fa-ul text-left">
                            <li class="mb-2">
                                <span class="fa-li"><i class="far fa-clock"></i></span>
                                <small>Bergabung pada <?php echo strftime("%B %Y", $v->date_created); ?></small>
                            </li>
                        </ul>
                        <hr>
                        <p class="card-text"><?php secho(($v->desc) ? $v->desc : "-"); ?></p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted"><?php echo  $tektime . ' ' . timeInfo($v->date_update) ?></small>
                    </div>
                </div>

            <?php
            endforeach;
            echo '</div>';
        } else { ?>
            <p class="text-center">Belum ada data untuk saat ini.</p>
        <?php }; ?>


        <hr class="my-3">

        <div class="row">
            <div class="col text-center">
                <p class="h3 text-dark">Tim Developer</p>
                <hr class="w-25 mb-3">
            </div>
        </div>

        <div class="card-deck justify-content-sm-center mb-4">
            <div class="col-md-4">
                <div class="card shadow">
                    <img class="card-img-top" src="<?php echo base_url('assets/img/bg-profil.png') ?>">
                    <div class="card-body">
                        <img src="<?php echo base_url('assets/img/profile/') . $dev[1]->photo ?>" class="rounded-circle img-thumbnail">
                        <h5 class="card-title text-primary font-weight-bold mt-2"><?php echo ucwords($dev[1]->name) ?></h5>
                        <ul class="fa-ul text-left">
                            <li class="mb-2">
                                <span class="fa-li"><i class="far fa-clock"></i></span>
                                <small>Bergabung pada <?php echo strftime("%B %Y", $dev[1]->date_created); ?></small>
                            </li>
                            <li class="mb-2">
                                <span class="fa-li"><i class="fas fa-envelope"></i></span>
                                <small><?php echo $dev[1]->email ?></small>
                            </li>
                        </ul>
                        <hr>
                        <p class="card-text"><?php secho(($dev[1]->desc) ? $dev[1]->desc : "-"); ?></p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted"><?php echo  $tektime . ' ' . timeInfo($dev[1]->date_update) ?></small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow">
                    <img class="card-img-top" src="<?php echo base_url('assets/img/bg-profil.png') ?>">
                    <div class="card-body">
                        <img src="<?php echo base_url('assets/img/profile/') . $dev[0]->photo ?>" class="rounded-circle img-thumbnail">
                        <h5 class="card-title text-primary font-weight-bold mt-2"><?php echo ucwords($dev[0]->name) ?></h5>
                        <ul class="fa-ul text-left">
                            <li class="mb-2">
                                <span class="fa-li"><i class="far fa-clock"></i></span>
                                <small>Bergabung pada <?php echo strftime("%B %Y", $dev[0]->date_created); ?></small>
                            </li>
                            <li class="mb-2">
                                <span class="fa-li"><i class="fas fa-envelope"></i></span>
                                <small><?php echo $dev[0]->email ?></small>
                            </li>
                        </ul>
                        <hr>
                        <p class="card-text"><?php secho(($dev[0]->desc) ? $dev[0]->desc : "-"); ?></p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted"><?php echo  $tektime . ' ' . timeInfo($dev[0]->date_update) ?></small>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- End Content-fluid -->