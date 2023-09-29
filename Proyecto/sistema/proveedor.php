<?php require_once "./vistas/parte_superior.php"  ?>


<div class="container">
    <?php

    include_once "./proveedor/model/conecProve.php";
    $sentencia = $bd->query("select * from proveedor");
    $proveedor = $sentencia->fetchAll(PDO::FETCH_OBJ);


    ?>
    <div class="container mt-5">
        <!-- alerta-->
        <?php
        if (isset($_GET['mensajeP']) and $_GET['mensajeP']  == 'falta algun dato') {



        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Rellena todos los campos.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }

        ?>

        <?php
        if (isset($_GET['mensajeP']) and $_GET['mensajeP']  == 'proveedor registrado') {



        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Proveedor registado: </strong> Proveedor registrado correctamente
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }

        ?>


        <?php
        if (isset($_GET['mensajeP']) and $_GET['mensajeP']  == 'error') {



        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error al actualizar!</strong> Intenta de nuevo
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }

        ?>

        <form class="row  g-3" method="POST" action="../sistema/proveedor/registrarProve.php">

            <div class="col-6 ">
                <label for="NombreProve"> Nombre del proveedor</label>
                <input type="text" class="form-control" id="NombreProve" placeholder="nombre" name="nomProveedor" required >
            </div>
            <div class="col-6">
                <label for="telefono"> telefono del proveedor</label>
                <input type="tel" class="form-control" id="telProveedor" placeholder="telefono" name="telProveedor" required >
            </div> 

            <div class="mb-3">
                <label for="comenId" class="form-label">Descripción</label>
                <textarea id="descProveedor" class="form-control" placeholder="Descripcón" name="descProveedor"></textarea required  >
            </div>

            <div class="mb-3">
                <label for="select1">Tipo de servicio</label>
                <select class="form-select" name="selectTS" id="selectTS" required>
                    <option  selected disabled>Seleccionar</option>
                    <option value="Florería y Decoración">Florería y Decoración</option>
                    <option value="Banquete-Catering">Banquetes</option>
                    <option value="Sonido">Sonidos</option>
                    <option value="Ballet-Parking">Ballet-Parking</option>
                    <option value="Casino">Casino</option>
                    <option value="Fotografía/Videografía">Fotografía/Videografía</option>
                    <option value="Música/Entretenimiento">Música/Entretenimiento</option>
                    <option value="Pastel de bodas">Pastel de bodas</option>
                    <option value="Invitaciones y papelería">Invitaciones y papelería</option>
                    <option value="Coordinador de bodas">Coordinador de bodas</option>
                    <option value="Alquiler de vehículos">Alquiler de vehículos</option>
                    <option value="Maquillaje y peinado">Maquillaje y peinado</option>
                    <option value="Alquiler de trajes">Alquiler de trajes</option>
                    <option value="Regalos y recuerdos">Regalos y recuerdos</option>
                    <option value="Servicio de transporte">Servicio de transporte</option>
                    <option value="Lugar de la boda">Lugar de la boda</option>
                    <option value="Servicio religioso">Servicio religioso</option>
                </select>
            </div>
            <div class="d-grid">
                <input type="hidden" name="oculto" value="1">
                <input type="submit" class="btn btn-primary" value="registrar">
            </div>
        </form>

    </div> <!--Aqui empieza la tabla de proveedores -->

    <div class="container mt-5">
        <table class="table table-striped">
            <thead>
                <tr class="table-primary">
                    <th>#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Tipo Servicio</th>
                    <th scope="col">Telefono</th>
                    <th scope="col" colspan="2">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($proveedor as $fila) {
                ?>
                    <tr>
                        <td scope="row"><?php echo $fila->idProveedor; ?></td>
                        <td><?php echo $fila->nombre_proveedor; ?></td>
                        <td><?php echo $fila->descripcion; ?></td>
                        <td><?php echo $fila->tipoServicio; ?></td>
                        <td><?php echo $fila->telefono; ?></td>

                        <td><a class="text-success" href="./proveedor/editarProve.php?idProveedor=<?php echo $fila->idProveedor; ?>"><i class="bi bi-pencil-square"></i></a></td>
                        <td><a class="text-success"  onclick="return confirm('Estas seguro que quieres eliminar este proveedor?')"  href="./proveedor/eliminarProve.php?idProveedor=<?php echo $fila->idProveedor; ?>"><i class="bi bi-trash"></i></a></td>
                    </tr>
                <?php

                }

                ?>
            </tbody>
        </table>

    </div>

    </body>


    <?php require_once "./vistas/parte_inferior.php"  ?>