<?php include_once "includes/templates/header.php"; ?>


    <section class="seccion contenedor" >
       <h2>Crear Administradores</h2>
        <form action="crear_admin.php" class="login" action="POST">
            <div class="campo">
                <label for="usuario">Usuario: </label> <input type="text" id="usuario" name="usuario" placeholder="tu usuario">
            </div>

            <div class="campo">
                <label for="Password">Password: </label> <input type="text" id="password" name="password" placeholder="tu password">
            </div>
            <div class="campo">
               <input type="submit" name="submit" class="button" value="crear">
            </div>
        </form>
      
    </section> 

    <?php include_once "includes/templates/footer.php"; ?>