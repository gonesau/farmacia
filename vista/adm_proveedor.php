<?php
session_start();

if ($_SESSION['us_tipo'] == 1 || $_SESSION['us_tipo'] == 3) {
    include_once 'layouts/header.php';
    include_once 'layouts/nav.php';
    include_once '../modelo/usuario.php';

    ?>

    <title>Gestionar Proveedor</title>


    <!-- Modal Crear Usuario-->
    <div class="modal fade" id="crearproveedor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title fs-5">Crear Proveedor</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success text-center" id="add" style="display:none;">
                            <span><i class="fas fa-check m-1"></i>Proveedor Creado</span>
                        </div>
                        <div class="alert alert-danger text-center" id="noadd" style="display:none;">
                            <span><i class="fas fa-times m-1"></i>Error al crear proveedor</span>
                        </div>
                        <form id="form-crear">
                            <div class="form-group row">
                                <label for="nombre" class="col-sm-4 col-form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" placeholder="Ingrese nombre" required>
                            </div>
                            <div class="form-group row">
                                <label for="telefono" class="col-sm-4 col-form-label">Telefono</label>
                                <input type="number" class="form-control" id="telefono" placeholder="Ingrese telefono"
                                    required>
                            </div>
                            <div class="form-group row">
                                <label for="correo" class="col-sm-4 col-form-label">Correo</label>
                                <input type="email" class="form-control" id="correo" placeholder="Ingrese el correo"
                                    required>
                            </div>
                            <div class="form-group row">
                                <label for="direccion" class="col-sm-4 col-form-label">Dirección</label>
                                <input type="text" class="form-control" id="direccion" placeholder="Ingrese dirección"
                                    required>
                            </div>
                            <input type="hidden" id="id_edit_prov">
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn bg-gradient-primary float-right m-1" id="btn_crear_usuario">Guardar
                            Proveedor</button>
                        <button type="button" data-dismiss="modal"
                            class="btn btn-outline-secondary float-right m-1">Cerrar</button>
                        </form>
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
                        <h1>Gestionar Proveedores <button data-toggle="modal"
                                data-target="#crearproveedor" type="button" class="btn bg-gradient-primary ml-2"> Crear
                                Proveedor </button> </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
                            <li class="breadcrumb-item active">Gestionar Proveedores</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Cuerpo de la página -->
        <section>
            <!-- Buscador de Usuarios -->
            <div class="container-fluid">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title fs-5">Buscar Proveedor</h3>
                        <div class="input-group">
                            <input type="text" id="buscar_proveedor" class="form-control float-left mt-2"
                                placeholder="Ingrese Nombre del Proveedor">
                            <div class="input-group-append">
                                <button class="btn btn-primary mt-2" id="btn_buscar_proveedor"><i
                                        class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="proveedores" class="row d-flex align-items-stretch">

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

<script src="../js/Proveedor.js"></script>

