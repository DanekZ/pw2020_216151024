<?php 

function koneksi(){
   return mysqli_connect('localhost','root','','pw2020_216151024');
}

function query($query){

   $conn = koneksi();

   $result = mysqli_query($conn,$query);

   // jika jumlah hasilnya hanya 1
   if(mysqli_num_rows($result) == 1){
      return mysqli_fetch_assoc($result);
   }

   $rows = [];
   while($row = mysqli_fetch_assoc($result)){
      $rows[] = $row;
   }

   return $rows;
}


?>