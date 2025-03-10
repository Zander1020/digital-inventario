<?php 
    include 'db.php';
    include 'header.php'; 

    session_start();
    if (!isset($_SESSION['usuario'])) {
        header("Location: ../index.php");
        exit;
    }
?>
<body>
    


<div class='row p-5'>
    <div></div>
    <div class='col-12 card p-2'>
        <h2>Lista de pedidos</h2>

        <!-- Filtro por estado de pedido -->
        <form method="GET" action="">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="estado_de_pedido">Filtrar por estado:</label>
                    <select class="form-select" name="estado_de_pedido" id="estado_de_pedido">
                        <option value="pendiente" <?php if (isset($_GET['estado_de_pedido']) && $_GET['estado_de_pedido'] == 'pendiente') echo 'selected'; ?>>Pendiente</option>
                        <option value="procesado" <?php if (isset($_GET['estado_de_pedido']) && $_GET['estado_de_pedido'] == 'procesado') echo 'selected'; ?>>Procesado</option>
                        <option value="terminado" <?php if (isset($_GET['estado_de_pedido']) && $_GET['estado_de_pedido'] == 'terminado') echo 'selected'; ?>>Terminado</option>
                        <option value="enviado" <?php if (isset($_GET['estado_de_pedido']) && $_GET['estado_de_pedido'] == 'enviado') echo 'selected'; ?>>Enviado</option>
                        <option value="entregado" <?php if (isset($_GET['estado_de_pedido']) && $_GET['estado_de_pedido'] == 'entregado') echo 'selected'; ?>>Entregado</option>
                    </select>
                </div>
                <div class="col-md-2 mt-4">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
        </form>

        <table class="table table-striped table-bordered" style='font-size: 14px'>
            <thead class="table-light">
                <tr>
                    <th>Cliente</th>
                    <th>Teléfono</th>
                    <th scope='col' style='width: 200px;'>Dirección</th>
                    <th>F. entrega</th>
                    <th>Cant.</th>
                    <th>Producto</th>
                    <th>Motivo</th>
                    <th>Precio Uni.</th>
                    <th>Precio Env</th>
                    <th>Estado ped.</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db.php';

                // Verificar si se ha seleccionado un estado de pedido
                $estado = isset($_GET['estado_de_pedido']) ? $_GET['estado_de_pedido'] : '';

                // Consulta SQL con filtro de estado si se ha seleccionado
                if (!empty($estado)) {
                    $sql = "SELECT * FROM pedidos WHERE estado_de_pedido = '$estado' ORDER BY fecha ASC";
                } else {
                    $sql = "SELECT * FROM pedidos WHERE estado_de_pedido = 'pendiente' ORDER BY fecha ASC";
                }
                

                $result = $conn->query($sql);
                $monto = 0;

                while ($row = $result->fetch_assoc()) {
                    $total = $row['cantidad'] * $row['precio_unitario'] + $row['precio_envio'];
                    $total2  = $row['cantidad'] * $row['precio_unitario'];
                    $monto += $total2;
                    echo "<tr>";
                    echo "<td>{$row['cliente']}</td>";
                    echo "<td>{$row['telefono']}</td>";
                    echo "<td style='word-wrap: break-word; width: 150px;'>{$row['direccion']}</td>";
                    echo "<td>{$row['fecha']}</td>";
                    echo "<td>{$row['cantidad']}</td>";
                    echo "<td>{$row['producto']}</td>";
                    echo "<td>{$row['motivo']}</td>";
                    echo "<td>{$row['precio_unitario']}</td>";
                    echo "<td>{$row['precio_envio']}</td>";
                    echo "<td>{$row['estado_de_pedido']}</td>";
                    echo "<td>{$total}</td>";
                    
                    // Aquí cambiamos los textos de "Editar" y "Borrar" por imágenes
                    echo "<td>
                            <a href='../crud/editar_pedido.php?id={$row['id']}' title='Editar'>
                                <img src='../imagenes/editar.png' alt='Editar' style='width: 24px; height: 24px;'></a>

                            <a href='../crud/ver_pedido.php?id={$row['id']}' title='Editar'>
                                <img src='../imagenes/detalles.png' alt='Editar' style='width: 24px; height: 24px;'></a>

                            <a href='factura.php?id={$row['id']}' title='Factura'>
                                <img src='../imagenes/factura.png' alt='Factura' style='width: 24px; height: 24px;'></a>
                            
                            <a href='../crud/borrar_pedido.php?id={$row['id']}' title='Borrar' onclick='return confirm(\"¿Estás seguro de que deseas borrar este pedido?\")'>
                                <img src='../imagenes/borrar.png' alt='Borrar' style='width: 24px; height: 24px;'></a>
                          </td>";
                    echo "</tr>";
                }
                echo "<h3>Total de pedidos: $" . $monto . "</h3>";
                
                ?>
            </tbody>
        </table>
    </div>
</div>

