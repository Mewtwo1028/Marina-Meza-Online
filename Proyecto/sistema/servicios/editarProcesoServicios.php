<a href="../empleado/model/conecEmple.php"></a>
<?php 
print_r($_POST);
if(!isset($_POST['idServicio'])){
    header('Location: ../servicios.php?mensajeS=Ha ocurrido un error');


}
include_once '../empleado/model/conecEmple.php';
$idServicio = $_POST['idServicio'];
$Proveedorid = $_POST['Proveedorid'];
$Clienteid = $_POST['Clienteid'];
$Eventoid = $_POST['Eventoid'];
$descripcion = $_POST['Descripcion'];
$cotizacion = $_POST['Cotizacion'];
$estatus = $_POST['Estatus'];

$sentencia = $bd->prepare("UPDATE servicios SET estatus = ?, cotizacion = ?, descripcion = ?, 
                FK_eventos_idEventos = ?, FK_proveedor_idProveedor = ?, FK_eventos_cliente_idCliente = ? where idServicio = ?;");
$resultado = $sentencia->execute([$estatus,$cotizacion,$descripcion,$Eventoid,$Proveedorid,$Clienteid]);

if ($resultado == TRUE) {
    header('Location: ../servicios.php?mensajeS=Servicio actualizado correctamente');
} else {
    header('Location: ../servicios.php?mensajeS=Ha ocurrido un error');
    exit();
}

?>