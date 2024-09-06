<?php
header('Content-Type: application/json');
require '../controllers/conexion_bd.php';

$sql = "SELECT id, nombre FROM servicios";
$result = $conn->query($sql);

$servicios = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $servicios[] = $row;
    }
}

echo json_encode($servicios);

$conn->close();
?>
