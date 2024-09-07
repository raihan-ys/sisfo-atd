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
			<div class="container-fluid">
				<table class="mx-auto" cellspacing="10" cellpadding="15">

					<!-- header -->
					<tr>
						<th scope="col" colspan="2">
							<img class="mhs-input-img d-block mx-auto mb-2" src="<?= base_url('assets/images/laptop-input.png') ?>">
							<h2 class="mhs-input-header p-1 d-block text-center mx-auto"><i class="far fa-circle fas fa-download"></i> Input Data Jabatan</h2>
							<!-- flashdata -->
							<?php if ($this->session->flashdata('jabatan_saved')) : ?>
							<div class="mx-auto alert alert-dismissible fade show bg-lime" id="alertDiv" style="width: 380px;">
								<h4 class="text-center"><?= $this->session->flashdata('jabatan_saved') ?> 👍</h4>
								<?php $this->session->unset_userdata('jabatan_saved') ?>
								<button title="Close this notification" type="button" class="close" id="closeAlert" aria-label="close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<?php endif ?>
						</th>
					</tr>
					<!-- /.header -->

					<form method="POST">
            <ul>
              <!-- kode jabatan -->
              <tr>
                <td class="mhs-td-label"><li class="mhs-label">Kode Jabatan</li></td>
                <td>
                  <b class="mhs-label">: &nbsp</b>
                  <input type="text" class="<?= form_error('kode_jabatan') ? 'input-invalid' : 'input' ?>" name="kode_jabatan" id="kode_jabatan" placeholder="Maks. 10 karakter" maxlength="10" value="<?= set_value('kode_jabatan') ?>" required>
                  <?= form_error('kode_jabatan', '<div class="text-tomato font-weight-bold">', '</div>') ?>
                </td>
              </tr>

              <!-- nama jabatan -->
              <tr>
                <td class="mhs-td-label"><li class="mhs-label">Nama Jabatan</li></td>
                <td>
                  <b class="mhs-label">: &nbsp</b>
                  <input type="text" class="<?= form_error('nama_jabatan') ? 'input-invalid' : 'input' ?>" name="nama_jabatan" id="nama_jabatan" placeholder="Maks. 30 karakter" maxlength="30" value="<?= set_value('nama_jabatan') ?>" required>
                  <?= form_error('nama_jabatan', '<div class="text-tomato font-weight-bold">', '</div>') ?>
                </td>
              </tr>

              <!-- gaji pokok -->
              <tr>
                <td class="mhs-td-label"><li class="mhs-label">Gaji Pokok</li></td>
                <td>
                  <b class="mhs-label">: &nbsp</b>
                  <input type="number" class="<?= form_error('gaji_pokok') ? 'input-invalid' : 'input' ?>" name="gaji_pokok" id="gaji_pokok" placeholder="Maks. 10 digit" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="10" value="<?= set_value('gaji_pokok') ?>" required>
                  <?= form_error('gaji_pokok', '<div class="text-tomato font-weight-bold">', '</div>') ?>
                </td>
              </tr>

              <!-- tunjangan beras -->
              <tr>
                <td class="mhs-td-label"><li class="mhs-label">Tunjangan Beras</li></td>
                <td>
                  <b class="mhs-label">: &nbsp</b>
                  <input type="number" class="<?= form_error('tunjangan_beras') ? 'input-invalid' : 'input' ?>" name="tunjangan_beras" id="tunjangan_beras" placeholder="Maks. 10 digit" oninput="this.value = this.value.replace(/[^0-9]/g, '');" value="<?= set_value('tunjangan_beras') ?>">
                  <?= form_error('tunjangan_beras', '<div class="text-tomato font-weight-bold">', '</div>') ?>
                </td>
              </tr>
            </ul>
            <!-- /.ul input -->

            <!-- buttons -->
            <td colspan="2" align="center">
              <br>

              <button type="submit" class="btn-submit">
                <b>Simpan <i class="fas fa-save"></i></b>
              </button>&nbsp&nbsp

              <script type="text/javascript">
                function bersih() {
                  // empty form fields
                  document.getElementById('kode_jabatan').value = ''; 
                  document.getElementById('nama_jabatan').value = '';
                  document.getElementById('gaji_pokok').value = '';
                  document.getElementById('tunjangan_beras').value = '';
                }
              </script>

              <button type="button" class="btn-reset" onclick="bersih()">
                <b>Bersih <i class="fas fa-broom"></i></b>
              </button>
            </td>
            <!-- buttons -->

					</form>
				</table>
			</div>
			<!-- /.container-fluid -->
		</div>
		<!-- /.content-wrapper -->

		<?php $this->load->view('templates/footer') ?>

	</div>
	<!-- /.wrapper -->
</body>
</html>