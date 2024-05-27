<?php
include '../modelo/Laboratorio.php';
$laboratorio = new Laboratorio();
if($_POST['funcion'] == 'crear'){
    $nombre = $_POST['nombre_laboratorio'];
    $avatar = 'lab.png';
    $laboratorio->crear($nombre, $avatar);
}

if($_POST['funcion'] == 'editar'){
    $nombre = $_POST['nombre_laboratorio'];
    $id_editado = $_POST['id_editado'];
    $laboratorio->editar($nombre, $id_editado);
}

if($_POST['funcion'] == 'buscar'){
    $laboratorio->buscar();
    $json = array();
    foreach($laboratorio->objetos as $objeto){
        $json[] = array(
            'id' => $objeto['id_laboratorio'],
            'nombre' => $objeto['nombre'],
            'avatar' => '../img/lab/'.$objeto['avatar']
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}


if($_POST['funcion'] == 'cambiar_logo'){
    $id = $_POST['id_logo_lab'];
    if($_FILES['foto']['type']=='image/jpeg' || $_FILES['foto']['type']=='image/png' || $_FILES['foto']['type']=='image/jpg'){
        $nombre = uniqid().'-'.$_FILES['foto']['name'];
        $ruta = '../img/lab/'.$nombre;
        move_uploaded_file($_FILES['foto']['tmp_name'], $ruta);   
        $laboratorio->cambiar_logo($id, $nombre);
        foreach($laboratorio->objetos as $objeto){
            if($objeto['avatar'] != 'lab.png'){
                unlink('../img/lab/'.$objeto['avatar']);
            }
        }
        $json = array();
        $json[] = array(
            'ruta'=>$ruta,
            'alert'=>'edit'
        );
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
    }
    else{
        $json = array();
        $json[] = array(
            'alert'=>'noedit'
        );
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
    }
}

if($_POST['funcion'] == 'borrar'){
    $id = $_POST['id'];
    $laboratorio->borrar($id);
}
if($_POST['funcion'] == 'rellenar_laboratorios'){
    $laboratorio->rellenar_laboratorios();
    $json = array();
    foreach ($laboratorio->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_laboratorio,
            'nombre'=>$objeto->nombre
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}

?>