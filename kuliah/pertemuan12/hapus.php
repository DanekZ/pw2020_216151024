<?php 
session_start();
// cek session login
if (!isset($_SESSION['login'])) {
   # code...
   header('Location: login.php');
   exit;
}

require 'functions.php';

// cek id url ada atau tidak
if(!isset($_GET['id'])){
   header('Location: index.php');
   exit;
}

// mengambil id dari url
$id = $_GET['id'];

if(hapus($id) > 0 ){
   echo "<script>
         alert('data berhasil di hapus');
         document.location.href = 'index.php';
         </script>";
} else{
   echo "<script>
            alert('data gagal dihapus');
            document.location.href = 'index.php';
         </script>";
}


?>