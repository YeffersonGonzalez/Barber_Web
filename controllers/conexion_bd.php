<?php
$servername = "localhost";
$username = "root";
$password = "123456789";
$dbname = "barber_web";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
    }
//   else {
//      echo "Conexión exitosa a la base de datos.";
//  }
?> 