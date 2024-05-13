<?php
session_start();
if($_SESSION['us_tipo']==1){
    include_once 'layouts/header.php';
?>

  <title>Adm | Editar Datos</title>
<?php
    include_once 'layouts/nav.php';
?>
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
                    <img id="avatar4"src="../img/avatar.png" class="profile-user-img img-fluid img-circle">
                  </div>
                  <h3 class="profile-username text-center text-success">
                      <?php
                        echo $_SESSION['us_nombre'];
                      ?>
                  </h3>
                  <p class="text-muted text-center">
                    Apellido
                  </p>
                  <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                      <b style="color:#0b7300">Edad</b> <a href="" class="float-right">
                        23
                      </a>
                    </li>
                    <li class="list-group-item">
                      <b style="color:#0b7300">DUI</b> <a href="" class="float-right">
                        06097163-5
                      </a>
                    </li>
                    <li class="list-group-item">
                      <b style="color:#0b7300">Tipo Usuario</b> <span class="badge-primary float-right">
                        Administrador
                      </span>
                    </li>
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
                  <p class="text-muted">
                    2222-2222
                  </p>
                  <strong style="color:#0b7300">
                    <i class="fas fa-map-marker-alt mr-1"></i> Residencia
                  </strong>
                  <p class="text-muted">
                    El Salvador
                  </p>
                  <strong style="color:#0b7300">
                    <i class="fas fa-at mr-1"></i> Email
                  </strong>
                  <p class="text-muted">
                    gonesau@outlook.es
                  </p>
                  <strong style="color:#0b7300">
                    <i class="fas fa-smile-wink mr-1"></i> Sexo
                  </strong>
                  <p class="text-muted">
                    Otro
                  </p>
                  <strong style="color:#0b7300">
                    <i class="fas fa-pencil-alt mr-1"></i> Información Adicional
                  </strong>
                  <p class="text-muted">
                    Otro
                  </p>

                  <button class="btn btn-block bg-gradient-danger">
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

                </div>
                <div class="card-footer">
                  
                </div>
              </div>      
          </div>
        </div>
      </div>
    </section>
  </div>



  
<?php
include_once 'layouts/footer.php';
}
else{
    header('Location: ../index.php');
}
?>
