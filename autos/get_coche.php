<?php
include '../connection.php';

$product_id = $_GET['product_id'];

$sql = "SELECT v.Marca, v.Modelo, v.Anio, v.Nombre as NombreVehiculo, s.Nombre as NombreSucursal FROM vehiculos v JOIN sucursal s ON v.ID_Vehiculo = s.ID_Vehiculo WHERE v.ID_Vehiculo = $product_id";
$result = mysqli_query($conexion, $sql);

if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $data = array(
            'marca' => $row['Marca'],
            'modelo' => $row['Modelo'],
            'anio' => $row['Anio'],
            'vehiculo' => $row['NombreVehiculo'],
            // 'distribuidor' => $row['NombreSucursal'],
        );

        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        echo "No se encontraron datos para el product_id: $product_id";
    }
} else {
    echo "Error en la consulta SQL: " . mysqli_error($conexion);
}

mysqli_close($conexion);
?>