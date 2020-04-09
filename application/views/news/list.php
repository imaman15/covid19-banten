<div class="container">
  <p class="h3 text-center mb-4 text-dark">Informasi Kesehatan dan Berita tentang Corona</p>

  <div class="row mb-2">
    <?php foreach ($berita as $berita) { ?>
      <div class="col-md-6">
        <div class="card flex-md-row mb-4 box-shadow h-md-250">
          <img class="card-img-right flex-auto d-none d-md-block" src="<?= base_url('assets/img/news/') . $berita->img ?>" height="200" width="200" alt="Card image cap">
          <div class="card-body d-flex flex-column align-items-start">
            <strong class="d-inline-block mb-2 text-primary"><?= ($berita->kategori == 1) ? "Info Kesehatan" : "Berita"; ?></strong>
            <h3 class="mb-0">
              <a class="text-dark" href="<?= base_url('news/detail/') . $berita->id_news ?>"><?= $berita->title ?></a>
            </h3>
            <div class="mb-1 text-muted"><?= tgl_indo($berita->tgl_publish) ?></div>
            <p class="card-text mb-auto"><?= substr($berita->content, 0, 100) . '...'; ?></p>
            <a href="<?= base_url('news/detail/') . $berita->id_news ?>">Continue reading</a>
          </div>
        </div>
      </div>
    <?php } ?>

  </div>

</div>