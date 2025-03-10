<?php 
    include '../includes/db.php';
    include '../includes/header.php'; 

    session_start();
    if (!isset($_SESSION['usuario'])) {
        header("Location: ../index.php");
        exit;
    }
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cliente = $_POST['cliente'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $cantidad = $_POST['cantidad'];
    $producto = $_POST['producto'];
    $motivo = $_POST['motivo'];
    $precio_unitario = $_POST['precio_unitario'];
    $precio_envio = $_POST['precio_envio'];
    $estado = $_POST['estado_de_pedido'];
    $fecha = $_POST['fecha_entrega'];
    $fecha = date('Y-m-d', strtotime($fecha));

    $sql = "INSERT INTO pedidos (cliente, telefono, direccion, fecha, cantidad, producto, motivo, precio_unitario, precio_envio, estado_de_pedido) 
            VALUES ('$cliente', '$telefono', '$direccion', '$fecha', '$cantidad',  '$producto', '$motivo', '$precio_unitario', '$precio_envio', '$estado')";
    
    if ($conn->query($sql)) {
        header("Location: ../includes/pedido.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<div class='row'>
    <div class='col-4'>

    </div>
<div class='card col-4'>
    <div class='card-header'>
        <div class='form-group'>
            <form action="crear_pedido.php" method="POST">
                <label for="cliente">Cliente:</label>
                <input type="text" name="cliente" required class='form-control'>
                
                <label for="telefono">Teléfono:</label>
                <input type="text" name="telefono" required class='form-control'>
                
                <label for="direccion">Dirección:</label>
                <input type="text" name="direccion" required class='form-control'>

                <div class="form-group mb-2 mb20">
                    <label for="fecha_entrega" class="form-label">Fecha de entrega</label>
                    <input type="text" class="form-control datepicker" id="fecha_entrega" name="fecha_entrega" placeholder="Selecciona una fecha">
                </div>
                
                <label for="cantidad">Cantidad:</label>
                <input type="number" name="cantidad" required class='form-control'>

                <label for="producto">Producto:</label>
                <input type="text" name="producto" required class='form-control'>
                
                <label for="motivo">Motivo:</label>
                <input type="text" name="motivo" required class='form-control'>
                
                <label for="precio_unitario">Precio Unitario:</label>
                <input type="number" step="0.01" name="precio_unitario" required class='form-control'>
                
                <label for="precio_envio">Precio Envío:</label>
                <input type="number" step="0.01" name="precio_envio" required class='form-control'>
                
                <label for="estado_de_pedido">Estado del Pedido:</label>
                <select name="estado_de_pedido" class='form-control'>
                    <option value="pendiente">Pendiente</option>
                    <option value="procesado">Procesado</option>
                    <option value="enviado">Enviado</option>
                    <option value="entregado">Entregado</option>
                </select>
                <br>
                <button type="submit"  class='btn btn-primary'>Guardar Pedido</button>
            </form>

