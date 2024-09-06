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

		<!-- content -->
		<div class="bg-transparent content-wrapper p-3">
			<div class="container-fluid" style="max-width: 1400px">
				<div class="card card-outline card-info article" style="background-color: oldlace">

					<!-- header -->   
					<div class="card-header">
						<h1><i class="fas fa-list"></i> Post List</h1>
						<div class="toolbar">

							<!-- post add -->
							<a href="<?= site_url('admin/akademik/post/add') ?>" class="btn btn-primary" role="button">
								<i class="fas fa-edit"></i> Create Post
							</a>
	
							<!-- flashdata -->
							<?php if ($this->session->flashdata('post_deleted')): ?>
							&nbsp &nbsp &nbsp
							<span class="alert alert-dismissible fade show bg-lime" id="alertDiv">
								<b><?= $this->session->flashdata('post_deleted') ?></b> <i class="fas fa-trash"></i>
								<?php $this->session->unset_userdata('post_deleted') ?>
								<button type="button" class="close" id="closeAlert" aria-label="close">
									<span aria-hidden="true">&times;</span>
								</button>
							</span>
							<?php elseif ($this->session->flashdata('post_truncated')): ?>
								<span class="alert alert-dismissible fade show bg-lime" id="alertDiv">
								<b><?= $this->session->flashdata('post_truncated') ?></b> <i class="fas fa-trash"></i>
								<?php $this->session->unset_userdata('post_truncated') ?>
								<button type="button" class="close" id="closeAlert" aria-label="close">
									<span aria-hidden="true">&times;</span>
								</button>
							</span>
							<?php endif ?>
							<!-- /.flashdata -->

						</div>
					</div>
					<!--/.header -->

					<!-- search -->
					<div class="my-3">
						<form method="GET">
							<!-- input keyword -->
							<input type="search" title="Enter the keyword" class="input" name="keyword" placeholder="Cari judul atau isi konten..." value="<?= html_escape($keyword) ?>" maxlength="255">
							&nbsp; &nbsp; &nbsp;

							<!-- select status -->
							<select title="Select status" class="input" name="status">
								<option value="" selected>Semua Status</option>
								<?php foreach ($statusx as $sts) : ?>
								<option value="<?= $sts ?>" <?= set_select('status', $sts, $sts === $status ? true : false) ?>>
									<?= $sts 	?>
								</option>
								<?php endforeach ?>
							</select>
							&nbsp; &nbsp; &nbsp; 

							<!-- submit -->
							<button title="Activate search engine" value="search" type="submit" class="btn-submit" style="background-color: aquamarine">
								Cari <i class="fas fa-search"></i>
							</button>
						</form>
					</div>
					<!-- /.search -->
					 <h1 class="text-center mb-3">
						Tidak ada yang ditemukan!
						<i class="fas fa-wind"></i><i class="fas fa-leaf"></i>
					 </h1>
				</div>
				<!-- /.card -->
			</div>
			<!-- /.container-fluid -->
		</div>
		<!-- /.content -->
		
		<?php $this->load->view('templates/footer') ?>

	</div>
	<!-- wrapper -->
</body>
</html>
