<?php
session_start();

if ($_SESSION['us_tipo'] == 1 || $_SESSION['us_tipo'] == 3) {
    include_once 'layouts/header.php';
    include_once '../modelo/usuario.php';
    //include_once '../modelo/Producto.php';
    ?>

    <title>Gestionar Usuarios</title>
    <?php
    include_once 'layouts/nav.php';
    $objUsuario = new usuario();
    //$objProducto = new producto();
    ?>

    <script src="../js/usuario.js"></script>
    <script src="../js/gestion_usuario.js"></script>

    <!-- Modal Crear lote-->
    <div class="modal fade" id="crearlote" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title fs-5">Crear lote</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success text-center" id="add_lote" style="display:none;">
                            <span><i class="fas fa-check m-1"></i>Se agregó correctamente</span>
                        </div>
                        <form id="form-crear-lote">
                            <div class="form-group row">
                                <label for="nombre_producto_lote" class="col-sm-4 col-form-label">Producto</label>
                                <label id="nombre_producto_lote">Nombre del Producto</label>
                            </div>


                            <div class="form-group row">
                                <label for="proveedor" class="col-sm-4 col-form-label">Proveedor</label>
                                <select name="proveedor" id="proveedor" class="form-control select2"></select>
                            </div>
                            <div class="form-group row">
                                <label for="stock" class="col-sm-4 col-form-label">Stock</label>
                                <input type="number" class="form-control" id="stock" placeholder="Ingrese stock" required>
                            </div>
                            <div class="form-group row">
                                <label for="vencimiento" class="col-sm-6 col-form-label">Vencimiento</label>
                                <input type="date" class="form-control" id="vencimiento"
                                    placeholder="Ingrese fecha de vencimiento">
                            </div>
                            <input type="hidden" id="id_lote_prod">
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn bg-gradient-primary float-right m-1" id="btn_crear_usuario">Guardar
                            lote</button>
                        <button type="button" data-dismiss="modal"
                            class="btn btn-outline-secondary float-right m-1">Cerrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal Cambiar Avatar de Producto-->
    <div class="modal fade" id="cambiologo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cambiar Logo</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img id="logoactual" src="../img/prod/prod_default.png"
                            class="profile-user-img img-fluid img-circle">
                    </div>
                    <div class="text-center">
                        <b id="nombre_logo"></b>
                    </div>
                    <div class="alert alert-success text-center" id="edit-prod" style="display:none;">
                        <span><i class="fas fa-check m-1"></i>Logo Actualizado Correctamente</span>
                    </div>
                    <div class="alert alert-danger text-center" id="noedit-prod" style="display:none;">
                        <span><i class="fas fa-times m-1"></i>Formato no soportado</span>
                    </div>
                    <form id="form_logo" enctype="multipart/form-data">
                        <div class="input-group mb-3 ml-5 mt-2">
                            <input type="file" class="input-group" name="foto">
                            <input type="hidden" name="funcion" id="funcion">
                            <input type="hidden" name="id_logo_prod" id="id_logo_prod">
                            <input type="hidden" name="avatar" id="avatar">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn bg-gradient-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>





    <!-- Modal Confirmar contraseña-->
    <div class="modal fade" id="confirmar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmar Contraseña</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img id="avatar1" src="../img/avatar.png" class="profile-user-img img-fluid img-circle">
                    </div>
                    <?php
                    // $datos = $objUsuario->obtener_datos($_SESSION['us_tipo']) aca utiliza el 3 y no se porque;
                    //tons mi pana, con la funcion de obtener datos nos jalamos todos los datos
                    $datos = $objUsuario->obtener_datos($_SESSION['usuario']);
                    if (is_array($datos) || is_object($datos)) {
                        //recorremos con un foreach todo lo que nos jalamos
                        foreach ($datos as $row => $column) {
                            ?>
                            <div class="text-center">
                                <h3 id="nombre_usuario" class="profile-username text-center text-success">
                                    <?php
                                    //imprimimos
                                    echo $column->nombre_us;
                                    ?>
                                </h3>
                                <p id="apellidos_usuario" class="text-muted text-center">
                                    <?php
                                    //imprimimos
                                    echo $column->apellidos_us;
                                    ?>
                                </p>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <span>Es necesario ingresar contraseña para continuar</span>
                    <div class="alert alert-success text-center" id="confirmado" style="display:none;">
                        <span><i class="fas fa-check m-1"></i>Usuario Modificado</span>
                    </div>
                    <div class="alert alert-danger text-center" id="rechazado" style="display:none;">
                        <span><i class="fas fa-times m-1"></i>Contraseña Incorrecta</span>
                    </div>
                    <form id="form-confirmar">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-unlock"></i>
                                </span>
                            </div>
                            <input type="password" class="form-control" id="oldpass" placeholder="Contraseña Actual">
                            <input type="hidden" id="id_usuario" name="id_usuario">
                            <input type="hidden" id="funcion" name="funcion">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn bg-gradient-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Crear producto-->
    <div class="modal fade" id="crearproducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title fs-5">Crear producto</h3>
                        <button data-dismiss="modal" aria-label="close" class="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success text-center" id="add" style="display:none;">
                            <span><i class="fas fa-check m-1"></i>Se agrego correctamente</span>
                        </div>
                        <div class="alert alert-danger text-center" id="noadd" style="display:none;">
                            <span><i class="fas fa-times m-1"></i>El producto ya existe</span>
                        </div>
                        <div class="alert alert-success text-center" id="edit_prod" style="display:none;">
                            <span><i class="fas fa-check m-1"></i>Se editó correctamente</span>
                        </div>
                        <div class="alert alert-danger text-center" id="noedit_prod" style="display:none;">
                            <span><i class="fas fa-times m-1"></i>El producto no se pudo editar</span>
                        </div>
                        <form id="form-crear-producto">
                            <div class="form-group row">
                                <label for="nombre_producto" class="col-sm-4 col-form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre_producto" placeholder="Ingrese nombre"
                                    required>
                            </div>
                            <div class="form-group row">
                                <label for="concentracion" class="col-sm-4 col-form-label">Concentracion</label>
                                <input type="text" class="form-control" id="concentracion"
                                    placeholder="Ingrese concentracion">
                            </div>
                            <div class="form-group row">
                                <label for="adicional" class="col-sm-6 col-form-label">Adicional</label>
                                <input type="text" class="form-control" id="adicional" placeholder="Ingrese adicional">
                            </div>
                            <div class="form-group row">
                                <label for="precio" class="col-sm-4 col-form-label">Precio</label>
                                <input type="number" class="form-control" id="precio" value='1'
                                    placeholder="Ingrese el precio" required>
                            </div>
                            <div class="form-group row">
                                <label for="laboratorio" class="col-sm-4 col-form-label">Laboratorio</label>
                                <select name="laboratorio" id="laboratorio" class="form-control select2"></select>
                            </div>
                            <div class="form-group row">
                                <label for="tipo" class="col-sm-4 col-form-label">Tipo</label>
                                <select name="tipo" id="tipo" class="form-control select2"></select>
                            </div>
                            <div class="form-group row">
                                <label for="presentacion" class="col-sm-4 col-form-label">Presentacion</label>
                                <select name="presentacion" id="presentacion" class="form-control select2"></select>
                            </div>
                            <input type="hidden" id="id_edit_prod">
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn bg-gradient-primary float-right m-1" id="btn_crear_usuario">Guardar
                            producto</button>
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
                        <h1>Gestion producto <button id="button-crear" data-toggle="modal" data-target="#crearproducto"
                                type="button" class="btn bg-gradient-primary ml-2"> Crear producto </button> </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
                            <li class="breadcrumb-item active">Gestion producto</li>
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
                        <h3 class="card-title fs-5">Buscar producto</h3>
                        <div class="input-group">
                            <input type="text" id="buscar-producto" class="form-control float-left mt-2"
                                placeholder="Ingrese nombre del producto">
                            <div class="input-group-append">
                                <button class="btn btn-primary mt-2" id="btn_buscar_usuario"><i
                                        class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="productos" class="row d-flex align-items-stretch">

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
<script src="../js/Producto.js"></script>
<!-- <script src="../js/"></script> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>