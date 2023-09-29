<?php 
    if(!isset($_GET['idServicio'])){
        header('Location: ../servicios.php?mensajeS=Ha ocurrido un error');
        exit();
    }

    include '../empleado/model/conecEmple.php';
    $idServicio = $_GET['idServicio'];

    $sentencia = $bd->prepare("DELETE FROM servicios where idServicio = ?;");
    $resultado = $sentencia->execute([$idServicio]);

    if ($resultado === TRUE) {
       header('Location: ../servicios.php?mensajeS=eliminado');
    } else {
        header('Location: ../servicios.php?mensajeS=Ha ocurrido un error');
    }