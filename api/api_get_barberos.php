<?php
header('Content-Type: application/json');
require '../controllers/conexion_bd.php';

$sql = "SELECT id, nombre FROM usuarios WHERE tipo = 'barbero'";
$result = $conn->query($sql);

$barberos = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $barberos[] = $row;
    }
}

echo json_encode($barberos);

$conn->close();
?>
