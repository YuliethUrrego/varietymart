<?php

$rutaFooter = "vista/layout/footer.php";
$rutaHeader = "vista/layout/header.php";


require_once 'modelo/ModeloProductos.php';
require_once 'controlador/ControlProductos.php';
require_once 'controlador/ControlConexion.php';

// Se consultan todos los productos para mostrarlos en una tabla
$objModeloProductos = new ModeloProductos("", "", "", "", "", "", "");
$objControlProductos = new ControlProductos($objModeloProductos);
$datos = $objControlProductos  -> consultarTodos();

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assents/css/estilo.css">
    <link rel="stylesheet" href="assents/css/footer.css">
    <link rel="icon" href="assents/img/store.png">
    
    <title>Variety Mart</title>
</head>
<body>';
    
if (file_exists($rutaHeader)) {
    include $rutaHeader;
}
    
    echo '<div class="contenido-principal">
        <div class="banner">
            <img class="img-banner" src="assents/img/banner.jpeg" alt="">
        </div>
        <h2 class="subtitulo">Nuestros productos</h2>
        <div class="contenedor-imagenes">';
        while($row = $datos->fetch_assoc()){
            echo'<img class="imagen" src="data:image/jpg;base64, '.base64_encode($row["imagen"]).'" alt="">';
        }

            
            
        echo'</div>
    </div>';    
    
    if (file_exists($rutaFooter)) {
        include $rutaFooter;
    }
    
echo '</body>

</html>'


?> 