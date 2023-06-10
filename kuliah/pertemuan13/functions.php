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

function upload(){
   $nama_file = $_FILES['gambar']['name'];
   $tipe_file = $_FILES['gambar']['type'];
   $tmp_file = $_FILES['gambar']['tmp_name'];
   $error_file = $_FILES['gambar']['error'];
   $size = $_FILES['gambar']['size'];
 
   // cek jika tidak upload foto
   if($error_file == 4){
      // echo "<script>
      //       alert('upload file terlebih dahulu');
      //       </script>";
      return 'nophoto.jpg';
   }

   // cek ekstensi file
   $daftar_gambar = ['jpg','jpeg','png'];
   $ekstensi_file = explode('.',$nama_file);
   $ekstensi_file = strtolower(end($ekstensi_file));

   if(!in_array($ekstensi_file,$daftar_gambar)){
      echo "<script>
      alert('yang anda upload bukan gambar!!');
      </script>";
      return false;
   }  

   // cek type file 
   if ($tipe_file != 'image/jpeg' && $tipe_file != 'image/png') {
      # code...
      echo "<script>
      alert('ini bukan gambar sayang');
      </script>";
      return false;
   }

   // cek ukuran file 
   if($size > 500000){
      echo "<script>
      alert('ukuran foto terlalu besar!!');
      </script>";
      return false;
   }

   // jika semua sudah lolos pengecekan 
   $namaFileBaru = uniqid();
   $namaFileBaru .= ".";
   $namaFileBaru .= $ekstensi_file;
  
   move_uploaded_file($tmp_file, 'img/'.$namaFileBaru );
   return $namaFileBaru;

}

function tambah($data){
   $conn = koneksi();
   $nama = htmlspecialchars($data['nama']) ; 
   $email = htmlspecialchars($data['email']) ;
   $nrp = htmlspecialchars($data['nrp']) ;
   $jurusan = htmlspecialchars($data['jurusan']) ;
   // $gambar = htmlspecialchars($data['gambar']) ;


   // upload gambar
   $gambar = upload();

   if (!$gambar) {
      # code...
      return false;
   }

   $query = "INSERT INTO mahasiswa 
            VALUES 
            (null,'$nama','$nrp','$email','$jurusan','$gambar')
            ";
   
   mysqli_query($conn,$query) or die(mysqli_error($conn));   
   return mysqli_affected_rows($conn);
}

function hapus($id){
   $conn = koneksi();

   // menghapus gambar 
   $mhs = query("SELECT * FROM mahasiswa WHERE id = '$id'");
   if($mhs['gambar'] != "nophoto.jpg"){
      unlink('img/'.$mhs['gambar']);
   }
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
   $gambar_lama = htmlspecialchars($data['gambar_lama']) ;
   $gambar = upload();

   // jika ada kesalahan upload gambar
   if(!$gambar){
      return false;
   }

   // jika tidak ganti gambar
   if($gambar == "nophoto.jpg"){
      $gambar = $gambar_lama;
   }

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