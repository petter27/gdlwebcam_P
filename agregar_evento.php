<?php
        include_once "includes/funciones/funciones.php";
        session_start();
        usuario_autenticado();
?>


<?php include_once "includes/templates/header.php"; ?>


    <section class="admin seccion contenedor" >
       <h2>Agregar Evento</h2>
        <p> Bienvenido, <?php echo $_SESSION["usuario"]; ?> </p>
        <?php include_once "includes/templates/admin_nav.php"; ?>
        
        <form class="invitado" action="agregar_evento.php" method="post">
            <div class="campo">
                <label for="nombre">Nombre Evento: </label> 
                <input type="text" id="nombre" name="nombre" placeholder="nombre" required>
            </div>
            <div class="campo">
                <label for="fecha">Fecha: </label> 
                <input type="date" id="fecha" name="fecha"  required>
            </div>
            <div class="campo">
                <label for="nombre">Hora: </label> 
                <input type="time" id="hora" name="hora" placeholder="hora" required>
            </div>
            <div class="campo">
                <label for="categoria">Categoria: </label> 
                <input type="radio" name="categorias" value="1">Seminario
            </div>
            <div class="campo">
                <label for="Invitado">Invitado: </label> 
                <select name="invitado">
                    <option value="1">Rafael Bautista </option>
                </select>
            </div>
            <div class="campo">
                <input type="submit" name="submit" value="agregar" class="button" >
            </div>
        </form>
    </section> 

    <?php include_once "includes/templates/footer.php"; ?>