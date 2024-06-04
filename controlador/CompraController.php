<?php
include '../modelo/Venta.php';
include_once '../modelo/conexion.php';
$venta = new Venta();
session_start();
$vendedor = $_SESSION['usuario'];
if ($_POST['funcion'] == 'registrar_compra') {
    $total = $_POST['total'];
    $nombre = $_POST['nombre'];
    $dui = $_POST['dui'];
    $productos = json_decode($_POST['json']);
    date_default_timezone_set('America/El_Salvador');
    $fecha = date('Y-m-d H:i:s');
    // print_r($productos);
    $venta->Crear($nombre, $dui, $total, $fecha, $vendedor);
    $venta->ultima_venta();
    foreach ($venta->objetos as $objeto) {
        $id_venta = $objeto->ultima_venta;
        echo $id_venta;
    }
    try {
        $db = new Conexion();
        $conexion = $db->pdo;
        $conexion->beginTransaction();
        foreach ($productos as $prod) {
            $cantidad = $prod->cantidad;
            while ($cantidad != 0) {
                $sql = "SELECT * FROM lote WHERE vencimiento = (SELECT MIN(vencimiento) FROM lote WHERE lote_id_prod=:id) AND lote_id_prod=:id";
                $query = $conexion->prepare($sql);
                $query->execute(array(':id' => $prod->id));
                $lote = $query->fetchall();
                foreach ($lote as $lote) {
                    if ($cantidad < $lote->stock) {
                        $sql = "INSERT INTO detalle_venta(det_cantidad, det_vencimiento,id_detalle_lote, id_det_prod, lote_id_prov, id_det_venta) 
                            VALUES 
                            ('$cantidad','$lote->vencimiento','$lote->id_lote','$prod->id', '$lote->lote_id_prov', '$id_venta')";
                        $conexion->exec($sql);
                        $conexion->exec("UPDATE lote SET stock = stock-'$cantidad' WHERE id_lote='$lote->id_lote'");
                        $cantidad = 0;
                    }
                    if ($cantidad == $lote->stock) {
                        $sql = "INSERT INTO detalle_venta(det_cantidad, det_vencimiento,id_detalle_lote, id_det_prod, lote_id_prov, id_det_venta) 
                            VALUES 
                            ('$cantidad','$lote->vencimiento','$lote->id_lote','$prod->id', '$lote->lote_id_prov', '$id_venta')";
                        $conexion->exec($sql);
                        $conexion->exec("DELETE FROM lote WHERE id_lote='$lote->id_lote'");
                        $cantidad = 0;
                    }
                    if ($cantidad > $lote->stock) {
                        $sql = "INSERT INTO detalle_venta(det_cantidad, det_vencimiento,id_detalle_lote, id_det_prod, lote_id_prov, id_det_venta) 
                            VALUES 
                            ('$lote->stock','$lote->vencimiento','$lote->id_lote','$prod->id', '$lote->lote_id_prov', '$id_venta')";
                        $conexion->exec($sql);
                        $conexion->exec("DELETE FROM lote WHERE id_lote='$lote->id_lote'");
                        $cantidad = $cantidad - $lote->stock;
                    }
                }
            }
            $subtotal = $prod->cantidad * $prod->precio;
            $conexion->exec("INSERT INTO venta_producto(cantidad, subtotal, 
                producto_id_producto, venta_id_venta) 
                values ('$prod->cantidad', '$subtotal', '$prod->id', '$id_venta')");
        }
        $conexion->commit();

    } catch (Exception $error) {
        $conexion->rollBack();
        $venta->borrar($id_venta);
        echo $error->getMessage();
    }
}