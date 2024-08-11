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
							<h2 class="mhs-input-header"><i class="far fa-circle fas fa-download"></i> Input Data Karyawan</h2>
							<!-- flashdata -->
							<?php if ($this->session->flashdata('karyawan_saved')) : ?>
							<div class="alert alert-dismissible fade show bg-lime" role="alert" style="width: 380px">
								<h4 align="center"><?= $this->session->flashdata('karyawan_saved') ?> 👍</h4>
								<?php $this->session->unset_userdata('karyawan_saved') ?>
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
						<!-- nik -->
						<tr>
							<td class="mhs-td-label"><li class="mhs-label">NIK</li></td>
							<td>
								<b class="mhs-label">: &nbsp</b>
								<input type="text" class="<?= form_error('nik') ? 'input-invalid' : 'input' ?>" name="nik" id="nik" placeholder="Maks. 10 digit (tidak kurang dari '0')" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '');" value="<?= set_value('nik') ?>" required>
								<?= form_error('nik', '<div class="text-tomato font-weight-bold">', '</div>') ?>
							</td>
						</tr>

						<!-- nama -->
						<tr>
							<td class="mhs-td-label"><li class="mhs-label">Nama</li></td>
							<td>
								<b class="mhs-label">: &nbsp</b>
								<input type="text" class="<?= form_error('nama') ? 'input-invalid' : 'input' ?>" name="nama" id="nama" placeholder="Maks. 30 karakter" maxlength="30" value="<?= set_value('nama') ?>" required>
								<?= form_error('nama', '<div class="text-tomato font-weight-bold">', '</div>') ?>
							</td>
						</tr>

						<!-- input tempat lahir -->
						<tr>
							<td class="mhs-td-label"><li class="mhs-label">Tempat Lahir</li></td>
							<td>
								<b class="mhs-label">: &nbsp</b>
								<input type="text" class="<?= form_error('tpt_lahir') ? 'input-invalid' : 'input' ?>" name="tpt_lahir" id="tpt_lahir" placeholder="Maks. 30 karakter" maxlength="30" value="<?= set_value('tpt_lahir') ?>" required>
								<?= form_error('tpt_lahir', '<div class="text-tomato font-weight-bold">', '</div>') ?>
							</td>
						</tr>

						<!-- tanggal lahir -->
						<tr>
							<td class="mhs-td-label"><li class="mhs-label">Tanggal Lahir</li></td>
							<td>
								<b class="mhs-label">: &nbsp</b>
								<input type="date" class="<?= form_error('tgl_lahir') ? 'input-invalid' : 'input' ?>" name="tgl_lahir" id="tgl_lahir" value="<?= set_value('tgl_lahir') ?>" required>
								<?= form_error('tgl_lahir', '<div class="text-tomato font-weight-bold">', '</div>') ?>
							</td>
						</tr>

						<!-- kelamin -->
						<tr>
							<td class="mhs-td-label"><li class="mhs-label">Jenis Kelamin</li></td>
							<td>
								<b class="mhs-label">: &nbsp</b>
								<label class="text-white">
									<input type="radio" class="text-white" name="kelamin" id="laki-laki" value="Laki-laki" <?= set_radio('kelamin', 'Laki-laki') ?>> Laki-laki
								</label>&nbsp &nbsp
								<label class="text-white">
									<input type="radio" class="text-white" name="kelamin" id="perempuan" value="Perempuan" <?= set_radio('kelamin', 'Perempuan') ?>> Perempuan
								</label>
								<?= form_error('kelamin', '<div class="text-tomato font-weight-bold">', '</div>') ?>
							</td>
						</tr>

						<!-- alamat -->
						<tr>
							<td  class="mhs-td-label"><li class="mhs-label">Alamat</li></td>
							<td>
								<div class="d-flex" style="align-items: flex-start">
									<b class="mhs-label m-0 mr-10">: &nbsp&nbsp</b>
									<textarea class="<?= form_error('alamat') ? 'input-invalid' : 'input' ?>" name="alamat" id="alamat" cols="25" rows="4" placeholder="Maks. 100 karakter" maxlength="100" 
									style="resize: none" required><?= set_value('alamat') ?></textarea>
								</div>
								<?= form_error('alamat', '<div class="text-tomato font-weight-bolder">', '</div>') ?>
							</td>
						</tr>

						<!-- no. telepon -->
						<tr>
							<td class="mhs-td-label"><li class="mhs-label">No. Telepon</li></td>
							<td>
								<b class="mhs-label">: &nbsp</b>
								<input type="tel" class="<?= form_error('no_telepon') ? 'input-invalid' : 'input' ?>" name="no_telepon" id="no_telepon" placeholder="Maks. 15 digit" maxlength="15" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="<?= set_value('no_telepon') ?>" required>
								<?= form_error('no_telepon', '<div class="text-tomato font-weight-bold">', '</div>') ?>
							</td>
						</tr>					

					<!-- buttons -->
					<td colspan="2" align="center">
						<br>

						<!-- submit -->
						<button type="submit" class="btn-submit">
							<b>Simpan <i class="fas fa-save"></i></b>
						</button>&nbsp&nbsp

						<script type="text/javascript">
							// empty the form fields value.
							function bersih() {
								document.getElementById('nik').value = ''; 
								document.getElementById('nama').value = '';
								document.getElementById('tpt_lahir').value = '';
								document.getElementById('tgl_lahir').value = '';
								document.getElementById('alamat').value = '';
								document.getElementById('no_telepon').value = '';

								
								document.getElementById('laki-laki').checked = false;
								document.getElementById('perempuan').checked = false;
							}
						</script>

						<!-- empty the form fields value. -->
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