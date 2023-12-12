$(document).ready(function () {
  var selectedData; // Variable para almacenar los datos seleccionados

  // Función para cargar vehículos basados en la sucursal seleccionada
  $("#distribuidor").change(function () {
    var selectedSucursal = $(this).val();

    // Verificar si se ha seleccionado algún distribuidor
    if (!selectedSucursal) {
      // Si no se ha seleccionado, deshabilitar y limpiar el select de modelos
      $("#vehiculo")
        .attr("disabled", true)
        .html("<option value=''>Selecciona el vehículo</option>");
      $("#vehiculo-imagen").attr("src", "").hide(); // Limpiar y ocultar la imagen
      return;
    }

    obtenerDatosVehiculo(
      selectedSucursal,
      null,
      "vehiculo",
      "Selecciona el vehículo",
      function (data) {
        // Habilita el select de modelos
        $("#vehiculo").removeAttr("disabled");

        // Almacena los datos seleccionados
        selectedData = data;

        // Oculta la imagen al cambiar de sucursal
        $("#vehiculo-imagen").attr("src", "").hide();
      }
    );
  });

  // Función para obtener vehiculos
  function obtenerDatosVehiculo(
    distribuidor,
    vehiculo,
    selectorID,
    defaultOption,
    successCallback
  ) {
    $.ajax({
      type: "POST",
      url: "../a_leer/obtenerVehiculoPrueba.php",
      data: { distribuidor: distribuidor, vehiculo: vehiculo },
      dataType: "json",
    })
      .done(function (data) {
        console.log(data);
        // Limpia y actualiza el select
        $("#" + selectorID).html(
          "<option value=''>" + defaultOption + "</option>"
        );
        $.each(data, function (index, item) {
          $("#" + selectorID).append(
            "<option value='" + item.Nombre + "'>" + item.Nombre + "</option>"
          );
        });

        // Llama al callback de éxito y pasa data como parámetro
        if (typeof successCallback === "function") {
          successCallback(data);
        }
      })
      .fail(function (error) {
        console.log("Error al obtener datos: " + error);
      });
  }

  // Mostrar imagen del vehículo seleccionado
  $("#vehiculo").change(function () {
    var selectedVehiculo = $(this).val();
    if (selectedVehiculo) {
      var selectedVehicleData = selectedData.find(function (vehicle) {
        return vehicle.Nombre === selectedVehiculo;
      });

      if (selectedVehicleData) {
        console.log("Ruta de la imagen:", selectedVehicleData.Fotografia);
        $("#vehiculo-imagen")
          .attr("src", "../img/" + selectedVehicleData.Fotografia)
          .show();
      } else {
        console.log("Datos del vehículo no encontrados.");
      }
    } else {
      $("#vehiculo-imagen").attr("src", "").hide();
    }
  });

  $("form").submit(function (event) {
    event.preventDefault(); // Evita que el formulario se envíe de forma predeterminada

    $.ajax({
      type: "POST",
      url: "../a_insertar/newPrueba.php",
      data: {
        distribuidor: $("#distribuidor").val(),
        vehiculo: $("#vehiculo").val(),
        fechaPrueba: $("#fechaPrueba").val(),
        horario: $("#horario").val(),
        nombres: $("#nombres").val(),
        apellido: $("#apellido").val(),
        telefono: $("#telefono").val(),
        email: $("#email").val(),
      },
      dataType: "json",
      success: function (response) {
        console.log(response); // Agrega esta línea para imprimir la respuesta en la consola
        if (response.status === "success") {
          alert("Éxito: " + response.message);
          // Redirige a la URL proporcionada
          window.location.href = response.redirect_url;
        } else {
          alert("Error: " + response.message);
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(
          "Error en la solicitud AJAX: " + textStatus + ", " + errorThrown
        );
        console.log(jqXHR.responseText);
      },
    });
  });

  // Función para verificar la disponibilidad de una hora específica en una fecha dada
  function verificarDisponibilidadHora(selectedDate, allowedTimes) {
    var selectedSucursal = $("#distribuidor").val();
    $.ajax({
      type: "POST",
      url: "../a_leer/verificarDisponibilidad copy.php",
      data: { fechaPrueba: selectedDate, horario: allowedTimes, distribuidor: selectedSucursal},
      dataType: "json",
    })
      .done(function (data) {
        // Limpiar el select antes de agregar nuevas opciones
        $("#horario").empty();

        // Crear y agregar las opciones basadas en la disponibilidad
        $.each(allowedTimes, function (index, allowedTime) {
          var option = $("<option>", { value: allowedTime, text: allowedTime });

          console.log("Hora permitida actual:", allowedTime);
          console.log("Horas ocupadas recibidas:", data);

          if (data && data.some(ocupada => ocupada.startsWith(allowedTime))) {
            console.log("Hora ocupada, deshabilitando opción");
            option.prop("disabled", true);
        }

          $("#horario").append(option);
        });
      })
      .fail(function (jqXHR, textStatus, errorThrown) {
        console.error(
          "Error al verificar disponibilidad:",
          textStatus,
          errorThrown
        );
        console.log(jqXHR.responseText);
      });
  }

  // Función para habilitar el siguiente paso (hora) al seleccionar una fecha
  $("#fechaPrueba").change(function () {
    // Habilita el select de hora
    $("#horario").removeAttr("disabled");
  });

  // Obtén la fecha actual en el formato YYYY-MM-DD
  var today = new Date();
  today.setDate(today.getDate() + 1); // Suma 1 día a la fecha actual
  var dd = today.getDate();
  var mm = today.getMonth() + 1; // Suma 1 al mes, ya que en JavaScript los meses van de 0 a 11
  var yyyy = today.getFullYear();

  // Formatea el día y el mes para asegurarte de que tengan dos dígitos
  if (dd < 10) {
    dd = "0" + dd;
  }

  if (mm < 10) {
    mm = "0" + mm;
  }

  // Función para cargar las horas disponibles basadas en la fecha seleccionada
  function cargarHorasDisponibles(selectedDate) {
    // Array de horas permitidas
    var allowedTimes = ["09:00", "11:00", "13:00", "15:00", "17:00"];

    // Llama a la función para verificar la disponibilidad de horas
    verificarDisponibilidadHora(selectedDate, allowedTimes);
  }
  // Construye la fecha actual en el formato deseado
  var currentDate = yyyy + "-" + mm + "-" + dd;

  // Establece el valor mínimo y deshabilita fechas anteriores en el campo de entrada de fecha
  document.getElementById("fechaPrueba").min = currentDate;

  // Agrega el siguiente código para desactivar la selección de fechas anteriores en el calendario
  // Evento change para el campo de fecha
  document.getElementById("fechaPrueba").addEventListener("input", function () {
    var selectedDate = this.value;
    cargarHorasDisponibles(selectedDate);

    // Verifica si la fecha seleccionada es anterior a la fecha mínima
    if (new Date(selectedDate) < today) {
      // Si es anterior, restablece la fecha mínima
      this.value = currentDate;
      cargarHorasDisponibles(currentDate);
    }
  });

  document.getElementById("horario").addEventListener("change", function () {
    var selectedTime = this.value;
    var allowedTimes = ["09:00", "11:00", "13:00", "15:00", "17:00"];

    if (selectedTime !== "" && !allowedTimes.includes(selectedTime)) {
      // Si la hora seleccionada no está permitida, establece la primera hora permitida
      this.value = allowedTimes[0];
    }
  });
});
