<?php
include '../modelo/Lote.php';
$lote = new Lote();

if ($_POST['funcion'] == 'crear_lote') {
    $id_producto = $_POST['id_producto'];
    $proveedor = $_POST['proveedor'];
    $stock = $_POST['stock'];
    $vencimiento = $_POST['vencimiento'];

    $lote->crear($id_producto, $proveedor, $stock, $vencimiento);
}

if ($_POST['funcion'] == 'buscar') {
    $lote->buscar();
    $json = array();
    foreach ($lote->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto['id_lote'],
            'nombre' => $objeto['prod_nom'],
            'concentracion' => $objeto['concentracion'],
            'adicional' => $objeto['adicional'],
            'stock' => $objeto['stock'],
            'laboratorio' => $objeto['lab_nom'],
            'tipo' => $objeto['tipo_nom'],
            'presentacion' => $objeto['pre_nom'],
            'proveedor' => $objeto['proveedor'],
            'vencimiento' => $objeto['vencimiento'],
            'logo' => '../img/prod/' . $objeto['logo'],
        );
    }
    error_log(print_r($json, true)); // Añadir esta línea para ver los datos en el log de errores
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

?>

