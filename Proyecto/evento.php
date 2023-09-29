<?php 
// Importamos los archivos tanto del header predeterminado para la página como el de conexión con la base de datos
// (header.php y conexion.php).
include 'templates/header.php';
include 'conexion.php';

// Iniciamos sesión de variables en la página con el método "session_start()".
session_start();
// Verificamos que la variable "idEvento" del método "session_start" se haya recibido.
if(isset($_SESSION['idEvento'])){
    // De ser así declaramos una variable llamada "idEvento" y la igualamos con esta variable.
    $idEvento = $_SESSION['idEvento'];
    // Declaramos la peticíon para buscar el evento mediante esta variable.
    $query = "SELECT * FROM eventos WHERE idEvento = $idEvento";
    // Ejecutamos esta petición.
    $execute = $bd -> query($query);
    // declaramos y llenamos algunas variables con los respectivos datos del evento que serán mostrados en la primera pestaña de
    // la página.
    foreach($execute as $fila){
        $fecha = $fila['fecha'];
        $lugar = $fila['lugar'];
        $invitados = $fila['noInvitados'];
        $tipo = $fila['tipoEvento'];
        $estatus = $fila['estatus'];
        $idCliente = $fila['FK_cliente_idCliente'];
    }

    // Datos del cliente
    // Por medio de los datos obtenidos del evento obtenemos los datos del cliente para mostrarlos también
    $query = "SELECT * FROM cliente WHERE idCliente = $idCliente";
    // Ejecutamos la petición
    $execute = $bd -> query($query);
    // Declaramos y llenamos las respectivas variables con los datos del cliente
    foreach($execute as $fila){
       $correo = $fila['correo'];
       $idCita = $fila['FK_cita_idCita'];
    }

    // De igual forma por medio del cliente se obtiene los datos de su cita para obtener más datos del cliente
    $query = "SELECT * FROM citas WHERE idCitas = $idCita";
    // Ejecutamos la petición
    $execute = $bd -> query($query);
    // Declaramos y llenamos las respectivas variables con los datos del cliente
    foreach($execute as $fila){
        $cliente = $fila['nombre'];
        $cliente .= " ";
        $cliente .= $fila['apellidos'];
        $telefono = $fila['telefono'];
    }

    // Datos de la encuesta
    // Por medio de los datos del evento obtenemos los datos de la encuesta para dar a conocer al cliente si puede o no realizarla
    $query = "SELECT * FROM encuestas WHERE FK_evento_idEvento = $idEvento";
    // Ejecutamos la petición
    $execute = $bd -> query($query);
    // Contamos los renglones para verificar que exista la encuesta realizada
    $count = $execute -> rowCount();
    // Verificamos si la variable estatus previamente declarada en la parte de arriba está declarada como "Preparación" o "Aceptado".
    if($estatus == "Preparacion" || $estatus == "Aceptado"){
        // De ser delcaramos estas variables para indicar al cliente que todavía no puede realizar su encuesta y desativamos
        // el formulario de la encuesta.
        $estatusEncuesta = "Aún no puedes realizar la encuesta de <br> satisfacción, ya que sigue en estado de preparación.";
        $encuestaAct = "disabled";
    }
    // De no ser así, erificamos si la variable estatus previamente declarada en la parte de arriba está declarada como "Cancelado".
    else if($estatus == "Cancelado"){
        // De ser delcaramos estas variables para indicar al cliente no podrá realizar su encuesta y desativamos
        // el formulario de la encuesta.
        $estatusEncuesta = "Lo sentimos, su evento ha sido cancelado, por <br> lo que no puede realizar su encuesta de satisfacción.";
        $encuestaAct = "disabled";
    }
    // De no ser así verificamos que la variable $count sea igual a cero o que la encuesta no ha sido realizada todavía.
    else if($count == 0){
        // Informamos al cliente que ya puede realizarla y activamos el formulario
        $estatusEncuesta = "Ya puedes realizar tu encuesta de satisfacción.";
        $encuestaAct = "";
    }
    // De no ser ninguna de las anteriores determinamos que la encuesta ya ha sido realizada.
    else {
        // Declaramos estas variables para indicar al cliente ya no puede realizar su encuesta y desativamos
        // el formulario de la encuesta.
        $estatusEncuesta = "Ya hemos registrado sus respuestas con exito. <br> Muchas gracias por su apoyo!";
        $encuestaAct = "disabled";
        // Llenamos el formulario con las respuestas seleccionadas y porporrcionadas por el cliente.
        foreach($execute as $fila){
            $calificaciones = $fila['calificaciones'];
            $sugerencia = $fila['sugerencia'];
        }
    }
}
// De no encontrar la variable idEvento en el metodo "SESSION" regresamos a la pagina anterior (mievento.php).
else {
    header('Location: mievento.php');
}
?>

<head><title>Marina Meza Online | Mi Evento</title></head>
                    <ul>
                        <li>
                            <a href="crearcita.php">Apartar una cita</a>
                        </li>
                        <li>
                            <a href="sistema/index.php">Iniciar sesión</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
    <div class="tab">
        <button class="tablinks" onclick="openTab(event, 'tab1')">Datos del evento</button>
        <button class="tablinks" onclick="openTab(event, 'tab2')">Estatus de servicios</button>
        <button class="tablinks" onclick="openTab(event, 'tab3')">Cotización</button>
        <button class="tablinks" onclick="openTab(event, 'tab4')">Contrato</button>
        <button class="tablinks" onclick="openTab(event, 'tab5')">Realizar Encuesta</button>
    </div>
    <div id="tab1" class="tabcontent">
        <h6>Datos del evento</h6>
        <div class ="evento">
            <div style="width: 100%;">
                <div class="datos-evento">
                    <input type="text" id="idEvento" name="claveEvento" value="<?= $idEvento?>" disabled>
                    <label for="proveedor">Clave de evento</label>
                    <input type="date" id="date" name="fecha" value="<?= $fecha ?>" disabled >
                    <label for="proveedor">Fecha</label>
                    <input type="text" id="Aforo" name="Aforo" value="<?= $invitados ?>" disabled>
                    <label for="proveedor">Aforo</label>
                </div>
                <div class="datos-evento">
                    <input type="text" id="cliente" name="cliente" value="<?= $cliente ?>" disabled>
                    <label for="proveedor">Nombre de cliente</label>
                    <input type="text" id="place" name="lugar" value="<?= $lugar?>" disabled >
                    <label for="proveedor">Lugar</label>
                    <input type="text" id="email" name="correo" value="<?= $correo?>" disabled >
                    <label for="proveedor">Correo electronico</label>     
                </div>
                <div class="datos-evento">
                    <input type="text" id="telefono" name="telefono" value="<?= $telefono ?>" disabled>
                    <label for="proveedor">Telefono del Contacto</label>
                    <input type="text" id="tipoEvento" name="tipoEvento" value="<?= $tipo ?>" disabled >
                    <label for="proveedor">Tipo de evento</label>
                    <select id="status" name="status" disabled>
                    <option value="Pendiente de pago" <?php if ($estatus == 'Pendiente de pago') echo 'selected';?> >Pendiente de pago</option>
                    <option value="Aceptado" <?php if ($estatus == 'Aceptado') echo 'selected';?> >Aceptado</option>
                    <option value="Preparacion" <?php if ($estatus == 'Preparacion') echo 'selected';?> >Preparación</option>
                    <option value="Cancelado" <?php if ($estatus == 'Cancelado') echo 'selected';?> >Cancelado</option>
                    <option value="Terminado" <?php if ($estatus == 'Terminado') echo 'selected';?> >Terminado</option>
                    </select>
                    <label for="proveedor">Estatus</label>
                </div>
            </div>
        </div>
    </div>
    <div id="tab2" class="tabcontent">
        <div  class="tabla-proveedor">
        <table>
                <thead>
                    <tr>
                        <th>Proveedor</th>
                        <th>Servicio</th>
                        <th>Descripcion</th>
                        <th>cotización</th>
                        <th>Estatus</th>
                    </tr>
                </thead>
                <tbody>
<?php
// Creamos la  petición para buscar los respectivos servicios del evento                      
$query = "SELECT * FROM servicios  WHERE FK_eventos_idEventos = $idEvento";
// Ejecutamos la petición
$execute = $bd -> query($query);
// Declaramos las variables necesarias para rescatar estos datos e imprimirlos en la tabla de la pestaña servicios.
foreach($execute as $fila){
    $idProveedor = $fila['FK_proveedor_idProveedor'];
    //Hacemos una petición para obtener los nombres de los proveedores de estos servicios.
    $query2 = "SELECT * FROM proveedor  WHERE idProveedor = $idProveedor";
    // Ejecutamos la petición
    $execute2 = $bd -> query($query2);
    // Imprimos todos estos los datos en la tabla
    foreach($execute2 as $fila2){
    ?>
    <tr>
        <td> <?= $fila2['nombre_proveedor']; ?> </td>
        <td> <?= $fila2['tipoServicio']; ?> </td>
        <td> <?= $fila['descripcion']; ?> </td>   
    <?php
    }
?> 
<td>$ <?= $fila['cotizacion']; ?> </td> 
<td> <?= $fila['estatus']; ?> </td>
</tr>
<?php }
?>
                </tbody>
            </table>
        </div>
    </div>
    <div id="tab3" class="tabcontent">
        <div class="evento">
            <iframe src="pdf/pdf2.php"></iframe>
        </div>
    </div>
    <div id="tab4" class="tabcontent">
        <div class="evento">
            <iframe src="pdf/pdf.php"></iframe>
        </div>
    </div>
    <div id="tab5" class="tabcontent">
        <div class="centrar">  
            <div style="width: 100%;">
            <h6><?= $estatusEncuesta?></h6>
                <form action="encuesta.php?id=<?=$idEvento?>" method="POST">
                    <div class="encuesta">
                        <fieldset <?= $encuestaAct?> >
                        ¿Está satisfecho con el servicio proporcionado para la realización del evento?
                        <div>
                            <input type="radio" id="1_1" name="p1" value="1" <?php if(isset($calificaciones))if($calificaciones[0] == "1")echo 'checked' ; ?> required >
                            <label for="1_1">Malo</label>
                        </div>
                        <div>
                            <input type="radio" id="1_2" name="p1" value="2" <?php if(isset($calificaciones))if($calificaciones[0] == "2")echo 'checked' ; ?> required >
                            <label for="1_2">Regular</label>
                        </div>
                        <div>
                            <input type="radio" id="1_3" name="p1" value="3" <?php if(isset($calificaciones))if($calificaciones[0] == "3")echo 'checked' ; ?> required >
                            <label for="1_3">Bueno</label>
                        </div>
                        <div>
                            <input type="radio" id="1_4" name="p1" value="4" <?php if(isset($calificaciones))if($calificaciones[0] == "4")echo 'checked' ; ?> required >   
                            <label for="1_4">Muy bueno</label>
                        </div>
                        <div>
                            <input type="radio" id="1_5" name="p1" value="5" <?php if(isset($calificaciones))if($calificaciones[0] == "5")echo 'checked' ; ?> required >
                            <label for="1_5">Excelente</label>
                        </div>
                        </fieldset>
                    </div>
                    <div class="encuesta">   
                        <fieldset <?= $encuestaAct?>>
                        ¿Se proporcionaron soluciones rápidas a los problemas que surgieron durante el evento?
                        <div>
                            <input type="radio" id="2_1" name="p2" value="1" <?php if(isset($calificaciones))if($calificaciones[2] == "1")echo 'checked' ; ?> required >
                            <label for="2_1">Malo</label>
                        </div>
                        <div>
                            <input type="radio" id="2_2" name="p2" value="2" <?php if(isset($calificaciones))if($calificaciones[2] == "2")echo 'checked' ; ?> required >
                            <label for="2_2">Regular</label>
                        </div>
                        <div>
                            <input type="radio" id="2_3" name="p2" value="3" <?php if(isset($calificaciones))if($calificaciones[2] == "3")echo 'checked' ; ?> required >
                            <label for="2_3">Bueno</label>
                        </div>
                        <div>
                            <input type="radio" id="2_4" name="p2" value="4" <?php if(isset($calificaciones))if($calificaciones[2] == "4")echo 'checked' ; ?> required >
                            <label for="2_4">Muy bueno</label>
                        </div>
                        <div>
                            <input type="radio" id="2_5" name="p2" value="5" <?php if(isset($calificaciones))if($calificaciones[2] == "5")echo 'checked' ; ?> required >
                            <label for="2_5">Excelente</label>
                        </div>
                        </fieldset>
                    </div>
                    <div class="encuesta">   
                        <fieldset <?= $encuestaAct?>>
                        ¿Recomendaría nuestros servicios para eventos similares a amigos o colegas?
                        <div>
                            <input type="radio" id="3_1" name="p3" value="1" <?php if(isset($calificaciones))if($calificaciones[4] == "1")echo 'checked' ; ?> required >
                            <label for="3_1">Malo</label>
                        </div>
                        <div>
                            <input type="radio" id="3_2" name="p3" value="2" <?php if(isset($calificaciones))if($calificaciones[4] == "2")echo 'checked' ; ?> required >
                            <label for="3_2">Regular</label>
                        </div>
                        <div>
                            <input type="radio" id="3_3" name="p3" value="3" <?php if(isset($calificaciones))if($calificaciones[4] == "3")echo 'checked' ; ?> required >
                            <label for="3_3">Bueno</label>
                        </div>
                        <div>
                            <input type="radio" id="3_4" name="p3" value="4" <?php if(isset($calificaciones))if($calificaciones[4] == "4")echo 'checked' ; ?> required >
                            <label for="3_4">Muy bueno</label>
                        </div>
                        <div>
                            <input type="radio" id="3_5" name="p3" value="5" <?php if(isset($calificaciones))if($calificaciones[4] == "5")echo 'checked' ; ?> required >
                            <label for="3_5">Excelente</label>
                        </div>
                        </fieldset>
                    </div>
                    <div class="encuesta">   
                        <fieldset <?= $encuestaAct?>>
                        ¿Encontró el proceso de organización del evento sencillo y sin complicaciones?
                        <div>
                            <input type="radio" id="4_1" name="p4" value="1" <?php if(isset($calificaciones))if($calificaciones[6] == "1")echo 'checked' ; ?> required >
                            <label for="4_1">Malo</label>
                        </div>
                        <div>
                            <input type="radio" id="4_2" name="p4" value="2" <?php if(isset($calificaciones))if($calificaciones[6] == "2")echo 'checked' ; ?> required >
                            <label for="4_2">Regular</label>
                        </div>
                        <div>
                            <input type="radio" id="4_3" name="p4" value="3" <?php if(isset($calificaciones))if($calificaciones[6] == "3")echo 'checked' ; ?> required >
                            <label for="4_3">Bueno</label>
                        </div>
                        <div>
                            <input type="radio" id="4_4" name="p4" value="4" <?php if(isset($calificaciones))if($calificaciones[6] == "4")echo 'checked' ; ?> required >
                            <label for="4_4">Muy bueno</label>
                        </div>
                        <div>
                            <input type="radio" id="4_5" name="p4" value="5" <?php if(isset($calificaciones))if($calificaciones[6] == "5")echo 'checked' ; ?> required >
                            <label for="4_5">Excelente</label>
                        </div>
                        </fieldset>
                    </div>
                    <div class="encuesta">   
                        <fieldset <?= $encuestaAct?>>
                        ¿Se cumplieron todos los términos y condiciones del contrato del evento?
                        <div>
                            <input type="radio" id="5_1" name="p5" value="1" <?php if(isset($calificaciones))if($calificaciones[8] == "1")echo 'checked' ; ?> required >
                            <label for="5_1">Malo</label>
                        </div>
                        <div>
                            <input type="radio" id="5_2" name="p5" value="2" <?php if(isset($calificaciones))if($calificaciones[8] == "2")echo 'checked' ; ?> required >
                            <label for="5_2">Regular</label>
                        </div>
                        <div>
                            <input type="radio" id="5_3" name="p5" value="3" <?php if(isset($calificaciones))if($calificaciones[8] == "3")echo 'checked' ; ?> required >
                            <label for="5_3">Bueno</label>
                        </div>
                        <div>
                            <input type="radio" id="5_4" name="p5" value="4" <?php if(isset($calificaciones))if($calificaciones[8] == "4")echo 'checked' ; ?> required >
                            <label for="5_4">Muy bueno</label>
                        </div>
                        <div>
                            <input type="radio" id="5_5" name="p5" value="5" <?php if(isset($calificaciones))if($calificaciones[8] == "5")echo 'checked' ; ?> required >
                            <label for="6_5">Excelente</label>
                        </div>
                        </fieldset>
                    </div>
                    <div class="encuesta">   
                        <fieldset <?= $encuestaAct?>>
                        ¿Estuvo el personal presente en el evento dispuesto a ayudar y resolver cualquier problema?
                        <div>
                            <input type="radio" id="6_1" name="p6" value="1" <?php if(isset($calificaciones))if($calificaciones[10] == "1")echo 'checked' ; ?> required >
                            <label for="6_1">Malo</label>
                        </div>
                        <div>
                            <input type="radio" id="6_2" name="p6" value="2" <?php if(isset($calificaciones))if($calificaciones[10] == "2")echo 'checked' ; ?> required >
                            <label for="6_2">Regular</label>
                        </div>
                        <div>
                            <input type="radio" id="6_3" name="p6" value="3" <?php if(isset($calificaciones))if($calificaciones[10] == "3")echo 'checked' ; ?> required >
                            <label for="6_3">Bueno</label>
                        </div>
                        <div>
                            <input type="radio" id="6_4" name="p6" value="4" <?php if(isset($calificaciones))if($calificaciones[10] == "4")echo 'checked' ; ?> required >
                            <label for="6_4">Muy bueno</label>
                        </div>
                        <div>
                            <input type="radio" id="6_5" name="p6" value="5" <?php if(isset($calificaciones))if($calificaciones[10] == "5")echo 'checked' ; ?> required >
                            <label for="6_5">Excelente</label>
                        </div>
                        </fieldset>
                    </div>
                    <div class="encuesta">   
                        <fieldset <?= $encuestaAct?>>
                        ¿Cuáles son los aspectos que podríamos mejorar para futuros eventos?
                        <div>
                            <input type="radio" id="7_1" name="p7" value="1" <?php if(isset($calificaciones))if($calificaciones[12] == "1")echo 'checked' ; ?> required >
                            <label for="7_1">Malo</label>
                        </div>
                        <div>
                            <input type="radio" id="7_2" name="p7" value="2" <?php if(isset($calificaciones))if($calificaciones[12] == "2")echo 'checked' ; ?> required >
                            <label for="7_2">Regular</label>
                        </div>
                        <div>
                            <input type="radio" id="7_3" name="p7" value="3" <?php if(isset($calificaciones))if($calificaciones[12] == "3")echo 'checked' ; ?> required >
                            <label for="7_3">Bueno</label>
                        </div>
                        <div>
                            <input type="radio" id="7_4" name="p7" value="4" <?php if(isset($calificaciones))if($calificaciones[12] == "4")echo 'checked' ; ?> required >
                            <label for="7_4">Muy bueno</label>
                        </div>
                        <div>
                            <input type="radio" id="7_5" name="p7" value="5" <?php if(isset($calificaciones))if($calificaciones[12] == "5")echo 'checked' ; ?> required >
                            <label for="7_5">Excelente</label>
                        </div>
                        </fieldset>
                    </div>
                    <div class="encuesta">   
                        <fieldset <?= $encuestaAct?>>
                        ¿La logística y la coordinación del evento fueron manejadas adecuadamente?
                        <br>
                        <div>
                            <input type="radio" id="8_1" name="p8" value="1" <?php if(isset($calificaciones))if($calificaciones[14] == "1")echo 'checked' ; ?> required >
                            <label for="8_1">Malo</label>
                        </div>
                        <div>
                            <input type="radio" id="8_2" name="p8" value="2" <?php if(isset($calificaciones))if($calificaciones[14] == "2")echo 'checked' ; ?> required >
                            <label for="8_2">Regular</label>
                        </div>
                        <div>
                            <input type="radio" id="8_3" name="p8" value="3" <?php if(isset($calificaciones))if($calificaciones[14] == "3")echo 'checked' ; ?> required >
                            <label for="8_3">Bueno</label>
                        </div>
                        <div>
                            <input type="radio" id="8_4" name="p8" value="4" <?php if(isset($calificaciones))if($calificaciones[14] == "4")echo 'checked' ; ?> required >
                            <label for="8_4">Muy bueno</label>
                        </div>
                        <div>
                            <input type="radio" id="8_5" name="p8" value="5" <?php if(isset($calificaciones))if($calificaciones[14] == "5")echo 'checked' ; ?> required >
                            <label for="8_5">Excelente</label>
                        </div>
                        </fieldset>
                    </div>
                    <div>
                        <p>Dejamos tus sugerencias u opiniones</p>
                        <textarea name="sugerencias" id="sugerencias" cols="1" rows="1" <?= $encuestaAct?> >
                        <?php if(isset($sugerencia))echo $sugerencia ; ?>
                        </textarea>
                    </div>
                    <br>
                    <div>
                        <div style="width: 100%;">
                            <input type="submit" value="Enviar" id="enviarEncuesta" name="enviarEncuesta" <?= $encuestaAct?>>
                            <input type="reset" value="Cancelar" id="Cancelar" <?= $encuestaAct?>>
                        </div>
                    </div>
                    <br>
                </form>
            </div> 
        </div>
    </div>
    <footer class="main-footer">
            <p>Todos los derechos reservados © 2023 | Marina Meza Online</p>
        </footer>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="scripts/menu.js"></script>
        <script src="scripts/tabs.js"></script>
<?php
    include 'templates/footer.php';
?>