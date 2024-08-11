<?php 
error_reporting(0);
require '../../config/koneksi.php';
$id = $_GET['id'];

// query select MySQL untuk mendapatkan data dari tabel kode jabatan dan kode karyawan(dengan inner join?)
$selectQuery = mysqli_query($koneksi, "SELECT * FROM tb_gaji a INNER JOIN tb_jabatan b ON a.kode_jabatan = b.kode_jabatan INNER JOIN tb_karyawan c ON a.kode_karyawan = c.kode_karyawan WHERE a.id = $id");

// mendapatkan data spesifik dari hasil query diatas
$result = mysqli_fetch_assoc($selectQuery);
?>
			
<!DOCTYPE html>
<html>
<head>
	<title> &nbsp </title>
</head>

<!-- onload="window.print();" ==> maksudnya, akan membuka halaman/webpage yang memersiapkan operasi untuk mencetak -->
<body onload="window.print();" 
style="font-family: sans-serif;">
<br>
	<!-- table -->
	<table align="center" border="0" cellpadding="5">
		<!-- ul input -->
		<ul>

			<!-- header -->
			<tr>
				<th bgcolor="honeydew" colspan="2" align="center">
					<h3>** Slip Pembayaran Gaji Karyawan **</h3>
				</th>
			</tr>
			<!-- /.header -->

			<!-- Profil Karyawan -->
			<!-- nama karyawan -->
			<tr>
				<td><li>Nama Karyawan</li></td>
				<td>
					: &nbsp
					<b><?php echo $result['nama_karyawan']; ?></b>
				</td>
			</tr>
			<!-- /.nama karyawan -->

			<!-- nama jabatan -->
			<tr>
				<td><li>Jabatan</li></td>
				<td>
					: &nbsp
					<b><?php echo $result['nama_jabatan']; ?></b>
				</td>
			</tr>
			<!-- /.nama jabatan -->

			<!-- Rincian Penggajian -->
			<!-- header 2nd -->
			<tr>
				<th align="center" colspan="2">
					<br>
					Rincian Gaji Karyawan
				</th>
			</tr>
			<!-- /.header 2 -->
			
			<!-- gaji pokok -->
			<tr>
				<td><li>Gaji Pokok</li></td>
				<td>
					: &nbsp
					<?php echo "Rp. ".number_format($result['gaji_pokok'], 2); ?>
				</td>
			</tr>
			<!-- /.gaji pokok -->

			<!-- tunjangan transportasi -->
			<tr>
				<td><li>Tunjangan Transportasi</li></td>
				<td>: &nbsp
					<?php echo "Rp. ".number_format($result['tjgn_transportasi'], 2); ?>	
				</td>
			</tr>
			<!-- /.tunjangan transportasi -->

			<!-- tunjangan beras -->
			<tr>
				<td><li>Tunjangan Beras</li></td>
				<td>: &nbsp
					<?php echo "Rp. ".number_format($result['tjgn_beras'], 2); ?>
				</td>
			</tr>
			<!-- /.tunjangan beras -->

			<!-- potongan keterlamabatan -->
			<tr>
				<td><li>Potongan Keterlambatan</li></td>
				<td>: &nbsp
					<?php echo "Rp. ".number_format($result['ptgn_trlmbt'], 2); ?>
				</td>
			</tr>
			<!-- /.potongan keterlambatan -->

			<!-- potongan absen -->
			<tr>
				<td><li>Potongan Absen</li></td>
				<td>: &nbsp
					<?php echo "Rp. ".number_format($result['ptgn_absen'], 2) ?>
				</td>
			</tr>
			<!-- /.potongan absen -->

			<!-- bonus -->
			<tr>
				<td><li>Bonus</li></td>
				<td>: &nbsp
					<?php echo "Rp. ".number_format($result['bonus'], 2); ?>
				</td>
			</tr>
			<!-- /.bonus -->

			<!-- gaji bersih -->
			<tr>
				<td>GAJI BERSIH</td>
				<td>
					: &nbsp
					<?php echo "<b>Rp. ".number_format($result['gaji_bersih'], 2)."</b>"; ?>
				</td>
			</tr>
			<!-- /.gaji bersih -->
	</table>
	<!-- table -->
</body>
</html>