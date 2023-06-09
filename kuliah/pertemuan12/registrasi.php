<?php 
require 'functions.php';

// cek apakah tombol registrasi sudah di klik
if(isset($_POST['registrasi'])){
   if(registrasi($_POST) > 0){
       echo "<script>
               alert('registrasi berhasil');
               document.location.href = 'login.php';
             </script>";
   } else {
       echo "<script>
               alert('registrasi gagal');
               document.location.href = 'registrasi.php';
             </script>";
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Form registrasi</title>
</head>

<body>
   <h3>Form Registrasi</h3>

   <form action="" method="post">
      <ul>
         <li>
            <label for="username">username : </label>
            <input type="text" name="username" placeholder="masukkan username" autofocus autocomplete="off"
               id="username" required>
         </li>
         <li>
            <label for="password1">password : </label>
            <input type="text" name="password1" placeholder="masukkan password" autocomplete="off" id="password1"
               required>
         </li>
         <li>
            <label for="password2">konfirmasi password : </label>
            <input type="text" name="password2" placeholder="konfirmasi password" autocomplete="off" id="password2"
               required>
         </li>
         <li>
            <button type="submit" name="registrasi">registrasi</button>
         </li>
      </ul>
   </form>

</body>

</html>