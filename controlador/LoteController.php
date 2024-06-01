<?php
include '../modelo/Lote.php';
$lote = new Lote();

if ($_POST['funcion'] == 'crear_lote') {
    $id_producto = $_POST['id_producto'];
    $proveedor = $_POST['proveedor'];
    $stock = $_POST['stock'];
    $vencimiento = $_POST['vencimiento'];

    $lote->crear($id_producto, $proveedor, $stock, $vencimiento);
}

if ($_POST['funcion'] == 'buscar') {
    $lote->buscar();
    $json = array();
    $fecha_actual = new DateTime();
    foreach ($lote->objetos as $objeto) {
        // Forma correcta de usar DateTime
        // Se obtiene un error de esta forma
        // $vencimiento = new DateTime(($objeto->vencimiento));
        // El error es que en json[] no se logra convertir
        // fecha_vencimiento a string
        $fecha_vencimiento = new DateTime($objeto['vencimiento']);
        $diferencia = $fecha_vencimiento->diff($fecha_actual);
        $mes = $diferencia->m + ($diferencia->y * 12);
        $dia = $diferencia->d;
        $verificado = $diferencia->invert;
        if ($verificado == 0) {
            $estado = 'danger';
            $mes = $mes * (-1);
            $dia = $dia * (-1);
        } else {
            if ($mes > 3) {
                $estado = 'light';
            }
            if ($mes <= 3) {
                $estado = 'warning';
            }
        }
        // if ($mes > 3) {
        //     $estado = 'light';
        // } elseif ($mes <= 3) {
        //     $estado = 'warning';
        // } elseif ($mes <= 0 && $dia <= 0) {
        //     $estado = 'danger';
        // }
        $json[] = array(
            'id' => $objeto['id_lote'],
            'nombre' => $objeto['prod_nom'],
            'concentracion' => $objeto['concentracion'],
            'adicional' => $objeto['adicional'],
            'stock' => $objeto['stock'],
            'laboratorio' => $objeto['lab_nom'],
            'tipo' => $objeto['tipo_nom'],
            'presentacion' => $objeto['pre_nom'],
            'proveedor' => $objeto['proveedor'],
            'vencimiento' => $objeto['vencimiento'],
            'logo' => '../img/prod/' . $objeto['logo'],
            'mes' => $mes,
            'dia' => $dia,
            'estado' => $estado,
        );
    }
    error_log(print_r($json, true)); // ver los datos en el log de errores
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

// La funcion post sin agregar el vencimiento funciona correctamente
// al agregar el vencimiento genera un error en Lote.js al renderizar
// El error es: SyntaxError: Unexpected token '<', "<br />
// <b>"... is not valid JSON
// at JSON.parse (<anonymous>)

// if ($_POST['funcion'] == 'buscar') {
//     try {
//         $lote->buscar();
//         $json = array();
//         $fecha_actual = new DateTime();
//         foreach ($lote->objetos as $objeto) {
//             try {
//                 // Validar el formato de la fecha
//                 $vencimiento = DateTime::createFromFormat('Y-m-d', $objeto['vencimiento']);
//                 if ($vencimiento !== false) {
//                     $diferencia = $vencimiento->diff($fecha_actual);
//                     $mes = $diferencia->m + ($diferencia->y * 12); // Incluye años como meses
//                     $dia = $diferencia->d;

//                     if ($mes > 3) {
//                         $estado = 'light';
//                     } elseif ($mes <= 3 && $mes > 0) {
//                         $estado = 'warning';
//                     } elseif ($mes <= 0 && $dia <= 0) {
//                         $estado = 'danger';
//                     }

//                     $json[] = array(
//                         'id' => $objeto['id_lote'],
//                         'nombre' => $objeto['prod_nom'],
//                         'concentracion' => $objeto['concentracion'],
//                         'adicional' => $objeto['adicional'],
//                         'stock' => $objeto['stock'],
//                         'laboratorio' => $objeto['lab_nom'],
//                         'tipo' => $objeto['tipo_nom'],
//                         'presentacion' => $objeto['pre_nom'],
//                         'proveedor' => $objeto['proveedor'],
//                         'vencimiento' => $objeto['vencimiento'],
//                         'logo' => '../img/prod/' . $objeto['logo'],
//                         'mes' => $mes,
//                         'dia' => $dia,
//                         'estado' => $estado,
//                     );
//                 } else {
//                     throw new Exception('Formato de fecha inválido para el lote ID ' . $objeto['id_lote']);
//                 }
//             } catch (Exception $e) {
//                 error_log("Error al procesar el lote ID {$objeto['id_lote']}: " . $e->getMessage());
//                 continue; // Continuar con el siguiente objeto en caso de error
//             }
//         }
//         header('Content-Type: application/json');
//         echo json_encode($json);
//     } catch (Exception $e) {
//         error_log($e->getMessage());
//         header('Content-Type: application/json');
//         echo json_encode(array('error' => 'An error occurred'));
//     }
// }