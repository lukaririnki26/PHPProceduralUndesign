<?php
session_start();
if (!isset($_SESSION["login"])){
    header("location: login.php");
}
if (!isset($_GET["m"])){
    $_GET["m"]=1;
}
require_once("fun.php");
require_once("limit.php");
$columnmasyarakat = ["no.","gambar","nama","email","alamat","aksi"];
$sqlgetmasyarakat = "select * from masyarakat limit $limitawal,$datatampil";
$getmasyarakatrows = getMasyarakatRows($sqlgetmasyarakat);
$no = 1;
if (isset($_POST["cari"])){

    $cari = $_POST["txcari"];
    $sqlcarimasyarakat = "select * from masyarakat where nama like '%$cari%'";
    $getmasyarakatrows = getMasyarakatRows($sqlcarimasyarakat);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data</title>
    <style>
    .loader{
        width: 30px;
        position: absolute;
        top : 140px;
        left :320px;
        z-index : -1;
        display : none;
    }
    </style>
</head>
<body>
    <a href="logout.php">Logout</a>
    <h1>Data masyarakat</h1>
    <h3 ><a href="insert.php">Tambah data</a></h3>
    <form action="" method="post">
        <input type="text" name="txcari" placeholder="masukkan nama yang ingin anda cari....." size="40" id="txcari" autocomplete="off">
        <button type="submit" name="cari" id="cari">cari</button>
        <td><img src="img/lolisister1.gif" class="loader"></td>
    </form>
    
    <?php if($_GET["m"]>1) :?>
    <a href="?m=<?=$_GET["m"]-1?>">&laquo;</a>
    <?endif;?>

    <?php for($i=1; $i<=$jumlahhalaman; $i++) :?>
    <?php if($i==$halamanaktif):?>
    <a href="?m=<?=$i?>" style="color : red;"><?=$i?></a>
    <?php else :?>
        <a href="?m=<?=$i?>" ><?=$i?></a>
    <?php endif;?>
    <?php endfor;?>

    <?php if($_GET["m"]<$jumlahhalaman) :?>
    <a href="?m=<?=$_GET["m"]+1?>">&raquo;</a>
    <?endif;?>
    <div id="content">
    <table border="1" cellspacing="4">
        <tr>
        <?php foreach($columnmasyarakat as $column):?>
            <th><?=$column?></th>
        <?php endforeach;?>
        </tr>
        <?php foreach($getmasyarakatrows as $row):?>
            <tr>  
            <td><?=$no?></td>
            <td><img src="img/<?=$row["gambar"]?>" width="70" height="80"></td>
            <td><?=$row["nama"]?></td>
            <td><?=$row["email"]?></td>
            <td><?=$row["alamat"]?></td>
            <td>
                <a href="update.php?id=<?=$row["id"]?>">Ubah</a> |
             <a href="delete.php?id=<?=$row["id"]?>" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</a></td>
           </tr>
           <?php $no++;?>
        <?php endforeach;?>  
    </table>
    </div>
</body>
<script src="js/jquery.min.js"></script>
<script src="js/sc.js"></script>
</html>