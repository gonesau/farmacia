$(document).ready(function () {
  var funcion = "";
  var id_usuario = $("#id_usuario").val();
  var edit = false;

  buscar_usuario(id_usuario);




  function buscar_usuario(dato) {
    funcion = "buscar_usuario";

    $.post(
      "../controlador/UsuarioController.php",
      { dato, funcion },
      (response) => {
        let nombre = "";
        let apellidos = "";
        let edad = "";
        let dui = "";
        let tipo = "";
        let telefono = "";
        let residencia = "";
        let correo = "";
        let sexo = "";
        let adicional = "";
        var nombre_usuario = "";
        var apellidos_usuario = "";
        console.log(response);
        const usuario = JSON.parse(response);
        nombre += `${usuario.nombre}`;
        apellidos += `${usuario.apellidos}`;
        nombre_usuario += `${usuario.name}`;
        apellidos_usuario += `${usuario.apell}`;
        edad += `${usuario.edad}`;
        dui += `${usuario.dui}`;
        if (usuario.tipo == 'Root') {
            tipo += `<h1 class="badge badge-danger">${usuario.tipo}</h1>`;
        }
        if (usuario.tipo == 'Tecnico') {
            tipo += `<h1 class="badge badge-primary">${usuario.tipo}</h1>`;
        }
        if (usuario.tipo == 'Administrador') {
            tipo += `<h1 class="badge badge-secondary">${usuario.tipo}</h1>`;
        }
        tipo += `${usuario.tipo}`;
        telefono += `${usuario.telefono}`;
        residencia += `${usuario.residencia}`;
        correo += `${usuario.correo}`;
        sexo += `${usuario.sexo}`;
        adicional += `${usuario.adicional}`;
        $('#nombre_us').html(nombre);
        $('#apellidos_us').html(apellidos);
        $('#nombre_us1').html(nombre);
        $('#apellidos_us1').html(apellidos);
        $('#nombre_us_foto').html(nombre); 
        $('#apellidos_us_foto').html(apellidos); 
        $('#nombre_us_confir').html(nombre); 
        $('#apellidos_us_confir').html(apellidos);
        $("#edad").html(edad);
        $("#dui_us").html(dui);
        $("#us_tipo").html(tipo);
        $("#telefono_us").html(telefono);
        $("#residencia_us").html(residencia);
        $("#correo_us").html(correo);
        $("#sexo_us").html(sexo);
        $("#adicional_us").html(adicional);
        $("#avatar3").attr("src", usuario.avatar);
        $("#avatar1").attr("src", usuario.avatar);
        $("#avatar2").attr("src", usuario.avatar);
        $("#avatar4").attr("src", usuario.avatar);
      }
    );
  }



  $(document).on("click", ".edit", (e) => {
    funcion = "capturar_datos";
    edit = true;
    $.post(
      "../controlador/UsuarioController.php",
      { funcion, id_usuario },
      (response) => {
        const usuario = JSON.parse(response);
        $("#telefono").val(usuario.telefono);
        $("#residencia").val(usuario.residencia);
        $("#correo").val(usuario.correo);
        $("#sexo").val(usuario.sexo);
        $("#adicional").val(usuario.adicional);
      }
    );
  });

  $("#form-usuario").submit((e) => {
    if (edit == true) {
      let telefono = $("#telefono").val();
      let residencia = $("#residencia").val();
      let correo = $("#correo").val();
      let sexo = $("#sexo").val();
      let adicional = $("#adicional").val();
      funcion = "editar_usuario";
      $.post(
        "../controlador/UsuarioController.php",
        { id_usuario, telefono, residencia, correo, sexo, adicional, funcion },
        (response) => {
          if (response == "editado") {
            $("#editado").hide("slow");
            $("#editado").show(1000);
            $("#editado").hide(2000);
            $("#form-usuario").trigger("reset");
          }
          edit = false;
          buscar_usuario(id_usuario);
        }
      );
    } else {
      $("#noeditado").hide("slow");
      $("#noeditado").show(1000);
      $("#noeditado").hide(2000);
      $("#form-usuario").trigger("reset");
    }
    e.preventDefault();
  });

  $("#form-pass").submit((e) => {
    e.preventDefault();
    let oldpass = $("#oldpass").val();
    let newpass = $("#newpass").val();
    funcion = "cambiar_contra";
    $.post(
      "../controlador/UsuarioController.php",
      { id_usuario, funcion, oldpass, newpass },
      (response) => {
        if (response == "update") {
          $("#update").hide("slow");
          $("#update").show(1000);
          $("#update").hide(2000);
          $("#form-pass").trigger("reset");
        } else {
          $("#noupdate").hide("slow");
          $("#noupdate").show(1000);
          $("#noupdate").hide(2000);
          $("#form-pass").trigger("reset");
        }
      }
    );
  });

  $("#form-foto").submit((e) => {
    let formData = new FormData($("#form-foto")[0]);
    $.ajax({
      url: "../controlador/UsuarioController.php",
      type: "POST",
      data: formData,
      cache: false,
      processData: false,
      contentType: false,
    }).done(function (response) {
      console.log(response);
      const json = JSON.parse(response);
      if (json.alert == "edit") {
        $("#avatar2").attr("src", json.ruta);
        $("#edit").hide("slow");
        $("#edit").show(1000);
        $("#edit").hide(2000);
        $("#form-foto").trigger("reset");
        buscar_usuario(id_usuario);
      } else if (json.alert == "noedit") {
        $("#noedit").hide("slow");
        $("#noedit").show(1000);
        $("#noedit").hide(2000);
        $("#form-foto").trigger("reset");
      }
    });
    e.preventDefault();
  });


  



});
