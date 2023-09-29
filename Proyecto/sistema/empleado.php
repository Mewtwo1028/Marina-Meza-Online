<?php require_once "vistas/parte_superior.php"  ?>
<div class="container">
    <?php
    include_once "./empleado/model/conecEmple.php";
    $sentencia = $bd->query("select * from empleado");
    $empleado = $sentencia->fetchAll(PDO::FETCH_OBJ);


    ?>


    <div class="container mt-5">


        <div class="row justify-content-center">
            <div class="col-md-7">
                <!-- alerta-->
                <?php
                if (isset($_GET['mensaje']) and $_GET['mensaje']  == 'falta algun dato') {



                ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> Rellena todos los campos.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                }

                ?>

                <?php
                if (isset($_GET['mensaje']) and $_GET['mensaje']  == 'empleado registrado') {



                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Usuario registado</strong> Se agrego correctamente el usuario
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                }

                ?>


                <?php
                if (isset($_GET['mensaje']) and $_GET['mensaje']  == 'error') {



                ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error al actualizar!</strong> Intenta de nuevo
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                }
                ?>

<?php
                if (isset($_GET['mensaje']) and $_GET['mensaje']  == 'admin') {



                ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Administrador en riesgo!</strong> No se puede eliminar la sesión del Administrador
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                }
                ?>

                <!-- fin alerta-->
                <div class="card">
                    <div class="card-header">
                        lista de empleados
                    </div>
                    <div class="p-4">

                        <table class="table aling-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Apellido</th>
                                    <th scope="col">Fecha-Nacimiento</th>
                                    <th scope="col">usuario</th>

                                    <th scope="col" colspan="2">Opciones</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($empleado as $dato) {
                                ?>
                                    <tr>
                                        <td scope="row"><?php echo $dato->idEmpleado; ?></td>
                                        <td><?php echo $dato->nombre; ?></td>
                                        <td><?php echo $dato->apellido; ?></td>
                                        <td><?php echo $dato->fechaNacimiento; ?></td>
                                        <td><?php echo $dato->usuario; ?></td>

                                        <td><a class="text-success" href="./empleado/editar.php?idEmpleado=<?php echo $dato->idEmpleado; ?>"><i class="bi bi-pencil-square"></i></a></td>
                                        <td><a class="text-success" href="./empleado/eliminar.php?idEmpleado=<?php echo $dato->idEmpleado;?>" onclick="return confirm('Estas seguro que quieres eliminar este empleado?')"><i class="bi bi-trash"></i></a></td>


                                    </tr>
                                <?php

                                }

                                ?>
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Registrar Empleados
                    </div>
                    <script>
                        function validarFormulario() {
                            var fechaNacimiento = new Date(document.getElementById("txtCumpleaños").value);
                            var fechaMinima = new Date();
                            fechaMinima.setFullYear(fechaMinima.getFullYear() - 18);
                            if (fechaNacimiento >= fechaMinima) {
                                alert("El empleado debe tener 18 años para poder trabajar");
                                return false;
                            }
                            return true;
                        }
                    </script>


                    <form class="p-4" method="POST" action="empleado/registrar.php" onsubmit="return validarFormulario()">
                        <div class="mb3">
                            <label class="form-label">Nombre:</label>
                            <input type="text" class="form control" name="txtNombre" autofocus required>
                        </div>
                        <div class="mb3">
                            <label class="form-label">Apellido:</label>
                            <input type="text" class="form control" name="txtApellido" autofocus required>
                        </div>
                       
                        <div class="mb3">
                            <label class="form-label">Fecha Nacimiento:</label>
                            <input type="date" class="form control" name="txtCumpleaños" id="txtCumpleaños" autofocus required>
                        </div>

                        <div class="mb3">
                            <label class="form-label">Usuario:</label>
                            <input type="text" class="form control" name="txtUsuario" autofocus required>
                        </div>
                        <div class="mb3">
                            <label class="form-label">Contraseña:</label>
                            <input type="text" class="form control" name="txtContraseña" autofocus required>
                        </div>
                        <div class="d-grid">
                            <input type="hidden" name="oculto" value="1">
                            <input type="submit" class="btn btn-primary" value="registrar">
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>


<?php require_once "vistas/parte_inferior.php"  ?>