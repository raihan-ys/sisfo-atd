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
			<div class="container-fluid" style="max-width: 1500px">

				<!-- header -->
				<h2 class="text-white text-center">
					<i class="fas fa-cog text-secondary"></i> Admin's Settings
				</h2>

				<!-- flashdata -->
				<?php if ($this->session->flashdata('message')) : ?>
				<div class="alert alert-dismissable fade show bg-lime h4 text-center mx-auto" id="alertDiv" style="width: 400px">
					<?= $this->session->flashdata('message') ?> 👍
					<?php $this->session->unset_userdata('message') ?>
					<button class="close" id="closeAlert" title="Close this notification" type="button" aria-label="close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php elseif ($this->session->flashdata('avatar_deleted')) : ?>
				<div class="alert alert-dismissable fade show bg-lime h4 text-center mx-auto" id="alertDiv" style="width: 400px">
					<?= $this->session->flashdata('avatar_deleted') ?> <i class="fas fa-trash"></i>
					<?php $this->session->unset_userdata('avatar_deleted') ?>
					<button class="close" id="closeAlert" title="Close this notification" type="button" aria-label="close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php endif ?>

				<div class="row">

					<!-- avatar -->
					<div class="small-box col m-3 p-3" style="background-color: whitesmoke">
						<div class="icon"><i class="fas fa-camera"></i></div>
						<div class="card-header"><h4>Picture</h4></div>
						<div class="card-body">
							<div class="text-center mb-2">
								<a class="btn btn-info btn-block" role="button" href="<?= site_url('admin/setting/avatar_upload') ?>">
									Change Avatar
								</a>
								<?php if ($current_user->avatar) : ?>
								<a class="btn btn-danger btn-block" role="button" href="<?= site_url('admin/setting/avatar_remove') ?>" onclick="return confirm('Are you sure to remove avatar?')">
									Remove Avatar
								</a>
								<?php endif ?>
							</div>
							<img class="img elevation-2 avatar-preview mx-auto d-block" style="width: 200px; height: 200px;" src="<?= $current_user->avatar ? base_url('uploads/user-avatar/'.$current_user->avatar) :	base_url('assets/images/user.png') ?>" alt="<?= htmlentities($current_user->name, true) ?>">
						</div>
					</div>

					<!-- profile -->
					<div class="small-box col m-3 p-3" style="background-color: whitesmoke">
						<div class="icon"><i class="fas fa-user"></i></div>
						<div class="card-header"><h4>Profile</h4></div>
						<div class="card-body">
							<a class="btn btn-info btn-block mb-2" role="button" href="<?= site_url('admin/setting/profile_edit') ?>">
								Edit Profile
							</a>
							<p class="text-center">
								<i class="fas fa-user"></i> Name:<br>
								<span class="font-weight-bold"><?= html_escape($current_user->name) ?></span>
							</p>
							<p class="text-center">
								<i class="fas fa-envelope"></i> E-mail:<br>
								<span class="font-weight-bold"><?= html_escape($current_user->email) ?></span>
							</p>
						</div>
					</div>

					<!-- security -->
					<div class="small-box col m-3 p-3" style="background-color: whitesmoke">
						<div class="icon"><i class="fas fa-lock"></i></div>
						<div class="card-header"><h4>Security</h4></div>
						<div class="card-body">
							<a class="btn btn-info btn-block mb-2" role="button" href="<?= site_url('admin/setting/password_verify') ?>">
								Change Password
							</a>
							<p class="text-center">
								<i class="fas fa-key"></i> Password:<br>
								<span class="font-weight-bold">**** (dummy)</span>
							</p>
							<p class="text-center">
								<i class="fas fa-tachometer-alt"></i> Terakhir diubah:<br>
								<span class="font-weight-bold"><?= $current_user->password_updated_at ?></span>
							</p>
						</div>
					</div>

				</div>
				<!-- /.row -->

				<hr class="bg-white">
				
			</div>
			<!-- /.container-fluid -->
		</div>
		<!-- /.content-wrapper -->
		
		<?php $this->load->view('templates/footer') ?>

	</div>
	<!-- wrapper -->
</body>
</html>