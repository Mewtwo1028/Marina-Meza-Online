<?php 
    include '../conexion.php';
    require '../vendor/autoload.php';
    session_start();
    if(isset($_SESSION['idEvento'])){

      // Datos del evento

      $idEvento = $_SESSION['idEvento'];
      $query = "SELECT * FROM eventos WHERE idEvento = $idEvento";
      $execute = $bd -> query($query);
      foreach($execute as $fila){
        $idCliente = $fila['FK_cliente_idCliente'];
        $cotizacion = $fila['cotizacion'];
      }

      // Datos del cliente

      $query = "SELECT FK_cita_idCita FROM cliente WHERE idCliente = $idCliente";
      $execute = $bd -> query($query);
      foreach($execute as $fila){
        $cita = $fila['FK_cita_idCita'];
      }

      $query = "SELECT * FROM citas WHERE idCitas = $cita";
      $execute = $bd -> query($query);
      foreach($execute as $fila){
        $cliente = $fila['nombre'];
        $cliente .= " ";
        $cliente .= $fila['apellidos'];
      }

      //Datos de servicios
      $textoServicios = "";
      $total = $cotizacion;

      $query = "SELECT * FROM servicios WHERE FK_eventos_idEventos = $idEvento";
      $execute = $bd -> query($query);
      foreach($execute as $fila){
        $idProveedor = $fila['FK_proveedor_idProveedor'];
        $query2 = "SELECT * FROM proveedor WHERE idProveedor = $idProveedor";
        $execute2 = $bd -> query($query2);
        foreach($execute2 as $fila2){
          $textoServicios .= "<tr>\n
                                <th>" . $fila2['tipoServicio'] . "</th>\n
                                  <td>\n
                                    <ul>\n 
                                      <li>" .  $fila['descripcion'] . "</li>\n
                                    </ul>\n
                                  </td>\n
                                  <td>$" . $fila['cotizacion'] . "</td>\n
                                  </tr>\n";
          $total += $fila['cotizacion'];
        }
      }
    }

    $html = '
    <!DOCTYPE html>
    <html>
    <head>
      <title>Cotización de Servicios - Boda</title>
      <style>
        body {
          font-family: Arial, sans-serif;
        }
        h1, h2 {
          text-align: center;
        }
        table {
          border-collapse: collapse;
        }
        th, td {
          padding: 8px;
          text-align: left;
          border-bottom: 1px solid #ddd;
        }
        .centrar {
          display: flex;
          width: 100%;
          align-items: center;
          justify-content: center;
        }
      </style>
    </head>
    <body>
      <h1>COTIZACIÓN DE SERVICIOS</h1>
      <hr>
      <h3>Fecha de cotización: 11 de mayo de 2023</h3>
      <h3>Cliente: ' . $cliente . '</h3>
      <hr>
      
      <h2>SERVICIOS CONTRATADOS</h2>
      <div class = "centrar">
        <div style="width:100%">
          <table>'
            . $textoServicios .
        '</table>
        </div>
      </div>
      <hr>
      <h4>COSTO DEL EVENTO: $' . $cotizacion . '</h4>
      <h2>TOTAL: $' . $total . '</h2>
      <hr>
      <h3>Condiciones de pago:</h3>
      <ul>
        <li>30% al momento de la reserva.</li>
        <li>70% restante se abonará un mes antes del evento.</li>
      </ul>
      <p>Nota: Esta cotización es válida por 30 días a partir de la fecha de emisión.</p>
      <p>No dude en ponerse en contacto con nosotros para cualquier consulta adicional o para realizar modificaciones en los servicios contratados.</p>
      <p>¡Gracias por considerarnos para su evento! Esperamos poder hacer de su boda un día inolvidable.</p>
      <p>Atentamente,<br>Equipo de Marina Meza Eventos</p>
    </body>
    </html>  
    ';
    use Dompdf\Dompdf;
    $dompdf = new Dompdf();
    $dompdf -> load_html($html);
    $dompdf -> render();
    $dompdf -> stream("documento.pdf", array('Attachment' => '0'));
?>