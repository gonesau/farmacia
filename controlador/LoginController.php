<?php
include_once '../modelo/usuario.php';
session_start();
$user = $_POST['user'];
$pass = $_POST['pass'];
$usuario = new usuario();
$usuario->Loguearse($user, $pass);
foreach($usuario->objetos as $objeto){
    print_r($objeto);
}
?>