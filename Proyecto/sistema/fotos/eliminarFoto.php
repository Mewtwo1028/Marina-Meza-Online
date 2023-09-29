<?php 
    if(!isset($_GET['idFoto'])){
        header('Location: ../galeria.php?mensajeC=Ha ocurrido un error');
        exit();
    }

    include '../empleado/model/conecEmple.php';
    $idFoto = $_GET['idFoto'];


    $sentencia = $bd->prepare("DELETE FROM fotos where idFoto = ?;");
    $resultado = $sentencia->execute([$idFoto]);

    if ($resultado === TRUE) {
        header('Location: ../galeria.php?mensajeC=eliminado');
    } else {
        header('Location: ../galeria.php?mensajeC=Ha ocurrido un error');
    }
?>