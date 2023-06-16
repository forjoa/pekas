<?php
// Conecta a la base de datos
$conexion = new mysqli('localhost', 'root', '1234', 'pekasNew');
if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="images/logo.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Shantell+Sans:ital,wght@0,400;1,800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Shantell+Sans&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/interfaz.css">
    <title>Panel de Control | Pedidos</title>
    <style>
        .pedido-int {
            width: 860px;
            display: flex;
            margin-bottom: 20px;
            border: 1px solid grey;
            border-radius: 10px;
            padding: 15px;
            gap: 10px;
        }

        .cliente {
            flex: 1;
        }

        .producto-int {
            flex: 1;
        }

        .pedido-int h3 {
            margin: 0;
        }

        .cliente ul,
        .producto-int ul {
            list-style-type: none;
            padding: 0;
            margin-top: 0;
        }

        .cliente ul li,
        .producto-int ul li {
            margin-bottom: 10px;
        }

        .btn-mail {
            display: block;
            margin-top: 10px;
            background-color: #f5f5f5;
            color: #333;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <header>
        <div class="top-header">
            <a href="mailto:info@tiendapekas.com">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail" width="20" height="20"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="#fff" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <rect x="3" y="5" width="18" height="14" rx="2" />
                    <polyline points="3 7 12 13 21 7" />
                </svg>
            </a>
            <a href="tel:+34917979967">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone" width="20"
                    height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fff" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path
                        d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                </svg>
            </a>
            <a href="https://wa.me/34689100096?text=" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-whatsapp" width="20"
                    height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fff" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" />
                    <path
                        d="M9 10a0.5 .5 0 0 0 1 0v-1a0.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a0.5 .5 0 0 0 0 -1h-1a0.5 .5 0 0 0 0 1" />
                </svg>
            </a>
        </div>
        <div class="nav-bar-general" id="mi-header">
            <div class="left">
                <div class="logo">
                    <img src="images/log.png">
                </div>
            </div>
            <div class="right">
                <ul>
                    <li><a href="index.html">INICIO</a></li>
                </ul>
            </div>
        </div>
    </header>

    <div class="form-class-i">
        <ul class="lista-usabilidad">
            <li><a href="interfaz.php">Subir contenido</a></li>
            <li><a href="interfaz_editar.php">Editar contenido</a></li>
            <li><a href="interfaz_eliminar.php">Eliminar producto</a></li>
            <li><a href="interfaz_pedidos.php">Pedidos</a></li>
        </ul>
        <h1>Pedidos que te han realizado: </h1>


        <div class="productos-i">
            <?php
            // Conecta a la base de datos
            $conexion = new mysqli('localhost', 'root', '1234', 'pekasNew');
            if ($conexion->connect_error) {
                die('Error de conexión: ' . $conexion->connect_error);
            }

            // Realiza la consulta
            $consulta = "SELECT DISTINCT pedidos.id AS pedido_id,
                        clientes.id AS cliente_id,
                        clientes.nombre AS cliente_nombre,
                        clientes.apellidos AS cliente_apellidos,
                        clientes.num_telefono AS cliente_telefono,
                        clientes.email AS cliente_email,
                        clientes.direccion AS cliente_direccion,
                        productos.id AS producto_id,
                        productos.nombre AS producto_nombre,
                        productos.descripcion AS producto_descripcion,
                        productos.precio AS producto_precio,
                        productos.imagen AS producto_imagen
                FROM pedidos
                JOIN clientes ON pedidos.id_cliente = clientes.id
                JOIN productos ON pedidos.id_producto = productos.id";
            $resultado = $conexion->query($consulta);

            // Muestra los resultados
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<div class='pedido-int'>";
                    echo "<h3>Pedido Num: " . $fila['pedido_id'] . "</h3>";
                    echo "<div class='cliente'>";
                    echo "<ul>";
                    echo "<li>Cliente ID: " . $fila['cliente_id'] . "</li>";
                    echo "<li>Nombre y apellido: " . $fila['cliente_nombre'] . " " . $fila['cliente_apellidos'] . "</li>";
                    echo "<li>Teléfono: " . $fila['cliente_telefono'] . "</li>";
                    echo "<li>Email: " . $fila['cliente_email'] . "</li>";
                    echo "<li>Dirección: " . $fila['cliente_direccion'] . "</li>";
                    echo "</ul>";
                    echo "</div>";
                    echo "<div class='producto-int'>";
                    echo "<ul>";
                    echo "<li>Producto ID: " . $fila['producto_id'] . "</li>";
                    echo "<li>Producto Nombre: " . $fila['producto_nombre'] . "</li>";
                    echo "<li>Producto Descripción: " . $fila['producto_descripcion'] . "</li>";
                    echo "<li>Producto Precio: " . $fila['producto_precio'] . "</li>";
                    echo "</ul>";
                    echo "<a class='btn-mail' href='mailto:" . $fila['cliente_email'] . "' target='_blank'>Enviar correo</a>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No hay pedidos disponibles</p>";
            }

            // Cierra la conexión a la base de datos
            $conexion->close();
            ?>
        </div>
    </div>

    <footer class="footer">

        <div class="f-general">
            <div class="f1">
                <p>Con la financiación de:</p>
                <img src="images/madrid.png">
            </div>
            <div class="f2">
                <p>Web diseñada por:</p>
                <img src="images/tomaya.png">
            </div>
            <div class="f3">
                <p>Promueve:</p>
                <img src="images/av.png">
            </div>
        </div>

    </footer>

</body>