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
						<h1>
							Tidak ada yang ditemukan!
						</h1>
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