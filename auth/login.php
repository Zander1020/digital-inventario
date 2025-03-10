<?php
session_start();
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verificar si el usuario existe en la base de datos
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Obtener los datos del usuario
        $user = $result->fetch_assoc();

        // Verificar la contraseña con password_verify()
        if (password_verify($password, $user['password'])) {
            // Si la contraseña es correcta, guardar en la sesión
            $_SESSION['usuario'] = $email;
            header("Location: includes/pedido.php");
            exit;
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
}
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<style>
        body {
            background-image: url(imagenes/fondo.jpg);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .login-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 400px;
            width: 100%;
        }
        .login-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
            text-align: center;
        }
        .form-control {
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .forgot-password {
            text-align: right;
        }
        .forgot-password a {
            color: #007bff;
            text-decoration: none;
        }
        .forgot-password a:hover {
            text-decoration: underline;
        }
        
    </style>

<body'>
<div class="login-container">
        <div class="login-title">
            <img src="imagenes/logo.png" width="80%">
        </div>
        <form method="POST" action="auth/login.php">
            <h3 class='text-center p-2'>Iniciar sesión</h3>
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email"  name='email' placeholder='Coreeo electronico' class="form-control" require>
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password"  name='password' placeholder='Contraseña' class="form-control" require>
            </div>
            <br>
            <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
        </form>
    </div>
</div>

</body>


</html>


