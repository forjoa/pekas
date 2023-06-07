<?php
// Conecta a la base de datos
$conexion = new mysqli('localhost', 'root', '1234', 'pekasNew');
if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}

$busquedasRealizadas = [];

// Verifica si se envió el formulario de búsqueda
if (isset($_GET['producto-buscar'])) {
    $productoBuscado = $_GET['producto-buscar'];

    // Escapa caracteres especiales para evitar inyección de SQL
    $productoBuscado = $conexion->real_escape_string($productoBuscado);

    // Realiza la consulta de búsqueda en la base de datos
    $consulta = "SELECT * FROM productos WHERE nombre LIKE '%$productoBuscado%' OR descripcion LIKE '%$productoBuscado%'";
    $resultadoBusqueda = $conexion->query($consulta);

    // Verifica si se encontraron resultados
    if ($resultadoBusqueda->num_rows > 0) {
        // Muestra los resultados encontrados
        while ($fila = $resultadoBusqueda->fetch_assoc()) {
            $productos[] = $fila;
        }
    } else {
        echo 'No se encontraron resultados.';
    }
    
    $busquedasRealizadas[] = $productoBuscado;
    
} else {
    // Obtiene todos los productos de la base de datos
    $resultado = $conexion->query('SELECT * FROM productos ORDER BY id DESC');
    $productos = [];
    while ($fila = $resultado->fetch_assoc()) {
        $productos[] = $fila;
    }
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
    <title>Pekas | CONTACTO</title>
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
                <div class="navbar-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="nav-list">
                    <ul>
                        <li><a href="index.html">INICIO</a></li>
                        <li><a href="contacto.html">CONTACTO</a></li>
                        <li><a href="tienda.php">TIENDA</a></li>
                    </ul>
                </div>
            </div>
            <div class="right">
                <ul>
                    <li><a id="mi-cuenta">MI CUENTA</a></li>
                    <svg xmlns="http://www.w3.org/2000/svg" id="icono-carrito" class="icono-carrito" width="20"
                        height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <circle cx="6" cy="19" r="2" />
                        <circle cx="17" cy="19" r="2" />
                        <path d="M17 17h-11v-14h-2" />
                        <path d="M6 5l14 1l-1 7h-13" />

                    </svg>
                    <div class="numeros">
                        <div id="feedback-c"></div>
                    </div>
                </ul>
            </div>
        </div>
    </header>

    <!--modal para el inicio de sesión-->
    <dialog id="modal">
        <div class="modal-content">
            <h2>USUARIO</h2>
            <input type="text" placeholder="Usuario" id="usuario">
            <h2>CONTRASEÑA</h2>
            <input type="password" placeholder="Contraseña" id="contrasenia">
            <button id="login" onclick="login()">Iniciar Sesión</button>
            <a id="cerrar-ventana">Cerrar ventana</a>
        </div>
    </dialog>

    <dialog class="modal-general">
        <div id="carrito-modal" class="modal">
            <div class="modal-content">
                <span class="close" cursor="pointer">&times;</span>
                <h2>Carrito de compras</h2>
                <div id="carrito"></div>
                <input type="hidden" id="talla-seleccionada" />
                <hr>
                <div class="cont-total">
                    <p>Total: </p>
                    <strong>
                        <div id="total">€</div>
                    </strong>
                </div>
                <button id="boton-comprar">Comprar</button>
            </div>
        </div>
    </dialog>


    <div class="buscador">
        <span style="font-family: 'Ubuntu"> Busca producto: </span>
        <form method="GET" action="tienda.php">
            <?php foreach ($busquedasRealizadas as $busqueda): ?>
                <input type="hidden" name="producto-buscar" value="<?php echo htmlspecialchars($busqueda); ?>">
            <?php endforeach; ?>
            <input type="text" class="buscador-input" name="producto-buscar" />
            <span class="lupa" onclick="submitForm()"></span>
        </form>
    </div>

    <?php if (isset($_GET['producto-buscar'])): ?>
        <div class="migas-de-pan">
            <a href="tienda.php">Inicio</a> / <span>
                <?php foreach ($busquedasRealizadas as $busqueda): ?>
                    <a href="tienda.php?producto-buscar=<?php echo urlencode($busqueda); ?>"><?php echo $busqueda; ?></a> /
                <?php endforeach; ?>
            </span>
        </div>
    <?php endif; ?>

    <div class="productos">

        <?php foreach ($productos as $producto): ?>
            <div class="producto" data-aos="fade-up">
                <img src="<?php echo substr($producto['imagen'], 3); ?>" alt="">
                <h2>
                    <?php echo $producto['nombre']; ?>
                </h2>
                <p>
                    <?php echo $producto['descripcion']; ?>
                </p>
                <p>
                    Precio: € <span class="precio">
                        <?php echo $producto['precio']; ?>
                    </span>
                </p>

                <label>Talla:
                    <select name="talla">
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                    </select></label>

                <button class="boton-producto">Añadir</button>
            </div>
        <?php endforeach; ?>

    </div>

    <footer class="footer" data-aos="fade-up">

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


    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="scripts/tienda.js"></script>
    <script src="scripts/main.js"></script>
    <script>
        function submitForm() {
            document.querySelector('form').submit();
        }
    </script>
</body>

</html>