<?php
include_once '../modelo/usuario.php';
$usuario = new usuario();
session_start();
$id_usuario = $_SESSION['usuario'];

if ($_POST['funcion'] == 'buscar_usuario') {
    $json = array();
    $fecha_actual = new DateTime();
    $usuario->obtener_datos($_POST['dato']);
    
    if (!empty($usuario->objetos)) { // Verificar si hay resultados
        foreach ($usuario->objetos as $objeto) {
            $nacimiento = new DateTime($objeto->edad);
            $edad = $nacimiento->diff($fecha_actual);
            $edad_years = $edad->y;
            $json[] = array(
                'nombre' => $objeto->nombre_us,
                'apellidos' => $objeto->apellidos_us,
                'edad' => $edad_years,
                'dui' => $objeto->dui_us,
                'tipo' => $objeto->nombre_tipo,
                'telefono' => $objeto->telefono_us,
                'residencia' => $objeto->residencia_us,
                'correo' => $objeto->correo_us,
                'sexo' => $objeto->sexo_us,
                'adicional' => $objeto->adicional_us,
                'avatar' => '../img/' . $objeto->avatar,
                'name' => $objeto->nombre_us,
                'apell' => $objeto->apellidos_us
            );
        }
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
    } else {
        echo json_encode(array()); // Devolver un array vacío si no hay resultados
    }
}

if ($_POST['funcion'] == 'obtenerNombreUsuario') {
    $json = array();
    $usuario->obtener_datos($id_usuario);
    foreach ($usuario->objetos as $objeto) {
        $json[] = array(
            'nombre' => $objeto->nombre_us,
            'apellidos' => $objeto->apellidos_us
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

if($_POST['funcion']=='capturar_datos'){
    $json = array();
    $id_usuario = $_POST['id_usuario'];
    $usuario->obtener_datos($id_usuario);
    foreach($usuario->objetos as $objeto){
        $json[] = array(
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

if($_POST['funcion']=='editar_usuario'){
    $id_usuario = $_POST['id_usuario'];
    $telefono = $_POST['telefono'];
    $residencia = $_POST['residencia'];
    $correo = $_POST['correo'];
    $sexo = $_POST['sexo'];
    $adicional = $_POST['adicional'];
    $usuario->editar($id_usuario, $telefono, $residencia, $correo, $sexo, $adicional);
    echo 'editado';
}

if($_POST['funcion']=='cambiar_contra'){
    $id_usuario = $_POST['id_usuario'];
    $oldpass = $_POST['oldpass'];
    $newpass = $_POST['newpass'];
    $usuario->cambiar_contra($id_usuario, $oldpass, $newpass);
}

if($_POST['funcion']=='cambiar_foto'){
    if($_FILES['foto']['type']=='image/jpeg' || $_FILES['foto']['type']=='image/png' || $_FILES['foto']['type']=='image/jpg'){
        $nombre = uniqid().'-'.$_FILES['foto']['name'];
        $ruta = '../img/'.$nombre;
        move_uploaded_file($_FILES['foto']['tmp_name'], $ruta);   
        $usuario->cambiar_foto($id_usuario, $nombre);
        foreach($usuario->objetos as $objeto){
            unlink('../img/'.$objeto->avatar);
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


if($_POST['funcion']=='buscar_usuario_adm'){
    $json = array();
    $fecha_actual = new DateTime();
    $usuario->buscar();
    foreach($usuario->objetos as $objeto){
        $nacimiento = new DateTime($objeto->edad);
        $edad = $nacimiento->diff($fecha_actual);
        $edad_years = $edad->y;
        $json[] = array(
            'id'=>$objeto->id_usuario,
            'nombre'=>$objeto->nombre_us,
            'apellidos'=>$objeto->apellidos_us,
            'edad'=>$edad_years,
            'dui'=>$objeto->dui_us,
            'tipo'=>$objeto->nombre_tipo,
            'telefono'=>$objeto->telefono_us,
            'residencia'=>$objeto->residencia_us,
            'correo'=>$objeto->correo_us,
            'sexo'=>$objeto->sexo_us,
            'adicional'=>$objeto->adicional_us,
            'avatar'=>'../img/'.$objeto->avatar,
            'tipo_de_usuario'=>$objeto->us_tipo
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}



if($_POST['funcion']=='crear_usuario'){
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $edad = $_POST['edad'];
    $dui = $_POST['dui'];
    $pass = $_POST['pass'];
    $tipo = 2;
    $avatar = 'avatar.png';

    // Añadir registros para depuración
    error_log("Datos recibidos: nombre=$nombre, apellido=$apellido, edad=$edad, dui=$dui, pass=$pass");

    $usuario->crear($nombre, $apellido, $edad, $dui, $pass, $tipo, $avatar);
}

if ($_POST['funcion'] == 'ascender') {
    $pass = $_POST['pass'];
    $id_ascendido = $_POST['id_usuario'];
    error_log("Ascender (controlador): pass=$pass, id_ascendido=$id_ascendido");
    $usuario->ascender($pass, $id_ascendido, $id_usuario);
}

if ($_POST['funcion'] == 'descender') {
    $pass = $_POST['pass'];
    $id_desecendido = $_POST['id_usuario'];
    error_log("Descender (controlador): pass=$pass, id_desecendido=$id_desecendido");
    $usuario->descender($pass, $id_desecendido, $id_usuario);
}

if ($_POST['funcion'] == 'borrar_usuario') {
    $pass = $_POST['pass'];
    $id_borrado = $_POST['id_usuario'];
    error_log("Eliminar (controlador): pass=$pass, id_eliminado=$id_borrado");
    $usuario->borrar($pass, $id_borrado, $id_usuario);
}


?>