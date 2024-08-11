<!DOCTYPE html>
<html lang="en">

<?php
$this->load->view('templates/head');
$this->load->view('templates/background');
?>

<body class="hold-transition sidebar-mini layout-fixed">

  <!-- wrapper -->
  <div class="wrapper">

		<?php 
		$this->load->view('templates/sidebar');
		$this->load->view('templates/navbar'); 
		?>

		<!-- content wrapper -->
    <div class="bg-transparent content-wrapper p-3">

			<!-- container form -->
			<div class="container-fluid" align="left" style="max-width: 550px">
				<!-- card -->
				<div class="card card-outline card-success" style="background-color: oldlace">

					<!-- header -->
					<div class="card-header text-center">
						<a target="_blank" title="Go ATD'S official website" href="https://www.amiktridharmapku.ac.id">
							<img src="<?= base_url('assets/images/atd-logo.png') ?>" width="150">
							<br><br>
							<b style="line-height: 0px; break-after: 0px">
								<strong class="h2 text-danger font-weight-bolder">AMIK </strong>
								<strong class="h2 text-primary font-weight-bolder">"TRI DHARMA"</strong>
							</b><br>
							<strong class="text-dark" style="font-size: 15px">
								AKADEMI MANAJEMEN INFORMATIKA DAN KOMPUTER
							</strong>
						</a>
					</div>

					<!-- subheader -->
					<div class="card-body">
						<p class="login-box-msg">
							<h5>Selamat Datang!</h5>
							<h6>Login sebagai Administrator</h6>
						</p>

						<!-- flashdata -->
						<?php if($this->session->flashdata('login_failed')) : ?>
							<b class="text-tomato">
								<?= $this->session->flashdata('login_failed') ?>
								<?php $this->session->unset_userdata('login_failed') ?>
							</b>
						<?php endif ?>

						<!-- form -->
						<form method="POST">
							<!-- username/email -->
							<input class="<?= form_error('username') ? 'input-invalid' : 'input' ?>" type="text" name="username" title="Enter your e-mail or username" placeholder="E-mail atau Username* (Maks. 64 karakter)" value="<?= set_value('username') ?>" required>
							<span class="fas fa-user"></span>
							<?= form_error('username', '<div class="text-tomato font-weight-bold">', '</div>') ?>
							<br><br>

							<!-- password -->
							<input class="<?= form_error('password') ? 'input-invalid' : 'input' ?>" type="password" name="password" id="password" title="Enter your password" placeholder="Password*" value="<?= set_value('password') ?>" required>
							<span class="fas fa-lock"></span>
							<?= form_error('password', '<div class="text-tomato font-weight-bold">', '</div>') ?>
							<br>

							<!-- JavaScript show password -->
							<script type="text/javascript">
								function show_password() {
									var pw = document.getElementById("password");
									if (pw.type === "password") {
										pw.type = "text";
									} else {
										pw.type = "password";
									}
								}
							</script>

							<!-- show password -->
							<label>
								<input type="checkbox" title="Make the password readable" onclick="show_password()"> Tampilkan Password
							</label>
							<br><br>

							<!-- submit -->
							<div>
								<input class="btn btn-primary btn-block font-weight-bold" type="submit" title="Make sure the username and password are correct!" value="Login">
							</div>
						</form>
						<!-- /.form -->
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
			<!-- /.container-fluid -->
		</div>
		<!-- /.content wrapper -->

  	<?php $this->load->view('templates/footer'); ?>
    
  </div>
  <!-- /.wrapper -->
</body>
</html>