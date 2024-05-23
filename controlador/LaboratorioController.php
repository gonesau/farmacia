<?php
include '../modelo/Laboratorio.php';
$laboratorio = new Laboratorio();
if($_POST['funcion'] == 'crear'){
    $nombre = $_POST['nombre_laboratorio'];
    $avatar = 'lab.png';
    $laboratorio->crear($nombre, $avatar);
}

if($_POST['funcion'] == 'buscar'){
    $laboratorio->buscar();
    $json = array();
    foreach($laboratorio->objetos as $objeto){
        $json[] = array(
            'id' => $objeto['id_laboratorio'],
            'nombre' => $objeto['nombre'],
            'avatar' => '../img/'.$objeto['avatar']
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

?>