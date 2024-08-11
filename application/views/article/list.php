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

	  <div class="content-wrapper bg-transparent p-3">

	    <?php $this->load->view('templates/content-header') ?>

	    <div class="container-fluid" style="max-width: 1000px">
			
	    	<div class="card card-outline card-success article" style="background-color: oldlace">

					<!-- header -->
	    		<div class="card-header">
		    		<h1>📚 Daftar Artikel</h1>

						<form method="get">
							<label for="keyword">Cari Artikel: </label>
							<input type="search" name="keyword" class="input" placeholder="Masukkan kata kunci.." value="<?= html_escape($keyword) ?>" maxlength="128">
							&nbsp &nbsp
							<button value="search" type="submit" class="btn-submit" style="background-color: aquamarine">
                Cari <i class="fas fa-search"></i>
              </button>
						</form>
					</div>

					<!-- contents -->
					<div class="card-body">
					  <?php foreach ($articles as $article) : ?>

					  <a title="Read this article" href="<?= base_url('article/'.$article->slug) ?>">
							<img src="<?= $article->image ? base_url('uploads/article-image/'.$article->image) : base_url('assets/images/atd-logo.png') ?>" alt="<?= $article->title ?>" style="max-height: 180px; max-width: 180px">

							<h2 class="text-info"><?= $article->title ? html_escape($article->title) : "Tidak Berjudul" ?></h2>

							<p class="text-dark"><?= substr($article->content, 0, 200) ?></p>
						</a>

						<hr>
					  <?php endforeach ?>

						<!-- pagination -->
						<?php
            if (!empty($keyword)) { 
              // do nothing... I make it like this, so when the user use the search feature, the pagination feature won't showing (because i still have problems with search and pagination feature combined).
            } else {
              echo $this->pagination->create_links();
            }
						?>
					</div>

				</div>
				<!-- /.card -->
		  </div>
	    <!-- /.container-fluid -->
	  </div>
	  <!-- /.content-wrapper -->
		<?php $this->load->view('templates/footer') ?>
	</div>
	<!-- /.wrapper -->
</body>
</html>
