
<?php
print_r($_POST);
if (!isset($_POST['id_evento_'])) {
    header('Location: ../evento.php?mensajeEve=error');
}
include_once '../proveedor/model/conecProve.php';
include '../../conexion.php';
$idEvento = $_POST['id_evento_'];
$nombre = $_POST['nombreEvento'];
$fecha = $_POST['FechaEvento'];
$lugar = $_POST['LugarEvento'];
$Numinvitados = $_POST['NumInvitados'];
$TipoEvento = $_POST['TipoEvento'];
$Estatus = $_POST['Estatus'];
$idCliente = $_POST['Clienteid'];

// Crear una nueva fecha sumando 30 días a la fecha actual
$fechaLimite = date('Y-m-d', strtotime('+30 days'));

// Verificar si la fecha es mayor o igual a 30 días a partir de la fecha actual
if ($fecha >= $fechaLimite) {
    header('Location: ../evento.php?mensajeEve=fecha');
}


$query = "UPDATE eventos SET nombre = '$nombre', fecha = '$fecha', lugar = '$lugar', noInvitados = $Numinvitados, tipoEvento = '$TipoEvento', estatus = '$Estatus', FK_cliente_idCliente = $idCliente WHERE idEvento = $idEvento";
$result = $bd->query($query);

if ($result == TRUE) {
    header('Location: ../evento.php?mensajeEve=evento registrado');
} else {
  print_r($result);
    header('Location: ../evento.php?mensajeEve=error');
    exit();
}
      

?>