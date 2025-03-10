<?php
// Incluir la librería TCPDF

require '../fpdf/tcpdf.php';
require 'db.php';


$pedido_id = $_GET['id'];

        // Consulta para obtener los detalles del pedido
        $sql = "SELECT * FROM pedidos WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $pedido_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Asegúrate de que hay resultados y asigna a la variable $pedido
if ($result->num_rows > 0) {
    $pedido = $result->fetch_assoc();
} else {
    die('No se encontró el pedido.');
}

// Crear una nueva instancia de TCPDF
$pdf = new TCPDF();

// Configurar las propiedades del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Alexander Yepez');
$pdf->SetTitle('Factura de Venta');
$pdf->SetMargins(10, 10, 20);

// Agregar una página
$pdf->AddPage();

// Establecer fuente
$pdf->SetFont('helvetica', '', 10);
$image_file='../imagenes/logo-web.jpg';
$pdf->Image($image_file, 10, 10, 50, '', '', '', '', '', false, 300, '', false, false, 0, false, false, false);

$subtotal  = ($pedido['precio_unitario'] * $pedido['cantidad']);


// HTML con la estructura de la tabla
$html = <<<EOD
<table  cellpadding="3" style="border:none;">

    <tr>
        <td rowspan="2" colspan="2" width="30%"><img src="$image_file" width="100%"></td>
        <td colspan="4" rowspan="2" style="text-align: center;"><b>ALEXANDER YEPEZ</b><br>
        Calle 4b4  #4 sur - 77 Malambo<br>
        NIT: 1042445492-4<br>
        yepezalexander1@gmail.com</td>
        <td colspan="2" style="text-align: center;border: 2px solid black; background-color: #b7ebfc"><b>FACTURA DE VENTA</b></td>
    </tr>
    <tr>
        <td colspan="3" style="border: 2px solid black; text-align:center; font-size: 20px"><b>FCT-$pedido[id]</b></td>
    </tr>
    <tr><td colspan="8" height="10"></td></tr>
    <tr >
        <td style="border: 2px solid black; background-color: #b7ebfc"><b>CLIENTE</b></td>
        <td colspan="2" style="border: 2px solid black;"> $pedido[cliente]</td>
        <td></td>
        <td style="border: 2px solid black; background-color: #b7ebfc"><b>FECHA</b></td>
        <td colspan="4" style="border: 2px solid black;">$pedido[fecha]</td>
    </tr>
    <tr>
        <td  style="border: 2px solid black; background-color: #b7ebfc"><b>CC / NIT</b></td>
        <td colspan="2" style="border: 2px solid black;"></td>
        <td></td>
        <td style="border: 2px solid black; background-color: #b7ebfc"><b>TELEFONO</b></td>
        <td colspan="3" style="border: 2px solid black;">$pedido[telefono]</td>
    </tr>
    <tr><td colspan="8" height="10"></td></tr>
    <tr>
        <th style="border: 2px solid black; text-align: center; background-color: #b7ebfc" width="10%">CANT</th>
        <th colspan="3" style="border: 2px solid black; background-color: #b7ebfc">DETALLES</th>
        <th style="border: 2px solid black; background-color: #b7ebfc">ABONO</th>
        <th style="border: 2px solid black; background-color: #b7ebfc">RETIRO</th>
        <th style="border: 2px solid black; background-color: #b7ebfc">VLR UND</th>
        <th style="border: 2px solid black; background-color: #b7ebfc">SUBTOTAL</th>
    </tr>
    <tr>
        <td >$pedido[cantidad]</td>
        <td colspan="3" style='font-size: 14px'>$pedido[producto] $pedido[motivo]</td>
        <td>0</td>
        <td>0</td>
        <td style='font-size: 12px'>$pedido[precio_unitario]</td>
        <td>$subtotal</td>
    </tr>
    <tr>
        <td style="text-align: center;"></td>
        <td colspan="3"></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td style="text-align: center;"></td>
        <td colspan="3"></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td style="text-align: center;"></td>
        <td colspan="3"></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td style="text-align: center;">1</td>
        <td colspan="3">Domicilio</td>
        <td></td>
        <td></td>
        <td>$pedido[precio_envio]</td>
        <td>$pedido[precio_envio]</td>
    </tr>
    <tr>
        <td colspan="5" style="border: 2px solid black;"><b>Dirección:</b> $pedido[direccion]</td>
        <td colspan="2"  style="border: 2px solid black;"><b>TOTAL</b></td>
        <td style="border: 2px solid black; font-size:  14px"><b>$$pedido[precio_total]</b></td>
    </tr>
    <tr>
        <td colspan="8" style="text-align: center; border: 2px solid black; background-color: #b7ebfc" ><b>RECUERDA QUE TAMBIÉN HACEMOS:</b><br>
        VOLANTES - PENDONES - MANTENIMIENTO - MODIFICACIONES - IMPRESIONES - COPIAS - FOTOGRAFÍAS</td>
    </tr>
</table>
EOD;

// Escribir el HTML en el documento PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Salida del PDF
$pdf->Output('factura.pdf', 'D');  // 'I' muestra en navegador, 'D' descarga el archivo
