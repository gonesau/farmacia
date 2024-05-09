<?php
include_once 'conexion.php';
class usuario{
    var $objetos;
    public function __construct(){
        $db = new conexion();
        $this->acceso = $db->pdo;
    }

    function Loguearse($dui, $pass){
        $sql = "SELECT * FROM usuario inner join tipo_us on us_tipo=id_tipo_us where dui_us =:dui and password_us =:pass";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':dui'=>$dui, ':pass'=>$pass));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

}
?>