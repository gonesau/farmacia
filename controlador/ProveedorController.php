<?php
include '../modelo/Proveedor.php';
$proveedor = new Proveedor();
if ($_POST['funcion'] == 'crear') {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $avatar = 'proveedor.png';

    $proveedor->crear($nombre, $telefono, $correo, $direccion, $avatar);
}

if ($_POST['funcion'] == 'buscar') {
    $proveedor->buscar();
    $json = array();
    foreach($proveedor->objetos as $objeto){
        $json[] = array(
            'id' => $objeto->id_proveedor,
            'nombre' => $objeto->nombre,
            'telefono' => $objeto->telefono,
            'correo' => $objeto->correo,
            'direccion' => $objeto->direccion,
            'avatar' => '../img/prov/'.$objeto->avatar
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}