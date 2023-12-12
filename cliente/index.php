<?php
include '../connection.php';

$sql = "SELECT * FROM vehiculos";
$result = mysqli_query($conexion, $sql);

if (!$result) {
  die('Error in SQL query: ' . mysqli_error($conexion));
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Wings Performance Motors</title>
  <link rel="icon" type="image/x-icon" href="../img/logo_bw.png" />
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <link rel="stylesheet" href="../css/style.css" />

  <!-- chatbot -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,1,0" />
  <link rel="stylesheet" href="../css/chat.css" />
  <script src="../js/chat.js" defer></script>
</head>

<body>
  <header class="site-header">
    <div id="menu-btn" class="fas fa-bars"></div>

    <a href="../cliente/index.php" class="logo">
      <img src="../img/logo_bw.png" alt="" />
    </a>

    <nav class="navbar">
      <a href="#vehiculo"><i class="fas fa-car-side"></i> Vehiculos</a>
      <a href="autos.php"><i class="fas fa-car"></i> Modelos</a>
      <a href="#servicios"><i class="fas fa-cogs"></i> Servicios</a>
      <a href="#opiniones"><i class="fas fa-star"></i> Opiniones</a>
      <a href="#contactos"><i class="fas fa-envelope"></i> Contacto</a>
      <a href="sobrenosotros.php"><i class="fas fa-info-circle"></i> Esto es Wings</a>
    </nav>

    <div class="btns">
      <div id="acceder-btn">
        <button class="btn">Acceder</button>
        <i class="far fa-user"></i>
      </div>

      <button class="switch" id="switch">
        <span><i class="fas fa-sun"></i></span>
        <span><i class="fas fa-moon"></i></span>
      </button>
    </div>

  </header>

  <div class="acceder-form-container">
    <span class="fas fa-times" id="close-acceder-form"></span>
    <form action="../login.php" method="post">
      <h3>Ingresar usuario</h3>
      <input type="email" id="correo" name="correo" placeholder="Correo electronico" class="caja" />
      <input type="password" id="contrasena" name="contrasena" placeholder="Contraseña" class="caja" />
      <input type="submit" value="Ingresar" class="btn" />
      <a href="citas.php"><button type="button" class="btn">Consulta tu cita</button></a>
    </form>
  </div>

  <section class="inicio" id="inicio">
    <h1 class="incio-site">LOS MEJORES AUTOMOVILES</h1>

    <img class="incio-site" data-aos="flip-left" data-aos-delay="450" src="../img/home-img.png" alt="inicio" />

    <a href="autos.php" class="btn incio-site">Ver mas autos</a>
  </section>

  <section class="iconos-container">
    <div class="iconos">
      <i class="fas fa-home"></i>
      <div class="content">
        <h3>300+</h3>
        <p>sucursales</p>
      </div>
    </div>

    <div class="iconos">
      <i class="fas fa-car"></i>
      <div class="content">
        <h3>4770+</h3>
        <p>Autos vendidos</p>
      </div>
    </div>

    <div class="iconos">
      <i class="fas fa-users"></i>
      <div class="content">
        <h3>320+</h3>
        <p>clientes satisfechos</p>
      </div>
    </div>

    <div class="iconos">
      <i class="fas fa-car"></i>
      <div class="content">
        <h3>1500+</h3>
        <p>nuevos autos</p>
      </div>
    </div>
  </section>

  <section class="vehiculo" id="vehiculo">
    <h2 class="heading">Vehiculos</h2>

    <div class="swiper mySwiper vehiculo-slider">
      <div class="swiper-wrapper">
        <?php
        $count = 0;
        while ($row = mysqli_fetch_assoc($result)) {
          if ($count < 8) {
            $imageURL = "../img/" . $row['Fotografia'];
            $defaultImageURL = "../img/noimage.png";
            ?>
            <div class="swiper-slide caja">
              <img src="<?php echo $imageURL; ?>" onerror="this.src='<?php echo $defaultImageURL; ?>'" alt=""
                style="max-width: 300px; height: auto;" />
              <div class="content">
                <h3>
                  <?php echo $row['Nombre']; ?>
                </h3>
                <div class="precio"><span>precio: </span> $
                  <?php echo $row['Precio']; ?>
                </div>
                <p>
                  Nuevo
                  <span class="fas fa-circle"></span>
                  <?php echo $row['Anio']; ?>
                  <span class="fas fa-circle"></span>
                  <?php echo $row['Modelo']; ?>
                  <span class="fas fa-circle"></span>
                  <?php echo $row['Version']; ?>
                  <span class="fas fa-circle"></span>
                  <?php echo $row['TipoMotor']; ?>
                </p>
                <a href="../autos/coche_<?php echo $row['ID_Vehiculo']; ?>.php" class="btn">Verificar</a>
              </div>
            </div>
            <?php
            $count++;
          } else {
            break; // Sale del bucle si ya se mostraron 8 coches
          }
        }
        ?>
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </section>

  <section class="modelos" id="modelos">
    <div class="swiper-pagination"></div>
  </section>

  <section class="servicios" id="servicios">
    <h2 class="heading">Nuestros Servicios</h2>

    <div class="caja-container">
      <div class="caja">
        <i class="fas fa-car"></i>
        <h3>Venta de Automoviles</h3>
        <p>
          Nuestro inventario incluye una amplia gama de vehículos de las
          principales marcas. Todos nuestros vehículos están cuidadosamente
          inspeccionados y certificados para garantizar tu tranquilidad y
          satisfacción.
        </p>
        <a href="ventaautos.php" class="btn">Leer mas</a>
      </div>

      <div class="caja">
        <i class="fas fa-tools"></i>
        <h3>Reparacion</h3>
        <p>
          Nuestro equipo altamente capacitado de mecánicos y técnicos
          automotrices está listo para poner en marcha tu vehículo y hacer que
          vuelva a la carretera en condiciones óptimas. Ya sea que necesites
          una reparación importante o simplemente un mantenimiento de rutina,
          estamos equipados con la experiencia y las herramientas necesarias
          para hacer el trabajo correctamente y a tiempo.
        </p>
        <a href="pw.php#reparacion" class="btn">Leer mas</a>
      </div>

      <div class="caja">
        <i class="fas fa-car-crash"></i>
        <h3>Automoviles Asegurados</h3>
        <p>
          Entendemos la importancia de su vehículo en su vida diaria. Ya sea
          que lo use para desplazarse al trabajo, llevar a su familia de un
          lugar a otro, o simplemente disfrutar de la libertad de la carretera
          abierta, su automóvil es una parte esencial de su vida.
        </p>
        <a href="seguro.php" class="btn">Leer mas</a>
      </div>

      <div class="caja">
        <i class="fas fa-car-battery"></i>
        <h3>Reemplazo de Baterias</h3>
        <p>
          Una batería en buen estado es esencial para garantizar que tu
          vehículo arranque sin problemas y funcione correctamente en cada
          viaje. Si notas que tu automóvil está teniendo dificultades para
          arrancar o si la batería tiene más de tres años, es hora de
          considerar su reemplazo.
        </p>
        <a href="pw.php#baterias" class="btn">Leer mas</a>
      </div>

      <div class="caja">
        <i class="fas fa-gas-pump"></i>
        <h3>Cambio de Aceite</h3>
        <p>
          Un elemento fundamental para asegurar un rendimiento óptimo de tu
          vehículo es el aceite del motor. Un cambio de aceite regular es
          esencial para mantener tu motor funcionando sin problemas y
          prolongar su vida útil.
        </p>
        <a href="pw.php#aceite" class="btn">Leer mas</a>
      </div>

      <div class="caja">
        <i class="fa-solid fa-gauge"></i>
        <h3>Prueba de Manejo</h3>
        <p>
          ¿Estás listo para experimentar la emoción de conducir tu próximo
          coche? Estamos encantados de ofrecerte la oportunidad de reservar
          una prueba de manejo personalizada y poner a prueba el vehículo de
          tus sueños. Nuestra prioridad es que te sientas seguro y emocionado
          al tomar tu decisión de compra.
        </p>
        <a href="prueba.php" class="btn">Leer mas</a>
      </div>

      <div class="caja">
        <i class="fas fa-cogs"></i>
        <h3>Servicio Certificado</h3>
        <p>
          En Wings Agency, nos enorgullece ofrecer un servicio certificado excepcional
          que va más allá de las expectativas. Nuestro compromiso con la calidad y la
          satisfacción del cliente es inquebrantable, y es por eso que hemos desarrollado
          nuestro servicio certificado para garantizar que su experiencia con nosotros sea
          insuperable.
        </p>
        <a href="serviciocertificado.php" class="btn">Leer mas</a>
      </div>

      <div class="caja">
        <i class="fas fa-headset"></i>
        <h3>Soporte 24/7</h3>
        <p>
          Nuestro equipo de expertos en automóviles está a tu disposición en
          todo momento para ayudarte con cualquier pregunta, problema o
          solicitud que puedas tener. Ya sea que necesites asistencia con la
          programación de mantenimiento, la información sobre nuestros últimos
          modelos, o incluso en caso de una emergencia en la carretera,
          estamos a solo un clic o una llamada de distancia.
        </p>
        <a href="atencion.php" class="btn">Leer mas</a>
      </div>
    </div>
  </section>

  <section class="opiniones" id="opiniones">
    <h2 class="heading">Opiniones de clientes</h2>

    <div class="swiper opiniones-slider">
      <div class="swiper-wrapper">
        <div class="swiper-slide slide">
          <i class="fas fa-quote-right"></i>
          <div class="usuario">
            <img src="../img/pic-1.png" alt="" />
            <div class="usuario-info">
              <h3>Juan Pérez</h3>
              <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
              </div>
            </div>
          </div>
          <p>
            La experiencia en línea de esta agencia es increíble. Pude navegar
            fácilmente por su sitio web, ver las opciones disponibles y
            programar una cita en cuestión de minutos. ¡Muy conveniente!
          </p>
        </div>

        <div class="swiper-slide slide">
          <i class="fas fa-quote-right"></i>
          <div class="usuario">
            <img src="../img/pic-2.png" alt="" />
            <div class="usuario-info">
              <h3>María Rodríguez</h3>
              <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
              </div>
            </div>
          </div>
          <p>
            Estoy muy impresionada con el servicio de esta agencia. El
            personal fue extremadamente amable y me ayudaron a encontrar el
            automóvil perfecto para mis necesidades. ¡Definitivamente volveré!
          </p>
        </div>

        <div class="swiper-slide slide">
          <i class="fas fa-quote-right"></i>
          <div class="usuario">
            <img src="../img/pic-3.png" alt="" />
            <div class="usuario-info">
              <h3>Carlos Martínez</h3>
              <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
              </div>
            </div>
          </div>
          <p>
            El servicio postventa de esta agencia es excepcional. Cuando tuve
            un problema con mi automóvil, lo solucionaron de manera rápida y
            eficiente. Definitivamente confío en ellos para futuras compras.
          </p>
        </div>

        <div class="swiper-slide slide">
          <i class="fas fa-quote-right"></i>
          <div class="usuario">
            <img src="../img/pic-4.png" alt="" />
            <div class="usuario-info">
              <h3>Laura Gómez</h3>
              <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
              </div>
            </div>
          </div>
          <p>
            La agencia automotriz ofrece una amplia gama de vehículos y
            opciones de financiamiento. Encontré el automóvil de mis sueños a
            un precio que se ajustaba a mi presupuesto. ¡Muy satisfecha con mi
            compra!
          </p>
        </div>

        <div class="swiper-slide slide">
          <i class="fas fa-quote-right"></i>
          <div class="usuario">
            <img src="../img/pic-5.png" alt="" />
            <div class="usuario-info">
              <h3>Alejandro Pérez</h3>
              <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
              </div>
            </div>
          </div>
          <p>
            Mi experiencia con esta agencia automotriz fue excepcional. Desde
            el momento en que ingresé, me trataron con profesionalismo y
            cortesía. Encontré el vehículo que estaba buscando y el proceso de
            compra fue sin complicaciones.
          </p>
        </div>

        <div class="swiper-slide slide">
          <i class="fas fa-quote-right"></i>
          <div class="usuario">
            <img src="../img/pic-6.png" alt="" />
            <div class="usuario-info">
              <h3>Ana García</h3>
              <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
              </div>
            </div>
          </div>
          <p>
            La atención al cliente de esta agencia es de primera clase.
            Respondieron todas mis preguntas y preocupaciones de manera
            profesional y amable. ¡Me hicieron sentir segura en mi decisión de
            compra!
          </p>
        </div>
      </div>
    </div>
  </section>

  <section class="contactos" id="contactos">
    <h2 class="heading">Contactanos</h2>
    <form action="mailto:wings_performance@gmail.com" method="post">
      <h3>Ponerse en contacto</h3>
      <input type="text" placeholder="Escribe tu nombre" class="box" />
      <input type="email" placeholder="Escribe tu correo electronico" class="box" />
      <input type="tel" placeholder="Telefono" class="box" />
      <textarea placeholder="Tu mensaje" class="box" cols="30" rows="10"></textarea>
      <input type="submit" value="Enviar" class="btn" />
    </form>
  </section>

  <section class="footer" id="footer">
    <div class="box-container">
      <div class="box">
        <h3>Sucursales</h3>
        <a href="#"> <i class="fas fa-map-marker-alt"></i> Tepic, Nayarit </a>
        <a href="#"> <i class="fas fa-map-marker-alt"></i> Guadalajara, Jalisco </a>
        <a href="#"> <i class="fas fa-map-marker-alt"></i> Monterrey, N.L. </a>
        <a href="#"> <i class="fas fa-map-marker-alt"></i> Santiago de Queretaro, Queretaro </a>
      </div>

      <div class="box">
        <h3>Enlaces rápidos</h3>
        <a href="#inicio"> <i class="fas fa-arrow-right"></i> Inicio </a>
        <a href="#vehiculos"> <i class="fas fa-arrow-right"></i> Vehiculos </a>
        <a href="#modelos"> <i class="fas fa-arrow-right"></i> Modelos </a>
        <a href="#servicios"> <i class="fas fa-arrow-right"></i> Servicios </a>
        <a href="#opiniones"> <i class="fas fa-arrow-right"></i> Opiniones </a>
        <a href="#contactos"> <i class="fas fa-arrow-right"></i> Contacto </a>
      </div>

      <div class="box" style="padding-right: 70px;">
        <h3>Informacion de contacto</h3>
        <a href="#"> <i class="fas fa-phone"></i> +52 327-987-5467 </a>
        <a href="#"> <i class="fas fa-phone"></i> +52 311-963-7891 </a>
        <a href="#"> <i class="fas fa-envelope"></i> wings_performance@gmail.com </a>
        <a href="#"> <i class="fas fa-map-marker-alt"></i> Av. Tecnológico No. 2595, 63175 Tepic, Nay. </a>
      </div>

      <div class="box">
        <h3>Nuestras redes sociales</h3>
        <a href="#"> <i class="fab fa-facebook-f"></i> Facebook </a>
        <a href="#"> <i class="fab fa-twitter"></i> Twitter </a>
        <a href="#"> <i class="fab fa-instagram"></i> Instagram </a>
        <a href="#"> <i class="fab fa-linkedin"></i> Linkedin </a>
        <a href="#"> <i class="fab fa-pinterest"></i> Pinterest </a>
      </div>
    </div>

    <footer>
      <div class="credit">
        © 2023 Wings Performance Motors. All rights reserved.
      </div>
    </footer>
  </section>

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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <script src="../js/script.js"></script>

  <script>
    AOS.init({
      duration: 800,
    });
  </script>
</body>

</html>