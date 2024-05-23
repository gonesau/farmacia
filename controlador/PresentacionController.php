<?php
include '../modelo/Presentacion.php';
$presentacion = new Presentacion();
if($_POST['funcion'] == 'crear'){
    $nombre = $_POST['nombre_pre'];
    $presentacion->crear($nombre);
}

if($_POST['funcion'] == 'editar'){
    $nombre = $_POST['nombre_pre'];
    $id_editado = $_POST['id_editado'];
    $presentacion->editar($nombre, $id_editado);
}

if($_POST['funcion'] == 'buscar'){
    $presentacion->buscar();
    $json = array();
    foreach($presentacion->objetos as $objeto){
        $json[] = array(
            'id' => $objeto['id_presentacion'],
            'nombre' => $objeto['nombre'],
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}


if($_POST['funcion'] == 'borrar'){
    $id = $_POST['id'];
    $presentacion->borrar($id);
}

?>