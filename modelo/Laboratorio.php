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

    function cambiar_logo($id, $nombre)
    {
        $sql = "SELECT avatar FROM laboratorio WHERE id_laboratorio=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchAll(PDO::FETCH_ASSOC); 

            $sql = "UPDATE laboratorio SET avatar=:nombre WHERE id_laboratorio=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id' => $id, ':nombre' => $nombre));

        return $this->objetos;
    }
    
}
?>