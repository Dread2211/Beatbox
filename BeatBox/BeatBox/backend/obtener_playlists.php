<?php
session_start();
include '../backend/conexion.php'; // Asegúrate de incluir la conexión correcta

// Verifica que el usuario esté autenticado
if (!isset($_SESSION['usuario_id'])) {
    http_response_code(403);
    echo json_encode(["error" => "Usuario no autenticado."]);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

// Consulta para obtener playlists y contar las canciones asociadas
$sql = "
    SELECT p.id, p.nombre, COUNT(c.id) AS cantidad_canciones 
    FROM playlist p
    LEFT JOIN contenido c ON p.id_contenido = c.id
    WHERE p.usuario_id = ?
    GROUP BY p.id
";
$stmt = $conexion->prepare($sql);
$stmt->bind_param('i', $usuario_id);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    $playlists = [];

    while ($row = $result->fetch_assoc()) {
        $playlists[] = $row;
    }

    echo json_encode(["success" => true, "playlists" => $playlists]);
} else {
    http_response_code(500);
    echo json_encode(["error" => "Error al obtener las playlists."]);
}

$stmt->close();
$conexion->close();
?>
