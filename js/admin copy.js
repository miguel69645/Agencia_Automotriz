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
      },
    ],
  });

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

  $("#sucursal-table").DataTable({
    scrollX: true,
    columns: [
      { data: "idSucursal" },
      { data: "Nombre" },
      { data: "Domicilio" },
      { data: "Telefono" },
      { data: "Correo" },
      { data: "idVehiculo" },
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
    ],
  });
});
