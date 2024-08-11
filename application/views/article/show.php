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

		<!-- content-wrapper -->
		<div class="bg-transparent content-wrapper p-3">

			<!-- main-content -->
			<div class="container-fluid" style="max-width: 1300px">	
				<div class="card card-outline card-success" style="background-color: oldlace">
					<article class="article">

						<!-- header -->
						<div class="card-header">

							<!-- article title -->
							<h1 class="post-title">
								<?= $article->title ? html_escape($article->title) : 'Tidak Berjudul' ?>
							</h1>

							<!-- meta (additonal information about the article) -->
							<div class="post-meta d-flex" style="align-items: center">
								<img class="img-circle elevation-2 avatar-preview" style="height: 60px; width: 60px" src="<?= $article->user_avatar ? base_url('uploads/user-avatar/'.$article->user_avatar) : base_url('assets/images/user.png') ?>" alt="<?= htmlentities($article->user, TRUE) ?>">
								&nbsp
								<!-- article writer -->
								<span style="flex-grow: 1">
									&nbsp <font size="5"><?= $article->user ?></font>
									<br>
									&nbsp Article Writer
								</span>
								<!-- date -->
								<span>
									<?php if ($article->updated_at) : ?>
									<font size="5">Updated at <?= $article->updated_at ?></font>
									<?php endif ?>
									<br>
									Created at <?= $article->created_at ?>
								</span>
							</div>
						</div>
						<!-- header -->

						<!-- body -->
						<div class="card-body pt-4">

							<!-- article body -->
							<div class="post-body">

								<!-- article image -->
								<div align="center">
									<img style="max-width: 500px" src="<?= $article->image ? base_url('uploads/article-image/'.$article->image) : base_url('assets/images/atd_logo.png') ?>" alt="<?= htmlentities($article->title, TRUE) ?>">
								</div><br>

								<!-- article content -->
								<?= $article->content ? html_escape($article->content) : 'Tidak ada konten.' ?>

							</div>
						</div>
						<!-- /.body -->
					</article>
				</div>
			</div>
			<!-- /.main-content -->
		</div>
		<!-- /.content-wrapper -->
		<?php $this->load->view('templates/footer') ?>
	</div>
	<!-- /.wrapper -->
</body>
</html>
