<?php 
require 'functions.php';

// tampung nilai rows di variabel mahasiswa
$mahasiswa = query("SELECT * FROM mahasiswa");

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
   <table border="1" cellspacing="0" cellpadding="10">
      <tr>
         <th>#</th>
         <th>gambar</th>
         <th>Nama</th>
         <th>Aksi</th>
      </tr>

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