<?php 
require 'functions.php';

// tampung nilai rows di variabel mahasiswa
$mahasiswa = query("SELECT * FROM mahasiswa");


if(isset($_POST['cari'])){
   $mahasiswa = cari($_POST['keyword']);
}
 ?>



<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Daftar Mahasiswa</title>
</head>

<body>
   <a href="tambahdata.php" style="display: block;">Tambah Data</a>
   <br>
   <form action="" method="post">
      <input placeholder="masukkan keyword pencarian" autocomplete="off" autofocus type="text" name="keyword" size="30">
      <button type="submit" name="cari">cari</button>
   </form>
   <br>
   <table border="1" cellspacing="0" cellpadding="10">
      <tr>
         <th>#</th>
         <th>gambar</th>
         <th>Nama</th>
         <th>Aksi</th>
      </tr>

      <?php if(empty($mahasiswa)): ?>
      <tr>
         <td colspan="4">
            <p>Data Mahasiswa Tidak Ditemukan</p>
         </td>
      </tr>
      <?php endif ?>

      <?php $i = 1; ?>
      <?php foreach($mahasiswa as $m) :?>
      <tr>
         <td><?= $i; ?></td>
         <td><img src="img/<?= $m['gambar']; ?>" alt="" width="100" height="100"></td>
         <td><?= $m['nama']; ?></td>
         <td><a href="detail.php?id=<?= $m['id']; ?>">Lihat Detail</a></td>
      </tr>
      <?php $i++; ?>
      <?php endforeach ?>
   </table>
</body>

</html>