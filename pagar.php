<?php

$opcion = $_POST['submit'];
switch ($opcion){

    case "Volver":
        header("Location: login.php");
        break;}

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pagar</title>
</head>
<body style='background: -webkit-linear-gradient(right, #23272a, #bd4227);'>
    <h1>Pasarela de pago en construcción, por favor vuelve a logearte.</h1>
    <input type="submit" name="submit" value="Volver" onclick="location.href='login.php';" style=' background-color: #ff5733; border: none; color: white; padding: 16px 32px; text-decoration: none; margin: 4px 2px; cursor: pointer; '>

</body>
</html>
