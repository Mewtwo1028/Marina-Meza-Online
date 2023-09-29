<?php require_once "vistas/parte_superior.php"  ?>
<?php require_once "./conexionBD.php";

$fechaActual = new DateTime();
$fechaActualSinHora = $fechaActual->format('Y-m-d');
$query = mysqli_query($mysqli, "SELECT cliente.idCliente, citas.nombre, citas.apellidos from cliente INNER JOIN citas ON cliente.FK_cita_idCita = citas.idCitas");
$query2 = mysqli_query($mysqli, "SELECT idEvento, fecha FROM eventos");

foreach($query2 as $fila){
    if($fila['fecha'] < $fechaActualSinHora){
        $idEvento = $fila['idEvento'];
        $query2 = mysqli_query($mysqli, "UPDATE eventos SET estatus = 'Terminado' WHERE idEvento = $idEvento");
    }
}

?>
<?php
    include_once "./empleado/model/conecEmple.php";
    $sentencia = $bd->query("select * from eventos");
    $evento = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<body class="container mt-5">
    <div class="container mt-5 ">
        <!-- alerta-->
        <?php
        if (isset($_GET['mensajeEve']) and $_GET['mensajeEve']  == 'fecha registrada') {
        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Ya existe un evento con esa fecha, intente con otra
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        ?>
       <?php
        if (isset($_GET['mensajeEve']) and $_GET['mensajeEve']  == 'falta algun dato') {
        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Rellena todos los campos.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        ?>
        <?php
        if (isset($_GET['mensajeEve']) and $_GET['mensajeEve']  == 'evento registrado') {
        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Evento registrado</strong> Se agrego correctamene el evento
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        ?>
        <?php
        if (isset($_GET['mensajeEve']) and $_GET['mensajeEve']  == 'error') {
        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error al actualizar!</strong> Intenta de nuevo
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        ?>
         <?php
        if (isset($_GET['mensajeEve']) and $_GET['mensajeEve']  == 'eliminado') {
        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Eliminado</strong> Evento eliminado
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        ?>
        <?php
        if (isset($_GET['mensajeEve']) and $_GET['mensajeEve']  == 'fecha') {
        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Fecha muy adelantada!</strong> Los fechas de evento tiene que tener 30 días de anticipación.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        ?>

        <!-- fin alerta-->
        
        <h1>registro de eventos</h1> 
        <form class="row g-3 mt-5" method="POST" action="evento/registrarEvento.php" >
        <div class="col-3">
                <label for="LugarEvento" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombreEvento" placeholder="Nombre" name="nombreEvento" required>
            </div>
            <div class="col-2">
                <label for="FechaEvento" class="form-label">Fecha del evento</label>
                <input type="date" class="form-control" id="fechaEvento" name="FechaEvento" min ="" required>
            </div>
            
            <div class="col-3">
                <label for="LugarEvento" class="form-label">Lugar del evento</label>
                <input type="text" class="form-control" id="LugarEvento" placeholder="Direccion de evento" name="LugarEvento" required>
            </div>
            <div class="col-2">
                <label for="NumInvitados" class="form-label">No. Invitados</label>
                <input type="number" class="form-control" id="NumInvitados" name="NumInvitados" required >
            </div>
            <div class="col-2">
                <label for="TipoEvento" class="form-label">Tipo de evento</label>
                <select class="form-select" aria-label="Default select example" id="TipoEvento" name="TipoEvento" required >
                    <option selected></option>
                    <option value="Romantico">Romantico</option>
                    <option value="Privado">Privado</option>
                    <option value="Formal">Formal</option>
                    <option value="Informal">Informal</option>

                    <option value="otros">otros</option>
                </select>

            </div>
            <div class="col-2">
                <label for="Estatus" class="form-label">Estatus</label>
                <select class="form-select" aria-label="Default select example" id="Estatus" name="Estatus" required >
                    <option selected></option>
                    <option value="Aceptado">Aceptado</option>
                    <option value="Preparacion">En preparacion</option>
                </select>
            </div>
            <div class="col-3">
                <label for="cotizacion" class="form-label">Cotización</label>
                <input type="number" step="0.01" min="0" pattern="^\d+(?:\.\d{1,2})?$" class="form-control" id="cotizacion" placeholder="$$$" name="cotizacion" required>
            </div>
            <div class="col-3">
                <label for="LugarEvento" class="form-label">Descripcion</label>
                <input type="text" class="form-control" id="descripcion" placeholder="Descripcion" name="descripcion" required>
            </div>
            <div class="col-1">
                <label for="Clienteid" class="form-label">Cliente-id</label>
                <select name="Clienteid" class="form-select" id="Clienteid" required >
                    <option disabled selected></option>
                    <?php
                    foreach ($query as $fila) {
                    ?>
                        <option value="<?= $fila['idCliente'] ?>"> <?= $fila['idCliente'] . " - " . $fila['nombre'] . " " . $fila['apellidos'] ?> </option>
                    <?php
                    }
                    ?>
                </select>

            </div>
            <div class="d-grid">

                <input type="submit" class="btn btn-primary" value="registrar">
            </div>
        </form>
        <div class="container mt-5">
            <table class="table table-striped">
                <thead>
                    <tr class="table table-sm">
                        <th>#</th>
                        <th scope="col">Fecha-Evento</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Lugar</th>
                        <th scope="col">No. Invitados</th>
                        <th scope="col">Tipo de evento</th>
                        <th scope="col">Estatus</th>
                        <th scope="col">Cotización</th>
                        <th scope="col">descripcion</th>
                        <th scope="col">Id-Cliente</th>
                        <th scope="col" colspan="2">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($evento as $dato) {
                    ?>
                        <tr>
                            <td scope="row"><?php echo $dato->idEvento; ?></td>
                            <td><?php echo $dato->fecha; ?></td>
                            <td><?php echo $dato->nombre; ?></td>
                            <td><?php echo $dato->lugar; ?></td>
                            <td><?php echo $dato->noInvitados; ?></td>
                            <td><?php echo $dato->tipoEvento; ?></td>
                            <td><?php echo $dato->estatus; ?></td>
                            <td><?php echo $dato->cotizacion; ?></td>
                            <td><?php echo $dato->descripcion; ?></td>
                            <td><?php echo $dato->FK_cliente_idCliente; ?></td>

                            <td><a class="text-success" href="./evento/editarEvento.php?idEvento=<?php echo $dato->idEvento; ?>"><i class="bi bi-pencil-square"></i></a></td>
                            <td><a class="text-success" href="./evento/eliminarEvent.php?idEvento=<?php echo $dato->idEvento; ?>" onclick="return confirm('Estas seguro que quieres eliminar este evento?')"><i class="bi bi-trash"></i></a></td>


                        </tr>
                    <?php

                    }

                    ?>
                </tbody>
            </table>
        </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/eventos.js"></script>
</body>

<?php require_once "vistas/parte_inferior.php"  ?>