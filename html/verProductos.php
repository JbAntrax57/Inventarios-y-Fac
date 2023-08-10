<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Productos</title>
    <link rel="stylesheet" href="../css/styletable.css" />
    <link rel="stylesheet" href="../css/bootstrap-4.6.0/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap-5.3.0/dist/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    <h1>Lista de Productos en Stock</h1>
    <table class="table table-bordered border-primary table-striped-columns">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>PRECIO</th>
                <th>COSTO</th>
                <th>STOCK</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('../php/conexion.php'); // Asegúrate de incluir el archivo de conexión
            $query = "SELECT idProducto, descripcionProducto, precioProducto, costoProducto, stockProducto FROM productos";
            $result = $conexion->query($query);
            if (!$result) {
                echo "Error en la consulta: " . $conexion->error;
                exit(); // Sale del script en caso de error
            }

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['idProducto'] . "</td>";
                echo "<td>" . $row['descripcionProducto'] . "</td>";
                echo "<td>" . $row['precioProducto'] . "</td>";
                echo "<td>" . $row['costoProducto'] . "</td>";
                echo "<td>" . $row['stockProducto'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="./facturacion.php" class="btn btn-danger">Regresar</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
