<?php
session_start();
if (isset($_SESSION["login"])){
    header("location: index.php");
}
require_once("fun.php");
if (isset($_POST["register"])) {
    if (register($_POST) > 0) {
        echo("
        <script>
        alert('berhasil registrasi');
        </script>
        ");
    }else{
        echo("
        <script>
        alert('gagal registrasi');
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
    <title>form registrasi</title>
</head>
<body>
    <h1>Registrasi</h1>
    <form action="" method="post">
        <ul>
            <li>
                <label for="username">username :</label>
                <input type="text" name="username" id="username" required>
            </li>
            <li>
                <label for="password">password :</label>
                <input type="password" name="password" id="password" required>
            </li>
            <li>
                <label for="password2">konfirmasi password:</label>
                <input type="password" name="password2" id="password2" required>
            </li>
            <li>
                <button type="submit" name="register">Register</button>
            </li>
        </ul>
    </form>
    
</body>
</html>