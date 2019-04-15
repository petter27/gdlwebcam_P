<?php 

function productos_json(&$boletos, &$camisas=0, &$etiquetas=0){
    $dias=array(
        0=>'un_dia',
        1=>'pase_completo',
        2=>'pase_2dias'
    );

    $total_boletos=array_combine($dias,$boletos);
    $json=array();

    foreach($total_boletos as $key=>$boletos){
        if((int) $boletos>0){
            $json[$key]=(int) $boletos;
        }
    }

$camisas=(int)$camisas;

if($camisas>0){
    $json['camisas']=$camisas;
}

$etiquetas=(int) $etiquetas;

if($etiquetas>0){
    $json['etiquetas']=$etiquetas;
}

    return json_encode($json);
}


function eventos_json(&$eventos){

    $eventos_json=array();

    foreach ($eventos as $evento){
        $eventos_json["eventos"][]=$evento;
    }

    return json_encode($eventos_json);
}

function formatear_pedido($articulos){
    $articulos=json_decode($articulos, true);
    $pedido="";
    if(array_key_exists('un_dia', $articulos)){
        $pedido .= 'Pase(s) un día: ' . $articulos['un_dia'] . "<br/>";
    }
    if(array_key_exists('pase_2dias', $articulos)){
        $pedido .= 'Pase(s) 2 días: ' . $articulos['pase_2dias'] . "<br/>";
    }
    if(array_key_exists('pase_completo', $articulos)){
        $pedido .= 'Pase(s) completo: ' . $articulos['pase_completo'] . "<br/>";
    }
    if(array_key_exists('camisas', $articulos)){
        $pedido .= 'Camisas: ' . $articulos['camisas'] . "<br/>";
    }
    if(array_key_exists('etiquetas', $articulos)){
        $pedido .= 'Etiquetas: ' . $articulos['etiquetas'] . "<br/>";
    }
    return $pedido;
}

function formatear_eventos_a_sql($eventos){
    $eventos=json_decode($eventos,true);
    $sql="SELECT nombre_evento FROM eventos WHERE clave='a'";
    foreach($eventos['eventos'] as $evento){
        $sql .= " OR clave='{$evento}'";
    }
    return $sql;
}

function usuario_autenticado(){
    if(!revisar_usuario()){
        header("Location:login.php");
    }
}

function revisar_usuario(){
    return isset($_SESSION["usuario"]);
}


?>