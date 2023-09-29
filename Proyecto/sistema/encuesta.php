<?php 
    include '../conexion.php';
    require_once "vistas/parte_superior.php";
    include_once "./empleado/model/conecEmple.php";

    $sentencia = $bd->query("select * from encuestas");
    $encuesta = $sentencia->fetchAll(PDO::FETCH_OBJ);

    $sentencia = $bd->query("select * from cliente");
    $cliente = $sentencia->fetchAll(PDO::FETCH_OBJ);

    $query = "SELECT * FROM encuestas";
    $result = $bd ->query($query);
    $GLOBALS['p'] = array();
    $p0 = array();
    $p1 = array();
    $p2 = array();
    $p3 = array();
    $p4 = array();
    $p5 = array();
    $p6 = array();
    $p7 = array();
    $i = 0;

    if($result -> rowCount() > 0){
        foreach($result as $fila){
            $p[] = $fila['calificaciones'];
        }
    }

    for($i = 0; $i < count($p); $i++){
        $p0[$i] = explode("-", $p[$i])[0];
        $p1[$i] = explode("-", $p[$i])[1];
        $p2[$i] = explode("-", $p[$i])[2];
        $p3[$i] = explode("-", $p[$i])[3];
        $p4[$i] = explode("-", $p[$i])[4];
        $p5[$i] = explode("-", $p[$i])[5];
        $p6[$i] = explode("-", $p[$i])[6];
        $p7[$i] = explode("-", $p[$i])[7];
    }

    function porcent($datos){
        global $p;
        $results = array(0, 0, 0, 0, 0);
        for($i = 0; $i < count($p); $i++)if($datos[$i] == 1)$results[0] += (1/count($p))*100;
        for($i = 0; $i < count($p); $i++)if($datos[$i] == 2)$results[1] += (1/count($p))*100;
        for($i = 0; $i < count($p); $i++)if($datos[$i] == 3)$results[2] += (1/count($p))*100;
        for($i = 0; $i < count($p); $i++)if($datos[$i] == 4)$results[3] += (1/count($p))*100;
        for($i = 0; $i < count($p); $i++)if($datos[$i] == 5)$results[4] += (1/count($p))*100;
        return $results;
    }

    function doStyles($pregunta){
        $estilos = "
        height: 120px;
        width: 120px;
        background: conic-gradient(#F50001 "  . porcent($pregunta)[0] .  "%, 
        #FD7E31 0 " . (porcent($pregunta)[1] == 0 ? 0 : (porcent($pregunta)[0] + porcent($pregunta)[1])) .  "%, 
        #FDB331 0 " . (porcent($pregunta)[2] == 0 ? 0 : porcent($pregunta)[0] + porcent($pregunta)[1] + porcent($pregunta)[2]) .  "%, 
        #B7DB31 0 " . (porcent($pregunta)[3] == 0 ? 0 : porcent($pregunta)[0] + porcent($pregunta)[1] + porcent($pregunta)[2]) + porcent($pregunta)[3] .  "%,
        #5EBE5A 0 " . (porcent($pregunta)[4] == 0 ? 0 : porcent($pregunta)[0] + porcent($pregunta)[1] + porcent($pregunta)[2] + porcent($pregunta)[3] + porcent($pregunta)[4]) .  "%);
        border-radius: 50%;
        display: inline-block;
        ";
        return $estilos;
    }

?>
<div class="container mt-5">
    <h1>Datos de las encuestas</h1>
    <br>
    <div class="centrar">

            <div class="color1"><p><center>Malo</center></p></div>
            <div class="color2"><p><center>Regular</center></p></div>
            <div class="color3"><p><center>Bueno</center></p></div>
            <div class="color4"><p><center>Muy bueno</center></p></div>
            <div class="color5"><p><center>Excelente</center></p></div>
    </div>
    <br>
    <br>
    <div style="width: 120px; display: inline-block; margin: 0 0.4em;">
        <div style="<?= doStyles($p0);?>"></div>
        <p><center>pregunta 1?</center></p>
    </div>
    
    <div style="width: 120px; display: inline-block; margin: 0 0.4em;">
        <div style="<?= doStyles($p1);?>"></div>
        <p><center>pregunta 2?</center></p>
    </div>

    <div style="width: 120px; display: inline-block; margin: 0 0.4em;">
        <div style="<?= doStyles($p2);?>"></div>
        <p><center>pregunta 3?</center></p>
    </div>

    <div style="width: 120px; display: inline-block; margin: 0 0.4em;">
        <div style="<?= doStyles($p3);?>"></div>
        <p><center>pregunta 4?</center></p>
    </div>

    <div style="width: 120px; display: inline-block; margin: 0 0.4em;">
        <div style="<?= doStyles($p4);?>"></div>
        <p><center>pregunta 5?</center></p>
    </div>
    
    <div style="width: 120px; display: inline-block; margin: 0 0.4em;">
        <div style="<?= doStyles($p5);?>"></div>
        <p><center>pregunta 6?</center></p>
    </div>

    <div style="width: 120px; display: inline-block; margin: 0 0.4em;">
        <div style="<?= doStyles($p6);?>"></div>
        <p><center>pregunta 7?</center></p>
    </div>

    <div style="width: 120px; display: inline-block; margin: 0 0.4em;">
        <div style="<?= doStyles($p7);?>"></div>
        <p><center>pregunta 8?</center></p>
    </div>
    <table class="table table-striped">

        <thead>
            <tr>
                <th>#</th>
                <th scope="col">Calificaciones</th>
                <th scope="col">sugerencia</th>
                <th scope="col">FK_evento_idEvento</th>



            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($encuesta as $dato) {
            ?>
                <tr>
                    <td scope="row"><?php echo $dato->idEncuesta; ?></td>
                    <td><?php echo $dato->calificaciones; ?></td>
                    <td><?php echo $dato->sugerencia; ?></td>
                    <td><?php echo $dato->FK_evento_idEvento; ?></td>
                </tr>
            <?php

            }

            ?>
        </tbody>

        </tbody>
    </table>


</div>

<?php require_once "vistas/parte_inferior.php"  ?>