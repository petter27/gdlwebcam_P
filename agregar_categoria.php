<?php
        include_once "includes/funciones/funciones.php";
        session_start();
        usuario_autenticado();

        if(isset($_POST["submit"])){
            $nombre=$_POST["nombre"];
            $icono=$_POST["icono"];
            try{
                require_once("includes/funciones/bd_conexion.php");
                $stmt=$conn->prepare("INSERT INTO categoria_evento (cat_evento,icono) 
                values (?,?)");
                $stmt->bind_param("ss", $nombre,$icono);
                $stmt->execute();
                $stmt->close();
                $conn->close();
                header('Location:agregar_categoria.php?exitoso=1');
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
        }
?>


<?php include_once "includes/templates/header.php"; ?>


    <section class="admin seccion contenedor" >
       <h2>Agregar Categoria</h2>
        <p> Bienvenido, <?php echo $_SESSION["usuario"]; ?> </p>
        <?php include_once "includes/templates/admin_nav.php"; ?>
        
        <form class="invitado" action="agregar_categoria.php" method="post">
            <div class="campo">
                <label for="nombre">Nombre Categoría: </label> 
                <input type="text" id="nombre" name="nombre" placeholder="nombre" required>
            </div>
            <div class="campo">
                <label for="icono">Icono: </label> 
                <input type="text" id="icono" name="icono" placeholder="Icono Font Awesome" required>
            </div>
            <div class="campo">
                <input type="submit" name="submit" value="agregar" class="button" >
            </div>
        </form>
        <?php 
        if(isset($_GET["exitoso"])){ ?>
            <div class="mensaje">
                Categoría Agregado correctamente!
            </div>
       <?php } ?>

    </section> 

    <?php include_once "includes/templates/footer.php"; ?>