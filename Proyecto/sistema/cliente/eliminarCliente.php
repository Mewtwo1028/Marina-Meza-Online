<?php 
    if(!isset($_GET['idCliente'])){
        header('Location: ../cliente.php?mensajeC=Ha ocurrido un error');
        exit();
    }

    include '../empleado/model/conecEmple.php';
    $idCliente = $_GET['idCliente'];


    $sentencia = $bd->prepare("DELETE FROM cliente where idCliente = ?;");
    $resultado = $sentencia->execute([$idCliente]);

    if ($resultado === TRUE) {
        header('Location: ../cliente.php?mensajeC=eliminado');
    } else {
        header('Location: ../cliente.php?mensajeC=Ha ocurrido un error');
    }
