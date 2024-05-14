<?php
include_once '../modelo/usuario.php';
$usuario = new usuario();
if($_POST(['funcion'])=='buscar_usuario'){
    $json = array();
    $usuario->obtener_datos($_POST['dato']);
    foreach($usuario->objetos as $objeto){
        $json[] = array(
            'nombre'=>$objeto->nombre_us,
            'apellido'=>$objeto->apellido_us,
            'edad'=>$objeto->edad_us,
            'dui'=>$objeto->dui_us,
            'tipo'=>$objeto->nombre_tipo,
            'telefono'=>$objeto->telefono_us,
            'residencia'=>$objeto->residencia_us,
            'correo'=>$objeto->correo_us,
            'sexo'=>$objeto->sexo_us,
            'adicional'=>$objeto->adicional_us
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
?>