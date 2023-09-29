
<?php 
print_r($_POST);
 
include_once './model/conecProve.php';
$idProveedor = $_POST['id_prov'];
$nombre = $_POST["nombreProveedor"];

$descripcion = $_POST["descProveedor"];
$servicio = $_POST["selectTS"];
$telefono = $_POST["telProveedor"];




$sentencia = $bd->prepare("UPDATE proveedor SET nombre_proveedor = ?, descripcion = ?, tipoServicio = ?, telefono = ? where idProveedor = ?");
$resultado = $sentencia->execute([$nombre,$descripcion,$servicio,$telefono,$idProveedor]);

if ($resultado == TRUE) {
    header('Location: ../proveedor.php?mensajeP=proveedor registrado');
} else {
    header('Location: ../proveedor.php?mensajeP=error');
    exit();
}

?>