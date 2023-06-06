<?php 
// koneksi ke database
$con = mysqli_connect('localhost','root','','pw2020_216151024');

// mengambil data yang ada di database tabel mahasiswa
$result = mysqli_query($con,"SELECT * FROM mahasiswa");

// ubah data ke dalam array
// mysqli_fetch_row($result) -> array numerik
// mysqli_fetch_assoc($result) -> array assosiatif
// mysqli_fetch_array($result) -> array keduanya
$rows = [];
while($row = mysqli_fetch_assoc($result)){
   $rows[] = $row;
}

// tampung nilai rows di variabel mahasiswa
$mahasiswa = $rows;

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
         <th>NIM</th>
         <th>Nama</th>
         <th>Email</th>
         <th>Jurusan</th>
         <th>Aksi</th>
      </tr>

      <?php $i = 1; ?>
      <?php foreach($mahasiswa as $m) :?>
      <tr>
         <td><?= $i; ?></td>
         <td><img src="img/<?= $m['gambar']; ?>" alt="" width="100" height="100"></td>
         <td><?= $m['nrp']; ?></td>
         <td><?= $m['nama']; ?></td>
         <td><?= $m['email']; ?></td>
         <td><?= $m['jurusan']; ?></td>
         <td><a href="">edit</a> | <a href="">hapus</a></td>
      </tr>
      <?php $i++; ?>
      <?php endforeach ?>
   </table>
</body>

</html>