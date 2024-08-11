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

    <!-- Content Wrapper -->
    <div class="bg-transparent content-wrapper p-3">
      <?php $this->load->view('templates/content_header') ?>

      <!-- content -->
      <div class="container-fluid" style="max-width: 800px">
        <div class="card card-outline card-danger p-1" style="background-color: oldlace" align="center">
          <h1 class="font-weight-bold">📜?</h1> 
          <h1><b>404</b> ; Halaman tidak ditemukan!</h1>
          <h5>Halaman yang kamu cari mungkin masih dikerjakan, atau tidak berada di website ini!</h5>
        </div>
      </div>
      <!-- /.content -->
      
    </div>
    <!-- /.content wrapper -->

    <?php $this->load->view('templates/footer') ?>
    
  </div>
  <!-- /.wrapper -->
</body>
</html>