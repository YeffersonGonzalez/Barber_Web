<?php
require 'conexion_bd.php';

$sql = "SELECT id, nombre, fecha_cita AS start FROM citas";
$result = $conn->query($sql);

$events = array();

while($row = $result->fetch_assoc()) {
    $events[] = $row;
}

echo json_encode($events);

$conn->close();
?>
