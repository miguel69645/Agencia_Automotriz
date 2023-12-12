<?php
include '../connection.php';
$query1 = 'SELECT * FROM servicios';
$result1 = mysqli_query($conexion, $query1);
$query2 = 'SELECT * FROM cliente';
$result2 = mysqli_query($conexion, $query2);
$query3 = 'SELECT * FROM sucursal';
$result3 = mysqli_query($conexion, $query3);
$query = 'SELECT * FROM citas';
$result = mysqli_query($conexion, $query);
$query4 = 'SELECT * FROM usuario';
$result4 = mysqli_query($conexion, $query4);
$query5 = 'SELECT * FROM vehiculos';
$result5 = mysqli_query($conexion, $query5);
$query6 = 'SELECT * FROM categoriavehiculo';
$result6 = mysqli_query($conexion, $query6);

session_start();
if (isset($_SESSION['mensaje'])) {
    if ($_SESSION['mensaje'] == 1) {
        echo '<script>alert("Se ha borrado exitosamente");</script>';
    } else {
        echo '<script>alert("No se ha borrado");</script>';
    }
}
session_unset();

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../img/logo_bw.png">
    <title>Agencia Automotriz</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-...." crossorigin="anonymous" />
</head>

<body>

    <script>
        var tipoUsuario = '<?php echo isset($_GET["tipo"]) ? $_GET["tipo"] : ""; ?>';
        if (tipoUsuario === 'administrador') {
            alert("Bienvenido Administrador!");
        } else if (tipoUsuario === 'empleado') {
            alert("Bienvenido Empleado!");
        }
    </script>

    <header>
        <div class="header-left">
            <a href="#" id="logout-link">
                <img src="../img/logo_wb.png" alt="Imagen izquierda" class="header-image">
            </a>
        </div>
        <h1>Wings Performance Motors</h1>
        <nav>
            <ul>
                <li><a href="#" onclick="toggleSection('servicios')">Servicios</a></li>
                <li><a href="#" onclick="toggleSection('cliente')">Cliente</a></li>
                <li><a href="#" onclick="toggleSection('citas')">Citas</a></li>
                <li><a href="#" onclick="toggleSection('sucursal')">Sucursal</a></li>
                <li><a href="#" onclick="toggleSection('vehiculos')">Vehículos</a></li>
            </ul>
        </nav>
        <div id="notifications-icon" class="notifications-icon">
            <i class="fas fa-bell fa-2x" onclick="showNotifications()" class="notifications-count"></i>
            <span id="notification-count"
                style="background-color: red; color: white; border-radius: 50%; padding: 2px 6px; font-size: 12px;"></span>
        </div>
    </header>

    <main>
        <section id="servicios" class="card hidden">
            <h2>Servicios</h2>
            <div class="table-container">
                <table id="servicio-table">
                    <thead>
                        <tr>
                            <th>idServicios</th>
                            <th>Nombre</th>
                            <th>Costo</th>
                            <th>Descripcion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result1 && mysqli_num_rows($result1) > 0) {
                            while ($row = mysqli_fetch_assoc($result1)) {
                                echo "<tr>";
                                echo "<td>" . $row['ID_Servicio'] . "</td>";
                                echo "<td>" . $row['Nombre'] . "</td>";
                                echo "<td>" . $row['Costo'] . "</td>";
                                echo "<td>" . $row['Descripcion'] . "</td>";
                                echo "<td><a href='../administrador/Actualizarservicio copy.php?ID_Servicio=" . $row['ID_Servicio'] . "'><img class='icon-white' src='../css/jam-master/icons/write.svg' alt='Editar'></a></td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>


        <section id="cliente" class="card hidden">
            <h2>Cliente</h2>
            <div class="table-container">
                <table id="cliente-table">
                    <thead>
                        <tr>
                            <th>idCliente</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Correo</th>
                            <th>Celular</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result2 && mysqli_num_rows($result2) > 0) {
                            while ($row = mysqli_fetch_assoc($result2)) {
                                echo "<tr>";
                                echo "<td>" . $row['ID_Cliente'] . "</td>";
                                echo "<td>" . $row['Nombre'] . "</td>";
                                echo "<td>" . $row['Apellido'] . "</td>";
                                echo "<td>" . $row['Correo'] . "</td>";
                                echo "<td>" . $row['Celular'] . "</td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section id="citas" class="card hidden">
            <h2>Citas</h2>
            <div class="t">
                <form id="citas-form">

                </form>
            </div>

            <div class="table-container">
                <table id="citas-table">
                    <thead>
                        <tr>
                            <th>idCitas</th>
                            <th>Cliente</th>
                            <th>Servicio</th>
                            <th>Vehiculo</th>
                            <th>Sucursal</th>
                            <th>FechaCita</th>
                            <th>HoraCita</th>
                            <th>Estatus</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                // Obtén los nombres correspondientes de las tablas relacionadas
                                $clienteNombre = obtenerNombrePorIDCliente($row['ID_Cliente']);
                                $servicioNombre = obtenerNombrePorIDServicio($row['ID_Servicio']);
                                $vehiculoNombre = obtenerNombrePorIDVehiculo($row['ID_Vehiculo']);
                                $sucursalNombre = obtenerNombrePorIDSucursal($row['ID_Sucursal']);

                                echo "<tr>";
                                echo "<td>" . $row['ID_Cita'] . "</td>";
                                echo "<td>" . $clienteNombre . "</td>";
                                echo "<td>" . $servicioNombre . "</td>";
                                echo "<td>" . $vehiculoNombre . "</td>";
                                echo "<td>" . $sucursalNombre . "</td>";
                                echo "<td>" . $row['FechaCita'] . "</td>";
                                echo "<td>" . $row['HoraCita'] . "</td>";
                                echo "<td>" . $row['Estatus'] . "</td>";
                                echo "<td><a href='../administrador/Actualizarcita copy.php?ID_Cita=" . $row['ID_Cita'] . "'><img class='icon-white' src='../css/jam-master/icons/write.svg' alt='Editar'></a></td>";
                                echo "</tr>";
                            }
                        }
                        ?>

                        <?php
                        function obtenerNombrePorIDCliente($id)
                        {
                            // Realiza una consulta SQL para obtener el nombre correspondiente de la tabla
                            $conexion = mysqli_connect('localhost', 'root', '', 'Agencia');
                            $consulta = "SELECT Nombre FROM cliente WHERE ID_Cliente = " . $id;
                            $resultado = mysqli_query($conexion, $consulta);
                            if ($fila = mysqli_fetch_assoc($resultado)) {
                                return $fila['Nombre'];
                            }
                            return 'No encontrado'; // Puedes personalizar el valor predeterminado si no se encuentra el nombre
                        }

                        function obtenerNombrePorIDVehiculo($id)
                        {
                            // Realiza una consulta SQL para obtener el nombre correspondiente de la tabla
                            $conexion = mysqli_connect('localhost', 'root', '', 'Agencia');
                            $consulta = "SELECT Nombre FROM vehiculos WHERE ID_Vehiculo = " . $id;
                            $resultado = mysqli_query($conexion, $consulta);
                            if ($fila = mysqli_fetch_assoc($resultado)) {
                                return $fila['Nombre'];
                            }
                            return 'No encontrado'; // Puedes personalizar el valor predeterminado si no se encuentra el nombre
                        }

                        function obtenerNombrePorIDServicio($id)
                        {
                            // Realiza una consulta SQL para obtener el nombre correspondiente de la tabla
                            $conexion = mysqli_connect('localhost', 'root', '', 'Agencia');
                            $consulta = "SELECT Nombre FROM servicios WHERE ID_Servicio = " . $id;
                            $resultado = mysqli_query($conexion, $consulta);
                            if ($fila = mysqli_fetch_assoc($resultado)) {
                                return $fila['Nombre'];
                            }
                            return 'No encontrado'; // Puedes personalizar el valor predeterminado si no se encuentra el nombre
                        }

                        function obtenerNombrePorIDSucursal($id)
                        {
                            // Realiza una consulta SQL para obtener el nombre correspondiente de la tabla
                            $conexion = mysqli_connect('localhost', 'root', '', 'Agencia');
                            $consulta = "SELECT Nombre FROM sucursal WHERE ID_Sucursal = " . $id;
                            $resultado = mysqli_query($conexion, $consulta);
                            if ($fila = mysqli_fetch_assoc($resultado)) {
                                return $fila['Nombre'];
                            }
                            return 'No encontrado'; // Puedes personalizar el valor predeterminado si no se encuentra el nombre
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section id="sucursal" class="card hidden">
            <h2>Sucursal</h2>
            <div class="table-container">
                <table id="sucursal-table">
                    <thead>
                        <tr>
                            <th>idSucursal</th>
                            <th>Nombre</th>
                            <th>Domicilio</th>
                            <th>Telefono</th>
                            <th>Correo</th>
                            <th>idVehiculo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result3 && mysqli_num_rows($result3) > 0) {
                            while ($row = mysqli_fetch_assoc($result3)) {
                                // Obtén el nombre correspondiente del Vehículo
                                $vehiculoNombre = obtenerNombreVehiculoPorID($row['ID_Vehiculo']);

                                echo "<tr>";
                                echo "<td>" . $row['ID_Sucursal'] . "</td>";
                                echo "<td>" . $row['Nombre'] . "</td>";
                                echo "<td>" . $row['Domicilio'] . "</td>";
                                echo "<td>" . $row['Telefono'] . "</td>";
                                echo "<td>" . $row['CorreoElectronico'] . "</td>";
                                echo "<td>" . $vehiculoNombre . "</td>";
                                echo "</tr>";
                            }
                        }
                        ?>

                        <?php
                        function obtenerNombreVehiculoPorID($id)
                        {
                            // Realiza una consulta SQL para obtener el nombre del Vehículo
                            $conexion = mysqli_connect('localhost', 'root', '', 'Agencia');
                            $consulta = "SELECT Nombre FROM vehiculos WHERE ID_Vehiculo = " . $id;
                            $resultado = mysqli_query($conexion, $consulta);
                            if ($fila = mysqli_fetch_assoc($resultado)) {
                                return $fila['Nombre'];
                            }
                            return 'No encontrado'; // Puedes personalizar el valor predeterminado si no se encuentra el nombre
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </section>

        <section id="vehiculos" class="card hidden">
            <h2>Vehículos</h2>
            <div class="table-container">
                <table id="vehiculos-table">
                    <thead>
                        <tr>
                            <th>idVehiculo</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Descripcion</th>
                            <th>Foto</th>
                            <th>Color</th>
                            <th>Modelo</th>
                            <th>Version</th>
                            <th>Marca</th>
                            <th>TipoMotor</th>
                            <th>Año</th>
                            <th>Pasajeros</th>
                            <th>idCategoria</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result5 && mysqli_num_rows($result5) > 0) {
                            while ($row = mysqli_fetch_assoc($result5)) {
                                // Obtén el nombre correspondiente de la categoría
                                $categoriaNombre = obtenerNombreCategoriaPorID($row['ID_Categoria']);

                                echo "<tr>";
                                echo "<td>" . $row['ID_Vehiculo'] . "</td>";
                                echo "<td>" . $row['Nombre'] . "</td>";
                                echo "<td>" . $row['Precio'] . "</td>";
                                echo "<td>" . $row['Descripcion'] . "</td>";
                                echo '<td><img src="../img/' . $row['Fotografia'] . '" onerror="this.src=\'../img/noimage.png\'" width="80" height="50"></td>';
                                echo "<td>" . $row['Color'] . "</td>";
                                echo "<td>" . $row['Modelo'] . "</td>";
                                echo "<td>" . $row['Version'] . "</td>";
                                echo "<td>" . $row['Marca'] . "</td>";
                                echo "<td>" . $row['TipoMotor'] . "</td>";
                                echo "<td>" . $row['Anio'] . "</td>";
                                echo "<td>" . $row['Pasajeros'] . "</td>";
                                echo "<td>" . $categoriaNombre . "</td>";
                                echo "</tr>";
                            }
                        }
                        ?>

                        <?php
                        function obtenerNombreCategoriaPorID($id)
                        {
                            // Realiza una consulta SQL para obtener el nombre de la Categoría
                            $conexion = mysqli_connect('localhost', 'root', '', 'Agencia');
                            $consulta = "SELECT Nombre FROM categoriavehiculo WHERE ID_Categoria = " . $id;
                            $resultado = mysqli_query($conexion, $consulta);
                            if ($fila = mysqli_fetch_assoc($resultado)) {
                                return $fila['Nombre'];
                            }
                            return 'No encontrado'; // Puedes personalizar el valor predeterminado si no se encuentra el nombre
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-bar">
            <p>© 2023 Agencia Wings. Derechos Reservados.</p>
        </div>
    </footer>

    <script>
        // Detecta cuando se intenta utilizar el botón de retroceso del navegador
        window.onpopstate = function (event) {
            // Redirige nuevamente a la página actual para evitar la navegación del historial
            history.pushState(null, null, window.location.pathname);
        };
    </script>
    <script>
        setTimeout(function () {
            window.history.forward();
        }, 0);
        window.onunload = function () {
            null
        };
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../js/admin copy.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>


</body>

</html>