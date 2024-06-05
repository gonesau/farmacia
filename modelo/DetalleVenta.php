<?php
include_once 'Conexion.php';
class DetalleVenta
{
    var $objetos;
    public function __construct()
    {
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    function ver($id)
    {
        $sql = "SELECT precio, cantidad, producto.nombre as producto, concentracion, adicional, 
        laboratorio.nombre as laboratorio, presentacion.nombre as presentacion,
        tipo_producto.nombre as tipo, subtotal
        FROM venta_producto
        JOIN producto on producto_id_producto = id_producto and venta_id_venta=:id
        JOIN laboratorio on prod_lab = id_laboratorio
        JOIN tipo_producto on prod_tip = id_tipo_prod
        JOIN presentacion on prod_pre = id_presentacion";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function recuperar($id_venta)
    {
        $sql = "SELECT * FROM detalle_venta WHERE id_det_venta=:id_venta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_venta' => $id_venta));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function borrar($id_detalleventa)
    {
        $sql = "DELETE FROM detalle_venta WHERE id_detalleventa=:id_detalleventa";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_detalleventa' => $id_detalleventa));
    }
}