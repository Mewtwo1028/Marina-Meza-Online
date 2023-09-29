<?php 
try{
    if(!isset($_GET['idCitas'])){
        header('Location: ../citas.php?mensajeCita=Ha ocurrido un error');
        exit();
    }

    include '../empleado/model/conecEmple.php';
    $idCita = $_GET['idCitas'];

    $sentencia = $bd->prepare("DELETE FROM citas where idCitas = ?;");
    $resultado = $sentencia->execute([$idCita]);

    if ($resultado === TRUE) {
        header('Location: ../citas.php?mensajeCita=eliminado');
    } else {
        header('Location: ../citas.php?mensajeCita=Ha ocurrido un error');
    }
} catch (PDOException $e) {
    if($e->getCode() == 23000){
        session_start();
        header('Location: ../citas.php?mensajeCita=Registros');
    }
}