<?php

include '../connection.php';

if (
    isset($_POST["nombre1"]) && !empty($_POST["nombre1"]) &&
    isset($_POST["apellido"]) && !empty($_POST["apellido"]) &&
    isset($_POST["correo"]) && !empty($_POST["correo"]) &&
    isset($_POST["contrasena"]) && !empty($_POST["contrasena"]) &&
    isset($_POST["telefono"]) && !empty($_POST["telefono"]) &&
    isset($_POST["tipo1"]) && !empty($_POST["tipo1"]) 
) {
    $nombre = $_POST['nombre1'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $telefono = $_POST['telefono'];
    $tipo = $_POST['tipo1'];

    // Create a prepared statement for insertion
    $queryInsert = "INSERT INTO usuario (Nombre, Apellido, Correo, Contrasena, Celular, TipoUsuario) 
                   VALUES (?, ?, ?, ?, ?, ?)";
    $stmtInsert = mysqli_prepare($conexion, $queryInsert);

    if ($stmtInsert) {
        // Bind parameters for insertion
        mysqli_stmt_bind_param($stmtInsert, "sssss", $nombre, $apellido, $correo, $telefono, $tipo);

        // Execute the prepared statement for insertion
        if (mysqli_stmt_execute($stmtInsert)) {
            // After successful insertion, update the IDs of the remaining vehicles
            $queryUpdate = "SET @count = 0;";
            $queryUpdate .= "UPDATE usuario SET ID_Usuario = @count := @count + 1;";
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
