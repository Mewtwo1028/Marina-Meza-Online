<?php
include 'conexion.php';

$fecha = $_GET['dia'];
$horas = array('09:00:00', '11:00:00', '13:00:00', '15:00:00', '17:00:00');
$horarios = array('09:00 - 11:00', '11:00 - 13:00', '13:00 - 15:00', '15:00 - 17:00', '17:00 - 19:00');
$disponibles = [];
$query = "SELECT * FROM citas WHERE fecha = :fecha";
$stmt = $bd->prepare($query);
$stmt->bindParam(':fecha', $fecha);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (count($result) > 0 && count($result) < 5) {
    $hora = array();
    foreach ($result as $fila) {
        $hora[] = $fila['hora'];
    }
    for ($i = 0; $i < count($horas); $i++) {
        if (!in_array($horas[$i], $hora)) {
            $disponibles[] = $horarios[$i];
        }
    }
    echo '<select name="hora" id="hora" class="form-select" required>';
    echo '<option value="" disabled selected >Seleccionar</option>';
    foreach ($disponibles as $fila) {
        echo '<option value="' . substr($fila, 0, 5) . '"> ' . $fila . ' </option>';
    }
    echo '</select>';
} 
else if (count($result) == 5){
    echo '<select name="hora" id="hora" class="form-select" required>';
    echo '<option value="" disabled selected >No disponible</option>';
    echo '</select>';
}
else {
    echo "
    <select name='hora' id='hora' class='form-select' required>
        <option value='' disabled selected >Seleccionar</option>";
    for ($i = 0; $i < count($horas); $i++) {
        echo '<option value="' . substr($horarios[$i], 0, 5) . ':00' . '"> ' . $horarios[$i] . ' </option>';
    }
    echo "</select>";
}
$bd = null;
?>
