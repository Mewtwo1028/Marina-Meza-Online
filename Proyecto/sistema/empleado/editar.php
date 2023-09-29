<?php include 'header.php' ?>


<?php
if (!isset($_GET['idEmpleado'])) {
    header('Location: ../empleado.php?mensaje=error');
    exit();
}

include_once './model/conecEmple.php';
$idEmpleado = $_GET['idEmpleado'];

$sentencia = $bd->prepare("select * from empleado where idEmpleado = ?;");
$sentencia->execute([$idEmpleado]);
$persona = $sentencia->fetch(PDO::FETCH_OBJ);
//print_r($persona);

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Editar datos de empleado
                </div>
                <form class="p-4" method="POST" action="editarProceso.php">
                    <div class="mb3">
                        <label class="form-label">Nombre:</label>
                        <input type="text" class="form control" name="txtNombre" autofocus required 
                        value="<?php echo $persona->nombre; ?>">
                    </div>
                    <div class="mb3">
                        <label class="form-label">Apellido:</label>
                        <input type="text" class="form control" name="txtApellido" autofocus required
                        value="<?php echo $persona->apellido; ?>">
                    </div>
                    <div class="mb3">
                        <label class="form-label">Cumpleaños:</label>
                        <input type="date" class="form control" name="txtCumpleaños" autofocus required
                        value="<?php echo $persona->fechaNacimiento; ?>">
                    </div>
                    <div class="mb3">
                        <label class="form-label">Usuario:</label>
                        <input type="text" class="form control" name="txtUsuario" autofocus required
                        value="<?php echo $persona->usuario; ?>">
                    </div>
                    <div class="mb3">
                        <label class="form-label">Contraseña:</label>
                        <input type="text" class="form control" name="txtContraseña" autofocus required
                        value="<?php echo $persona->password; ?>">
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="idEmpleado"   value="<?php echo $persona->idEmpleado; ?>">
                        <input type="submit" class="btn btn-primary" value="editar">
                        

                    </div>
                </form>
                <a href="../../sistema/empleado.php">
                    <button type="submit" class="btn btn-primary">Regresar</button>
                </a>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php' ?>