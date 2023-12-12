$(document).ready(function () {
  // Función para resetear opciones y deshabilitar el selector
  function resetOptions(selector) {
    selector.html("<option value=''>Selecciona una opción</option>");
    selector.attr("disabled", "disabled");
  }

  // Función para cargar modelos basados en la marca seleccionada
  $("#marca").change(function () {
    var selectedMarca = $(this).val();
    obtenerDatosModelos(
      selectedMarca,
      null,
      "modelo",
      "Selecciona el modelo del vehículo",
      function (data) {
        // Habilita el select de modelos
        $("#modelo").removeAttr("disabled");

        // Limpia y deshabilita el select de años
        resetOptions($("#anio"));
        resetOptions($("#vehiculo"));
        resetOptions($("#tipo_servicio"));

        // Llama a la función para actualizar el botón de continuar
        actualizarBotonContinuar();
      }
    );
  });

  // Función para obtener modelos y años
  function obtenerDatosModelos(
    marca,
    modelo,
    selectorID,
    defaultOption,
    successCallback
  ) {
    $.ajax({
      type: "POST",
      url: "../a_leer/obtenerModelos.php", // Update the URL for obtenerModelos.php
      data: { marca: marca, modelo: modelo },
      dataType: "json",
    })
      .done(function (data) {
        // Limpia y actualiza el select
        $("#" + selectorID).html(
          "<option value=''>" + defaultOption + "</option>"
        );
        $.each(data, function (index, item) {
          $("#" + selectorID).append(
            "<option value='" + item + "'>" + item + "</option>"
          );
        });

        // Llama al callback de éxito
        successCallback(data);
      })
      .fail(function (error) {
        console.log("Error al obtener datos: " + error);
      });
  }

  // Función para cargar años basados en la marca y modelo seleccionados
  $("#modelo").change(function () {
    var selectedMarca = $("#marca").val();
    var selectedModelo = $(this).val();
    obtenerDatosAnios(
      selectedMarca,
      selectedModelo,
      "anio",
      "Selecciona el año del vehículo",
      function (data) {
        // Habilita el select de años
        $("#anio").removeAttr("disabled");

        // Limpia y deshabilita el select de vehiculo
        resetOptions($("#vehiculo"));
        resetOptions($("#tipo_servicio"));

        // Llama a la función para actualizar el botón de continuar
        actualizarBotonContinuar();
      }
    );
  });

  // Función para obtener modelos y años
  function obtenerDatosAnios(
    marca,
    modelo,
    selectorID,
    defaultOption,
    successCallback
  ) {
    $.ajax({
      type: "POST",
      url: "../a_leer/obtenerAnios.php",
      data: { marca: marca, modelo: modelo },
      dataType: "json",
    })
      .done(function (data) {
        $("#" + selectorID).html(
          "<option value=''>" + defaultOption + "</option>"
        );
        $.each(data, function (index, item) {
          $("#" + selectorID).append(
            "<option value='" + item + "'>" + item + "</option>"
          );
        });

        successCallback(data);
      })
      .fail(function (error) {
        console.log("Error al obtener datos: " + error);
      });
  }

  // Función para vehiculos basados en la marca, modelo y año seleccionados
  $("#anio").change(function () {
    var selectedMarca = $("#marca").val();
    var selectedModelo = $("#modelo").val();
    var selectedAño = $(this).val();
    obtenerDatosVehiculos(
      selectedMarca,
      selectedModelo,
      selectedAño,
      "vehiculo",
      "Selecciona el vehículo",
      function (data) {
        // Habilita el select de vehiculo
        $("#vehiculo").removeAttr("disabled");

        // Limpia y deshabilita el select de tipo de servicio
        resetOptions($("#tipo_servicio"));

        // Llama a la función para actualizar el botón de continuar
        actualizarBotonContinuar();
      }
    );
  });

  // Función para obtener modelos y años
  function obtenerDatosVehiculos(
    marca,
    modelo,
    anio,
    selectorID,
    defaultOption,
    successCallback
  ) {
    $.ajax({
      type: "POST",
      url: "../a_leer/obtenerVehiculo.php",
      data: { marca: marca, modelo: modelo, anio: anio },
      dataType: "json",
    })
      .done(function (data) {
        $("#" + selectorID).html(
          "<option value=''>" + defaultOption + "</option>"
        );
        $.each(data, function (index, item) {
          $("#" + selectorID).append(
            "<option value='" + item + "'>" + item + "</option>"
          );
        });

        successCallback(data);
      })
      .fail(function (error) {
        console.log("Error al obtener datos: " + error);
      });
  }

  $("#vehiculo").change(function () {
    var selectedMarca = $("#marca").val();
    var selectedModelo = $("#modelo").val();
    var selectedAño = $("#anio").val();
    var selectedVehiculo = $(this).val();
    var selectedServicio = $("#tipo_servicio").val();
    obtenerDatosServicios(
      selectedMarca,
      selectedModelo,
      selectedAño,
      selectedVehiculo,
      "tipo_servicio",
      "Selecciona el servicio",
      function (data) {
        // Habilita el select de servicios
        $("#tipo_servicio").removeAttr("disabled");

        // Llama a la función para actualizar el botón de continuar
        actualizarBotonContinuar();
      }
    );

    // Función para obtener datos de servicios
    function obtenerDatosServicios(
      marca,
      modelo,
      anio,
      vehiculo,
      selectorID,
      defaultOption,
      successCallback
    ) {
      $.ajax({
        type: "POST",
        url: "../cliente/formulario.php",
        data: { marca: marca, modelo: modelo, anio: anio, vehiculo: vehiculo },
        dataType: "json",
      })
        .done(function (data) {
          $("#" + selectorID).html(
            "<option value=''>" + defaultOption + "</option>"
          );
          $.each(data, function (index, item) {
            $("#" + selectorID).append(
              "<option value='" + item + "'>" + item + "</option>"
            );
          });

          successCallback(data);
        })
        .fail(function (error) {
          console.log("Error al obtener datos: " + error);
        });
    }

    obtenerDatosDistribuidores(
      selectedMarca,
      selectedModelo,
      selectedAño,
      selectedVehiculo,
      selectedServicio,
      "distribuidor",
      "Selecciona el distribuidor",
      function (data) {
        // Habilita el select de servicios
        $("#distribuidor").removeAttr("disabled");

        // Llama a la función para actualizar el botón de continuar
        actualizarBotonContinuar();
      }
    );
  });

  // Función para obtener distribuidores basados en la marca, modelo, año, vehículo y tipo de servicio seleccionados
  function obtenerDatosDistribuidores(
    marca,
    modelo,
    anio,
    vehiculo,
    tipo_servicio,
    selectorID,
    defaultOption,
    successCallback
  ) {
    $.ajax({
      type: "POST",
      url: "../a_leer/obtenerDistribuidores.php",
      data: {
        marca: marca,
        modelo: modelo,
        anio: anio,
        vehiculo: vehiculo,
        tipo_servicio: tipo_servicio,
      },
      dataType: "json",
    })
      .done(function (data) {
        $("#" + selectorID).html(
          "<option value=''>" + defaultOption + "</option>"
        );
        if (data.length > 0) {
          $.each(data, function (index, item) {
            $("#" + selectorID).append(
              "<option value='" + item + "'>" + item + "</option>"
            );
          });
        } else {
          resetSelectsInSecondStep();
        }

        successCallback(data);
        verificarCamposPaso2(); // Agrega esta línea para actualizar el botón de continuar
      })
      .fail(function (error) {
        console.log("Error al obtener datos: " + error);
      });
  }

  // Función para verificar la disponibilidad de una hora específica en una fecha dada
  function verificarDisponibilidadHora(selectedDate, allowedTimes) {
    var selectedSucursal = $("#distribuidor").val();
    $.ajax({
      type: "POST",
      url: "../a_leer/verificarDisponibilidad.php",
      data: { dateInput: selectedDate, time: allowedTimes, distribuidor: selectedSucursal},
      dataType: "json",
    })
      .done(function (data) {
        // Limpiar el select antes de agregar nuevas opciones
        $("#time").empty();

        // Crear y agregar las opciones basadas en la disponibilidad
        $.each(allowedTimes, function (index, allowedTime) {
          var option = $("<option>", { value: allowedTime, text: allowedTime });

          console.log("Hora permitida actual:", allowedTime);
          console.log("Horas ocupadas recibidas:", data);

          if (data && data.some(ocupada => ocupada.startsWith(allowedTime))) {
            console.log("Hora ocupada, deshabilitando opción");
            option.prop("disabled", true);
        }

          $("#time").append(option);
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

  $("form").submit(function (event) {
    event.preventDefault(); // Evita que el formulario se envíe de forma predeterminada

    $.ajax({
      type: "POST",
      url: "../a_insertar/newFormulario.php",
      data: {
        marca: $("#marca").val(),
        modelo: $("#modelo").val(),
        anio: $("#anio").val(),
        vehiculo: $("#vehiculo").val(),
        tipo_servicio: $("#tipo_servicio").val(),
        distribuidor: $("#distribuidor").val(),
        dateInput: $("#dateInput").val(),
        time: $("#time").val(),
        name: $("#name").val(),
        apellido: $("#apellido").val(),
        tel: $("#tel").val(),
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

  // Función para habilitar/deshabilitar el botón de continuar
  function actualizarBotonContinuar() {
    // Verifica si todos los select tienen una opción seleccionada
    var todosSelect = $(
      "#marca, #modelo, #anio, #vehiculo, #tipo_servicio"
    ).filter(function () {
      return $(this).val() !== "";
    });

    // Habilita el botón si todos los select tienen una opción seleccionada, de lo contrario, deshabilítalo
    $(".btn-next").prop("disabled", todosSelect.length !== 5);
  }

  // Función para verificar si los campos del paso 2 están vacíos y desactivar el botón de continuar
  function verificarCamposPaso2() {
    var distribuidor = $("#distribuidor").val();
    var fechaCita = $("#dateInput").val();
    var horaCita = $("#time").val();

    // Si alguno de los campos está vacío o undefined, desactiva el botón
    if (!distribuidor || !fechaCita || !horaCita) {
      $(".btn-next").prop("disabled", true);
    } else {
      // Si todos los campos están llenos, habilita el botón
      $(".btn-next").prop("disabled", false);
    }
  }

  function verificarCamposPaso3() {
    var nombre = $("#name").val();
    var apellidos = $("#apellido").val();
    var telefono = $("#tel").val();
    var email = $("#email").val();

    // Si alguno de los campos está vacío, desactiva el botón de enviar
    if (!nombre || !apellidos || !telefono || !email) {
      $(".btn-submit").prop("disabled", true);
    } else {
      // Si todos los campos están llenos, habilita el botón de enviar
      $(".btn-submit").prop("disabled", false);
    }
  }

  // Función para resetear y desactivar selects en el segundo paso
  function resetSelectsInSecondStep() {
    // Limpia y desactiva los elementos en el segundo paso
    $("#distribuidor, #dateInput, #time").each(function () {
      // Restablece el valor y deshabilita los campos de fecha y hora
      if ($(this).is("input[type='date']")) {
        $(this).val("");
        $(this).attr("min", "");
        $(this).prop("disabled", true); // Usa prop() en lugar de attr() para deshabilitar
      } else if ($(this).is("select")) {
        if ($(this).attr("id") !== "time") {
          resetOptions($(this));
        }
        $(this).prop("disabled", true); // Usa prop() en lugar de attr() para deshabilitar
      }
    });

    // Llama a la función para actualizar el botón de continuar
    verificarCamposPaso2();
  }

  function resetSelectsInSecondStep1() {
    // Limpia y desactiva los elementos en el segundo paso
    $("#dateInput, #time").each(function () {
      // Restablece el valor y deshabilita los campos de fecha y hora
      if ($(this).is("input[type='date']")) {
        $(this).val("");
        $(this).attr("min", "");
        $(this).prop("disabled", true); // Usa prop() en lugar de attr() para deshabilitar
      } else if ($(this).is("select")) {
        if ($(this).attr("id") !== "time") {
          resetOptions($(this));
        }
        $(this).prop("disabled", true); // Usa prop() en lugar de attr() para deshabilitar
      }
    });

    // Llama a la función para actualizar el botón de continuar
    verificarCamposPaso2();
  }

  // Llama a la función cuando cambie el valor de los campos del paso 2
  $("#distribuidor, #dateInput, #time").change(function () {
    verificarCamposPaso2();
  });

  // Llama a la función cuando se cargue la página para realizar la verificación inicial
  verificarCamposPaso2();

  $("#name, #apellido, #tel, #email").change(function () {
    verificarCamposPaso3();
  });

  verificarCamposPaso3();

  // Asigna el evento change a los select para llamar a la función cuando cambien
  $("#marca, #modelo, #anio, #vehiculo, #tipo_servicio").change(function () {
    actualizarBotonContinuar();
  });

  $("#distribuidor").change(function () {
    resetSelectsInSecondStep1();
    if ($(this).val() === "") {
      // Si no se ha seleccionado ningún distribuidor, reinicia los campos de fecha y hora
      resetSelectsInSecondStep1();
    } else {
      // Si se ha seleccionado un distribuidor, habilita el campo de fecha
      $("#dateInput").removeAttr("disabled");
      verificarCamposPaso2();
    }
  });

  // Función para habilitar el siguiente paso (hora) al seleccionar una fecha
  $("#dateInput").change(function () {
    // Habilita el select de hora
    $("#time").removeAttr("disabled");
    verificarCamposPaso2();
  });

  // Evento change para el select de marca en el segundo paso
  $("#modelo").change(function () {
    resetSelectsInSecondStep();
  });

  // Evento change para el select de año en el segundo paso
  $("#anio").change(function () {
    resetSelectsInSecondStep();
  });

  // Evento change para el select de vehículo en el segundo paso
  $("#vehiculo").change(function () {
    resetSelectsInSecondStep();
  });

  const nextButton = document.querySelector(".btn-next");
  const prevButton = document.querySelector(".btn-prev");
  const submitButton = document.querySelector(".btn-submit"); // Agrega esta línea
  const steps = document.querySelectorAll(".step");
  const form_steps = document.querySelectorAll(".form-step");
  let active = 1;

  nextButton.addEventListener("click", () => {
    active++;
    if (active > steps.length) {
      active = steps.length;
    }
    updateProgress();
    actualizarBotonContinuar(); // Agrega esta línea para actualizar el botón de continuar
    verificarCamposPaso2();

    // Agrega esta lógica para cambiar el texto del botón al llegar al paso 3
    if (active === steps.length) {
      nextButton.style.display = "none";
      submitButton.style.display = "inline-block";
    }
  });

  prevButton.addEventListener("click", () => {
    active--;
    if (active < 1) {
      active = 1;
    }
    updateProgress();
    verificarCamposPaso2();
    actualizarBotonContinuar();

    // Agrega esta lógica para cambiar el texto del botón al regresar al paso 2
    if (active !== steps.length) {
      nextButton.style.display = "inline-block";
      submitButton.style.display = "none";
    }
  });

  submitButton.addEventListener("click", () => {});

  const updateProgress = () => {
    console.log("steps.length => " + steps.length);
    console.log("active => " + active);

    // toggle .active class for each list item
    steps.forEach((step, i) => {
      if (i === active - 1) {
        step.classList.add("active");
        form_steps[i].classList.add("active");
        console.log("i => " + 1);
      } else {
        step.classList.remove("active");
        form_steps[i].classList.remove("active");
      }
    });

    // enable or disable prev and next
    if (active === 1) {
      prevButton.disabled = true;
    } else if (active === steps.length) {
      nextButton.disabled = true;
    } else {
      prevButton.disabled = false;
      nextButton.disabled = false;
    }
  };

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
  document.getElementById("dateInput").min = currentDate;

  // Agrega el siguiente código para desactivar la selección de fechas anteriores en el calendario
  // Evento change para el campo de fecha
  document.getElementById("dateInput").addEventListener("input", function () {
    var selectedDate = this.value;
    cargarHorasDisponibles(selectedDate);

    // Verifica si la fecha seleccionada es anterior a la fecha mínima
    if (new Date(selectedDate) < today) {
      // Si es anterior, restablece la fecha mínima
      this.value = currentDate;
      cargarHorasDisponibles(currentDate);
    }
  });

  document.getElementById("time").addEventListener("change", function () {
    var selectedTime = this.value;
    var allowedTimes = ["09:00", "11:00", "13:00", "15:00", "17:00"];

    if (selectedTime !== "" && !allowedTimes.includes(selectedTime)) {
      // Si la hora seleccionada no está permitida, establece la primera hora permitida
      this.value = allowedTimes[0];
    }
  });
});