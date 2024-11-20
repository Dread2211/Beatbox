<?php
include('../backend/conexion.php');

// Verificar si se recibió el ID de la playlist
if (isset($_GET["id"])) {
    $playlist_id = (int)$_GET["id"];

    // Consulta para obtener los datos de la playlist
    $sql = "SELECT nombre, fecha_creada, usuario_id FROM playlist WHERE id = $playlist_id";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        // Mostrar los datos de la playlist
        $row = $result->fetch_assoc();
        echo "<h2>Detalles de la Playlist</h2>";
        echo "<p><strong>Título:</strong> " . htmlspecialchars($row["nombre"]) . "</p>";
        echo "<p><strong>Fecha de Creación:</strong> " . htmlspecialchars($row["fecha_creada"]) . "</p>";
        echo "<p><strong>Creada por Usuario ID:</strong> " . htmlspecialchars($row["usuario_id"]) . "</p>";
    } else {
        echo "No se encontró la playlist.";
    }
} else {
    echo "ID de playlist no especificado.";
}

// Cerrar la conexión
$conexion->close();
?>