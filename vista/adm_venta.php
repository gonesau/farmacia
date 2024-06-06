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
                        <table class="table table-hover text-nowrap">
                            <thead class="table-success">
                                <tr>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Producto</th>
                                    <th>Concentracion</th>
                                    <th>Adicional</th>
                                    <th>Laboratorio</th>
                                    <th>Presentacion</th>
                                    <th>Tipo</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody id="registros" class="table-warning">

                            </tbody>
                        </table>
                        <div class="float-right input-group-append">
                            <h3 class="m-3">Total: </h3>
                            <h3 id="total" class="m-3"></h3>
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

        <!--
        Cuerpo de la página 
        <section>
            Consultas de ventas 
            <div class="container-fluid">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title fs-5">Consultas</h3>
                    </div>
                    <div class="card-body">
                        
                        <div class="row">
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3 id="venta_dia_vendedor">0</h3>
                                        <p>New Orders</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-bag"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>

                            <div class="col-lg-3 col-6">

                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3>53<sup style="font-size: 20px">%</sup></h3>
                                        <p>Bounce Rate</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>

                            <div class="col-lg-3 col-6">

                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>44</h3>
                                        <p>User Registrations</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-person-add"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>

                            <div class="col-lg-3 col-6">

                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3>65</h3>
                                        <p>Unique Visitors</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-pie-graph"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </section>
        -->
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