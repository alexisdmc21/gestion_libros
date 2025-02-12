<?php include 'header.php'; ?>
<?php include 'libros.php'; ?>

<h3>Lista de libros</h3>
    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th>Id</th>
                <th>Titulo</th>
                <th>Autor</th>
                <th>Precio</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $alerta; ?>
            <?php renderizarTabla($libros); ?>
        </tbody>
    </table>

<?php include 'footer.php'; ?>