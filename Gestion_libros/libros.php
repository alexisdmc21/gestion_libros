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

// Variables para manejar mensajes y valores del formulario
$alerta = ''; // Mensaje para alertar al usuario
$nombre = ''; // Nombre del producto (vacío por defecto)
$precio = ''; // Precio del producto (vacío por defecto)
$stock = ''; // Stock del producto (vacío por defecto)
$index = null; // Índice del producto para edición

//Gestionar valores en el formulario//
if($_SERVER['REQUEST_METHOD']==='POST'){
    $titulo = $_POST['titulo']??'';
    $autor = $_POST['autor']??'';
    $precio = $_POST['precio']??0;
    $cantidad = $_POST['cantidad']??0;
    $index = $_POST['index']??null;
  
  
  if($index !==null && is_numeric($index)){
      if(actualizarlibros((int)$index,$titulo,$autor,$precio,$cantidad)){
          $alerta = "Libro actualizado correctamente";

          $titulo = $autor = $precio = $cantidad = '';
      }else{
          $alerta ="No se pudo actualizar";
      }
  }else{ 
      if(agregarlibros($titulo,$autor,$precio,$cantidad)){
          $alerta = "Libro registrado correctamente";
          
            $titulo = $autor = $precio = $cantidad = '';
            $index = null;
      }else{
          $alerta ="No se pudo registrar";
          $index = null;
      }
  
    }
  
  }
  
  //gestionar las acciones de eliminar y editar
  if($_SERVER['REQUEST_METHOD']==='GET'){
      $action = $_GET['action']??'';
      $index = $_GET['index']??null;
  
      
  if($action==='eliminar' && is_numeric($index)){
      if(eliminarlibros((int)$index)){
          $alerta = "Libro eliminado correctamente";
      }else{
          $alerta ="No fue posible eliminar";
      }
  }else
      if($action==='editar' && is_numeric($index)){
          $libro = $_SESSION['libros'][$index] ?? null;
          if($libro){
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
        echo "<tr><td colspan='6'>No existen productos</tr></td>";
    } else {
        foreach ($libros as $index => $libro) {
            echo "
                <tr>
                    <td>" . ($index + 1) . "</td>
                    <td>".$libro['titulo']."</td>
                    <td>".$libro['autor']."</td>
                    <td>".$libro['precio']."</td>
                    <td>".$libro['cantidad']."</td>
                    <td>
                       <a href='registro.php?action=editar&index=" . $index . "' class='btn btn-warning btn-sm'>Editar</a>
                        <a href='?action=eliminar&index=$index' class='btn btn-danger btn-sm'>Eliminar</a>
                    </td>
                </tr>
                ";
        }
    }
}

if(!empty($alerta)){
    echo "<script>alert('$alerta')</script>";
}
?>