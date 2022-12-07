<?php
    print_r($_POST);
    if(!isset($_POST['id'])){
        header('Location: index.php?mensaje=error');
    }

    include 'conect.php';
    $id = $_POST["id"];
    $nprod = $_POST["nprod"];
    $marca = $_POST["marca"];
    $medida = $_POST["medida"];
    $precio = $_POST["precio"];
    $stock = $_POST["stock"];

    //$sentencia = $bd->prepare("CALL SP_ACTUALIZAR('$nprod','$marca','$medida','$precio','$stock','$id')");
    $sentencia = $bd->prepare("UPDATE producto SET nprod = ?, marca = ?, medida = ?,precio = ?,stock = ? where id = ?;");
    $resultado = $sentencia->execute([$nprod, $marca, $medida,$precio,$stock, $id]);

    if ($resultado === TRUE) {
        header('Location: tabla-producto.php?mensaje=editado');
    } else {
        header('Location: tabla-producto.php?mensaje=error');
        exit();
    }
    
?>