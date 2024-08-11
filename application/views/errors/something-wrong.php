<!DOCTYPE html>
<html lang="en">

<?php 
$this->load->view('templates/head'); 
$this->load->view('templates/background_video'); 
?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <?php 
    $this->load->view('templates/sidebar'); 
    $this->load->view('templates/navbar');
    ?>

    <!-- content-wrapper -->
    <div class="bg-transparent content-wrapper p-3">

      <?php $this->load->view('templates/content_header'); ?>

      <div class="container-fluid" style="max-width: 600px">
        <div class="card card-outline card-danger p-1" style="background-color: oldlace" align="center">
          <h2 class="font-weight-bold">Terjadi Kesalahan... <i class="fas fa-bug"></i></h2>
          <h4>Coba ulangi proses, atau hubungi administrator</h4>
        </div>
      </div>

    </div>
    <!-- /.content-wrapper -->

    <?php $this->load->view('templates/footer') ?>

  </div>
  <!-- /.wrapper -->
</body>
</html>