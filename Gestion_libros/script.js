function validarFormulario() {
    const titulo = document.getElementById('titulo').value;
    const autor = document.getElementById('autor').value;
    const precio = document.getElementById('precio').value;
    const cantidad = document.getElementById('cantidad').value;

    if (titulo === '') {
        alert('El campo titulo es obligatorio');
        return false;
    }

    if (autor === '') {
        alert('El campo autor es obligatorio');
        return false;
    }

    if (isNaN(precio) || precio <= 0) {
        alert('El campo precio debe ser un numero mayor a 0');
        return false;
    }

    return true;
}

document.addEventListener("DOMContentLoaded", function() {
    const alerta = document.getElementById("mensajeAlerta");
    if (alerta && alerta.textContent.trim() !== "") {
        alert(alerta.textContent);
    }
});