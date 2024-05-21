<?php
session_start();
if ($_SESSION['us_tipo'] == 1 || $_SESSION['us_tipo'] == 3) {
    include_once 'layouts/header.php';
    ?>

    <title>Adm | Atributos</title>
    <?php
    include_once 'layouts/nav.php';
    ?>


    <!-- Modal Crear Laboratorio-->
    <div class="modal fade" id="crearlaboratorio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title fs-5">Crear Laboratorio</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success text-center" id="add" style="display:none;">
                            <span><i class="fas fa-check m-1"></i>Usuario Creado</span>
                        </div>
                        <div class="alert alert-danger text-center" id="noadd" style="display:none;">
                            <span><i class="fas fa-times m-1"></i>Error al crear usuario</span>
                        </div>
                        <form id="form-crear-laboratorio">
                            <div class="form-group row">
                                <label for="nombre_laboratorio" class="col-sm-6 col-form-label">Nombre de Laboratorio</label>
                                <input type="text" class="form-control" id="nombre_laboratorio" placeholder="Ingrese nombres" required>
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn bg-gradient-primary float-right m-1" id="btn_crear_usuario">Crear</button>
                        <button type="button" data-dismiss="modal"
                            class="btn btn-outline-secondary float-right m-1">Cerrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


        <!-- Modal Crear tipo-->
        <div class="modal fade" id="creartipo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title fs-5">Crear Laboratorio</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success text-center" id="add" style="display:none;">
                            <span><i class="fas fa-check m-1"></i>Usuario Creado</span>
                        </div>
                        <div class="alert alert-danger text-center" id="noadd" style="display:none;">
                            <span><i class="fas fa-times m-1"></i>Error al crear usuario</span>
                        </div>
                        <form id="form-crear-tipo">
                            <div class="form-group row">
                                <label for="nombre_tipo" class="col-sm-6 col-form-label">Nombre de Tipo</label>
                                <input type="text" class="form-control" id="nombre_tipo" placeholder="Ingrese nombres" required>
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn bg-gradient-primary float-right m-1" id="btn_crear_usuario">Crear</button>
                        <button type="button" data-dismiss="modal"
                            class="btn btn-outline-secondary float-right m-1">Cerrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


            <!-- Modal Crear tipo-->
            <div class="modal fade" id="crearpresentacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title fs-5">Crear Laboratorio</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success text-center" id="add" style="display:none;">
                            <span><i class="fas fa-check m-1"></i>Usuario Creado</span>
                        </div>
                        <div class="alert alert-danger text-center" id="noadd" style="display:none;">
                            <span><i class="fas fa-times m-1"></i>Error al crear usuario</span>
                        </div>
                        <form id="form-crear-presentacion">
                            <div class="form-group row">
                                <label for="nombre_presentacion" class="col-sm-6 col-form-label">Nombre de Presentacion</label>
                                <input type="text" class="form-control" id="nombre_presentacion" placeholder="Ingrese nombres" required>
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn bg-gradient-primary float-right m-1" id="btn_crear_usuario">Crear</button>
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
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Gestión de Atributos</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../vista/adm_catalogo.php">Home</a></li>
                            <li class="breadcrumb-item active">Gestión Atributos</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Horizontal Form -->
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-pills">
                                    <li class="nav-items">
                                        <a href="#laboratorio" class="nav-link active" data-toggle="tab">Laboratorio</a>
                                    </li>
                                    <li class="nav-items">
                                        <a href="#tipo" class="nav-link" data-toggle="tab">Tipo</a>
                                    </li>
                                    <li class="nav-items">
                                        <a href="#presentacion" class="nav-link" data-toggle="tab">Presentación</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="laboratorio">
                                        <div class="card card-success">
                                            <div class="card-header">
                                                <div class="card-title">Laboratorio <button type="button" data-toggle="modal" data-target="#crearlaboratorio" class="btn bg-primary btn-sm m-2"> Crear Laboratorio</button> </div>
                                                <div class="input-group">
                                                    <input id="buscar_laboratorio" type="text"
                                                        class="form-control float-left" placeholder="Ingrese nombre">
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-default"><i
                                                                class="fas fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                            </div>
                                            <div class="card-footer">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tipo">
                                        <div class="card card-success">
                                            <div class="card-header">
                                                <div class="card-title">Tipo <button type="button" data-toggle="modal" data-target="#creartipo" class="btn bg-primary btn-sm m-2"> Crear Tipo</button>  </div>
                                                <div class="input-group">
                                                    <input id="buscar_tipo" type="text"
                                                        class="form-control float-left" placeholder="Ingrese nombre">
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-default"><i
                                                                class="fas fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                            </div>
                                            <div class="card-footer">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="presentacion">
                                        <div class="card card-success">
                                            <div class="card-header">
                                                <div class="card-title">Presentación <button type="button" data-toggle="modal" data-target="#crearpresentacion" class="btn bg-primary btn-sm m-2"> Crear Presentación </button> </div>
                                                <div class="input-group">
                                                    <input id="buscar_presentacion" type="text"
                                                        class="form-control float-left" placeholder="Ingrese nombre">
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-default"><i
                                                                class="fas fa-search"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                            </div>
                                            <div class="card-footer">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php
    include_once 'layouts/footer.php';
} else {
    header('Location: ../index.php');
}
?>