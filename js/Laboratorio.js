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
            {nombre_laboratorio, funcion},
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
    function buscar_lab(consulta){
        funcion = "buscar";
        $.post(
            "../controlador/LaboratorioController.php",{consulta, funcion}, (response) => {
                const laboratorios = JSON.parse(response);
                let template = "";
                laboratorios.forEach((laboratorio) => {
                    template += `
                        <tr labId="${laboratorio.id}">
                            <td>${laboratorio.nombre}</td>
                            <td>
                                <img src="${laboratorio.avatar}" class="img-fluid rounded-1" width="50" height="50">
                            </td>
                            <td>
                                <button type="button" class="avatar btn btn-info btn-sm editar" title="Editar logo"> <i class="far fa-image"> </i> </button>
                                <button type="button" class="editar btn btn-warning btn-sm editar" title="Editar laboratorio"> <i class="fas fa-edit"> </i> </button>
                                <button type="button" class="borrar btn btn-danger btn-sm borrar" title="Eliminar laboratorio"><i class="fa fa-trash"> </i></button>
                            </td>
                        </tr>
                    `;
                });
                $("#laboratorios").html(template);
                
            });
    }

    $(document).on("keyup", "#buscar_laboratorio", function () {
        let valor = $(this).val();
        if (valor != "") {
            buscar_lab(valor);

        } else {
            buscar_lab();
        }
    });  



});

