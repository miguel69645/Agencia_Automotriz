<?php

include '../connection.php';

if (isset($_GET['ID_Servicio'])) {
    $idservicio = $_GET['ID_Servicio'];

    // Eliminar el vehículo de la base de datos
    $queryDelete = "DELETE FROM servicios WHERE ID_Servicio = $idservicio";
    
    if (mysqli_query($conexion, $queryDelete)) {
        // La eliminación fue exitosa
        // Actualizar los IDs de los vehículos restantes
        $queryUpdate = "SET @count = 0;";
        $queryUpdate .= "UPDATE servicios SET ID_Servicio = @count := @count + 1;";
        mysqli_multi_query($conexion, $queryUpdate);

        session_start();
        $_SESSION['mensaje'] = 1;
        header('Location: ../administrador/admin.php');
    } else {
        // Ocurrió un error al eliminar
        $_SESSION['mensaje'] = 2;
        header('Location: ../administrador/admin.php');
    }

    mysqli_close($conexion);
} else {
    echo "ID de servicio no especificado.";
}

?>
