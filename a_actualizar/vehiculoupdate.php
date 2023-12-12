<?php
include '../connection.php';

if(isset($_GET['ID_Vehiculo'])) {
    $id = $_GET['ID_Vehiculo'];
} else {
    echo "<script>alert('ID de vehiculo no proporcionado');</script>";
    exit;
}

if(isset($_POST['nombre']) && isset($_POST['precio']) && isset($_POST['descripcion']) && isset($_POST['fotografia']) && isset($_POST['color']) && isset($_POST['modelo']) && isset($_POST['version']) && isset($_POST['marca']) && isset($_POST['marca']) && isset($_POST['tipo2']) && isset($_POST['ano']) && isset($_POST['pasajeros']) && isset($_POST['idcat'])) {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $precio = mysqli_real_escape_string($conexion, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
    $fotografia = mysqli_real_escape_string($conexion, $_POST['fotografia']);
    $color = mysqli_real_escape_string($conexion, $_POST['color']);
    $modelo = mysqli_real_escape_string($conexion, $_POST['modelo']);
    $version = mysqli_real_escape_string($conexion, $_POST['version']);
    $marca = mysqli_real_escape_string($conexion, $_POST['marca']);
    $tipomotor = mysqli_real_escape_string($conexion, $_POST['tipo2']);
    $anio = mysqli_real_escape_string($conexion, $_POST['ano']);
    $pasajeros = mysqli_real_escape_string($conexion, $_POST['pasajeros']);
    $categoria = mysqli_real_escape_string($conexion, $_POST['idcat']);
    

    $query = "UPDATE vehiculos SET Nombre='$nombre', Precio='$precio', Descripcion='$descripcion', Fotografia='$fotografia', Color='$color', Modelo='$modelo', Version='$version', Marca='$marca', TipoMotor='$tipomotor', Anio='$anio', Pasajeros='$pasajeros', ID_Categoria='$categoria' WHERE ID_Vehiculo=$id";

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
