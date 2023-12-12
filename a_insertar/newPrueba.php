<?php

include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST["distribuidor"]) && !empty($_POST["distribuidor"]) &&
        isset($_POST["vehiculo"]) && !empty($_POST["vehiculo"]) &&
        isset($_POST["fechaPrueba"]) && !empty($_POST["fechaPrueba"]) &&
        isset($_POST["horario"]) && !empty($_POST["horario"]) &&
        isset($_POST["nombres"]) && !empty($_POST["nombres"]) &&
        isset($_POST["apellido"]) && !empty($_POST["apellido"]) &&
        isset($_POST["telefono"]) && !empty($_POST["telefono"]) &&
        isset($_POST["email"]) && !empty($_POST["email"])
    ) {
        insertar();
    }
}

function insertar()
{
    global $conexion;

    $nombre = $_POST['nombres'];
    $apellido = $_POST['apellido'];
    $tel = $_POST['telefono'];
    $email = $_POST['email'];
    $vehiculo = $_POST['vehiculo'];
    $distribuidor = $_POST['distribuidor'];
    $date = $_POST['fechaPrueba'];
    $time = $_POST['horario'];
    $tipo_servicio = 'Prueba de manejo';
    $estatus = 'Disponible';

    $vehiculo = mysqli_real_escape_string($conexion, $vehiculo);
    $tipo_servicio = mysqli_real_escape_string($conexion, $tipo_servicio);
    $distribuidor = mysqli_real_escape_string($conexion, $distribuidor);
    $date = mysqli_real_escape_string($conexion, $date);
    $time = mysqli_real_escape_string($conexion, $time);
    $nombre = mysqli_real_escape_string($conexion, $nombre);
    $apellido = mysqli_real_escape_string($conexion, $apellido);
    $tel = mysqli_real_escape_string($conexion, $tel);
    $email = mysqli_real_escape_string($conexion, $email);
    $estatus = mysqli_real_escape_string($conexion, $estatus);

    // Genera un ID aleatorio de 4 dígitos
    $idCita = generateRandomId(1000, 9999);

    // Verifica si el ID ya existe en la tabla
    $queryCheckId = "SELECT COUNT(*) FROM citas WHERE ID_Cita = ?";
    $stmtCheckId = mysqli_prepare($conexion, $queryCheckId);
    mysqli_stmt_bind_param($stmtCheckId, "i", $idCita);
    mysqli_stmt_execute($stmtCheckId);
    mysqli_stmt_bind_result($stmtCheckId, $count);
    mysqli_stmt_fetch($stmtCheckId);
    mysqli_stmt_close($stmtCheckId);

    // Si el ID ya existe, genera uno nuevo hasta encontrar uno único
    while ($count > 0) {
        $idCita = generateRandomId(1000, 9999);

        $stmtCheckId = mysqli_prepare($conexion, $queryCheckId);
        mysqli_stmt_bind_param($stmtCheckId, "i", $idCita);
        mysqli_stmt_execute($stmtCheckId);
        mysqli_stmt_bind_result($stmtCheckId, $count);
        mysqli_stmt_fetch($stmtCheckId);
        mysqli_stmt_close($stmtCheckId);
    }

    // Insertar en la tabla cliente
    $queryInsertCliente = "INSERT INTO cliente (Nombre, Apellido, Correo, Celular) VALUES (?, ?, ?, ?)";
    $stmtInsertCliente = mysqli_prepare($conexion, $queryInsertCliente);

    if ($stmtInsertCliente) {
        mysqli_stmt_bind_param($stmtInsertCliente, "ssss", $nombre, $apellido, $email, $tel);

        if (mysqli_stmt_execute($stmtInsertCliente)) {
            $idCliente = mysqli_insert_id($conexion);

            // Insertar en la tabla citas
            $queryInsertCitas = "INSERT INTO citas (ID_Cita, ID_Cliente, ID_Servicio, ID_Vehiculo, ID_Sucursal, FechaCita, HoraCita, Estatus) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmtInsertCitas = mysqli_prepare($conexion, $queryInsertCitas);

            if ($stmtInsertCitas) {
                // Obtener ID del servicio
                $queryGetServicio = "SELECT ID_Servicio FROM servicios WHERE Nombre = ?";
                $stmtGetServicio = mysqli_prepare($conexion, $queryGetServicio);
                mysqli_stmt_bind_param($stmtGetServicio, "s", $tipo_servicio);
                mysqli_stmt_execute($stmtGetServicio);
                mysqli_stmt_bind_result($stmtGetServicio, $idServicio);
                mysqli_stmt_fetch($stmtGetServicio);
                mysqli_stmt_close($stmtGetServicio);

                // Obtener ID del vehículo
                $queryGetVehiculo = "SELECT ID_Vehiculo FROM vehiculos WHERE Nombre = ?";
                $stmtGetVehiculo = mysqli_prepare($conexion, $queryGetVehiculo);
                mysqli_stmt_bind_param($stmtGetVehiculo, "s", $vehiculo);
                mysqli_stmt_execute($stmtGetVehiculo);
                mysqli_stmt_bind_result($stmtGetVehiculo, $idVehiculo);
                mysqli_stmt_fetch($stmtGetVehiculo);
                mysqli_stmt_close($stmtGetVehiculo);

                // Obtener ID de la sucursal
                $queryGetSucursal = "SELECT ID_Sucursal FROM sucursal WHERE Nombre = ?";
                $stmtGetSucursal = mysqli_prepare($conexion, $queryGetSucursal);
                mysqli_stmt_bind_param($stmtGetSucursal, "s", $distribuidor);
                mysqli_stmt_execute($stmtGetSucursal);
                mysqli_stmt_bind_result($stmtGetSucursal, $idDistribuidor);
                mysqli_stmt_fetch($stmtGetSucursal);
                mysqli_stmt_close($stmtGetSucursal);

                // Insertar en la tabla citas
                mysqli_stmt_bind_param($stmtInsertCitas, "iiisssss", $idCita, $idCliente, $idServicio, $idVehiculo, $idDistribuidor, $date, $time, $estatus);

                if (mysqli_stmt_execute($stmtInsertCitas)) {

                    // Éxito en la inserción, devuelve la URL de redirección
                    $response = array("status" => "success", "message" => "Su cita ha sido registrada.", "redirect_url" => "../cliente/prueba.php");
                    echo json_encode($response);
                    exit;
                } else {
                    // Error al insertar en la tabla citas
                    $response = array("status" => "error", "message" => "Error al insertar en la tabla citas: " . mysqli_error($conexion));
                    echo json_encode($response);
                }

                // Cierra la declaración preparada de la tabla citas
                mysqli_stmt_close($stmtInsertCitas);
            } else {
                // Error al preparar la declaración para la tabla citas
                echo '<script>alert("Error al preparar la declaración para la tabla citas: ' . mysqli_error($conexion) . '");</script>';
            }
        } else {
            // Error al insertar en la tabla cliente
            echo '<script>alert("Error al insertar en la tabla cliente: ' . mysqli_error($conexion) . '");</script>';
        }

        // Cierra la declaración preparada de la tabla cliente
        mysqli_stmt_close($stmtInsertCliente);
    } else {
        // Error al preparar la declaración para la tabla cliente
        echo '<script>alert("Error al preparar la declaración para la tabla cliente: ' . mysqli_error($conexion) . '");</script>';
    }
}

// Función para generar un ID aleatorio de 4 dígitos
function generateRandomId($min, $max) {
    return mt_rand($min, $max);
}

?>
