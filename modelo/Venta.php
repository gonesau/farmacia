<?php
include 'Conexion.php';
class Venta
{
    var $objetos;
    public function __construct()
    {
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    function Crear($nombre, $dui, $total, $fecha, $vendedor)
    {
        $sql = "INSERT INTO venta(fecha, cliente, dui, total, vendedor) values(:fecha, :cliente, :dui, :total, :vendedor)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':fecha' => $fecha, ':cliente' => $nombre, ':dui' => $dui, ':total' => $total, ':vendedor' => $vendedor));
    }

    function ultima_venta()
    {
        $sql = "SELECT MAX(id_venta) as ultima_venta FROM venta";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function borrar($id_venta)
    {
        $sql = "DELETE FROM venta WHERE id_venta:id_venta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_venta' => $id_venta));
    }
}