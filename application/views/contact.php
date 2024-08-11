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
		
		<!-- content-wrapper -->
		<div class="bg-transparent content-wrapper p-3">

     	<?php $this->load->view('templates/content-header') ?>
     		
      <!-- form container -->
			<div class="container-fluid" align="left" style="max-width: 500px">
				<!-- card -->
				<div class="card card-outline card-teal" style="background-color: oldlace">
					
					<!-- header -->
					<div class="card-header text-center" >
						<h1>Contact Us <i class="fas fa-comment text-teal"></i></h1>
						<h5>Kirim pesan, saran dan kritik Anda melalui form berikut</h5>
					</div>

				 	<!-- body -->
					<div class="card-body">
						<!-- flashdata -->
						<?php if($this->session->flashdata('message_sent')) : ?>
						<div align="center" class="text-success font-weight-bold">
							<?= $this->session->flashdata('message_sent') ?>
							<?php $this->session->unset_userdata('message_sent') ?>
						</div><br>
						<?php endif ?>

						<!-- form -->
						<form method="POST">
							<!-- name -->
							<div class="ml-5">
								<i class="fas fa-user"></i>
								<label for="name">Nama*</label><br>
								<input class="<?= form_error('name') ? 'input-invalid' : 'input' ?>" type="text" name="name" id="name" title="Enter your name" placeholder="Maks. 32 karakter" maxlength="32" value="<?= set_value('name') ?>" required>
								<?= form_error('name', '<div class="text-danger font-weight-bold">', '</div>') ?>
							</div><br>

							<!-- email -->
							<div class="ml-5">
								<i class="fas fa-envelope"></i>
								<label for="email">E-mail*</label><br>
								<input type="email" class="<?= form_error('email') ? 'input-invalid' : 'input' ?>" name="email" id="email" title="Your E-mail address" placeholder="Maks 64 karakter" value="<?= set_value('email') ?>" required>
								<?= form_error('email', '<div class="text-danger font-weight-bold">', '</div>') ?>
							</div><br>

							<!-- message -->
							<div class="ml-5">
								<i class="fas fa-pen-alt"></i>
								<label for="message">Message*</label><br>
								<textarea class="<?= form_error('message') ? 'input-invalid' : 'input' ?> sans-serif" name="message" id="message" title="Enter your message" cols="30" rows="5" 
								placeholder="Pesan Anda | Maks. 150 karakter" 
								style="resize: none;" required><?= set_value('message') ?></textarea>
								<?= form_error('message', '<div class="text-danger font-weight-bold">', '</div>') ?>
							</div><br>

							<!-- function untuk membersihkan form -->
							<script type="text/javascript">
								function bersih() {
									// mengosongkan field <input>
									document.getElementById('name').value = ''; 
									document.getElementById('email').value = '';
									document.getElementById('message').value = '';	
								}
							</script>

							<!-- submit & reset -->
							<div class="ml-5">
								<button class="btn-submit h6" type="submit" title="Submit the form">
									Kirim <i class="fas fa-upload"></i>
								</button>&nbsp &nbsp
								<button class="btn-reset h6" type="button" title="Empty the form" onclick="bersih()">
									Bersih <i class="fas fa-broom"></i>
								</button>
							</div>
						</form>
						<!-- /.form -->
					</div>
					<!-- /.container form -->
				</div>
				<!-- /.card -->
			</div>
			<!-- /.container form -->
		</div>
		<!-- /.content-wrapper -->

		<?php $this->load->view('templates/footer')	?>

	</div>
	<!-- /.wrapper -->
</body>
</html>