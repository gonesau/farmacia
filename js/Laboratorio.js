$(document).ready(function () {
  var funcion = "";
  buscar_lab();
  // Función que se ejecuta al hacer clic en el botón btn_crear_usuario
  $("#form-crear-laboratorio").submit((e) => {
    e.preventDefault();
    let nombre_laboratorio = $("#nombre_laboratorio").val();
    funcion = "crear";
    $.post(
      "../controlador/LaboratorioController.php",
      { nombre_laboratorio, funcion },
      (response) => {
        if (response.trim() == "add") {
          $("#add-laboratorio").hide("slow");
          $("#add-laboratorio").show(1000);
          $("#add-laboratorio").hide(2000);
          $("#form-crear-laboratorio").trigger("reset");
          buscar_lab();
        } else {
          $("#noadd-laboratorio").hide("slow");
          $("#noadd-laboratorio").show(1000);
          $("#noadd-laboratorio").hide(2000);
          $("#form-crear-laboratorio").trigger("reset");
          buscar_lab();
        }
      }
    );
    e.preventDefault();
  });

  // Función para buscar laboratorio
  function buscar_lab(consulta) {
    funcion = "buscar";
    $.post(
      "../controlador/LaboratorioController.php",
      { consulta, funcion },
      (response) => {
        const laboratorios = JSON.parse(response);
        let template = "";
        laboratorios.forEach((laboratorio) => {
          template += `
                        <tr labId="${laboratorio.id}" labnombre="${laboratorio.nombre}" labavatar="${laboratorio.avatar}">
                            <td>${laboratorio.nombre}</td>
                            <td>
                                <img src="${laboratorio.avatar}" class="img-fluid rounded-1" width="50" height="50">
                            </td>
                            <td>
                                <button type="button" data-toggle="modal" data-target="#cambiologo" class="avatar btn btn-info btn-sm editar" title="Editar logo"> <i class="far fa-image"> </i> </button>
                                <button type="button" class="editar btn btn-warning btn-sm editar" title="Editar laboratorio"> <i class="fas fa-edit"> </i> </button>
                                <button type="button" class="borrar btn btn-danger btn-sm borrar" title="Eliminar laboratorio"><i class="fa fa-trash"> </i></button>
                            </td>
                        </tr>
                    `;
        });
        $("#laboratorios").html(template);
      }
    );
  }

  $(document).on("keyup", "#buscar_laboratorio", function () {
    let valor = $(this).val();
    if (valor != "") {
      buscar_lab(valor);
    } else {
      buscar_lab();
    }
  });

  $(document).on("click", ".avatar", (e) => {
    funcion = "cambiar_logo";
    const elemento = $(this)[0].activeElement.parentElement.parentElement;
    const id = $(elemento).attr("labId");
    const nombre = $(elemento).attr("labnombre");
    const avatar = $(elemento).attr("labavatar");
    $("#logoactual").attr("src", avatar);
    $("#nombre_logo").html(nombre);
    $("#funcion").val(funcion);
    $("#id_logo_lab").val(id);
  });

  $("#form_logo").submit((e) => {
    let formData = new FormData($("#form_logo")[0]);
    $.ajax({
      url: "../controlador/LaboratorioController.php",
      type: "POST",
      data: formData,
      cache: false,
      processData: false,
      contentType: false,
    }).done(function (response) {
      const json = JSON.parse(response);
      if (json.alert == "edit") {
        buscar_lab();
        $("#logoactual").attr("src", json.ruta);
        $("#form_logo").trigger("reset");
        $("#edit-laboratorio").hide("slow");
        $("#edit-laboratorio").show(1000);
        $("#edit-laboratorio").hide(2000);
        buscar_lab();
      } else {
        $("#form_logo").trigger("reset");
        $("#noedit-laboratorio").hide("slow");
        $("#noedit-laboratorio").show(1000);
        $("#noedit-laboratorio").hide(2000);
        buscar_lab();
      }
    });
    e.preventDefault();
  });

  $(document).on("click", ".borrar", (e) => {
    funcion = "borrar";
    const elemento = $(this)[0].activeElement.parentElement.parentElement;
    const id = $(elemento).attr("labId");
    const nombre = $(elemento).attr("labnombre");
    const avatar = $(elemento).attr("labavatar");
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: "btn btn-success",
        cancelButton: "btn btn-danger mr-1",
      },
      buttonsStyling: false,
    });
    swalWithBootstrapButtons
      .fire({
        title: "Estás seguro de eliminar el laboratorio " + nombre + "?",
        text: "No podrás revertir esto!",
        imageUrl: avatar,
        imageWidth: 100,
        imageHeight: 100,
        showCancelButton: true,
        confirmButtonText: "Si, borrar laboratorio",
        cancelButtonText: "No, cancelar",
        reverseButtons: true,
      })
      .then((result) => {
        if (result.isConfirmed) {
            $.post(
                "../controlador/LaboratorioController.php",
                { id, funcion },
                (response) => {
                    console.log(response);
                });
          swalWithBootstrapButtons.fire({
            title: "Laboratorio eliminado",
            text: "El laboratorio " + nombre + " ha sido eliminado",
            icon: "success",
          });
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire({
            title: "Cancelado",
            text: "El laboratorio " + nombre + " no se ha eliminado",
            icon: "error",
          });
        }
      });
  });
});
