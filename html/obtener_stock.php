<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "facturacion";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el idProducto de la petición GET
$idProducto = $_GET['idProducto'];

// Obtener el stock del producto
$sql = "SELECT stockProducto FROM productos WHERE idProducto = $idProducto";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $stock = $row['stockProducto'];
    echo $stock;
} else {
    echo '0'; // Si el producto no existe, se considera stock cero
}

$conn->close();
?>
