<?php 
    // Se importan otros archivos php como el header predeterminado para toda la pagina
    // así como el que nos permite tener conexion con la base de datos (header.php y conexion.php respectivamente).
    include 'templates/header.php'; 
    include 'conexion.php';
    // Se declara una variable ($albums) para alamacenar un texto generado más adelante donde tendrá toda la información de cada album del evento.
    $albums = array();
    // Se hace un llamado a todas las imagenes almacenadas en la base de datos.
    $queryEvento = "SELECT DISTINCT eventos.idEvento, eventos.nombre, eventos.fecha FROM eventos INNER JOIN fotos ON eventos.idEvento = fotos.FK_evento_idEvento";
    // Se ejecuta la petición
    $result = $bd -> query($queryEvento);
    // Se declaran las variables para identificar a cada imagen con su respectivo evento mediante los datos de su fila en la base de datos
    //($nombre, $fecha, $idEvento).
    $nombre = array();
    $fecha = array();
    $idEvento = array();
    //Se introducen estos datos dentro de las variables previamente creadas, con ayuda de la petición que se hizo hace 2 pasos.
    foreach($result as $fila){
        $nombre[] = $fila['nombre'];
        $fecha[] = $fila['fecha'];
        $idEvento[] = $fila['idEvento'];
    }
    // En esta parte se genera el texto antes explicado que será introducido en la parte derecha de la pagina galeria.php (Galeria de eventos),
    // y previamente introducido en cada posición del arreglo $albums[].
    for($i=0; $i < count($nombre); $i++){
        $albums[] = '
        <a href="javascript:void(0);" onclick="cambiarAlbum(' . $idEvento[$i] . ')"">
        <div class="album">
            <img src="img/galeria/foto1.jpg" alt="">
            <div class="album-info">
                <p>Evento: Boda ' . $nombre[$i] . '</p>
                <p>Realizado: ' . $fecha[$i] . '</p>
            </div>
        </div>
        </a>
        ';
    }
    
?>
<html>
    
<head><title>Marina Meza Online | Galería</title></head>
                <ul>
                    <li>
                        <a href="mievento.php">Mi evento</a>
                    </li>
                    <li>
                        <a href="crearcita.php">Apartar una cita</a>
                    </li>
                    <li>
                        <a href="sistema/index.php">Iniciar sesión</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <br>
        <h5 style="margin: 0; margin-top:1rem;">Galeria de eventos</h5>
        <div>
            <div class="border-gallery">
                <div class ="gallery-selecter">
                    <h6>Eventos</h6>
                    <?php for($i=0; $i < count($albums); $i++)echo $albums[$i];?>
                </div>
            </div>
            <div class ="gallery-viewer" id="gallery-viewer">
                <div class="container">
                    <div class="row">
                        <div class="col s12">
                            <div class="carousel center-align carousel2" id="carousel2">
                                <div class="carousel-item">
                                    <img id="fotos0" src="img/galeria/foto1.jpg" alt="">
                                </div>

                                <div class="carousel-item">
                                    <img id="fotos1" src="" alt="">
                                </div>

                                <div class="carousel-item">
                                    <img id="fotos2" src="" alt="">
                                </div>

                                <div class="carousel-item">
                                    <img id="fotos3" src="" alt="">
                                </div>

                                <div class="carousel-item">
                                    <img id="fotos4" src="" alt="">
                                </div>

                                <div class="carousel-item">
                                    <img id="fotos5" src="" alt="">
                                </div>

                                <div class="carousel-item">
                                    <img id="fotos6" src="" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <h6>Breve descripción de cada foto</h6>
                </div>
            </div>
        </div>
    </main>
    <footer class="main-footer">
        <p>Todos los derechos reservados © 2023 | Marina Meza Online</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="scripts/menu.js"></script>
    <script src="scripts/main2.js"></script>
    <script src="scripts/carrusel.js"></script>
    <!-- <script src="scripts/carousel.js"></script> -->
</html>
<?php include 'templates/footer.php'; ?>