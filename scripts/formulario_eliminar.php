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

    // Verificar si el ID es válido 
    if (!is_numeric($id)) {
        echo "El ID proporcionado no es válido.";
        exit;
    }

    // Escapar los valores para evitar inyección de SQL
    $id = $conexion->real_escape_string($id);

    // Construir la consulta SQL para eliminar el registro
    $sql = "DELETE FROM productos WHERE id = $id";

    // Ejecutar la consulta SQL
    if ($conexion->query($sql) === TRUE) {
        echo "Registro eliminado correctamente.";
    } else {
        echo "Error al eliminar el registro: " . $conexion->error;
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
    header('Location: ../tienda.php');
    exit;
}
?>