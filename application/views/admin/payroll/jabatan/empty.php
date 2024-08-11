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

    <div class="bg-transparent content-wrapper p-3">
      <div class="container-fluid" style="max-width: 1300px">
        <div class="card card-outline card-primary">
          <table border="1">

            <!-- header -->
            <thead>
              <tr>
                <td class="mhs-tb-header" colspan="10">

                  <!-- title -->
                  <div class="mhs-tb-title" align="center">
                    <a class="text-white" title="Go back, if the data you're searches with keyword is not found." href="<?= site_url('admin/payroll/jabatan') ?>">
                      <i class="far fa-circle fas fa-users"></i> Daftar Jabatan
                    </a>
                  </div>

                  <div align="center">

                  <!-- flashdata -->
                    <?php if ($this->session->flashdata('jabatan_deleted')) : ?>
                    <div class="alert alert-dismissible fade show bg-lime" role="alert" style="width: 380px">
                      <h4><?= $this->session->flashdata('jabatan_deleted') ?> <i class="fas fa-trash"></i></h4>
                      <?php $this->session->unset_userdata('jabatan_deleted') ?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <?php elseif ($this->session->flashdata('jabatan_truncated')) : ?>
                    <div class="alert alert-dismissible fade show bg-lime" role="alert" style="width: 500px">
                      <h4><?= $this->session->flashdata('jabatan_truncated') ?> <i class="fas fa-fire"></i></h4>
                      <?php $this->session->unset_userdata('jabatan_truncated') ?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <?php endif ?>
                         
                    <!-- search -->
                    <h5>- Pencarian Data -</h5>
                    <form method="GET">

                      <!-- input keyword -->
                      <label for="keyword">Pencarian Jabatan: </label>
                      <input class="input" style="width: 230px" title="Enter the keyword" type="search" name="keyword" placeholder="Masukkan Kode/Nama Jabatan" value="<?= html_escape($keyword) ?>">&nbsp&nbsp

                      <!-- btn submit -->
                      <button title="Search engine, activated!" type="submit" class="btn-submit" style="background-color: aquamarine">
                        Cari <i class="fas fa-search"></i>
                      </button>
                    </form>
                  </div>
                  <!-- /.seacrh -->

                </td>
              </tr>
            </thead>
            <!-- /.header -->

            <!-- content -->
            <tbody>
              <tr>
                <td style="background-color: oldlace">
                  <h1 align="center">Tidak ada yang ditemukan!</h1>
                  <h5 align="center">
                    <a class="text-info" href="<?= site_url('admin/payroll/jabatan/add') ?>">Tambah data</a>
                    atau coba cari dengan kata kunci yang berbeda!
                  </h5>
                </td>
              </tr>
            </tbody>
            <!-- /.content -->
          </table> 
        </div>
        <!-- /.card -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content-wrapper -->
  
    <?php $this->load->view('templates/footer') ?>

  </div>
  <!-- /.wrapper -->
</body>
</html>