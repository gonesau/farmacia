<?php
require_once ('../vendor/autoload.php');

$id_venta = $_POST['id'];
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML('<h1>Hello world!</h1>');

$mpdf->Output("../pdf/pdf-" . $id_venta . ".pdf", "F");

?>