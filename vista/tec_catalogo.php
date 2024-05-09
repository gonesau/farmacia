<?php
session_start();
if($_SESSION['us_tipo'] == 2){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Técnicor</title>
</head>
<body>
    <h1>Hola Técnico</h1>
    <a href="../controlador/LogOut.php">Cerrar Sesión</a>
</body>
</html>
<?php
}
else{
    header('Location: ../vista/login.php');
}
?>