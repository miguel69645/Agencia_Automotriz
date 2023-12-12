<?php

include '../connection.php';

if (
    isset($_POST["nombre4"]) && !empty($_POST["nombre4"]) &&
    isset($_POST["costo"]) && !empty($_POST["costo"]) &&
    isset($_POST["descripcion4"]) && !empty($_POST["descripcion4"]) 
) {
    $nombre = $_POST['nombre4'];
    $costo = $_POST['costo'];
    $descripcion = $_POST['descripcion4'];

    // Create a prepared statement for insertion
    $queryInsert = "INSERT INTO servicios (Nombre, Costo, Descripcion) 
                   VALUES (?, ?, ?)";
    $stmtInsert = mysqli_prepare($conexion, $queryInsert);

    if ($stmtInsert) {
        // Bind parameters for insertion
        mysqli_stmt_bind_param($stmtInsert, "sss", $nombre, $costo, $descripcion);

        // Execute the prepared statement for insertion
        if (mysqli_stmt_execute($stmtInsert)) {
            // After successful insertion, update the IDs of the remaining vehicles
            $queryUpdate = "SET @count = 0;";
            $queryUpdate .= "UPDATE servicios SET ID_Servicio = @count := @count + 1;";
            mysqli_multi_query($conexion, $queryUpdate);

            session_start();
            $_SESSION['message'] = 1;

            // JavaScript alert to indicate successful data insertion
            echo '<script>alert("Los datos se han insertado correctamente.");</script>';

            echo '<script>window.location.href = "../administrador/admin.php";</script>';
            exit; // Terminate the script to prevent further unnecessary code execution
        } else {
            // In case of an error, display an alert
            echo '<script>alert("Error al insertar los datos.");</script>';
        }

        // Close the prepared statement for insertion
        mysqli_stmt_close($stmtInsert);
    } else {
        // Error handling for the prepared statement creation
        echo "Error: " . mysqli_error($conexion);
    }
}
?>
