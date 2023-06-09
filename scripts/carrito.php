<?php
session_start();
$clienteId = $_SESSION['clienteId'];

// Verifica si se ha registrado exitosamente
if (isset($_SESSION['registroExitoso']) && $_SESSION['registroExitoso']) {
    // Muestra el mensaje de registro exitoso
    echo "<p>Registro exitoso. ¡Bienvenido!</p>";

    // Limpia la variable de sesión para que no se muestre el mensaje en futuras visitas a la página
    $_SESSION['registroExitoso'] = false;

    header ('Location: ../pedidos.php');
}

// Verificar si el cliente ha seleccionado algún producto en el carrito
if (!empty($_POST['productoId'])) {
    $productoId = $_POST['productoId'];
    
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "1234", "pekasNew");
    
    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
    
    // Insertar el pedido en la tabla de pedidos
    $sql = "INSERT INTO pedidos (id_producto, id_cliente) VALUES ('$productoId', '$clienteId')";
    if ($conexion->query($sql) === TRUE) {
        echo "Pedido realizado correctamente.";
    } else {
        echo "Error al realizar el pedido: " . $conexion->error;
    }
    
    // Cerrar la conexión
    $conexion->close();
}
?>
