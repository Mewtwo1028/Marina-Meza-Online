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

    // Obtener los datos del formulario
    $nombre_imagen  = $_FILES['archivo']['name'];
    $temporal = $_FILES['archivo']['tmp_name'];
    $carpeta = '../../galeria';
    $ruta = $carpeta . '/' . $nombre_imagen;
    $descripcion = $_POST['descripcion'];
    $idEvento = $_POST['idEvento'];
    echo $idEvento;
    $query = "SELECT * FROM eventos WHERE idEvento = $idEvento";
    $result = $conn -> query($query);
    foreach($result as $fila){
        $fecha = $fila['fecha'];
    }

    move_uploaded_file($temporal, $ruta);

    $query = "INSERT INTO fotos (descripcion, fecha, ruta, FK_evento_idEvento)
    VALUES ('$descripcion', '$fecha', '$ruta', '$idEvento')";

    if ($conn->query($query) === TRUE) {
        header('Location: ../galeria.php?mensajeFoto=foto registrada');
    } else {
        header('Location: ../galeria.php?mensajeFoto=error');
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
?>