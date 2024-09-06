<!DOCTYPE html>
<html lang="en">

<?php $this->load->view('templates/head'); ?>
<?php $this->load->view('templates/background'); ?>

<body class="hold-transition sidebar-mini layout-fixed">

	<!-- wrapper -->
	<div class="wrapper">

		<?php 
		$this->load->view('templates/sidebar');
		$this->load->view('templates/navbar'); 
		?>

		<!-- content -->
		<div class="bg-transparent content-wrapper p-3">
			<div class="container-fluid" style="max-width: 1000px">

				<h1 class="text-white">Feedbacks <i class="fas fa-comments"></i></h1>

				<a class="btn btn-danger font-weight-bold" title="No feedbacks at all.." role="button" href="<?= site_url('admin/akademik/feedback/truncate') ?>" onclick="return confirm('⚠ Anda yakin ingin menghapus semua item?')">
					<i class="fas fa-fire"></i> Delete All Feedbacks
				</a><br><br>

				<!-- flashdata -->
				<?php if ($this->session->flashdata('feedback_deleted')) : ?>
				<div class="alert alert-dismissible fade show bg-lime" id="alertDiv" style="width: 320px">
					<b><?= $this->session->flashdata('feedback_deleted') ?></b> <i class="fas fa-trash"></i>
					<?php $this->session->unset_userdata('feedback_deleted') ?>
					<button type="button" class="close" id="closeAlert" aria-label="close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php endif ?>

				<!-- feedbacks -->
				<?php foreach ($feedbacks as $feedback) : ?>
				<div class="card card-outline card-info bg-oldlace">
					<div class="card-header">
						<div>
							<b><?= $feedback->name ?></b> 
							<small class="text-secondary"><?= $feedback->email ?></small>
						</div>
						<div>
							<small class="text-secondary"><?= $feedback->created_at ?></small>
						</div>
						<p><?= $feedback->message ?></p>
						<a class="btn btn-danger btn-small" title="delete feedback from our dearest subscriber" href="<?= site_url('admin/akademik/feedback/delete/'.$feedback->id) ?>" onclick="return confirm('⚠ Anda yakin ingin hapus item ini?')">
							<i class="fas fa-trash"></i> Hapus
						</a>
					</div>
				</div>
				<?php endforeach ?>
				<!-- /.feedbacks -->
			</div>
			<!-- /. container-fluid -->
		</div>	
		<!-- /. content-wrapper -->

		<?php $this->load->view('templates/footer') ?>

	</div>
	<!-- /.wrapper -->
</body>
</html>