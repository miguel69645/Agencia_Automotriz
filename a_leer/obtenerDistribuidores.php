<?php
include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['marca']) && isset($_POST['modelo']) && isset($_POST['anio']) && isset($_POST['vehiculo']) && isset($_POST['tipo_servicio'])) {
        obtenerDistribuidores();
    }
}

function obtenerDistribuidores()
{
    global $conexion;

    $selectedMarca = $_POST['marca'];
    $selectedModelo = $_POST['modelo'];
    $selectedAño = $_POST['anio'];
    $selectedVehiculo = $_POST['vehiculo'];

    $queryDistribuidores = "SELECT DISTINCT s.Nombre FROM sucursal s JOIN vehiculos v ON s.ID_Vehiculo = v.ID_Vehiculo WHERE v.Marca = '$selectedMarca' AND v.Modelo = '$selectedModelo' AND v.Anio = '$selectedAño' AND v.Nombre = '$selectedVehiculo'";
    $resultDistribuidores = mysqli_query($conexion, $queryDistribuidores);

    $distribuidores = array();

    if ($resultDistribuidores->num_rows > 0) {
        while ($row = $resultDistribuidores->fetch_assoc()) {
            $distribuidores[] = $row["Nombre"];
        }
    }

    echo json_encode($distribuidores);
    exit();
}
?>
