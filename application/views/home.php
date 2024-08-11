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

        <!-- introduction -->
        <div class="jumbotron card card-outline card-primary text-center">
          <img id="intro-pic" height="600" src="<?= base_url('assets/images/one-piece.jpg') ?>" alt="Monkey D Luffy">
          <br>
          <h1 id="intro-name">_RAINHARDER</h1>
          <h5>Website ini dibuat sebagai portfolio saya. <b>"Silahkan Dilihat"</p>
        </div>

        <!-- about me -->
        <div class="jumbotron card card-outline card-danger elevation-3 bg-primary text-center">
          <h1>About Me</h1>
          <h5>
            Perkenalkan Nama saya RAIHAN YUDI SYUKMA, seorang mahasiswa INSTITUT AZ ZUHRA program studi D3 Manajemen Informatika. Saya memiliki kemampuan menguasai bahasa pemrograman PHP.
            <br>
            <em>"Ajarin JavaScript dong puh sepuh, biar kayak sepuhkan?"</em>
            <br><br>
            <img class="img img-circle elevation-3" src="<?= base_url('assets/images/atd-logo.png') ?>" alt="Logo ATD" width="300">
          </h5>
        </div>

        <!-- others -->
        <div class="jumbotron elevation-3 card card-outline card-primary">
          <div class="row">
            <!-- service -->
            <div class="col small-box bg-dark m-5 p-3 text-center">
              <h3>Service</h3>
              <img src="<?= base_url('assets/images/laptop-input.png') ?>" width="80%" alt="Computer Image"/>
              <p>We provide many exciting services and of course your satisfaction is our top priority.</p>
              <button class="btn btn-block btn-primary">See Now</button>
            </div>

            <!-- portfolio -->
            <div class="col small-box bg-dark m-5 p-3 text-center">
              <h3>Portfolio</h3>
              <img src="<?= base_url('assets/images/laptop-input.png') ?>" width="80%" alt="Computer Image"/>
              <p>Our team has worked on many projects and they were all done by professionals.</p>
              <button class="btn btn-block btn-secondary">Coming Soon</button>
            </div>

            <!-- coming soon -->
            <div class="col small-box bg-dark m-5 p-3 text-center">
              <h3>Coming Soon</h3>
            </div>
          </div>
        </div>
        <!-- /.others -->

        <!-- profile -->
        <div class="row">
          <div class="col small-box m-5 elevation-3 bg-white text-center p-2">
            <h1 class="text-primary">DATA DIRI</h1>
            <br>
            <h2>
              NIM : 21010019
              <br>
              <img src="<?= base_url('assets/images/user.png') ?>" height="500" alt="User's avatar">
              <br>
              RAIHAN YUDI SYUKMA
            </h2>
          </div>
        
          <div class="col small-box m-5 elevation-3 bg-white text-center p-2">
            <h1 class="text-primary">DATA DIRI</h1>
            <br>
            <h2>
              NIM : 21010019
              <br>
              <img src="<?= base_url('assets/images/user.png') ?>" height="500" alt="User's avatar">
              <br>
              RAIHAN YUDI SYUKMA
            </h2>
          </div>
        </div>
        <!-- /.profile -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content-wrapper -->
    <?php $this->load->view('templates/footer') ?>
  </div>
  <!--/.wrapper -->
</body>
</html>
