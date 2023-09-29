<?php require_once "vistas/parte_superior.php"  ?>
<?php require_once "./conexionBD.php";

?>
<?php
$query1 = mysqli_query($mysqli, "SELECT * from eventos");
$query2 = mysqli_query($mysqli, "SELECT * from fotos");
$query3 = mysqli_query($mysqli, "SELECT eventos.nombre FROM eventos INNER JOIN fotos ON FK_evento_idEvento = idEvento")
?>

<body class="container mt-5">
    <div class="container mt-5">
        <!-- alerta-->
        <?php
        if (isset($_GET['mensajeCita']) and $_GET['mensajeFoto']  == 'falta algun dato') {



        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Rellena todos los campos.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }

        ?>

        <?php
        if (isset($_GET['mensajeCita']) and $_GET['mensajeFoto']  == 'foto registrada') {

        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Cita registada</strong> Se agrego correctamente la cita
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }

        ?>


        <?php
        if (isset($_GET['mensajeCita']) and $_GET['mensajeFoto']  == 'Ha ocurrido un error') {



        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error al actualizar!</strong> Intenta de nuevo
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }

        ?>

        <?php
        if (isset($_GET['mensajeCita']) and $_GET['mensajeFoto']  == 'eliminado') {

        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Cita eliminada</strong> Se elimino correctamente la cita
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }

        ?>
        <?php
        if (isset($_GET['mensajeCita']) and $_GET['mensajeFoto']  == 'Cita actualizada correctamente') {

        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Cita actualizada</strong> Se actualizo correctamente la cita
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }

        ?>

        <!-- fin alerta-->
        <form class="row g-3 mt-2" method="POST" action="fotos/registrarFoto.php" enctype="multipart/form-data">
        <h1>Galeria de eventos pasados</h1>

            <div class="col-4 mb-2">
                <label for="archivo">Seleccionar archivo</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input"  accept="image/jpeg, image/png" id="archivo" name="archivo" required >  
                    <label class="custom-file-label" for="archivo">Elegir archivo</label>
                </div>
            </div>
            <div class="col-2 mb-2">
                <label for="Descripcion" class="form-label">Descripcion:</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" required >
            </div>
            <div class="col-2 mb-2">
                <label for="idEvento" class="form-label">Evento-ID</label>
                <select name="idEvento" class="form-select" id="idEvento" required >
                    <option value="" disabled selected ></option>
                    <?php
                    foreach ($query1 as $fila) {

                    ?>
                        <option value="<?= $fila['idEvento'] ?>"> <?= $fila['idEvento'] . " - " . $fila['nombre']  ?> </option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="d-grid">
                <input type="submit" class="btn btn-primary" value="Registrar">
            </div>
        </form>
        <div class="container m-1">
            <table class="table table-striped">
                <thead>
                    <tr class="table table-sm">
                        <th>#</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">ID de evento</th>
                        <th scope="col" colspan="2">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($query2 as $dato) {
                        foreach ($query3 as $fila) {
                    ?>
                        <tr>
                            <td><?= $dato['idFoto']; ?></td>
                            <td><?= $dato['descripcion']; ?></td>
                            <td><?= $dato['fecha']; ?></td>
                            <td><?= $dato['FK_evento_idEvento'] . "-" . $fila['nombre']; ?></td>

                            <td><a class="text-success" href="fotos/editarFoto.php?id=<?= $dato['idFoto']?>"><i class="bi bi-pencil-square"></i></a></td>
                            <td><a class="text-success" href="fotos/eliminarFoto.php?idFoto=<?= $dato['idFoto']?>" onclick="return confirm('Estas seguro de eliminar la foto?')"><i class="bi bi-trash"></i></a></td>

                        </tr>
                    <?php
                        }
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>  
</body>
<?php require_once "vistas/parte_inferior.php"  ?>