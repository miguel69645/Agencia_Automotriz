<?php

include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['modelo']) && isset($_POST['marca']) && isset($_POST['anio'])) {
        obtenerVehiculo();
    }
}

function obtenerVehiculo() {
    // Copy the function code here
    global $conexion;

    $selectedMarca = $_POST['marca'];
    $selectedModelo = $_POST['modelo'];
    $selectedAño = $_POST['anio'];

    $queryVehiculo = "SELECT DISTINCT Nombre FROM vehiculos WHERE Marca = '$selectedMarca' AND Modelo = '$selectedModelo' AND Anio = '$selectedAño'";
    $resultVehiculo = mysqli_query($conexion, $queryVehiculo);

    $vehiculos = array();

    if ($resultVehiculo->num_rows > 0) {
        while ($row = $resultVehiculo->fetch_assoc()) {
            $vehiculos[] = $row["Nombre"];
        }
    }

    echo json_encode($vehiculos);
    exit();
}
?>