<?php
require 'conexion.php';

header('Content-Type: application/json');

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_usuario = $_POST['usuario'];
    $contrasena = $_POST['password'];

    try {
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->bind_param("s", $nombre_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows == 1) {
            $fila = $resultado->fetch_assoc();
            if (password_verify($contrasena, $fila['contrasena'])) {
                session_start();
                $_SESSION['usuario'] = $nombre_usuario;
                $_SESSION['loggedIn'] = true;
                $response['status'] = 'success';
                $response['message'] = 'Inicio de sesión exitoso';
                $response['loggedIn'] = true;
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Contraseña incorrecta';
                $response['loggedIn'] = false;
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Usuario incorrecto';
        }

        $stmt->close();
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = 'Error en el servidor: ' . $e->getMessage();
    }
    echo json_encode($response);
}
?>