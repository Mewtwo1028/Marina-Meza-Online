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
if(empty($_POST["oculto"]) || empty($_POST["txtCorreo"])|| empty($_POST["Citaid"])){
        echo "faltan datos";
        header('Location: ../cliente.php?mensajeC=falta algun dato');
        exit();

}
// Obtener los datos del formulario
$correo = $_POST['txtCorreo'];
$FK_cita_idCita = $_POST['Citaid'];

// Insertar los datos en la base de datos
$sql = "INSERT INTO cliente(correo, FK_cita_idCita) VALUES ('$correo','$FK_cita_idCita')";

if ($conn->query($sql) === TRUE) {
    header('Location: ../cliente.php?mensajeC=Cliente registrado correctamente');
} else {
    header('Location: ../cliente.php?mensajeC=Ha ocurrido un error'). $conn->error;
}
// Cerrar la conexión a la base de datos
$conn->close();

?>

