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
	    	<?php $this->load->view('templates/content-header') ?>

	    	<div class="container-fluid" style="max-width: 800px">
	    		<div class="card card-outline card-warning article" style="background-color: oldlace">
		    		<h1>Belum ada Artikel!</h1>
		    		<p>Artikel mungkin masih di dalam draft, penulis akan segera menyelesaikannya... <span class="h1">👨‍💻</span></p>
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