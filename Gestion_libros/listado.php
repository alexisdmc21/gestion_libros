<?php include 'header.php'; ?>
<?php include 'libros.php';
$libros = obtenerLibros();
 ?>
 
<div class="container mt-4">
<h1>Lista de libros registrados</h1>
    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Autor</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php renderizarTabla($libros); ?>
        </tbody>
    </table>
    </div>

<?php include 'footer.php'; ?>

