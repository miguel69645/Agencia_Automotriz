<?php
include '../connection.php';

if(isset($_GET['ID_Sucursal'])) {
    $id = $_GET['ID_Sucursal'];
} else {
    echo "<script>alert('ID de sucursal no proporcionado');</script>";
    exit;
}

if(isset($_POST['nombre3']) && isset($_POST['domicilio3']) && isset($_POST['correo3']) && isset($_POST['telefono3']) && isset($_POST['idvehiculo3'])) {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre3']);
    $domicilio = mysqli_real_escape_string($conexion, $_POST['domicilio3']);
    $telefono = mysqli_real_escape_string($conexion, $_POST['telefono3']);
    $correo = mysqli_real_escape_string($conexion, $_POST['correo3']);
    $vehiculo = mysqli_real_escape_string($conexion, $_POST['idvehiculo3']);

    $query = "UPDATE sucursal SET Nombre='$nombre', Domicilio='$domicilio', CorreoElectronico='$correo', Telefono='$telefono', ID_Vehiculo='$vehiculo' WHERE ID_Sucursal=$id";

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
