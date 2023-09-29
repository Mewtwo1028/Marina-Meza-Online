<?php include 'headerCliente.php' ?>
<?php require_once "../conexionBD.php";

$query = mysqli_query($mysqli, "SELECT idCitas from citas");

?>

<?php
if (!isset($_GET['idCliente'])) {
    header('Location: ../cliente.php?mensajeC=Ha ocurrido un error');
    exit();
}

include_once '../empleado/model/conecEmple.php';
$idCliente = $_GET['idCliente'];

$sentencia = $bd->prepare("select * from cliente where idCliente = ?;");
$sentencia->execute([$idCliente]);
$persona = $sentencia->fetch(PDO::FETCH_OBJ);
//print_r($persona);

$Cita = $persona->FK_cita_idCita;

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Editar datos del Cliente
                </div>
                <form class="p-4" method="POST" action="editarProcesoCliente.php">
                    <div class="mb3">
                        <label class="form-label">Correo:</label>
                        <input type="text" class="form control" name="txtCorreo" autofocus required value="<?php echo $persona->correo; ?>">
                    </div>
                    <div class="mb3">
                        <label for="Citaid" class="form-label">ID-Cita:</label>
                        <select name="Citaid" class="form-select" id="Citaid">
                            <option disabled selected value="<?php echo $persona->FK_cita_idCita; ?>"></option>
                            <?php
                            foreach ($query as $fila) {

                            ?>

                                <option value="<?= $fila['idCitas'] ?>" <?php echo $Cita == $fila['idCitas'] ? 'selected' : '' ?>> <?= $fila['idCitas']  ?> </option>
                            <?php
                            }
                            ?>
                        </select>

                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="idCliente" value="<?php echo $persona->idCliente; ?>">
                        <input type="submit" class="btn btn-primary" value="Editar">


                    </div>
                </form>
                <a href="../../sistema/cliente.php">
                    <button type="submit" class="btn btn-primary">Regresar</button>
                </a>
            </div>
        </div>
    </div>
</div>

<?php include 'footerCliente.php' ?>