<?php

//revisamos que hay una variable de sesion, sino la iniciamos
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Ingresa al sistema cuandoe exista variable de sesion activa
if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok" && $_SESSION["rolUsuario"] == 0){
     
    require_once '../../modelo/ModeloProveedores.php';
    require_once '../../controlador/ControlProveedores.php';
    require_once '../../controlador/ControlConexion.php';

    $codigo = $_GET["codigo"];

    $objModeloProveedores = new ModeloProveedores($codigo, "", "", "", "", "", "");
    $objControlProveedores = new ControlProveedores($objModeloProveedores);
    $objControlProveedores  -> borrar();

    header("Location: proveedor.php");

}

?>