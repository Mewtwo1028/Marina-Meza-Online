<?php
    // Incluimos el archivo con la conexión a la base de datos (conexion.php).
    include 'conexion.php';

    // Declaramos las variables necesarias para guardar los datos de la cita del visitante en la base de datos
    // obtenidos mediante el metodo GET de php de la pagina crearcita.php (Apartar una cita).
    $name     = $_POST['nombre'];
    $lastname = $_POST['apellido']; 
    $phone    = $_POST['numero'];
    $date     = $_POST['fecha'];
    $time     = $_POST['hora'];
    $tipo     = 0;

    // Hacemos la petición necesaria a la base de datos para introducir la información de la cita
    $query = "INSERT INTO citas(nombre, apellidos, telefono, fecha, hora, tipoUsuario)
                VALUES('$name', '$lastname', '$phone', '$date', '$time', '$tipo')";

    // Ejecutamos la petición
    $ejecutar = $bd -> query($query);

    // Si la ejecución fue exitosa se inicia sesión de datos de la pagina con el metodo "session_start" para
    // mandar un mensaje a la pagina de Apartar una cita (crearcita.php) de que el registro se completó con éxito.
    if($ejecutar){
        session_start();
        $_SESSION['listo'] = 1;
        header("Location: crearcita.php");
        exit();
    }

    //Cerramos la base de datos.
    $bd = null;
?>