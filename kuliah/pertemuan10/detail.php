<?php 
require 'functions.php';

// memeriksa data yang dikirim melalui url
$id = $_GET['id'];

// melakukan query berdasarkan id 
$mahasiswa = query("SELECT * FROM mahasiswa WHERE id = $id");

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Detail Mahasiswa</title>
</head>

<body>
   <h3>Detail Mahasiswa</h3>
   <ul>
      <li><img src="img/<?= $mahasiswa['gambar']; ?>" alt="" width="100" height="100"></li>
      <li>NRP : <?php echo $mahasiswa['nrp'] ?></li>
      <li>Nama : <?= $mahasiswa['nama']; ?></li>
      <li>Email : <?= $mahasiswa['email']; ?></li>
      <li>Jurusan : <?= $mahasiswa['jurusan']; ?></li>
      <li><a href="">edit</a> | <a href="">hapus</a></li>
      <li><a href="latihan3.php">kembali ke daftar mahasiswa</a></li>
   </ul>
</body>

</html>