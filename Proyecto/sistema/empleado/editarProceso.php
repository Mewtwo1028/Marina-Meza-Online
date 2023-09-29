
<?php 
print_r($_POST);
if(!isset($_POST['idEmpleado'])){
    header('Location: ../empleado.php?mensaje=error');


}
include_once './model/conecEmple.php';
$idEmpleado = $_POST['idEmpleado'];
$nombre = $_POST["txtNombre"];
$apellido = $_POST["txtApellido"];
$fechaNacimiento = $_POST["txtCumpleaños"];
$usuario = $_POST["txtUsuario"];
$contrasena = $_POST["txtContraseña"];

$sentencia = $bd->prepare("UPDATE empleado SET nombre = ?, apellido = ?, fechaNacimiento = ?, usuario = ?, password = ? where idEmpleado = ?;");
$resultado = $sentencia->execute([$nombre,$apellido,$fechaNacimiento,$usuario,$contrasena,$idEmpleado]);

if ($resultado == TRUE) {
    header('Location: ../empleado.php?mensaje=empleado registrado');
} else {
    header('Location: ../empleado.php?mensaje=error');
    exit();
}

?>