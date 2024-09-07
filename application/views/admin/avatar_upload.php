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
			<div class="container-fluid" style="max-width: 700px">
				<div class="card card-outline card-primary p-1" style="background-color: oldlace">

					<!-- header -->
					<div class="card-header">
						<h1><i class="fas fa-image"></i> Change Avatar</h1>
					</div>

					<div class="card-body">
						<form method="POST" enctype="multipart/form-data" runat="server">
							<div>
								<label class="login-msg">
									Upload file dengan format <span class="text-info">.gif</span>, <span class="text-info">.jpeg</span>, <span class="text-info">.jpg</span>, atau <span class="text-info">.png</span> sebagai avatar <b>(max size: 1MB, width: 1000px, height: 1000px)</b>.
								</label>

								<!-- upload file -->
								<center>
									<label class="label-upload">
										<input type="file" name="avatar" id="avatar" accept="image/gif, image/jpeg, image/jpg, image/png" onchange="read_url();" required>
										<span>Pilih file</span>
									</label>
								</center>
							</div>

							<!-- dispay messages -->
							<!-- upload error -->
							<?php if (isset($upload_error)) : echo $upload_error; ?>

							<!-- upload success -->
							<?php elseif ($this->session->flashdata('message')) : ?>
							<p class="text-success font-weight-bold"><?= $this->session->flashdata('message') ?> 👍</p>
							<?php $this->session->unset_userdata('message') ?>
							
							<?php endif ?>

							<!-- action error -->
							<?php if (isset($action_error)) : ?> 
							<b class="text-danger">Action Error: </b><?= $action_error ?>
							<?php endif ?>

							<!-- show the uploaded image -->
							<div class="pt-2" id="image_field" align="center">
								<img class="elevation-2 <?= isset($error) ? 'avatar-preview-invalid' : 'avatar-preview' ?>" id="selected_file" src="<?= $current_user->avatar ? 
								base_url('uploads/user-avatar/'.$current_user->avatar) : 
								base_url('assets/images/user.png') ?>" alt="<? htmlentities($current_user->name, TRUE) ?>">
							</div>

							<!-- submit button -->
							<div class="pt-3" id="submit_field" align="center">
								<button type="submit" class="btn btn-primary btn-block" value="upload">
									Upload <i class="fas fa-upload"></i>
								</button>
							</div>
						</form>

						<!-- JS to show and hide elements -->
						<script type="text/javascript">

							// show selected file
							function read_url() {

								// get the elements
								const [file] = document.getElementById('avatar').files;
								// if the image file selected
								if (file) {
									selected_file.src = URL.createObjectURL(file);
								}
							}
						</script>

					</div>
					<!-- /.card-body -->
				</div>
				<!-- /. card -->
			</div>
			<!-- /.container-fluid -->
		</div>
		<!-- /.content-wrapper -->
		
		<?php $this->load->view('templates/footer') ?>

	</div>
	<!-- wrapper -->
</body>
</html>