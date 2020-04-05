<div class="container">
  <p class="h2 text-center mb-4">Data Informasi Persebaran Corona Provinsi Banten</p>
  <div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-6 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Orang Dalam Pantauan (ODP)</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">350</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-diagnoses fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-6 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pasien Dalam Pengawasan (PDP)</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">215</div>
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
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Positif Corona</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">320</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user-injured fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Sembuh</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">32</div>
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
              <div class="h5 mb-0 font-weight-bold text-gray-800">340</div>
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
          <h6 class="m-0 font-weight-bold text-primary">Area Chart</h6>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <canvas id="myAreaChart"></canvas>
          </div>
          <hr>
          Styling for the area chart can be found in the <code>/js/demo/chart-area-demo.js</code> file.
        </div>
      </div>
    </div>
  </div>
  <p class="text-center">Grafik Informasi Persebaran Corona Per Kabupaten</p>
  <div class="row">
    <div class="col-md-6">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-center"> <a class="nav-link" href="detail.php">Lebak</a></h6>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <canvas id="myAreaChart2"></canvas>
          </div>
          <hr>
          <p class="text-right">
            <a class="btn btn-md bg-primary text-white" href="detail.php">Lihat Lebih Detal</a>
          </p>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-center"> <a class="nav-link" href="detail.php">Serang</a></h6>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <canvas id="myAreaChart3"></canvas>
          </div>
          <hr>
          <p class="text-right">
            <a class="btn btn-md bg-primary text-white" href="detail.php">Lihat Lebih Detal</a>
          </p>
        </div>
      </div>
    </div>

  </div>

  <!-- End Content-fluid -->
</div>
<script src="assets/vendor/chart/chart.min.js"></script>
<script src="assets/js/demo/chart-area-demo.js"></script>