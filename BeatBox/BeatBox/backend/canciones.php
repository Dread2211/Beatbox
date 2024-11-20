<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include('../backend/conexion.php');

    $sql = "SELECT c.id, c.state, c.format, c.duration, c.title, c.fav, c.approved, u.nombre as artist, c.lyric, c.img, c.src 
            FROM contenido c
            LEFT JOIN usuarios u ON c.artist = u.id";

    $result = $conexion->query($sql);

    // Establecer el encabezado de la respuesta a JSON
    header('Content-Type: application/json');

    // Verificar si hubo un error en la consulta
    if (!$result) {
        echo json_encode(array('error' => "Error en la consulta: " . $conexion->error));
        exit; // Termina la ejecución si hay un error
    }

    if ($result->num_rows > 0) {
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode(array('allSongs' => $data), JSON_UNESCAPED_SLASHES);
    } else {
        echo json_encode(array('allSongs' => array()));
    }

    $conexion->close();
?>