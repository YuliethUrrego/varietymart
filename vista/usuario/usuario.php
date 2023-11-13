<?php

//revisamos que hay una variable de sesion, sino la iniciamos
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Ingresa al sistema cuandoe exista variable de sesion activa y el usuario es el administrador
if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok" && $_SESSION["rolUsuario"] == 0){

    //para que no se muestre posibles advertencias o errores (eliminar para hacer pruebas)
    error_reporting(0);


    $rutaFooter = "../layout/footer2.php";
    $rutaHeader = "../layout/header2.php";

    require_once '../../modelo/ModeloUsuarios.php';
    require_once '../../controlador/ControlUsuarios.php';
    require_once '../../controlador/ControlConexion.php';

    $codigo = $_SESSION["codigoUsuario"];

    // Se consultan los datos para visualizarlo al ingresar a todos los usuarios excepto a si mismo
    $objModeloUsuario = new ModeloUsuarios("", "", "", "", "", "", "", "", "", "");
    $objControlUsuario = new ControlUsuarios($objModeloUsuario);
    $datos = $objControlUsuario  -> consultarTodos();

    echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../../assents/css/estilo.css">
    <link rel="stylesheet" href="../../assents/css/footer.css">
    <link rel="stylesheet" href="../../assents/css/proveedor.css">
    <link rel="icon" href="../../assents/img/store.png">

    <title>Usuarios</title>
</head>
<body>';

    if (file_exists($rutaHeader)) {
        include $rutaHeader;
    }

    echo '<div class="container">

        <h1>Usuarios</h1>
        <br><br>

        <table>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Cédula</th>
                <th>Correo</th>
                <th>Ciudad</th>
                <th>Género</th>
                <th>Rol</th>
                <th>Estado</th>
            </tr>';
            while($row = $datos->fetch_assoc()){
        echo '<tr>
                <td>'.$row["nombre"].'</td>
                <td>'.$row["apellido"].'</td>
                <td>'.$row["cedula"].'</td>
                <td>'.$row["correo"].'</td>
                <td>'.$row["ciudad"].'</td>
                <td>'.$row["sexoDec"].'</td>';
                // El admin no se puede modificar a si mismo, solo le muestra su rol y estado
                if($codigo == $row["codigo"]){
                    echo '<td>'.$row["rolDec"].'</td>
                            <td>'.$row["estadoDec"].'</td>';
                }
                // Cuando es usuario es Editor y está activo
                else if($row["rol"] == 1  && $row["estado"] == 0){
                    echo '<td> <a href="cambiarRolEstado.php?rol='.$row["rol"].'&codigo='.$row["codigo"].'" class="editor-button">'.$row["rolDec"].'</a></td>
                            <td> <a href="cambiarRolEstado.php?estado='.$row["estado"].'&codigo='.$row["codigo"].'" class="activo-button">'.$row["estadoDec"].'</a></td>';
                }
                //Cuando el Usuario es de Consulta y está activo
                else if($row["rol"] == 2 && $row["estado"] == 0){
                    echo '<td> <a href="cambiarRolEstado.php?rol='.$row["rol"].'&codigo='.$row["codigo"].'" class="consulta-button">'.$row["rolDec"].'</a></td>
                    <td> <a href="cambiarRolEstado.php?estado='.$row["estado"].'&codigo='.$row["codigo"].'" class="activo-button">'.$row["estadoDec"].'</a></td>';
                }
                //Cuando el Usuario es Editor y está Inactivo
                else if($row["rol"] == 1 && $row["estado"] == 1){
                    echo '<td> <a href="cambiarRolEstado.php?rol='.$row["rol"].'&codigo='.$row["codigo"].'" class="editor-button">'.$row["rolDec"].'</a></td>
                    <td> <a href="cambiarRolEstado.php?estado='.$row["estado"].'&codigo='.$row["codigo"].'" class="inactivo-button">'.$row["estadoDec"].'</a></td>';
                }
                //Cuando el Usuario es de Consulta y está Inactivo
                else if($row["rol"] == 2 && $row["estado"] == 1){
                    echo '<td> <a href="cambiarRolEstado.php?rol='.$row["rol"].'&codigo='.$row["codigo"].'" class="consulta-button">'.$row["rolDec"].'</a></td>
                    <td> <a href="cambiarRolEstado.php?estado='.$row["estado"].'&codigo='.$row["codigo"].'" class="inactivo-button">'.$row["estadoDec"].'</a></td>';
                }

                echo '</td>
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

