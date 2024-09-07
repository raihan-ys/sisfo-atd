<!DOCTYPE html>
<html>

<?php
$this->load->view('templates/head');
$this->load->view('templates/background');
?>

<body class="hold-transition sidebar-mini layout-fixed">

<!-- wrapper -->
<div class="wrapper">

	<?php 
  $this->load->view('templates/navbar');
  $this->load->view('templates/sidebar'); 
  ?>

	<!-- content -->
	<div class="bg-transparent content-wrapper p-3">
		<div class="container-fluid" style="max-width: 5000px">
				<div class="card card-outline card-info">
          <table border="1">

            <!-- header row -->
            <thead>
              <tr>
                <td class="mhs-tb-header" colspan="12">
                  <!-- title -->
                  <div title="This is the title" class="mhs-tb-title mb-3" align="center">
                    <i class="far fa-circle fas fa-users"></i> Daftar Gaji
                    <br>
                    <!-- add -->
                    <a href="<?= base_url('admin/payroll/gaji/add') ?>" class="btn btn-small btn-primary" role="button">
                      <p class="h3">Tambah Data +</p>
                    </a>
                  </div>

                  <div align="center">

                    <!-- flashdata -->
                    <?php if ($this->session->flashdata('gaji_deleted')) : ?>
                    <div class="alert alert-dismissible fade show bg-lime" id="alertDiv" style="width: 350px">
                      <h4><?= $this->session->flashdata('gaji_deleted') ?> <i class="fas fa-trash"></i></h4>
                      <?php $this->session->unset_userdata('gaji_deleted') ?>
                      <button title="close this notification" type="button" class="close" id="closeAlert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <?php endif ?>

                    <!-- Search -->
                    <h5>- Pencarian Data -</h5>
                    <form method="GET">

                      <!-- input keyword -->
                      <label for="keyword">Pencarian Gaji</label>
                      <input type="search" title="Enter the keyword" class="input" name="keyword" placeholder="Masukkan No. Gaji" value="<?= html_escape($keyword) ?>" maxlength="128" style="width: 230px">&nbsp&nbsp

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
                <th class="mhs-th">No. Gaji</th>
								<th class="mhs-th">Tgl. Gaji</th>
								<th class="mhs-th">NIK</th>
                <th class="mhs-th">Kode Jabatan</th>
								<th class="mhs-th">Gaji Pokok</th>
                <th class="mhs-th">Tunjangan Beras</th>
                <th class="mhs-th">Potongan Terlambat</th>
								<th class="mhs-th">Potongan Absen</th>
								<th class="mhs-th">Bonus</th>
								<th class="mhs-th">Gaji Bersih</th>
                <th class="mhs-th">Aksi</th>
              </tr>
            </thead>
            <!-- /.th -->

            <!-- data -->
            <?php $i = 1; foreach ($gaji as $gj) : ?>
            <tbody>
              <tr class="mhs-tr">
                <td align="center" bgcolor="skyblue"><b><?= $i."."; $i++?></b></td>
                <td class="mhs-td" bgcolor="papayawhip"><?= $gj->no_gaji ?></td>
                <td class="mhs-td" bgcolor="oldlace"><?=  $gj->tgl_gaji ?></td>
                <td class="mhs-td" bgcolor="papayawhip"><?=  $gj->nik ?></td>
                <td class="mhs-td" bgcolor="oldlace"><?=  $gj->kode_jabatan ?></td>
								<td class="mhs-td" bgcolor="papayawhip"><?=  $gj->gaji_pokok ?></td>
								<td class="mhs-td" bgcolor="papayawhip"><?=  $gj->tunjangan_beras ?></td>
								<td class="mhs-td" bgcolor="oldlace"><?=  $gj->potongan_telat ?></td>
								<td class="mhs-td" bgcolor="papayawhip"><?=  $gj->potongan_absen ?></td>
								<td class="mhs-td" bgcolor="oldlace"><?=  $gj->bonus ?></td>
								<td class="mhs-td" bgcolor="papayawhip"><?=  $gj->gaji_bersih ?></td>
                <td class="mhs-td-action">
                  <a href="<?= base_url('admin/payroll/gaji/edit/'.$gj->id) ?>">
                    <Button class="mhs-btn-edit">
                      Ubah<img class="mhs-img-edit" src="<?= base_url('assets/images/pencil.png') ?>">
                    </Button>
                  </a><br>
                  <a href="<?= base_url('admin/payroll/gaji/delete/'. $gj->id) ?>" onclick="return confirm('⚠ Hapus data? No. Gaji: <?=  $gj->no_gaji.',  NIK: '. $gj->nik ?>')">
                    <Button class="mhs-btn-delete">
                      Hapus<img class="mhs-img-delete" src="<?= base_url('assets/images/cross-red.png') ?>">
                    </Button>
                  </a>
									<a href="<?= base_url('admin/payroll/gaji/print/'. $gj->id) ?>">
										<Button class="btn btn-rounded btn-warning m-1">
											Cetak
                      <i class="fas fa-print"></i>
										</Button>
									</a>		
                </td>
              </tr>
            </tbody>
            <?php endforeach; ?>
            <!-- /.data -->

            <!-- table footer -->
            <tr>
              <td class="mhs-tb-footer pr-1" colspan="12">
                <?php
                if (!empty($keyword)) { 
                  /* do nothing... I make it like this, so when the user use the search feature, the pagination feature won't showing (because i still have problems with search and pagination feature combined) */
                } 
                else {
                  echo $this->pagination->create_links();
                }
                ?>
                <a title="All data will DELETED!" href="<?= base_url('admin/payroll/gaji/truncate') ?>" onclick="return confirm('⚠ Anda yakin ingin MENGHAPUS SELURUH DATA GAJI?')">
                  <button class="mhs-btn-truncate">🔥 Hapus seluruh data</button>
                </a>
              </td>
            </tr>
          </table>
        </div>
        <!-- /.card -->.
		</div>
	</div>
	<!-- /.content -->
	
	<?php $this->load->view('templates/footer') ?>

</div>
<!-- wrapper -->

</body>
</html>