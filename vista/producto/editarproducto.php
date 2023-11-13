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

    $codigo = $_GET["codigo"];

    // Se consultan todos los proveedores para mostrarlos en el formulario
    $objModeloProveedores = new ModeloProveedores("", "", "", "", "", "", "");
    $objControlProveedores = new ControlProveedores($objModeloProveedores);
    $proveedores = $objControlProveedores  -> consultarTodos();

    // Se consulta el proveedor para agregar los datos al fomrulario de editar
    $objModeloProductos = new ModeloProductos($codigo, "", "", "", "", "", "");
    $objControlProductos = new ControlProductos($objModeloProductos);
    $datos = $objControlProductos  -> consultar();
    
    //Para editar con la imagen
    if(isset($_POST["btnEditar"]) && isset($_POST["txtNombre"]) && isset($_POST["txtValor"]) && isset($_POST["txtCantidad"]) && !empty($_FILES['txtImagen']['tmp_name']) && isset($_POST["txtProveedor"])){
        $nombre =  $_POST["txtNombre"];
        $valor =  $_POST["txtValor"];
        $cantidad = $_POST["txtCantidad"];
        $observaciones = $_POST["txtObservaciones"];
        $imagen = addslashes(file_get_contents($_FILES['txtImagen']['tmp_name']));
        $proveedor = $_POST["txtProveedor"];
        
        $objModeloProductos = new ModeloProductos($codigo, $nombre, $valor, $cantidad, $observaciones, $imagen, $proveedor);
        $objControlProductos = new ControlProductos($objModeloProductos);
        $objControlProductos  -> editar();
    
    }

    //Para editar sin la imagen
    if(isset($_POST["btnEditar"]) && isset($_POST["txtNombre"]) && isset($_POST["txtValor"]) && isset($_POST["txtCantidad"]) && isset($_POST["txtProveedor"])){
        $nombre =  $_POST["txtNombre"];
        $valor =  $_POST["txtValor"];
        $cantidad = $_POST["txtCantidad"];
        $observaciones = $_POST["txtObservaciones"];
        $proveedor = $_POST["txtProveedor"];
        
        $objModeloProductos = new ModeloProductos($codigo, $nombre, $valor, $cantidad, $observaciones, "", $proveedor);
        $objControlProductos = new ControlProductos($objModeloProductos);
        $objControlProductos  -> editarSinImagen();
    
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

    echo '<form action="" method="POST" enctype="multipart/form-data">

        <h2 class="form__title">Editar Producto</h2>

        <div class="container">

            <div>
                <input type="text" id="nombre" name="txtNombre" class="form__input" value="'.$datos["nombre"].'" placeholder="Nombre" required>
            </div>

            <div>
                <input type="number" id="valor" name="txtValor" class="form__input" value="'.$datos["valor"].'" placeholder="Valor" required>
            </div>

            <div >
                <input type="number" id="cantidad" name="txtCantidad" class="form__input" value="'.$datos["cantidad"].'" placeholder="Cantidad" required>
            </div>

            <div>
                <input type="text" id="observaciones" name="txtObservaciones" class="form__input" value="'.$datos["observaciones"].'" placeholder="Observaciones" >
            </div>

            <div>
                <img class="imagen" src="data:image/jpg;base64, '.base64_encode($datos["imagen"]).'" alt="">
                <input type="file" id="imagen" name="txtImagen" class="form__input" placeholder="Imagen">
            </div>

            <div>
                <select id="proveedor" name="txtProveedor" class="form__input" required>';
                while($row = $proveedores->fetch_assoc()){
                    if($row["codigo"] == $datos["FK_proveedor"]){
                        echo '<option selected value="'.$row["codigo"].'">'.$row["nombre"].'</option>';
                    }else{
                        echo '<option value="'.$row["codigo"].'">'.$row["nombre"].'</option>';
                    }
                   
                }

            echo '</select>
            </div>

            <input type="submit" class="boton" name="btnEditar" value="Editar">

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