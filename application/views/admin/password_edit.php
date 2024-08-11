<!DOCTYPE html>
<html lang="en">

<?php 
$this->load->view('templates/head');
$this->load->view('templates/background_video');
?>


<body class="hold-transition sidebar-mini layout-fixed">

	<!-- wrapper -->
	<div class="wrapper">

		<?php 
		$this->load->view('templates/sidebar');
		$this->load->view('templates/navbar');
		?>

		<div class="bg-transparent content-wrapper p-3">
			<div class="container-fluid" style="max-width: 500px">
				<div class="card card-outline card-primary p-1"style="background-color: oldlace">

					<div class="card-header">
						<h2><i class="fas fa-cog text-secondary"></i> Password Change</h2>
					</div>

					<div class="card-body">
						<form method="POST">
							<div>
								<label for="password">Password</label><br>
								<input type="password" name="password" class="<?= form_error('password') ? 'input-invalid' : 'input' ?>" placeholder="Enter your new password" value="<?= set_value('password') ?>" required>
								<i class="fas fa-lock"></i>
								<?= form_error('password', '<div class="text-danger font-weight-bold">', '</div>') ?>
							</div><br>

							<div>
								<label for="password_confirm">Konfirmasi Password</label><br>
								<input type="password" name="password_confirm" class="<?= form_error('password_confirm') ? 'input-invalid' : 'input' ?>" placeholder="Password harus cocok" value="<?= set_value('password_confirm') ?>" required>
								<i class="fas fa-screwdriver"></i>
								<?= form_error('password_confirm', '<div class="text-danger font-weight-bold">', '</div>') ?>
							</div><br>

							<div>
								<button type="submit" class="btn btn-primary btn-block">
									Save changes <i class="fas fa-save"></i>
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
		<!-- /.content-wrapper -->
		
		<?php $this->load->view('templates/footer') ?>

	</div>
	<!-- wrapper -->
</body>
</html>