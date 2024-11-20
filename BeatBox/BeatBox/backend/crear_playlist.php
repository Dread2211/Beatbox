<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
if (!isset($_SESSION["usuario_id"])) {
    // Redirigir si no hay sesión activa
    header("Location: home.php");
    exit();
}
include('../backend/conexion.php');

var_dump($_POST);



// Establecer el encabezado Content-Type para JSON
header('Content-Type: application/json');

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["titulo"]) && isset($_POST["usuario_id"])) {
    $titulo = $conexion->real_escape_string($_POST["titulo"]);
    $usuario_id = (int)$_POST["usuario_id"];

    // Consulta para insertar la nueva playlist
    $sql = "INSERT INTO playlist (nombre, fecha_creada, usuario_id) VALUES ('$titulo', CURDATE(), $usuario_id)";

    if ($conexion->query($sql) === TRUE) {
        // Obtener el ID de la playlist recién creada
        $playlist_id = $conexion->insert_id;

        // Responder con éxito y el ID de la nueva playlist
        echo json_encode([
            'success' => true,
            'playlist_id' => $playlist_id,
            'message' => 'Playlist creada con éxito'
        ]);
    } else {
        // Responder con error
        echo json_encode([
            'success' => false,
            'message' => 'Error al crear la playlist: ' . $conexion->error
        ]);
    }
} else {
    // Responder con error si no se recibieron los datos esperados
    echo json_encode([
        'success' => false,
        'message' => 'Datos incompletos'
    ]);
}

?>
