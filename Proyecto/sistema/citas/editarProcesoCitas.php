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
print_r($_POST);
if(!isset($_POST['idCitas'])){
    header('Location: ../citas.php?mensajeCita=Ha ocurrido un error');

}
include_once '../empleado/model/conecEmple.php';
$idCitas = $_POST['idCitas'];
$nombre = $_POST["Nombre"];
$apellido = $_POST["Apellido"];
$telefono = $_POST["Telefono"];
$fecha = $_POST["FechaCita"];
$hora = $_POST["hora"];

$sentencia = "UPDATE citas SET nombre = '$nombre', apellidos = 'apellido', telefono = '$telefono', fecha = '$fecha', hora = '$hora' where idCitas = '$idCitas'";
$resultado = $bd -> query($sentencia);

if ($resultado == TRUE) {
    header('Location: ../citas.php?mensajeCita=Cita actualizada correctamente');
} else {
    header('Location: ../citas.php?mensajeCita=Ha ocurrido un error');
    exit();
}

?>