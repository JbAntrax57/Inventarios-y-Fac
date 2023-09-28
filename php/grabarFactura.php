<?php
include('conexion.php');
$idCliente = $_POST["codigoCliente"];
$subTotal = $_POST['subTotal'];
$iva = $_POST['iva'];
$totalFactura = $_POST['totalFactura'];
$numeroFilas = $_POST['numeroFilas'];

// Insertar la cabecera de la factura
$strSQL = "INSERT INTO factura_cabecera VALUES (0, $idCliente, NOW(), $subTotal, $iva, $totalFactura)";
if ($conexion->query($strSQL) === TRUE) {
    $idFactura = $conexion->insert_id;

    // Actualizar el stock de los productos y insertar el detalle de la factura
    for ($i = 1; $i <= $numeroFilas; $i++) {
        $campoIdProducto = "idProducto_" . $i;
        $campoPvp = "pvp_" . $i;
        $campoSubTotalLinea = "subtotal_" . $i;
        $campoCantidad = "cant_" . $i;
        $datoIdProducto = $_POST[$campoIdProducto];
        $datoPvp = $_POST[$campoPvp];
        $datoSubTotalLinea = $_POST[$campoSubTotalLinea];
        $datoCantidad = $_POST[$campoCantidad];

        // Verificar el stock disponible
        $sqlStock = "SELECT stockProducto FROM productos WHERE idProducto = $datoIdProducto";
        $resultStock = $conexion->query($sqlStock);
        if ($resultStock->num_rows > 0) {
            $rowStock = $resultStock->fetch_assoc();
            $stockDisponible = $rowStock['stockProducto'];
            if ($datoCantidad > $stockDisponible) {
                echo "No hay stock suficiente para el producto con ID $datoIdProducto.";
                break;
            }

            // Actualizar el stock
            $nuevoStock = $stockDisponible - $datoCantidad;
            $sqlUpdateStock = "UPDATE productos SET stockProducto = $nuevoStock WHERE idProducto = $datoIdProducto";
            if ($conexion->query($sqlUpdateStock) === FALSE) {
                echo "Error al actualizar el stock del producto con ID $datoIdProducto.";
                break;
            }

            // Insertar el detalle de la factura
            $strSQL = "INSERT INTO factura_detalle VALUES ($idFactura, $datoIdProducto, $datoCantidad, $datoPvp, $datoSubTotalLinea)";
            if ($conexion->query($strSQL) === FALSE) {
                echo "Error al grabar el detalle de la factura.";
                break;
            }
        } else {
            echo "El producto con ID $datoIdProducto no existe.";
            break;
        }
    }
    
    // Si todo salió bien, generar el PDF del ticket
    // require('fpdf.php');
    // require_once 'lib/fpdf.php';
    require_once '../lib/fpdf.php';



    // Crear una nueva clase PDF que herede de la clase FPDF
    class PDF extends FPDF
    {
        // Método para generar el contenido del PDF
        function Content($idFactura, $totalFactura)
        {
            $this->SetFont('Arial', '', 14);
            $this->Cell(0, 10, 'Factura No: ' . $idFactura, 0, 1, 'C');

            // Agregar más contenido del ticket de acuerdo a tus necesidades
            // ...

            // Ejemplo: Agregar el total de la factura
            $this->SetFont('Arial', 'B', 16);
            $this->Cell(0, 10, 'Total: $' . $totalFactura, 0, 1, 'C');
        }
    }

    // Crear una instancia de la clase PDF
    $pdf = new PDF();
    $pdf->AddPage();

    // Llamar al método Content pasando el ID de la factura y el total de la factura para generar el contenido del PDF
    $pdf->Content($idFactura, $totalFactura);

    // Descargar el PDF
    $pdf->Output('ticket.pdf', 'D');
} else {
    echo "Error al grabar la factura.";
}

?>