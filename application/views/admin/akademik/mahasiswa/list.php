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
                  <div title="This is the title" class="mhs-tb-title" align="center">
                    <i class="far fa-circle fas fa-users"></i> Daftar Mahasiswa
                  </div>

                  <div align="center">

                    <!-- flashdata -->
                    <?php if ($this->session->flashdata('mahasiswa_deleted')) : ?>
                    <div class="alert alert-dismissible fade show bg-lime" id="alertDiv" style="width: 350px">
                      <h4><?= $this->session->flashdata('mahasiswa_deleted') ?> <i class="fas fa-trash"></i></h4>
                      <?php $this->session->unset_userdata('mahasiswa_deleted') ?>
                      <button type="button" id="closeAlert" class="close" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <?php endif ?>

                    <!-- Search -->
                    <h5>- Pencarian Data -</h5>
                    <form method="GET">

                      <!-- input keyword -->
                      <label for="keyword">1. </label>
                      <input type="search" title="Enter the keyword" class="input" name="keyword" placeholder="Masukkan NIM / Nama" value="<?= html_escape($keyword) ?>" maxlength="128" style="width: 230px">&nbsp&nbsp

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

                      <!-- select program studi -->
                      <label for="program_studi">3. </label>
                      <select title="Select.. uh, study program?" class="input" style="width: 230px" name="program_studi">
                        <option value="" selected>Semua Program Studi</option>
                        <?php foreach ($program_studix as $prodi) : ?>
                        <option value="<?= $prodi ?>" <?= set_select('program_studi', $prodi, $prodi == $program_studi ? TRUE : FALSE) ?>>
                          <?= $prodi ?>
                        </option>
                        <?php endforeach ?>
                      </select>&nbsp&nbsp

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
                <th class="mhs-th">NIM</th>
                <th class="mhs-th">Nama</th>
                <th class="mhs-th">Tempat Lahir</th>
                <th class="mhs-th">Tanggal Lahir</th>
                <th class="mhs-th">Jenis Kelamin</th>
                <th class="mhs-th">Alamat</th>
                <th class="mhs-th">No. Telepon</th>
                <th class="mhs-th">Program Studi</th>
                <th class="mhs-th">Aksi</th>
              </tr>
            </thead>
            <!-- /.th -->

            <!-- data -->
            <?php $i = 1; foreach ($mahasiswa as $mhs) : ?>
            <tbody>
              <tr class="mhs-tr">
                <td align="center" bgcolor="skyblue"><b><?= $i."." ?></b></td>
                <td class="mhs-td" bgcolor="papayawhip"><?= $mhs->nim ?></td>
                <td class="mhs-td" bgcolor="oldlace"><?=  $mhs->nama ?></td>
                <td class="mhs-td" bgcolor="papayawhip"><?=  $mhs->tpt_lahir ?></td>
                <td class="mhs-td" bgcolor="oldlace"><?=  $mhs->tgl_lahir ?></td>
                <td class="mhs-td" bgcolor="papayawhip"><?=  $mhs->kelamin ?></td>
                <td class="mhs-td" bgcolor="oldlace"><?=  $mhs->alamat ?></td>
                <td class="mhs-td" bgcolor="papayawhip"><?=  $mhs->no_telepon ?></td>
                <td class="mhs-td" bgcolor="oldlace"><?=  $mhs->program_studi ?></td>
                <td class="mhs-td-action">
                  <a title="Edit this Student's data" href="<?= base_url('admin/akademik/mahasiswa/edit/'.$mhs->id) ?>">
                    <Button class="mhs-btn-edit">
                      Ubah<img class="mhs-img-edit" src="<?= base_url('assets/images/pencil.png') ?>">
                    </Button>
                  </a><br>
                  <a title="Delete this Student's data" href="<?= base_url('admin/akademik/mahasiswa/delete/'. $mhs->id) ?>" onclick="return confirm('⚠ Hapus data? NIM: <?=  $mhs->nim.',  Nama: '. $mhs->nama ?>')">
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

                <!-- pagination -->
                <?php
                if (!empty($keyword) || !empty($kelamin) || !empty($program_studi)) { 
                  /* do nothing... I make it like this, so when the user use the search feature, the pagination feature won't showing (because i still have problems with search and pagination feature combined) */
                } 
                else {
                  echo $this->pagination->create_links();
                }
                ?>
                
                <!-- truncate -->
                <a title="All data will DELETED!" href="<?= base_url('admin/akademik/mahasiswa/truncate') ?>" onclick="return confirm('⚠ Anda yakin ingin MENGHAPUS SELURUH DATA MAHASISWA?')">
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