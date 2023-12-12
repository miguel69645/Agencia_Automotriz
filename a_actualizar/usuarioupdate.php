<?php
include '../connection.php';

if(isset($_GET['ID_Usuario'])) {
    $id = $_GET['ID_Usuario'];
} else {
    echo "<script>alert('ID de usuario no proporcionado');</script>";
    exit;
}

if(isset($_POST['nombre1']) && isset($_POST['apellido']) && isset($_POST['correo']) && isset($_POST['contrasena']) && isset($_POST['telefono']) && isset($_POST['tipo1'])) {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre1']);
    $apellido = mysqli_real_escape_string($conexion, $_POST['apellido']);
    $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
    $contrasena = mysqli_real_escape_string($conexion, $_POST['contrasena']);
    $telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);
    $tipo = mysqli_real_escape_string($conexion, $_POST['tipo1']);

    $query = "UPDATE usuario SET Nombre='$nombre', Apellido='$apellido', Correo='$correo', Contrasena='$contrasena', celular='$telefono', TipoUsuario='$tipo' WHERE ID_Usuario=$id";

    $result = mysqli_query($conexion, $query);

    if($result) {
        echo "<script>alert('Actualizado correctamente');window.location.href='../administrador/admin.php';</script>";
    } else {
        echo "<script>alert('No se pudo actualizar');</script>";
    }
} else {
    echo "<script>alert('Faltan datos en el formulario');</script>";
}
?>
