<?php
require 'conexion.php';

header('Content-Type: application/json');

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validar y sanitizar entradas
    $nombre = $_POST['name'];
    $usuario = $_POST['usuario'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $contrasena = $_POST['password'];

    try {
        // Verificar si el nombre de usuario, el correo electrónico o el teléfono ya están en uso
        $stmt = $conexion->prepare("SELECT usuario, email, telefono FROM usuarios WHERE usuario = ? OR email = ? OR telefono = ?");
        if (!$stmt) {
            throw new Exception('Error en la preparación de la consulta: ' . $conexion->error);
        }

        $stmt->bind_param("sss", $usuario, $email, $telefono);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            // Verificar cuál campo específico está en uso
            $fila = $resultado->fetch_assoc();
            if ($fila['usuario'] == $usuario) {
                $response['status'] = 'error';
                $response['message'] = 'El nombre de usuario ya está en uso.';
            } elseif ($fila['email'] == $email) {
                $response['status'] = 'error';
                $response['message'] = 'El correo electrónico ya está en uso.';
            } elseif ($fila['telefono'] == $telefono) {
                $response['status'] = 'error';
                $response['message'] = 'El teléfono ya está en uso.';
            }
        } else {
            // Hashear la contraseña antes de almacenarla
            $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

            // Asignar el rol predeterminado
            $rol = 1;

            // Insertar el nuevo usuario en la base de datos
            $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, usuario, telefono, email, contrasena, rol) VALUES (?, ?, ?, ?, ?, ?)");
            if (!$stmt) {
                throw new Exception('Error en la preparación de la consulta: ' . $conexion->error);
            }

            $stmt->bind_param("sssssi", $nombre, $usuario, $telefono, $email, $hashed_password, $rol);

            if ($stmt->execute()) {
                $response['status'] = 'success';
                $response['message'] = 'Registro exitoso.';
            } else {
                throw new Exception('Error al ejecutar la inserción: ' . $stmt->error);
            }
        }

        $stmt->close();
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = 'Error: ' . $e->getMessage();
    }

    echo json_encode($response);
}
?>