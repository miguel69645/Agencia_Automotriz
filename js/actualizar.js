document.getElementById('cancelar-button').addEventListener('click', () => {
    const confirmarCancelar = confirm('¿Estás seguro de que deseas cancelar?');
    if (confirmarCancelar) {
        window.location.href = 'admin.php';
    }
});

// Espera a que se cargue el contenido del DOM antes de ejecutar el código
document.addEventListener("DOMContentLoaded", function () {
    // Obtener referencia al formulario y al botón de enviar
    const form = document.querySelector(".login-form");
    const submitButton = form.querySelector(".login-button");

    // Agregar un evento click al botón de enviar
    submitButton.addEventListener("click", function (event) {
        // Verificar cada campo del formulario
        if (form.id === 'usuarios-form') {
            const nombre1 = form.querySelector("#nombre1").value;
            const apellido = form.querySelector("#apellido").value;
            const correo = form.querySelector("#correo").value;
            const telefono = form.querySelector("#telefono").value;
            const tipo1 = form.querySelector("#tipo1").value;
            
            if (!nombre1 || !apellido || !correo || !telefono || !tipo1) {
                event.preventDefault();
                alert("¡Todos los campos deben estar completos!");
            }
        } else if (form.id === 'vehiculos-form') { // Change 'vehiculo-form' to 'login-form'
            const nombre = form.querySelector("#nombre").value;
            const precio = form.querySelector("#precio").value; // Update input IDs
            const descripcion = form.querySelector("#descripcion").value;
            const fotografia = form.querySelector("#fotografia").value;
            const color = form.querySelector("#color").value;
            const modelo = form.querySelector("#modelo").value;
            const version = form.querySelector("#version").value;
            const marca = form.querySelector("#marca").value;
            const tipo2 = form.querySelector("#tipo2").value;
            const ano = form.querySelector("#ano").value;
            const pasajeros = form.querySelector("#pasajeros").value;
        
            if (!nombre || !precio || !descripcion || !fotografia || !color || !modelo || !version || !marca || !tipo2 || !ano || !pasajeros) {
                event.preventDefault();
                alert("¡Todos los campos deben estar completos!");
            }

        } else if (form.id === 'categorias-form') { // Change 'vehiculo-form' to 'login-form'
            const nombre2 = form.querySelector("#nombre2").value;
            const descripcion1 = form.querySelector("#descripcion2").value; // Update input IDs
        
            if (!nombre2 || !descripcion1) {
                event.preventDefault();
                alert("¡Todos los campos deben estar completos!");
            }

        } else if (form.id === 'sucursals-form') { // Change 'vehiculo-form' to 'login-form'
            const nombre3 = form.querySelector("#nombre3").value;
            const domicilio3 = form.querySelector("#domicilio3").value; // Update input IDs
            const telefono3 = form.querySelector("#telefono3").value; // Update input IDs
            const correo3 = form.querySelector("#correo3").value; // Update input IDs
            const vehiculo3 = form.querySelector("#idvehiculo3").value; // Update input IDs
        
            if (!nombre3 || !domicilio3 || !telefono3 || !correo3 || !vehiculo3) {
                event.preventDefault();
                alert("¡Todos los campos deben estar completos!");
            }
        } else if (form.id === 'servicios-form') { // Change 'vehiculo-form' to 'login-form'
            const nombre4 = form.querySelector("#nombre4").value;
            const costo = form.querySelector("#costo").value;
            const descripcion4 = form.querySelector("#descripcion4").value; // Update input IDs
        
            if (!nombre4 || !costo || !descripcion4) {
                event.preventDefault();
                alert("¡Todos los campos deben estar completos!");
            }
        } else if (form.id === 'citas-form') { // Change 'vehiculo-form' to 'login-form'
            const estatus = form.querySelector("#estatus").value; // Update input IDs
        
            if (!estatus) {
                event.preventDefault();
                alert("¡Todos los campos deben estar completos!");
            }
        }
    });
});