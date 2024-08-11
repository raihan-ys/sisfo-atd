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

    <!-- Content Wrapper -->
    <div class="bg-transparent content-wrapper p-3">

      <!-- Main content -->
      <div class="container-fluid" style="max-width: 3500px">
        <div class="card card-outline card-info">
          <table border="1">

            <!-- header row -->
            <thead>
              <tr>
                <td class="mhs-tb-header" colspan="10">

                  <!-- add -->
                  <a href="<?= base_url('admin/payroll/jabatan/add') ?>" class="btn btn-block btn-primary" role="button">
                    <h3>Tambah Data +</h3>
                  </a>

                  <br>

                  <!-- title -->
                  <div title="This is the title" class="mhs-tb-title" align="center">
                    <i class="far fa-circle fas fa-users"></i> Daftar Jabatan
                  </div>

                  <div align="center">

                    <!-- flashdata -->
                    <?php if ($this->session->flashdata('jabatan_deleted')) : ?>
                    <div class="alert alert-dismissible fade show bg-lime" role="alert" style="width: 350px">
                      <h4><?= $this->session->flashdata('jabatan_deleted') ?> <i class="fas fa-trash"></i></h4>
                      <?php $this->session->unset_userdata('jabatan_deleted') ?>
                      <button title="close this notification" type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <?php endif ?>

                    <!-- Search -->
                    <h5>- Pencarian Data -</h5>
                    <form method="GET">

                      <!-- input keyword -->
                      <label for="keyword">Pencarian Jabatan</label>
                      <input type="search" title="Enter the keyword" class="input" name="keyword" placeholder="Masukkan Kode/Nama Jabatan" value="<?= html_escape($keyword) ?>" maxlength="128" style="width: 230px">&nbsp&nbsp

                      <!-- submit -->
                      <button title="Activate search engine" value="search" type="submit" class="btn-submit" style="background-color: aquamarine">
                        Cari <i class="fas fa-search"></i>
                      </button>
                    </form>
                  </div>
                  <!-- /.Seacrh -->
                </td>
              </tr>
            </thead>
            <!-- /.header row -->

            <!-- th-->
            <thead>
              <tr>
                <th class="mhs-th">No.</th>
                <th class="mhs-th">Kode Jabatan</th>
                <th class="mhs-th">Nama Jabatan</th>
                <th class="mhs-th">Gaji Pokok</th>
                <th class="mhs-th">Tunjangan Beras</th>
                <th class="mhs-th">Aksi</th>
              </tr>
            </thead>
            <!-- /.th -->

            <!-- data -->
            <?php $i = 1; foreach ($jabatan as $jbt) : ?>
            <tbody>
              <tr class="mhs-tr">
                <td align="center" bgcolor="skyblue"><b><?= $i."." ?></b></td>
                <td class="mhs-td" bgcolor="papayawhip"><?= $jbt->kode_jabatan ?></td>
                <td class="mhs-td" bgcolor="oldlace"><?=  $jbt->nama_jabatan ?></td>
                <td class="mhs-td" bgcolor="papayawhip"><?=  $jbt->gaji_pokok ?></td>
                <td class="mhs-td" bgcolor="oldlace"><?=  $jbt->tunjangan_beras ?></td>
                <td class="mhs-td-action">
                  <a title="Edit this Postions's data" href="<?= base_url('admin/payroll/jabatan/edit/'.$jbt->id) ?>">
                    <Button class="mhs-btn-edit">
                      Ubah<img class="mhs-img-edit" src="<?= base_url('assets/images/pencil.png') ?>">
                    </Button>
                  </a><br>
                  <a title="Delete this Position's data" href="<?= base_url('admin/payroll/jabatan/delete/'. $jbt->id) ?>" onclick="return confirm('⚠ Hapus data? NIM: <?=  $jbt->kode_jabatan.',  Nama: '. $jbt->nama_jabatan ?>')">
                    <Button class="mhs-btn-delete">
                      Hapus<img class="mhs-img-delete" src="<?= base_url('assets/images/cross-red.png') ?>">
                    </Button>
                  </a>
                </td>
              </tr>
            </tbody>
            <?php $i++; endforeach; ?>
            <!-- /.data -->

            <!-- table footer -->
            <tr>
              <td class="mhs-tb-footer pr-1" colspan="10">
                <?php
                if (!empty($keyword) || !empty($kelamin) || !empty($program_studi)) { 
                  /* do nothing... I make it like this, so when the user use the search feature, the pagination feature won't showing (because i still have problems with search and pagination feature combined) */
                } 
                else {
                  echo $this->pagination->create_links();
                }
                ?>
                <a title="All data will DELETED!" href="<?= base_url('admin/payroll/jabatan/truncate') ?>" onclick="return confirm('⚠ Anda yakin ingin MENGHAPUS SELURUH DATA JABATAN?')">
                  <button class="mhs-btn-truncate">🔥 Hapus seluruh data</button>
                </a>
              </td>
            </tr>
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