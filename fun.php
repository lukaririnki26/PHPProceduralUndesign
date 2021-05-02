<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "lelang";
$connection = mysqli_connect($server,$username,$password,$database);
function getMasyarakatRows($sql){
  global $connection;
  $state = mysqli_query($connection,$sql);
  $results = [];
  while($result  = mysqli_fetch_assoc($state)){
      $results[] = $result;
  }
  return $results;
  
}
function insertMasyarakatRows($data){
  global $connection;
  $nama = htmlspecialchars($data["nama"]);
  $email = htmlspecialchars($data["email"]);
  $alamat = htmlspecialchars($data["alamat"]);
  $gambar=upload();
  if (!$gambar){
    return false;
  }
  $sqlinsertmasyarakat = "insert into masyarakat values(null,'$gambar','$nama','$email','$alamat');";
  mysqli_query($connection,$sqlinsertmasyarakat);
  return mysqli_affected_rows($connection);
}
function updateMasyarakatRows($data){
  global $connection;
  $id = $data["id"];
  $nama = htmlspecialchars($data["nama"]);
  $email = htmlspecialchars($data["email"]);
  $alamat = htmlspecialchars($data["alamat"]);
  $gambarlama = htmlspecialchars($data["gambarlama"]);
  if ($_FILES["gambar"]["error"]===4){
    $gambar = $gambarlama;
  }else{
  $gambar=upload();
  }
  $sqlupdatemasyarakat = "update masyarakat set gambar='$gambar',nama='$nama',email='$email',alamat='$alamat' where id =$id;";
  mysqli_query($connection,$sqlupdatemasyarakat);
  return mysqli_affected_rows($connection);
}
function deleteMasyarakatRows($data){
  global $connection;
  $sqldeletemasyarakat = "delete from masyarakat where id = $data";
  mysqli_query($connection,$sqldeletemasyarakat);
  return mysqli_affected_rows($connection);
}
function upload(){

  $nama = $_FILES["gambar"]["name"];
  $tmp = $_FILES["gambar"]["tmp_name"];
  $status = $_FILES["gambar"]["error"];
  $ekstensivalid = ["png","jpg","jpeg"];
  $ekstensi = explode(".",$nama);
  $ekstensi = strtolower(end($ekstensi));
  $namabaru = uniqid();
  $namabaru .=".";
  $namabaru .=$ekstensi;
  if (!in_array($ekstensi,$ekstensivalid)){
    echo("
    <script>
    alert('format file tidak didukung');
    </script>
    ");
    return false;
  }

  if ($status === 4){
    echo("
    <script>
    alert('tidak ada gambar yang dipilih');
    </script>
    ");
    return false;
  }
  move_uploaded_file($tmp , 'img/' . $namabaru);
  return $namabaru;
  var_dump($namabaru);
}
function register($data){
  global $connection;
  $username = stripslashes($data["username"]);
  $password = mysqli_real_escape_string($connection, $data["password"]);
  $password2 = mysqli_real_escape_string($connection, $data["password2"]);
  $sqlcekuser = "select username from user where username = '$username'";
  $state = mysqli_query($connection,$sqlcekuser);
  if(mysqli_num_rows($state)==1){
    echo("
    <script>
    alert('username telah terdaftar');
    </script>
    ");
    return false;
  }
  if($password !== $password2){
    echo("
    <script>
    alert('konfirmasi password salah');
    </script>
    ");
    return false;
  }
  $password = password_hash($password,PASSWORD_DEFAULT);
  $sqlregis = "insert into user values(null,'$username','$password')";
  mysqli_query($connection,$sqlregis);
  return mysqli_affected_rows($connection);
}
function login($data){
  global $connection;
  $username = $data["username"];
  $password = $data["password"];
  $sqllogincek = "select * from user where username ='$username'";
  $state = mysqli_query($connection, $sqllogincek);
  if (mysqli_num_rows($state)==1) {
    $row = mysqli_fetch_assoc($state);
      if(password_verify($password,$row["password"])){    
        if(isset($data["remember"])){
          $cook = hash('sha256',$username);
          setcookie('keyto',$row["id"],time()+120);
          setcookie('keytoo',$cook,time()+120);
        }    
        return true;
      }
  }else{
    return false;
  }

}

?>