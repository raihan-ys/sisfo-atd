<!DOCTYPE html>
<html lang="en">

<?php 
$this->load->view('templates/head');
$this->load->view('templates/background');
?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <?php
    $this->load->view('templates/sidebar'); 
    $this->load->view('templates/navbar'); 
    ?>

    <div class="content-wrapper bg-transparent p-3">

      <?php $this->load->view('templates/content-header') ?>

      <div class="container-fluid" style="max-width: 2000px">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-outline card-primary">
              <div class="card-header text-center">
                <h1>Selamat Datang di Sistem Informasi ATD</h1>
                <h5>AMIK "Tri Dharma" Pku</h5>
              </div>
              <div class="card-body">
                <p class="text-center">Sistem informasi ini dibuat untuk memudahkan mahasiswa dalam mengakses informasi terkait Akademi Manajemen Informatika dan Komputer "Tri Dharma" Pekanbaru.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content-wrapper -->
    <?php $this->load->view('templates/footer') ?>
  </div>
  <!--/.wrapper -->
</body>
</html>
