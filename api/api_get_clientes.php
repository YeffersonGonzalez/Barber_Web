<?php
header('Content-Type: application/json');
require '../controllers/conexion_bd.php';

$sql = "SELECT id, nombre FROM usuarios WHERE tipo = 'cliente'";
$result = $conn->query($sql);

$clientes = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $clientes[] = $row;
    }
}

echo json_encode($clientes);

$conn->close();
?>
