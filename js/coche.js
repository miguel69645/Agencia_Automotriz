document.addEventListener("DOMContentLoaded", function () {
    var buyButton = document.querySelector(".buy-button");
  
    if (buyButton) {
      buyButton.addEventListener("click", function () {
        var productId = this.getAttribute("data-id");
  
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "../autos/get_coche.php?product_id=" + productId, true);
  
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {
              if (xhr.status == 200) {
                var data = JSON.parse(xhr.responseText);
          
                // Almacena los datos en sessionStorage
                sessionStorage.setItem("marca", data.marca);
                sessionStorage.setItem("modelo", data.modelo);
                sessionStorage.setItem("anio", data.anio);
                sessionStorage.setItem("vehiculo", data.vehiculo);
                sessionStorage.setItem("tipo_servicio", 'Venta');                 
                // Redirige a la página del formulario
                window.location.href = "../cliente/formulario copy.php";
              } else {
                console.error("Error en la solicitud AJAX. Estado:", xhr.status);
              }
            }
        };
        xhr.send();
      });
    } else {
      console.error("No se encontró el elemento .buy-button en el DOM.");
    }
  });
  