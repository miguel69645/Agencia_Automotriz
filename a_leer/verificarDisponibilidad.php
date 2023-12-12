<?php

include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["dateInput"])) {
    $fecha = $_POST["dateInput"];
    $sucursal = $_POST["distribuidor"]; // Obtén la sucursal seleccionada

    // Realiza la consulta para obtener las horas ocupadas en la fecha y sucursal especificadas
    $query = "SELECT HoraCita FROM citas JOIN sucursal ON citas.ID_Sucursal = sucursal.ID_Sucursal WHERE FechaCita = ? AND sucursal.Nombre = ?";    
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "ss", $fecha, $sucursal); // Bind sucursal as a string
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $hora);

    $horasOcupadas = array();

    while (mysqli_stmt_fetch($stmt)) {
        $horasOcupadas[] = $hora;
    }

    mysqli_stmt_close($stmt);

    // Devuelve las horas ocupadas como respuesta JSON
    echo json_encode($horasOcupadas);
} else {
    // Si no se proporciona la fecha, devuelve un array vacío
    echo json_encode(array());
}
?>
