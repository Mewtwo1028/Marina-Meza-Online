<?php 
    if(!isset($_GET['idProveedor'])){
        header('Location: ../proveedor.php?mensajeP=error');
        exit();
    }

    include 'model/conecProve.php';
    $idProveedor = $_GET['idProveedor'];

    $sentencia = $bd->prepare("DELETE FROM proveedor where idProveedor = ?;");
    $resultado = $sentencia->execute([$idProveedor]);

    if ($resultado === TRUE) {
        header('Location: ../proveedor.php?mensajeP=eliminado');
    } else {
        header('Location: ../proveedor.php?mensajeP=error');
    }