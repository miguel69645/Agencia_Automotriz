<?php
include '../connection.php';

session_start();
// Después de obtener los valores de sessionStorage
$marca = isset($_SESSION["marca"]) ? $_SESSION["marca"] : '';
$modelo = isset($_SESSION["modelo"]) ? $_SESSION["modelo"] : '';
$anio = isset($_SESSION["anio"]) ? $_SESSION["anio"] : '';
$vehiculo = isset($_SESSION["vehiculo"]) ? $_SESSION["vehiculo"] : '';
$servicio = isset($_SESSION["tipo_servicio"]) ? $_SESSION["tipo_servicio"] : '';
// $sucursal = isset($_SESSION["distribuidor"]) ? $_SESSION["distribuidor"] : '';
// Comprobar si los campos tienen datos antes de imprimir el script
if (!empty($marca)) {
    echo '<script>sessionStorage.setItem("marca", ' . json_encode($marca) . ');</script>';
}
if (!empty($modelo)) {
    echo '<script>sessionStorage.setItem("modelo", ' . json_encode($modelo) . ');</script>';
}
if (!empty($anio)) {
    echo '<script>sessionStorage.setItem("anio", ' . json_encode($anio) . ');</script>';
}
if (!empty($vehiculo)) {
    echo '<script>sessionStorage.setItem("vehiculo", ' . json_encode($vehiculo) . ');</script>';
}
if (!empty($servicio)) {
    echo '<script>sessionStorage.setItem("tipo_servicio", ' . json_encode($servicio) . ');</script>';
}
// if (!empty($sucursal)) {
//     echo '<script>sessionStorage.setItem("distribuidor", ' . json_encode($sucursal) . ');</script>';
// }
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Formulario Cita</title>
    <link rel="icon" type="image/x-icon" href="../img/logo_bw.png" />
    <link rel='stylesheet' type='text/css' media='screen' href='../css/style2.css'>
</head>

<body>
    <div id="page" class="site">
        <div class="container">
            <div class="form-box">
                <div class="progress">
                    <div class="logo"><a href="index.php"><span>Wings</span> Agency</a></div>
                    <ul class="progress-steps">
                        <li class="step active">
                            <span>1</span>
                            <p>Vehículo <br><span>Detalles del vehículo</span></p>
                        </li>
                        <li class="step">
                            <span>2</span>
                            <p>Distribuidor <br><span>Distribuidor y detalles</span></p>
                        </li>
                        <li class="step">
                            <span>3</span>
                            <p>Contacto <br><span>Contacto e información</span></p>
                        </li>
                    </ul>
                </div>
                <form action="../a_insertar/newFormulario.php" method="POST">
                    <div class="form-one form-step active">
                        <div class="bg-svg"></div>
                        <h2>Información del vehículo</h2>
                        <p>Ingrese los datos del automovil y servicio que busca</p>
                        <div>
                            <label>Marca</label>
                            <input type="text" id="marca" name="marca" value="<?php echo htmlspecialchars($marca); ?>" disabled>
                        </div>
                        <div>
                            <label>Modelo</label>
                            <input type="text" id="modelo" name="modelo"
                                value="<?php echo htmlspecialchars($modelo); ?>" disabled>
                        </div>
                        <div>
                            <label>Año</label>
                            <input type="text" id="anio" name="anio" value="<?php echo htmlspecialchars($anio); ?>" disabled>
                        </div>
                        <div>
                            <label>Vehículo</label>
                            <input type="text" id="vehiculo" name="vehiculo"
                                value="<?php echo htmlspecialchars($vehiculo); ?>" disabled>
                        </div>
                        <div>
                            <label>Tipo de cita</label>
                            <input type="text" name="tipo_servicio" id="tipo_servicio" class="hidden"
                                value="<?php echo htmlspecialchars($servicio); ?>" disabled>
                        </div>
                    </div>
                    <div class="form-two form-step">
                        <div class="bg-svg"></div>
                        <h2>Distribuidor Autorizado</h2>
                        <p>Seleccione un distribuidor y agende una cita</p>
                        <div>
                            <label>Distribuidor</label>
                            <select name="distribuidor" id="distribuidor" class="hidden" disabled>
                                <option value="">Seleccione el distribuidor al que desea dirigirse</option>
                            </select>
                        </div>
                        <div>
                            <label>Fecha de la cita</label>
                            <input type="date" id="dateInput" name="dateInput" min="" max="2024-04-30" class="hidden"
                                disabled>
                        </div>
                        <div>
                            <label>Hora de la cita</label>
                            <select name="time" id="time" class="hidden" disabled>
                                <option value="">Seleccione la hora de la cita</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-three form-step">
                        <div class="bg-svg"></div>
                        <h2>Información de contacto</h2>
                        <p>Ingrese sus datos de contacto</p>
                        <div>
                            <label>Nombre</label>
                            <input type="text" placeholder="Juan Ramon" id="name">
                        </div>
                        <div>
                            <label>Apellidos</label>
                            <input type="text" placeholder="Lopez Mendez" id="apellido">
                        </div>
                        <div>
                            <label>Numero de teléfono</label>
                            <input type="tel" placeholder="+523276547876" id="tel">
                        </div>
                        <div>
                            <label>Dirección de correcto electrónico</label>
                            <input type="email" placeholder="ejemplo@ejemplo.com" id="email">
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn-prev" disabled>Regresar</button>
                        <button type="button" class="btn-next" disabled>Continuar</button>
                        <button type="submit" class="btn-submit" disabled>Enviar</button>
                    </div>
                </form>
            </div>
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../js/script3.js"></script>

</body>

</html>