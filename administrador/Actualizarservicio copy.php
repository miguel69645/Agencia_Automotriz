<?php
include '../connection.php';

$id = isset($_GET["ID_Servicio"]) ? intval($_GET["ID_Servicio"]) : null;

if (!$id) {
    // Si el ID no se pasa o no es válido, puedes mostrar un mensaje de error o redirigir al usuario.
    echo "ID de servicio no válido o no proporcionado.";
    exit; // Puedes agregar una redirección o mensaje personalizado aquí si lo deseas.
}

$query = "SELECT * FROM servicios WHERE ID_Servicio = $id";
$result = mysqli_query($conexion, $query);

if ($row = mysqli_fetch_assoc($result)) {
    $nombre = $row['Nombre'];
    $costo = $row['Costo'];
    $descripcion = $row['Descripcion'];
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
                <h2>Actualizar Categoria</h2>
                <form action="../a_actualizar/servicioupdate copy.php?ID_Servicio=<?=$id?>" method="post" class="login-form" id="servicios-form">
                    <div class="input-container">
                        <label for="nombre4">Nombre:</label>
                        <input type="text" id="nombre4" name="nombre4" value="<?php echo isset($nombre) ? $nombre : ''; ?>" required>
                    </div>
                    <div class="input-container">
                        <label for="costo">Costo:</label>
                        <input type="number" id="costo" name="costo" value="<?php echo isset($costo) ? $costo : ''; ?>" required>
                    </div>
                    <div class="input-container">
                        <label for="descripcion4">Descripcion:</label>
                        <input type="text" id="descripcion4" name="descripcion4" value="<?php echo isset($descripcion) ? $descripcion : ''; ?>" required>
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