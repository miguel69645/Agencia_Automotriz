<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../img/logo_bw.png" />
    <link rel="stylesheet" href="../css/styles.css">
    <title>Compra de Coche</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
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
            <p><strong>Nombre:</strong> Honda Accord 2023</p>
            <p><strong>Marca:</strong> Honda</p>
            <p><strong>Modelo:</strong> Accord 2023</p>
            <p><strong>Descripción:</strong> El Honda Accord 2023 continúa su legado como un sedán de tamaño medio que
                combina elegancia, rendimiento y tecnología. Con un diseño sofisticado y características avanzadas, el
                Accord ofrece una experiencia de conducción equilibrada, destacando tanto por su eficiencia como por su
                comodidad.</p>
            <h3>Especificaciones Clave:</h3>
            <p><strong>Motor:</strong> Ofrece opciones de motores eficientes, incluyendo motores de cuatro cilindros,
                proporcionando un rendimiento suave y eficiencia de combustible.</p>
            <p><strong>Transmisión:</strong> Disponible con transmisiones automáticas que ofrecen cambios precisos y una
                respuesta ágil, asegurando una experiencia de conducción placentera.</p>
            <p><strong>Interior:</strong> El interior del Accord 2023 se distingue por su diseño ergonómico y la
                incorporación de tecnologías modernas, incluyendo un avanzado sistema de infoentretenimiento y
                características de seguridad líderes en su clase.</p>
        </div>
        <img id="car-image" src="../img/coches-colores/car-12.png" alt="Coche Blanco">
        <div class="info">
            <h2>Honda Accord</h2>
            <p>Precio: $25,000</p>
            <p>Color:
                <select id="color-select">
                    <option value="blanco">Blanco</option>
                </select>
            </p>
            <button class="buy-button" data-id="12">Comprar</button>
        </div>
    </div>
    <footer>
        <p>© 2023 Agencia Wings. Derechos Reservados.</p>
    </footer>

    <script>
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