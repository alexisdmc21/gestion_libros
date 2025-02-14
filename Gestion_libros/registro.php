<?php include 'header.php'; ?>
<?php include 'libros.php'; ?>

<div class="container mt-4">
<h1>Registrar Nuevo Libro</h1>
    <div class="form-container">
        <form id="form_libros" method="POST" onsubmit="return validarFormulario()">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" required class="form-control">
        
        <label for="autor">Autor:</label>
        <input type="text" name="autor" required class="form-control">
        
        <label for="precio">Precio:</label>
        <input type="number" name="precio" min="1" required class="form-control">
        
        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" min="1" required class="form-control">
        
        <button type="submit" class="btn btn-primary mt-2">Registrar</button>
        </form>
</div>

<?php include 'footer.php'; ?>