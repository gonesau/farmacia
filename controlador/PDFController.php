<?php
require_once ('../vendor/autoload.php');
require_once ('../modelo/Pdf.php');

$id_venta = $_POST['id'];
$html = getHTML($id_venta);
$css = file_get_contents("../css/pdf.css");

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

$mpdf->Output("../pdf/pdf-" . $id_venta . ".pdf", "F");

?>