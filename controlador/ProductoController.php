<?php
include '../modelo/Producto.php';
$producto = new Producto();


if ($_POST['funcion'] == 'crear') {
    $nombre = $_POST['nombre'];
    $concentracion = $_POST['concentracion'];
    $adicional = $_POST['adicional'];
    $precio = $_POST['precio'];
    $laboratorio = $_POST['laboratorio'];
    $tipo = $_POST['tipo'];
    $presentacion = $_POST['presentacion'];
    $avatar = 'prod_default.png';
    $producto->crear($nombre, $concentracion, $adicional, $precio, $laboratorio, $tipo, $presentacion, $avatar);
}


// ProductoController.php
if ($_POST['funcion'] == 'editar') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $concentracion = $_POST['concentracion'];
    $adicional = $_POST['adicional'];
    $precio = $_POST['precio'];
    $laboratorio = $_POST['laboratorio'];
    $tipo = $_POST['tipo'];
    $presentacion = $_POST['presentacion'];
    $producto->editar($id, $nombre, $concentracion, $adicional, $precio, $laboratorio, $tipo, $presentacion);
    // echo 'edit';
}


if ($_POST['funcion'] == 'buscar') {
    $producto->buscar();
    $json = array();
    foreach ($producto->objetos as $objeto) {
        //$producto->objetos contiene arrays
        //se convierte a objetos antes de acceder a sus propiedades:
        if (is_array($objeto)) {
            $objeto = (object) $objeto;
        }

        $producto->obtener_stock($objeto->id_producto);
        foreach ($producto->objetos as $obj) {
            $total = $obj->total;
        }

        $json[] = array(
            'id' => $objeto->id_producto,
            'nombre' => $objeto->nombre,
            'concentracion' => $objeto->concentracion,
            'adicional' => $objeto->adicional,
            'precio' => $objeto->precio,
            'stock' => $total,
            'laboratorio' => $objeto->laboratorio,
            'tipo' => $objeto->tipo,
            'presentacion' => $objeto->presentacion,
            'laboratorio_id' => $objeto->prod_lab,
            'tipo_id' => $objeto->prod_tip,
            'presentacion_id' => $objeto->prod_pre,
            'avatar' => '../img/prod/' . $objeto->avatar,
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'cambiar_avatar') {
    $id = $_POST['id_logo_prod'];
    $avatar = $_POST['avatar'];
    if ($_FILES['foto']['type'] == 'image/jpeg' || $_FILES['foto']['type'] == 'image/png' || $_FILES['foto']['type'] == 'image/jpg') {
        $nombre = uniqid() . '-' . $_FILES['foto']['name'];
        $ruta = '../img/prod/' . $nombre;
        move_uploaded_file($_FILES['foto']['tmp_name'], $ruta);
        $producto->cambiar_logo($id, $nombre);
        if ($avatar != '../img/prod/prod_default.png') {
            unlink($avatar);
        }
        $json = array();
        $json[] = array(
            'ruta' => $ruta,
            'alert' => 'edit'
        );
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
    } else {
        $json = array();
        $json[] = array(
            'alert' => 'noedit'
        );
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
    }
}

if ($_POST['funcion'] == 'borrar') {
    $id = $_POST['id'];
    $producto->borrar($id);
}

if ($_POST['funcion'] == 'buscar_id') {
    $id = $_POST['id_producto'];
    $producto->buscar_id($id);
    $json = array();
    foreach ($producto->objetos as $objeto) {
        if (is_array($objeto)) { //$producto->objetos contiene arrays
            $objeto = (object) $objeto; //se convierte a objetos antes de acceder a sus propiedades:
        }

        $producto->obtener_stock($objeto->id_producto);
        foreach ($producto->objetos as $obj) {
            $total = $obj->total;
        }

        $json[] = array(
            'id' => $objeto->id_producto,
            'nombre' => $objeto->nombre,
            'concentracion' => $objeto->concentracion,
            'adicional' => $objeto->adicional,
            'precio' => $objeto->precio,
            'stock' => $total,
            'laboratorio' => $objeto->laboratorio,
            'tipo' => $objeto->tipo,
            'presentacion' => $objeto->presentacion,
            'laboratorio_id' => $objeto->prod_lab,
            'tipo_id' => $objeto->prod_tip,
            'presentacion_id' => $objeto->prod_pre,
            'avatar' => '../img/prod/' . $objeto->avatar,
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}


?>