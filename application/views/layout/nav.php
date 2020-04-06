 <!-- Main Content -->
 <div id="content">
     <nav id="main-navbar" class="navbar navbar-expand-md navbar-light bg-white shadow fixed-top">
         <div class="container">
             <a class="navbar-brand" href="<?php echo site_url() ?>">
                 <img class="img-profile" src="<?php echo base_url('assets/img/covid-512.png') ?>" width="40">
                 Covid-19 Banten
             </a>
             <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon"></span>
             </button>
             <div class="collapse navbar-collapse" id="navbarCollapse">
                 <ul class="navbar-nav ml-auto">
                     <!-- Nav Menu -->
                     <li class="nav-item">
                         <a class="nav-link p-3 hvr-shrink <?php echo ($this->uri->uri_string() ==  "") ? "active" : NULL; ?>" href="<?= site_url() ?>">Beranda</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link p-3 hvr-shrink <?php echo ($this->uri->uri_string() ==  U_NEWS) ? "active" : NULL; ?>" href="<?= site_url(U_NEWS) ?>">Info Kesehatan</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link p-3 hvr-shrink <?php echo ($this->uri->uri_string() ==  U_TEAM) ? "active" : NULL; ?>" href="<?= site_url(U_TEAM) ?>">Tim Relawan</a>
                     </li>
                 </ul>
             </div>
         </div>
     </nav>
     <!--End Content  -->
 </div>