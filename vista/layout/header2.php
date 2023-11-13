<?php

//revisamos que hay una variable de sesion, sino la iniciamos
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Ingresa al sistema cuandoe exista variable de sesion activa
if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){


echo '<header>
    <h1><img src="../../assents/img/logoNombre-removebg.png" alt=""></h1>
    <input type="checkbox" id="check">
    <label for="check" class="mostrar-menu">
        &#8801
    </label>
    <nav class="menu">
        <ul>
            <li> <a href="../producto/producto.php">Productos</a></li>';
            // Si el usuario es administradior (0) puede gestionar proveedores y usuarios
            if($_SESSION["rolUsuario"] == 0){
                echo '<li> <a href="../proveedor/proveedor.php">Proveedores</a></li>
                <li> <a href="../usuario/usuario.php">Usuarios</a></li>';
            }
            // Si el usuario es Editor(1)  puede gestionar proveedores
            else if($_SESSION["rolUsuario"] == 1){
                echo '<li> <a href="../proveedor/proveedor.php">Proveedores</a></li>';
            }         
        echo '
            <li> <a href="../usuario/perfil.php">Perfil</a></li>
            <li> <a href="../usuario/salir.php">Cerrar Sesión</a></li>
            <label for="check" class="esconder-menu">
                &#215
            </label>
        </ul>
    </nav>
</header>';


}else{
    //Si no existe sesion activa se va a la pagina principal
    echo '<script>
    window.location = "../../index.php";
    </script>';
}

?>