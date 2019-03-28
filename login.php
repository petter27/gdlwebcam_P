<?php
        $resultado="";
        if (isset($_POST["submit"])){
            session_start();
            $usuario=$_POST["usuario"];
            $password=$_POST["password"];
            

            try{
                require_once("includes/funciones/bd_conexion.php");
                $stmt=$conn->prepare("SELECT * FROM admins WHERE usuario=? ;");
                $stmt->bind_param("s", $usuario);
                $stmt->execute();
                $stmt->bind_result($id,$nombre_usuario, $password_usuario);
                
                while($stmt->fetch()){

                    if(password_verify($password,$password_usuario)){
                        $_SESSION['usuario']=$usuario;
                        $_SESSION['id']=$id;
                        header('Location: admin-area.php');
                    }else{
                        $resultado="Hubo un error";
                    }
                
                }
                    
                $stmt->close();
                $conn->close();
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
            
        }
?>


<?php include_once "includes/templates/header.php"; ?>


    <section class="seccion contenedor" >
       <h2>Iniciar Sesion</h2>
        <form action="login.php" class="login" method="POST">
            <div class="campo">
                <label for="usuario">Usuario: </label> <input type="text" id="usuario" name="usuario" placeholder="tu usuario">
            </div>

            <div class="campo">
                <label for="Password">Password: </label> <input type="password" id="password" name="password" placeholder="tu password">
            </div>
            <div class="campo">
               <input type="submit" name="submit" class="button" value="Iniciar">
            </div>
        </form>

            <?php 
            echo $resultado;
            ?>
      
    </section> 

    <?php include_once "includes/templates/footer.php"; ?>