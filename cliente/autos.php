<?php
include '../connection.php';

$sql = "SELECT cv.Nombre, v.Fotografia, v.Precio, v.Modelo, v.ID_Vehiculo FROM categoriavehiculo cv
        JOIN vehiculos v ON cv.ID_Categoria = v.ID_Categoria";

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <link rel="stylesheet" href="../css/style.css" />
  <!-- <script src="//code.tidio.co/mn4rawekegvh6qn8txduywipa9zguikj.js" async></script> -->

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
      <a href="index.php#vehiculo"><i class="fas fa-car-side"></i> Vehiculos</a>
      <a href="index.php#servicios"><i class="fas fa-cogs"></i> Servicios</a>
      <a href="index.php#opiniones"><i class="fas fa-star"></i> Opiniones</a>
      <a href="#contactos"><i class="fas fa-envelope"></i> Contacto</a>
      <a href="sobrenosotros.php"><i class="fas fa-info-circle"></i> Esto es Wings</a>
    </nav>

    <div class="btns">
      <div id="acceder-btn">
        <buttom class="btn">Acceder</buttom>
        <i class="far fa-user"></i>
      </div>

      <buttom class="switch" id="switch">
        <span><i class="fas fa-sun"></i></span>
        <span><i class="fas fa-moon"></i></span>
      </buttom>
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

  <section class="vehiculo" id="vehiculo">
    <h2 class="heading">Vehiculos</h2>
    <div class="swiper-pagination"></div>
  </section>

  <section class="modelos" id="modelos">
    <h2 class="heading">Todos los modelos</h2>

    <?php
    // Inicializa un array para almacenar vehículos por categoría
    $vehiculosPorCategoria = array();

    while ($row = mysqli_fetch_assoc($result)) {
      $categoriaNombre = $row['Nombre'];

      // Verifica si la categoría ya existe en el array
      if (!isset($vehiculosPorCategoria[$categoriaNombre])) {
        $vehiculosPorCategoria[$categoriaNombre] = array();
      }

      // Agrega el vehículo a la categoría correspondiente
      $vehiculosPorCategoria[$categoriaNombre][] = $row;
    }

    // Recorre las categorías y genera las diapositivas del slider
    foreach ($vehiculosPorCategoria as $categoriaNombre => $vehiculos) {
      echo '<div class="swiper mySwiper modelos-slider">';
      echo '<h3 class="heading">' . $categoriaNombre . '</h3>';
      echo '<div class="swiper-wrapper">';

      foreach ($vehiculos as $vehiculo) {
        $modelo = $vehiculo['Modelo'];
        $precio = $vehiculo['Precio'];

        echo '<div class="swiper-slide caja">';
        echo '<img src="../img/' . $vehiculo['Fotografia'] . '" onerror="this.src=\'../img/noimage.png\'">';
        echo '<h3>' . $modelo . '</h3>';
        echo '<div class="star">';
        // Genera estrellas dinámicamente
        for ($i = 0; $i < 5; $i++) {
          echo '<i class="fas fa-star"></i>';
        }
        echo '</div>';
        echo '<div class="precio">$' . $precio . '</div>';
        echo '<a href="../autos/coche_' . $vehiculo['ID_Vehiculo'] . '.php" class="btn">Verificar</a>';
        echo '</div>';
      }

      echo '</div>';
      echo '<div class="swiper-pagination"></div>';
      echo '</div>';
    }
    ?>
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
        <a href="index.php#inicio"> <i class="fas fa-arrow-right"></i> Inicio </a>
        <a href="index.php#vehiculos"> <i class="fas fa-arrow-right"></i> Vehiculos </a>
        <a href="index.php#modelos"> <i class="fas fa-arrow-right"></i> Modelos </a>
        <a href="index.php#servicios"> <i class="fas fa-arrow-right"></i> Servicios </a>
        <a href="index.php#opiniones"> <i class="fas fa-arrow-right"></i> Opiniones </a>
        <a href="index.php#contactos"> <i class="fas fa-arrow-right"></i> Contacto </a>
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
          <img src="../img/persona.png" alt="Descripción de la imagen">
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