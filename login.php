<?php
include('php/conexion.php'); // Asegúrate de que la ruta sea correcta

if(isset($_POST['login'])) {
    $user = $_POST['user'];
    $contraseña = $_POST['contraseña'];

    // Realiza la consulta de autenticación usando las variables de conexión definidas en conexion.php
    $query = "SELECT * FROM usuarios WHERE user = '$user' AND contraseña = '$contraseña'";
    $result = $conexion->query($query);

    if ($result->num_rows > 0) {
        // Autenticación exitosa, redirigir al usuario a la página de facturación
        header("Location: ./html/facturacion.php");
        exit();
    } else {
        // Autenticación fallida
        echo "Usuario o contraseña incorrectos.";
    }
}
?>
