<?php

include '../connection.php';
global $conexion;

if (isset($_GET['id'])) {
    $id_cita_cancelar = $_GET['id'];

    // Realizar la actualización del estado de la cita a "cancelado"
    $sql_update = "UPDATE citas SET estatus = 'Cancelado' WHERE ID_Cita = $id_cita_cancelar";
    $resultado_update = mysqli_query($conexion, $sql_update);

    if ($resultado_update) {
        // Redirigir de vuelta a la página anterior
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit; // Asegúrate de que el código no siga ejecutándose después de la redirección
    } else {
        echo "Error al cancelar la cita: " . mysqli_error($conexion);
    }
} else {
    echo "ID de cita no proporcionado.";
}
?>
