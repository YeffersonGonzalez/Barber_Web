<?php
header('Content-Type: application/json');
require '../controllers/conexion_bd.php';

$sql = "SELECT 
            c.id, 
            u.nombre AS cliente, 
            b.nombre AS barbero, 
            s.nombre AS servicio, 
            c.fecha_cita, 
            c.estado 
        FROM 
            citas c
        INNER JOIN 
            usuarios u ON c.usuario_id = u.id
        INNER JOIN 
            usuarios b ON c.barbero_id = b.id
        INNER JOIN 
            servicios s ON c.servicio_id = s.id
        ORDER BY 
            c.fecha_cita DESC";

$result = $conn->query($sql);

$citas = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $citas[] = $row;
    }
}

echo json_encode($citas);

$conn->close();
?>
