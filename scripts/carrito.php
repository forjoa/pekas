<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <div id="root">

    </div>
</body>
<script>
    
    const carrito = localStorage.getItem('carrito');
    var actual =window.location+'';
    var splitActual = actual.split('/');
    var id = splitActual[splitActual.length-1];
    $.ajax ({
        type: "POST",
        url: "../procesar_compra.php",
        data: {carro: carrito, idCliente: id},
        success: function (data) {
            console.log('bien');
            console.log(data);
        },
        error: function(error) {
            console.log('error '+error);
        }
    })
</script>

</html>