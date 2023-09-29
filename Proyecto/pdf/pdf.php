<?php 
    include '../conexion.php';
    require '../vendor/autoload.php';

    $htmlContent = file_get_contents('contrato.htm');
    $textContent = strip_tags($htmlContent);

    session_start();
    if(isset($_SESSION['idEvento'])){

      $idEvento = $_SESSION['idEvento'];
      $query = "SELECT * FROM eventos WHERE idEvento = $idEvento";
      $execute = $bd -> query($query);
      foreach($execute as $fila){
        $idCliente = $fila['FK_cliente_idCliente'];
        $fecha = $fila['fecha'];
      }

      // Datos del cliente

    $query = "SELECT * FROM cliente WHERE idCliente = $idCliente";
    $execute = $bd -> query($query);
    foreach($execute as $fila){
       $idCita = $fila['FK_cita_idCita'];
    }

    $query = "SELECT * FROM citas WHERE idCitas = $idCita";
    $execute = $bd -> query($query);
    foreach($execute as $fila){
        $cliente = $fila['nombre'];
        $cliente .= " ";
        $cliente .= $fila['apellidos'];
    }
    }

    $textoModificado = str_replace(["--cliente--", "--Cliente--", "--CLIENTE--"], $cliente, $htmlContent);
    $textoModificado = str_replace(["--fecha--", "--Fecha--", "--FECHA--"], $fecha, $textoModificado);


    use Dompdf\Dompdf;
    $dompdf = new Dompdf();
    $dompdf -> load_html($textoModificado);
    $dompdf -> render();
    $dompdf -> stream("documento.pdf", array('Attachment' => '0'));
?>