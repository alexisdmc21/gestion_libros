function validarFormulario() {
    const titulo = document.getElementById('titulo').value;
    const autor = document.getElementById('autor').value;
    const precio = document.getElementById('precio').value;
    const cantidad = document.getElementById('cantidad').value;

const regex = /^[a-zA-Z]+$/;
    if(!titulo.trim() && !autor.trim() && !precio.trim() && !cantidad.trim()){
       alert('Todos los campos deben ser llenados');
        return false;
   }else{
   
    if (!titulo.trim()) 
        alert('El campo titulo es obligatorio');
    else

    if (!autor.trim()) 
        alert('El campo autor es obligatorio');
    else

    if (!regex.test(autor.trim())) 
        alert('El campo autor debe llevar solo caractéres');
     
    else

    if (isNaN(precio) || precio <= 0) 
        alert('El campo precio debe ser un numero mayor a 0');
        
    else

    if (isNaN(cantidad) || cantidad <= 0) 
        alert('El campo cantidad debe ser un numero mayor a 0');
       else{
        return true;
       }
      return false;
    }
}
