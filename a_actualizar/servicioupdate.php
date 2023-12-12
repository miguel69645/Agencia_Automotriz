<?php
include '../connection.php';

if(isset($_GET['ID_Servicio'])) {
    $id = $_GET['ID_Servicio'];
} else {
    echo "<script>alert('ID de servicio no proporcionado');</script>";
    exit;
}

if(isset($_POST['nombre4']) && isset($_POST['costo']) && isset($_POST['descripcion4'])) {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre4']);
    $costo = mysqli_real_escape_string($conexion, $_POST['costo']);
    $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion4']);

    $query = "UPDATE servicios SET Nombre='$nombre', Costo='$costo', Descripcion='$descripcion' WHERE ID_Servicio = $id";

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
