<?php


require_once '../../modelo/ModeloUsuarios.php';
require_once '../../controlador/ControlUsuarios.php';
require_once '../../controlador/ControlConexion.php';

if(isset($_POST["btnRegistrarse"]) && isset($_POST["txtNombre"]) && isset($_POST["txtApellido"]) && isset($_POST["txtCedula"]) && isset($_POST["txtCorreo"]) && isset($_POST["txtContrasena"])){
    $nombre =  $_POST["txtNombre"];
    $apellido =  $_POST["txtApellido"];
    $cedula =  $_POST["txtCedula"];
    $correo = $_POST["txtCorreo"];
    $contrasena = $_POST["txtContrasena"];

    $objModeloUsuario = new ModeloUsuarios("", $nombre, $apellido, $cedula, $correo, $contrasena, "", "");
    $objControlUsuario = new ControlUsuarios($objModeloUsuario);
    $objControlUsuario  -> registrar();

}


echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assents/css/login_registro.css"">
    <link rel="icon" href="../../assents/img/store.png">
    <title>Registro</title>
</head> 
<body>
    <form class="form" action="" method="POST">
        <h2 class="form__title">Crear cuenta</h2>
        <p class="form-paragraph">¿Ya tienes cuenta? <a href="login.php" class="form__link">Entra aqui</a></p>
        
        <div class="form__container">
            
            <div class="form__group">
                <input type="text" id="name" name="txtNombre" class="form__input" placeholder="Nombre:" required>
                <span class="form__line"></span>
            </div>

            <div class="form__group">
                <input type="text" id="name"  name="txtApellido" class="form__input" placeholder="Apellidos:" required>
                <span class="form__line"></span>
            </div>

            <div class="form__group">
                <input type="number" id="cedula" name="txtCedula" class="form__input" placeholder="Cedula:" required>
                <span class="form__line"></span>
            </div>

            <div class="form__group">
                <input type="email" id="user" name="txtCorreo" class="form__input" placeholder="Correo electrónico:" required>
                <span class="form__line"></span>
            </div>
        
            <div class="form__group">
                <input type="password" id="Password" name="txtContrasena" class="form__input" placeholder="Contraseña:" required>
                <span class="form__line"></span>
            </div>

            <input type="submit" class="form__submit" name="btnRegistrarse" value="Registrarse">
            <a href="../../index.php" <input type="submit" class="form__volver" name="" value="Volver">Volver</a>

        </div>
    
</body>
</html>'

?>