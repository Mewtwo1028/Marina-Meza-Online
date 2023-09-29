<?php
// Incluir el archivo de conexión a la base de datos
include 'templates/header.php';
include 'conexion.php';


if(isset($_POST['submit'])){
    $proveedor = $_POST['proveedor'];
    $telefono = $_POST['telefono'];
    $descripcion = $_POST['descripcion'];
    $tipo_servicio = $_POST['tipo_servicio'];

    phpinfo();

    // Crear la consulta SQL para insertar los datos en la base de datos
    $query = "INSERT INTO proveedor(nombre_proveedor, descripcion, tipoServicio, telefono) 
            VALUES('$proveedor','$descripcion','$tipo_servicio','$telefono')";

    // Ejecutar la consulta y guardar el resultado
    $ejecutar = $bd -> query($query);

    // Verificar si la consulta se ejecutó correctamente
    if($ejecutar){
        // Si se insertó correctamente, redirigir al usuario a la página de proveedores
        header("Location: proveedores.php");
        ?> 
        <script>alert(<?php echo "registro con exito!"; ?> );</script>
        <?php
        // Cerrar la conexión a la base de datos
        mysqli_close($bd);
        exit(); // Terminar la ejecución del script
    } else {
        // Si hubo un error al insertar los datos, mostrar un mensaje de error y redirigir al usuario a la página de proveedores
        header("Location: proveedores.php");
        
        // Cerrar la conexión a la base de datos
        mysqli_close($bd);
        exit(); // Terminar la ejecución del script
    }
}
if(isset($_GET['id'])){
    if(explode(" ", $_GET['id'])[1] == 'edit'){
        $id = explode(" ", $_GET['id'])[0];
        $query = "SELECT * FROM proveedor WHERE idProveedor = $id";
        $execute = $bd -> query($query);
        foreach($execute as $fila){
            $proveedor = $fila['nombre_proveedor'];
            $telefono = $fila['telefono'];
            $descripcion = $fila['descripcion'];
            $tipo_servicio = $fila['tipoServicio'];
        }
        
    }
} 

if(isset($_POST['editar'])){

}
?>

<head><title>Marina Meza Online | Editar Proveedor</title></head>
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
<h4>Editar proveedor</h4>
<div class="editar-proveedor" >
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
                <input type="text" id="proveedor2" name="proveedorE", value="<?= $proveedor ?>">
                <label for="proveedor">Proveedor</label>

                <input type="text" id="telefono2" name="telefonoE" value="<?= $telefono ?>">
                <label for="proveedor">Telefono del contacto</label>

                <input type="text" id="descripcion2" name="descripcionE" value="<?= $descripcion ?>">
                <label for="proveedor">Descripción</label>
                <br>

                <select name="tipo_servicioE" id="tipo_servicio2" required>
                    <option value="" <?php if ($tipo_servicio == 'Seleccionar') echo 'selected';?> >Seleccionar</option>
                    <option value="Papeleria" <?php if ($tipo_servicio == 'Papeleria') echo 'selected';?> >Papeleria</option>
                    <option value="Florería" <?php if ($tipo_servicio == 'Florería') echo 'selected';?> >Florería</option>
                    <option value="Banquetes" <?php if ($tipo_servicio == 'Banquetes') echo 'selected';?> >Banquetes</option>
                    <option value="Sonido" <?php if ($tipo_servicio == 'Sonido') echo 'selected';?> >Sonido</option>
                    <option value="Ballet-Parking" <?php if ($tipo_servicio == 'Ballet-Parking') echo 'selected';?> >Ballet-Parking</option>
                    <option value="Casino" <?php if ($tipo_servicio == 'Casino') echo 'selected';?> >Casino</option>
                </select>
            
                <br>
                <br>
                <label for="proveedor">Tipo de servicio</label>
                <br>
                <div class="centrar">
                    <div style="width: 100%;">
                    <input type="submit" value="Modificar" id="Aceptar" name="editar">
                    <input type="reset" value="Cancelar" id="Cancelar">
                    </div>
                </div>
                
            </form>
        </div>
        <footer class="main-footer">
            <p>Todos los derechos reservados © 2023 | Marina Meza Online</p>
        </footer>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="scripts/menu.js"></script>
        <script src="scripts/tabs.js"></script>
<?php include 'templates/footer.php';?>