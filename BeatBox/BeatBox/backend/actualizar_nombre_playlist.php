<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

include '../backend/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $playlistId = $_POST['playlist_id'];
    $nuevoNombre = $_POST['nuevo_nombre'];

    // Verifica que los datos sean válidos
    if (!empty($playlistId) && !empty($nuevoNombre)) {
        $sql = "UPDATE playlist SET nombre = ? WHERE id = ? AND usuario_id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sii", $nuevoNombre, $playlistId, $_SESSION['usuario_id']); 

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Error al actualizar el nombre.']);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'Datos inválidos.']);
    }

    error_log("Playlist ID: $playlistId, Nuevo Nombre: $nuevoNombre, Usuario ID: {$_SESSION['usuario_id']}");


    $conexion->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Método no permitido.']);
}
?>