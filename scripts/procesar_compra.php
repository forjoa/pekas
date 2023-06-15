<?php
$conexion = new mysqli('localhost', 'root', '1234', 'pekasNew');
if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}

$cliente_id = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $pwd = $_POST['contrasenia'];
    $previous_page = $_POST['previous_page'];

    if ($previous_page == 'tienda') {

        $query_user = "SELECT id FROM clientes WHERE email = '$correo' AND pwd = '$pwd'";

        $result = $conexion->query($query_user);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo $row['id'];
                $cliente_id = $row['id'];
            }
            header("Location: ./carrito.php/".$cliente_id);
        } else {
            echo 'Esta cuenta no existe en nuestra base de datos';
        }
    } else {

        $carro = $_POST['carro'];
        $data = json_decode($carro, true);
        $cliente_id = json_decode($_POST['idCliente'], true);
        //Guardado del carrito en base de datos
        echo $data;
        print_r($data);
        print_r($cliente_id);
        
        echo $cliente_id;
        foreach ($data as $producto) {
            $id = $producto['id'];
            $query_insert_pedidos = "INSERT INTO pedidos (id_producto, id_cliente) VALUES (?, ?)";
            $stmt = $conexion->prepare($query_insert_pedidos);
            $stmt->bind_param('ii', $id, $cliente_id);
            $stmt->execute();
            $stmt->close();
            if ($stmt) {
                echo "bien insertado";
                print_r("bien");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                print_r("Error: " . $sql . "<br>" . mysqli_error($conn));
            }
        }

    }


}




?>