$(document).ready(function () {
  var funcion = "";
  var edit = false;
  buscar_tipo();
  // Función que se ejecuta al hacer clic en el botón btn_crear_usuario
  $("#form-crear-tipo").submit((e) => {
    e.preventDefault();
    let nombre_tipo = $("#nombre_tipo").val();
    let id_editado = $("#id_editar_tipo").val();
    if (edit == false) {
      funcion = "crear";
    } else {
      funcion = "editar";
    }
    $.post(
      "../controlador/TipoController.php",
      { nombre_tipo, id_editado, funcion },
      (response) => {
        if (response.trim() == "add") {
          $("#add-tipo").hide("slow");
          $("#add-tipo").show(1000);
          $("#add-tipo").hide(2000);
          $("#form-crear-tipo").trigger("reset");
          buscar_tipo();
        }
        if (response.trim() == "noadd") {
          $("#noadd-tipo").hide("slow");
          $("#noadd-tipo").show(1000);
          $("#noadd-tipo").hide(2000);
          $("#form-crear-tipo").trigger("reset");
          buscar_tipo();
        }
        if (response == "edit") {
          $("#edit-tipo").hide("slow");
          $("#edit-tipo").show(1000);
          $("#edit-tipo").hide(2000);
          $("#form-crear-tipo").trigger("reset");
          buscar_tipo();
        }
        edit = false;
      }
    );
    e.preventDefault();
  });

  // Función para buscar laboratorio
  function buscar_tipo(consulta) {
    funcion = "buscar";
    $.post(
      "../controlador/TipoController.php",
      { consulta, funcion },
      (response) => {
        const tipos = JSON.parse(response);
        let template = "";
        tipos.forEach((tipo) => {
          template += `
                                                <tr tipoId="${tipo.id}" tiponombre="${tipo.nombre}" ">
                                                        <td>${tipo.nombre}</td>
                                                        <td>
                                                                <button type="button" data-toggle="modal" data-target="#creartipo" class="btn btn-warning btn-sm editar_tipo" title="Editar tipo"> <i class="fas fa-edit"> </i> </button>
                                                                <button type="button" class="btn btn-danger btn-sm borrar_tipo" title="Eliminar tipo"><i class="fa fa-trash"> </i></button>
                                                        </td>
                                                </tr>
                                        `;
        });
        $("#tipos").html(template);
      }
    );
  }

  $(document).on("keyup", "#buscar_tipo", function () {
    let valor = $(this).val();
    if (valor != "") {
      buscar_tipo(valor);
    } else {
      buscar_tipo();
    }
  });


  $(document).on("click", ".borrar_tipo", (e) => {
    funcion = "borrar";
    const elemento = $(this)[0].activeElement.parentElement.parentElement;
    const id = $(elemento).attr("tipoId");
    const nombre = $(elemento).attr("tiponombre");
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: "btn btn-success",
        cancelButton: "btn btn-danger mr-1",
      },
      buttonsStyling: false,
    });
    swalWithBootstrapButtons
      .fire({
        title: "Estás seguro de eliminar el tipo " + nombre + "?",
        text: "No podrás revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, borrar tipo",
        cancelButtonText: "No, cancelar",
        reverseButtons: true,
      })
      .then((result) => {
        if (result.isConfirmed) {
          $.post(
            "../controlador/TipoController.php",
            { id, funcion },
            (response) => {
              edit = false;
              if (response.trim() == "borrado") {
                swalWithBootstrapButtons.fire({
                  title: "Eliminado",
                  text: "El tipo " + nombre + " ha sido eliminado",
                  icon: "success",
                });
                buscar_tipo();
              } else {
                swalWithBootstrapButtons.fire({
                  title: "Error",
                  text:
                    "El tipo " +
                    nombre +
                    " no ha sido eliminado porque tiene productos asociados",
                  icon: "error",
                });
              }
            }
          );
        } else if (result.dismiss === Swal.DismissReason.cancel) {
          swalWithBootstrapButtons.fire({
            title: "Cancelado",
            text: "El tipo " + nombre + " no ha sido eliminado",
            icon: "error",
          });
        }
      });
  });

  $(document).on("click", ".editar_tipo", (e) => {
    const elemento = $(this)[0].activeElement.parentElement.parentElement;
    const id = $(elemento).attr("tipoId");
    const nombre = $(elemento).attr("tiponombre");
    $("#id_editar_tipo").val(id);
    $("#nombre_tipo").val(nombre);
    edit = true;
  });
});
