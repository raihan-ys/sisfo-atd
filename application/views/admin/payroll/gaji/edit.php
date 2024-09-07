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
							<h2 class="mhs-input-header d-block mx-auto text-center"><i class="fas fa-edit"></i> Ubah Data Penggajian</h2>
							<!-- flashdata -->
							<?php if ($this->session->flashdata('gaji_updated')) : ?>
							<div class="alert alert-dismissible fade show bg-lime mx-auto" id="alertDiv" style="width: 380px">
								<h4 class="text-center"><?= $this->session->flashdata('gaji_updated') ?> 👍</h4>
								<?php $this->session->unset_userdata('gaji_updated') ?>
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
							<!-- no_gaji -->
							<tr>
								<th scope="row" class="mhs-td-label"><li class="mhs-label">No. Gaji</li></td>
								<td>
									<b class="mhs-label">: &nbsp</b>
									<input type="text" class="<?= form_error('no_gaji') || $this->session->flashdata('no_duplicated') ? 'input-invalid' : 'input' ?>" name="no_gaji" id="no_gaji" placeholder="Maks. 10 karakter" maxlength="10" value="<?= set_value('no_gaji', $gaji->no_gaji) ?>" required>
									<?= form_error('no_gaji', '<div class="text-tomato font-weight-bold">', '</div>') ?>
									<!-- if the submitted no_gaji is alredy taken -->
									<?php if ($this->session->flashdata('no_duplicated')) : ?>
									<br>
									<div class="text-tomato font-weight-bold">
										<?= $this->session->flashdata('no_duplicated') ?>
										<!-- <?php $this->session->unset_userdata('no_duplicated') ?> -->
									</div>
									<?php endif ?>
								</td>
							</tr>

							<!-- tgl_gaji -->
							<tr>
								<th scope="row" class="mhs-td-label"><li class="mhs-label">Tgl. Gaji</li></td>
								<td>
									<b class="mhs-label">: &nbsp</b>
									<input type="date" class="<?= form_error('tgl_gaji') ? 'input-invalid' : 'input' ?>" name="tgl_gaji" id="tgl_gaji" value="<?= set_value('tgl_gaji', $gaji->tgl_gaji) ?>" required>
									<?= form_error('tgl_gaji', '<div class="text-tomato font-weight-bold">', '</div>') ?>
								</td>
							</tr>

							<!-- nik -->
							<tr>
								<th scope="row" class="mhs-td-label"><li class="mhs-label">NIK</li></td>
								<td>
									<b class="mhs-label">: &nbsp</b>
									<select class="<?= form_error('nik') ? 'input-invalid' : 'input' ?>" name="nik" id="nik" required>
										<option value="" selected disabled hidden>Pilih Karyawan</option>
										<?php foreach ($karyawan as $kry) : ?>
										<option value="<?= $kry->nik ?>" <?= set_select('nik', $kry->nik) ?> <?= $kry->nik === $gaji->nik ? "selected" : '' ?>>
											<?= $kry->nik ." ==> ". $kry->nama ?>
										</option>
										<?php endforeach ?>
									<?= form_error('nik', '<div class="text-tomato font-weight-bold">', '</div>') ?>
								</td>
							</tr>

							<!-- kode jabatan -->
							<tr>
								<th scope="row" class="mhs-td-label"><li class="mhs-label">Kode Jabatan</li></td>
								<td>
									<b class="mhs-label">: &nbsp</b>
									<select class="<?= form_error('kode_jabatan') ? 'input-invalid' : 'input' ?>" name="kode_jabatan" id="kode_jabatan" onchange="changeValue(this.value)" required>
										<option value="" selected disabled hidden>Pilih Jabatan</option>

										<!-- Prepare a variable that contains a javascript array definition. -->
										<?php $jsArray = "var jsArray = new Array(); \n"; ?>

										<!-- Display all jabatan as <option>(s). -->
										<?php foreach ($jabatan as $jbt) : ?>

										<option value="<?= $jbt->kode_jabatan ?>" <?= set_select('kode_jabatan', $jbt->kode_jabatan) ?> <?= $gaji->kode_jabatan === $jbt->kode_jabatan ? "selected" : '' ?>>
											<?= $jbt->kode_jabatan ." ==> ". $jbt->nama_jabatan ?>
										</option>

										<?php
										$jsArray .= "jsArray['".$jbt->kode_jabatan."'] = 
										{
											gaji_pokok:'".addslashes($jbt->gaji_pokok)."',
											tunjangan_beras:'".addslashes($jbt->tunjangan_beras)."'
										}; \n"; 
										?>

										<?php endforeach ?>
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
							<th scope="row" class="mhs-td-label"><li class="mhs-label">Gaji Pokok</li></td>
							<td>
								<b class="mhs-label">: &nbsp</b>
								<input type="number" class="<?= form_error('gaji_pokok') ? 'input-invalid' : 'input' ?>" style="background: wheat" name="gaji_pokok" id="gaji_pokok" value="<?= set_value('gaji_pokok', $gaji->gaji_pokok) ?>" required readonly>
								<?= form_error('gaji_pokok', '<div class="text-tomato font-weight-bold">', '</div>') ?>
							</td>
						</tr>

						<!-- tunjangan_beras -->
						<tr>
							<th scope="row" class="mhs-td-label"><li class="mhs-label">Tunjangan Beras</li></td>
							<td>
								<b class="mhs-label">: &nbsp</b>
								<input type="number" class="<?= form_error('tunjangan_beras') ? 'input-invalid' : 'input' ?>" style="background: wheat" name="tunjangan_beras" id="tunjangan_beras" value="<?= set_value('tunjangan_beras', $gaji->tunjangan_beras) ?>" required readonly>
								<?= form_error('tunjangan_beras', '<div class="text-tomato font-weight-bolder">', '</div>') ?>
							</td>
						</tr>

						<!-- potongan_telat -->
						<tr>
							<th scope="row" class="mhs-td-label"><li class="mhs-label">Potongan Telat</li></td>
							<td>
								<b class="mhs-label">: &nbsp</b>
								<input type="number" class="<?= form_error('potongan_telat') ? 'input-invalid' : 'input' ?>" name="potongan_telat" id="potongan_telat" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="<?= set_value('potongan_telat', $gaji->potongan_telat) ?>" required>
								<?= form_error('potongan_telat', '<div class="text-tomato font-weight-bold">', '</div>') ?>
							</td>
						</tr>
						
						<!-- potongan_absen -->
						<tr>
							<th scope="row" class="mhs-td-label"><li class="mhs-label">Potongan Absen</li></td>
							<td>
								<b class="mhs-label">: &nbsp</b>
								<input type="number" class="<?= form_error('potongan_absen') ? 'input-invalid' : 'input' ?>" name="potongan_absen" id="potongan_absen" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="<?= set_value('potongan_absen', $gaji->potongan_absen) ?>" required>
								<?= form_error('potongan_absen', '<div class="text-tomato font-weight-bold">', '</div>') ?>
							</td>
						</tr>	
						
						<!-- bonus -->
						<tr>
							<th scope="row" class="mhs-td-label"><li class="mhs-label">Bonus</li></td>
							<td>
								<b class="mhs-label">: &nbsp</b>
								<input type="tel" class="<?= form_error('bonus') ? 'input-invalid' : 'input' ?>" name="bonus" id="bonus" placeholder="Maks. 10 digit" maxlength="15" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="<?= set_value('bonus', $gaji->bonus) ?>" required>
								<?= form_error('bonus', '<div class="text-tomato font-weight-bold">', '</div>') ?>
							</td>
						</tr>

						<tr>
							<td colspan="2">
								<button type="button" class="btn btn-block bg-lime" id="countButton">
									<h5>Hitung Gaji</h5>
								</button>
							</td>
						</tr>

						<!-- gaji_bersih -->
						<tr>
							<th scope="row" class="mhs-td-label"><li class="mhs-label">Gaji Bersih</li></td>
							<td>
								<b class="mhs-label">: &nbsp</b>
								<input type="tel" class="<?= form_error('gaji_bersih') ? 'input-invalid' : 'input' ?>" name="gaji_bersih" id="gaji_bersih" placeholder="Maks. 10 digit" maxlength="15" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="<?= set_value('gaji_bersih', $gaji->gaji_bersih) ?>" required readonly>
								<?= form_error('gaji_bersih', '<div class="text-tomato font-weight-bold">', '</div>') ?>
							</td>
						</tr>				

					<tr>
						<!-- buttons -->
						<td colspan="2" align="center">
							<br>

							<!-- submit -->
							<button type="submit" class="btn-submit">
								<b>Ubah <i class="fas fa-edit"></i></b>
							</button>&nbsp&nbsp

							<!-- empty the form fields value. -->
							<button type="button" class="btn-reset" id="resetButton"	>
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

	<script>
		$(document).ready(function() {
			// Get elements.
			const countButton = $("#countButton");
			const resetButton = $("#resetButton");

			// Count total salary.
			countButton.click(function() {
				let gaji_pokok = parseFloat($("#gaji_pokok").val()) || 0;
				let tunjangan_beras = parseFloat($("#tunjangan_beras").val()) || 0;
				let potongan_telat = parseFloat($("#potongan_telat").val()) || 0;
				let potongan_absen = parseFloat($("#potongan_absen").val()) || 0;
				let bonus = parseFloat($("#bonus").val()) || 0;

				let gaji_bersih = gaji_pokok + tunjangan_beras - potongan_telat - potongan_absen + bonus;
				
				$("#gaji_bersih").val(gaji_bersih);
			});

			// Reset all fields.
			resetButton.click(function() {
				$("#no_gaji").val('');
				$("#tgl_gaji").val('');
				$("#nik").val('');
				$("#kode_jabatan").val('');
				$("#gaji_pokok").val('0');
				$("#tunjangan_beras").val('0');
				$("#potongan_telat").val('0');
				$("#potongan_absen").val('0');
				$("#bonus").val('0');
				$("#gaji_bersih").val('0');
			});
		});
	</script>
</body>
</html>