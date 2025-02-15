<?php include 'header.php'; ?>
<?php include 'libros.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg p-4">
                <h2 class="text-center mb-4">
                    <?php echo isset($index) ? 'Editar Libro' : 'Registrar Nuevo Libro'; ?>
                </h2>
                <form id="form_libros" method="POST" onsubmit="return validarFormulario()">
                    <input type="hidden" name="index" value="<?php echo htmlspecialchars($index ?? ''); ?>">

                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título:</label>
                        <input type="text" id="titulo" name="titulo" class="form-control" value="<?php echo htmlspecialchars($titulo ?? ''); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="autor" class="form-label">Autor:</label>
                        <input type="text" id="autor" name="autor" class="form-control" value="<?php echo htmlspecialchars($autor ?? ''); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio:</label>
                        <input type="number" id="precio" name="precio" class="form-control" min="1" value="<?php echo htmlspecialchars($precio ?? ''); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad:</label>
                        <input type="number" id="cantidad" name="cantidad" class="form-control" min="1" value="<?php echo htmlspecialchars($cantidad ?? ''); ?>">
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <?php echo isset($index) ? 'Actualizar' : 'Registrar'; ?>
                        </button>
                        <?php if (isset($index)): ?>
                            <a href="listado.php" class="btn btn-secondary">Cancelar</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
