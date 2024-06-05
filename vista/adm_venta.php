<?php
session_start();
if ($_SESSION['us_tipo'] == 3 || $_SESSION['us_tipo'] == 1) {
    include_once 'layouts/header.php';
    include_once '../modelo/usuario.php';
    //include_once '../modelo/Producto.php';
    ?>

    <title>Gestión Venta</title>
    <?php
    include_once 'layouts/nav.php';
    $objUsuario = new usuario();
    ?>

    <!-- Modal Detalle de venta-->
    <div class="modal fade" id="vista_venta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title fs-5">Detalle venta</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="codigo_venta">Codigo venta :</label>
                            <span id="codigo_venta"></span>
                        </div>
                        <div class="form-group">
                            <label for="fecha">Fecha:</label>
                            <span id="fecha"></span>
                        </div>
                        <div class="form-group">
                            <label for="cliente">Cliente: </label>
                            <span id="cliente"></span>
                        </div>
                        <div class="form-group">
                            <label for="dui">DUI:</label>
                            <span id="dui"></span>
                        </div>
                        <div class="form-group">
                            <label for="vendedor">Vendedor: </label>
                            <span id="vendedor"></span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" data-dismiss="modal"
                            class="btn btn-outline-secondary float-right m-1">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Encabezado de la página -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Gestion Ventas </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
                            <li class="breadcrumb-item active">Gestion Ventas</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Cuerpo de la página -->
        <section>
            <!-- Buscador de Productos -->
            <div class="container-fluid">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title fs-5">Buscar Ventas</h3>
                    </div>
                    <div class="card-body">
                        <table id="tabla_venta" class="display table table-hover text-nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Fecha de venta</th>
                                    <th>Cliente</th>
                                    <th>DUI</th>
                                    <th>Total</th>
                                    <th>Vendedor</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </section>
    </div>



    <?php
    include_once 'layouts/footer.php';
} else {
    header('Location: ../index.php');
}
?>
<script src="../js/Venta.js"></script>
<script src="../js/datatables.js"></script>