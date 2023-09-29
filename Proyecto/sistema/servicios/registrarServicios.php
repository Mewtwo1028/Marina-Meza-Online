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

// Obtener los datos del formulario
$Eventoid = $_POST['Eventoid'];
$Descripcion = $_POST['Descripcion'];
$Cotizacion = $_POST['Cotizacion'];
$Estatus = $_POST['Estatus'];
$Proveedorid = $_POST['Proveedorid'];

// Insertar los datos en la base de datos
$query = "SELECT * FROM eventos WHERE idEvento = $Eventoid";
$result = mysqli_query($conn, $query);
foreach($result as $fila)$Clienteid = $fila['FK_cliente_idCliente'];
$sql = "INSERT INTO servicios(estatus, cotizacion, descripcion, FK_eventos_idEventos, FK_proveedor_idProveedor, FK_eventos_cliente_idCliente) VALUES ('$Estatus', '$Cotizacion', '$Descripcion','$Eventoid','$Proveedorid','$Clienteid')";

if ($conn->query($sql) === TRUE) {
    header('Location: ../servicios.php?mensajeS=Servicio registrado correctamente');
} else {
    header('Location: ../servicios.php?mensajeS=Ha ocurrido un error'). $conn->error;
}

// Cerrar la conexión a la base de datos
$conn->close();
?>