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
    if (validarCampos($titulo, $autor, $precio, $cantidad)) {
        $_SESSION['libros'][] = [
            'titulo' => htmlspecialchars($titulo),
            'autor' => htmlspecialchars($autor),
            'precio' => (float) $precio,
            'cantidad' => (int) $cantidad
        ];
        return true;
    }
    return false;
}

function actualizarlibros($index, $titulo, $autor, $precio, $cantidad)
{
    if (isset($_SESSION['libros'][$index]) && validarCampos($titulo, $autor, $precio, $cantidad)) {
        $_SESSION['libros'][$index] = [
            'titulo' => htmlspecialchars($titulo),
            'autor' => htmlspecialchars($autor),
            'precio' => (float) $precio,
            'cantidad' => (int) $cantidad
        ];
        return true;
    }
    return false;
}

function eliminarlibros($index)
{
    if (isset($_SESSION['libros'][$index])) {
        array_splice($_SESSION['libros'], $index, 1);
        return true;
    }
    return false;
}

function validarCampos($titulo, $autor, $precio, $cantidad)
{
    return !empty($titulo) && !empty($autor) && $precio > 0 && $cantidad > 0;
}

$alerta = '';
$titulo = '';
$autor = '';
$precio = '';
$cantidad = '';
$index = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'] ?? '';
    $autor = $_POST['autor'] ?? '';
    $precio = $_POST['precio'] ?? 0;
    $cantidad = $_POST['cantidad'] ?? 0;
    $index = $_POST['index'] ?? null;

    if ($index !== null && is_numeric($index)) {
        if (actualizarlibros($index, $titulo, $autor, $precio, $cantidad)) {
            $alerta = 'Libro actualizado correctamente';
            $titulo = $autor = $precio = $cantidad = '';
        } else {
            $alerta = 'No se pudo actualizar el libro';
        }
    } else {
        if (agregarlibros($titulo, $autor, $precio, $cantidad)) {
            $alerta = 'Libro registrado correctamente';
            $titulo = $autor = $precio = $cantidad = '';
        } else {
            $alerta = 'No se pudo registrar el libro';
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_GET['action'] ?? '';
    $index = $_GET['index'] ?? null;

    if ($action == 'delete' && is_numeric($index)) {
        if (eliminarlibros((int)$index)) {
            $alerta = 'Libro eliminado correctamente';
        } else {
            $alerta = 'No se pudo eliminar el libro';
        }
    } elseif ($action == 'edit' && is_numeric($index)) {
        $libro = $_SESSION['libros'][$index] ?? null;
        if ($libro) {
            $titulo = $libro['titulo'];
            $autor = $libro['autor'];
            $precio = $libro['precio'];
            $cantidad = $libro['cantidad'];
            $index = (int)$index;
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
                        <a href='?action=edit&index=$index' class='btn btn-warning btn-sm'>Editar</a>
                        <a href='?action=delete&index=$index' class='btn btn-danger btn-sm'>Eliminar</a>
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema Gestor de Libros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<script>
    function validarFormulario() {
        const titulo = document.getElementById('titulo').value;
        const autor = document.getElementById('autor').value;
        const precio = document.getElementById('precio').value;
        const cantidad = document.getElementById('cantidad').value;

        if (titulo === '') {
            alert('El campo titulo es obligatorio');
            return false;
        }

        if (autor === '') {
            alert('El campo autor es obligatorio');
            return false;
        }

        if (isNaN(precio) || precio <= 0) {
            alert('El campo precio debe ser un numero mayor a 0');
            return false;
        }

        return true;
    }

    <?php if (!empty($alerta)) : ?>
        alert('<?php echo $alerta; ?>');
    <?php endif; ?>
</script>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary " data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="https://www.espe.edu.ec/">
                <img src="https://encuestas.espe.edu.ec/tmp/assets/46dd5aad/ESPE.png" alt="ESPE Logo" width="36" height="40" class="me-2 align-middle">
                ESPE
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Registrar Libro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Listado de Libros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <h1>Sistema de gestion de libros</h1>
    <div class="form-container">
        <form id="form_libros" method="POST">
            <label for="titulo">Titulo</label>
            <input type="text" name="titulo" id="titulo">
            <label for="autor">Autor</label>
            <input type="text" name="autor" id="autor">
            <label for="precio">Precio</label>
            <input type="number" name="precio" id="precio">
            <label for="cantidad">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad">
            <button type="submit">Registrar</button>
        </form>
    </div>
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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>