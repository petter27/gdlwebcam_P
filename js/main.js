var api="AIzaSyD6XZOtDbXdWbJ9gFS8FOiYj7nnFUTEy_0";


      function initMap() {

        var latLng={
            lat:13.987746,
            lng: -89.549231
        };

      var  map = new google.maps.Map(document.getElementById('mapa'), {
         'center': latLng,
          'zoom': 15,
          'mapTypeId':google.maps.MapTypeId.ROADMAP,
         /* 'draggable': false,
          'scrollwheel': false  */
        });

    var informacion=google.maps.InfoWindow({
        content: contenido
    });

    var contenido='<h2>GDLWEBCAM</>'+
                '<p>Del 10 al 12 de Diciembre</p>'+
                '<p>Visitanos!</p>';

    var marker=google.maps.Marker({
        position:latLng,
        map:map,
        title: 'GDLWEBCAM'
    });

    marker.addListener('click', function(){
        informacion.open(map,marker);
    });
      }


(function(){
    "use strict";
    document.addEventListener('DOMContentLoaded', function(){

        //Campos datos usuario
        var nombre=document.getElementById('nombre');
        var apellido=document.getElementById('apellido');
        var email=document.getElementById('email');

        //Campos pases
         var pase_dia=document.getElementById('pase_dia');
         var pase_completo=document.getElementById('pase_completo');
         var pase_dosdias=document.getElementById('pase_dosdias');


        //botones y divs

        var btnRegistro=document.getElementById('btnRegistro');
        var calcular=document.getElementById('calcular');
        var ErrorDiv=document.getElementById('error');
        var lista_productos=document.getElementById('lista-productos');
        var regalo=document.getElementById('regalo');
        var suma=document.getElementById('suma-total');

        //Extras
        var etiquetas=document.getElementById('etiquetas');
        var camisa_evento=document.getElementById('camisa_evento');

        btnRegistro.disabled=true;

if(document.getElementById('calcular')){

        calcular.addEventListener('click',calcularMonto);
        pase_dia.addEventListener('blur',mostrarDias);
        pase_dosdias.addEventListener('blur',mostrarDias);
        pase_completo.addEventListener('blur',mostrarDias);
        nombre.addEventListener('blur', validarCampos);
        apellido.addEventListener('blur', validarCampos);
        email.addEventListener('blur', validarCampos);
        email.addEventListener('blur', validarMail);


        function validarMail(){
            if(this.value.indexOf("@")>-1){
                ErrorDiv.style.display="none";
                this.style.border="1px solid #ccc";
             }else{
                ErrorDiv.style.display="block";
                ErrorDiv.innerHTML=("Email no válido");
                this.style.border="1px solid red";
                ErrorDiv.style.border="1px solid red";
                }
            
        }

        function validarCampos(){
                if(this.value==''){
                    ErrorDiv.style.display="block";
                    ErrorDiv.innerHTML=("Este campo es obligatorio");
                    this.style.border="1px solid red";
                    ErrorDiv.style.border="1px solid red";
                }else{
                    ErrorDiv.style.display="none";
                    this.style.border="1px solid #ccc";
                }
            
        }

        function calcularMonto(event){
            event.preventDefault();
        
            if(regalo.value===""){
                alert("Debes elegir un regalo");
                regalo.focus;
            }else{
                var boletosDia=parseInt(pase_dia.value,10)||0,
                    boletos2Dias=parseInt(pase_dosdias.value,10)||0,
                    boletoCompleto=parseInt(pase_completo.value,10)||0,
                    cantCamisas=parseInt(camisa_evento.value,10)||0,
                    CantEtiquetas=parseInt(etiquetas.value,10)||0;

                var totalPagar=(boletosDia*30)+(boletos2Dias*45)+(boletoCompleto*50)+((cantCamisas*10)*0.93)+(CantEtiquetas*2);

                var listaProductos=[];
                if(boletosDia>=1){
                listaProductos.push(boletosDia+' pases por día')
                 }
                 if(boletos2Dias>=1){
                listaProductos.push(boletos2Dias+' pases por 2 días');
                 }
                 if(boletoCompleto>=1){
                listaProductos.push(boletoCompleto+' pases completos');
                 }
                 if(cantCamisas>=1){
                listaProductos.push(cantCamisas+' camisas');
                 }
                 if(CantEtiquetas>=1){
                listaProductos.push(CantEtiquetas+' etiquetas');
                 }

                 lista_productos.style.display="block";
                 lista_productos.innerHTML="";

                 for(var i=0; i<listaProductos.length;i++){
                     lista_productos.innerHTML +=listaProductos[i]+'</br>';
                 }

                 suma.innerHTML="\$ "+totalPagar.toFixed(2);
            }
            btnRegistro.disabled=false;
            document.getElementById("total_pedido").value=totalPagar.toFixed(2);

        };

        function mostrarDias(event){
        var boletosDia=parseInt(pase_dia.value,10)||0,
            boletos2Dias=parseInt(pase_dosdias.value,10)||0,
            boletoCompleto=parseInt(pase_completo.value,10)||0;

            var diasElegidos=[];
            if(boletosDia>0){
            diasElegidos.push('viernes');
            }

            if(boletos2Dias>0){
                diasElegidos.push('viernes','sabado');
            }

            if(boletoCompleto>0){
                diasElegidos.push('viernes','sabado','domingo');
            }

           
            for(var i=0; i<diasElegidos.length;i++){
                document.getElementById(diasElegidos[i]).style.display="block";
            }

        }
        
    }
    });  //DOM Content Loaded
})();



$(function(){

    //lettering
    $('.nombre-sitio').lettering();

    //Agregar clase a menu (PAra saber donde se encuentra el usuario)

    $("body.conferencia .navegacion-principal a:contains('Conferencia')").addClass("activo");
    $("body.calendario .navegacion-principal a:contains('Calendario')").addClass("activo");
    $("body.invitados .navegacion-principal a:contains('Invitados')").addClass("activo");

    //dejar fijo el menu del sitio
    var windowHeigth=$(window).height();
    var BarraAltura=$('.barra').innerHeight();

    $(window).scroll(function(){
        var scroll=$(window).scrollTop();
        if(scroll>windowHeigth){
            $('.barra').addClass('fixed');
            $('body').css({'margin-top':BarraAltura+'px'});
        }else{
            $('.barra').removeClass('fixed');
            $('body').css({'margin-top':'0px'});
        }
    });
    
    //menu responsive
    $('.menu-movil').on('click', function(){
        $('.navegacion-principal').slideToggle();
    });



    //programa de coferencias
    $('.programa-evento .info-curso:first').show();
    $('.menu-programa a:first').addClass('activo');
    $('.menu-programa a').on('click', function(){
        $('.menu-programa a').removeClass('activo');
        $(this).addClass('activo');
        $('.ocultar').hide();
        var enlace=$(this).attr('href');
        $(enlace).fadeIn(1000); //para mostrar la etiqueta a (conferencia, seminario o taller con un efecto)
        return false; //para que no se mueva la pagina al presionar una opcion

    });


//animaciones para los numeros

$('.resumen-evento li:nth-child(1) p').animateNumber({number:6},1200);
$('.resumen-evento li:nth-child(2) p').animateNumber({number:15},1200);
$('.resumen-evento li:nth-child(3) p').animateNumber({number:3},1500);
$('.resumen-evento li:nth-child(4) p').animateNumber({number:9},1500);


//cuenta regresiva
$('.cuenta-regresiva').countdown('2019/06/07 09:00:00',function(event){
$('#dias').html(event.strftime('%D'));
$('#horas').html(event.strftime('%H'));
$('#minutos').html(event.strftime('%M'));
$('#segundos').html(event.strftime('%S'));
});

//colorbox para mostrar descripcion de los invitados en la seccion Invitados

$(".invitado-info").colorbox({inline:true,width:"50%"});
$(".boton_newsletter").colorbox({inline:true,width:"50%"});

});










