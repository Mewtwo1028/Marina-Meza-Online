<?php include 'headerServicios.php' ?>
<?php require_once "../conexionBD.php";

$query3 = mysqli_query($mysqli, "SELECT * from cliente");
$query2 = mysqli_query($mysqli, "SELECT * from proveedor");
$query1 = mysqli_query($mysqli, "SELECT * from eventos");

?>

<?php
include_once "../empleado/model/conecEmple.php";
$sentencia = $bd->query("select * from eventos");
$evento = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>
<?php
include_once "../empleado/model/conecEmple.php";
$sentencia = $bd->query("select * from cliente");
$cliente = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>
<?php
include_once "../empleado/model/conecEmple.php";
$sentencia = $bd->query("select * from proveedor");
$proveedor = $sentencia->fetchAll(PDO::FETCH_OBJ);

?>
<?php
if (!isset($_GET['idServicio'])) {
    header('Location: ../servicio.php?mensajeS=Ha ocurrido un error');
    exit();
}


include_once '../empleado/model/conecEmple.php';
$idServicio = $_GET['idServicio'];

$sentencia = $bd->prepare("select * from servicios where idServicio = ?;");
$sentencia->execute([$idServicio]);
$persona = $sentencia->fetch(PDO::FETCH_OBJ);
//print_r($persona);
$Cliente = $persona->FK_eventos_cliente_idCliente;
$evento = $persona->FK_eventos_idEventos;
$proveedor = $persona->FK_proveedor_idProveedor;
$estatus = $persona->estatus;
$descripcion = $persona->descripcion;
?>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Editar datos del Servicio
                </div>
                <form class="p-4" method="POST" action="editarProcesoServicios.php">
                    <div class="mb3">
                        <label for="Eventoid" class="form-label">Evento-ID</label>
                        <select name="Eventoid" class="form-select" value="<?php echo $persona->FK_eventos_idEventos; ?>">
                            <option disabled selected></option>
                            <?php
                            foreach ($query1 as $fila) {

                            ?>

                                <option value="<?= $fila['idEvento'] ?>" <?php echo $evento == $fila['idEvento'] ? 'selected' : '' ?>> <?= $fila['idEvento'] . " - " . $fila['lugar'] ?> </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb3">
                        <label for="Proveedorid" class="form-label">Proveedor-ID</label>
                        <select name="Proveedorid" class="form-select" id="Proveedorid">
                            <option disabled selected></option>
                            <?php
                            foreach ($query2 as $fila) {

                            ?>

                                <option value="<?= $fila['idProveedor'] ?>" <?php echo $proveedor == $fila['idProveedor'] ? 'selected' : '' ?>> <?= $fila['idProveedor'] . " - " . $fila['nombre_proveedor'] ?> </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb3">
                        <label class="form-label">Descripción:</label>
                        <input type="text" class="form control" name="Descripcion" autofocus required value="<?= $descripcion ?>">
                    </div>
                    <div class="mb3">
                        <label class="form-label">Cotización: $</label>
                        <input type="text" class="form control" name="Cotizacion" autofocus required value="<?php echo $persona->cotizacion; ?>">
                    </div>

                    <div class="mb3">
                        <label for="Estatus" class="form-label">Estatus:</label>
                        <select class="form-select" aria-label="Default select example" name="Estatus" value="<?php echo $persona->Estatus; ?>">
                            <option selected></option>
                            <option value="En Confirmación"<?php echo $estatus === 'En Confirmación' ? 'selected' : '' ?>>En Confirmación</option>
                            <option value="Disponible"<?php echo $estatus === 'Disponible' ? 'selected' : '' ?>>Disponible</option>
                            <option value="No Disponible"<?php echo $estatus === 'No Disponible' ? 'selected' : '' ?>>No Disponible</option>
                            <option value="Pendiente de Pago"<?php echo $estatus === 'Pendiente de Pago' ? 'selected' : '' ?>>Pendiente de Pago</option>
                            <option value="Pagado"<?php echo $estatus === 'Pagado' ? 'selected' : '' ?>>Pagado</option>
                        </select>

                    </div>


            </div>
            <div class="d-grid">
                <input type="hidden" name="idServicio" value="<?php echo $persona->idServicio; ?>">
                <input type="submit" class="btn btn-primary" value="Editar">


            </div>
            </form>
            <a href="../../sistema/servicios.php">
                <button type="submit" class="btn btn-primary">Regresar</button>
            </a>
        </div>
    </div>
</div>
</div>

<?php include 'footerServicios.php' ?>