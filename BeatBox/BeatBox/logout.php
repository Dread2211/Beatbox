<?php
    session_start();
    // Destruir todas las variables de sesión
    $_SESSION = array();
    // Destruir la sesión
    session_destroy();
    // Redirigir al usuario a la página de inicio u otra página
    header("Location: home.php");
    exit;
?>
