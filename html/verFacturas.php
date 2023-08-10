<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HISTORIAL FACTURAS</title>
    <link rel="stylesheet" href="../css/styletable.css" />
    <link rel="stylesheet" href="../css/bootstrap-4.6.0/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap-5.3.0/dist/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    <h1>HISTORIAL VENTAS</h1>
    <table class="table table-bordered border-primary table-striped-columns">
        <thead class="table-dark">
            <tr>
                <th>ID VENTA</th>
                <th>CLIENTE</th>
                <th>FECHA</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('../php/conexion.php'); // Asegúrate de incluir el archivo de conexión
            $query = "SELECT f.idFactura as id,c.nombresCliente as client , f.fechaFactura as date, f.total as total
            FROM factura_cabecera as f
            LEFT JOIN clientes as c ON f.idCliente = c.idCliente
            ORDER BY f.fechaFactura DESC
            LIMIT 10";
            $result = $conexion->query($query);
            if (!$result) {
                echo "Error en la consulta: " . $conexion->error;
                exit(); // Sale del script en caso de error
            }

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['client'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['total'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="./facturacion.php" class="btn btn-danger">Regresar</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
