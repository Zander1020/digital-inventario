<?php 
    include '../includes/db.php';
    include '../includes/header.php'; 

    session_start();
    if (!isset($_SESSION['usuario'])) {
        header("Location: ../index.php");
        exit;
    }

    // Verificar si se recibe un ID a través de GET
    if (isset($_GET['id'])) {
        $pedido_id = $_GET['id'];

        // Consulta para obtener los detalles del pedido
        $sql = "SELECT * FROM pedidos WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $pedido_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Si existe el pedido
        if ($result->num_rows > 0) {
            $pedido = $result->fetch_assoc();
        } else {
            echo "<p>No se encontró el pedido con ID $pedido_id</p>";
            exit;
        }
    } else {
        echo "<p>No se recibió ningún ID de pedido</p>";
        exit;
    }
?>

<body>
    <div class='row'></div>
    <div class='col-3'></div>
<div class="container p-5 col-5">
    <h2 style='color: white' class='text-center'>Detalles del Pedido</h2>
    <div class="card p-3">
    <table class="table table-striped table-bordered" style='font-size: 14px'>
        <tr>
            <th>Cliente</th>
            <td style="font-weight: normal;"><?php echo $pedido['cliente']; ?></td>
        </tr>
        <tr>
            <th>Telefono</th>
            <td style="font-weight: normal;"><?php echo $pedido['telefono']; ?></td>
        </tr>
        <tr>
            <th>Dirección</th>
            <td style="font-weight: normal;"><?php echo $pedido['direccion']; ?></td>
        </tr>
        <tr>
            <th class='w-25'>F. de entrega</th>
            <td style="font-weight: normal;"><?php echo $pedido['fecha']; ?></td>
        </tr>
        <tr>
            <th>Cantidad</th>
            <td style="font-weight: normal;"><?php echo $pedido['cantidad']; ?></td>
        </tr>
        <tr>
            <th>Producto</th>
            <td style="font-weight: normal;"><?php echo $pedido['producto']; ?></td>
        </tr>
        <tr>
            <th>Motivo</th>
            <td style="font-weight: normal;"><?php echo $pedido['motivo']; ?></td>
        </tr>
        <tr>
            <th>Precio uni.</th>
            <td style="font-weight: normal;"><?php echo $pedido['precio_unitario']; ?></td>
        </tr>
        <tr>
            <th>T. Libros</th>
            <td style="font-weight: normal;"><?php echo $pedido['precio_unitario'] * $pedido['cantidad']; ?></td>
        </tr>
        <tr>
            <th>Domicilio</th>
            <td style="font-weight: normal;"><?php echo $pedido['precio_envio']; ?></td>
        </tr>
        <tr>
            <th>Total</th>
            <td style="font-weight: normal;">$<?php echo $pedido['cantidad'] * $pedido['precio_unitario'] + $pedido['precio_envio']; ?></td>
        </tr>
        <tr>
            <th>Estado</th>
            <td style="font-weight: normal;"><?php echo $pedido['estado_de_pedido']; ?></td>
        </tr>
        
    </table>
    <a href="../includes/pedido.php" class="btn btn-primary">Volver a la lista</a>
        
    </div>
    
</div>
</body>
