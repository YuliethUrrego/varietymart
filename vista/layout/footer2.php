<?php

//revisamos que hay una variable de sesion, sino la iniciamos
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Ingresa al sistema cuandoe exista variable de sesion activa
if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){

    echo '
<footer class="footer2">
    <div class="footer-content">
        <div class="footer-section links">
            <h1>Enlaces rápidos</h1>
            <ul>
                <li><a href="../producto/producto.php">Productos</a></li>';
                if($_SESSION["rolUsuario"] == 0){
                    echo '<li><a href="../proveedor/proveedor.php">Proveedores</a></li>';
                }
                echo '<li><a href="../usuario/perfil.php">Perfil</a></li>
                <li> <a href="../../index.php">Cerrar Sesión</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        &copy; <?php echo date("Y"); ?> Supermercado variety Mart
    </div>
</footer>';


}else{
    //Si no existe sesion activa se va a la pagina principal
    echo '<script>
    window.location = "../../index.php";
    </script>';
}

?>




