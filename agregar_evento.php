<?php
        include_once "includes/funciones/funciones.php";
        session_start();
        usuario_autenticado();
        if(isset($_POST["submit"])){
            $nombre=$_POST["nombre"];
            $fecha=$_POST["fecha"];
            $hora=$_POST["hora"];
            $id_cat=$_POST["categorias"];
            $id_invitado=$_POST["invitado"];

            try{
                require_once("includes/funciones/bd_conexion.php");
                $stmt=$conn->prepare("SELECT cat_evento,COUNT(DISTINCT nombre_evento) FROM eventos
                INNER JOIN categoria_evento ON eventos.id_cat_evento=categoria_evento.id_categoria
                WHERE id_cat_evento=?");
                $stmt->bind_param("s",$id_cat);
                $stmt->execute();
                $stmt->bind_result($categoria_evento,$total);
                $stmt->store_result(); //guardar el resultado del sql anterior para nueva consulta.
                $sql="INSERT INTO eventos(nombre_evento,fecha_evento,hora_evento,id_cat_evento,id_inv,clave)
                VALUES (?,?,?,?,?,?);";
                $stmt2=$conn->prepare($sql);
                $stmt->fetch();
                (int) $total=$total;
                $total++;
                $clave=strtolower(substr($categoria_evento, 0, 5))."_". $total;
                $stmt2->bind_param("ssssss", $nombre, $fecha, $hora, $id_cat,$id_invitado,$clave);
                $stmt2->execute();
                $stmt2->close();
                $stmt->close();
                $conn->close();
                header('Location:agregar_evento.php?exitoso=1');
            }catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
        }
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
                <label for="categoria">Categoria: </label> <br>
                <?php
                try{
                    require_once("includes/funciones/bd_conexion.php");
                    $sql="SELECT * FROM categoria_evento";
                    $resultado=$conn->query($sql);
                    while($cat_eventos=$resultado->fetch_assoc()){
                    echo "<input type='radio' name='categorias' value='".$cat_eventos["id_categoria"]."' > ".$cat_eventos["cat_evento"]."<br/>";
                    ?>
                <?php
                    }
                }catch(Exception $e){
                    echo "Error: " . $e->getMessage();
                }
                ?>
            </div>
            <div class="campo">
                <label for="Invitado">Invitado: </label> 
                <select name="invitado">
                <?php
                try{
                    require_once("includes/funciones/bd_conexion.php");
                    $sql="SELECT invitado_id,nombre_invitado, apellido_invitado FROM invitados";
                    $res_invitados=$conn->query($sql);
                    while($invitados=$res_invitados->fetch_assoc()){
                    echo "<option value='".$invitados["invitado_id"]."'>".$invitados["nombre_invitado"]." ".$invitados["apellido_invitado"]."</option>";
                    ?>
                <?php
                    }
                }catch(Exception $e){
                    echo "Error: " . $e->getMessage();
                }
                ?>
                </select>
            </div>
            <div class="campo">
                <input type="submit" name="submit" value="agregar" class="button" >
            </div>
        </form>
        <?php 
        if(isset($_GET["exitoso"])){ ?>
            <div class="mensaje">
                Evento Agregado correctamente!
            </div>
       <?php } ?>

        <?php $conn->close(); ?>
    </section> 

    <?php include_once "includes/templates/footer.php"; ?>