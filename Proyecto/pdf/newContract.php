<?php
    if($_FILES){
        $archivoSubido = $_FILES['archivo']['tmp_name'];
        echo $archivoSubido;
    }
    $archivoExistente = 'contrato.htm';
    $nuevoContenido = file_get_contents($archivoSubido);
    file_put_contents($archivoExistente, $nuevoContenido);
    header('Location: ../sistema/contrato.php');
    exit;
?>
