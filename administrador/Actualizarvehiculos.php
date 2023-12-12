<?php
include '../connection.php';

$charactersToRemove = array('{', '}');
$id = isset($_GET["ID_Vehiculo"]) ? intval($_GET["ID_Vehiculo"]) : null;

if (!$id) {
    // Si el ID no se pasa o no es válido, puedes mostrar un mensaje de error o redirigir al usuario.
    echo "ID de vehículo no válido o no proporcionado.";
    exit; // Puedes agregar una redirección o mensaje personalizado aquí si lo deseas.
}

$query = "SELECT * FROM vehiculos WHERE ID_Vehiculo = $id";
$result = mysqli_query($conexion, $query);

if ($row = mysqli_fetch_assoc($result)) {
    $nombre = $row['Nombre'];
    $precio = $row['Precio'];
    $descripcion = $row['Descripcion'];
    $fotografia = $row['Fotografia'];
    $color = $row['Color'];
    $modelo = $row['Modelo'];
    $version = $row['Version'];
    $marca = $row['Marca'];
    $tipomotor = $row['TipoMotor'];
    $anio = $row['Anio'];
    $pasajeros = $row['Pasajeros'];
    $categoria = $row['ID_Categoria'];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../img/logo_bw.png">
    <link rel="stylesheet" href="../css/actualizar.css">
    <title>Agencia Automotriz</title>
</head>

<body>
    <header>
        <div class="header-left">
            <a href=""><img src="../img/logo_wb.png" alt="Imagen izquierda" class="header-image"></a>
        </div>
        <h1>Wings Performance Motors</h1>
    </header>

    <main>
        <section class="login-section">
            <div class="login-container">
                <h2>Actualizar Vehiculos</h2>
                <form action="../a_actualizar/vehiculoupdate.php?ID_Vehiculo=<?=$id?>" method="post" class="login-form" id="vehiculos-form">
                    <div class="input-container">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" value="<?php echo isset($nombre) ? $nombre : ''; ?>" required>
                    </div>
                    <div class="input-container">
                        <label for="precio">Precio:</label>
                        <input type="number" id="precio" name="precio" value="<?php echo isset($precio) ? $precio : ''; ?>" required>
                    </div>
                    <div class="input-container">
                        <label for="descripcion">Descripcion:</label>
                        <input type="text" id="descripcion" name="descripcion" value="<?php echo isset($descripcion) ? $descripcion : ''; ?>" required>
                    </div>
                    <div class="input-container">
                        <label for="fotografia">Fotografia:</label>
                        <input type="file" id="fotografia" name="fotografia" accept="image/*" value="<?php echo isset($fotografia) ? $fotografia : ''; ?>" onclick="actualizarImg()" required>
                    </div>
                    <div class="input-container">
                        <label for="color">Color:</label>
                        <input type="text" id="color" name="color" value="<?php echo isset($color) ? $color : ''; ?>" required>
                    </div>
                    <div class="input-container">
                        <label for="modelo">Modelo:</label>
                        <input type="text" id="modelo" name="modelo" value="<?php echo isset($modelo) ? $modelo : ''; ?>" required>
                    </div>
                    <div class="input-container">
                        <label for="version">Version:</label>
                        <input type="text" id="version" name="version" value="<?php echo isset($version) ? $version : ''; ?>" required>
                    </div>
                    <div class="input-container">
                        <label for="marca">Marca:</label>
                        <input type="text" id="marca" name="marca" value="<?php echo isset($marca) ? $marca : ''; ?>" required>
                    </div>
                    <div class="input-container">
                        <label for="tipo2">TipoMotor:</label>
                        <select type="text" id="tipo2" name="tipo2" required>
                            <option value="" disabled selected>Seleccionar</option>
                            <option value="motor1" <?php echo (isset($tipomotor) && $tipomotor == 'motor1') ? 'selected' : ''; ?>>Motor1</option>
                            <option value="motor2" <?php echo (isset($tipomotor) && $tipomotor == 'motor2') ? 'selected' : ''; ?>>Motor2</option>
                        </select>
                    </div>
                    <div class="input-container">
                        <label for="ano">Año:</label>
                        <input type="number" id="ano" name="ano" value="<?php echo isset($anio) ? $anio : ''; ?>" required>
                    </div>
                    <div class="input-container">
                        <label for="pasajeros">Pasajeros:</label>
                        <input type="number" id="pasajeros" name="pasajeros" value="<?php echo isset($pasajeros) ? $pasajeros : ''; ?>" required>
                    </div>
                    <div class="input-container">
                        <label for="idcat">Categoria:</label>
                        <input type="number" id="idcat" name="idcat" value="<?php echo isset($categoria) ? $categoria : ''; ?>" required>
                    </div>
                    <div class="input-container">
                        <input type="submit" value="Actualizar" class="login-button">
                    </div>
                    <div class="input-container">
                        <input type="button" value="Cancelar" class="login-button" id="cancelar-button">
                    </div>
                </form>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-bar">
            <p>© 2023 Agencia Wings. Derechos Reservados.</p>
        </div>
    </footer>

    <script>
        // Detecta cuando se intenta utilizar el botón de retroceso del navegador
        window.onpopstate = function (event) {
            // Redirige nuevamente a la página actual para evitar la navegación del historial
            history.pushState(null, null, window.location.pathname);
        };
    </script>
    <script>
        setTimeout(function () { window.history.forward(); }, 0);
        window.onunload = function () { null };
    </script>
    <script src="../js/actualizar.js"></script>
    
</body>

</html>