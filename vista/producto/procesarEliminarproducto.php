<?php

//revisamos que hay una variable de sesion, sino la iniciamos
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Ingresa al sistema cuandoe exista variable de sesion activa y el usuario sea administrador editor
if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok" && ($_SESSION["rolUsuario"] == 0 || $_SESSION["rolUsuario"] == 1)){
     
    require_once '../../modelo/ModeloProductos.php';
    require_once '../../controlador/ControlProductos.php';
    require_once '../../controlador/ControlConexion.php';

    $codigo = $_GET["codigo"];

    $objModeloProductos = new ModeloProductos($codigo, "", "", "", "", "", "");
    $objControlProductos = new ControlProductos($objModeloProductos);
    $objControlProductos  -> borrar();

    header("Location: producto.php");

}

?>