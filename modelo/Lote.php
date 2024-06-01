<?php
include_once ("conexion.php");
class Lote
{
    var $objetos;
    public function __construct()
    {
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    function crear($id_producto, $proveedor, $stock, $vencimiento)
    {
        $sql = "INSERT INTO lote(stock, vencimiento, lote_id_prod, lote_id_prov) VALUES(:stock, :vencimiento, :id_producto, :proveedor);";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':stock' => $stock, ':vencimiento' => $vencimiento, ':id_producto' => $id_producto, ':proveedor' => $proveedor));
        echo "add";
    }

    function buscar()
    {
        if (!empty($_POST['consulta'])) {
            $consulta = $_POST['consulta'];
            $sql = "SELECT id_lote, stock, vencimiento, concentracion, adicional, producto.nombre as prod_nom, laboratorio.nombre as lab_nom, tipo_producto.nombre as tipo_nom, 
            presentacion.nombre as pre_nom, proveedor.nombre as proveedor, producto.avatar as logo FROM `lote` 
            JOIN proveedor on lote_id_prov=id_proveedor
            JOIN producto on lote_id_prod=id_producto
            JOIN laboratorio on prod_lab=id_laboratorio
            JOIN tipo_producto on prod_tip=id_tipo_prod
            JOIN presentacion on prod_pre=id_presentacion
            WHERE producto.nombre LIKE :consulta ORDER BY producto.nombre LIMIT 25;";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta' => "%$consulta%"));
            $this->objetos = $query->fetchAll(PDO::FETCH_ASSOC);
            error_log(print_r($this->objetos, true)); // Añadir esta línea para ver los datos en el log de errores
            return $this->objetos;
        } else {
            $sql = "SELECT id_lote, stock, vencimiento, concentracion, adicional, producto.nombre as prod_nom, laboratorio.nombre as lab_nom, tipo_producto.nombre as tipo_nom, 
            presentacion.nombre as pre_nom, proveedor.nombre as proveedor, producto.avatar as logo FROM `lote` 
            JOIN proveedor on lote_id_prov=id_proveedor
            JOIN producto on lote_id_prod=id_producto
            JOIN laboratorio on prod_lab=id_laboratorio
            JOIN tipo_producto on prod_tip=id_tipo_prod
            JOIN presentacion on prod_pre=id_presentacion
            WHERE producto.nombre not LIKE '' ORDER BY producto.nombre LIMIT 25;";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchAll(PDO::FETCH_ASSOC);
            error_log(print_r($this->objetos, true)); // Añadir esta línea para ver los datos en el log de errores
            return $this->objetos;
        }
    }
    
}
?>