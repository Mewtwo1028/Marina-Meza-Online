<?php include '../../conexion.php'?>

<!doctype html>
<html lang="es">

<head>
    <title>Marina Meza oNLINE</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- cdn icnonos-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>
    <div class="container-fluid bg-mz">
        <div class="row">
            <div class="col-md">
                <header class="py-3">
                    <h3 class="text-center">Editar Foto</h3>
                </header>
            </div>
        </div>
    </div>



<?php
if (!isset($_GET['id'])) {
    header('Location: ../galeria.php?mensajeP=error');
    exit();
}
$idFoto = $_GET['id'];

$query = "SELECT * FROM fotos WHERE idFoto = $idFoto";
$sentencia = $bd -> query($query);
//print_r($persona);

foreach($sentencia as $fila){
    $descripcion = $fila['descripcion'];
    $fecha = $fila['fecha'];
    $ruta = $fila['ruta'];
}

$query = "SELECT * FROM eventos";
$sentencia = $bd -> query($query);
//print_r($persona);

foreach($sentencia as $fila){
    $idEvento = $fila['idEvento'];
    $nEvento = $fila['fecha'];
    $lugar = $fila['lugar'];
    $fEvento = $fila['fecha'];
}



?>

<body class="sb-nav-fixed">

    <div class="container mt-5">


        <form class="row  g-3" method="POST" action="editarProcesoProve.php">
            <input type="hidden" name="id_prov" value="<?php echo $idProveedor; ?>">
            <div class="col-6 ">
                <label for="archivo">Seleccionar archivo</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" value ="<?= $ruta ?>" accept="image/jpeg, image/png" id="archivo" name="archivo" required >  
                    <label class="custom-file-label" for="archivo">Elegir archivo</label>
                </div>
            </div>
            <div class="col-6">
                <label for="telefono">Descripcion</label>
                <input type="tel" class="form-control" id="telProveedor"  name="telProveedor" value="<?= $descripcion ?>">
            </div>

            <div class="mb-3">
                <label for="comenId" class="form-label">Descripción</label>
                <textarea id="descProveedor" class="form-control" placeholder="Descripción" name="descProveedor" value="<?php  ?>"></textarea>
            </div>

            <div class="mb-3">
                <label for="select1">Tipo de servicio</label>
                <select class="form-select" name="selectTS" id="selectTS" >
                    <option  selected></option>
                    <option value="Papeleria"   <?php echo $Tipo_Servicio === 'Papeleria'?'selected':'' ?>>Papeleria</option>
                    <option value="Florería" <?php echo $Tipo_Servicio === 'Floreria'?'selected':'' ?>>Florería</option>
                    <option value="Banquetes" <?php echo $Tipo_Servicio === 'Banquetes'?'selected':'' ?>>Banquetes</option>
                    <option value="Sonidos" <?php echo $Tipo_Servicio === 'Sonidos'?'selected':'' ?>>Sonidos</option>
                    <option value="Ballet-Parking" <?php echo $Tipo_Servicio === 'Ballet-Parking'?'selected':'' ?>>Ballet-Parking</option>
                    <option value="Casino" <?php echo $Tipo_Servicio === 'Casino'?'selected':'' ?>>Casino</option>
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