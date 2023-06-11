<?php
$conexion = new mysqli('localhost', 'root', '1234', 'pekasNew');
if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}

session_start();

// Verificar si el carrito de compra está creado y no está vacío
if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
    // Obtener los ID de los productos del carrito
    $id_productos = $_SESSION['carrito'];
} else {
    echo 'no existe una puta mierda';
}

// Guardar las variables
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $pwd = $_POST['contrasenia'];

    $productos = $_POST['productos'];

    $query_user = "SELECT id FROM clientes WHERE email = '$correo' AND pwd = '$pwd'";
    
    $result = $conexion->query($query_user);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            echo $row['id'];
        }
    } else {
        echo 'Esta cuenta no existe en nuestra base de datos';
    }
}

?>