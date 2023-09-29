<?php require_once "vistas/parte_superior.php"  ?>
<?php require_once "./conexionBD.php";

$query2 = mysqli_query($mysqli, "SELECT * from proveedor");
$query1 = mysqli_query($mysqli, "SELECT * from eventos");
$query = mysqli_query($mysqli, "SELECT eventos.nombre from eventos INNER JOIN servicios ON FK_eventos_idEventos = idEvento");

?>
<?php
include_once "./empleado/model/conecEmple.php";
$sentencia = $bd->query("select * from servicios");
$servicio = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>
<?php
include_once "./empleado/model/conecEmple.php";
$sentencia = $bd->query("select * from eventos");
$evento = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>
<?php
include_once "./empleado/model/conecEmple.php";
$sentencia = $bd->query("select * from cliente");
$cliente = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>
<?php
include_once "./empleado/model/conecEmple.php";
$sentencia = $bd->query("select * from proveedor");
$proveedor = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<body>

    <div class="container">
        <!-- alerta-->
        <?php
        if (isset($_GET['mensajeS']) and $_GET['mensajeS']  == 'falta algun dato') {
        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Rellena todos los campos.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }

        ?>

        <?php
        if (isset($_GET['mensajeS']) and $_GET['mensajeS']  == 'Servicio registrado correctamente') {

        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Servicio registado</strong> Se agrego correctamente el servicio
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }

        ?>


        <?php
        if (isset($_GET['mensajeS']) and $_GET['mensajeS']  == 'Ha ocurrido un error') {



        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error al actualizar!</strong> Intenta de nuevo
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }

        ?>

        <?php
        if (isset($_GET['mensajeS']) and $_GET['mensajeS']  == 'eliminado') {

        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Servicio eliminado</strong> Se elimino correctamente el servicio
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }

        ?>
        <?php
        if (isset($_GET['mensajeS']) and $_GET['mensajeS']  == 'Servicio actualizado correctamente') {

        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Servicio actualizado</strong> Se actualizo correctamente el servicio
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }

        ?>

        <!-- fin alerta-->
        <h1>Registro de Servicios</h1>
        <form class="row g-3 mt-5" method="POST" action="servicios/registrarServicios.php">

            <div class="col-1">
                <label for="Eventoid" class="form-label">Evento-ID</label>
                <select name="Eventoid" class="form-select" id="Eventoid" required >
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
            <div class="col-2">
                <label for="Proveedorid" class="form-label">Proveedor-ID</label>
                <select name="Proveedorid" class="form-select" id="Proveedorid" required >
                    <option value="" disabled selected ></option>
                    <?php
                    foreach ($query2 as $fila) {

                    ?>
                        <option value="<?= $fila['idProveedor'] ?>"> <?= $fila['idProveedor'] . " - " . $fila['nombre_proveedor'] ?> </option>
                    <?php
                    }
                    ?>
                </select>
            </div>  
            <div class="col-4">
                <label for="Descripcion" class="form-label">Descripción</label >
                <input type="text" class="form-control" id="Descripcion" placeholder="Descripcion del servicio" name="Descripcion" required>

            </div>
            <div class="col-2">
                <label for="Cotizacion" class="form-label">Cotización: $</label >
                <input class="form-control" id="Cotizacion" placeholder="$$$" name="Cotizacion" type="number" step="0.01" min="0" pattern="^\d+(?:\.\d{1,2})?$" required>
            </div>
            <div class="col-2">
                <label for="Estatus" class="form-label">Estatus:</label>
                <select class="form-select" aria-label="Default select example" id="Estatus" name="Estatus" required>
                    <option value="" disabled selected></option>
                    <option value="En Confirmación">En Confirmación</option>
                    <option value="Disponible">Disponible</option>
                    <option value="No Disponible">No Disponible</option>
                    <option value="Pendiente de Pago">Pendiente de Pago</option>
                    <option value="Pagado">Pagado</option>
                </select>

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
                        <th scope="col">ID-Evento</th>
                        <th scope="col">ID-Proveedor</th>
                        <th scope="col">ID-Cliente</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Cotización</th>
                        <th scope="col">Estatus</th>
                        <th scope="col" colspan="2">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($servicio as $dato) {
                        foreach($query as $dato2){
                    ?>
                        <tr>
                            <td scope="row"><?php echo $dato->idServicio; ?></td>
                            <td><?php echo $dato->FK_eventos_idEventos . "-" . $dato2['nombre']; ?></td>
                            <td><?php echo $dato->FK_proveedor_idProveedor; ?></td>
                            <td><?php echo $dato->FK_eventos_cliente_idCliente; ?></td>
                            <td><?php echo $dato->descripcion; ?></td>
                            <td><?php echo $dato->cotizacion; ?></td>
                            <td><?php echo $dato->estatus; ?></td>

                            <td><a class="text-success" href="./servicios/editarServicios.php?idServicio=<?php echo $dato->idServicio; ?>"><i class="bi bi-pencil-square"></i></a></td>
                            <td><a class="text-success" href="./servicios/eliminarServicios.php?idServicio=<?php echo $dato->idServicio; ?>" onclick="return confirm('Estas seguro de eliminar este servicio?')"><i class="bi bi-trash"></i></a></td>


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