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

	<!-- content -->
	<div class="bg-transparent content-wrapper p-3">
		<div class="container-fluid " style="max-width: 600px">

			<!-- flashdata -->
			<?php if ($this->session->flashdata('post_deleted')) : ?>
			<div class="alert alert-dismissible fade show bg-lime" role="alert" style="width: 300px">
				<b><?= $this->session->flashdata('post_deleted') ?></b> <i class="fas fa-trash"></i>
				<?php $this->session->unset_userdata('post_deleted') ?>
				<button type="button" class="close" data-dismiss="alert" aria-label="close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php elseif ($this->session->flashdata('post_truncated')) : ?>
			<div class="alert alert-dismissible fade show bg-lime" role="alert" style="width: 380px">
				<b><?= $this->session->flashdata('post_truncated') ?></b> <i class="fas fa-fire"></i>
				<?php $this->session->unset_userdata('post_truncated') ?>
				<button type="button" class="close" data-dismiss="alert" aria-label="close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php endif ?>
			
			<div class="card card-outline card-danger p-3" style="background-color: oldlace">
				<h1>Article not found! <i class="fas fa-frown"></i></h1>
				<div>
					<a href="<?= site_url('admin/akademik/post/add') ?>" class="btn btn-primary">
						Write Article <i class="fas fa-edit"></i> 
					</a>
				</div>
			</div>
		</div>
		<!-- /.container-fluid -->
	</div>
	<!-- /.content -->
	
	<?php $this->load->view('templates/footer') ?>

</div>
<!-- wrapper -->

</body>
</html>