<?php require_once "vistas/parte_superior.php"  ?>
<?php require_once "./conexionBD.php";

$query = mysqli_query($mysqli, "SELECT * from citas");
?>
<div class="container">
       <?php
       include_once "./empleado/model/conecEmple.php";
       $sentencia = $bd->query("select * from cliente");
       $cliente = $sentencia->fetchAll(PDO::FETCH_OBJ);


       ?>
       <div class="container mt-5">


              <div class="row justify-content-center">
                     <div class="col-md-7">
                            <!-- alerta-->
                            <?php
                            if (isset($_GET['mensajeC']) and $_GET['mensajeC']  == 'falta algun dato') {



                            ?>
                                   <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                          <strong>Error!</strong> Rellena todos los campos.
                                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                   </div>
                            <?php
                            }

                            ?>

                            <?php
                            if (isset($_GET['mensajeC']) and $_GET['mensajeC']  == 'Cliente registrado correctamente') {

                            ?>
                                   <div class="alert alert-success alert-dismissible fade show" role="alert">
                                          <strong>Cliente registado</strong> Se agrego correctamente el cliente
                                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                   </div>
                            <?php
                            }

                            ?>


                            <?php
                            if (isset($_GET['mensajeC']) and $_GET['mensajeC']  == 'Ha ocurrido un error') {



                            ?>
                                   <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                          <strong>Error al actualizar!</strong> Intenta de nuevo
                                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                   </div>
                            <?php
                            }

                            ?>

                            <?php
                            if (isset($_GET['mensajeC']) and $_GET['mensajeC']  == 'eliminado') {

                            ?>
                                   <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                          <strong>Cliente eliminado</strong> Se elimino correctamente el cliente
                                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                   </div>
                            <?php
                            }

                            ?>
                            <?php
                            if (isset($_GET['mensajeC']) and $_GET['mensajeC']  == 'Cliente actualizado correctamente') {

                            ?>
                                   <div class="alert alert-success alert-dismissible fade show" role="alert">
                                          <strong>Cliente actualizado</strong> Se actualizo correctamente el cliente
                                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                   </div>
                            <?php
                            }

                            ?>

                            <!-- fin alerta-->
                            <div class="card">
                                   <div class="card-header">
                                          Lista de Clientes
                                   </div>
                                   <div class="p-4">

                                          <table class="table aling-middle">
                                                 <thead>
                                                        <tr>
                                                               <th>#</th>
                                                               <th scope="col">Correo</th>
                                                               <th scope="col">ID-Cita</th>
                                                               <th scope="col" colspan="2">Opciones</th>


                                                        </tr>
                                                 </thead>
                                                 <tbody>
                                                        <?php
                                                        foreach ($cliente as $dato) {
                                                        ?>
                                                               <tr>
                                                                      <td scope="row"><?php echo $dato->idCliente ?></td>
                                                                      <td><?php echo $dato->correo; ?></td>
                                                                      <td><?php echo $dato->FK_cita_idCita; ?></td>
                                                                      <td><a class="text-success" href="./cliente/editarCliente.php?idCliente=<?php echo $dato->idCliente; ?>"><i class="bi bi-pencil-square"></i></a></td>
                                                                      <td><a class="text-success" href="./cliente/eliminarCliente.php?idCliente=<?php echo $dato->idCliente; ?>" onclick="return confirm('Estas seguro de eliminar este cliente?')"><i class="bi bi-trash"></i></a></td>


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
                                          Registrar Cliente
                                   </div>
                                   <script>
                                          function validarFormulario() {
                                                 return true;
                                          }
                                   </script>


                                   <form class="p-4" method="POST" action="../sistema/cliente/registrarCliente.php" onsubmit="return validarFormulario()">
                                          <div class="mb3">
                                                 <label class="form-label">Correo:</label>
                                                 <input type="text" class="form control" name="txtCorreo" autofocus required>
                                          </div>
                                          <div class="mb3">
                                                 <label for="Citaid" class="form-label">ID-Cita:</label>
                                                 <select name="Citaid" class="form-select" id="Citaid">
                                                        <option disabled selected></option>
                                                        <?php
                                                        foreach ($query as $fila) {

                                                        ?>
                                                               
                                                               <option class="form control" value="<?= $fila['idCitas'] ?>"> <?= $fila['idCitas'] . " - " . $fila['nombre'] . " - " . $fila['apellidos'] . " - " . $fila['fecha']  ?> </option>
                                                        <?php
                                                        }
                                                        ?>
                                                 </select>

                                          </div>
                                          <div class="d-grid">
                                                 <input type="hidden" name="oculto" value="1">
                                                 <input type="submit" class="btn btn-primary" value="Registrar">
                                          </div>
                                   </form>
                            </div>
                     </div>

              </div>
       </div>
</div>

<?php require_once "vistas/parte_inferior.php"  ?>