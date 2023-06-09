<?php
// Conecta a la base de datos
$conexion = new mysqli('localhost', 'root', '1234', 'pekasNew');
if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}

// Verifica que se haya enviado la solicitud POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Recolectamos las variables
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['email'];
    $pwd = $_POST['pwd'];

    // Evitamos inyecciones SQL
    $nombre = $conexion->real_escape_string($nombre);
    $apellido = $conexion->real_escape_string($apellido);
    $telefono = $conexion->real_escape_string($telefono);
    $direccion = $conexion->real_escape_string($direccion);
    $correo = $conexion->real_escape_string($correo);
    $pwd = $conexion->real_escape_string($pwd);


    // Consulta preparada
    $sql = "INSERT INTO clientes (nombre, apellidos, num_telefono, email, direccion, pwd) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssss", $nombre, $apellido, $telefono, $correo, $direccion, $pwd);

    // Ejecutamos la consulta preparada
    $stmt->execute();

    // Cerrar la conexión a la base de datos
    $stmt->close();
    $conexion->close();
    header('Location: ../tienda.php');
    exit;

}

?>