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
                  <!-- title -->
                  <div title="This is the title" class="mhs-tb-title mb-3" align="center">
                    <i class="far fa-circle fas fa-users"></i> Daftar Karyawan
                    <br>
                    <!-- add -->
                    <a href="<?= base_url('admin/payroll/karyawan/add') ?>" class="btn btn-small btn-primary p-1" role="button">
                      <p class="h3">Tambah Data +</p>
                    </a>
                  </div>

                  <div align="center">

                    <!-- flashdata -->
                    <?php if ($this->session->flashdata('karyawan_deleted')) : ?>
                    <div class="alert alert-dismissible fade show bg-lime" id="alertDiv" style="width: 350px">
                      <h4><?= $this->session->flashdata('karyawan_deleted') ?> <i class="fas fa-trash"></i></h4>
                      <?php $this->session->unset_userdata('karyawan_deleted') ?>
                      <button title="close this notification" type="button" class="close" id="closeAlert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <?php endif ?>

                    <!-- search form -->
                    <h5>- Pencarian Data -</h5>
                    <form method="GET">

                      <!-- input keyword -->
                      <label for="keyword">Pencarian Karyawan: </label>
                      <input type="search" title="Enter the keyword" class="input" name="keyword" placeholder="Masukkan NIK / Nama" value="<?= html_escape($keyword) ?>" maxlength="128" style="width: 230px">&nbsp&nbsp

                      <!-- select kelamin -->
                      <label for="kelamin">2. </label>
                      <select title="Select gender" class="input" style="width: 230px" name="kelamin">
                        <option value="" selected>Semua Jenis Kelamin</option>
                        <?php foreach ($kelaminx as $klm) : ?>
                        <option value="<?= $klm ?>" <?= set_select('kelamin', $klm, $klm == $kelamin ? TRUE : FALSE) ?>>
                          <?= $klm ?>
                        </option>
                        <?php endforeach ?>
                      </select>&nbsp&nbsp

                      <!-- submit -->
                      <button title="Activate search engine" value="search" type="submit" class="btn-submit" style="background-color: aquamarine">
                        Cari <i class="fas fa-search"></i>
                      </button>
                    </form>
										<!-- /.Seacrh form -->

                  </div>
                </td>
              </tr>
            </thead>
            <!-- /.header row -->

            <!-- th-->
            <thead>
              <tr>
                <th class="mhs-th">No.</th>
                <th class="mhs-th">NIK</th>
                <th class="mhs-th">Nama</th>
                <th class="mhs-th">Tempat Lahir</th>
                <th class="mhs-th">Tanggal Lahir</th>
                <th class="mhs-th">Jenis Kelamin</th>
                <th class="mhs-th">Alamat</th>
                <th class="mhs-th">No. Telepon</th>
                <th class="mhs-th">Aksi</th>
              </tr>
            </thead>
            <!-- /.th -->

            <!-- data -->
            <?php $i = 1; foreach ($karyawan as $kry) : ?>
            <tbody>
              <tr class="mhs-tr">
                <td align="center" bgcolor="skyblue"><b><?= $i."." ?></b></td>
                <td class="mhs-td" bgcolor="papayawhip"><?= $kry->nik ?></td>
                <td class="mhs-td" bgcolor="oldlace"><?=  $kry->nama ?></td>
                <td class="mhs-td" bgcolor="papayawhip"><?=  $kry->tpt_lahir ?></td>
                <td class="mhs-td" bgcolor="oldlace"><?=  $kry->tgl_lahir ?></td>
                <td class="mhs-td" bgcolor="papayawhip"><?=  $kry->kelamin ?></td>
                <td class="mhs-td" bgcolor="oldlace"><?=  $kry->alamat ?></td>
                <td class="mhs-td" bgcolor="papayawhip"><?=  $kry->no_telepon ?></td>
                <td class="mhs-td-action">
                  <a title="Edit this Employee's data" href="<?= base_url('admin/payroll/karyawan/edit/'.$kry->id) ?>">
                    <Button class="mhs-btn-edit">
                      Ubah<img class="mhs-img-edit" src="<?= base_url('assets/images/pencil.png') ?>">
                    </Button>
                  </a><br>
                  <a title="Delete this Employee's data" href="<?= base_url('admin/payroll/karyawan/delete/'. $kry->id) ?>" onclick="return confirm('⚠ Hapus data? NIK: <?=  $kry->nik.',  Nama: '. $kry->nama ?>')">
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
                if (!empty($keyword)) { 
                  /* do nothing... I make it like this, so when the user use the search feature, the pagination feature won't showing (because i still have problems with search and pagination feature combined) */
                } 
                else {
                  echo $this->pagination->create_links();
                }
                ?>
                <a title="All data will DELETED!" href="<?= base_url('admin/payroll/karyawan/truncate') ?>" onclick="return confirm('⚠ Anda yakin ingin MENGHAPUS SELURUH DATA KARYAWAN?')">
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