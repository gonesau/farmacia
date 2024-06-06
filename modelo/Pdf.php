<?php
include_once 'Venta.php';
include_once 'VentaProducto.php';

function getHTML($id_venta)
{
    $venta = new Venta();
    $venta_producto = new VentaProducto();

    $venta->buscar_id($id_venta);
    $venta_producto->ver($id_venta);

    $plantilla = '
    <body>
        <header class="clearfix">
            <div id="logo">
                <img src="../img/logo.png" width="60" height="60">
            </div>
            <h1>Comprobante de pago</h1>
            <div id="company" class="clearfix">
                <div id="negocio">Farmanet</div>
                <div>Direccion Numero ###, <br> Ciudad, San Salvador</div>
                <div>(305)</div>
                <div><a href="mailto:company@example.com">Company@example.com</a></div>
            </div>';
    foreach ($venta->objetos as $objeto) {
        $plantilla .= '
            <div id="project">
                <div><span>Codigo de venta: </span>' . $objeto->id_venta . '</div>
                <div><span>Cliente: </span>' . $objeto->cliente . '</div>
                <div><span>DUI: </span>' . $objeto->dui . '</div>
                <div><span>Fecha y Hora: </span>' . $objeto->fecha . '</div>
                <div><span>Vendedor: </span>' . $objeto->vendedor . '</div>
            </div>
            ';
    }
    $plantilla .= '
        </header>
        <main>
            <table>
                <thead>
                    <tr>
                        <th class="service">Producto</th>
                        <th class="service">Concentracion</th>
                        <th class="service">Adicional</th>
                        <th class="service">Laboratorio</th>
                        <th class="service">Presentacion</th>
                        <th class="service">Tipo</th>
                        <th class="service">Cantidad</th>
                        <th class="service">Precio</th>
                        <th class="service">Subtotal</th>
                    </tr>
                </thead>
                <tbody>';
    foreach ($venta_producto->objetos as $objeto) {
        $plantilla .= '
                    <tr>
                        <td class="servic">' . $objeto->producto . '</td>
                        <td class="servic">' . $objeto->concentracion . '</td>
                        <td class="servic">' . $objeto->adicional . '</td>
                        <td class="servic">' . $objeto->laboratorio . '</td>
                        <td class="servic">' . $objeto->presentacion . '</td>
                        <td class="servic">' . $objeto->tipo . '</td>
                        <td class="servic">' . $objeto->cantidad . '</td>
                        <td class="servic">' . $objeto->precio . '</td>
                        <td class="servic">' . $objeto->subtotal . '</td>
                    </tr>
        ';
    }
    $calculos = new Venta();
    $calculos->buscar_id($id_venta);
    foreach ($calculos->objetos as $objeto) {
        $iva = $objeto->total * 0.13;
        $sub = $objeto->total - $iva;

        $plantilla .= '
                    <tr>
                        <td colspan="8" class="grand total">SUBTOTAL</td>
                        <td class="grand total">S/.' . $sub . '</td>
                        </tr>
                    <tr>
                        <td colspan="8" class="grand total">IVA(13%)</td>
                        <td class="grand total">S/.' . $iva . '</td>
                    </tr>
                    <tr>
                        <td colspan="8" class="grand total">TOTAL</td>
                        <td class="grand total">S/.' . $objeto->total . '</td>
                    </tr>
        ';
    }
    $plantilla .= '
                </tbody>
            </table>
            <div id="notices">
                <div>NOTICE:</div>
                <div class="notice">*PRESENTAR ESTE COMPROBANTE DE PAGO PARA CUALQUIER RECLAMO O DEVOLUCION.</div>
                <div class="notice">*EL RECLAMO PROCEDERÁ DENTRO DE LAS 24 HORAS DE HABER HECHO LA COMPRA.</div>
                <div class="notice">*SI EL PRODUCTO ESTA DAÑADO O ABIERTO, LA DEVOLUCIÓN NO PROCEDERÁ</div>
                <div class="notice">*REVISE SU CAMBIO ANTES DE SALIR DEL ESTABLECIMIENTO.</div>
            </div>
        </main>
        <footer>
        Creado por equipo de desarrollo Farmanet
        </footer>
    </body>
    ';


    return $plantilla;
}
