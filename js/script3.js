$(document).ready(function () {
  // Asignación de valores a los campos
  document.getElementById("marca").value = sessionStorage.getItem("marca");
  document.getElementById("modelo").value = sessionStorage.getItem("modelo");
  document.getElementById("anio").value = sessionStorage.getItem("anio");
  document.getElementById("vehiculo").value =
    sessionStorage.getItem("vehiculo");
  document.getElementById("tipo_servicio").value =
    sessionStorage.getItem("tipo_servicio");

  // Función para resetear opciones y deshabilitar el selector
  function resetOptions(selector) {
    selector.html("<option value=''>Selecciona una opción</option>");
    selector.attr("disabled", "disabled");
  }

  function obtenerDatosDistribuidores(successCallback) {
    var marca = $("#marca").val().trim();
    var modelo = $("#modelo").val().trim();
    var anio = $("#anio").val().trim();
    var vehiculo = $("#vehiculo").val().trim();
    var tipo_servicio = $("#tipo_servicio").val().trim();
    var selectorID = "distribuidor";
    var defaultOption = "Selecciona una opción";
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
      .fail(function (jqXHR, textStatus, errorThrown) {
        console.error("Error al obtener datos:", textStatus, errorThrown);
        console.log("Datos recibidos en caso de error:", jqXHR.responseText);
      });
  }

  // Función para verificar la disponibilidad de una hora específica en una fecha dada
  function verificarDisponibilidadHora(selectedDate, allowedTimes) {
    var selectedSucursal = $("#distribuidor").val();
    $.ajax({
      type: "POST",
      url: "../a_leer/verificarDisponibilidad.php",
      data: {
        dateInput: selectedDate,
        time: allowedTimes,
        distribuidor: selectedSucursal,
      },
      dataType: "json",
    })
      .done(function (data) {
        // Limpiar el select antes de agregar nuevas opciones
        $("#time").empty();

        // Crear y agregar las opciones basadas en la disponibilidad
        $.each(allowedTimes, function (index, allowedTime) {
          var option = $("<option>", {
            value: allowedTime,
            text: allowedTime,
          });

          console.log("Hora permitida actual:", allowedTime);
          console.log("Horas ocupadas recibidas:", data);

          if (data && data.some((ocupada) => ocupada.startsWith(allowedTime))) {
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

    // Obtén los valores de los campos
    var marca = $("#marca").val().trim();
    var modelo = $("#modelo").val().trim();
    var anio = $("#anio").val().trim();
    var vehiculo = $("#vehiculo").val().trim();
    var tipo_servicio = $("#tipo_servicio").val().trim();
    var distribuidor = $("#distribuidor").val().trim();
    var dateInput = $("#dateInput").val().trim();
    var time = $("#time").val().trim();
    var name = $("#name").val().trim();
    var apellido = $("#apellido").val().trim();
    var tel = $("#tel").val().trim();
    var email = $("#email").val().trim();

    console.log("dato1: " + marca);
    console.log("dato2: " + modelo);
    console.log("dato3: " + anio);
    console.log("dato4: " + vehiculo);
    console.log("dato5: " + tipo_servicio);
    console.log("dato6: " + distribuidor);
    console.log("dato7: " + dateInput);
    console.log("dato8: " + time);
    console.log("dato9: " + name);
    console.log("dato10: " + apellido);
    console.log("dato11: " + tel);
    console.log("dato12: " + email);
    // Realiza las validaciones
    if (
      !marca ||
      !modelo ||
      !anio ||
      !vehiculo ||
      !tipo_servicio ||
      !distribuidor ||
      !dateInput ||
      !time ||
      !name ||
      !apellido ||
      !tel ||
      !email
    ) {
      // Si algún campo está vacío, muestra un mensaje de error o realiza la lógica que desees
      alert(
        "Por favor, completa todos los campos antes de enviar el formulario."
      );
      return;
    }

    // Si todos los campos tienen valores, realiza la solicitud AJAX
    $.ajax({
      type: "POST",
      url: "../a_insertar/newFormulario.php",
      data: {
        marca: marca,
        modelo: modelo,
        anio: anio,
        vehiculo: vehiculo,
        tipo_servicio: tipo_servicio,
        distribuidor: distribuidor,
        dateInput: dateInput,
        time: time,
        name: name,
        apellido: apellido,
        tel: tel,
        email: email,
      },
      dataType: "json",
      success: function (response) {
        console.log(response);
        if (response.status === "success") {
          alert("Éxito: " + response.message);
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

  // Función para habilitar/deshabilitar el botón de continuar
  function actualizarBotonContinuar() {
    var marca = $("#marca").val().trim();
    var modelo = $("#modelo").val().trim();
    var anio = $("#anio").val().trim();
    var vehiculo = $("#vehiculo").val().trim();
    var tipo_servicio = $("#tipo_servicio").val().trim();

    // Si el campo de vehiculo tiene datos, habilita el campo de distribuidor
    if (vehiculo) {
      $("#distribuidor").removeAttr("disabled");
    } else {
      $("#distribuidor").attr("disabled", "disabled");
    }

    // Si alguno de los campos está vacío o undefined, desactiva el botón
    if (!marca || !modelo || !anio || !vehiculo || !tipo_servicio) {
      $(".btn-next").prop("disabled", true);
    } else {
      // Si todos los campos están llenos, habilita el botón
      $(".btn-next").prop("disabled", false);
    }
  }

  // Llamada inicial a la función para actualizar el botón
  actualizarBotonContinuar();
  obtenerDatosDistribuidores();

  // Función para verificar si los campos del paso 2 están vacíos y desactivar el botón de continuar
  function verificarCamposPaso2() {
    var distribuidor = $("#distribuidor").val();
    var fechaCita = $("#dateInput").val();
    var horaCita = $("#time").val();

    // Si el campo de fecha cita tiene datos, habilita el campo de fecha
    if (fechaCita) {
      $("#time").removeAttr("disabled");
    } else {
      $("#time").attr("disabled", "disabled");
    }

    // Si alguno de los campos está vacío o undefined, desactiva el botón
    if (!distribuidor || !fechaCita || !horaCita) {
      console.log("Campos vacios");
      $(".btn-next").prop("disabled", true);
    } else {
      console.log("Campos correctos");
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

  // Evento de cambio en los campos
  $("#marca, #modelo, #anio, #vehiculo, #tipo_servicio").change(function () {
    actualizarBotonContinuar();
  });

  // Llama a la función cuando cambie el valor de los campos del paso 2
  $("#distribuidor, #dateInput, #time").change(function () {
    verificarCamposPaso2();
  });

  // Llama a la función cuando se cargue la página para realizar la verificación inicial
  // verificarCamposPaso2();

  $("#name, #apellido, #tel, #email").change(function () {
    verificarCamposPaso3();
  });

  // verificarCamposPaso3();

  // Función para habilitar el siguiente paso (fecha) al seleccionar un distribuidor
  $("#distribuidor").change(function () {
    // Elimina llamadas innecesarias a resetSelectsInSecondStep1
    // resetSelectsInSecondStep1();

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
