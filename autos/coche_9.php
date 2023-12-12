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
            <p><strong>Nombre:</strong> Volkswagen Golf</p>
            <p><strong>Marca:</strong> Volkswagen</p>
            <p><strong>Modelo:</strong> 2023</p>
            <p><strong>Descripción:</strong> El Volkswagen Golf es un automóvil compacto que ha ganado renombre por su
                versatilidad, eficiencia y diseño práctico. Como uno de los modelos más emblemáticos de Volkswagen, el
                Golf ofrece una combinación equilibrada de rendimiento, comodidad y tecnología, siendo una opción
                popular para aquellos que buscan un vehículo compacto y ágil.</p>
            <h3>Especificaciones Clave:</h3>
            <p><strong>Motor:</strong> Ofrece opciones de motores eficientes, incluyendo motores de gasolina y diésel,
                que brindan un equilibrio entre rendimiento y eficiencia de combustible.</p>
            <p><strong>Transmisión:</strong> Disponible con transmisiones manuales o automáticas, proporcionando
                opciones de conducción adaptadas a las preferencias individuales.</p>
            <p><strong>Interior:</strong> El interior del Golf destaca por su funcionalidad y calidad de construcción,
                con asientos cómodos y tecnología intuitiva para una experiencia de conducción placentera.</p>
        </div>
        <img id="car-image" src="../img/coches-colores/car-9.png" alt="Coche Blanco">
        <div class="info">
            <h2>Volkswagen Golf</h2>
            <p>Precio: $25,000</p>
            <p>Color:
                <select id="color-select">
                    <option value="blanco">Blanco</option>
                </select>
            </p>
            <button class="buy-button" data-id="9">Comprar</button>
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