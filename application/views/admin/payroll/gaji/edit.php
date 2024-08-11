<?php

// Use constants for database credentials.
define('hostname', 'localhost');
define('username', 'root');
define('password', '');
define('database', 'atd_payroll');

// Try to connect with MySQL database, with above credentials.
try {
	$db = mysqli_connect(hostname, username, password, database);

	// If the connection fails.
	if (!$db) {
		throw new Exception('Failed to connect to the database!');
	}

	// If the connection success, then perform the desired operation..

} catch (Exception $e) {
	// Log the error.
	error_log("Failed to connect to the database: ".mysqli_connect_error());

	// Display a user-friendly error message.
	echo '<h3 style="color: red">Failed to connect to the database, Please try again!</h3>';

	// Stop this file execution
	exit;
}
?>

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
				<table align="center" border="0" cellspacing="10" cellpadding="15">

					<!-- header -->
					<tr>
						<td colspan="2" align="center">
							<img class="mhs-input-img" src="<?= base_url('assets/images/laptop-input.png') ?>"><br><br>	
							<!-- title -->
							<h2 class="mhs-input-header"><i class="far fa-circle fas fa-pencil"></i> Ubah Data Penggajian</h2>
							<!-- flashdata -->
							<?php if ($this->session->flashdata('gaji_saved')) : ?>
							<div class="alert alert-dismissible fade show bg-lime" role="alert" style="width: 380px">
								<h4 align="center"><?= $this->session->flashdata('gaji_saved') ?> 👍</h4>
								<?php $this->session->unset_userdata('gaji_saved') ?>
								<button title="Close this notification" type="button" class="close" data-dismiss="alert" aria-label="close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<?php endif ?>
						</td>
					</tr>
					<!-- /.header -->
								 
					<form method="POST">
					<ul>
						<!-- no_gaji -->
						<tr>
							<td class="mhs-td-label"><li class="mhs-label">No. Gaji</li></td>
							<td>
								<b class="mhs-label">: &nbsp</b>
								<input type="text" class="<?= form_error('no_gaji') ? 'input-invalid' : 'input' ?>" name="no_gaji" id="no_gaji" placeholder="Maks. 10 karakter" maxlength="10" value="<?= set_value('no_gaji') ?>" required>
								<?= form_error('no_gaji', '<div class="text-tomato font-weight-bold">', '</div>') ?>
							</td>
						</tr>

						<!-- tgl_gaji -->
						<tr>
							<td class="mhs-td-label"><li class="mhs-label">Tgl. Gaji</li></td>
							<td>
								<b class="mhs-label">: &nbsp</b>
								<input type="date" class="<?= form_error('tgl_gaji') ? 'input-invalid' : 'input' ?>" name="tgl_gaji" id="tgl_gaji" value="<?= set_value('tgl_gaji') ?>" required>
								<?= form_error('tgl_gaji', '<div class="text-tomato font-weight-bold">', '</div>') ?>
							</td>
						</tr>

						<!-- nik -->
						<tr>
							<td class="mhs-td-label"><li class="mhs-label">NIK</li></td>
							<td>
								<b class="mhs-label">: &nbsp</b>
								<select class="<?= form_error('nik') ? 'input-invalid' : 'input' ?>" name="nik" id="nik" required>
									<option value="" selected disabled hidden>Pilih Karyawan</option>
									<?php $selectKaryawan = mysqli_query($db, "SELECT * FROM karyawan") ?>
									<?php while ($karyawan = mysqli_fetch_array($selectKaryawan)) : ?>
								
									<option value="<?= $karyawan['nik'] ?>" <?= set_select('nik', $karyawan['nik']) ?>>
										<?= $karyawan['nik'] ." ==> ". $karyawan['nama'] ?>
									</option>
	
									<?php endwhile ?>
								<?= form_error('nik', '<div class="text-tomato font-weight-bold">', '</div>') ?>
							</td>
						</tr>

						<!-- kode jabatan -->
						<tr>
							<td class="mhs-td-label"><li class="mhs-label">Kode Jabatan</li></td>
							<td>
								<b class="mhs-label">: &nbsp</b>
								<select class="<?= form_error('kode_jabatan') ? 'input-invalid' : 'input' ?>" name="kode_jabatan" id="kode_jabatan" onchange="changeValue(this.value)" required>
									<option value="" selected disabled hidden>Pilih Jabatan</option>

									<!-- Query to get all jabatan. -->
									<?php $selectJabatan = mysqli_query($db, "SELECT * FROM jabatan") ?>

									<!-- Prepare a variable that contains a javascript array definition. -->
									<?php $jsArray = "var jsArray = new Array(); \n"; ?>

									<!-- Display all jabatan as <option>(s). -->
									<?php while ($jabatan = mysqli_fetch_array($selectJabatan)) : ?>

									<option value="<?= $jabatan['kode_jabatan'] ?>" <?= set_select('kode_jabatan', $jabatan['kode_jabatan']) ?>>
										<?= $jabatan['kode_jabatan'] ." ==> ". $jabatan['nama_jabatan'] ?>
									</option>

									<!-- Define $jsArray['".$jabatan['kode_jabatan']."']'s value. -->
									<?php
									$jsArray .= "jsArray['".$jabatan['kode_jabatan']."'] = 
									{
										gaji_pokok:'".addslashes($jabatan['gaji_pokok'])."',
										tunjangan_beras:'".addslashes($jabatan['tunjangan_beras'])."'
									}; \n"; 
									?>

									<?php endwhile ?>
								<?= form_error('kode_jabatan', '<div class="text-tomato font-weight-bold">', '</div>') ?>
							</td>
						</tr>

						<script type="text/javascript">

						// Define a new javascript array.
						<?= $jsArray ?>
							function changeValue(kode_jabatan) {	
								document.getElementById('gaji_pokok').value = jsArray[kode_jabatan].gaji_pokok;
								document.getElementById('tunjangan_beras').value = jsArray[kode_jabatan].tunjangan_beras;
							};
						</script>

						<!-- gaji_pokok -->
						<tr>
							<td class="mhs-td-label"><li class="mhs-label">Gaji Pokok</li></td>
							<td>
								<b class="mhs-label">: &nbsp</b>
								<input type="number" class="<?= form_error('gaji_pokok') ? 'input-invalid' : 'input' ?>" style="background: wheat" name="gaji_pokok" id="gaji_pokok" value="<?= set_value('gaji_pokok') ?>" required readonly>
								<?= form_error('gaji_pokok', '<div class="text-tomato font-weight-bold">', '</div>') ?>
							</td>
						</tr>

						<!-- tunjangan_beras -->
						<tr>
							<td  class="mhs-td-label"><li class="mhs-label">Tunjangan Beras</li></td>
							<td>
								<b class="mhs-label">: &nbsp</b>
								<input type="number" class="<?= form_error('tunjangan_beras') ? 'input-invalid' : 'input' ?>" style="background: wheat" name="tunjangan_beras" id="tunjangan_beras" value="<?= set_value('tunjangan_beras') ?>" required readonly>
								<?= form_error('tunjangan_beras', '<div class="text-tomato font-weight-bolder">', '</div>') ?>
							</td>
						</tr>

						<!-- potongan_telat -->
						<tr>
							<td class="mhs-td-label"><li class="mhs-label">Potongan Telat</li></td>
							<td>
								<b class="mhs-label">: &nbsp</b>
								<input type="number" class="<?= form_error('potongan_telat') ? 'input-invalid' : 'input' ?>" name="potongan_telat" id="potongan_telat" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="<?= set_value('potongan_telat') ?>" required>
								<?= form_error('potongan_telat', '<div class="text-tomato font-weight-bold">', '</div>') ?>
							</td>
						</tr>
						
						<!-- potongan_absen -->
						<tr>
							<td class="mhs-td-label"><li class="mhs-label">Potongan Absen</li></td>
							<td>
								<b class="mhs-label">: &nbsp</b>
								<input type="number" class="<?= form_error('potongan_absen') ? 'input-invalid' : 'input' ?>" name="potongan_absen" id="potongan_absen" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="<?= set_value('potongan_absen') ?>" required>
								<?= form_error('potongan_absen', '<div class="text-tomato font-weight-bold">', '</div>') ?>
							</td>
						</tr>	
						
						<!-- bonus -->
						<tr>
							<td class="mhs-td-label"><li class="mhs-label">Bonus</li></td>
							<td>
								<b class="mhs-label">: &nbsp</b>
								<input type="tel" class="<?= form_error('bonus') ? 'input-invalid' : 'input' ?>" name="bonus" id="bonus" placeholder="Maks. 10 digit" maxlength="15" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="<?= set_value('bonus') ?>" required>
								<?= form_error('bonus', '<div class="text-tomato font-weight-bold">', '</div>') ?>
							</td>
						</tr>

						<tr>
							<td colspan="2">
								<button type="button" class="btn btn-success btn-block" id="btn-count" onclick="count()">
									<h5>Count</h5>
								</button>
							</td>
						</tr>

						<!-- gaji_bersih -->
						<tr>
							<td class="mhs-td-label"><li class="mhs-label">Gaji Bersih</li></td>
							<td>
								<b class="mhs-label">: &nbsp</b>
								<input type="tel" class="<?= form_error('gaji_bersih') ? 'input-invalid' : 'input' ?>" name="gaji_bersih" id="gaji_bersih" placeholder="Maks. 10 digit" maxlength="15" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="<?= set_value('gaji_bersih') ?>" required readonly>
								<?= form_error('gaji_bersih', '<div class="text-tomato font-weight-bold">', '</div>') ?>
							</td>
						</tr>				

					<tr>
						<!-- buttons -->
						<td colspan="2" align="center">
							<br>

							<!-- submit -->
							<button type="submit" class="btn-submit">
								<b>Simpan <i class="fas fa-save"></i></b>
							</button>&nbsp&nbsp

							<script type="text/javascript">
								// Get HTML elements.
								$gaji_pokok = Number(document.getElementById('gaji_pokok').value)
								$tunjangan_beras = Number(document.getElementById('tunjangan_beras').value)
								$potongan_telat = Number(document.getElementById('potongan_telat').value)
								$potongan_absen = Number(document.getElementById('potongan_absen').value)
								$bonus = Number(document.getElementById('bonus').value)
								$gaji_bersih = Number(document.getElementById('gaji_bersih').value)

								// Empty the form fields.	
								function bersih() {
									document.getElementById('no_gaji').value = ''
									document.getElementById('tgl_gaji').value = ''
									document.getElementById('nik').value = ''
									document.getElementById('kode_jabatan').value = ''
									$gaji_pokok.value = ''
									$tunjangan_beras.value = ''
									$potongan_absen.value = ''
									$bonus.value = ''
									$bonus.value = ''
									document.getElementById('gaji_bersih').value = ''
								}

								// Counts gaji bersih.
								function count() {
									$gaji_bersih_x = $gaji_pokok + $tunjangan_beras - $potongan_telat - $potongan_absen + $bonus;
									document.getElementById('gaji_bersih').value = $gaji_bersih_x
								}
							</script>

							<!-- empty the form fields value. -->
							<button type="button" class="btn-reset" onclick="bersih()">
								<b>Bersih <i class="fas fa-broom"></i></b>
							</button>
						</td>
					</tr>
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