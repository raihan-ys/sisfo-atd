<!DOCTYPE html>
<html>

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
							<img class="mhs-input-img mx-auto mb-2 d-block" src="<?= base_url('assets/images/laptop-input.png') ?>">
							<h2 class="mhs-input-header mx-auto p-1 text-center d-block"><i class="fas fa-pen"></i> Ubah Data Karyawan</h2>
							
							<!-- flashdata -->
							<?php if ($this->session->flashdata('karyawan_updated')) : ?>
							<div align="center" class="mx-auto alert alert-dismissible fade show bg-lime" id="alertDiv" style="width: 380px">
								<h4><?= $this->session->flashdata('karyawan_updated') ?> 👍</h4>
								<?php $this->session->unset_userdata('karyawan_updated') ?>
								<button title="close this notification" type="button" class="close" id="closeAlert" aria-label="close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<?php endif ?>
						</th>
					</tr>
					<!-- /.form header -->

					<form method="POST">
						<ul>

						<!-- nik -->
						<tr>
							<td class="mhs-td-label"><li class="mhs-label">NIK</li></td>
							<td>
								<b class="mhs-label">: &nbsp</b>
								<input class="<?= form_error('nik') || $this->session->flashdata('nik_duplicated') ? 'input-invalid' : 'input' ?>" type="text" name="nik" id="nik" placeholder="Maks. 10 digit (tidak kurang dari '0')" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="<?= set_value('nik', $karyawan->nik) ?>" required>
								<?= form_error('nik', '<div class="text-tomato font-weight-bold">', '</div>') ?>

								<!-- if the submitted NIK is alredy taken -->
								<?php if ($this->session->flashdata('nik_duplicated')) : ?>
								<br>
								<div class="text-tomato font-weight-bold">
									<?= $this->session->flashdata('nik_duplicated') ?>
									<!-- <?php $this->session->unset_userdata('nik_duplicated') ?> -->
								</div>
								<?php endif ?>
							</td>
						</tr>

						<!-- nama -->
						<tr>
							<td class="mhs-td-label"><li class="mhs-label">Nama</li></td>
							<td>
								<b class="mhs-label">: &nbsp</b>
								<input class="<?= form_error('nama') ? 'input-invalid' : 'input' ?>" type="text" name="nama" id="nama" maxlength="30" placeholder="Maks. 30 karakter" value="<?= set_value('nama', $karyawan->nama) ?>" required>
								<?= form_error('nama', '<div class="text-tomato font-weight-bold">', '</div>') ?>
							</td>
						</tr>

						<!-- tempat lahir -->
						<tr>
							<td class="mhs-td-label"><li class="mhs-label">Tempat Lahir</li></td>
							<td>
								<b class="mhs-label">: &nbsp</b>
								<input type="text" class="<?= form_error('tpt_lahir') ? 'input-invalid' : 'input' ?>" name="tpt_lahir" id="tpt_lahir" maxlength="30" placeholder="Maks. 30 karakter" value="<?= set_value('tpt_lahir', $karyawan->tpt_lahir) ?>" required>
								<?= form_error('tpt_lahir', '<div class="text-tomato font-weight-bold">', '</div>') ?>
							</td>
						</tr>

						<!-- tanggal lahir -->
						<tr>
							<td class="mhs-td-label"><li class="mhs-label">Tanggal Lahir</li></td>
							<td>
								<b class="mhs-label">: &nbsp</b>
								<input type="date" class="<?= form_error('tgl_lahir') ? 'input-invalid' : 'input' ?>" name="tgl_lahir" id="tgl_lahir" value="<?= set_value('tgl_lahir', $karyawan->tgl_lahir) ?>" required>
								<?= form_error('tgl_lahir', '<div class="text-tomato font-weight-bold">', '</div>') ?>
							</td>
						</tr>

						<!-- jenis kelamin -->
						<tr>
							<td class="mhs-td-label"><li class="mhs-label">Jenis Kelamin</li></td>
							<td>
								<b class="mhs-label">: &nbsp</b>
								<label class="text-white">
									<input type="radio" class="text-white" name="kelamin" id="laki-laki" value="Laki-laki" <?= set_radio('kelamin', 'Laki-laki', $karyawan->kelamin == 'Laki-laki' ? TRUE : FALSE) ?>> Laki-laki
								</label>&nbsp &nbsp
								<label class="text-white">
									<input type="radio" class="text-white" name="kelamin" id="perempuan" value="Perempuan" <?= set_radio('kelamin', 'Perempuan', $karyawan->kelamin == 'Perempuan' ? TRUE : FALSE) ?>> Perempuan
								</label>
								<?= form_error('kelamin', '<div class="text-tomato font-weight-bold">', '</div>') ?>
							</td>
						</tr>

						<!-- input alamat -->
						<tr>
							<td  class="mhs-td-label"><li class="mhs-label">Alamat</li></td>
							<td>
								<div class="d-flex" style="align-items: flex-start">
									<b class="mhs-label m-0 mr-10">: &nbsp&nbsp</b>
									<textarea class="<?= form_error('alamat') ? 'input-invalid' : 'input' ?>" name="alamat" id="alamat" maxlength="100" cols="25" rows="4" placeholder="Maks. 100 karakter" 
									style="resize: none" required><?= set_value('alamat', $karyawan->alamat) ?></textarea>
								</div>
								<?= form_error('alamat', '<div class="text-tomato font-weight-bold">', '</div>') ?>
							</td>
						</tr>

						<!-- no. telepon -->
						<tr>
							<td class="mhs-td-label"><li class="mhs-label">No. Telepon</li></td>
							<td>
								<b class="mhs-label">: &nbsp</b>
								<input type="tel" class="<?= form_error('no_telepon') ? 'input-invalid' : 'input' ?>" name="no_telepon" id="no_telepon" maxlength="15" placeholder="Maks. 15 digit" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="<?= set_value('no_telepon', $karyawan->no_telepon) ?>" required>
								<?= form_error('no_telepon', '<div class="text-tomato font-weight-bold">', '</div>') ?>
							</td>
						</tr>
					</ul>
					<!-- /.ul input -->

					<!-- buttons -->
					<td colspan="2" align="center">

						<br>

						<!-- submit -->
						<button title="Submit data" type="submit" class="btn-submit">
							<b>Ubah <i class="fas fa-save"></i></b>
						</button>&nbsp &nbsp

						<script type="text/javascript">
							// reset the form fields value to it's original value.
							function resetValue() {

								// reset inputs.
								document.getElementById('nik').value = '<?= $karyawan->nik ?>'; 
								document.getElementById('nama').value = '<?= $karyawan->nama ?>';
								document.getElementById('tpt_lahir').value = '<?= $karyawan->tpt_lahir ?>';
								document.getElementById('tgl_lahir').value = '<?= $karyawan->tgl_lahir ?>';
								document.getElementById('alamat').value = '<?= $karyawan->alamat ?>';
								document.getElementById('no_telepon').value = '<?= $karyawan->no_telepon ?>';

								// empty <input type="radio"> fields.
								<?php if ($karyawan->kelamin == 'Laki-laki') : ?> 
								document.getElementById('laki-laki').checked = true;
								<?php elseif ($karyawan->kelamin != 'Laki-laki') : ?>
								document.getElementById('laki-laki').checked = false;
								<?php endif ?>

								<?php if ($karyawan->kelamin == 'Perempuan') : ?>
								document.getElementById('perempuan').checked = true;
								<?php elseif ($karyawan->kelamin != 'Perempuan') : ?>
								document.getElementById('perempuan').checked = false;
								<?php endif ?>
							};

							// empty the form fields.
							function bersih() {
								document.getElementById('nik').value = ''; 
								document.getElementById('nama').value = '';
								document.getElementById('tpt_lahir').value = '';
								document.getElementById('tgl_lahir').value = '';
								document.getElementById('alamat').value = '';
								document.getElementById('no_telepon').value = '';

								document.getElementById('laki-laki').checked = false;
								document.getElementById('perempuan').checked = false;
							};
						</script>

						<!-- reset -->
						<button title="Set the form fields to its original value." type="button" class="btn-reset" onclick="resetValue()">
							<b>Reset <i class="fas fa-eraser"></i></b>
						</button>&nbsp&nbsp

						<!-- empty -->
						<button title="Emtpy the form fields." type="button" class="btn-reset" onclick="bersih()">
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
	<!-- wrapper -->
</body>
</html>