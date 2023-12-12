<?php

include '../connection.php';

if (
    isset($_POST["nombre3"]) && !empty($_POST["nombre3"]) &&
    isset($_POST["domicilio3"]) && !empty($_POST["domicilio3"]) &&
    isset($_POST["telefono3"]) && !empty($_POST["telefono3"]) &&
    isset($_POST["correo3"]) && !empty($_POST["correo3"]) &&
    isset($_POST["idvehiculo3"]) && !empty($_POST["idvehiculo3"]) 
) {
    $nombre = $_POST['nombre3'];
    $domicilio = $_POST['domicilio3'];
    $telefono = $_POST['telefono3'];
    $correo = $_POST['correo3'];
    $vehiculo = $_POST['idvehiculo3'];

    // Create a prepared statement for insertion
    $queryInsert = "INSERT INTO sucursal (Nombre, Domicilio, Telefono, CorreoElectronico, ID_Vehiculo) 
                   VALUES (?, ?, ?, ?, ?)";
    $stmtInsert = mysqli_prepare($conexion, $queryInsert);

    if ($stmtInsert) {
        // Bind parameters for insertion
        mysqli_stmt_bind_param($stmtInsert, "sssss", $nombre, $domicilio, $correo, $telefono, $vehiculo);

        // Execute the prepared statement for insertion
        if (mysqli_stmt_execute($stmtInsert)) {
            // After successful insertion, update the IDs of the remaining vehicles
            $queryUpdate = "SET @count = 0;";
            $queryUpdate .= "UPDATE sucursal SET ID_Sucursal = @count := @count + 1;";
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
