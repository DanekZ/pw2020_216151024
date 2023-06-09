<?php 
session_start();
require 'functions.php';
// cek session login
if (!isset($_SESSION['login'])) {
   # code...
   header('Location: login.php');
   exit;
}



// cek apakah tombol tambah data sudah diklik
if(isset($_POST['tambah'])){
   if(tambah($_POST) > 0){
      echo "<script>
            alert('data anda berhasil ditambahkan!')
            document.location.href = 'index.php';
            </script>";
   } else {
      echo "data anda gagal terkirim";
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
   <h3>form tambah data mahasiswa</h3>
   <form action="" method="POST">
      <ul>
         <li>
            <label>
               nama :
               <input type="text" name="nama" autofocus>
            </label>
         </li>
         <li>
            <label>
               nrp :
               <input type="text" name="nrp">
            </label>
         </li>
         <li>
            <label>
               email :
               <input type="text" name="email">
            </label>
         </li>
         <li>
            <label>
               jurusan :
               <input type="text" name="jurusan">
            </label>
         </li>
         <li>
            <label>
               gambar :
               <input type="text" name="gambar">
            </label>
         </li>
         <li>
            <button type="submit" name="tambah">tambah data</button>
         </li>
      </ul>
   </form>
</body>

</html>