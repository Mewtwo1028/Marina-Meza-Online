<?php 
//print_r($_POST);
if(empty($_POST["oculto"]) || empty($_POST["txtNombre"]) || empty($_POST["txtApellido"]) || empty($_POST["txtCumpleaños"]) || empty($_POST["txtUsuario"]) || empty($_POST["txtContraseña"])){
        echo "faltan datos";
        header('Location: ../empleado.php?mensaje=falta algun dato');
        exit();

}
include_once './model/conecEmple.php';
$nombre = $_POST["txtNombre"];
$apellido = $_POST["txtApellido"];
$fechaNacimiento = $_POST["txtCumpleaños"];
$usuario = $_POST["txtUsuario"];
$contrasena = $_POST["txtContraseña"];

$sentencia = $bd->prepare("INSERT INTO empleado(nombre,apellido,fechaNacimiento,usuario,password) VALUES (?,?,?,?,?);");
$resultado = $sentencia->execute([$nombre,$apellido,$fechaNacimiento,$usuario,$contrasena]);

if ($resultado == TRUE) {
    header('Location: ../empleado.php?mensaje=empleado registrado');
} else {
    header('Location: ../empleado.php?mensaje=error');
    exit();
}

?>