<?php include 'header.php'; ?>
<?php include 'libros.php'; ?>

<div class="container mt-4">
<h1><?php echo isset($index) ? 'Editar tu Libro!!' : 'Registrar Nuevo Libro'; ?></h1>
    <div class="form-container">
        <form id="form_libros" method="POST" onsubmit="return validarFormulario()">
        <input type="hidden" name="index" value="<?php echo htmlspecialchars($index ?? ''); ?>">

        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($titulo ?? ''); ?>">
        
        <label for="autor">Autor:</label>
        <input type="text" id="autor" name="autor" value="<?php echo htmlspecialchars($autor ?? ''); ?>">
        
        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" min="1" value="<?php echo htmlspecialchars($precio ?? ''); ?>">
        
        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" min="1" value="<?php echo htmlspecialchars($cantidad ?? ''); ?>">
        
        <button type="submit"><?php echo isset($index) ? 'Actualizar' : 'Registrar'; ?></button>


        <?php if ($index !== null): ?>
                <a href="listado.php">Cancelar</a>
            <?php endif; ?>
    </a>
        </form>
</div>

<?php include 'footer.php'; ?>
</body>
</html>