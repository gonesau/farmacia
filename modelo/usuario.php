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

    function obtener_datos($id){
        $sql = "SELECT * FROM usuario join tipo_us on us_tipo=id_tipo_us and id_usuario=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }
    
    function editar($id_usuario, $telefono, $residencia, $correo, $sexo, $adicional){
        $sql = "UPDATE usuario SET telefono_us=:telefono, residencia_us=:residencia, correo_us=:correo, sexo_us=:sexo, adicional_us=:adicional WHERE id_usuario=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_usuario, ':telefono'=>$telefono, ':residencia'=>$residencia, ':correo'=>$correo, ':sexo'=>$sexo, ':adicional'=>$adicional));
    }
}
?>