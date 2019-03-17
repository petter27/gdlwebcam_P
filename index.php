<?php include_once "includes/templates/header.php"; ?>

   <section class="seccion contenedor">
       <h2>La mejor conferencia de diseño web en español</h2>
       <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Duis venenatis 
           velit et metus. Duis lacinia leo in velit. Sed tristique. Sed id turpis malesuada nulla bibendum iaculis.
            In nec velit. Fusce augue diam, sollicitudin eu, porttitor vel, euismod vel, nisl. 
            Aenean venenatis quam eu massa.</p>
    </section> <!--seccion-->

    <section class="programa">
        <div class="contenedor-video">
            <video autoplay loop poster="img/bg-talleres.jpg">
                <source src="video/video.mp4" type="video/mp4">
                <source src="video/video.webm" type="video/webm">
                <source src="video/video.ogv" type="video/ogg">
            </video>
        </div> <!--Contenedor video-->

        <div class="contenido-programa">
            <div class="contenedor">
                <div class="programa-evento">
                    <h2>Programa del evento</h2>
                    <?php
                        try{
                            require_once("includes/funciones/bd_conexion.php");
                            $sql="SELECT * FROM categoria_evento;";
                            $resultado=$conn->query($sql);
                        }catch(Exception $e){
                          $error=$e->getMessage();
                         }
                    ?>

                    <nav class="menu-programa">
                    <?php
                        while ($categoria=$resultado->fetch_assoc()){ ?>
                        <a href="#<?php echo strtolower($categoria["cat_evento"]); ?>"><i class="fa <?php echo $categoria["icono"]; ?>" aria-hidden="true"></i><?php echo $categoria["cat_evento"]; ?></a>
                   <?php } ?>
                    </nav>

                    <?php
                     try{
                        require_once("includes/funciones/bd_conexion.php");
                        $sql="SELECT evento_id,nombre_evento, fecha_evento,hora_evento, cat_evento,nombre_invitado,
                        apellido_invitado FROM eventos e INNER JOIN categoria_evento ce ON e.id_cat_evento=ce.id_categoria
                        INNER JOIN invitados i ON e.id_inv=i.invitado_id AND e.id_cat_evento=1
                        ORDER BY evento_id LIMIT 2; ";
                        $sql.="SELECT evento_id,nombre_evento, fecha_evento,hora_evento, cat_evento,nombre_invitado,
                        apellido_invitado FROM eventos e INNER JOIN categoria_evento ce ON e.id_cat_evento=ce.id_categoria
                        INNER JOIN invitados i ON e.id_inv=i.invitado_id AND e.id_cat_evento=2
                        ORDER BY evento_id LIMIT 2; ";
                        $sql.="SELECT evento_id,nombre_evento, fecha_evento,hora_evento, cat_evento,nombre_invitado,
                        apellido_invitado FROM eventos e INNER JOIN categoria_evento ce ON e.id_cat_evento=ce.id_categoria
                        INNER JOIN invitados i ON e.id_inv=i.invitado_id AND e.id_cat_evento=3
                        ORDER BY evento_id LIMIT 2;";

                        }catch(Exception $e){
                        $error=$e->getMessage();
                        }
                    ?>

                    <?php $conn->multi_query($sql); ?>
                    <?php
                        do{
                            $resultado=$conn->store_result();
                            $row=$resultado->fetch_all(MYSQLI_ASSOC); ?>
                            <?php $i=0; ?>
                            <?php foreach($row as $evento): ?>
                            <?php if($i % 2==0){ ?>
                            <div id="<?php echo strtolower($evento['cat_evento']); ?>" class="info-curso ocultar clearfix">
                            <?php } ?>
                                <div class="detalle-evento">
                                    <h3><?php echo utf8_encode($evento['nombre_evento']); ?></h3>
                                    <p><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo $evento['hora_evento']; ?></p>
                                    <p><i class="fa fa-calendar" aria-hidden="true"></i><?php echo $evento['fecha_evento']; ?></p>
                                    <p><i class="fa fa-user" aria-hidden="true"></i><?php echo $evento['nombre_invitado'].' '.$evento['apellido_invitado']; ?></p>
                                </div>
                            <?php if($i % 2==1){ ?>
                            <a href="calendario.php" class="button float-right">ver todos</a>
                            </div> <!--id talleres-->
                            <?php } ?>
                            <?php $i++; ?>
                        <?php endforeach; ?>

                    <?php
                        $resultado->free();
                        }while($conn->more_results() && $conn->next_result());
                    ?>


                </div> <!--programa eventos-->
            </div> <!--Contenedor-->
        </div> <!--contenido del programa-->
    </section> <!--programa-->

    <?php include_once "includes/templates/invitados.php"; ?>

    <div class="contador parallax">
        <div class="contenedor">
            <ul class="resumen-evento clearfix">
                <li>
                    <p class="numero"> </p> Invitados
                </li>
                <li>
                        <p class="numero"> </p> Talleres
                </li>
                <li>
                        <p class="numero"> </p> Dias
                </li>
                <li>
                        <p class="numero"> </p> Conferencias
                </li>
            </ul>
        </div>
    </div>

    <section class="precios seccion">
        <h2>precios</h2>
        <div class="contenedor">
            <ul class="lista-precios clearfix">
                <li>
                    <div class="tabla-precio">
                        <h3>Pase por día</h3>
                        <p class="numero">$30</p>
                        <ul>
                            <li>Bocadillos gratis</li>
                            <li>Todas las conferencias</li>
                            <li>Todos los talleres</li>
                        </ul>
                        <a href="#" class="button hollow">Comprar</a>
                    </div>
                </li>

                <li>
                        <div class="tabla-precio">
                            <h3>Todos los días</h3>
                            <p class="numero">$50</p>
                            <ul>
                                <li>Bocadillos gratis</li>
                                <li>Todas las conferencias</li>
                                <li>Todos los talleres</li>
                            </ul>
                            <a href="#" class="button">Comprar</a>
                        </div>
                </li>
                <li>
                            <div class="tabla-precio">
                                <h3>Pase por 2 días</h3>
                                <p class="numero">$45</p>
                                <ul>
                                    <li>Bocadillos gratis</li>
                                    <li>Todas las conferencias</li>
                                    <li>Todos los talleres</li>
                                </ul>
                                <a href="#" class="button hollow">Comprar</a>
                            </div>
                </li>
            </ul>
        </div>
    </section>  <!-- fin precios-->

    <div class="mapa" id="mapa">
        
    </div>

    <section class="seccion">
        <h2>Testimoniales</h2>
        <div class="testimoniales contenedor clearfix">
        <div class="testimonial">
            <blockquote>
                <p>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quam nam ad incidunt accusantium dicta ipsam nihil sed, 
                    numquam pariatur blanditiis, non molestiae reprehenderit! Repellat possimus eum sit soluta adipisci aliquam!
                </p>
                <footer class="info-testimonial clearfix">
                    <img src="img/testimonial.jpg" alt="Imagen testimonial">
                    <cite>Oswaldo Aponte Escobar <span>Diseñador en @prisma</span></cite>
                </footer>  
            </blockquote>
        </div> <!-- testimonial-->

        <div class="testimonial">
                <blockquote>
                    <p>
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quam nam ad incidunt accusantium dicta ipsam nihil sed, 
                        numquam pariatur blanditiis, non molestiae reprehenderit! Repellat possimus eum sit soluta adipisci aliquam!
                    </p>
                    <footer class="info-testimonial clearfix">
                        <img src="img/testimonial.jpg" alt="Imagen testimonial">
                        <cite>Oswaldo Aponte Escobar <span>Diseñador en @prisma</span></cite>
                    </footer>  
                </blockquote>
            </div> <!-- testimonial-->
            <div class="testimonial">
                    <blockquote>
                        <p>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quam nam ad incidunt accusantium dicta ipsam nihil sed, 
                            numquam pariatur blanditiis, non molestiae reprehenderit! Repellat possimus eum sit soluta adipisci aliquam!
                        </p>
                        <footer class="info-testimonial clearfix">
                            <img src="img/testimonial.jpg" alt="Imagen testimonial">
                            <cite>Oswaldo Aponte Escobar <span>Diseñador en @prisma</span></cite>
                        </footer>  
                    </blockquote>
                </div> <!-- testimonial-->  
            </div> <!--testimoniales--> 
    </section>

    <div class="newletter parallax">
        <div class="contenido contenedor">
            <p>Regístrate al newletter:</p>
            <h3>GdlWebCam</h3>
            <a href="#mc_embed_signup" class="boton_newsletter button transparente">Registarse</a>
        </div> <!--contenido-->
    </div> <!--newletter-->

    <div class="seccion">
        <h2>Faltan</h2>
        <div class="cuenta-regresiva contenedor">
            <ul class="clearfix">
                <li>
                    <p id="dias" class="numero"></p> días
                </li>
                <li>
                    <p id="horas" class="numero"></p> horas
                        
                </li>
                <li>
                    <p id="minutos" class="numero"></p> minutos
                        
                </li>
                <li>
                    <p id="segundos" class="numero"></p> segundos
                </li>
            </ul>
        </div>
    </div> <!--cuenta regresiva-->


    <?php include_once "includes/templates/footer.php"; ?>