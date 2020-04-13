<div class="container">
  <input type="hidden" id="base_url" value="<?= base_url() ?>">
  <p class="h3 text-center mb-4 text-dark">Data Informasi Persebaran Corona Provinsi Banten</p>
  <div class="row">

    <div class="col-xl-6 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Orang Dalam Pantauan (ODP)</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah[0]->tot_odp ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-diagnoses fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-6 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pasien Dalam Pengawasan (PDP)</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah[0]->tot_pdp ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-procedures fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- End Row -->
  </div>
  <div class="row">

    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Positif Corona</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah[0]->tot_positif ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user-injured fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Sembuh</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah[0]->tot_sembuh ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clinic-medical fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Meninggal</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah[0]->tot_meninggal ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-ambulance fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Row -->
  </div>
  <!-- Area Chart -->
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary text-center">Grafik Provinsi Banten</h6>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <canvas id="myAreaChart"></canvas>
          </div>
        </div>
        <div class="card-footer">.
          <div class="row mt-n4 justify-content-center">
            <div class="col-md-3 small">
              <div class="p-2 d-flex align-items-center"><i class="fas fa-circle text-primary"></i><span class="pl-2">Orang Dalam Pantauan (ODP)</span></div>
            </div>
            <div class="col-md-3 small">
              <div class="p-2 d-flex align-items-center"><i class="fas fa-circle text-info"></i><span class="pl-2">Pasien Dalam Pengawasan (PDP)</span></div>
            </div>
            <div class="col-md-2 small">
              <div class="p-2 d-flex align-items-center"><i class="fas fa-circle text-warning"></i><span class="pl-2">Positif</span></div>
            </div>
            <div class="col-md-2 small">
              <div class="p-2 d-flex align-items-center"><i class="fas fa-circle text-success"></i><span class="pl-2">Sembuh</span></div>
            </div>
            <div class="col-md-2 small">
              <div class="p-2 d-flex align-items-center"><i class="fas fa-circle text-danger"></i><span class="pl-2">Meninggal</span></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <p class="text-center">Grafik Informasi Persebaran Corona Per Kabupaten</p>
  <div class="row">
    <?php foreach ($kabupaten as $kabupaten) { ?>
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
              <a class="btn btn-md bg-primary text-white" href="<?= base_url('home/detail/') ?><?= $kabupaten->id_district ?>">Lihat Lebih Detail</a>
            </p>
          </div>
          <div class="card-footer" style="font-size: 14px;">.
            <div class="row mt-n4 justify-content-center small">
              <div class="col-lg-3 ml-lg-n4">
                <div class="p-2 d-flex align-items-center"><i class="fas fa-circle text-primary"></i><span class="pl-1">Orang Dalam Pantauan (ODP)</span></div>
              </div>
              <div class="col-lg-3 ml-lg-n4">
                <div class="p-2 d-flex align-items-center"><i class="fas fa-circle text-info"></i><span class="pl-1">Pasien Dalam Pengawasan (PDP)</span></div>
              </div>
              <div class="col-lg-2">
                <div class="p-2 d-flex align-items-center"><i class="fas fa-circle text-warning"></i><span class="pl-1">Positif</span></div>
              </div>
              <div class="col-lg-2">
                <div class="p-2 d-flex align-items-center"><i class="fas fa-circle text-success"></i><span class="pl-1">Sembuh</span></div>
              </div>
              <div class="col-lg-2">
                <div class="p-2 d-flex align-items-center"><i class="fas fa-circle text-danger"></i><span class="pl-1">Meninggal</span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>

  <!-- End Content-fluid -->
</div>


<script src="<?php echo base_url() ?>assets/vendor/chart/chart.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/demo/chart-area-demo.js"></script>