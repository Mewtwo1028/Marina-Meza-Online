<?php 
    include 'headerCitas.php';
    include '../../conexion.php';
?>


<?php
if (!isset($_GET['idCitas'])) {
    header('Location: ../citas.php?mensajeCita=Ha ocurrido un error');
    exit();
}

$idCitas = $_GET['idCitas'];

$sentencia = $bd->prepare("select * from citas where idCitas = ?;");
$sentencia->execute([$idCitas]);
$persona = $sentencia->fetch(PDO::FETCH_OBJ);

//print_r($persona);

?>
<body onload="muestraSelect('<?php $persona->fecha; ?>', '<?= $idCitas ?>')">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Editar datos de la Cita
                </div>
                <form class="p-4" method="POST" action="editarProcesoCitas.php">
                    <div class="mb3">
                        <label class="form-label">Nombre:</label>
                        <input type="text" class="form control" name="Nombre" autofocus required 
                        value="<?php echo $persona->nombre; ?>">
                    </div>
                    <div class="mb3">
                        <label class="form-label">Apellido:</label>
                        <input type="text" class="form control" name="Apellido" autofocus required 
                        value="<?php echo $persona->apellidos; ?>">
                    </div>
                    <div class="mb3">
                        <label class="form-label">Telefono:</label>
                        <input type="text" class="form control" name="Telefono" autofocus required
                        value="<?php echo $persona->telefono; ?>">
                    </div>
                    <div class="mb3">
                        <label for="FechaCita" class="form-label">Fecha de cita:</label>
                        <input type="date" onchange="muestraSelect(this.value, <?= $idCitas ?>)" class="form-control" id="fecha" name="FechaCita" value="<?= $persona->fecha; ?>">

                    </div>
                    <div class="mb3">
                        <label for="HoraCita" class="form-label">Hora de cita:</label>
                        <div id="horarios">
                            <select name="hora" id="hora" class="form-select" required>
                                <option value="" disabled >Seleccionar</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="idCitas" value="<?php echo $persona->idCitas; ?>">
                        <input type="submit" class="btn btn-primary" value="Editar">
                        

                    </div>
                </form>
                <a href="../../sistema/citas.php">
                    <button type="submit" class="btn btn-primary">Regresar</button>
                </a>
            </div>
        </div>
    </div>
</div>
</body>

<script src="../js/date2.js"></script>
<?php include 'footerCitas.php' ?>
