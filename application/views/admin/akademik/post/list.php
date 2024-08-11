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
							</a>&nbsp &nbsp

							<!-- post truncate -->
							<a href="<?= site_url('admin/akademik/post/truncate') ?>" class="btn btn-danger" role="button" onclick="return confirm('⚠ Anda yakin ingin menghapus semua artikel?')">
								<i class="fas fa-fire"></i> Delete all Posts
							</a>

							<!-- flashdata -->
							<?php if ($this->session->flashdata('post_saved')): ?>
							&nbsp &nbsp &nbsp
							<span class="alert alert-dismissible fade show bg-lime" role="alert">
								<b><?= $this->session->flashdata('post_saved') ?></b> 👍
								<?php $this->session->unset_userdata('post_saved') ?>
								<button type="button" class="close" data-dismiss="alert" aria-label="close">
									<span aria-hidden="true">&times;</span>
								</button>
							</span>
							<?php elseif ($this->session->flashdata('post_updated')): ?>
								&nbsp &nbsp &nbsp
							<span class="alert alert-dismissible fade show bg-lime" role="alert">
								<b><?= $this->session->flashdata('post_updated') ?></b> 👍
								<?php $this->session->unset_userdata('post_updated') ?>
								<button type="button" class="close" data-dismiss="alert" aria-label="close">
									<span aria-hidden="true">&times;</span>
								</button>
							</span>
							<?php elseif ($this->session->flashdata('post_deleted')): ?>
							&nbsp &nbsp &nbsp
							<span class="alert alert-dismissible fade show bg-lime" role="alert">
								<b><?= $this->session->flashdata('post_deleted') ?></b> <i class="fas fa-trash"></i>
								<?php $this->session->unset_userdata('post_deleted') ?>
								<button type="button" class="close" data-dismiss="alert" aria-label="close">
									<span aria-hidden="true">&times;</span>
								</button>
							</span>
							<?php endif ?>

						</div>
					</div>
					<!--/.header -->

					<!-- search -->
					<tr>
						<td>
							<br>
							<div>
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
							<br>
						</td>
					</tr>
					<!-- /.search -->

					<!-- body -->
					<table class="table card-body">

						<thead>
							<tr>
								<th bgcolor="skyblue" style="width: 5%">No.</th>
								<th class="bg-lime text-center">Judul</th>
								<th class="bg-lime text-center" style="width: 15%">Status</th>
								<th class="bg-lime text-center" style="width: 20%">Penulis</th>
								<th bgcolor="skyblue" class="text-center" style="width: 20%">Aksi</th>
							</tr>
						</thead>

						<tbody>
							<?php
							$i = 1; // <-index number
							foreach ($articles as $article) : 
							?>
							<tr>

								<!-- index column -->
								<td class="text-center font-weight-bold" style="vertical-align: middle" bgcolor="skyblue">
									<?= $i.'.'; $i++ ?>
								</td>
								
								<!-- title and image column -->
								<td style="padding-left: 50px;vertical-align: middle">
									<!-- image -->
									<div>
										<img class="article-image-preview" style="max-height: 180px; max-width: 180px" 
										src="<?= $article->image ? base_url('uploads/article-image/'.$article->image) : base_url('assets/images/atd-logo.png') ?>" alt="<?= $article->title ?>">
									</div>

									<!-- title -->
									<div class="font-weight-bold text-info h4"><?= $article->title ?></div>
									<div class="text-dark"><?= substr($article->content, 0, 200) ?></div>

									<!-- created at and updated at -->
									<div class="text-secondary">
										<small>
											Created at <?= $article->created_at ?>
											<?php if ($article->updated_at) : ?>
											| Updated at <?= $article->updated_at ?>
											<?php endif ?>
										</small>
									</div>
								</td>

								<!-- status column -->
								<td bgcolor="papayawhip" align="center" style="vertical-align: middle">
									<font class="<?= $article->draft === 'true' ? 'text-secondary' : 'text-success' ?> font-weight-bold" size="4">
										<?= $article->draft === 'true' ? 'Draft' : 'Published' ?>
									</font>
								</td>

								<!-- writer column-->
								<td align="center" style="vertical-align: middle">
									<font class="text-primary font-weight-bold" size="4"><?= $article->user ?></font>
								</td>
	
								<!-- action column -->
								<td bgcolor="skyblue" align="center" style="vertical-align: middle">
									<div>
										<a href="<?= site_url('article/show/'.$article->slug) ?>" class="btn btn-small btn-info" title="PREVIEW" role="button" target="_blank">
											<i class="fas fa-eye"></i>
										</a>

										<a href="<?= site_url('admin/akademik/post/edit/'.$article->id) ?>" class="btn btn-small btn-info" title="EDIT" role="button"> 
											<i class="fas fa-pen"></i>
										</a>

										<a href="<?= site_url('admin/akademik/post/delete/'.$article->id) ?>" class="btn btn-small btn-danger" title="DELETE" role="button" onclick="return confirm('⚠ Anda yakin ingin menghapus artikel ini?')">
											<i class="fas fa-trash"></i>
										</a>
									</div>
								</td>
							</tr>
							<?php endforeach ?>

							<!-- footer -->
							<tr>
								<td>
									<!-- pagination -->
									<?php
									if (!empty($keyword) || !empty($status)) { 
										/* do nothing... I make it like this, so when the user use the search feature, the pagination feature won't showing (because i still have problems with search and pagination feature combined) */
									}
									else {
										echo $this->pagination->create_links();
									}
									?>
								</td>
							</tr>
						</tbody>
					</table>
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
