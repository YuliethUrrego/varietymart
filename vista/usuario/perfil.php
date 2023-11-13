<?php

//revisamos que hay una variable de sesion, sino la iniciamos
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Ingresa al sistema cuandoe exista variable de sesion activa
if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){

    //para que no se muestre posibles advertencias o errores (eliminar para hacer pruebas)
    error_reporting(0);

$rutaFooter = "../layout/footer2.php";
$rutaHeader = "../layout/header2.php";
$codigo = $_SESSION["codigoUsuario"];

require_once '../../modelo/ModeloUsuarios.php';
require_once '../../controlador/ControlUsuarios.php';
require_once '../../controlador/ControlConexion.php';

// Se consultan los datos para visualizarlo al ingresar al perfil
$objModeloUsuario = new ModeloUsuarios($codigo, "", "", "", "", "", "", "", "");
$objControlUsuario = new ControlUsuarios($objModeloUsuario);
$datos = $objControlUsuario  -> consultar();

//Para editar
if(isset($_POST["btnEditar"]) && isset($_POST["txtNombre"]) && isset($_POST["txtApellido"]) 
&& isset($_POST["txtContrasena"]) && isset($_POST["txtCiudad"]) && isset($_POST["txtSexo"])){
    $nombre =  $_POST["txtNombre"];
    $apellido =  $_POST["txtApellido"];
    $contrasena =  $_POST["txtContrasena"];
    $ciudad = $_POST["txtCiudad"];
    $sexo = $_POST["txtSexo"];

    //Editamos
    $objModeloUsuario = new ModeloUsuarios($codigo, $nombre, $apellido, "", "", $contrasena, $ciudad, $sexo, "");
    $objControlUsuario = new ControlUsuarios($objModeloUsuario);
    $objControlUsuario  -> editar();

    //Consultamos nuevamente los datos para que se refresque
    $objModeloUsuario = new ModeloUsuarios($codigo, "", "", "", "", "", "", "", "");
    $objControlUsuario = new ControlUsuarios($objModeloUsuario);
    $datos = $objControlUsuario  -> consultar();

}

//Para eliminar
if(isset($_POST["btnEliminar"])){

    $objModeloUsuario = new ModeloUsuarios($codigo, "", "", "", "", "", "", "", "");
    $objControlUsuario = new ControlUsuarios($objModeloUsuario);
    $objControlUsuario  -> borrar(); 

    echo '<script>
            window.alert("El perfil se eliminó correctamente");
            window.location = "salir.php";
        </script>';
}

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assents/css/forms.css">
    <link rel="stylesheet" href="../../assents/css/estilo.css">
    <link rel="stylesheet" href="../../assents/css/footer.css">
    <link rel="icon" href="../../assents/img/store.png">
    
    <title>Perfil</title>

</head>

<body>';

if (file_exists($rutaHeader)) {
    include $rutaHeader;
}
    echo '<form action="" method="POST">

        <h2 class="form__title">Editar Perfil</h2>

        <div class="container">

            <div>
                <input type="text" id="nombre" name="txtNombre" class="form__input" placeholder="Nombre" value="'.$datos["nombre"].'" required>
            </div>

            <div>
                <input type="text" id="apellido" name="txtApellido" class="form__input" placeholder="Apellido" value="'.$datos["apellido"].'" required>
            </div>

            <div >
                <input type="password" id="contrasena" name="txtContrasena" class="form__input" placeholder="Contraseña" required>
            </div>

            <div>
                <input type="text" id="ciudad" name="txtCiudad" class="form__input" placeholder="Ciudad de Residencia" value="'.$datos["ciudad"].'" required>
            </div>';
            if($datos["sexo"] == "1"){
                echo'
            <div >
                <select id="sexo" name="txtSexo" class="form__input" required>
                    <option value="">Seleccionar Género</option>
                    <option selected value="1">Masculino</option>
                    <option value="2">Femenino</option>
                    <option value="3">Otro</option>
                </select>
            </div>';
            }else if(($datos["sexo"] == "2")){
                echo'
            <div >
                <select id="sexo" name="txtSexo" class="form__input" required>
                    <option value="">Seleccionar Género</option>
                    <option value="1">Masculino</option>
                    <option selected value="2">Femenino</option>
                    <option value="3">Otro</option>
                </select>
            </div>';
            }else if(($datos["sexo"] == "3")){
                echo'
            <div >
                <select id="sexo" name="txtSexo" class="form__input" required>
                    <option value="">Seleccionar Género</option>
                    <option value="1">Masculino</option>
                    <option value="2">Femenino</option>
                    <option selected value="3">Otro</option>
                </select>
            </div>';
            }else{
                echo'
                <div >
                    <select id="sexo" name="txtSexo" class="form__input" required>
                        <option value="">Seleccionar Género</option>
                        <option value="1">Masculino</option>
                        <option value="2">Femenino</option>
                        <option value="3">Otro</option>
                    </select>
                </div>';
            }
            
        echo '<input type="submit" class="boton" name="btnEditar" value="Editar">
    
        </div>  

    </form>

    <form class="form_eliminar" action="" method="POST">
    <input type="submit" class="boton_eliminar" name="btnEliminar" value="Eliminar Perfil">
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