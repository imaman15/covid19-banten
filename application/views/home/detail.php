<div class="container">
  <input type="hidden" id="base_url" value="<?= base_url() ?>">
  <input type="hidden" id="id" value="<?= $this->uri->segment('3') ?>">
  <input type="hidden" id="nama_kabupaten_default" value="<?= $kabupaten_detail[0]->nama_district ?>">
  <p class="h3 text-center mb-4 text-dark">Data Informasi Persebaran Corona Wilayah <?= ucwords($kabupaten_detail[0]->nama_district) ?></p>
  <div class="row text-right mb-4">
    <div class="col-md-8">
    </div>
    <div class="form-group col-md-4">
      <select id="filter_kabupaten" class="form-control text-right">
        <option value="<?= $this->uri->segment('3') ?>">Pilih Wilayah</option>
        <?php foreach ($kabupaten as $kabupaten) { ?>
          <option value="<?= $kabupaten->id_district ?>"><?= $kabupaten->nama_district ?></option>
        <?php } ?>
      </select>
    </div>
  </div>

  <!-- Area Chart -->
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary text-center" id="nama_kabupaten"><?= $kabupaten_detail[0]->nama_district ?></h6>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <canvas id="myAreaChart"></canvas>
          </div>
          <hr>
          <p class="text-center">Grafik Informasi Persebaran Corona Per Kabupaten</p>
        </div>
      </div>
    </div>
  </div>

  
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary text-center">Tabel Persebaran Corona Per Kecamatan</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Tanggal Update</th>
                  <th>Kecamatan / Kota</th>
                  <th>Orang Dalam Pantauan</th>
                  <th>Pasien Dalam Pengawasan</th>
                  <th>Positif</th>
                  <th>Sembuh</th>
                  <th>Meninggal</th>
                </tr>
              </thead>
              <tbody id="tbl_body">
            
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- End Content-fluid -->
</div>

<script src="<?php echo base_url() ?>assets/vendor/chart/chart.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/demo/detail.js"></script>

