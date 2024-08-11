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

		<div class="content-wrapper p-3 bg-transparent">

     	<?php $this->load->view('templates/content-header') ?>

      <!-- content -->
      <section class="content">
        <div class="container-fluid" style="max-width: 800px">

					<div class="card card-outline card-primary p-3" style="background: oldlace">
						<!-- header -->
						<h1>🧮 Calculator</h1>
						<hr>
						<!-- contents -->
						<table align="center" border="0" cellpadding="10">
							<thead>
								<tr>
									<th colspan="2">Welcome to My Calculator! :)</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td class="h6">Input First Number</td>
									<td><input class="input" type="number" name="first-num" id="first-num" placeholder="Enter first number." min="0" maxlength="10" required></td>
								</tr>
								<tr>
									<td class="h6">Input Second Number </td>
									<td><input class="input" type="number" name="second-num" id="second-num" placeholder="Enter second number." min="0" maxlength="10" required></td>
								</tr>
								<tr>
									<td class="h6">Choose Operation</td>
									<td> 
										<input class="btn-primary m-3" type="button" name="add" id="add" value="add (+)">
										<input class="btn-primary m-3" type="button" name="substract" id="substract" value="substract (-)">
										<input class="btn-primary m-3" type="button" name="multiply" id="multiply" value="multiply (x)">
										<input class="btn-primary m-3" type="button" name="divide" id="divide" value="divide (/)">
										<input class="btn-primary m-3" type="button" name="modulo" id="modulo" value="modulo (%)">
									</td>
								</tr>
								<tr>
									<td class="h6">Result</td>
									<td><input class="input" type="text" name="result" id="result" readonly></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<!--/.container fluid -->
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<?php $this->load->view('templates/footer') ?>
		
	</div>
	<!-- /.wrapper -->
</body>
</html>
<script src="<?= base_url('assets/js/calculator.js') ?>"></script>
