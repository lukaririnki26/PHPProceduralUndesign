<?php
require_once("fun.php");
session_start();
    # code...
    if (isset($_COOKIE["keyto"])&&isset($_COOKIE["keytoo"])) {
        $id = $_COOKIE["keyto"];
        $username = $_COOKIE["keytoo"];
        $sqlcek = "select * from user where id ='$id'";
        $state = mysqli_query($connection, $sqlcek);
        $row = mysqli_fetch_assoc($state);
        $username2 = hash("sha256",$row["username"]);
        if ($username === $username2) {
            $_SESSION["login"]=true; 
        }
    }

if (isset($_SESSION["login"])){
    header("location: index.php");
}
if (isset($_POST["login"])) {
    
    if (login($_POST) > 0) {
       
        header("Location: index.php");
        $_SESSION["login"]=true;
    }else{
        $error =true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($error)):?>
        <p style="color:red; font-style:italic;">gagal login</p>
    <?php endif;?>
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
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">remember me</label>
            </li>
            <li>
                <button type="submit" name="login">Login</button>
            </li>
        </ul>
    </form>
    
</body>
</html>