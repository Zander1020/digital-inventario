<?php
include '../includes/db.php';
include '../includes/header.php';

session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit;
};

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener los datos del pedido por su ID
    $sql = "SELECT * FROM pedidos WHERE id = $id";
    $result = $conn->query($sql);
    $pedido = $result->fetch_assoc();
}

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

    // Actualizar los datos del pedido en la base de datos
    $sql = "UPDATE pedidos SET cliente='$cliente', telefono='$telefono', direccion='$direccion', fecha='$fecha',cantidad='$cantidad', producto='$producto', motivo='$motivo',precio_unitario='$precio_unitario', precio_envio='$precio_envio', estado_de_pedido='$estado' WHERE id=$id";
    
    if ($conn->query($sql)) {
        echo "Pedido actualizado con éxito.";
        header("Location: ../includes/pedido.php");
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
            <form action="" method="POST">
                <label for="cliente">Cliente:</label>
                <input type="text" name="cliente" value="<?php echo $pedido['cliente']; ?>" required class='form-control'>

                <label for="telefono">Teléfono:</label>
                <input type="text" name="telefono" value="<?php echo $pedido['telefono']; ?>" required
                class='form-control'>

                <label for="direccion">Dirección:</label>
                <input type="text" name="direccion" value="<?php echo $pedido['direccion']; ?>" required
                class='form-control'>

               
                    <label for="fecha_entrega" class="form-label">Fecha de entrega</label>
                    <input type="text" class="form-control datepicker" id="fecha_entrega" name="fecha_entrega" placeholder="Selecciona una fecha" value="<?php echo $pedido['fecha']; ?>">
              
                <label for="cantidad">Cantidad:</label>
                <input type="number" name="cantidad" value="<?php echo $pedido['cantidad']; ?>" required
                class='form-control'>

                <label for="producto">Producto:</label>
                <input type="text" name="producto" value="<?php echo $pedido['producto']; ?>" required
                class='form-control'>

                <label for="motivo">Motivo:</label>
                <input type="text" name="motivo" value="<?php echo $pedido['motivo']; ?>" required
                class='form-control'>

                <label for="precio_unitario">Precio Unitario:</label>
                <input type="number" step="0.01" name="precio_unitario" value="<?php echo $pedido['precio_unitario']; ?>" required
                class='form-control'>

                <label for="precio_envio">Precio Envío:</label>
                <input type="number" step="0.01" name="precio_envio" value="<?php echo $pedido['precio_envio']; ?>" required
                class='form-control'>

                <label for="estado_de_pedido">Estado del Pedido:</label>
                <select name="estado_de_pedido" class='form-control'>
                    <option value="pendiente" <?php if ($pedido['estado_de_pedido'] == 'pendiente') echo 'selected'; ?>>Pendiente</option>
                    <option value="procesado" <?php if ($pedido['estado_de_pedido'] == 'procesado') echo 'selected'; ?>>Procesado</option>
                    <option value="terminado" <?php if ($pedido['estado_de_pedido'] == 'terminado') echo 'selected'; ?>>Terminado</option>
                    <option value="enviado" <?php if ($pedido['estado_de_pedido'] == 'enviado') echo 'selected'; ?>>Enviado</option>
                    <option value="entregado" <?php if ($pedido['estado_de_pedido'] == 'entregado') echo 'selected'; ?>>Entregado</option>
                </select>
                <br>
                <button type="submit" class='btn btn-primary'>Actualizar Pedido</button>
            </form>
</div>

