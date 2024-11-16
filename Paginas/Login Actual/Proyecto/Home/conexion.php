<?php
    $servidor = "localhost";
    $usuario = "root";
    $contrasena = "";
    $base_de_datos = "beatbox";

    $conexion = mysqli_connect($servidor, $usuario, $contrasena, $base_de_datos);

    if (!$conexion) {
        die("Conexión fallida: " . mysqli_connect_error());
    }
?>