<?php
session_start();
if (!isset($_SESSION["login"])){
    header("location: login.php");
}
require_once("fun.php");
$id = $_GET["id"];
$sqlmasyarakatupdate = "select * from masyarakat where id = $id ";
$rowsupdate = getMasyarakatRows($sqlmasyarakatupdate);
foreach($rowsupdate as $row){
    $nama = $row["nama"];
    $alamat = $row["alamat"];
    $email = $row["email"];
    $gambar = $row["gambar"];
}
                
if (isset($_POST["ubah"])) {
    if(updateMasyarakatRows($_POST) > 0){
        echo("
        <script> 
        alert('data berhasil diubah');
        document.location.href='index.php';
        </script>
        ");        
    }else{
        echo("
        <script> 
        alert('data gagal diubah');
        document.location.href='index.php';
        </script>
        ");  
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah data</title>
</head>
<body>
    <h1>Ubah data mayarakat</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?=$id?>" >
        <input type="hidden" name="gambarlama" value="<?=$gambar?>" >
        <ul>
            <li>
                <label for="nama">Nama :</label>
                <input type="text" name="nama" id="nama" value="<?=$nama?>" required>
            </li>
            <li>
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" value="<?=$email?>"  required>
            </li>
            <li>
                <label for="alamat">Alamat:</label>
                <input type="text" name="alamat" id="alamat" value="<?=$alamat?>"  required>
            </li>
            <li>
                <label for="gambar">Gambar:</label>
                <img src="img/<?=$gambar?>" width="50">
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="ubah" onclick= "return confirm('Anda yakin mau mengubah data?')">ubah</button>
            </li>
        </ul>
    </form>
</body>
</html>