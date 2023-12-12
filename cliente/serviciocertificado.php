<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicio certificado</title>
    <link rel="icon" type="image/x-icon" href="../img/logo_bw.png" />
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="../css/style_certificado.css">

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
            <h1>Servicio certificado</h1>
            <p>
                En Wings, entendemos la importancia de la calidad y la eficiencia en cada servicio, <br>
                y contamos con el compromiso de la excelencia automotriz.
            </p>
        </div>
    </section>

    <section>
        <h2 class="section-title_5">
            MANEJA SEGURO
        </h2>

        <p class="project-description">
            Realiza el servicio básico cada 12 mil km o cada 12 meses
            y conserva tu garantía.
        </p>

        <div class="image-container">

            <div class="image-d">
                <img src="../img/prooptimo_.png" alt="Imagen 1">
                <h3>AUTOPARTES ORIGINALES</h3>

            </div>
            <div class="image-d">
                <img src="../img/sin_costo.png" alt="Imagen 2">
                <h3>SERVICIOS INCLUIDOS <br>SIN COSTO</h3>

            </div>
            <div class="image-d">
                <img src="../img/cobertura.png" alt="Imagen 3">
                <h3>ASISTENCIA <br> A NIVEL NACIONAL</h3>

            </div>
        </div>
    </section>

    <!-- Nueva sección con imágenes, nombres y descripciones -->
    <section class="image-section" id="descrip">
        <div>

        </div>
        <h2 class="section-title_2">
            Toma ventaja de los servicios incluidos para los <br>
            vehículos que wings tiene para ti.

        </h2>

        <p class="project-description">
            En Wings nos preocupamos por darte un servicio excepcional, es por ello que te otorgamos el Programa De
            Servicios Incluidos Wings:

        </p>

        <p class="project-description">
            Este programa comprende de dos servicios de mantenimiento básico y/o cambio de aceite y filtro sin costo;
            dichos beneficios son realizables dentro de los 24 meses posteriores a la fecha de compra de tu nuevo
            vehículo Wings (aplica para años modelo 2017 en adelante).

        </p>



    </section>

    <div>
        <h2 class="section-title_5">
            Acude al piso de servicio
        </h2>

        <p class="project-description">
            Algunas de las razones principales para redimir tus servicios incluidos Wings son las siguientes:
        </p>

        <ul class="project-description_9">
            <li>
                Lograrás mantener tu vehículo en optimas condiciones con refacciones 100% originales creadas
                específicamente para tu auto

            </li>
            <br>
            <li>
                Recibirás atención 100% personalizada por parte de nuestros técnicos certificados

            </li>
            <br>
            <li>
                Contamos con centros de servicio con la mas alta tecnología para tu auto

            </li>
        </ul>

        <p class="project-description">
            Consulta tu póliza de garantía para verificar cuando debes acudir a tu taller de servicio certificado Wings.
        </p>

        <p class="project-description">
            Para mayor información visita a tu distribuidor autorizado Wings o comunícate al centro de atención a
            clientes 800 466 0801.
        </p>
    </div>

    <section>
        <div class="more-info">
            <img src="../img/mecanica.jpg" alt="Ejemplo 2">
            <a href="../cliente/formulario.php" style="text-decoration: none;"><button class="btn_3">Agenda tu cita de
                    servicio</button></a>

        </div>
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

    <script>
        AOS.init({
            duration: 800,
        });
    </script>
</body>

</html>