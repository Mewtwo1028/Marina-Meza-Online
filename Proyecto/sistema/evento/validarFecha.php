<?php
// Obtener la fecha del formulario
$form_date = $_POST['FechaEvento'];

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "marinameza";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si hay errores de conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consultar si la fecha ya está registrada en la base de datos
$sql = "SELECT * FROM eventos WHERE fecha = '$form_date'";
$result = $conn->query($sql);

// Si se encuentra un resultado, mostrar un mensaje de error
if ($result->num_rows > 0) {
    echo "La fecha ya está registrada en la base de datos.";
    exit;
}

// Si no se encuentra ningún resultado, continuar con el registro de datos
// ...
?>