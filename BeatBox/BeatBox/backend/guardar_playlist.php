<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include '../backend/conexion.php'; // Asegúrate de incluir tu archivo de conexión a la base de datos.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica que el usuario esté autenticado
    if (!isset($_SESSION['usuario_id'])) {
        http_response_code(403); // Prohibido
        echo json_encode(["error" => "Usuario no autenticado."]);
        exit;
    }


    header('Content-Type: application/json');

    // Recibe y valida los datos enviados
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $fecha_creada = date('Y-m-d'); // Fecha actual
    $usuario_id = $_SESSION['usuario_id'];
    $cantidad_canciones = isset($_POST['cantidad_canciones']) ? (int)$_POST['cantidad_canciones'] : 0;

    if (empty($nombre)) {
        http_response_code(400); // Solicitud incorrecta
        echo json_encode(["error" => "El nombre de la playlist es obligatorio."]);
        exit;
    }

    // Inserta los datos en la tabla de playlists
    $sql = "INSERT INTO playlist (fecha_creada, nombre, id_contenido, usuario_id)
            VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    if ($stmt) {
        $id_contenido = null; // En este caso, se deja nulo por defecto.
        $stmt->bind_param('ssii', $fecha_creada, $nombre, $id_contenido, $usuario_id);
        if ($stmt->execute()) {
            echo json_encode(["success" => true, "playlist_id" => $stmt->insert_id]);
        } else {
            http_response_code(500); // Error del servidor
            echo json_encode(["error" => "Error al guardar la playlist."]);
        }
        $stmt->close();
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Error al preparar la consulta."]);
    }

    $conexion->close();
} else {
    http_response_code(405); // Método no permitido
    echo json_encode(["error" => "Metodo no permitido."]);
}

?>


