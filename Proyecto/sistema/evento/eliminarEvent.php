<?php 
    if(!isset($_GET['idEvento'])){
        //header('Location: ../proveedor.php?mensajeP=error');
        exit();
    }

    include '../empleado/model/conecEmple.php';
    $idEvento = $_GET['idEvento'];

    $sentencia = $bd->prepare("DELETE FROM eventos where idEvento = ?;");
    $resultado = $sentencia->execute([$idEvento]);

    if ($resultado === TRUE) {
        header('Location: ../evento.php?mensajeEve=eliminado');
    } else {
        // header('Location: ../proveedor.php?mensajeP=error');
    }