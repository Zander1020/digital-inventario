<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/layout.css">
    <!-- Incluir jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Incluir jQuery UI -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
        $(document).ready(function() {
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd', // Formato de la fecha
                autoclose: true,      // Cierra automáticamente el calendario después de seleccionar
                todayHighlight: true  // Resalta la fecha de hoy
            });
        });
    </script>
    <title>Digital Plus</title>
    <style>
    body {
            background-image: url(../imagenes/fondo.jpg);
            background-size: cover; /* La imagen cubrirá todo el fondo */
            background-position: center; /* La imagen se centrará en la pantalla */
            background-repeat: no-repeat; /* Evita que la imagen se repita */
            background-attachment: fixed;
            margin: 20px;
        }
    </style>
</head>
<div class='row'>
    <div class='col-1'></div>
    <div class='col-2 p-2'>
        <img src="../imagenes/logo.png" width="100%">
    </div>
    <div class='col-8 text-end p-3'>
        <a href="../auth/logout.php" class='btn btn-primary'>Salir</a>
    </div>
    <div class='col-1 m-4'></div>

</div>
<div class='row text-center p-'>
    <div class='col'>
    <a href='../includes/pedido.php'>
         <img src="../imagenes/casa.png" width='5%'></a>

    <a href='../crud/crear_pedido.php'>
         <img src="../imagenes/agregar-pedido.png" width='5%'>
    </a>
    
    </div>
</div>
<div class='p-4'>

</div>