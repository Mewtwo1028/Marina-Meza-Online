<?php 
include 'templates/header.php';
include 'conexion.php';
?>  

<head><title>Marina Meza Online | Evento</title></head>
                    <ul>
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
    <div style="margin : 8rem auto; max-width: 500px;">
        <h5>Ingrese su clave de evento</h5>
        <br><br>
        <?php 
        // Comprobamos por medio del método "POST" si el botón ingresar ha si accionado
        if(isset($_POST['ingresar'])){
            // De ser así declaramos la variable $id y le damos el valor de la variable idEvento del
            // método "POST" 
            $id = $_POST['idEvento'];
            // Hacemos la petición para buscar el evento por medio del id ($id).
            $query = "SELECT * FROM eventos WHERE idEvento = $id";
            // Ejecutamos la petición
            $execute = $bd -> query($query);
            // Contamos el número de filas encontradas de eventos
            $count = $execute -> rowCount();
            //Verificamos que halla al menos 1 o que exista el evento
            if($count > 0){
                // De ser así iniciamos sesión de variables en la pagina con el método "session_start()".
                session_start();
                // Declaramos la varaible idEvento del método "session_start()" con la de idEvento del método
                // "POST".
                $_SESSION['idEvento'] = $_POST['idEvento'];
                // Redirigimos al cliente al la pagina Evento (evento.php).
                header("Location: evento.php");
                exit;
            }
            // De no ser correcto el id del evento se manda un mensaje de error diciendo que no es correcto el id del evento.
            else {
                echo '<div role="alert" style= "color: red;">
                    Error! Clave de evento incorrecto.
                </div>';
            }
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
            <input type="text" id="idEvento" name="idEvento" required autofocus>
            <label for="name">Clave de evento</label>
            <br>
            <br>
            <div class="centrar">
                <div style="width: 100%;">
                    <input type="submit" value="Ingresar" name="ingresar">
                </div>
            </div>
        </form>
    </div>
</main>
<footer class="main-footer">
            <p>Todos los derechos reservados © 2023 | Marina Meza Online</p>
        </footer>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="scripts/menu.js"></script>
<?php include 'templates/footer.php'; ?>