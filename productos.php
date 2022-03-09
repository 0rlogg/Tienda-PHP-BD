<?php
session_start();

/*CLASES QUE VAMOS A NECESITAR*/
spl_autoload_register(function ($clase){
    require ("clases/BD.php");
    require ("clases/Cesta.php");
    require ("clases/Producto.php");

});

/*REDIRECCION*/






$conexion = new BD();
$lista_productos = $conexion->lista_productos();
$opcion = $_POST['submit'];
$precio_total = $_POST['precio_total'];
$cesta = Cesta::obtener_cesta();

switch ($opcion){
    case "Añadir":
        $cod = $_POST['codigo'];
        $cesta->add_producto($cod);

        break;
    case "Eliminar":
        $cod = $_POST['codigo'];
        $cesta->delete_producto($cod);
        break;
    case "Pagar":
        $conexion->cerrar();
        session_destroy();
        header("Location:pagar.php");
        break;
    case "Vaciar Cesta":
        $cesta = $cesta->vaciar_cesta();
        break;
}
$cesta->guardar_cesta();
$listado_cesta = $cesta->getCesta();

?>

<!doctype html>
<html lang="es">
<head style=' background-color: #23272a; color: #ff5733'>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="estilos/estilos.css">
    <title>Tienda</title>
</head>
<body style=' background-color: #23272a; color: #ff5733'>
    <div class="left">
    <h1 style="text-align: center">PRODUCTOS</h1>

    <?php
        foreach ($lista_productos as $producto){
            $codigo = $producto['cod'];
            $producto = new Producto($producto);
            $nombre_corto = $producto->getNombre_corto();
            $PVP = $producto->getPVP();

            echo"
                <div id='contenedor' style='   background: -webkit-linear-gradient(right, #bd4227, #23272a); border: solid #ff5733 '>
                
                    <form action='productos.php' method='post'>
                    <br>
                            &nbsp<label style='color: white'><b>$nombre_corto</b></label>
                            <label style='color: white'>$PVP €</label>
                            <br>
                            <br>
                            &nbsp<input type='submit' value='Añadir' name='submit'  style=' background-color: #ff5733; border: none; color: white; padding: 16px 32px; text-decoration: none; margin: 4px 2px; cursor: pointer; '>
                        <input type='hidden' name='codigo' value='$codigo'>
                    </form><br>
               </div>
               <br>";}
    ?>
    </div>

    <div class="rigth" style=' background-color: #23272a; color: white;'>
        <h1 style="text-align: center; color: #FF5733">CESTA</h1>
        <?php
        $precio_total = 0;

        if ($cesta->cesta_vacia()){
            echo "<h4 style='text-align: center; color: #FF5733'>Actualmente no hay productos</h4>";
        }else{
            foreach ($listado_cesta as $cod_producto => $unidades){
                $producto_cesta = $conexion->obtiene_producto($cod_producto);
                $PVP = $producto_cesta->getPVP();
                $precio_linea = $PVP*$unidades;

                $precio_total = $precio_total + $precio_linea;
                $precio_total = guardar_precio_total($precio_total);

                echo "<form action='productos.php' method='post'>
                        <label>$unidades&nbsp&nbsp&nbsp</label>
                        <label>$cod_producto&nbsp&nbsp&nbsp</label>
                        <label>$PVP €</label>
                        <div class='rigth'>
                            <input type='submit' value='Eliminar' name='submit' style=' background-color: #ff5733; border: none; color: white; padding: 10px 22px; text-decoration: none; margin: 4px 2px; cursor: pointer; '>
                        </div><br><br>
                        
                        <input type='hidden' name='codigo' value='$cod_producto'>
                    </form>";
            }

            echo "<form action='productos.php' method='post'>
                    <div class='left'>
                        <label>Total : $precio_total € </label>
                    </div>
                    <br>
                    <div>
                        <input type='submit' value='Pagar' name='submit' style=' background-color: green; border: none; color: white; padding: 10px 22px; text-decoration: none; margin: 4px 2px; cursor: pointer; '>
                        <input type='submit' value='Vaciar Cesta' name='submit' style=' background-color: red; border: none; color: white; padding: 10px 22px; text-decoration: none; margin: 4px 2px; cursor: pointer; ' >                      
                    </div>
                   </form>
                   </div>";
        }


        function guardar_precio_total($precio_total){
            return $precio_total;
        }

        ?>
    </div>
</body>
</html>
