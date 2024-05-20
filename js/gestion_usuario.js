$(document).ready(function () {
  // Funcion para buscar un usuario
  var funcion;
  var tipo_de_usuario = $("#tipo_de_usuario").val();

  if (tipo_de_usuario == 2) {
    $("#button-crear").hide();
  }

  function buscar_datos(consulta) {
    funcion = "buscar_usuario_adm";
    $.post(
      "../controlador/UsuarioController.php",
      { consulta, funcion },
      (response) => {
        const usuarios = JSON.parse(response);
        let template = "";
        usuarios.forEach((usuario) => {
          template += `
          <div usuarioId="${usuario.id}" class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">`;
                    if(usuario.tipo_de_usuario == 3){
                      template+=`<h1 class="badge badge-danger">${usuario.tipo}</h1>`;
                    }
                    if(usuario.tipo_de_usuario == 2){
                      template+=`<h1 class="badge badge-primary">${usuario.tipo}</h1>`;
                    }
                    if(usuario.tipo_de_usuario == 1){
                      template+=`<h1 class="badge badge-secondary">${usuario.tipo}</h1>`;
                    }
              template+=`</div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>${usuario.nombre} ${usuario.apellidos}</b></h2>
                      <p class="text-muted text-sm"><b>Sobre mi: </b> ${usuario.adicional} </p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-id-card"></i></span> DUI: ${usuario.dui} </li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-birthday-cake"></i></span> Edad: ${usuario.edad} </li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Dirección: ${usuario.residencia} </li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Teléfono #: ${usuario.telefono}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-at"></i></span> Emaill: ${usuario.email}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-smile-wink"></i></span> Sexo: ${usuario.sexo}</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="${usuario.avatar}" alt="user-avatar" class="img-circle img-fluid" width="225" height="225">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">`;
          if (tipo_de_usuario == 3) {
            if (usuario.tipo_de_usuario != 3) {
              template += `
                      <button data-toggle="modal" data-target="#confirmar" type="button" class="borrar_usuario btn btn-danger">
                          <i class="fas fa-trash mr-1"></i> Eliminar
                      </button>
                      `;
            }
            if (usuario.tipo_de_usuario == 2) {
              template += `
                      <button data-toggle="modal" data-target="#confirmar" type="button" class="ascender btn btn-primary">
                          <i class="fas fa-sort-amount-up ml-1"></i> Ascender
                      </button>
                      `;
            }
            if (usuario.tipo_de_usuario == 1) {
              template += `
                      <button data-toggle="modal" data-target="#confirmar" type="button" class="descender btn btn-secondary">
                          <i class="fas fa-sort-amount-down ml-1"></i> Descender
                      </button>
                      `;
            }
          } else {
            if (
              tipo_de_usuario == 1 &&
              usuario.tipo_de_usuario != 1 &&
              usuario.tipo_de_usuario != 3
            ) {
              template += `
                        <button data-toggle="modal" data-target="#confirmar" type="button" class="borrar_usuario btn btn-danger">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                        `;
            }
          }
          template += `
                  </div>
                </div>
              </div>
                `;
        });
        $("#usuarios").html(template);
      }
    );
  }
  $(document).on("keyup", "#buscar", function () {
    let valor = $(this).val();
    if (valor != "") {
      buscar_datos(valor);
    } else {
      buscar_datos(valor);
    }
  });

  // Funcion para crear un usuario
  $("#form-crear").submit((e) => {
    e.preventDefault();

    let nombre = $("#nombre").val();
    let apellido = $("#apellido").val();
    let dui = $("#dui").val();
    let edad = $("#edad").val();
    let pass = $("#pass").val();

    funcion = "crear_usuario";

    // Añadir registros para depuración
    console.log(
      `Datos enviados: nombre=${nombre}, apellido=${apellido}, edad=${edad}, dui=${dui}, pass=${pass}`
    );

    $.post(
      "../controlador/UsuarioController.php",
      { nombre, apellido, dui, edad, pass, funcion },
      (response) => {
        console.log(response);
        if (response == "add") {
          $("#add").hide("slow");
          $("#add").show(1000);
          $("#add").hide(2000);
        } else {
          $("#noadd").hide("slow");
          $("#noadd").show(1000);
          $("#noadd").hide(2000);
        }
        $("#form-crear").trigger("reset");
      }
    );
  });

  $(document).on("click", ".ascender", function () {
    const elemento = $(this).closest(".card");
    const id = $(elemento).attr("usuarioId");
    console.log(`Ascender clicked: id=${id}`);
    $("#id_usuario").val(id); // Asegúrate de usar el id correcto
    $("#funcion").val("ascender");
  });

  $(document).on("click", ".descender", function () {
    const elemento = $(this).closest(".card");
    const id = $(elemento).attr("usuarioId");
    console.log(`Descender clicked: id=${id}`);
    $("#id_usuario").val(id); // Asegúrate de usar el id correcto
    $("#funcion").val("descender");
  });

  $(document).on("click", ".borrar_usuario", function () {
    const elemento = $(this).closest(".card");
    const id = $(elemento).attr("usuarioId");
    console.log(`Borrar clicked: id=${id}`);
    funcion = "borrar_usuario";
    $("#id_usuario").val(id);
    $("#funcion").val(funcion);
  });

  $('#form-confirmar').submit((e) => {
    e.preventDefault();
    let pass = $('#oldpass').val();
    let id_usuario = $('#id_usuario').val();
    let funcion = $('#funcion').val();
    console.log(`Form submit: pass=${pass}, id_usuario=${id_usuario}, funcion=${funcion}`);
    $.post('../controlador/UsuarioController.php', { pass, id_usuario, funcion }, (response) => {
      console.log(`Response: ${response}`);
      if (response == 'ascendido' || response == 'descendido' || response == 'borrado') {
        $('#confirmado').hide('slow');
        $('#confirmado').show(1000);
        $('#confirmado').hide(2000);
        $('#form-confirmar').trigger('reset');
      } else {
        $('#rechazado').hide('slow');
        $('#rechazado').show(1000);
        $('#rechazado').hide(2000);
        $('#form-confirmar').trigger('reset');
      }
      buscar_datos();
    });
  });


  buscar_datos();
});
