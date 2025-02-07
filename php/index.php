<?php
session_start();

if (!isset($_SESSION['libros'])) {
    $_SESSION['libros'] = [];
}

function obtenerlibros()
{
    return $_SESSION['libros'];
}

function agregarlibros($titulo, $autor, $precio, $cantidad)
{
    if (!empty($titulo) && !empty($autor) && $precio > 0 && $cantidad > 0) {
        $_SESSION['libros'][] = [
            'titulo' => htmlspecialchars($titulo),
            'autor' => htmlspecialchars($autor),
            'precio' => (float)$precio,
            'cantidad' => (int)$cantidad
        ];
        return true;
    }
    return false;
}

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'] ?? '';
    $autor = $_POST['autor'] ?? '';
    $precio = $_POST['precio'] ?? 0;
    $cantidad = $_POST['cantidad'] ?? 0;

    if (empty($titulo) || empty($autor)) {
        $mensaje = 'Titulo y autor no pueden estar vacios';
    } elseif ($precio <= 0 || $cantidad <= 0) {
        $mensaje = 'Precio y cantidad deben ser valores positivos';
    } else {
        if (agregarlibros($titulo, $autor, $precio, $cantidad)) {
            $mensaje = 'Libro agregado correctamente';
        } else {
            $mensaje = 'Error al agregar el libro';
        }
    }
}



$libros = obtenerlibros();

function renderizarTabla($libros)
{
    if (empty($libros)) {
        echo "<tr><td>No existen productos</tr></td>";
    } else {
        foreach ($libros as $index => $libro) {
            echo "
                <tr>
                    <td>" . ($index + 1) . "</td>
                    <td>{$libro['titulo']}</td>
                    <td>{$libro['autor']}</td>
                    <td>{$libro['precio']}</td>
                    <td>{$libro['cantidad']}</td>
                    <td>
                        <a href='editar.php?id=$index'>Editar</a> |
                        <a href='eliminar.php?id=$index'>Eliminar</a>
                    </td>
                </tr>
                ";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Sistema de gestion de libros</h1>
    <div class="form-container">
        <form id="form_libros" method="POST">
            <label for="titulo">Titulo</label>
            <input type="text" name="titulo" id="titulo" >
            <label for="autor">Autor</label>
            <input type="text" name="autor" id="autor" >
            <label for="precio">Precio</label>
            <input type="number" name="precio" id="precio" >
            <label for="cantidad">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" >
            <button type="submit">Registrar</button>
        </form>
    </div>
    <h3>Lista de libros</h3>
    <table>
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
            <?php echo $mensaje; ?>
            <?php renderizarTabla($libros); ?>
        </tbody>
</body>

</html>