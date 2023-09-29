
<?php include 'header.php' ?>


<?php
if (!isset($_GET['idProveedor'])) {
    header('Location: ../proveedor.php?mensajeP=error');
    exit();
}

include_once './model/conecProve.php';
$idProveedor = $_GET['idProveedor'];

$sentencia = $bd->prepare("select * from proveedor where idProveedor = ?;");
$sentencia->execute([$idProveedor]);
$persona = $sentencia->fetch(PDO::FETCH_OBJ);
//print_r($persona);

$Tipo_Servicio = $persona->tipoServicio; /// modificado


$Descripcion = $persona->descripcion;



?>

<body class="sb-nav-fixed">

    <div class="container mt-5">


        <form class="row  g-3" method="POST" action="editarProcesoProve.php">
            <input type="hidden" name="id_prov" value="<?php echo $idProveedor; ?>">
            <div class="col-6 ">
                <label for="NombreProve"> Nombre del proveedor</label>
                <input type="text" class="form-control" id="NombreProve" placeholder="nombre" name="nombreProveedor" value="<?php echo $persona->nombre_proveedor; ?>">
            </div>
            <div class="col-6">
                <label for="telefono"> telefono del proveedor</label>
                <input type="tel" class="form-control" id="telProveedor"  name="telProveedor" value="<?php echo $persona->telefono; ?>">
            </div>

            <div class="mb-3">
                <label for="comenId" class="form-label">Descripción</label>
                <textarea id="descProveedor" class="form-control" placeholder="Descripción" name="descProveedor" value="<?php  echo $persona->descripcion; ?>"><?php  echo $persona->descripcion; ?></textarea>
            </div>

            <div class="mb-3">
                <label for="select1">Tipo de servicio</label>
                <select class="form-select" name="selectTS" id="selectTS" >
                    <option  selected>Seleccionar</option>
                    <option value="Papeleria"   <?php echo ($Tipo_Servicio == 'Papeleria'?'selected':'') ?>>Papeleria</option>
                    <option value="Florería" <?php echo ($Tipo_Servicio == 'Floreria'?'selected':'') ?>>Florería</option>
                    <option value="Banquetes" <?php echo ($Tipo_Servicio == 'Banquetes'?'selected':'') ?>>Banquetes</option>
                    <option value="Sonidos" <?php echo ($Tipo_Servicio == 'Sonidos'?'selected':'') ?>>Sonidos</option>
                    <option value="Ballet-Parking" <?php echo ($Tipo_Servicio == 'Ballet-Parking'?'selected':'') ?>>Ballet-Parking</option>
                    <option value="Casino" <?php echo ($Tipo_Servicio == 'Casino'?'selected':'') ?>>Casino</option>
                </select>
            </div>
            <div class="d-grid">
                <input type="hidden" name="oculto" value="1">
                <input type="submit" class="btn btn-primary" value="Actualizar registro">
            </div>
            <a href="../../sistema/proveedor.php">
                <button type="submit" class="btn btn-primary">Regresar</button>
            </a>

        </form>

    </div>

</body>

<?php include 'footer.php' ?>