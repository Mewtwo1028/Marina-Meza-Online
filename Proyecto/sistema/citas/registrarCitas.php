<?php 
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "marinameza";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión es exitosa
if ($conn->connect_error) {
  die("La conexión a la base de datos ha fallado: " . $conn->connect_error);
}

//print_r($_POST);
if(empty($_POST["Nombre"]) || empty($_POST["Apellido"]) || empty($_POST["Telefono"]) || empty($_POST["FechaCita"]) || empty($_POST["hora"])){
        echo "faltan datos";
        header('Location: ../citas.php?mensajeCita=falta algun dato');
        exit();

}
// Obtener los datos del formulario
$nombre    = $_POST['Nombre'];
$apellido  = $_POST['Apellido'];
$telefono  = $_POST['Telefono'];
$fechaCita = $_POST['FechaCita'];
$horaCita  = $_POST['hora'];
$tipo      = 1;

// Insertar los datos en la base de datos
$sql = "INSERT INTO citas(nombre, apellidos, telefono, fecha, hora, tipoUsuario) VALUES ('$nombre','$apellido', '$telefono', '$fechaCita','$horaCita', '$tipo')";

if ($conn->query($sql) === TRUE) {
    header('Location: ../citas.php?mensajeCita=Cita registrada correctamente');
} else {
    header('Location: ../citas.php?mensajeCita=Ha ocurrido un error'). $conn->error;
}
// Cerrar la conexión a la base de datos
$conn->close();

?>

