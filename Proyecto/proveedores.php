<?php 
    include 'conexion.php';
    include 'templates/header.php' 
?>

<head><title>Marina Meza Online | Proveedores</title></head>
                    <ul>
                        <li>
                            <a href="mievento.php">Mi evento</a>
                        </li>
                        <li>
                            <a href="crearcita.php">Apartar una cita</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
<main>
    <div class="tab">
        <button class="tablinks" onclick="openTab(event, 'tab1')">Registrar proveedor</button>
        <button class="tablinks" onclick="openTab(event, 'tab2')">Editar proveedor</button>
    </div>
    <div id="tab1" class="tabcontent">
        <div class="registrar-proveedor">
            <form action="proveedor.php" method="POST">
                <input type="text" id="proveedor" name="proveedor"required>
                <label for="proveedor">Proveedor</label>
                <input type="text" id="telefono" name="telefono" required >
                <label for="proveedor">Telefono del contacto</label>
                <input type="text" id="descripcion" name="descripcion" required>
                <label for="proveedor">Descripción</label>

                <br>

                <select name="tipo_servicio" id="tipo_servicio" required>
                    <option value="" disabled selected >Seleccionar</option>
                    <option value="Papeleria">Papeleria</option>
                    <option value="Florería">Florería</option>
                    <option value="Banquetes">Banquetes</option>
                    <option value="Sonido">Sonido</option>
                    <option value="Ballet-Parking">Ballet-Parking</option>
                    <option value="Casino">Casino</option>
                </select>
                <label for="proveedor">Tipo de servicio</label>
                <br><br>
                <div class="centrar">
                    <div style="width: 100%;" >
                        <input type="submit" value="Agregar" id="Agregar" name="submit">
                        <input type="reset" value="Cancelar" id="Cancelar">
                    </div>
                </div>

            </form>
        </div>
        <div class="tabla-proveedor">   
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Proveedor</th>
                        <th>Telefono</th>
                        <th>Descripción</th>
                        <th>Servicio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Crear la consulta SQL para obtener los datos de la base de datos
                        try{
                            $query = "SELECT * FROM proveedor";
                            // Ejecutar la consulta
                            $ejecutar = $bd -> query($query);
                            // Iterar sobre los resultados y crear las filas de la tabla
                        }catch(Exception $e){
                            ?>
                          <td> <?php echo "Error al tratas de conectar con la base de datos!"; ?> </td>
                           <?php
                        }
                        if($ejecutar){
                            foreach ($ejecutar as $fila){
                                ?>
                                <tr>
                                    <td> <?php echo $fila['idProveedor']; ?></td>
                                    <td> <?php echo $fila['nombre_proveedor']; ?></td>
                                    <td> <?php echo $fila['telefono']; ?></td>
                                    <td> <?php echo $fila['descripcion']; ?></td>
                                    <td> <?php echo $fila['tipoServicio']; ?></td>
                                </tr>
                                <?php
                            }
                        }
                        
                        // Cerrar la conexión a la base de datos
                        ?>
                </tbody>
            </table>
        </div>
    </div>
      
    <div id="tab2" class="tabcontent">
        
        <div  class="tabla-proveedor">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Proveedor</th>
                        <th>Telefono</th>
                        <th>Descripción</th>
                        <th>Servicio</th>
                        <th><span id="open-menu-button" class="jam jam-pencil"></th>
                        <th><span id="open-menu-button" class="jam jam-trash"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Crear la consulta SQL para obtener los datos de la base de datos
                        $query = "SELECT * FROM proveedor";
                        // Ejecutar la consulta
                        $ejecutar = $bd -> query($query);
                        // Iterar sobre los resultados y crear las filas de la tabla
                        foreach ($ejecutar as $fila){
                            ?>
                            <tr>
                                <td> <?= $fila['idProveedor']; ?></td>
                                <td> <?= $fila['nombre_proveedor']; ?></td>
                                <td> <?= $fila['telefono']; ?></td>
                                <td> <?= $fila['descripcion']; ?></td>
                                <td> <?= $fila['tipoServicio']; ?></td>
                                <td> <a href="proveedor.php?id=<?= $fila['idProveedor'] . ' edit'?>"><span id="open-menu-button" class="jam jam-pencil"></span></a></td>
                                <td> <a href="proveedor.php?id=<?= $fila['idProveedor'] . ' delete'?>"><span id="open-menu-button" class="jam jam-trash"></span></a></td>
                            </tr>
                            <?php
                        }
                        // Cerrar la conexión a la base de datos
                        $bd = null;
                        ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<footer class="main-footer">
    <p>Todos los derechos reservados © 2023 | Marina Meza Online</p>
</footer>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="scripts/menu.js"></script>
        <script src="scripts/tabs.js"></script>
<?php include 'templates/footer.php' ?>