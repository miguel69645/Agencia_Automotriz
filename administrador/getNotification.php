<?php

include '../connection.php';

// Consultar citas pendientes
$query = "SELECT COUNT(*) AS count FROM citas WHERE Estatus = 'Disponible'";
$result = mysqli_query($conexion, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];

    $response = array('success' => true, 'count' => $count);
} else {
    $response = array('success' => false, 'message' => mysqli_error($conexion));
}

echo json_encode($response);
?>