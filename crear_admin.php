
<?php
        include_once "includes/funciones/funciones.php";
        session_start();
        usuario_autenticado();
?>

<?php include_once "includes/templates/header.php"; ?>


    <section class="admin seccion contenedor" >
       <h2>Crear Administradores</h2>
       <?php include_once "includes/templates/admin_nav.php"; ?>
        <form action="crear_admin.php" class="login" method="POST">
            <div class="campo">
                <label for="usuario">Usuario: </label> <input type="text" id="usuario" name="usuario" placeholder="tu usuario">
            </div>

            <div class="campo">
                <label for="Password">Password: </label> <input type="password" id="password" name="password" placeholder="tu password">
            </div>
            <div class="campo">
               <input type="submit" name="submit" class="button" value="crear">
            </div>
        </form>

        <?php
        
        if (isset($_POST["submit"])){
            $usuario=$_POST["usuario"];
            $password=$_POST["password"];

            if(strlen($usuario)<5){
                echo "El nombre del usuario debe ser mas largo";
            }
            $opciones=array (
                'cost' => 12
            );
            $hashed_password=password_hash($password,PASSWORD_BCRYPT, $opciones);

            try{
                require_once("includes/funciones/bd_conexion.php");
                $stmt=$conn->prepare("INSERT INTO admins (usuario,hash_pass) values (?,?)");
                $stmt->bind_param("ss", $usuario, $hashed_password);
                $stmt->execute();

                if($stmt->error){
                echo "<div class='mensaje error'>";
                echo "Hubo un error";
                echo "</div>" ;
            }else {
                echo "<div class='mensaje'>";
                echo "Usuario registrado correctamente";
                echo "</div>" ;
            }
                $stmt->close();
                $conn->close();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
        }

        ?>
      
    </section> 

    <?php include_once "includes/templates/footer.php"; ?>