<div class="container">
  <input type="hidden" id="base_url" value="<?= base_url() ?>">
  <p class="h3 text-center mb-4 text-dark">Data Informasi Persebaran Corona Wilayah <?= ucwords($kabupaten_detail[0]->nama_district) ?></p>
  <div class="row text-right mb-4">
    <div class="col-md-8">
    </div>
    <div class="form-group col-md-4">
      <select id="filter_kabupaten" class="form-control text-right">
        <option value="">Pilih wilayah</option>
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
          <h6 class="m-0 font-weight-bold text-primary text-center"><?= $kabupaten_detail[0]->nama_district ?></h6>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <canvas id="myAreaChart2"></canvas>
          </div>
          <hr>
          Styling for the area chart can be found in the <code>/js/demo/chart-area-demo.js</code> file.
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-center"> <a class="nav-link" href="<?= base_url('home/detail/') ?><?= $kabupaten->id_district ?>"><?= $kabupaten->nama_district ?></a></h6>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <canvas id="myAreaChart<?= $kabupaten->id_district ?>"></canvas>
          </div>
          <hr>
          <p class="text-right">
            <a class="btn btn-md bg-primary text-white" href="<?= base_url('home/detail/') ?><?= $kabupaten->id_district ?>">Lihat Lebih Detal</a>
          </p>
        </div>
      </div>
    </div>
  </div>
  <p class="text-center">Tabel Informasi Persebaran Corona Per Kabupaten</p>
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
              <tbody>
                <tr>
                  <td>31, Maret 2020</td>
                  <td>Rangkasbitung</td>
                  <td>33</td>
                  <td>22</td>
                  <td>61</td>
                  <td>24</td>
                  <td>32</td>
                </tr>
                <tr>
                  <td>31, Maret 2020</td>
                  <td>Cibadak</td>
                  <td>33</td>
                  <td>22</td>
                  <td>61</td>
                  <td>24</td>
                  <td>32</td>
                </tr>
                <tr>
                  <td>31, Maret 2020</td>
                  <td>Gunung Kencana</td>
                  <td>33</td>
                  <td>22</td>
                  <td>61</td>
                  <td>24</td>
                  <td>32</td>
                </tr>
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
<script src="<?php echo base_url() ?>assets/js/demo/chart-area-demo.js"></script>