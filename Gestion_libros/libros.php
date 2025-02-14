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

//Gestionar valores en el formulario//
if($_SERVER['REQUEST_METHOD']==='POST'){
    $titulo = $_POST['titulo']??'';
    $autor = $_POST['autor']??'';
    $precio = $_POST['precio']??0;
    $cantidad = $_POST['cantidad']??0;
    $index = $_POST['index']??null;
  
  
  if(!$index ===null && is_numeric($index)){
      if(actualizarlibro((int)$index,$titulo,$nombre,$precio,$cantidad)){
          $alerta = "Se actualizo  correctamente";
        
      }else{
          $alerta ="No se pudo actualizar";
      }
  }else{ 
      if(agregarlibros($titulo,$autor,$precio,$cantidad)){
          $alerta = "Se actualizo  correctamente";
          
      }else{
          $alerta ="No se pudo actualizar";
      }
  
    }
  
  }
  
  //gestionar las acciones de eliminar y editar
  if($_SERVER['REQUEST_METHOD']==='GET'){
      $action = $_GET['action']??'';
      $index = $_GET['index']??null;
  
      
  if($action==='eliminar' && is_numeric($index)){
      if(eliminarlibros($index)){
          $alerta = "Se elimino correctamente";
      }else{
          $alerta ="No se pudo eliminar";
      }
  }else
      if($action==='editar' && is_numeric($index)){
          $libro = $_SESSION['libros'][$index] ?? null;
          if($libro){
          $titulo = $libro['titulo'];
          $autor = $libro['autor'];
          $precio = $libro['precio'];
          $cantidad = $libro['cantidad'];
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
                    <td>".$libro['titulo']."</td>
                    <td>".$libro['autor']."</td>
                    <td>".$libro['precio']."</td>
                    <td>".$libro['cantidad']."</td>
                    <td>
                        <a href='?action=editar&index=$index' class='btn btn-warning btn-sm'>Editar</a>
                        <a href='?action=eliminar&index=$index' class='btn btn-danger btn-sm'>Eliminar</a>
                    </td>
                </tr>
                ";
        }
    }
}
?>