<?php
include '../connection.php';

if(isset($_GET['ID_Categoria'])) {
    $id = $_GET['ID_Categoria'];
} else {
    echo "<script>alert('ID de categoria no proporcionado');</script>";
    exit;
}

if(isset($_POST['nombre2']) && isset($_POST['descripcion1'])) {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre2']);
    $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion1']);

    $query = "UPDATE categoriavehiculo SET Nombre='$nombre', Descripcion='$descripcion' WHERE ID_Categoria = $id";

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
