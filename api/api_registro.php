<?php
header('Content-Type: application/json');
require '../controllers/conexion_bd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!$data) {
        echo json_encode(["error" => "Error en la decodificación del JSON o JSON vacío"]);
        exit;
    }

    if (!isset($data['nombre']) || !isset($data['email']) || !isset($data['tipo'])) {
        echo json_encode(["error" => "Faltan datos requeridos."]);
        exit;
    }

    $nombre = $data['nombre'];
    $email = $data['email'];
    $telefono = isset($data['telefono']) ? $data['telefono'] : null;
    $tipo = $data['tipo'];

    // Prepara la consulta SQL
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, telefono, tipo) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        echo json_encode(["error" => "Error al preparar la consulta: " . $conn->error]);
        exit;
    }
    
    $stmt->bind_param("ssss", $nombre, $email, $telefono, $tipo);

    // Ejecuta la consulta y verifica si se insertó correctamente
    if ($stmt->execute()) {
        echo json_encode(["success" => "Usuario registrado exitosamente."]);
    } else {
        echo json_encode(["error" => "Error al ejecutar la consulta: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["error" => "Método no permitido."]);
}
