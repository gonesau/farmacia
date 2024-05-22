<?php
include '../modelo/Laboratorio.php';
$laboratorio = new Laboratorio();
if($_POST['funcion'] == 'crear'){
    $nombre = $_POST['nombre_laboratorio'];
    $avatar = 'lab.png';
    $laboratorio->crear($nombre, $avatar);
}
?>