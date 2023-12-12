<?php
include '../connection.php';

if (
    isset($_POST["nombre"]) && !empty($_POST["nombre"]) &&
    isset($_POST["precio"]) && !empty($_POST["precio"]) &&
    isset($_POST["descripcion"]) && !empty($_POST["descripcion"]) &&
    isset($_POST["color"]) && !empty($_POST["color"]) &&
    isset($_POST["modelo"]) && !empty($_POST["modelo"]) &&
    isset($_POST["version"]) && !empty($_POST["version"]) &&
    isset($_POST["marca"]) && !empty($_POST["marca"]) &&
    isset($_POST["tipo2"]) && !empty($_POST["tipo2"]) &&
    isset($_POST["ano"]) && !empty($_POST["ano"]) &&
    isset($_POST["pasajeros"]) && !empty($_POST["pasajeros"]) &&
    isset($_POST["idcat"]) && !empty($_POST["idcat"])
) {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $color = $_POST['color'];
    $modelo = $_POST['modelo'];
    $version = $_POST['version'];
    $marca = $_POST['marca'];
    $tipomotor = $_POST['tipo2'];
    $anio = $_POST['ano'];
    $pasajeros = $_POST['pasajeros'];
    $categoria = $_POST['idcat'];

    if (isset($_POST["fotografia"]) && !empty($_POST["fotografia"])) {
        $fotografia = $_POST['fotografia'];
    } else {
        $fotografia = '';
    }

    // Create a prepared statement for insertion
    $queryInsert = "INSERT INTO vehiculos (Nombre, Precio, Descripcion, Fotografia, Color, Modelo, Version, Marca, TipoMotor, Anio, Pasajeros, ID_Categoria) 
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmtInsert = mysqli_prepare($conexion, $queryInsert);

    if ($stmtInsert) {
        // Bind parameters for insertion
        mysqli_stmt_bind_param($stmtInsert, "ssssssssssss", $nombre, $precio, $descripcion, $fotografia, $color, $modelo, $version, $marca, $tipomotor, $anio, $pasajeros, $categoria);

        // Execute the prepared statement for insertion
        if (mysqli_stmt_execute($stmtInsert)) {
            // After successful insertion, update the IDs of the remaining vehicles
            $queryUpdate = "SET @count = 0;";
            $queryUpdate .= "UPDATE vehiculos SET ID_Vehiculo = @count := @count + 1;";
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
