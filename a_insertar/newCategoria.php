<?php

include '../connection.php';

if (
    isset($_POST["nombre2"]) && !empty($_POST["nombre2"]) &&
    isset($_POST["descripcion1"]) && !empty($_POST["descripcion1"]) 
) {
    $nombre = $_POST['nombre2'];
    $descripcion = $_POST['descripcion1'];

    // Create a prepared statement for insertion
    $queryInsert = "INSERT INTO categoriavehiculo (Nombre, Descripcion) 
                   VALUES (?, ?)";
    $stmtInsert = mysqli_prepare($conexion, $queryInsert);

    if ($stmtInsert) {
        // Bind parameters for insertion
        mysqli_stmt_bind_param($stmtInsert, "ss", $nombre, $descripcion);

        // Execute the prepared statement for insertion
        if (mysqli_stmt_execute($stmtInsert)) {
            // After successful insertion, update the IDs of the remaining vehicles
            $queryUpdate = "SET @count = 0;";
            $queryUpdate .= "UPDATE categoriavehiculo SET ID_Categoria = @count := @count + 1;";
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
