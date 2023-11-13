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

    require_once '../../modelo/ModeloProveedores.php';
    require_once '../../controlador/ControlProveedores.php';

    require_once '../../controlador/ControlConexion.php';

    // Se consultan todos los proveedores para mostrarlos en el formulario
    $objModeloProveedores = new ModeloProveedores("", "", "", "", "", "", "");
    $objControlProveedores = new ControlProveedores($objModeloProveedores);
    $datos = $objControlProveedores  -> consultarTodos();


    //Agregar Producto
    if(isset($_POST["btnAgregar"]) && isset($_POST["txtNombre"]) && isset($_POST["txtValor"]) && isset($_POST["txtCantidad"]) && isset($_POST["txtProveedor"])){
        $nombre =  $_POST["txtNombre"];
        $valor =  $_POST["txtValor"];
        $cantidad = $_POST["txtCantidad"];
        $observaciones = $_POST["txtObservaciones"];
        $imagen = addslashes(file_get_contents($_FILES['txtImagen']['tmp_name']));
        $proveedor = $_POST["txtProveedor"];
    
        $objModeloProductos = new ModeloProductos("", $nombre, $valor, $cantidad, $observaciones, $imagen, $proveedor);
        $objControlProductos = new ControlProductos($objModeloProductos);
        $objControlProductos  -> crear();
    
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

echo '<?php include "../layout/header2.php" ?>

    <form action="" method="POST" enctype="multipart/form-data">

        <h2 class="form__title">Agregar Producto</h2>

        <div class="container">

            <div>
                <input type="text" id="nombre" name="txtNombre" class="form__input" placeholder="Nombre" required>
            </div>

            <div>
                <input type="number" id="valor" name="txtValor" class="form__input" placeholder="Valor" required>
            </div>

            <div >
                <input type="number" id="cantidad" name="txtCantidad" class="form__input" placeholder="Cantidad" required>
            </div>

            <div>
                <input type="text" id="observaciones" name="txtObservaciones" class="form__input" placeholder="Observaciones" >
            </div>

            <div>
                <input type="file" id="imagen" name="txtImagen" class="form__input" placeholder="Imagen" accepts="image/jpg" required>
            </div>

            <div>
                <select id="proveedor" name="txtProveedor" class="form__input" required>
                <option value="">Seleccionar Proveedor</option>';
                while($row = $datos->fetch_assoc()){
                   echo '<option value="'.$row["codigo"].'">'.$row["nombre"].'</option>';
                }

            echo '</select>
            </div>

            <input type="submit" class="boton" name="btnAgregar" value="Agregar">

            <a href="producto.php" <input type="submit" class="form__volver" name="" value="Volver">Volver</a>
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