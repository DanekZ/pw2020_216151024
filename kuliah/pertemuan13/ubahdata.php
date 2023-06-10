<?php 
session_start();
require 'functions.php';
// cek session login
if (!isset($_SESSION['login'])) {
   # code...
   header('Location: login.php');
   exit;
}



// cek jika tidak ada id
if(!isset($_GET['id'])){
   header('Location: index.php');
   exit;
}

// cek nilai pada url
$id = $_GET['id'];

// panggil data dari database
$m = query("SELECT * FROM mahasiswa WHERE id = $id");


// cek apakah tombol tambah data sudah diklik
if(isset($_POST['ubah'])){
   if(ubah($_POST) > 0){
      echo "<script>
            alert('data anda berhasil diubah!');
            document.location.href = 'index.php';
            </script>";
   } else {
      echo "data anda gagal diubah";
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>tambah data</title>
</head>

<body>
   <h3>form ubah data mahasiswa</h3>
   <form action="" method="POST" enctype="multipart/form-data">
      <ul>

         <input type="hidden" name="gambar_lama" value="<?= $m['gambar']; ?>">
         <label>
            <input type="hidden" name="id" value="<?= $m['id']; ?>">
         </label>
         <li>
            <label>
               nama :
               <input type="text" name="nama" value="<?= $m['nama']; ?>" autofocus>
            </label>
         </li>
         <li>
            <label>
               nrp :
               <input type="text" name="nrp" value="<?= $m['nrp']; ?>">
            </label>
         </li>
         <li>
            <label>
               email :
               <input type="text" name="email" value="<?= $m['email']; ?>">
            </label>
         </li>
         <li>
            <label>
               jurusan :
               <input type="text" name="jurusan" value="<?= $m['jurusan']; ?>">
            </label>
         </li>
         <li>
            <label>
               gambar :
               <input type="file" name="gambar" class="gambar" onchange="previewImage()">
            </label>
            <img src="img/<?= $m['gambar']; ?>" alt="" width="120" style="display: block;" class="imgPreview">
         </li>
         <li>
            <button type="submit" name="ubah">Ubah Data</button>
         </li>
      </ul>
   </form>


   <script src="js/previewImg.js"></script>
</body>

</html>