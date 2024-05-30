<?php
include_once("conexion.php");
class Producto{
    var $objetos;
    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    function crear($nombre, $concentracion, $adicional, $precio, $laboratorio, $tipo, $presentacion, $avatar){
        $sql = "SELECT id_producto FROM producto WHERE nombre =:nombre and concentracion=:concentracion and adicional=:adicional and prod_lab=:laboratorio and prod_tip=:tipo and prod_pre=:presentacion";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nombre' => $nombre,':concentracion' => $concentracion,':adicional' => $adicional, ':laboratorio' => $laboratorio, ':tipo' => $tipo, ':presentacion' => $presentacion));
        $this->objetos = $query->fetchAll();
        if(!empty($this->objetos)){
            echo 'noadd';
        }else{
            $sql = "INSERT INTO producto(nombre, concentracion, adicional, precio, prod_lab, prod_tip, prod_pre, avatar) VALUES(:nombre, :concentracion, :adicional, :precio, :laboratorio, :tipo, :presentacion, :avatar)";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':nombre' => $nombre,':concentracion' => $concentracion,':adicional' => $adicional, ':laboratorio' => $laboratorio, ':tipo' => $tipo, ':presentacion' => $presentacion, ':precio' => $precio, ':avatar' => $avatar));
            echo 'add';
        }
    }

    function buscar(){
        if(!empty($_POST['consulta'])){
            $consulta = $_POST['consulta'];
            $sql = "SELECT * FROM laboratorio WHERE nombre LIKE :consulta";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta' => "%$consulta%"));
            $this->objetos = $query->fetchAll(PDO::FETCH_ASSOC); 
            return $this->objetos;
        }
        else{
            $sql = "SELECT * FROM laboratorio where nombre NOT LIKE '' ORDER BY id_laboratorio DESC LIMIT 25";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchAll(PDO::FETCH_ASSOC); 
            return $this->objetos;
        }
    }
}
?>