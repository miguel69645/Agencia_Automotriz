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
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css"> -->
    <link rel="stylesheet" href="../css/jquery.dataTables.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-...." crossorigin="anonymous" />
    <title>Agencia Automotriz</title>
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
                <li><a href="#" onclick="toggleSection('cliente')">Cliente</a></li>
                <li><a href="#" onclick="toggleSection('citas')">Citas</a></li>
                <li><a href="#" onclick="toggleSection('servicios')">Servicios</a></li>
                <li><a href="#" onclick="toggleSection('sucursal')">Sucursal</a></li>
                <li><a href="#" onclick="toggleSection('usuarios')">Usuarios</a></li>
                <li><a href="#" onclick="toggleSection('categoria')">Categoria</a></li>
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
                                echo "<td><a href='Actualizarcita.php?ID_Cita=" . $row['ID_Cita'] . "'><img class='icon-white' src='../css/jam-master/icons/write.svg' alt='Editar'></a></td>";
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

        <section id="servicios" class="card hidden">
            <h2>Servicios</h2>
            <div class="t">
                <form action="../a_insertar/newServicio.php" method="post" id="servicio-form">
                    <label for="nombre4">Nombre:</label>
                    <input type="text" id="nombre4" name="nombre4" required>
                    <label for="costo">Costo:</label>
                    <input type="number" id="costo" name="costo" required>
                    <label for="descripcion4">Descripcion:</label>
                    <input type="text" id="descripcion4" name="descripcion4" required>
                    <button type="submit" id="add-btn6" class="add-btn6">Agregar</button>
                </form>
            </div>

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
                                echo "<td colspan='2'><a href='Actualizarservicio.php?ID_Servicio=" . $row['ID_Servicio'] . "'><img class='icon-white' src='../css/jam-master/icons/write.svg' alt='Editar'></a>" .
                                    "<a href='../a_borrar/Eliminarservicios.php?ID_Servicio=" . $row['ID_Servicio'] . "' onclick='return showDeleteConfirmation();'><img class='icon-white' src='../css/jam-master/icons/trash.svg' alt='Eliminar'></a></td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section id="sucursal" class="card hidden">
            <h2>Sucursal</h2>
            <div class="t">
                <form action="../a_insertar/newSucursal.php" method="post" id="sucursal-form">
                    <label for="nombre3">Nombre:</label>
                    <input type="text" id="nombre3" name="nombre3" required>
                    <label for="domicilio3">Domicilio:</label>
                    <input type="text" id="domicilio3" name="domicilio3" required>
                    <label for="telefono3">Telefono:</label>
                    <input type="tel" id="telefono3" name="telefono3" required>
                    <label for="correo3">Correo:</label>
                    <input type="email" id="correo3" name="correo3" required><br>
                    <label for="idvehiculo3">idVehiculo:</label>
                    <input type="text" id="idvehiculo3" name="idvehiculo3" required>
                    <button type="submit" id="add-btn5" class="add-btn5">Agregar</button>
                </form>
            </div>
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
                            <th>Acciones</th>
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
                                echo "<td colspan='2'><a href='Actualizarsucursal.php?ID_Sucursal=" . $row['ID_Sucursal'] . "'><img class='icon-white' src='../css/jam-master/icons/write.svg' alt='Editar'></a>" .
                                    "<a href='../a_borrar/Eliminarsucursal.php?ID_Sucursal=" . $row['ID_Sucursal'] . "' onclick='return showDeleteConfirmation();'><img class='icon-white' src='../css/jam-master/icons/trash.svg' alt='Eliminar'></a></td>";
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

        <section id="usuarios" class="card hidden">
            <h2>Usuarios</h2>
            <div class="t">
                <form action="../a_insertar/newUsuario.php" method="post" id="usuario-form">
                    <label for="nombre1">Nombre:</label>
                    <input type="text" id="nombre1" name="nombre1" required>
                    <label for="apellido">Apellidos:</label>
                    <input type="text" id="apellido" name="apellido" required>
                    <label for="correo">Correo:</label>
                    <input type="email" id="correo" name="correo" required>
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" id="contrasena" name="contrasena" required><br>
                    <label for="telefono">Telefono:</label>
                    <input type="tel" id="telefono" name="telefono" required>
                    <label for="tipo1">Tipo:</label>
                    <select type="text" id="tipo1" name="tipo1" required>
                        <option value="" disabled selected>Seleccionar</option>
                        <option value="Administrador">Administrador</option>
                        <option value="Empleado">Empleado</option>
                    </select>
                    <button type="submit" id="add-btn2" class="add-btn2">Agregar</button>
                </form>
            </div>

            <div class="table-container">
                <table id="usuarios-table">
                    <thead>
                        <tr>
                            <th>idUsuario</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Correo</th>
                            <th>Contraseña</th>
                            <th>Telefono</th>
                            <th>TipoUsuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result4 && mysqli_num_rows($result4) > 0) {
                            while ($row = mysqli_fetch_assoc($result4)) {
                                echo "<tr>";
                                echo "<td>" . $row['ID_Usuario'] . "</td>";
                                echo "<td>" . $row["Nombre"] . "</td>";
                                echo "<td>" . $row['Apellido'] . "</td>";
                                echo "<td>" . $row['Correo'] . "</td>";
                                echo "<td>" . $row['Contrasena'] . "</td>";
                                echo "<td>" . $row['Celular'] . "</td>";
                                echo "<td>" . $row['TipoUsuario'] . "</td>";
                                echo "<td colspan='2'><a href='Actualizarusuarios.php?ID_Usuario=" . $row['ID_Usuario'] . "'><img class='icon-white' src='../css/jam-master/icons/write.svg' alt='Editar'></a>" .
                                    "<a href='../a_borrar/Eliminarusuario.php?ID_Usuario=" . $row['ID_Usuario'] . "' onclick='return showDeleteConfirmation();'><img class='icon-white' src='../css/jam-master/icons/trash.svg' alt='Eliminar'></a></td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section id="categoria" class="card hidden">
            <h2>Categoria De Vehiculos</h2>
            <div class="t">
                <form action="../a_insertar/newCategoria.php" method="post" id="categoria-form">
                    <label for="nombre2">Nombre:</label>
                    <input type="text" id="nombre2" name="nombre2" required>
                    <label for="descripcion1">Descripcion:</label>
                    <input type="text" id="descripcion1" name="descripcion1" required>
                    <button type="submit" id="add-btn4" class="add-btn4">Agregar</button>
                </form>
            </div>

            <div class="table-container">
                <table id="categoria-table">
                    <thead>
                        <tr>
                            <th>idCategoria</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result6 && mysqli_num_rows($result6) > 0) {
                            while ($row = mysqli_fetch_assoc($result6)) {
                                echo "<tr>";
                                echo "<td>" . $row['ID_Categoria'] . "</td>";
                                echo "<td>" . $row["Nombre"] . "</td>";
                                echo "<td>" . $row['Descripcion'] . "</td>";
                                echo "<td colspan='2'><a href='Actualizarcategoria.php?ID_Categoria=" . $row['ID_Categoria'] . "'><img class='icon-white' src='../css/jam-master/icons/write.svg' alt='Editar'></a>" .
                                    "<a href='../a_borrar/Eliminarcategoria.php?ID_Categoria=" . $row['ID_Categoria'] . "' onclick='return showDeleteConfirmation();'><img class='icon-white' src='../css/jam-master/icons/trash.svg' alt='Eliminar'></a></td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section id="vehiculos" class="card hidden">
            <h2>Vehículos</h2>
            <div class="t">
                <form action="../a_insertar/newVehiculo.php" method="post" id="vehiculos-form">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required>
                    <label for="precio">Precio:</label>
                    <input type="number" id="precio" name="precio" required>
                    <label for="descripcion">Descripcion:</label>
                    <input type="text" id="descripcion" name="descripcion" required>
                    <label for="fotografia">Fotografia:</label>
                    <input type="file" id="fotografia" name="fotografia" accept="image/*" onclick="actualizarImg()"
                        required><br>
                    <label for="color">Color:</label>
                    <input type="text" id="color" name="color" required>
                    <label for="modelo">Modelo:</label>
                    <input type="text" id="modelo" name="modelo" required>
                    <label for="version">Version:</label>
                    <input type="text" id="version" name="version" required>
                    <label for="marca">Marca:</label>
                    <input type="text" id="marca" name="marca" required>
                    <label for="tipo2">TipoMotor:</label>
                    <select type="text" id="tipo2" name="tipo2" required>
                        <option value="" disabled selected>Seleccionar</option>
                        <option value="motor1">Motor1</option>
                        <option value="motor2">Motor2</option>
                    </select><br>
                    <label for="ano">Año:</label>
                    <input type="number" id="ano" name="ano" required>
                    <label for="pasajeros">Pasajeros:</label>
                    <input type="number" id="pasajeros" name="pasajeros" required>
                    <label for="idcat">Categoria:</label>
                    <input type="number" id="idcat" name="idcat" required>
                    <button type="submit" id="add-btn3" class="add-btn3">Agregar</button>
                </form>
            </div>

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
                            <th>Acciones</th>
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
                                echo "<td colspan='2'><a href='Actualizarvehiculos.php?ID_Vehiculo=" . $row['ID_Vehiculo'] . "'><img class='icon-white' src='../css/jam-master/icons/write.svg' alt='Editar'></a>" .
                                    "<a href='../a_borrar/Eliminarvehiculo.php?ID_Vehiculo=" . $row['ID_Vehiculo'] . "' onclick='return showDeleteConfirmation();'><img class='icon-white' src='../css/jam-master/icons/trash.svg' alt='Eliminar'></a></td>";
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
    <script src="../js/admin.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

</body>

</html>