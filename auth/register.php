<?php include '../includes/db.php'; 
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit;
};
?>

<form action="register.php" method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" required>
    
    <label for="email">Correo electrónico:</label>
    <input type="email" name="email" required>
    
    <label for="password">Contraseña:</label>
    <input type="password" name="password" required>
    
    <button type="submit">Registrarse</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO usuarios (nombre, email, password) VALUES ('$nombre', '$email', '$password')";
    
    if ($conn->query($sql)) {
        echo "Usuario registrado con éxito.";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
