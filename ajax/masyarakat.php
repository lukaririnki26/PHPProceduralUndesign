<?php
sleep(1);
require_once("../fun.php");
$cari = $_GET["cari"];
$columnmasyarakat = ["no.","gambar","nama","email","alamat","aksi"];
$sqlcarimasyarakat = "select * from masyarakat where nama like '%$cari%'";
$getmasyarakatrows = getMasyarakatRows($sqlcarimasyarakat);
$no =1;
?>
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