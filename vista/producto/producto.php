<?php

//revisamos que hay una variable de sesion, sino la iniciamos
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Ingresa al sistema cuandoe exista variable de sesion activa
if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){

$rutaFooter = "../layout/footer2.php";
$rutaHeader = "../layout/header2.php";

require_once '../../modelo/ModeloProductos.php';
require_once '../../controlador/ControlProductos.php';
require_once '../../controlador/ControlConexion.php';

// Se consultan todos los productos para mostrarlos en una tabla
$objModeloProductos = new ModeloProductos("", "", "", "", "", "", "");
$objControlProductos = new ControlProductos($objModeloProductos);
$datos = $objControlProductos  -> consultarTodos();



echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assents/css/estilo.css">
    <link rel="stylesheet" href="../../assents/css/footer.css">
    <link rel="icon" href="../../assents/img/store.png">
    
    <title>Variety Mart</title>
</head>
<body>';

if (file_exists($rutaHeader)) {
    include $rutaHeader;
}
    
    echo '<div class="contenido-principal">

        <h1 class="subtitulo">Productos</h1>

        <div class="agregar">
            <a href="../producto/agregarproducto.php" class="edit-add">Agregar Producto</a>
        </div>

        <div class="contenedor-imagenes">';

        while($row = $datos->fetch_assoc()){

           echo ' <div class="contenedor">
                    <img class="imagen" src="data:image/jpg;base64, '.base64_encode($row["imagen"]).'" alt="">
                    <div class="acciones">
                        <a href="editarproducto.php?codigo='.$row["codigo"].'" class="edit-button">Editar</a>
                        <a href="procesarEliminarproducto.php?codigo='.$row["codigo"].'" class="edit-delete"">Eliminar</a>
                    </div>
                    <div class="informacion-imagenes">
                        <p> Nombre: '.$row["nombre"].'</p>
                        <p> Valor: $ '.$row["valor"].'</p>
                        <p> Cantidad: '.$row["cantidad"].' </p>
                        <p> Proveedor: '.$row["nombreProveedor"].' </p>
                    </div>
                </div> ';
        }

              
            
   echo '</div>';

if (file_exists($rutaFooter)) {
    include $rutaFooter;
}

echo '
<script src="../../assents/js/confirmacion.js"></script>

</body>

</html>';

}else{

        //Si no existe sesion activa se va a la pagina principal
        echo '<script>
        window.location = "../../index.php";
        </script>';
        
}

?>