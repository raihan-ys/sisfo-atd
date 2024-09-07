<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Slip Gaji - <?= $gaji->no_gaji ?></title>
  <style>
    body { font-family: Arial, sans-serif; }
    .container { width: 80%; margin: 0 auto; }
    table { width: 100%; border-collapse: collapse; }
    th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
    th { background-color: #f2f2f2; }
  </style>
</head>
<body>
  <div class="container">
    <h1>Slip Gaji</h1>
    <table>
      <tr>
        <th>No. Gaji</th>
        <td><?= $gaji->no_gaji ?></td>
      </tr>
      <tr>
        <th>Tanggal Gaji</th>
        <td><?= $gaji->tgl_gaji ?></td>
      </tr>
      <tr>
        <th>NIK</th>
        <td><?= $gaji->nik ?></td>
      </tr>
      <tr>
        <th>Kode Jabatan</th>
        <td><?= $gaji->kode_jabatan ?></td>
      </tr>
      <tr>
        <th>Gaji Pokok</th>
        <td>Rp <?= number_format($gaji->gaji_pokok, 0, ',', '.') ?></td>
      </tr>
      <tr>
        <th>Tunjangan Beras</th>
        <td>Rp <?= number_format($gaji->tunjangan_beras, 0, ',', '.') ?></td>
      </tr>
      <tr>
        <th>Potongan Terlambat</th>
        <td>Rp <?= number_format($gaji->potongan_telat, 0, ',', '.') ?></td>
      </tr>
      <tr>
        <th>Potongan Absen</th>
        <td>Rp <?= number_format($gaji->potongan_absen, 0, ',', '.') ?></td>
      </tr>
      <tr>
        <th>Bonus</th>
        <td>Rp <?= number_format($gaji->bonus, 0, ',', '.') ?></td>
      </tr>
      <tr>
        <th>Gaji Bersih</th>
        <td>Rp <?= number_format($gaji->gaji_bersih, 0, ',', '.') ?></td>
      </tr>
    </table>
  </div>
  <script>
    window.print();
  </script>
</body>
</html>