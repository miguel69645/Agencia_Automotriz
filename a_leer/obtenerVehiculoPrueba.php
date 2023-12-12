<?php

include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['distribuidor'])) {
        obtenerVehiculo();
    }
}

function obtenerVehiculo()
{
    global $conexion;

    $selectedSucursal = $_POST['distribuidor'];

    $queryVehiculos = "SELECT DISTINCT v.Nombre, v.Fotografia FROM vehiculos v JOIN sucursal s ON v.ID_Vehiculo = s.ID_Vehiculo WHERE s.Nombre = '$selectedSucursal'";
    $resultVehiculos = mysqli_query($conexion, $queryVehiculos);

    $vehiculos = array();

    if ($resultVehiculos->num_rows > 0) {
        while ($row = $resultVehiculos->fetch_assoc()) {
            $vehiculo = array(
                'Nombre' => $row['Nombre'],
                'Fotografia' => $row['Fotografia']
            );
            $vehiculos[] = $vehiculo;
        }
    }

    echo json_encode($vehiculos);
    exit();
}

?>