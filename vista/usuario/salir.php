<?php

session_start();
//destruimos la sesion
session_destroy();

//redirige al la pagina de inicio
echo '
<script>
    window.location = "../../index.php";
</script>';
?>