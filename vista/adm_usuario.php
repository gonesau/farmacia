<?php
session_start();


if ($_SESSION['us_tipo'] == 1 || $_SESSION['us_tipo'] == 3) {
    include_once 'layouts/header.php';
    ?>

    <title>Gestionar Usuarios</title>
    <?php
    include_once 'layouts/nav.php';
    ?>

    <script src="../js/usuario.js"></script>
    <script src="../js/gestion_usuario.js"></script>
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
                <div class="text-center">
            <h3 id="nombre_usuario" class="nombre_us_var profile-username text-center text-success">

            </h3>
            <p id="apellidos_usuario" class="apellidos_us_var text-muted text-center">

            </p>
          </div>
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


    <!-- Modal Crear Usuario-->
    <div class="modal fade" id="crearusuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title fs-5">Crear Usuario</h3>
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
                        <form id="form-crear">
                            <div class="form-group row">
                                <label for="nombre" class="col-sm-4 col-form-label">Nombres</label>
                                <input type="text" class="form-control" id="nombre" placeholder="Ingrese nombres" required>
                            </div>
                            <div class="form-group row">
                                <label for="apellido" class="col-sm-4 col-form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellido" placeholder="Ingrese apellidos"
                                    required>
                            </div>
                            <div class="form-group row">
                                <label for="edad" class="col-sm-6 col-form-label">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="edad" required>
                            </div>
                            <div class="form-group row">
                                <label for="dui" class="col-sm-4 col-form-label">DUI</label>
                                <input type="text" class="form-control" id="dui" placeholder="Ingrese el DUI" required>
                            </div>
                            <div class="form-group row">
                                <label for="pass" class="col-sm-4 col-form-label">Contraseña</label>
                                <input type="password" class="form-control" id="pass" placeholder="Ingrese la contraseña"
                                    required>
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn bg-gradient-primary float-right m-1" id="btn_crear_usuario">Crear
                            Usuario</button>
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
                        <h1>Gestionar Usuarios <button id="button-crear" data-toggle="modal" data-target="#crearusuario"
                                type="button" class="btn bg-gradient-primary ml-2"> Crear usuario </button> </h1>

                        <input type="hidden" id="tipo_de_usuario" value="<?php
                        echo $_SESSION['us_tipo'];
                        ?>">
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
                            <li class="breadcrumb-item active">Gestionar Usuarios</li>
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
                        <h3 class="card-title fs-5">Buscar Usuario</h3>
                        <div class="input-group">
                            <input type="text" id="buscar" class="form-control float-left mt-2"
                                placeholder="Ingrese Nombre, Apellido o DUI del usuario">
                            <div class="input-group-append">
                                <button class="btn btn-primary mt-2" id="btn_buscar_usuario"><i
                                        class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="usuarios" class="row d-flex align-items-stretch">

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
<script src="../js/usuario.js"></script>
<script src="../js/gestion_usuario.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>