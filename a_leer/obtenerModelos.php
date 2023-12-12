<?php

include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['marca'])) {
        obtenerModelos();
    }
}

function obtenerModelos() {
    // Copy the function code here
    global $conexion;

    $selectedMarca = $_POST['marca'];

    $queryModelos = "SELECT DISTINCT Modelo FROM vehiculos WHERE Marca = '$selectedMarca'";
    $resultModelos = mysqli_query($conexion, $queryModelos);

    $modelos = array();

    if ($resultModelos->num_rows > 0) {
        while ($row = $resultModelos->fetch_assoc()) {
            $modelos[] = $row["Modelo"];
        }
    }

    echo json_encode($modelos);
    exit();
}
?>