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


function tambah($data){
   $conn = koneksi();
   $nama = htmlspecialchars($data['nama']) ; 
   $email = htmlspecialchars($data['email']) ;
   $nrp = htmlspecialchars($data['nrp']) ;
   $jurusan = htmlspecialchars($data['jurusan']) ;
   $gambar = htmlspecialchars($data['gambar']) ;

   $query = "INSERT INTO mahasiswa 
            VALUES 
            (null,'$nama','$nrp','$email','$jurusan','$gambar')
            ";
   
   mysqli_query($conn,$query) or die(mysqli_error($conn));   
   return mysqli_affected_rows($conn);
}

function hapus($id){
   $conn = koneksi();
   $query = "DELETE FROM mahasiswa WHERE id = $id";
   mysqli_query($conn,$query) or die(mysqli_error($conn));
   return mysqli_affected_rows($conn);
}

function ubah($data){
   $conn = koneksi();

   $id = $data['id'];
   $nama = htmlspecialchars($data['nama']) ; 
   $email = htmlspecialchars($data['email']) ;
   $nrp = htmlspecialchars($data['nrp']) ;
   $jurusan = htmlspecialchars($data['jurusan']) ;
   $gambar = htmlspecialchars($data['gambar']) ;

   $query = "UPDATE mahasiswa SET
               nama = '$nama',
               nrp = '$nrp',
               email = '$email',
               jurusan = '$jurusan',
               gambar = '$gambar'
               WHERE id = $id
            ";
   
   mysqli_query($conn,$query) or die(mysqli_error($conn));   
   return mysqli_affected_rows($conn);
}
?>