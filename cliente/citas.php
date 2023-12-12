<?php

include '../connection.php';
global $conexion;

// Verificar si hay resultados
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Formulario Cita</title>
    <link rel="icon" type="image/x-icon" href="../img/logo_bw.png" />
    <link rel='stylesheet' type='text/css' media='screen' href='../css/style2.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>

<body>
    <div id="page" class="site">
        <div class="container">
            <div class="form-box">
                <div class="progress">
                    <div class="logo">
                        <a href="index.php"><span>Wings</span> Agency</a>

                        <h2>Consulta tus citas </h2>
                        <p>Ingrese los datos de la cita a buscar</p>
                    </div>
                </div>
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="form-one form-step active">
                        <div class="div-bus">
                            <label>Codígo de la cita</label>
                            <input type="text" name="codigo" placeholder="Coloca el codígo">
                            <input type="submit" name="enviar" value="BUSCAR" class="btn-submit-2">
                        </div>

                        <div>
                            <?php         
                            if (isset($_POST['enviar']))
                            {
                                if (empty($_POST['codigo'])) {
                                    echo "<script language='JavaScript'>
                                        alert('Ingresa el codígo de tu cita');
                                        location.assign('citas.php');
                                        </script>
                                    ";
                                }
                                $id_cita = $_POST['codigo'];
                                $sql = "SELECT c.ID_Cita, cl.Nombre as Cliente, v.Nombre as Vehiculo, se.Nombre as Servicio, s.Nombre as Sucursal, CONCAT(c.FechaCita, ' ', c.HoraCita) as FechaHora, c.estatus
                                        FROM citas c
                                        LEFT JOIN cliente cl ON c.ID_Cliente = cl.ID_Cliente
                                        LEFT JOIN vehiculos v ON c.ID_Vehiculo = v.ID_Vehiculo
                                        LEFT JOIN servicios se ON c.ID_Servicio = se.ID_Servicio
                                        LEFT JOIN sucursal s ON c.ID_Sucursal = s.ID_Sucursal
                                        WHERE c.ID_Cita = $id_cita AND c.estatus = 'Disponible'";
                                
                                $resultado = mysqli_query($conexion, $sql);
                                
                                if ($resultado->num_rows > 0) {
                                    echo "<table border='1'>
                                            <tr>
                                                <th>Cliente</th>
                                                <th>Vehiculo</th>
                                                <th>Servicio</th>
                                                <th>Sucursal</th>
                                                <th>Fecha y Hora</th>
                                                <th>Status</th>
                                                <th>Accion</th>      
                                            </tr>";
                                
                                    // Mostrar datos en la tabla
                                    while ($row = $resultado->fetch_assoc()) {
                                        echo "<tr>
                                                <td>" . $row["Cliente"] . "</td>
                                                <td>" . $row["Vehiculo"] .  "</td>
                                                <td>" . $row["Servicio"] . "</td>
                                                <td>" . $row["Sucursal"] .  "</td>
                                                <td>" . $row["FechaHora"] . "</td>
                                                <td>" . $row["estatus"] . "</td>
                                                <td><a href='cancelar_cita.php?id=" . $row["ID_Cita"] . "' onclick='return confirmarCancelacion();' ><i class='fa-solid fa-ban'></i></a></td>
                                            </tr>";
                                    }
                                
                                    echo "</table>";
                                } else {
                                    echo "No se encontraron resultados.";
                                }
                            }
                            ?>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>

    <script>
        // Detecta cuando se intenta utilizar el botón de retroceso del navegador
        window.onpopstate = function(event) {
            // Redirige nuevamente a la página actual para evitar la navegación del historial
            history.pushState(null, null, window.location.pathname);
        };
    </script>
    <script>
        setTimeout(function() {
            window.history.forward();
        }, 0);
        window.onunload = function() {
            null
        };
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
    function confirmarCancelacion() {
        return confirm("¿Estás seguro que deseas cancelar tu cita?");
    }
</script>

</body>

</html>