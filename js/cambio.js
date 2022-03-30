function displayPassword() {
    document.getElementById("cambio_password").classList.remove("d-none");
    document.getElementById("cambio_datos").classList.add("d-none");
    document.getElementById("cambio_direccion").classList.add("d-none");
    }

function displayDatos() {
    document.getElementById("cambio_password").classList.add("d-none");
    document.getElementById("cambio_datos").classList.remove("d-none");
    document.getElementById("cambio_direccion").classList.add("d-none");
}

function displayDireccion() {
    document.getElementById("cambio_direccion").classList.remove("d-none");
    document.getElementById("cambio_password").classList.add("d-none");
    document.getElementById("cambio_datos").classList.add("d-none");
}
