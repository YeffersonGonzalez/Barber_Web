<?php
header('Content-Type: application/json');
require '../controllers/conexion_bd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['cliente_id']) || !isset($data['barbero_id']) || !isset($data['servicio_id']) || !isset($data['fecha']) || !isset($data['hora'])) {
        echo json_encode(["error" => "Faltan datos requeridos."]);
        exit;
    }

    $cliente_id = $data['cliente_id'];
    $barbero_id = $data['barbero_id'];
    $servicio_id = $data['servicio_id'];
    $fecha = $data['fecha'];
    $hora = $data['hora'];

    $fecha_cita = $fecha . ' ' . $hora;

    // Prepara la consulta SQL
    $stmt = $conn->prepare("INSERT INTO citas (usuario_id, barbero_id, servicio_id, fecha_cita) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiis", $cliente_id, $barbero_id, $servicio_id, $fecha_cita);

    if ($stmt->execute()) {
        echo json_encode(["success" => "Cita agendada exitosamente."]);
    } else {
        echo json_encode(["error" => "Error al agendar la cita."]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["error" => "Método no permitido."]);
}
?>