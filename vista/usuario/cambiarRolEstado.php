<?php

//revisamos que hay una variable de sesion, sino la iniciamos
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Ingresa al sistema cuandoe exista variable de sesion activa y el usuario sea Administrador 
if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok" && ($_SESSION["rolUsuario"] == 0)){
     
    require_once '../../modelo/ModeloUsuarios.php';
    require_once '../../controlador/ControlUsuarios.php';
    require_once '../../controlador/ControlConexion.php';

    $codigo = $_GET["codigo"];

    if(isset($_GET["rol"])){
        echo $_GET["rol"] . " " ;
        echo $_GET["codigo"]. " ";
        
        // Si el rol es editor pasa a Consulta
        if($_GET["rol"] == 1){
            $rol = 2;
        }
        // Si el rol es consulta pasa a Editor
        else if($_GET["rol"] == 2){
            $rol = 1;
        }

        $objModeloUsuario = new ModeloUsuarios($codigo, "", "", "", "", "", "", "", $rol, "");
        $objControlUsuario = new ControlUsuarios($objModeloUsuario);
        $objControlUsuario  -> editarRol();

    }else if(isset($_GET["estado"])){
        echo $_GET["estado"] . " " ;
        echo $_GET["codigo"]. " ";

        // Si el estado es activo pasa a inactivo
        if($_GET["estado"] == 0){
            $estado = 1;
        }
        // Si el estado es inactivo pasa a activo
        else if($_GET["estado"] == 1){
            $estado = 0;
        }

        $objModeloUsuario = new ModeloUsuarios($codigo, "", "", "", "", "", "", "", "", $estado);
        $objControlUsuario = new ControlUsuarios($objModeloUsuario);
        $objControlUsuario  -> editarEstado();
    }

    header("Location: usuario.php");

}

?>