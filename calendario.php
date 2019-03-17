

<?php include_once "includes/templates/header.php"; ?>

 
    <section class="seccion conetenedor">
        <h2>Calendario de eventos</h2>

        <?php
        try{
            require_once("includes/funciones/bd_conexion.php");
            $sql="SELECT evento_id,nombre_evento, fecha_evento,hora_evento, cat_evento,nombre_invitado,
            apellido_invitado FROM eventos e INNER JOIN categoria_evento ce ON e.id_cat_evento=ce.id_categoria
            INNER JOIN invitados i ON e.id_inv=i.invitado_id
            ORDER BY evento_id;";
            $resultado=$conn->query($sql);
        }catch(Exception $e){
            $error=$e->getMessage();
        }
        ?>


        <div class="calendario">
        <?php
       while($eventos=$resultado->fetch_all(MYSQLI_ASSOC)){  ?>
        
        <?php $dias=array(); ?>
        <?php foreach($eventos as $evento) {
            $dias[]=$evento["fecha_evento"];
        }?>

        <?php $dias=array_values(array_unique($dias)); ?>
        <?php $contador=0; ?>
        
        <?php
           foreach($eventos as $evento):
           ?>

           <?php
           $dia_actual=$evento["fecha_evento"]; 

           if($dia_actual==$dias[$contador]): ?>
           <h3><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo $evento["fecha_evento"]; ?></h3>

        <?php if($contador<2){
            $contador++;
            }else{ $contador=0;
            } ?>
        <?php endif;?>

        <div class="dia">
        <p class="titulo"><?php echo utf8_encode($evento["nombre_evento"]) ?></p>
        <p class="hora"><i class="fa fa-clock-o" aria-hidden="true">
        </i><?php echo $evento["fecha_evento"]." ".$evento["hora_evento"]." hrs" ?></p>
        <p>
            <?php
            $categoria_evento=$evento["cat_evento"];

            switch($categoria_evento){
                case "Talleres":
                echo '<i class="fa fa-code" aria-hidden="true"></i>Taller ';
            break;
                case "Conferencias":
                echo '<i class="fa fa-comment" aria-hidden="true"></i>Conferencia ';
                break;
                case "Seminarios":
                echo '<i class="fa fa-university" aria-hidden="true"></i>Seminario ';
                break;
                default:
                echo "";
                break;
            }
            ?>
        </p>
        <p> <i class="fa fa-user" aria-hidden="true"></i>
        <?php echo $evento["nombre_invitado"]." ".$evento["apellido_invitado"]; ?>
        </p>
        </div>
            <?php
            endforeach;
       }
            ?>
        </div> <!--.calendario-->

        <?php $conn->close(); ?>
    </section> 
    
    <?php include_once "includes/templates/footer.php"; ?>