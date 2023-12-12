<?php
include '../connection.php';

$querySucursal = 'SELECT DISTINCT Nombre FROM sucursal';
$resultSucursal = mysqli_query($conexion, $querySucursal);

$sucursal = array();

if ($resultSucursal->num_rows > 0) {
    while ($row = $resultSucursal->fetch_assoc()) {
        $sucursal[] = $row["Nombre"];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba de Manejo</title>
    <link rel="icon" type="image/x-icon" href="../img/logo_bw.png" />
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="../css/prueba.css">

    <!-- chatbot -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,1,0" />
    <link rel="stylesheet" href="../css/chat.css" />
    <script src="../js/chat.js" defer></script>
</head>

<body>
    <section>
        <div class="banner2">
            <div class="navbar">
                <a href="../cliente/index.php" class="logo">
                    <img src="../img/logo_wb.png" alt="" class="logo" />
                </a>
                <ul>
                    <li><a href="index.php#vehiculo"><i class="fas fa-car-side"></i> Vehiculos</a></li>
                    <li><a href="autos.php"><i class="fas fa-car"></i> Modelos</a></li>
                    <li><a href="index.php#servicios"><i class="fas fa-cogs"></i> Servicios</a></li>
                    <li><a href="index.php#opiniones"><i class="fas fa-star"></i> Opiniones</a></li>
                    <li><a href="index.php#contactos"><i class="fas fa-envelope"></i> Contacto</a></li>
                    <li><a href="sobrenosotros.php"><i class="fas fa-info-circle"></i> Esto es Wings</a></li>
                </ul>
            </div>
        </div>

        <div class="content">
            <h1>Solicita tu prueba de manejo
            </h1>
            <p>
                Atrévete a vivir la experiencia de conducir un auto y ponte al volante <br> SUV o Pick Up que siempre
                quisiste

            </p>
        </div>
    </section>

    <!-- Nueva sección con imágenes, nombres y descripciones -->
    <section class="image-section" id="descrip" style="margin-top: 0px;padding-bottom: 10px;">
        <h2 class="section-title_2">
            Prueba de manejo
        </h2>

        <hr class="linea-divisora">

    </section>

    <form action="../a_insertar/newPrueba.php" method="POST">
        <section class="form-section">
            <div class="form-left">
                <div class="form-group">
                    <label for="distribuidor">Distribuidor*</label>
                    <select id="distribuidor" name="distribuidor" required>
                        <option value="">Selecciona el distribuidor</option>
                        <?php
                        foreach ($sucursal as $sucursal) {
                            echo "<option value=\"$sucursal\">$sucursal</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label for="vehiculo">Vehiculo*</label>
                        <select id="vehiculo" name="vehiculo" disabled required>
                            <option value="">Selecciona el vehiculo</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fechaPrueba">Fecha de Prueba de Manejo*</label>
                    <input type="date" id="fechaPrueba" name="fechaPrueba" placeholder="DD/MM/AAAA" min="" max="2024-04-30" required>
                </div>
                <div class="form-group">
                    <label for="horario">Elige horario para tu Prueba de Manejo*</label>
                    <select id="horario" name="horario" disabled required>
                        <option value="">Seleccionar el horario de la cita</option>

                    </select>
                </div>
            </div>
            <div class="form-right">
                <div class="form-group">
                    <label for="nombres">Nombre(s)*</label>
                    <input type="text" id="nombres" name="nombres" required=="required">
                </div>
                <div class="form-group">
                    <label for="apellido">Apellidos*</label>
                    <input type="text" id="apellido" name="apellido" required>
                </div>
                <div class="form-group">
                    <label for="email">Email*</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono*</label>
                    <input type="tel" id="telefono" name="telefono" required>
                </div>
            </div>
            <div class="form-group" style="width: 330px; height: 200px; margin-right: 100px;">
                <img id="vehiculo-imagen" src="" alt="Imagen del vehículo" style="width: 330px; height: 200px;">
            </div>
        </section>
        <hr class="linea-divisora">
        <p class="project-description">
            Los campos con * son obligatorios
        </p>
        <button type="submit"> Enviar </button>
    </form>


    <h2 class="section-title_3" style="font-family: sans-serif;">
        Déjanos tus datos y descubre algo extraordinario <br> desde el primer viaje.

    </h2>

    <p class="project-description_2">
        Nuestros vehículos ofrecen una dinámica experiencia de manejo que garantiza potencia, seguridad y dinamismo en
        cada trayecto.
        <br>
        ¿Cuál quieres manejar?
    </p>

    <section class="info-section">
        <!-- Cuadro de color e imagen a la derecha -->
        <div class="info-box">
            <img src="../img/img-3.jpg" alt="Ejemplo 1">
            <div class="box-content">
                <h3>Autos
                </h3>
                <p>
                    Ponte al volante de uno de los autos nuevos que Wings México tiene para ti, todos con un diseño
                    moderno y atractivo que va con tu personalidad. Por encima de todo, nuestros coches garantizan una
                    experiencia de manejo llena de dinamismo y seguridad desde el primer momento. ¿Cuál eliges?
                </p>
            </div>
        </div>

        <!-- Cuadro de color e imagen a la izquierda -->
        <div class="info-box reversed">
            <img src="../img/img-2.jpg" alt="Ejemplo 2">
            <div class="box-content">
                <h3>SUV's
                </h3>
                <p>
                    Decídete a probar la placentera experiencia de conducción de las SUV´s y Crossover de Wings México y
                    disfruta de su atractivo diseño que se adecua a tu estilo con el más alto nivel de tecnología,
                    confort y sofisticación de su categoría para que descubras algo extraordinario desde que la
                    enciendes. ¿Con cuál te quedas?


                </p>
            </div>
        </div>


        <!-- Cuadro de color e imagen a la derecha -->
        <div class="info-box">
            <img src="../img/img_3.jpg" alt="Ejemplo 1">
            <div class="box-content">
                <h3>Camionetas

                </h3>
                <p>
                    Conoce la versatilidad de las Camionetas, y Vehículos Comerciales que Wings México tiene para
                    ayudarte con el trabajo duro. Pruébalos y evalúa la eficiencia del poderoso motor bajo su cofre, la
                    adaptabilidad de su diseño, o bien, su gran capacidad de carga y arrastre. Te convencerán desde el
                    primer viaje. ¿Por cuál te decides?


                </p>
            </div>
        </div>


        <!-- Cuadro de color e imagen a la izquierda -->
        <div class="info-box reversed">
            <img src="../img/performance.jpg" alt="Ejemplo 2">
            <div class="box-content">
                <h3>Performance
                </h3>
                <p>
                    Déjate sorprender por Ford Performance y experimenta la Potencia, Tecnología y Dinamismo que ofrecen
                    sus vehículos de Alto Desempeño. Siéntete como un verdadero piloto de carreras al volante de
                    nuestros Autos Deportivos y eleva la adrenalina al máximo desde el primer momento. ¿Te atreves a
                    vivir la aventura?



                </p>
            </div>
        </div>
    </section>

    <section class="final">
        <h2 class="section-title_4" style="font-family: sans-serif;">
            Haz una Prueba de Manejo y vive la experiencia <br> de conducir el auto que deseas

        </h2>

        <p class="project-description_2">
            Disfruta de su diseño exterior, ponte al volante acomodando el asiento, enciende el motor y presiona los
            pedales para emprender tu <br>
            primer viaje. Conduce, siente cómo su confortable interior y su tecnología van contigo. Mírate en los
            espejos y ¡descubre cómo te ves en <br>
            el auto que quieres!


        </p>
    </section>

    <section>
        <button class="chatbot-toggler">
            <span class="material-symbols-rounded">mode_comment</span>
            <span class="material-symbols-outlined">close</span>
        </button>
        <div class="chatbot">
            <header>
                <h2>Chat</h2>
                <span class="close-btn material-symbols-outlined">close</span>
            </header>
            <ul class="chatbox">
                <li class="chat incoming">
                    <span class="material-symbols-outlined">
                        <img src="../img/persona.png" alt="Descripción de la imagen" />
                    </span>
                    <p>Hola 👋<br />¿Como puedo ayudarte?</p>
                </li>
            </ul>
            <div class="chat-input">
                <textarea placeholder="Enter a message..." spellcheck="false" required></textarea>
                <span id="send-btn" class="material-symbols-rounded">send</span>
            </div>
        </div>
    </section>

    <script>
        // Detecta cuando se intenta utilizar el botón de retroceso del navegador
        window.onpopstate = function (event) {
            // Redirige nuevamente a la página actual para evitar la navegación del historial
            history.pushState(null, null, window.location.pathname);
        };
    </script>
    <script>
        setTimeout(function () {
            window.history.forward();
        }, 0);
        window.onunload = function () {
            null
        };
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="../js/prueba.js"></script>

    <script>
        AOS.init({
            duration: 800,
        });
    </script>

</body>

</html>