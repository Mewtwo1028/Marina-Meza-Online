<?php 
include 'conexion.php';
    if(isset($_POST['enviarEncuesta'])){
        $idEvento = $_GET['id'];
        $p1 = $_POST['p1'];
        $p2 = $_POST['p2'];
        $p3 = $_POST['p3'];
        $p4 = $_POST['p4'];
        $p5 = $_POST['p5'];
        $p6 = $_POST['p6'];
        $p7 = $_POST['p7'];
        $p8 = $_POST['p8'];
        $calificaciones = $p1 . "-" . $p2 . "-" . $p3 . "-" . $p4 . "-" . $p5 . "-" . $p6 . "-" . $p7 . "-" . $p8;
        $sugerencias = $_POST['sugerencias'];
        $query = "INSERT INTO encuestas(calificaciones, sugerencia, FK_evento_idEvento) 
                  VALUES ('$calificaciones', '$sugerencias', '$idEvento')";
        $execute = $bd -> query($query);
        session_start();
        $_SESSION['idEvento'] = $_GET['id'];
        header("Location: evento.php");
    }
?>