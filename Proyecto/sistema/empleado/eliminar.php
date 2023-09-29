<?php 
    include '../../conexion.php';

    if(!isset($_GET['idEmpleado'])){
        header('Location: ../empleado.php?mensaje=error');
        exit();
    }

    $idEmpleado = $_GET['idEmpleado'];
    $query = "SELECT tipo_usuario FROM empleado WHERE idEmpleado = $idEmpleado";
    $result =$bd -> query($query);
    foreach($result as $fila)$tipo = $fila['tipo_usuario'];
    if($tipo == 1){
        header('Location: ../empleado.php?mensaje=admin');
        exit();
    }

    $sentencia = $bd->prepare("DELETE FROM empleado where idEmpleado = ?;");
    $resultado = $sentencia->execute([$idEmpleado]);

    if ($resultado === TRUE) {
        header('Location: ../empleado.php?mensaje=eliminado');
    } else {
        header('Location: ../empleado.php?mensaje=error');
    }
