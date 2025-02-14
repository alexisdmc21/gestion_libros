# Actividad de aprendizaje N.°2 - 2do Parcial
# Desarrollo de un sistema web de gestión de libros y autores

# Integrantes:

- Alexis Damian Morales Cuasquer
- Jessica Estefania Sanchez Ugsiña
- Melanie Abigail Talavera Castillo

# Descripción de la actividad

Deberán desarrollar un sistema web utilizando PHP, basado en el código proporcionado (para la gestión de productos), pero adaptado para gestionar libros y autores. 

# Desarrollo

Este sistema web permite gestionar libros y autores utilizando PHP y JavaScript. Su funcionalidad principal incluye el registro, actualización, eliminación y listado de libros.

El sistema está dividido en varios archivos para una mejor organización:

- La página principal (index.php) muestra un mensaje de bienvenida y un botón para acceder al formulario de registro.
- Registro de libros (registro.php) incluye un fromulario, en el cual se debe ingresar: título del libro, nombre del autor, precio y cantidad de ejemplares disponibles.
Antes de enviar los datos, un script en JavaScript (script.js) valida que los campos de texto no estén vacíos y que los valores numéricos sean positivos. Además, el sistema no permite ingresar números negativos en los campos de precio y cantidad.
- La página de listado (listado.php) muestra todos los libros registrados en una tabla, permitiendo visualizar los datos almacenados, cada fila de la tabla incluye opciones para editar o eliminar un libro. Al eliminar un libro, el sistema muestra un mensaje de confirmación indicando que el libro ha sido eliminado correctamente.
- Contacto (contacto.php) presenta los datos de contacto de los integrantes, como su número telefónico y correo electrónico.
