<?php include 'header.php' ?>
<?php require_once "../conexionBD.php";

$query = mysqli_query($mysqli, "SELECT idCliente from cliente");

?>
<?php

include_once '../empleado/model/conecEmple.php';
$idEvento = $_GET['idEvento'];

$sentencia = $bd->prepare("select * from eventos where idEvento = ?;");
$sentencia->execute([$idEvento]);
$persona = $sentencia->fetch(PDO::FETCH_OBJ);
//print_r($persona);

// agregando
$Tipo_Evento = $persona->tipoEvento;

$Estatus = $persona->estatus;

$Cliente = $persona->FK_cliente_idCliente;


?>


<div class="container mt-5 ">

    <div class="card-header text-size-lg text-center ">
        Modificar de eventos
    </div>
    <form class="row g-3 mt-5" method="POST" action="editarEventoPro.php" >
   
    <div class="col-1">
        <label for="LugarEvento" class="form-label">Id Evento</label>
        <input type="text" class="form-control" id="id_evento_" name="id_evento_" value="<?php echo $idEvento; ?>" >
    </div>
    <div class="col-2">
        <label for="LugarEvento" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombreEvento" placeholder="Nombre de evento" name="nombreEvento" value="<?php echo $persona->nombre; ?>">
    </div>
    <div class="col-2">
        <label for="LugarEvento" class="form-label">Lugar del evento</label>
        <input type="text" class="form-control" id="LugarEvento" placeholder="Direccion de evento" name="LugarEvento" value="<?php echo $persona->lugar; ?>">
    </div>
    <div class="col-2">
        <label for="FechaEvento" class="form-label">Fecha del evento</label>
        <input type="date" class="form-control" id="FechaEvento" name="FechaEvento" value="<?php echo $persona->fecha; ?>">
    </div>
    <div class="col-2">
        <label for="NumInvitados" class="form-label">No. Invitados</label>
        <input type="number" class="form-control" id="NumInvitados" name="NumInvitados" value="<?php echo $persona->noInvitados; ?>">
    </div>
    <div class="col-2">
        <label for="TipoEvento" class="form-label">Tipo de evento</label>
        <select class="form-select" aria-label="Default select example" id="TipoEvento" name="TipoEvento">
            <option value=""></option>
            <!--- MODIFICADO --->
            <option value="Romantico" <?php echo $Tipo_Evento === 'Romantico'?'selected':'' ?>>Romantico</option>
            <option value="Privado" <?php echo $Tipo_Evento === 'Privado'?'selected':'' ?>>Privado</option>
            <option value="Formal" <?php echo $Tipo_Evento === 'Formal'?'selected':'' ?>>Formal</option>
            <option value="Informal" <?php echo $Tipo_Evento === 'Informal'?'selected':'' ?>>Informal</option>
            <option value="otros" <?php echo $Tipo_Evento === 'otros'?'selected':'' ?>>otros</option>
        </select>

    </div>
        <div class="col-2">
            <label for="Estatus" class="form-label">Estatus</label>
            <select class="form-select" aria-label="Default select example" id="Estatus" name="Estatus" value="<?php echo $persona->estatus ?>">
                <option selected></option>
                <option value="Pendiente de pago" <?php echo $Estatus === 'Pendiente de pago'?'selected':'' ?>>Pendiente de pago</option>
                <option value="Aceptado" <?php echo $Estatus === 'Aceptado'?'selected':'' ?>>Aceptado</option>
                <option value="Preparacion" <?php echo $Estatus === 'Preparacion'?'selected':'' ?>>En preparacion</option>
                <option value="Cancelado" <?php echo $Estatus === 'Cancelado'?'selected':'' ?>>Cancelado</option>
                <option value="Terminado" <?php echo $Estatus === 'Terminado'?'selected':'' ?>>Terminado</option>

            </select>

        </div>

        <div class="col-1">
            <label for="Clienteid" class="form-label">Cliente-id</label>
            <select name="Clienteid" class="form-select" id="Clienteid">
                <option disabled selected value="<?php echo $persona->FK_cliente_idCliente; ?>"></option>
                <?php
                foreach ($query as $fila) {

                ?>

                    <option value="<?= $fila['idCliente'] ?>" <?php echo $Cliente == $fila['idCliente']?'selected':'' ?>> <?= $fila['idCliente']  ?> </option>
                <?php
                }
                ?>
            </select>

        </div>
        <div class="d-grid">

            <input type="submit" class="btn btn-primary" value="Modificar">
        </div>
    </form>
</div>

<?php include 'footer.php' ?>