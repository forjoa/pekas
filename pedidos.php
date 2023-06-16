<?php
// Conecta a la base de datos
$conexion = new mysqli('localhost', 'root', '1234', 'pekasNew');
if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}

$clienteId = $_GET['clienteId'];

$resultado = $conexion->query("SELECT * FROM productos WHERE id IN (SELECT id_producto FROM pedidos WHERE id_cliente = '$clienteId')");
$productos = [];
while ($fila = $resultado->fetch_assoc()) {
    $productos[] = $fila;
}

$resultado_dos = $conexion->query("SELECT nombre FROM clientes WHERE id = '$clienteId'");
$nombre_user = "";
while ($fila = $resultado_dos->fetch_assoc()) {
    $nombre_user = $fila['nombre'];
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
    <title>Usuarios | Pedidos</title>
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

    <div class="pedidos-general">
        <h2>Bienvenido,
            <?php echo $nombre_user ?>, estos son tus pedidos:
        </h2>
        <table>
            <tbody class="pedido">
                <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td style="text-align: left;">
                            <img src="<?php echo substr($producto['imagen'], 3); ?>" />
                        </td>
                        <td style="text-align: left;">
                            <h3 style="margin: 0;">
                                <?php echo $producto['nombre']; ?>
                            </h3>
                        </td>
                        <td style="text-align: right;">
                            <?php echo $producto['descripcion'] . ':'; ?>
                        </td>
                        <td style="text-align: right;">
                            <strong>
                                <?php echo $producto['precio'] . '€'; ?>
                            </strong>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
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