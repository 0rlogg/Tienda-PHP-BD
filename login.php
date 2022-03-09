<?php

session_start();
spl_autoload_register(function ($clase){
    require ("clases/BD.php");
});

if (isset($_POST['submit'])) {

    $usuario = $_POST['user'];
    $password = $_POST['pass'];
    $bd = new BD();

    if ($bd->validar_login($usuario, $password)) {
        $_SESSION['user'] = $usuario;
        header("Location:productos.php");
        exit();}

    else {
        $error = "Debe de aportar datos correctos";}}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/login.css">
    <title>Document</title>
</head>
<body>
<div class="login-page">
    <div class="form">
        <form class="login-form" action="login.php" method="post">
            <input type="text" placeholder="username" name="user"/>
            <input type="password" placeholder="password" name="pass"/>
            <button type="submit" name="submit">login</button>
        </form>
    </div>
</div>
</body>
</html>
