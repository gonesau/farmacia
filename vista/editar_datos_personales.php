<?php
session_start();
if ($_SESSION['us_tipo'] == 1 || $_SESSION['us_tipo'] == 3 || $_SESSION['us_tipo'] == 2) {
  include_once 'layouts/header.php';
  ?>

  <title>Adm | Editar Datos</title>
  <?php
  include_once 'layouts/nav.php';
  ?>

  <!-- Modal Cambiar Contraseña-->
  <div class="modal fade" id="cambiocontra" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Cambiar Contraseña</h1>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="text-center">
            <img id="avatar1" src="../img/avatar.png" class="profile-user-img img-fluid img-circle">
          </div>
          <div class="text-center">
            <h3 id="nombre_us" class="profile-username text-center text-success">
              <?php
              echo $_SESSION['nombre'];
              ?>
            </h3>
            <p id="apellidos_us" class="text-muted text-center">
              <?php
              echo $_SESSION['apellido'];
              ?>
            </p>
          </div>
          <div class="alert alert-success text-center" id="update" style="display:none;">
            <span><i class="fas fa-check m-1"></i>Contraseña actualizada correctamente</span>
          </div>
          <div class="alert alert-danger text-center" id="noupdate" style="display:none;">
            <span><i class="fas fa-times m-1"></i>Contraseña Actual Incorrecta</span>
          </div>
          <form id="form-pass">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="fas fa-unlock"></i>
                </span>
              </div>
              <input type="password" class="form-control" id="oldpass" placeholder="Contraseña Actual">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="fas fa-lock"></i>
                </span>
              </div>
              <input type="password" class="form-control" id="newpass" placeholder="Contraseña Nueva">
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

  <!-- Modal Foto-->
  <div class="modal fade" id="cambiofoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Cambiar Fotografía</h1>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="text-center">
            <img id="avatar2" src="../img/avatar.png" class="profile-user-img img-fluid img-circle">
          </div>
          <div class="text-center">
            <h3 id="nombre_us_foto" class="profile-username text-center text-success">
              <?php
              echo $_SESSION['nombre'];
              ?>
            </h3>
            <p id="apellidos_us_foto" class="text-muted text-center">
              <?php
              echo $_SESSION['apellido'];
              ?>
            </p>
          </div>
          <div class="alert alert-success text-center" id="edit" style="display:none;">
            <span><i class="fas fa-check m-1"></i>Fotografía Actualizada Correctamente</span>
          </div>
          <div class="alert alert-danger text-center" id="noedit" style="display:none;">
            <span><i class="fas fa-times m-1"></i>Formato no soportado</span>
          </div>
          <form id="form-foto" enctype="multipart/form-data">
            <div class="input-group mb-3 ml-5 mt-2">
              <input type="file" class="input-group" name="foto">
              <input type="hidden" name="funcion" value="cambiar_foto">
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Datos Personales</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../vista/adm_catalogo.php">Home</a></li>
              <li class="breadcrumb-item active">Datos Personales</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-3">
              <div class="card card-success card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <input id="id_usuario" type="hidden" value="<?php echo $_SESSION['usuario'] ?>">
                    <img id="avatar3" src="../img/avatar.png" class="profile-user-img img-fluid img-circle">
                  </div>
                  <div class="text-center mt-1">
                    <button data-toggle="modal" data-target="#cambiofoto" type="button" class="btn btn-primary btn-sm">
                      Cambiar Foto
                    </button>
                  </div>
                  <h3 id="nombre_us" class="profile-username text-center text-success">

                  </h3>
                  <p id="apellidos_us" class="text-muted text-center">

                  </p>
                  <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                      <b style="color:#0b7300">Edad</b> <a id="edad" href="" class="float-right">
                        23
                      </a>
                    </li>
                    <li class="list-group-item">
                      <b style="color:#0b7300">DUI</b> <a id="dui_us" href="" class="float-right">
                        06097163-5
                      </a>
                    </li>
                    <li class="list-group-item">
                      <b style="color:#0b7300">Tipo Usuario</b> <span id="us_tipo" class="badge-primary float-right">
                        Administrador
                      </span>
                    </li>
                    <button data-toggle="modal" data-target="#cambiocontra" type="button"
                      class="btn btn-block btn-outline-warning btn-sm">
                      Cambiar Contraseña
                    </button>
                  </ul>
                </div>
              </div>
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title text-center">Sobre mi</h3>
                </div>
                <div class="card-body">
                  <strong style="color:#0b7300">
                    <i class="fas fa-phone mr-1"></i> Telefono
                  </strong>
                  <p id="telefono_us" class="text-muted">
                    2222-2222
                  </p>
                  <strong style="color:#0b7300">
                    <i class="fas fa-map-marker-alt mr-1"></i> Residencia
                  </strong>
                  <p id="residencia_us" class="text-muted">
                    El Salvador
                  </p>
                  <strong style="color:#0b7300">
                    <i class="fas fa-at mr-1"></i> Email
                  </strong>
                  <p id="correo_us" class="text-muted">
                    gonesau@outlook.es
                  </p>
                  <strong style="color:#0b7300">
                    <i class="fas fa-smile-wink mr-1"></i> Sexo
                  </strong>
                  <p id="sexo_us" class="text-muted">
                    Otro
                  </p>
                  <strong style="color:#0b7300">
                    <i class="fas fa-pencil-alt mr-1"></i> Información Adicional
                  </strong>
                  <p id="adicional_us" class="text-muted">
                    Otro
                  </p>

                  <button class="edit btn btn-block bg-gradient-danger">
                    Editar
                  </button>
                </div>
                <div class="card-footer">
                  <p class="text-muted text-center">Created by Ubuntomar</p>
                </div>
              </div>
            </div>
            <div class="col-md-9">
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Editar Datos Personales</h3>
                </div>
                <div class="card-body">
                  <div class="alert alert-success text-center" id="editado" style="display:none;">
                    <span><i class="fas fa-check m-1"></i>Datos Actualizados</span>
                  </div>
                  <div class="alert alert-danger text-center" id="noeditado" style="display:none;">
                    <span><i class="fas fa-times m-1"></i>Edición Deshabilitada</span>
                  </div>
                  <form id="form-usuario" class="form-horizontal">
                    <div class="form-group row">
                      <label for="telefono" class="col-sm-2 col-form-label">Telefono</label>
                      <div class="col-sm-10">
                        <input type="number" class="form-control" id="telefono" placeholder="Telefono">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="residencia" class="col-sm-2 col-form-label">Residencia</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="residencia" placeholder="Residencia">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="correo" class="col-sm-2 col-form-label">Correo</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="correo" placeholder="Correo">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="sexo" class="col-sm-2 col-form-label">Sexo</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="sexo" placeholder="Sexo">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="adicional" class="col-sm-2 col-form-label">Información Adicional</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" id="adicional" placeholder="Información Adicional"></textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10 float-right">
                        <button type="submit" class="btn btn-block btn-outline-success">Guardar</button>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="card-footer">
                  <p class="text-muted text-center">Verifique los datos a ingresar</p>
                </div>
              </div>
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