<?php

include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['modelo']) && isset($_POST['marca'])) {
        obtenerAnios();
    }
}

function obtenerAnios() {
    // Copy the function code here
    global $conexion;

    $selectedMarca = $_POST['marca'];
    $selectedModelo = $_POST['modelo'];

    $queryAños = "SELECT DISTINCT Anio FROM vehiculos WHERE Marca = '$selectedMarca' AND Modelo = '$selectedModelo'";
    $resultAños = mysqli_query($conexion, $queryAños);

    $años = array();

    if ($resultAños->num_rows > 0) {
        while ($row = $resultAños->fetch_assoc()) {
            $años[] = $row["Anio"];
        }
    }

    echo json_encode($años);
    exit();
}
?>
