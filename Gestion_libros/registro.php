<?php include 'header.php'; ?>
<?php include 'libros.php'; ?>

<div class="container mt-4">
<h1>Registrar Libro</h1>
    <div class="form-container">
        <form id="form_libros" method="POST" onsubmit="return validarFormulario()">
            <label for="titulo">Titulo</label>
            <input type="text" name="titulo" id="titulo">
            <label for="autor">Autor</label>
            <input type="text" name="autor" id="autor">
            <label for="precio">Precio</label>
            <input type="number" name="precio" id="precio">
            <label for="cantidad">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad">
            <button type="submit">
                  <?php echo isset($index)?'Actualizar': 'Registrar';?>   
            </button>
        </form>
</div>

<?php include 'footer.php'; ?>