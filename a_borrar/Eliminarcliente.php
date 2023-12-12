<?php

include '../connection.php';

if (isset($_GET['ID_Cliente'])) {
    $idcliente = $_GET['ID_Cliente'];

    // Eliminar el vehículo de la base de datos
    $queryDelete = "DELETE FROM cliente WHERE ID_Cliente = $idcliente";
    
    if (mysqli_query($conexion, $queryDelete)) {
        // La eliminación fue exitosa
        // Actualizar los IDs de los vehículos restantes
        $queryUpdate = "SET @count = 0;";
        $queryUpdate .= "UPDATE cliente SET ID_Cliente = @count := @count + 1;";
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
    echo "ID de cliente no especificado.";
}

?>
