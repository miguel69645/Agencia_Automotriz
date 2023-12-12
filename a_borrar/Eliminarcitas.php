<?php

include '../connection.php';

if (isset($_GET['ID_Cita'])) {
    $idcitas = $_GET['ID_Cita'];

    // Obtener el ID del cliente asociado a la cita
    $queryGetClienteID = "SELECT ID_Cliente FROM citas WHERE ID_Cita = $idcitas";
    $result = mysqli_query($conexion, $queryGetClienteID);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        $idcliente = $row['ID_Cliente'];

        // Eliminar la cita de la base de datos
        $queryDeleteCita = "DELETE FROM citas WHERE ID_Cita = $idcitas";
        if (mysqli_query($conexion, $queryDeleteCita)) {

            // Eliminar el cliente asociado a la cita
            $queryDeleteCliente = "DELETE FROM cliente WHERE ID_Cliente = $idcliente";
            if (mysqli_query($conexion, $queryDeleteCliente)) {

                // Actualizar los IDs de las citas restantes
                $queryUpdateCitas = "SET @count = 0;";
                if (mysqli_query($conexion, $queryUpdateCitas)) {
                    $queryUpdateCitas = "UPDATE citas SET ID_Cita = @count := @count + 1";
                    if (!mysqli_query($conexion, $queryUpdateCitas)) {
                        // Manejar el error de la segunda consulta si es necesario
                        $_SESSION['mensaje'] = 2;
                        
                        exit();
                    }
                } else {
                    // Manejar el error de la primera consulta si es necesario
                    $_SESSION['mensaje'] = 2;
               
                    exit();
                }

                // Actualizar los IDs de los clientes restantes
                $queryUpdateClientes = "SET @count = 0;";
                if (mysqli_query($conexion, $queryUpdateClientes)) {
                    $queryUpdateCitas = "UPDATE cliente SET ID_Cliente = @count := @count + 1";
                if (!mysqli_query($conexion, $queryUpdateClientes)) {
                    // Manejar el error de la consulta si es necesario
                    $_SESSION['mensaje'] = 2;
                    exit();
                }
            }
                session_start();
                $_SESSION['mensaje'] = 1;
                header('Location: ../administrador/admin.php');
                exit();  // Importante agregar exit() después de redirigir para evitar la ejecución continua del script

            } else {
                // Ocurrió un error al eliminar el cliente
                $_SESSION['mensaje'] = 2;
            }
        } else {
            // Ocurrió un error al eliminar la cita
            $_SESSION['mensaje'] = 2;
        }
    } else {
        // No se pudo obtener el ID del cliente
        $_SESSION['mensaje'] = 2;
    }
} else {
    echo "ID de cita no especificado.";
}

mysqli_close($conexion);
exit();  // Importante agregar exit() después de redirigir para evitar la ejecución continua del script
?>
