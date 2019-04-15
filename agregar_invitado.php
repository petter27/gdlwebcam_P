<?php
        include_once "includes/funciones/funciones.php";
        session_start();
        usuario_autenticado();

        $resultado="";
        if(isset($_POST["submit"])){
            $nombre=$_POST["nombre"];
            $apellido=$_POST["apellido"];
            $descripcion=$_POST["descripcion"];

            //para la imagen
            $directorio="/img/invitados/";
            if(move_uploaded_file($_FILES["imagen"]["tmp_name"], __DIR__ . $directorio . $_FILES["imagen"]["name"])){
                $imagen_url=$_FILES["imagen"]["name"];
                $resultado="imagen subida";
                try{
                    require_once("includes/funciones/bd_conexion.php");
                    $stmt=$conn->prepare("INSERT INTO invitados (nombre_invitado,apellido_invitado,descripcion,url_imagen) 
                    values (?,?,?,?)");
                    $stmt->bind_param("ssss", $nombre, $apellido, $descripcion, $imagen_url);
                    $stmt->execute();
                    $stmt->close();
                    $conn->close();
                    header('Location:agregar_invitado.php?exitoso=1');
                }catch(Exception $e){
                    echo "Error: " . $e->getMessage();
                }
            }
        }
?>


<?php include_once "includes/templates/header.php"; ?>


    <section class="admin seccion contenedor" >
       <h2>Panel de Administración</h2>
        <p> Bienvenido, <?php echo $_SESSION["usuario"]; ?> </p>
        <?php include_once "includes/templates/admin_nav.php"; ?>
        <form class="invitado" action="agregar_invitado.php" method="post" enctype="multipart/form-data">
            <div class="campo">
                <label for="nombre">Nombre: </label> 
                <input type="text" id="nombre" name="nombre" placeholder="nombre" required>
            </div>
            <div class="campo">
                <label for="apellido">Apellido: </label> 
                <input type="text" id="apellido" name="apellido" placeholder="Apellido" required>
            </div>
            <div class="campo">
                <label for="descripcion">Descripcion: </label> 
                <textarea id="descripcion" name="descripcion" placeholder="Descripcion" required></textarea>
            </div>
            <div class="campo">
                <label for="Imagen">Imagen: </label> 
                <input type="file" id="imagen" name="imagen" required>
            </div>
            <div class="campo">
                <input type="submit" name="submit" value="agregar" class="button" >
            </div>
        </form>

    <?php if(isset($_GET["exitoso"])){ ?> 
        <div class="mensaje">
            Agregado correctamente!
        </div>

    <?php }  ?>
    </section> 

    <?php include_once "includes/templates/footer.php"; ?>