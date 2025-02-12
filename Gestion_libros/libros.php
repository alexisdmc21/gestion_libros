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