<?php

require_once '../../modelo/ModeloUsuarios.php';
require_once '../../controlador/ControlUsuarios.php';
require_once '../../controlador/ControlConexion.php';

if(isset($_POST["btnIngresar"]) && isset($_POST["txtCorreo"]) && isset($_POST["txtContrasena"])){

    $correo = $_POST["txtCorreo"];
    $contrasena = $_POST["txtContrasena"];

    $objModeloUsuario = new ModeloUsuarios("", "", "", "", $correo, $contrasena, "", "");
    $objControlUsuario = new ControlUsuarios($objModeloUsuario);
    $objControlUsuario  -> IngresoUsuarios();

}


echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assents/css/login_registro.css">
    <link rel="icon" href="../../assents/img/store.png">
    <title>Inicio Sesion</title>
</head>
<body>
    
  <form class="form" action="" method="POST">
    <h2 class="form__title">Inicia Sesión</h2>
    <p class="form-paragraph">¿Aún no tienes una cuenta? <a href="registro.php" class="form__link">Entra aquí</a></p>
    
    <div class="form__container">
        

        <div class="form__group">
            <input type="email" id="user" name="txtCorreo" class="form__input" placeholder="Correo electrónico: " required>
            
            <span class="form__line"></span>
        </div>
    
        <div class="form__group">
            <input type="password" id="Password" name="txtContrasena" class="form__input" placeholder="Contraseña: " required>
            
            <span class="form__line"></span>
        </div>
       
        <!-- Enlace para ir al principal-->
        <input type="submit" class="form__submit" name="btnIngresar" value="Ingresar">
        <a href="../../index.php" <input type="submit" class="form__volver" name="" value="Volver">Volver</a>


    </div>  

</form>
    
</body>
</html>';

?>