<?php

include '../connection.php';

if (isset($_GET['ID_Categoria'])) {
    $idcategoria = $_GET['ID_Categoria'];

    // Eliminar el vehículo de la base de datos
    $queryDelete = "DELETE FROM categoriavehiculo WHERE ID_Categoria = $idcategoria";
    
    if (mysqli_query($conexion, $queryDelete)) {
        // La eliminación fue exitosa
        // Actualizar los IDs de los vehículos restantes
        $queryUpdate = "SET @count = 0;";
        $queryUpdate .= "UPDATE categoriavehiculo SET ID_Categoria = @count := @count + 1;";
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
    echo "ID de categoria no especificado.";
}

?>
