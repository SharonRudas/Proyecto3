<?php
    //print_r($_POST);
    if(empty($_POST["oculto"]) || empty($_POST["nprod"]) || empty($_POST["marca"]) || empty($_POST["medida"])|| empty($_POST["precio"])|| empty($_POST["stock"])){
        header('Location: tabla-producto.php?mensaje=falta');
        exit();
    }

    include_once 'conect.php';
    $nprod = $_POST["nprod"];
    $marca = $_POST["marca"];
    $medida = $_POST["medida"];
    $precio = $_POST["precio"];
    $stock = $_POST["stock"];
    
    $sentencia = $bd->prepare("INSERT INTO producto(nprod,marca,medida,precio,stock) VALUES (?,?,?,?,?);");
    $resultado = $sentencia->execute([$nprod,$marca,$medida,$precio,$stock]);

    if ($resultado === TRUE) {
        header('Location: tabla-producto.php?mensaje=registrado');
    } else {
        header('Location: tabla-producto.php?mensaje=error');
        exit();
    }
    
?>