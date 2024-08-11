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
			  <table align="center" border="0" cellspacing="10" cellpadding="15">

			  <!-- header -->
				<tr>
					<td colspan="2" align="center">
					  <img class="mhs-input-img" src="<?= base_url('assets/images/laptop-input.png') ?>"><br><br>

						<!-- title -->	
						<h2 class="mhs-input-header"><i class="fas fa-pen"></i> Ubah Data Jabatan</h2>
							
						<!-- flashdata -->
						<?php if ($this->session->flashdata('jabatan_updated')) : ?>
						<div align="center" class="alert alert-dismissible fade show bg-lime" role="alert" style="width: 380px">
						<h4><?= $this->session->flashdata('jabatan_updated') ?> 👍</h4>
						<?php $this->session->unset_userdata('jabatan_updated') ?>
						<button title="close this notification" type="button" class="close" data-dismiss="alert" aria-label="close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>
						<?php endif ?>
					</td>
				</tr>
				<!-- /.header -->

				<form method="POST">
					<ul>
					  <!-- kode -->
					  <tr>
						  <td class="mhs-td-label"><li class="mhs-label">Kode Jabatan</li></td>
						  <td>
                <b class="mhs-label">: &nbsp</b>
                <input class="<?= form_error('kode_jabatan') || $this->session->flashdata('kode_duplicated') ? 'input-invalid' : 'input' ?>" type="text" name="kode_jabatan" id="kode_jabatan" placeholder="Maks. 10 karakter"  value="<?= set_value('kode_jabatan', $jabatan->kode_jabatan) ?>" maxlength="10" required>
                <?= form_error('kode_jabatan', '<div class="text-tomato font-weight-bold">', '</div>') ?>

                <!-- if the submitted kode jabatan is alredy taken... -->
                <?php if ($this->session->flashdata('kode_duplicated')) : ?>
                <br>
                <div class="text-tomato font-weight-bold">
                  <?= $this->session->flashdata('kode_duplicated') ?>
                  <?php $this->session->unset_userdata('kode_duplicated') ?>
                </div>
                <?php endif ?>
							</td>
						</tr>

						<!-- nama -->
						<tr>
							<td class="mhs-td-label"><li class="mhs-label">Nama Jabatan</li></td>
							<td>
								<b class="mhs-label">: &nbsp</b>
								<input class="<?= form_error('nama_jabatan') ? 'input-invalid' : 'input' ?>" type="text" name="nama_jabatan" id="nama_jabatan" maxlength="30" placeholder="Maks. 30 karakter" value="<?= set_value('nama_jabatan', $jabatan->nama_jabatan) ?>" required>
								<?= form_error('nama_jabatan', '<div class="text-tomato font-weight-bold">', '</div>') ?>
							</td>
						</tr>

						<!-- gaji pokok -->
						<tr>
							<td class="mhs-td-label"><li class="mhs-label">Gaji Pokok</li></td>
							<td>
								<b class="mhs-label">: &nbsp</b>
								<input type="number" class="<?= form_error('gaji_pokok') ? 'input-invalid' : 'input' ?>" name="gaji_pokok" id="gaji_pokok" maxlength="10" placeholder="Maks. 10 digit" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="<?= set_value('gaji_pokok', $jabatan->gaji_pokok) ?>" required>
								<?= form_error('gaji_pokok', '<div class="text-tomato font-weight-bold">', '</div>') ?>
							</td>
						</tr>

						<!-- tunjangan beras -->
						<tr>
							<td class="mhs-td-label"><li class="mhs-label">Tunjangan beras</li></td>
							<td>
								<b class="mhs-label">: &nbsp</b>
								<input type="text" class="<?= form_error('tunjangan_beras') ? 'input-invalid' : 'input' ?>" name="tunjangan_beras" id="tunjangan_beras" maxlength="10" placeholder="Mkas. 10 digit" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="<?= set_value('tunjangan_beras', $jabatan->tunjangan_beras) ?>">
								<?= form_error('tunjangan_beras', '<div class="text-tomato font-weight-bold">', '</div>') ?>
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
							// set all form fields value to original value.
							function resetValue() {
								document.getElementById('kode_jabatan').value = '<?= $jabatan->kode_jabatan ?>'
								document.getElementById('nama_jabatan').value = '<?= $jabatan->nama_jabatan ?>'
								document.getElementById('gaji_pokok').value = '<?= $jabatan->gaji_pokok ?>'
								document.getElementById('tunjangan_beras').value = '<?= $jabatan->tunjangan_beras ?>'
							}

							// empty form fields value.
							function bersih() {
								document.getElementById('kode_jabatan').value = ''
								document.getElementById('nama_jabatan').value = ''
								document.getElementById('gaji_pokok').value = ''
								document.getElementById('tunjangan_beras').value = ''
							}
						</script>

						<!-- reset -->
						<button title="Set the form fields to it's original value (the fields value before the form submitted)" type="button" class="btn-reset" onclick="resetValue()">
							<b>Reset <i class="fas fa-eraser"></i></b>
						</button>&nbsp&nbsp

						<!-- clean -->
						<button title="Emtpy the form fields" type="button" class="btn-reset" onclick="bersih()">
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