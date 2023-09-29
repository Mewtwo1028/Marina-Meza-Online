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
      $nombre = $_POST['nombreEvento'];
      $fecha = $_POST['FechaEvento'];
      $lugar = $_POST['LugarEvento'];
      $Numinvitados = $_POST['NumInvitados'];
      $TipoEvento = $_POST['TipoEvento'];
      $Estatus = $_POST['Estatus'];
      $cotizacion = $_POST['cotizacion'];
      $descripcion = $_POST['descripcion'];
      $idCliente = $_POST['Clienteid'];

      $sqlf= "SELECT * FROM eventos WHERE fecha = '$fecha'";
      $result = $conn->query($sqlf);

      // Si se encuentra un resultado, mostrar un mensaje de error
      if ($result->num_rows > 0) {
        header('Location: ../evento.php?mensajeEve=fecha registrada');
          exit;
      }else{

      // Insertar los datos en la base de datos
      $sql = "INSERT INTO eventos(nombre, fecha, lugar, noInvitados, tipoEvento, estatus, cotizacion, descripcion, FK_cliente_idCliente) VALUES ('$nombre', '$fecha', '$lugar', '$Numinvitados','$TipoEvento','$Estatus','$cotizacion', '$descripcion', '$idCliente')";

      if ($conn->query($sql) === TRUE) {
        header('Location: ../evento.php?mensajeEve=evento registrado');
      } else {
        header('Location: ../evento.php?mensajeEve=error');
      }

      // Cerrar la conexión a la base de datos
      $conn->close();
      }
?>