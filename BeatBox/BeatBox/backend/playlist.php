<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include ('../backend/conexion.php');

$sql = "SELECT p.fecha_creada, p.nombre, p.favorito, p.COUNT(id_contenido) as cant, p.img, u.nombre as user
        FROM playlist p
        LEFT JOIN usuarios u ON c.user = u.id";

$result = $conexion->query($sql);

header('Content-Type: application/json');

if (!$result) {
    echo json_encode(array('error' => "Error en la consulta: " . $conexion->error));
    exit();
}

if ($result->num_rows > 0) {
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode(array('infoList' => $data), JSON_UNESCAPED_SLASHES);

} else {
    echo json_encode(array('infoList' => array()));
}

$conexion->close();
?>



