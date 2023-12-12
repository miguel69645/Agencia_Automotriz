<?php
// Conexión a la base de datos 
include 'connection.php';
// Obtener el correo electrónico y la contraseña del formulario
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

// Consulta SQL para verificar las credenciales del usuario
$sql = "SELECT * FROM usuario WHERE Correo = '$correo' AND Contrasena = '$contrasena'";

$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    // Usuario autenticado con éxito
    $row = $result->fetch_assoc();
    $tipoUsuario = $row['TipoUsuario'];

    if ($tipoUsuario === 'Administrador') {
        // Redirigir al usuario a admin.php con una variable en la URL
        header("Location: administrador/admin.php?tipo=administrador");
        exit();
    } else {
        // Redirigir a otra página para usuarios no administradores
        header("Location: empleado/empleado.php?tipo=empleado");
        exit();
    }
} else {
    // Las credenciales son incorrectas, mostrar una alerta
    echo '<script>alert("Credenciales incorrectas. Por favor, inténtalo de nuevo.");</script>';
    
    // Redirigir al usuario a la página anterior después de un retraso de 0.5 segundos
    header('Refresh: 0.5; URL=' . $_SERVER['HTTP_REFERER']);
}
?>
