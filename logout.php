<?php
session_start();
session_unset();
session_destroy();
setcookie('keytoo','',time()-3600);
setcookie('keyto','',time()-3600);
header("location: login.php");
?>