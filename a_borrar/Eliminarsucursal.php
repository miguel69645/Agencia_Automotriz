<?php

include '../connection.php';

if (isset($_GET['ID_Sucursal'])) {
    $idsucursal = $_GET['ID_Sucursal'];

    // Eliminar el vehículo de la base de datos
    $queryDelete = "DELETE FROM sucursal WHERE ID_Sucursal = $idsucursal";
    
    if (mysqli_query($conexion, $queryDelete)) {
        // La eliminación fue exitosa
        // Actualizar los IDs de los vehículos restantes
        $queryUpdate = "SET @count = 0;";
        $queryUpdate .= "UPDATE sucursal SET ID_Sucursal = @count := @count + 1;";
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
    echo "ID de sucursal no especificado.";
}

?>
