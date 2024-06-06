<?php
session_start();

if ($_SESSION['us_tipo'] == 3 || $_SESSION['us_tipo'] == 2) {
    include_once 'layouts/header.php';
    include_once '../modelo/usuario.php';
    //include_once '../modelo/Producto.php';
    ?>

    <title>Gestionar Lote</title>
    <?php
    include_once 'layouts/nav.php';
    $objUsuario = new usuario();
    ?>

    <!-- Modal Crear lote-->
    <div class="modal fade" id="editarlote" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title fs-5">Editar lote</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success text-center" id="edit-lote" style="display:none;">
                            <span><i class="fas fa-check m-1"></i>Se editó correctamente</span>
                        </div>
                        <form id="form-editar-lote">
                            <div class="form-group">
                                <label for="codigo_lote">Codigo lote: </label>
                                <label id="codigo_lote">codigo lote</label>
                            </div>
                            <div class="form-group">
                                <label for="stock">Stock: </label>
                                <input id="stock" type="number" class="form-control" required>
                            </div>
                            <input type="hidden" id="id_lote_prod">
                            <div class="card-footer">
                                <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
                                <button type="button" data-dismiss="modal"
                                    class="btn btn-outline-secondary float-right m-1">Cerrar</button>
                        </form>
                    </div>
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
                        <h1>Gestion Lote </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
                            <li class="breadcrumb-item active">Gestion Lote</li>
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
                        <h3 class="card-title fs-5">Buscar Lotes</h3>
                        <div class="input-group">
                            <input type="text" id="buscar_lote" class="form-control float-left mt-2"
                                placeholder="Ingrese nombre del producto">
                            <div class="input-group-append">
                                <button class="btn btn-primary mt-2" id="btn_buscar_usuario"><i
                                        class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="lotes" class="row d-flex align-items-stretch">

                        </div>
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
<script src="../js/Lote.js"></script>