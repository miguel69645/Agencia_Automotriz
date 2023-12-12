<?php
include '../connection.php';

if(isset($_GET['ID_Cita'])) {
    $id = $_GET['ID_Cita'];
} else {
    echo "<script>alert('ID de cita no proporcionado');</script>";
    exit;
}

if(isset($_POST['estatus'])) {
    $estatus = mysqli_real_escape_string($conexion, $_POST['estatus']);

    $query = "UPDATE citas SET Estatus='$estatus' WHERE ID_Cita = $id";

    $result = mysqli_query($conexion, $query);

    if($result) {
        echo "<script>alert('Actualizado correctamente');window.location.href='../empleado/empleado.php';</script>";
    } else {
        echo "<script>alert('No se pudo actualizar');</script>";
    }
} else {
    echo "<script>alert('Faltan datos en el formulario');</script>";
}
?>
