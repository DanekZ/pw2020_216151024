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

function cari($keyword){
   $conn = koneksi();
   $query = "SELECT * FROM mahasiswa WHERE
             nama LIKE '%$keyword%' or
             nrp LIKE '%$keyword%' or
             jurusan LIKE '%$keyword%' 
             ";

   $result = mysqli_query($conn,$query);
   $rows = [];

   while($row = mysqli_fetch_assoc($result)){
      $rows[] = $row;
   }

   return $rows; 
}


function login($data){
   $koneksi = koneksi();
   $username = htmlspecialchars($data['username']);
   $password = htmlspecialchars($data['password']);

   if($user = query("SELECT * FROM user WHERE username = '$username'")){
      if(password_verify($password, $user['password'])){
         // set session
         $_SESSION['login'] = true;
         echo "<script>
               alert('login berhasil');
               document.location.href = 'index.php';
               </script>";
         exit;
      }   
   } else{
      return [
         'error' => true,
         'pesan' => "username/password anda salah"
      ];
  }
}

function registrasi($data){
   $conn = koneksi();
   $username = mysqli_real_escape_string($conn,$data['username']);
   $password = mysqli_real_escape_string($conn,$data['password1']);
   $password2 = mysqli_real_escape_string($conn,$data['password2']);


   // cek username dan password tidak boleh kosong
   if(empty($username) || empty($password) || empty($password)){
      echo "<script>
            alert('username / password tidak boleh kosong!');
            document.location.href = 'registrasi.php';
            </script>";
      return false;
   }

   // jika username sudah ada 
   if(query("SELECT * FROM user WHERE username = '$username'")){
      echo "<script>
               alert('username sudah terdaftar');
               document.location.href = 'registrasi.php';
             </script>";
      return false;
   }

   // jika konfirmasi password tidak sesuai dengan password
   if ($password2 !== $password) {
      # code...
      echo "<script>
               alert('konfirmasi password anda tidak sesuai');
               document.location.href = 'registrasi.php';
             </script>";
      return false;
   }

   // jika password yang diinput terlalu pendek
   if (strlen($password) < 5) {
      # code...
       echo "<script>
               alert('password anda terlalu pendek');
               document.location.href = 'registrasi.php';
             </script>";
      return false;     
   }

   // enkripsi password 
   $password_baru = password_hash($password, PASSWORD_DEFAULT);
   $query = "INSERT INTO user 
            VALUES 
            (null,'$username','$password_baru')";

   mysqli_query($conn,$query) or mysqli_error($conn);
   return mysqli_affected_rows($conn);
}
?>