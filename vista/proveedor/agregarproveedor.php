<?php

//revisamos que hay una variable de sesion, sino la iniciamos
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Ingresa al sistema cuandoe exista variable de sesion activa y el usuario sea admiinstrador o editor 
if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok" && ($_SESSION["rolUsuario"] == 0 || $_SESSION["rolUsuario"] == 1)){
    $rutaFooter = "../layout/footer2.php";
    $rutaHeader = "../layout/header2.php";

    
require_once '../../modelo/ModeloProveedores.php';
require_once '../../controlador/ControlProveedores.php';
require_once '../../controlador/ControlConexion.php';


//Agregar provedor
if(isset($_POST["btnAgregar"]) && isset($_POST["txtNombre"]) && isset($_POST["txtIdentificacion"])){

    // Consultamos si ya existe proveedor con ese mismo NIT o cédula
    $identificacion = $_POST["txtIdentificacion"];
    $objModeloProveedores = new ModeloProveedores("", $identificacion, "", "", "", "", "");
    $objControlProveedores = new ControlProveedores($objModeloProveedores);
    $proYaRegistrado = $objControlProveedores  -> consultarPorIdentificacion();

//Valida si el proveedor con el mismo nit existe 
if($proYaRegistrado != null && $proYaRegistrado["identificacion"] == $identificacion ){

    echo'<script>
    window.alert("Error. Ya existe un proveedor con el numero de identificación ingresado");    
    </script>';
}else{

    $nombre =  $_POST["txtNombre"];
    $ciudad = $_POST["txtCiudad"];
    $direccion = $_POST["txtDireccion"];
    $telefono = $_POST["txtTelefono"];
    $email = $_POST["txtEmail"];

    $objModeloProveedores = new ModeloProveedores("", $identificacion, $nombre, $ciudad, $direccion, $telefono, $email);
    $objControlProveedores = new ControlProveedores($objModeloProveedores);
    $objControlProveedores  -> crear();
}

    

}



echo '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assents/css/estilo.css">
    <link rel="stylesheet" href="../../assents/css/footer.css">
    <link rel="icon" href="../../assents/img/store.png">
    <link rel="stylesheet" href="../../assents/css/forms.css">
    <title>Editar Proveedor</title>
</head>

<body>';

if (file_exists($rutaHeader)) {
    include $rutaHeader;
}

    echo '<form action="" method="POST">

        <h2 class="form__title">Agregar Proveedor</h2>

        <div class="container">

            <div>
                <input type="text" id="nombre" name="txtNombre" class="form__input" placeholder="Nombre/Razón Social" required>
            </div>

            <div>
                <input type="number" id="identificacion" name="txtIdentificacion" class="form__input" placeholder="Cédula/NIT" required>
            </div>

            <div >
                <input type="text" id="ciudad" name="txtCiudad" class="form__input" placeholder="Ciudad" >
            </div>

            <div>
                <input type="text" id="direccion" name="txtDireccion" class="form__input" placeholder="Direccion" >
            </div>

            <div>
                <input type="text" id="telefono" name="txtTelefono" class="form__input" placeholder="Telefono">
            </div>

            <div>
                <input type="email" id="email" name="txtEmail" class="form__input" placeholder="Correo Electrónico">
            </div>

            <input type="submit" class="boton" name="btnAgregar" value="Agregar">

            <a href="proveedor.php" <input type="submit" class="form__volver" name="" value="Volver">Volver</a>
        </div>  

    </form>';
    if (file_exists($rutaFooter)) {
        include $rutaFooter;
 }

echo '</body>
</html>';

}else{
        //Si no existe sesion activa se va a la pagina principal
        echo '<script>
        window.location = "../../index.php";
        </script>';
}
?>