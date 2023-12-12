<?php
include '../connection.php';

$id = isset($_GET["ID_Usuario"]) ? intval($_GET["ID_Usuario"]) : null;

if (!$id) {
    // Si el ID no se pasa o no es válido, puedes mostrar un mensaje de error o redirigir al usuario.
    echo "ID de usuario no válido o no proporcionado.";
    exit; // Puedes agregar una redirección o mensaje personalizado aquí si lo deseas.
}

$query = "SELECT * FROM usuario WHERE ID_Usuario = $id";
$result = mysqli_query($conexion, $query);

if ($row = mysqli_fetch_assoc($result)) {
    $nombre = $row['Nombre'];
    $apellido = $row['Apellido'];
    $correo = $row['Correo'];
    $contrasena = $row['Contrasena'];
    $telefono = $row['Celular'];
    $tipo = $row['TipoUsuario'];
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
                <h2>Actualizar Usuarios</h2>
                <form action="../a_actualizar/usuarioupdate.php?ID_Usuario=<?=$id?>" method="post" class="login-form" id="usuarios-form">
                    <div class="input-container">
                        <label for="nombre1">Nombre:</label>
                        <input type="text" id="nombre1" name="nombre1" value="<?php echo isset($nombre) ? $nombre : ''; ?>" required>
                    </div>
                    <div class="input-container">
                        <label for="apellido">Apellidos:</label>
                        <input type="text" id="apellido" name="apellido" value="<?php echo isset($apellido) ? $apellido : ''; ?>" required>
                    </div>
                    <div class="input-container">
                        <label for="correo">Correo:</label>
                        <input type="text" id="correo" name="correo" value="<?php echo isset($correo) ? $correo : ''; ?>" required>
                    </div>
                    <div class="input-container">
                        <label for="contrasena">Contraseña:</label>
                        <input type="password" id="contrasena" name="contrasena" value="<?php echo isset($contrasena) ? $contrasena : ''; ?>" required>
                    </div>
                    <div class="input-container">
                        <label for="telefono">Telefono:</label>
                        <input type="tel" id="telefono" name="telefono" value="<?php echo isset($telefono) ? $telefono : ''; ?>" required>
                    </div>
                    <div class="input-container">
                        <label for="tipo1">TipoUsuario:</label>
                        <select type="text" id="tipo1" name="tipo1" required>
                            <option value="" disabled selected>Seleccionar</option>
                            <option value="Administrador" <?php echo (isset($tipo) && $tipo == 'Administrador') ? 'selected' : ''; ?>>Administrador</option>
                            <option value="Empleado" <?php echo (isset($tipo) && $tipo == 'Empleado') ? 'selected' : ''; ?>>Empleado</option>
                        </select>
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