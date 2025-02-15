function validarFormulario() {
    const titulo = document.getElementById('titulo').value.trim();
    const autor = document.getElementById('autor').value.trim();
    const precio = document.getElementById('precio').value;
    const cantidad = document.getElementById('cantidad').value;
    

    // Validar que el título no esté vacío
    if (titulo === '') {
        alert('El título no puede estar vacío.');
        return false;
    }

    // Validar que el autor no esté vacío
    if (autor === '') {
        alert('El autor no puede estar vacío.');
        return false;
    }

    // Validar que el precio sea un número positivo
    if (isNaN(precio) || precio <= 0) {
        alert('El precio debe ser un número mayor a 0.');
        return false;
    }

    // Validar que la cantidad sea un número positivo
    if (isNaN(cantidad) || cantidad <= 0) {
        alert('La cantidad debe ser un número mayor a 0.');
        return false;
    }

    return true; // El formulario es válido
}
