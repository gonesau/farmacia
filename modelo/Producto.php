<?php
include_once ("conexion.php");
class Producto
{
    var $objetos;
    public function __construct()
    {
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    function crear($nombre, $concentracion, $adicional, $precio, $laboratorio, $tipo, $presentacion, $avatar)
    {
        $sql = "SELECT id_producto FROM producto WHERE nombre =:nombre and concentracion=:concentracion and adicional=:adicional and prod_lab=:laboratorio and prod_tip=:tipo and prod_pre=:presentacion";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nombre' => $nombre, ':concentracion' => $concentracion, ':adicional' => $adicional, ':laboratorio' => $laboratorio, ':tipo' => $tipo, ':presentacion' => $presentacion));
        $this->objetos = $query->fetchAll();
        if (!empty($this->objetos)) {
            echo 'noadd';
        } else {
            $sql = "INSERT INTO producto(nombre, concentracion, adicional, precio, prod_lab, prod_tip, prod_pre, avatar) VALUES(:nombre, :concentracion, :adicional, :precio, :laboratorio, :tipo, :presentacion, :avatar)";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':nombre' => $nombre, ':concentracion' => $concentracion, ':adicional' => $adicional, ':laboratorio' => $laboratorio, ':tipo' => $tipo, ':presentacion' => $presentacion, ':precio' => $precio, ':avatar' => $avatar));
            echo 'add';
        }
    }

    // Producto.php
    function editar($id, $nombre, $concentracion, $adicional, $precio, $laboratorio, $tipo, $presentacion)
    {
        $sql = "SELECT id_producto FROM producto WHERE id_producto!=:id and nombre =:nombre and concentracion=:concentracion and adicional=:adicional and prod_lab=:laboratorio and prod_tip=:tipo and prod_pre=:presentacion";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id, ':nombre' => $nombre, ':concentracion' => $concentracion, ':adicional' => $adicional, ':laboratorio' => $laboratorio, ':tipo' => $tipo, ':presentacion' => $presentacion));
        $this->objetos = $query->fetchAll();
        if (!empty($this->objetos)) {
            echo 'noedit';
        } else {
            $sql = "UPDATE producto SET nombre=:nombre, concentracion=:concentracion, adicional=:adicional, precio=:precio, prod_lab=:laboratorio, prod_tip=:tipo, prod_pre=:presentacion WHERE id_producto=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':nombre' => $nombre, ':concentracion' => $concentracion, ':adicional' => $adicional, ':laboratorio' => $laboratorio, ':tipo' => $tipo, ':presentacion' => $presentacion, ':precio' => $precio, ':id' => $id));
            echo 'edit';
        }
    }



    function buscar()
    {
        if (!empty($_POST['consulta'])) {
            $consulta = $_POST['consulta'];
            $sql = "SELECT id_producto, producto.nombre as nombre, concentracion, adicional, precio, laboratorio.nombre as laboratorio, tipo_producto.nombre as tipo, presentacion.nombre as presentacion, producto.avatar, prod_lab, prod_tip, prod_pre
            FROM producto
            JOIN laboratorio on prod_lab=id_laboratorio
            JOIN tipo_producto on prod_tip=id_tipo_prod
            JOIN presentacion on prod_pre=id_presentacion and producto.nombre LIKE :consulta LIMIT 25;";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta' => "%$consulta%"));
            $this->objetos = $query->fetchAll(PDO::FETCH_ASSOC);
            return $this->objetos;
        } else {
            $sql = "SELECT id_producto, producto.nombre as nombre, concentracion, adicional, precio, laboratorio.nombre as laboratorio, tipo_producto.nombre as tipo, presentacion.nombre as presentacion, producto.avatar, prod_lab, prod_tip, prod_pre
            FROM producto
            JOIN laboratorio on prod_lab=id_laboratorio
            JOIN tipo_producto on prod_tip=id_tipo_prod
            JOIN presentacion on prod_pre=id_presentacion and producto.nombre NOT LIKE '' ORDER BY producto.nombre LIMIT 25";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchAll(PDO::FETCH_ASSOC);
            return $this->objetos;
        }
    }

    function cambiar_logo($id, $nombre)
    {
        $sql = "UPDATE producto SET avatar=:nombre WHERE id_producto=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nombre' => $nombre, ':id' => $id));
    }

    function borrar($id)
    { 
        $sql = "DELETE FROM producto WHERE id_producto=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        if(!empty($query->execute(array(':id' => $id)))){
            echo 'borrado';
        }
        else{
            echo 'noborrado';
        }
    }

    function obtener_stock($id)
    {
        $sql = "SELECT SUM(stock) as total FROM lote WHERE lote_id_prod=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }

}