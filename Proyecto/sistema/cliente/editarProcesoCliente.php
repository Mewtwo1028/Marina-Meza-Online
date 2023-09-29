<a href="../empleado/model/conecEmple.php"></a>
<?php 
print_r($_POST);
if(!isset($_POST['idCliente'])){
    header('Location: ../cliente.php?mensajeC=Ha ocurrido un error');


}
include_once '../empleado/model/conecEmple.php';
$idCliente = $_POST['idCliente'];
$correo = $_POST["txtCorreo"];
$FK_cita_idCita = $_POST["Citaid"];

$sentencia = $bd->prepare("UPDATE cliente SET correo = ?, FK_cita_idCita = ? where idCliente = ?;");
$resultado = $sentencia->execute([$correo,$FK_cita_idCita,$idCliente]);

if ($resultado == TRUE) {
    header('Location: ../cliente.php?mensajeC=Cliente actualizado correctamente');
} else {
    header('Location: ../cliente.php?mensajeC=Ha ocurrido un error');
    exit();
}

?>