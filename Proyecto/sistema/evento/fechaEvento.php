<?php
    $contrasena ="";
    $usuario = "root";
    $nombre_bd = "marinameza";

    try{
        $bd = new PDO(
            'mysql:host=localhost;
            dbname='.$nombre_bd,
            $usuario,
            $contrasena,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
        );
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }catch (Exception $e){
        echo "No fue posible conectar la base de datos: " .$e->getMessage();
    }
    
$fecha = $_GET['dia'];
$query = "SELECT * FROM eventos WHERE fecha = :fecha";
$stmt = $bd->prepare($query);
$stmt->bindParam(':fecha', $fecha);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (count($result) > 0) echo "true";
else echo "false";
$bd = null;
?>