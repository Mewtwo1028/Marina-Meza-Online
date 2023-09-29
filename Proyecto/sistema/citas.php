<?php require_once "vistas/parte_superior.php"  ?>
<?php
include_once "empleado/model/conecEmple.php";
$sentencia = $bd->query("select * from citas");
$citas = $sentencia->fetchAll(PDO::FETCH_OBJ);

function esCaduca($id){
    global $bd;
    $sentencia2 = $bd->prepare("select * from citas where idCitas = ?;");
    $sentencia2->execute([$id]);
    $persona1 = $sentencia2->fetch(PDO::FETCH_OBJ);
    $fecha = $persona1->fecha;
    $fechaActual = new DateTime();  // Fecha actual
    $date = new DateTime($fecha);
    return $date >= $fechaActual;
}
?>

<body>

    <div class="container">
        <!-- alerta-->
        <?php
        if (isset($_GET['mensajeCita']) and $_GET['mensajeCita']  == 'falta algun dato') {



        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Rellena todos los campos.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }

        ?>

        <?php
        if (isset($_GET['mensajeCita']) and $_GET['mensajeCita']  == 'Cita registrada correctamente') {

        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Cita registada</strong> Se agrego correctamente la cita
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }

        ?>


        <?php
        if (isset($_GET['mensajeCita']) and $_GET['mensajeCita']  == 'Ha ocurrido un error') {



        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error al actualizar!</strong> Intenta de nuevo
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }

        ?>

        <?php
        if (isset($_GET['mensajeCita']) and $_GET['mensajeCita']  == 'eliminado') {

        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Cita eliminada</strong> Se elimino correctamente la cita
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }

        ?>
        <?php
        if (isset($_GET['mensajeCita']) and $_GET['mensajeCita']  == 'Cita actualizada correctamente') {

        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Cita actualizada</strong> Se actualizo correctamente la cita
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        ?>
        <?php
        if (isset($_GET['mensajeCita']) and $_GET['mensajeCita']  == 'Registros') {
        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>¡Error al borar la cita!</strong> Tiene que borrar todos los datos relacionados con la cita
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        ?>

        <!-- fin alerta-->
        <h1>Registro de citas</h1>
        <form class="row g-3 mt-5" method="POST" action="./citas/registrarCitas.php">

            <div class="col-2">
                <label for="Nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="Nombre" placeholder="Nombre para reservar" name="Nombre">
            </div>
            <div class="col-2">
                <label for="Apellido" class="form-label">Apellido:</label>
                <input type="text" class="form-control" id="Apellido" name="Apellido">
            </div>
            <div class="col-2">
                <label for="Telefono" class="form-label">Telefono:</label>
                <input type="text" class="form-control" id="Telefono" name="Telefono">
            </div>
            <div class="col-2">
                <label for="FechaCita" class="form-label">Fecha de cita:</label>
                <input type="date" onchange="muestraSelect(this.value)" class="form-control" id="fecha" name="FechaCita">
            </div>
            <div class="col-2" >
                <label for="FechaCita" class="form-label">Hora de cita:</label>
                <div id="horarios">
                    <select name="hora" id="hora" class="form-select" required>
                        <option value="" disabled selected >Seleccionar</option>
                    </select>
                </div>
            </div>
            <div class="d-grid">
                <input type="submit" class="btn btn-primary" value="Registrar">
            </div>
        </form>


        <div class="container mt-5">
            <table class="table table-striped">
                <thead>
                    <tr class="table table-sm">
                        <th>#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Fecha de Cita</th>
                        <th scope="col">Hora de Cita</th>
                        <th scope="col" colspan="2">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($citas as $dato) {
                    ?>
                        <tr>
                            <td scope="row"><?php echo $dato->idCitas; ?></td>
                            <td><?php echo $dato->nombre; ?></td>
                            <td><?php echo $dato->apellidos; ?></td>
                            <td><?php echo $dato->telefono; ?></td>
                            <td><?php echo $dato->fecha; ?></td>
                            <td><?php echo $dato->hora; ?></td>
                            <?php
                                if(esCaduca($dato->idCitas))echo '<td><a class="text-success" href="citas/editarCitas.php?idCitas=' .  $dato->idCitas . '"><i class="bi bi-pencil-square"></i></a></td>';
                                else echo '<td></td>';
                            ?>
                            <td><a class="text-success" href="./citas/eliminarCitas.php?idCitas=<?= $dato->idCitas; ?>" onclick="return confirm('Estas seguro de eliminar la cita?')"><i class="bi bi-trash"></i></a></td>

                        </tr>
                    <?php

                    }

                    ?>
                </tbody>
            </table>
        </div>



    </div>
    <script src="js/date.js"></script>
</body>
<?php require_once "vistas/parte_inferior.php"  ?>