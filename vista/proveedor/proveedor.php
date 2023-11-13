<?php

//revisamos que hay una variable de sesion, sino la iniciamos
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Ingresa al sistema cuandoe exista variable de sesion activa
if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){

    $rutaFooter = "../layout/footer2.php";
    $rutaHeader = "../layout/header2.php";

    require_once '../../modelo/ModeloProveedores.php';
    require_once '../../controlador/ControlProveedores.php';
    require_once '../../controlador/ControlConexion.php';


    // Se consultan todos los proveedores para mostrarlos en una tabla
    $objModeloProveedores = new ModeloProveedores("", "", "", "", "", "", "");
    $objControlProveedores = new ControlProveedores($objModeloProveedores);
    $datos = $objControlProveedores  -> consultarTodos();
    


echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assents/css/estilo.css">
    <link rel="stylesheet" href="../../assents/css/footer.css">
    <link rel="stylesheet" href="../../assents/css/proveedor.css">
    <link rel="icon" href="../../assents/img/store.png">

    <title>Proveedores</title>
   
</head>
<body>';

if (file_exists($rutaHeader)) {
    include $rutaHeader;
}

echo '<?php include "../layout/header2.php" ?>

 <div class="container">

    <h1>Proveedores</h1>
   
    <div class="agregar">
        <a href="../proveedor/agregarproveedor.php" class="edit-add">Agregar Proveedor</a>
    </div>

    <table>
        <tr>
            <th>Nombre/Razón Social</th>
            <th>NIT/Cédula</th>
            <th>Ciudad</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>';

    while($row = $datos->fetch_assoc()){
        
        echo'<tr>
                <td>'.$row["nombre"].'</td>
                <td>'.$row["identificacion"].'</td>
                <td>'.$row["ciudad"].'</td>
                <td>'.$row["direccion"].'</td>
                <td>'.$row["telefono"].'</td>
                <td>'.$row["email"].'</td>
                <td class="acciones">
                    <a href="editarproveedor.php?codigo='.$row["codigo"].'" class="edit-button">Editar</a>
                     <a href="procesarEliminarproveedor.php?codigo='.$row["codigo"].'" class="edit-delete">Eliminar</a>
                </td>
            </tr>';
       }
   
        
    echo '</table>
    
</div>
<script src="../../assents/js/confirmacion.js"></script>';

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