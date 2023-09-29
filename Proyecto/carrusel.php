<?php
// Importamos el archivo con la conexión con la base de datos (conexion.php).
include 'conexion.php';
    // Declaramos la variable $idEvento para para almacenar la id del evento obtenido por el método GET
    // por petición del archivo carrusel.js de su función cambiarAlbum(id).
    $idEvento = $_GET['id'];
    // Escribimos la petición a la base de datos para obtener las imágenes del respectivo evento seleccionado.
    $query = "SELECT ruta, descripcion FROM fotos WHERE FK_evento_idEvento = $idEvento";
    // Mandamos la petición
    $result = $bd -> query($query);
    // Declaramos la variable $fotos de tipo arreglo para alamcenar las rutas del as imágenes del respectivo
    // evento seleccionado.
    $fotos = array();
    // Introducimos las rutas en el arreglo con ayuda de la petición previamente ejecutada.
    foreach($result as $fila){
        $fotos[] = $fila['ruta'];
    }
    // Se imprimen cada ruta separadas por los caracteres "%%" para poder introducirse en las imágenes.
    for($i=0; $i<count($fotos); $i++)echo substr($fotos[$i], 6) . ($i == count($fotos)-1  ? "" : "%%");
    // Se cierra la base de datos.
    $bd = null;
?>