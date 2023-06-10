<?php
require "../functions.php";
$mahasiswa = cari($_GET['keyword']) ;
 ?>

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