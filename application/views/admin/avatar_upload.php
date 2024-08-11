<!DOCTYPE html>
<html lang="en">

<?php 
$this->load->view('templates/head');
$this->load->view('templates/background_video');
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
							<div class="avatar-upload-field pt-2" id="image_field" align="center">
								<img class="elevation-2 <?= isset($error) ? 'avatar-preview-invalid' : 'avatar-preview' ?>" id="selected_file" src="<?= $current_user->avatar ? 
								base_url('uploads/avatar/'.$current_user->avatar) : 
								base_url('assets/images/user.png') ?>" alt="<? htmlentities($current_user->name, TRUE) ?>">
							</div>

							<!-- actions to perform -->
							<div class="avatar-upload-field pt-3" id="action_field">
								<label><i class="fas fa-brush text-teal"></i> Select one of this actions (optional)</label>
								<ul>
									<!-- crop option -->
									<label>
										<i class="fas fa-crop"></i> Crop 	<input type="radio" name="action" id="crop_radio" value="crop">
									</label><br>

									<!-- resize option -->
									<label>
										<i class="fas fa-expand-arrows-alt"></i> Resize 	<input type="radio" name="action" id="resize_radio" value="resize">
									</label><br>

									<!-- rotate option -->
									<label>
										<i class="fas fa-arrow-up"></i> Rotate 	<input type="radio" name="action" id="rotate_radio" value="rotate">
									</label><br>

									<!-- watermark option -->
									<label>
										<i class="fas fa-water"></i> Watermark 	<input type="radio" name="action" id="watermark_radio" value="watermark">
									</label><br>

									<!-- no action -->
									<label>
										(X) None <input type="radio" name="action" id="none_radio" value="">
									</label>
								</ul>
							</div>

							<!-- crop input field -->
							<div class="avatar-upload-field" id="crop_field">
								<hr class="bg-teal">
								<label>Enter coordinates for image cropping</label>
								<ul type="square">
									<li>
										<label style="width: 25%" for="x_axis">X-axis (left)</label>
										<input style="border-radius: 5px" type="number" name="x_axis" placeholder="maks. 5 digit" maxlength="5" oninput="this.value = this.value.replace(/[^0-9]/g, '');" value="<?= set_value('x_axis') ?>">
									</li>
									<li class="pt-1">
										<label style="width: 25%" for="y_axis">Y-axis (top) </label>
										<input style="border-radius: 5px" type="number" name="y_axis" placeholder="maks. 5 digit" maxlength="5" oninput="this.value = this.value.replace(/[^0-9]/g, '');" value="<?= set_value('y_axis') ?>">
									</li>
								</ul>
							</div>
							
							<!-- resize input field -->
							<div class="avatar-upload-field" id="resize_field">
								<hr class="bg-teal">
								<label>Enter height & width for image resizing</label>
								<ul type="square">
									<li>
										<label style="width: 25%" for="height">Height</label>
										<input style="border-radius: 5px" type="number" name="height" placeholder="maks. 5 digit" maxlength="5" oninput="this.value = this.value.replace(/[^0-9]/g, '');" value="<?= set_value('height') ?>">
									</li>
									<li>
										<label style="width: 25%" for="width">Width</label>
										<input style="border-radius: 5px" type="number" name="width" placeholder="maks. 5 digit" maxlength="5" oninput="this.value = this.value.replace(/[^0-9]/g, '');" value="<?= set_value('width') ?>">
									</li> 	
								</ul>
							</div>

							<!-- rotate input field -->
							<div class="avatar-upload-field" id="rotate_field">
								<hr class="bg-teal">
								<label>Choose angle for image rotating</label>
								<ul>
									<label><input type="radio" name="rotation_angle" value="90"> 90 degree</label>
									<br>
									<label><input type="radio" name="rotation_angle" value="180"> 180 degree</label>
									<br>
									<label><input type="radio" name="rotation_angle" value="270"> 270 degree</label>
									<br>
									<label><input type="radio" name="rotation_angle" value="360"> 360 degree</label>
								</ul>
							</div>

							<!-- watermark input field -->
							<div class="avatar-upload-field" id="watermark_field">
								<hr class="bg-teal">
								<label>Enter text for watermark the image</label>
								<ul type="square">
									<li>
										<label style="width: 29%" for="wm_text">Text</label>
										<input style="border-radius: 5px" type="text" name="wm_text" placeholder="maks. 20 karakter" maxlength="20" value="<?= set_value('wm_text') ?>">
									</li>
									<li>
										<label style="width: 29%" for="wm_font_size">Font Size (in PX)</label>
										<input style="border-radius: 5px" type="number" name="wm_font_size" placeholder="max. value 30px" maxlength="2" value="<?= set_value('wm_font_size') ?>">
									</li>
								</ul>
							</div>

							<!-- submit button -->
							<div class="avatar-upload-field pt-3" id="submit_field" align="center">
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
								const image_field =  document.getElementById('image_field');
								const action_field = document.getElementById('action_field');
								const submit_field = document.getElementById('submit_field');

								// if the image file selected
								if (file) {
									// show the image field
									image_field.style.display = 'block';
									selected_file.src = URL.createObjectURL(file);

									// show actions and submit field
									action_field.style.display = 'block';
									submit_field.style.display = 'block';
								}
							}

							// handle the action radios onclick event
							function display_field() {

								// get the field elements by their id
								const crop_field = document.getElementById('crop_field');
								const resize_field = document.getElementById('resize_field');
								const rotate_field = document.getElementById('rotate_field');
								const watermark_field = document.getElementById('watermark_field');

								// if the crop radio is checked
								if (document.getElementById('crop_radio').checked) {
									resize_field.style.display = 'none';
									rotate_field.style.display = 'none';
									watermark_field.style.display = 'none';
									crop_field.style.display = 'block';
								}
								// if the resize radio is clicked
								else if (document.getElementById('resize_radio').checked) {
									crop_field.style.display = 'none';
									rotate_field.style.display = 'none';
									watermark_field.style.display = 'none';
									resize_field.style.display = 'block';
								}
								// if the rotate radio is clicked
								else if (document.getElementById('rotate_radio').checked) {
									crop_field.style.display = 'none';
									resize_field.style.display = 'none';
									watermark_field.style.display = 'none';
									rotate_field.style.display = 'block';
								}
								// if the resize radio is clicked
								else if (document.getElementById('watermark_radio').checked) {
									crop_field.style.display = 'none';
									resize_field.style.display = 'none';
									rotate_field.style.display = 'none';
									watermark_field.style.display = 'block';
								}
								// if the none radio is clicked
								else if (document.getElementById('none_radio').checked) {
									crop_field.style.display = 'none';
									resize_field.style.display = 'none';
									rotate_field.style.display = 'none';
									watermark_field.style.display = 'none';
								}
							}

							const action_radios = document.querySelectorAll('input[name="action"]');
							action_radios.forEach(action => {
								action.addEventListener('click', display_field);
							});
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