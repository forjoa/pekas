<?php
// Conecta a la base de datos
$conexion = new mysqli('localhost', 'root', '1234', 'pekasNew');
if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}

// Verifica que se haya enviado la solicitud POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $imagen = '';

    // Si se envió una imagen, la guarda en el servidor
    if ($_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
        $imagen = '../upload_img/' . uniqid() . '-' . $_FILES['imagen']['name'];
        move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen);
    } 

    // Escapar los valores para evitar inyección de SQL
    $id = $conexion->real_escape_string($id);
    $nombre = $conexion->real_escape_string($nombre);
    $descripcion = $conexion->real_escape_string($descripcion);
    $precio = $conexion->real_escape_string($precio);
    $imagen = $conexion->real_escape_string($imagen);

    // Construir la consulta SQL para actualizar los datos
    $sql = "UPDATE productos SET nombre = '$nombre', descripcion = '$descripcion', precio = '$precio', imagen = '$imagen' WHERE id = $id";

    // Ejecutar la consulta SQL
    if ($conexion->query($sql) === TRUE) {
        echo "Datos actualizados correctamente.";
    } else {
        echo "Error al actualizar los datos: " . $conexion->error;
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
    header('Location: ../tienda.php');
    exit;
}
?>
