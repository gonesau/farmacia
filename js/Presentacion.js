$(document).ready(function () {
  var funcion = "";
  var edit = false;
  buscar_pre();
  // Función que se ejecuta al hacer clic en el botón btn_crear_usuario
  $("#form-crear-pre").submit((e) => {
    e.preventDefault();
    let nombre_pre = $("#nombre_pre").val();
    let id_editado = $("#id_editar_pre").val();
    if (edit == false) {
      funcion = "crear";
    } else {
      funcion = "editar";
    }
    $.post(
      "../controlador/PresentacionController.php",
      { nombre_pre, id_editado, funcion },
      (response) => {
        if (response.trim() == "add") {
          $("#add-pre").hide("slow");
          $("#add-pre").show(1000);
          $("#add-pre").hide(2000);
          $("#form-crear-pre").trigger("reset");
          buscar_pre();
        }
        if (response.trim() == "noadd") {
          $("#noadd-pre").hide("slow");
          $("#noadd-pre").show(1000);
          $("#noadd-pre").hide(2000);
          $("#form-crear-pre").trigger("reset");
          buscar_pre();
        }
        if (response == "edit") {
          $("#edit-pre").hide("slow");
          $("#edit-pre").show(1000);
          $("#edit-pre").hide(2000);
          $("#form-crear-pre").trigger("reset");
          buscar_pre();
        }
        edit = false;
      }
    );
    e.preventDefault();
  });

  // Función para buscar laboratorio
  function buscar_pre(consulta) {
    funcion = "buscar";
    $.post(
      "../controlador/PresentacionController.php",
      { consulta, funcion },
      (response) => {
        const presentaciones = JSON.parse(response);
        let template = "";
        presentaciones.forEach((presentacion) => {
          template += `
                                                  <tr preId="${presentacion.id}" prenombre="${presentacion.nombre}" ">
                                                          <td>${presentacion.nombre}</td>
                                                          <td>
                                                                  <button type="button" data-toggle="modal" data-target="#crearpre" class="btn btn-warning btn-sm editar_pre" title="Editar Presentación"> <i class="fas fa-edit"> </i> </button>
                                                                  <button type="button" class="btn btn-danger btn-sm borrar_pre" title="Eliminar Presentación"><i class="fa fa-trash"> </i></button>
                                                          </td>
                                                  </tr>
                                          `;
        });
        $("#presentaciones").html(template);
      }
    );
  }

  $(document).on("keyup", "#buscar_presentacion", function () {
    let valor = $(this).val();
    if (valor != "") {
      buscar_pre(valor);
    } else {
      buscar_pre();
    }
  });

  $(document).on("click", ".borrar_pre", (e) => {
    funcion = "borrar";
    const elemento = $(this)[0].activeElement.parentElement.parentElement;
    const id = $(elemento).attr("preId");
    const nombre = $(elemento).attr("prenombre");
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: "btn btn-success",
        cancelButton: "btn btn-danger mr-1",
      },
      buttonsStyling: false,
    });
    swalWithBootstrapButtons
      .fire({
        title: "Estás seguro de eliminar la Presentación: " + nombre + "?",
        text: "No podrás revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, borrar presentacion",
        cancelButtonText: "No, cancelar",
        reverseButtons: true,
      })
      .then((result) => {
        if (result.isConfirmed) {
          $.post(
            "../controlador/PresentacionController.php",
            { id, funcion },
            (response) => {
              edit = false;
              if (response.trim() == "borrado") {
                swalWithBootstrapButtons.fire({
                  title: "Eliminado",
                  text: "La presentación " + nombre + " ha sido eliminado",
                  icon: "success",
                });
                buscar_pre();
              } else {
                swalWithBootstrapButtons.fire({
                  title: "Error",
                  text:
                    "La Presentación " +
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
            text: "La Presentación " + nombre + " no ha sido eliminado",
            icon: "error",
          });
        }
      });
  });

  $(document).on("click", ".editar_pre", (e) => {
    const elemento = $(this)[0].activeElement.parentElement.parentElement;
    const id = $(elemento).attr("preId");
    const nombre = $(elemento).attr("prenombre");
    $("#id_editar_pre").val(id);
    $("#nombre_pre").val(nombre);
    edit = true;
  });
});
