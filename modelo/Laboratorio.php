<?php
include_once("conexion.php");
class Laboratorio{
    var $objetos;
    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    function crear($nombre, $avatar){
        $sql = "SELECT id_laboratorio FROM laboratorio WHERE nombre = :nombre";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nombre' => $nombre));
        $this->objetos = $query->fetchAll();
        if(!empty($this->objetos)){
            echo "noadd";
        }else{
            $sql = "INSERT INTO laboratorio(nombre, avatar) VALUES(:nombre, :avatar)";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':nombre' => $nombre, ':avatar' => $avatar));
            echo "add";
        }
    }

}
?>