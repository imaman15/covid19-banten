<div class="container">
    <p class="h3 text-center mb-4 text-dark">Berita Terkini</p>
    <?php foreach ($detail as $detail) { ?>
        <div class="card mb-4">
            <div class="card-header text-center">
                <?= $detail->title ?>
            </div>
            <div class="card-body text-justify">
                <div class="row">

                    <div class="col-md-4">
                        <img src="<?= base_url('assets/img/news/') . $detail->img ?>" class="img-fluid mb-4" alt="Responsive image">
                        <p class="btn btn-light">Berita pada <?= tgl_indo($detail->tgl_publish) ?></p>
                        <p class="btn btn-light"><?= ($detail->kategori == 1) ? "Info Kesehatan" : "Berita"; ?></p>
                        <p class="btn btn-light">Ditulis oleh <?= $detail->name ?></p>

                    </div>
                    <div class="col-md-8">
                        <?= $detail->content ?>
                    </div>

                </div>
            </div>
        </div>
    <?php } ?>
</div>

<!-- End Content-fluid -->