document.addEventListener('DOMContentLoaded', validacion);

function validacion() {
    let idsErrores = document.querySelectorAll('[id^=error');
    for (let idError in idsErrores) {
        idsErrores[idError].innerHTML = "";
    }
    document.getElementById('form').addEventListener('submit', function(event) {
        let inputs = event.target;
        for (let i in inputs) {
            if (inputs[i]?.tagName?.toLowerCase() === 'input') {
                let id = inputs[i].getAttribute('id').replace('#', '');
                if (inputs[i].value.length === 0) {
                    document.getElementById('error' + id).innerHTML = id + ' no debe estar vacio!!!';
                    event.preventDefault();
                } else if ((inputs[i].getAttribute('id') === 'email' || inputs[i].getAttribute('type') === 'email') && !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(inputs[i].value)) {
                    document.getElementById('error' + id).innerHTML = id + ' no es un email válido!!!';
                    event.preventDefault();
                } else {
                    document.getElementById('error' + id).innerHTML = '';
                }
            }
        }
    });
}