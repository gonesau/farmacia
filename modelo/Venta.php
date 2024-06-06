<?php
include_once 'Conexion.php';
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
        $sql = "DELETE FROM venta WHERE id_venta=:id_venta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_venta' => $id_venta));
        echo 'delete';
    }

    function buscar()
    {
        $sql = "SELECT id_venta, fecha, cliente, dui, total, CONCAT(usuario.nombre_us, ' ', usuario.apellidos_us) as vendedor FROM venta join usuario on vendedor=id_usuario";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function verificar($id_venta, $id_usuario)
    {
        $sql = "SELECT * FROM venta WHERE vendedor=:id_usuario and id_venta=:id_venta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_usuario' => $id_usuario, ':id_venta' => $id_venta));
        $this->objetos = $query->fetchall();
        if (!empty($this->objetos)) {
            return 1;
        } else {
            return 0;
        }
    }

    function recuperar_vendedor($id_venta)
    {
        $sql = "SELECT us_tipo FROM venta JOIN usuario on id_usuario=vendedor WHERE id_venta=:id_venta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_venta' => $id_venta));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function buscar_id($id_venta)
    {
        $sql = "SELECT id_venta, fecha, cliente, dui, total, CONCAT(usuario.nombre_us, ' ', usuario.apellidos_us) 
        as vendedor FROM venta join usuario on vendedor=id_usuario
        and id_venta=:id_venta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_venta' => $id_venta));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

}