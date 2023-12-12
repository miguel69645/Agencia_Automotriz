<?php
include '../connection.php';

$queryMarcas = 'SELECT DISTINCT Marca FROM vehiculos';
$resultMarcas = mysqli_query($conexion, $queryMarcas);

$marcas = array();

if ($resultMarcas->num_rows > 0) {
    while ($row = $resultMarcas->fetch_assoc()) {
        $marcas[] = $row["Marca"];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['modelo']) && isset($_POST['marca']) && isset($_POST['anio']) && isset($_POST['vehiculo'])) {
        obtenerServicios();
    }
}

function obtenerServicios()
{
    // Copy the function code here
    global $conexion;

    $selectedMarca = $_POST['marca'];
    $selectedModelo = $_POST['modelo'];
    $selectedAño = $_POST['anio'];
    $selectedVehiculo = $_POST['vehiculo'];

    $queryServicios = "SELECT DISTINCT s.Nombre FROM servicios s JOIN vehiculos v WHERE v.Marca = '$selectedMarca' AND v.Modelo = '$selectedModelo' AND v.Anio = '$selectedAño' AND v.Nombre = '$selectedVehiculo'";
    $resultServicios = mysqli_query($conexion, $queryServicios);

    $resultServicios = mysqli_query($conexion, $queryServicios);

    $servicios = array();

    if ($resultServicios->num_rows > 0) {
        while ($row = $resultServicios->fetch_assoc()) {
            $servicios[] = $row["Nombre"];
        }
    }

    echo json_encode($servicios);
    exit();
}
?>

<?php
// Inicia la sesión para acceder a sessionStorage
session_start();

// Obtén los datos de sessionStorage
$marca = $_SESSION["marca"] ?? "";
$modelo = $_SESSION["modelo"] ?? "";
$anio = $_SESSION["anio"] ?? "";
$vehiculo = $_SESSION["vehiculo"] ?? "";

// Limpia los datos de sessionStorage después de usarlos
unset($_SESSION["marca"]);
unset($_SESSION["modelo"]);
unset($_SESSION["anio"]);
unset($_SESSION["vehiculo"]);
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
                            <select name="marca" id="marca">
                                <option value="">Selecciona la marca del vehículo</option>
                                <?php
                                foreach ($marcas as $marca) {
                                    echo "<option value=\"$marca\">$marca</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label>Modelo</label>
                            <select name="modelo" id="modelo" class="hidden" disabled>
                                <option value="">Selecciona el modelo del vehículo</option>
                                <!-- Las opciones de modelo se cargarán dinámicamente mediante JavaScript -->
                            </select>
                        </div>
                        <div>
                            <label>Año</label>
                            <select name="anio" id="anio" class="hidden" disabled>
                                <option value="">Selecciona el año del vehículo</option>
                                <!-- Las opciones de año se cargarán dinámicamente mediante JavaScript -->
                            </select>
                        </div>
                        <div>
                            <label>Vehiculo</label>
                            <select name="vehiculo" id="vehiculo" class="hidden" disabled>
                                <option value="">Selecciona el vehículo</option>
                                <!-- Las opciones de año se cargarán dinámicamente mediante JavaScript -->
                            </select>
                        </div>
                        <div>
                            <label>Tipo de cita</label>
                            <select name="tipo_servicio" id="tipo_servicio" class="hidden" disabled>
                                <option value="">Selecciona el tipo de cita a realizar</option>
                            </select>
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
    <script src="../js/script2.js"></script>
    <script src="../js/coche.js"></script>

</body>

</html>