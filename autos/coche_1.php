<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="icon" type="image/x-icon" href="../img/logo_bw.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <title>Compra de Coche</title>
</head>

<body>
    <header>
        <div class="navbar">
            <a href="../cliente/index.php" class="logo">
                <img src="../img/logo_wb.png" alt="" class="logo" />
            </a>
            <ul>
                <li><a href="../cliente/index.php#vehiculo"><i class="fas fa-car-side"></i> Vehiculos</a></li>
                <li><a href="../cliente/autos.php"><i class="fas fa-car"></i> Modelos</a></li>
                <li><a href="../cliente/index.php#servicios"><i class="fas fa-cogs"></i> Servicios</a></li>
                <li><a href="../cliente/index.php#opiniones"><i class="fas fa-star"></i> Opiniones</a></li>
                <li><a href="../cliente/index.php#contactos"><i class="fas fa-envelope"></i> Contacto</a></li>
                <li><a href="../cliente/sobrenosotros.php"><i class="fas fa-info-circle"></i> Esto es Wings</a></li>
            </ul>
        </div>
    </header>
    <div class="car-details">
        <div class="car-info">
            <h2>Detalles:</h2>
            <p><strong>Nombre:</strong> Porsche 911</p>
            <p><strong>Marca:</strong> Porsche</p>
            <p><strong>Modelo:</strong> 911</p>
            <p><strong>Descripción:</strong> El Porsche 911, un ícono en el mundo automotriz, combina perfectamente un
                diseño atemporal con un rendimiento de vanguardia. Como modelo insignia de la prestigiosa marca Porsche,
                el 911 ha mantenido su distintiva silueta a lo largo de las generaciones, evolucionando continuamente
                para cumplir con los estándares modernos.</p>
            <h3>Especificaciones Clave:</h3>
            <p><strong>Motor:</strong> Motor bóxer de seis cilindros con turbocompresor.</p>
            <p><strong>Transmisión:</strong> Equipado con una transmisión manual precisa.</p>
            <p><strong>Interior:</strong> Fabricado con precisión y lujo en mente, el interior del 911 ofrece un
                equilibrio perfecto entre comodidad y un diseño centrado en el conductor.</p>
        </div>
        <img id="car-image" src="../img/coches-colores/car-1/blanco.png" alt="Coche Blanco">
        <div class="info">
            <h2>Porsche 911</h2>
            <p>Precio: $25,000</p>
            <p>Color:
                <select id="color-select" onchange="updateCarImage()">
                    <option value="blanco">Blanco</option>
                    <option value="gris">Gris</option>
                    <option value="negro">Negro</option>
                    <option value="rojo">Rojo</option>
                    <option value="azul">Azul</option>
                </select>
            </p>
            <button class="buy-button" data-id="2">Comprar</button>
        </div>
    </div>
    <footer>
        <p>© 2023 Agencia Wings. Derechos Reservados.</p>
    </footer>

    <script>
        function updateCarImage() {
            // Obtiene el elemento select
            var colorSelect = document.getElementById('color-select');

            // Obtiene el valor seleccionado
            var selectedColor = colorSelect.value;

            // Construye la ruta de la imagen según el color seleccionado
            var imagePath = '../img/coches-colores/car-1/' + selectedColor + '.png';

            // Obtiene el elemento de la imagen y actualiza su fuente
            var carImage = document.getElementById('car-image');
            carImage.src = imagePath;
            carImage.alt = 'Coche ' + selectedColor.charAt(0).toUpperCase() + selectedColor.slice(1);
        }

        // Detecta cuando se intenta utilizar el botón de retroceso del navegador
        window.onpopstate = function (event) {
            // Redirige nuevamente a la página actual para evitar la navegación del historial
            history.pushState(null, null, window.location.pathname);
        };

        setTimeout(function () {
            window.history.forward();
        }, 0);

        window.onunload = function () {
            null
        };
    </script>
    <script src="../js/coche.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</body>

</html>