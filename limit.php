<?php
$datatampil =2;
$jumlahdata =count(getMasyarakatRows("select * from masyarakat"));
$jumlahhalaman = ceil($jumlahdata/$datatampil);
$halamanaktif = (isset($_GET["m"])) ? $_GET["m"] : 1;
$limitawal =($datatampil * $halamanaktif) - $datatampil;
?>