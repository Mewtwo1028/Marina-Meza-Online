<?php
    if(empty($_POST["oculto"]) || empty($_POST["nomProveedor"]) || empty($_POST["telProveedor"]) || empty($_POST["descProveedor"]) || empty($_POST["selectTS"])){
        echo "faltan datos";
        header('Location: ../proveedor.php?mensajeP=falta algun dato');
        exit();

}

include_once './model/conecProve.php';
$nombre_proveedor = $_POST["nomProveedor"];
$descripcion = $_POST["descProveedor"];
$tipoServicio = $_POST["selectTS"];
$telefono = $_POST["telProveedor"];
$tipos = $_POST["selectTS"];

$sentencia = $bd->prepare("INSERT INTO proveedor(nombre_proveedor,descripcion,tipoServicio,telefono) VALUES (?,?,?,?);");
$resultado = $sentencia->execute([$nombre_proveedor,$descripcion,$tipos,$telefono]);

if ($resultado == TRUE) {
    header('Location: ../proveedor.php?mensajeP=proveedor registrado');
} else {
    header('Location: ../proveedor.php?mensajeP=error');
    exit();
}


?>