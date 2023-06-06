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

// Obtener los datos del formulario
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$costo = $_POST['costo'];
$stock = $_POST['stock'];

// Insertar los datos en la tabla productos
$sql = "INSERT INTO productos (descripcionProducto, precioProducto, costoProducto, stockProducto) VALUES ('$descripcion', $precio, $costo, $stock)";
if ($conn->query($sql) === TRUE) {
    echo "Producto agregado exitosamente.";
} else {
    echo "Error al agregar el producto: " . $conn->error;
}

$conn->close();

// Redireccionar al index.html
header("Location: addProducto.html");
exit();
?>
