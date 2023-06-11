<?php
// Conecta a la base de datos
$conexion = new mysqli('localhost', 'root', '1234', 'pekasNew');
if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}

// Obtener los datos enviados por el formulario
$email = $_POST['usuario'];
$password = $_POST['contrasenia'];

if ($email == 'joaquin' && $password == '1234') {
    header('Location: ../interfaz.php');

} else {

    // Consultar en la base de datos si el cliente existe
    $sql = "SELECT id FROM clientes WHERE email = '$email'";
    $resultado = $conexion->query($sql);

    // Verificar si se encontró un cliente con las credenciales proporcionadas
    if ($resultado->num_rows > 0) {
        // Cliente autenticado correctamente
        $fila = $resultado->fetch_assoc();
        $clienteId = $fila['id'];

        // Guardar el ID del cliente en una variable de sesión para su uso posterior
        session_start();
        $_SESSION['clienteId'] = $clienteId;

        // Redirigir al usuario al carrito de compras para que pueda continuar con la compra
        header("Location: ../pedidos.php");
        // Mostrar mensaje de registro exitoso al usuario
        $_SESSION['registroExitoso'] = true;

        exit();
    } else {
        echo "Error al registrar. Por favor, inténtalo de nuevo.";
    }
}

// Cerrar la conexión
$conexion->close();
?>