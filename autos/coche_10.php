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
            <p><strong>Nombre:</strong> Honda Civic</p>
            <p><strong>Marca:</strong> Honda</p>
            <p><strong>Modelo:</strong> 2023</p>
            <p><strong>Descripción:</strong> El Honda Civic es un automóvil compacto que ha logrado destacarse por su
                confiabilidad, eficiencia y diseño elegante. Como un pilar en la línea de Honda, el Civic ofrece una
                combinación de practicidad y estilo, brindando una experiencia de conducción equilibrada para aquellos
                que buscan un vehículo eficiente y agradable de manejar.</p>
            <h3>Especificaciones Clave:</h3>
            <p><strong>Motor:</strong> Ofrece opciones de motores eficientes, incluyendo motores de cuatro cilindros que
                proporcionan un equilibrio entre rendimiento y economía de combustible.</p>
            <p><strong>Transmisión:</strong> Disponible con transmisiones manuales o automáticas, proporcionando
                opciones de conducción adaptadas a las preferencias individuales.</p>
            <p><strong>Interior:</strong> El interior del Civic es conocido por su calidad de construcción, asientos
                cómodos y una disposición intuitiva, con tecnología moderna centrada en la conectividad y la comodidad
                del conductor.</p>
        </div>
        <img id="car-image" src="../img/coches-colores/car-10.png" alt="Coche Blanco">
        <div class="info">
            <h2>Honda Civic</h2>
            <p>Precio: $25,000</p>
            <p>Color:
                <select id="color-select">
                    <option value="blanco">Blanco</option>
                </select>
            </p>
            <button class="buy-button" data-id="10">Comprar</button>
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