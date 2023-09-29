<?php include 'templates/header.php'; ?>
<head><title>Marina Meza Online | Crear cita</title></head>
                    <ul>
                        <li>
                            <a href="mievento.php">Mi evento</a>
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
    <br>
    <div class="form-login">
        <h6>Genere una cita para que uno de nuestros colaboradores se ponga en contacto con usted para planear su boda</h6>
        <br>
        <div>
        <?php 
            // Se inicia sesión de datos en la pagina con el método "session_start" para recibir los datos 
            // del archivo citas.php.
            session_start();
            // Verificamos mediante el método SESSION si la variable listo ha sido enviada
            if(isset($_SESSION['listo'])){
                // De ser recibida verificamos que su valor sea para confirmar los datos registrados
                if($_SESSION['listo'] == 1){
                    // Declaramos un div con el mensaje de confirmación de datos guardados correctamente.
        echo '<div style="color: green; margin: 1em; text-align:center; font-size: 20px; font-weight: 600;" role="alert">
                Se ha registrado con exito su cita!
            </div>';   
                }
            }
            // Cerramos la sesión de los datos.
            session_unset();
        ?>
    </div>
        <br>
        <form action="citas.php?tipo=0" method="POST">
            <input type="text" id="name" name="nombre" required>
            <label for="name">Ingresa tu nombre(s)</label>
            <input type="text" id="lastname" name="apellido" required>
            <label for="lastname">Ingresa tu apellido(s)</label>
            <input type="text" id="phone" name="numero" required>
            <label for="name">Ingresa tu número de teléfono</label>
            <input type="date" id="fecha" name="fecha" onchange="muestraSelect(this.value)" min="" required>
            <label for="name">Ingresa tu fecha de cita</label>
            <div id="horarios">
                <select name="hora" id="hora" required>
                    <option value="" disabled selected >Seleccionar</option>
                </select>
            </div>
            <label for="name">Ingresa la hora disponible</label>
            <br>
            <br>
            <div class="centrar">
                <div style="width: 100%;">
                    <input type="submit" value="Registar cita">
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
<script src="scripts/date.js"></script>
<?php include 'templates/footer.php'; ?>    