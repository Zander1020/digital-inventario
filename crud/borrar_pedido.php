<?php
include '../includes/db.php';

session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit;
};

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar el pedido de la base de datos
    $sql = "DELETE FROM pedidos WHERE id = $id";
    
    if ($conn->query($sql)) {
        header("Location: ../includes/pedido.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
