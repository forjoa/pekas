<?php
// Conecta a la base de datos
$conexion = new mysqli('localhost', 'root', '1234', 'pekasNew');
if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}

// Verifica que se haya enviado la solicitud POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtiene los valores del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $imagen = '';

    // Si se envió una imagen, la guarda en el servidor
    if ($_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
        $imagen = '../upload_img/' . uniqid() . '-' . $_FILES['imagen']['name'];
        move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen);
    } 

    // Inserta el nuevo producto en la base de datos
    $stmt = $conexion->prepare('INSERT INTO productos (nombre, descripcion, precio, imagen) VALUES (?, ?, ?, ?)');
    $stmt->bind_param('ssds', $nombre, $descripcion, $precio, $imagen);
    $stmt->execute();

    // Redirecciona a la página principal
    header('Location: ../tienda.php');
    exit;
}