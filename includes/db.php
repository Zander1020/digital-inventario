<?php


// db.php - Conexión a la base de datos
$host = "localhost"; // Cambia según tu configuración
$user = "root"; // Cambia si tienes un usuario distinto
$password = ""; // Cambia si tienes contraseña en tu servidor
$database = "digital-inventario";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>