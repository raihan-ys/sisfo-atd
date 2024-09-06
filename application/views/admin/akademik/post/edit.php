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
			<div class="container-fluid" style="max-width: 1000px">
				<div class="card card-outline card-info article" style="background-color: oldlace">

					<div class="card-header text-center"><h1 class="post-title">Edit Artikel</h1></div>

					<div class="card-body">
						<form method="POST" enctype="multipart/form-data">
							
							<!-- image -->
							<div>
								<label>
									<i class="fas fa-image"></i> Image<br>
									Upload a file with <span class="text-info">.gif</span>, <span class="text-info">.jpeg</span>, <span class="text-info">.jpg</span>, or <span class="text-info">.png</span> format for the article's image or illustration <b>(max. size 1MB, width 1500px, height 1500px)</b>.
								</label>

								<!-- upload file -->
								<label class="label-upload">
									<input type="file" name="image" id="image" accept="image/gif, image/jpeg, image/jpg, image/png" onchange="preview_image()" required>
									<span>Choose file</span>
								</label>

								<script type="text/javascript">
									// function to preview the uploaded image
									function preview_image() 
									{
										// get the uploaded file
										const [file] = document.getElementById('image').files;
										if (file) {
											// create the directory to that file
											uploaded_file.src = URL.createObjectURL(file); 
										}
									}
								</script>

								<!-- display image errors -->
								<?php if ($this->session->flashdata('file_not_set')) : ?>
								<p class="text-danger font-weight-bold">
									<?= $this->session->flashdata('file_not_set') ?>
									<?php $this->session->unset_userdata('file_not_set') ?>
								</p>
								<?php elseif (isset($image_error)) : echo $image_error; endif ?>

								<!-- show the uploaded image -->
								<div class="pt-1">
									<img class="<?= $this->session->flashdata('file_not_set') || isset($image_error) ? 'article-image-preview-invalid' : 'article-image-preview' ?>" id="uploaded_file" src="<?= $article->image ? base_url('uploads/article-image/'.$article->image) : base_url('assets/images/atd-logo.png') ?>" alt="Article's image">
								</div>
							</div>
							<!-- /.image -->

							<!-- title -->
							<div class="pt-3">
								<label for="title"><i class="fas fa-flag"></i> Judul</label><br>
								<input class="<?= form_error('title') ||  $this->session->flashdata('title_duplicated') ? 'input-invalid' : 'input' ?>" type="text" name="title" id="title" placeholder="Maks. 128 karakter | Judul tidak boleh sama" title="Judul artikel wajib diisi!" value="<?= set_value('title', $article->title) ?>" maxlength="128" required>
								<?= form_error('title', '<div class="text-danger font-weight-bold">', '</div>') ?>

								<!-- if the submitted title is the already taken... -->
								<?php if ($this->session->flashdata('title_duplicated')) : ?>
								<div class="text-danger font-weight-bold">
									<?= $this->session->flashdata('title_duplicated') ?>
									<?php $this->session->unset_userdata('title_duplicated') ?>
								</div>
								<?php endif ?>
							</div>

							<!-- content -->
							<div class="pt-3">
								<label for="content"><i class="fas fa-edit"></i> Konten</label><br>
								<textarea class="<?= form_error('content') ? 'input-invalid' : 'input' ?>" name="content" id="content" title="Article contents goes here.." cols="30" rows="10" placeholder="Write your imagination..." style="resize: none; width: 800px" required><?= set_value('content', $article->content) ?></textarea>
								<?= form_error('content', '<div class="text-danger font-weight-bold">', '</div>') ?>
							</div> 

							<script type="text/javascript">
								// function untuk mengembalikan value field seperti semula
								function resetValue() {
									document.getElementById('title').value = '<?= $article->title ?>';
									document.getElementById('content').value = '<?= $article->content ?>';
								};
								// function untuk mengosongkan field
								function bersih() {
									document.getElementById('title').value = '';
									document.getElementById('content').value = '';
								};
							</script>

							<div>
								<button class="btn btn-secondary" type="submit" name="draft" value="true">Simpan ke Draft</button>
								<button class="btn btn-primary" type="submit" name="draft" value="false">Publish Update</button>
								<button class="btn btn-warning" type="button" onclick="resetValue()">Reset</button>
								<button class="btn btn-danger" type="button" onclick="bersih()">Bersih</button>
								<?= form_error('draft', '<div class="text-danger font-weight-bold"', '</div>') ?>
							</div>
						</form>
					</div>
					<!-- /.card-body -->
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