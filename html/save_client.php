<?php
// Obtener los datos del formulario
$documento = $_POST['documento'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "facturacion";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Inserción de datos en la tabla clientes
$sql = "INSERT INTO clientes (documentoCliente, nombresCliente, apellidosCliente, direccionCliente, telefonoCliente)
        VALUES ('$documento', '$nombres', '$apellidos', '$direccion', '$telefono')";

if ($conn->query($sql) === TRUE) {
    echo "Cliente agregado correctamente";
} else {
    echo "Error al agregar el cliente: " . $conn->error;
}

$conn->close();
?>
