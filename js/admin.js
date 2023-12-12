function toggleSection(sectionId) {
  var section = document.getElementById(sectionId);
  section.classList.toggle("hidden");
}

function showDeleteConfirmation() {
  var confirmation = confirm("¿Está seguro de que desea eliminar los datos?");
  return confirmation;
}

function actualizarImg() {
  const $inputfile = document.querySelector("#fotografia"),
    $imgProducto = document.querySelector("#image");
  // Escuchar cuando cambie
  $inputfile.addEventListener("change", () => {
    // Los archivos seleccionados, pueden ser muchos o uno
    const files = $inputfile.files;
    // Si no hay archivos salimos de la función y quitamos la imagen
    if (!files || !files.length) {
      $imgProducto.src = "";
      return;
    }
    // Ahora tomamos el primer archivo, el cual vamos a previsualizar
    const archivoInicial = files[0];
    // Lo convertimos a un objeto de tipo objectURL
    const Url = URL.createObjectURL(archivoInicial);
    // Y a la fuente de la imagen le ponemos el objectURL
    $imgProducto.src = Url;
  });
}

window.onload = function () {
  var addBtnUsuarios = document.getElementById("add-btn2");
  addBtnUsuarios.addEventListener("click", function (event) {
    var nombre1 = document.getElementById("nombre1").value;
    var apellido = document.getElementById("apellido").value;
    var correo = document.getElementById("correo").value;
    var telefono = document.getElementById("telefono").value;
    var tipo1 = document.getElementById("tipo1").value;

    if (!nombre1 || !apellido || !correo || !telefono || !tipo1) {
      event.preventDefault();
      alert("Faltan datos. Por favor, complete todos los campos.");
    }
  });

  var addBtnCategoria = document.getElementById("add-btn4");
  addBtnCategoria.addEventListener("click", function (event) {
    var nombre2 = document.getElementById("nombre2").value;
    var descripcion1 = document.getElementById("descripcion1").value;

    if (!nombre2 || !descripcion1) {
      event.preventDefault();
      alert("Faltan datos. Por favor, complete todos los campos.");
    }
  });

  var addBtnServicio = document.getElementById("add-btn6");
  addBtnServicio.addEventListener("click", function (event) {
    var nombre4 = document.getElementById("nombre4").value;
    var costo = document.getElementById("costo").value;
    var descripcion4 = document.getElementById("descripcion4").value;

    if (!nombre4 || !costo || !descripcion4) {
      event.preventDefault();
      alert("Faltan datos. Por favor, complete todos los campos.");
    }
  });

  var addBtnSucursal = document.getElementById("add-btn5");
  addBtnSucursal.addEventListener("click", function (event) {
    var nombre3 = document.getElementById("nombre3").value;
    var domicilio3 = document.getElementById("domicilio3").value;
    var telefono3 = document.getElementById("telefono3").value;
    var correo3 = document.getElementById("correo3").value;
    var vehiculo3 = document.getElementById("idvehiculo3").value;

    if (!nombre3 || !domicilio3 || !telefono3 || !correo3 || !vehiculo3) {
      event.preventDefault();
      alert("Faltan datos. Por favor, complete todos los campos.");
    }
  });

  var addBtnVehiculos = document.getElementById("add-btn3");
  addBtnVehiculos.addEventListener("click", function (event) {
    var nombre = document.getElementById("nombre").value;
    var precio = document.getElementById("precio").value;
    var descripcion = document.getElementById("descripcion").value;
    var fotografia = document.getElementById("fotografia").value;
    var color = document.getElementById("color").value;
    var modelo = document.getElementById("modelo").value;
    var version = document.getElementById("version").value;
    var marca = document.getElementById("marca").value;
    var tipo2 = document.getElementById("tipo2").value;
    var ano = document.getElementById("ano").value;
    var pasajeros = document.getElementById("pasajeros").value;

    if (
      !nombre ||
      !precio ||
      !descripcion ||
      !fotografia ||
      !color ||
      !modelo ||
      !version ||
      !marca ||
      !tipo2 ||
      !ano ||
      !pasajeros
    ) {
      event.preventDefault();
      alert("Faltan datos. Por favor, complete todos los campos. ");
    } else if (precio < 0 || pasajeros < 0 || ano < 0) {
      event.preventDefault();
      alert("No es posible insertar valores negativos. ");
    }
  });
};

document.addEventListener("DOMContentLoaded", function () {
  // Obtén el enlace de cerrar sesión por su ID
  const logoutLink = document.getElementById("logout-link");

  // Agrega un controlador de eventos al enlace
  logoutLink.addEventListener("click", function (e) {
    // Muestra una alerta de confirmación
    const confirmLogout = confirm("¿Desea cerrar sesión?");

    // Si el usuario confirma el cierre de sesión, redirige a index.php
    if (confirmLogout) {
      window.location.href = "../cliente/index.php";
    } else {
      // Previene la acción predeterminada del enlace si no se confirma
      e.preventDefault();
    }
  });
});

function showNotifications() {
  // Hacer una solicitud AJAX para obtener las citas pendientes
  $.ajax({
    url: "../administrador/getNotification.php", // Nombre del archivo PHP que obtendrá las citas pendientes
    type: "GET",
    dataType: "json",
    success: function (response) {
      // Mostrar las notificaciones o manejar la respuesta según sea necesario
      if (response.count > 0) {
        alert("Hay citas pendientes.");
        // Puedes actualizar dinámicamente el número de notificaciones en el ícono
        $("#notification-count").text(response.count).show();
      } else {
        alert("No hay citas pendientes.");
        // Puedes ocultar el ícono de notificación o realizar otras acciones según tus necesidades
        $("#notification-count").hide();
      }
    },
    error: function () {
      alert("Error de conexión al obtener notificaciones.");
    },
  });
}

$(document).ready(function () {
  // Inicializar DataTable para la tabla de clientes
  $("#cliente-table").DataTable({
    columns: [
      { data: "idCliente" },
      { data: "Nombre" },
      { data: "Apellido" },
      { data: "Correo" },
      { data: "Celular" },
    ],
  });

  $("#citas-table").DataTable({
    columns: [
      { data: "idCitas" },
      { data: "Cliente" },
      { data: "Servicio" },
      { data: "Vehiculo" },
      { data: "Sucursal" },
      { data: "FechaCita" },
      { data: "HoraCita" },
      { data: "Estatus" },
      { data: "Acciones", orderable: false, searchable: false },
    ],
  });

  $("#servicio-table").DataTable({
    columns: [
      { data: "idServicios" },
      { data: "Nombre" },
      { data: "Costo" },
      { data: "Descripcion" },
      {
        data: "Acciones",
        orderable: false,
        searchable: false,
        render: function (data, type, row) {
          // Puedes personalizar la salida HTML según tus necesidades.
          return (
            "<a href='Actualizarservicio.php?ID_Servicio=" +
            row["idServicios"] +
            "'><img class='icon-white' src='../css/jam-master/icons/write.svg' alt='Editar'></a>" +
            "<a href='../a_borrar/Eliminarservicios.php?ID_Servicio=" +
            row["idServicios"] +
            "' onclick='return showDeleteConfirmation();'><img class='icon-white' src='../css/jam-master/icons/trash.svg' alt='Eliminar'></a>"
          );
        },
      },
    ],
  });

  $("#sucursal-table").DataTable({
    scrollX: true,
    columns: [
      { data: "idSucursal" },
      { data: "Nombre" },
      { data: "Domicilio" },
      { data: "Telefono" },
      { data: "Correo" },
      { data: "idVehiculo" },
      {
        data: "Acciones",
        orderable: false,
        searchable: false,
        render: function (data, type, row) {
          // Puedes personalizar la salida HTML según tus necesidades.
          return (
            "<a href='Actualizarsucursal.php?ID_Sucursal=" +
            row["idSucursal"] +
            "'><img class='icon-white' src='../css/jam-master/icons/write.svg' alt='Editar'></a>" +
            "<a href='../a_borrar/Eliminarsucursal.php?ID_Sucursal=" +
            row["idSucursal"] +
            "' onclick='return showDeleteConfirmation();'><img class='icon-white' src='../css/jam-master/icons/trash.svg' alt='Eliminar'></a>"
          );
        },
      },
    ],
  });

  $("#usuarios-table").DataTable({
    columns: [
      { data: "idUsuario" },
      { data: "Nombre" },
      { data: "Apellidos" },
      { data: "Correo" },
      { data: "Contraseña" },
      { data: "Telefono" },
      { data: "TipoUsuario" },
      {
        data: "Acciones",
        orderable: false,
        searchable: false,
        render: function (data, type, row) {
          // Puedes personalizar la salida HTML según tus necesidades.
          return (
            "<a href='Actualizarusuarios.php?ID_Usuario=" +
            row["idUsuario"] +
            "'><img class='icon-white' src='../css/jam-master/icons/write.svg' alt='Editar'></a>" +
            "<a href='../a_borrar/Eliminarusuario.php?ID_Usuario=" +
            row["idUsuario"] +
            "' onclick='return showDeleteConfirmation();'><img class='icon-white' src='../css/jam-master/icons/trash.svg' alt='Eliminar'></a>"
          );
        },
      },
    ],
  });

  $("#categoria-table").DataTable({
    columns: [
      { data: "idCategoria" },
      { data: "Nombre" },
      { data: "Descripcion" },
      {
        data: "Acciones",
        orderable: false,
        searchable: false,
        render: function (data, type, row) {
          // Puedes personalizar la salida HTML según tus necesidades.
          return (
            "<a href='Actualizarcategoria.php?ID_Categoria=" +
            row["idCategoria"] +
            "'><img class='icon-white' src='../css/jam-master/icons/write.svg' alt='Editar'></a>" +
            "<a href='../a_borrar/Eliminarcategoria.php?ID_Categoria=" +
            row["idCategoria"] +
            "' onclick='return showDeleteConfirmation();'><img class='icon-white' src='../css/jam-master/icons/trash.svg' alt='Eliminar'></a>"
          );
        },
      },
    ],
  });

  $("#vehiculos-table").DataTable({
    scrollX: true,
    columns: [
      { data: "idVehiculo" },
      { data: "Nombre" },
      { data: "Precio" },
      { data: "Descripcion" },
      { data: "Foto", orderable: false, searchable: false },
      { data: "Color" },
      { data: "Modelo" },
      { data: "Version" },
      { data: "Marca" },
      { data: "TipoMotor" },
      { data: "Año" },
      { data: "Pasajeros" },
      { data: "idCategoria" },
      {
        data: "Acciones",
        orderable: false,
        searchable: false,
        render: function (data, type, row) {
          // Puedes personalizar la salida HTML según tus necesidades.
          return (
            "<a href='Actualizarvehiculos.php?ID_Vehiculo=" +
            row["idVehiculo"] +
            "'><img class='icon-white' src='../css/jam-master/icons/write.svg' alt='Editar'></a>" +
            "<a href='../a_borrar/Eliminarvehiculo.php?ID_Vehiculo=" +
            row["idVehiculo"] +
            "' onclick='return showDeleteConfirmation();'><img class='icon-white' src='../css/jam-master/icons/trash.svg' alt='Eliminar'></a>"
          );
        },
      },
    ],
  });
});
