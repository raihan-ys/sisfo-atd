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

		<div class="bg-transparent content-wrapper p-3">
			<div class="container-fluid" style="max-width: 800px">

				<!-- flashdata -->
				<?php if ($this->session->flashdata('feedback_deleted')) : ?>
				<div class="alert alert-dismissible fade show bg-success" role="alert" style="width: 320px">
					<b><?= $this->session->flashdata('feedback_deleted') ?></b> <i class="fas fa-trash"></i>
					<?php $this->session->unset_userdata('feedback_deleted') ?>
					<button type="button" class="close" data-dismiss="alert" aria-label="close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php elseif ($this->session->flashdata('feedback_truncated')) : ?>
				<div class="alert alert-dismissible fade show bg-success" role="alert" style="width: 350px">
					<b><?= $this->session->flashdata('feedback_truncated') ?></b> <i class="fas fa-fire"></i>
					<?php $this->session->unset_userdata('feedback_truncated') ?>
					<button type="button" class="close" data-dismiss="alert" aria-label="close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php endif ?>
				<!-- /.flashdata -->

				<div class="card card-outline card-warning p-1" align="center" style="background-color: oldlace; width: 700px">
	        <h2>No Feedbacks... <i class="fas fa-wind"></i> <i class="fas fa-leaf"></i></h2>
	        <h4>But you can <a class="text-info" href="<?= site_url('page/contact') ?>">create your own feedback!</h4>
	      </div>
			</div>
			<!-- container-fluid -->
		</div>
		<!-- /.content-wrapper -->
		
		<?php $this->load->view('templates/footer') ?>

	</div>
	<!-- wrapper -->
</body>
</html>