<?php 
    if(!isset($_GET['id'])){
        header('Location: tabla-producto.php?mensaje=error');
        exit();
    }

    include 'conect.php';
    $id = $_GET['id'];

    $sentencia = $bd->prepare("call SP_ELIMINAR('$id')");
    //call sp_eliminar ('$id')
    $resultado = $sentencia->execute([$id]);

    if ($resultado === TRUE) {
        header('Location: insertar-producto.php?mensaje=eliminado');
    } else {
        header('Location: tabla-producto.php?mensaje=error');
    }
    
?>