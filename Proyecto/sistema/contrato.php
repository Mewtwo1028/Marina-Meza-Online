<?php require_once "vistas/parte_superior.php"  ?>
<?php require_once "./conexionBD.php";

?>
<?php
$query1 = mysqli_query($mysqli, "SELECT * from eventos");
$query2 = mysqli_query($mysqli, "SELECT * from fotos");
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
        <form class="row g-3 mt-2" method="POST" action="../pdf/newContract.php" enctype="multipart/form-data">
        <h1>Contrato con el cliente</h1>
        <h5>
            Para actualizar el contrato haga uno nuevo en Office Word y al guardar el archivo especifíquelo con extension "Páginas web (*.htm;* .html)".
        </h5>
        <div>
            <img style="width: 700px;" src="../img/Contrato.jpg" alt="Ejemplo">
        </div>
        <h6>
            En las partes específicas donde se declaran los datos del evento, que son el cliente y la fecha,
            escriba estos datos de la siguiente manera: <br> <br>
            --Cliente-- <br>
            --Fecha--
        </h6>
            <div class="col-4 mb-2">
                <label for="archivo">Seleccionar archivo</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input"  accept=".htm, .html" id="archivo" name="archivo" required >  
                    <label class="custom-file-label" for="archivo">Elegir archivo</label>
                </div>
            </div>
            <div class="col-10 mb-2">
                <input type="submit" class="btn btn-primary" value="Registrar">
            </div>
        </form>
        <div>
            <style>
                iframe {
                    padding: 2em;
                    width: 95%;
                    height: 25rem;
                }
            </style>
            <iframe src="../pdf/contrato.htm"></iframe>
        </div>
    </div>  
</body>
<?php require_once "vistas/parte_inferior.php"?>