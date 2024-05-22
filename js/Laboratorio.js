$(document).ready(function () {
    var funcion = "";

    // Función que se ejecuta al hacer clic en el botón btn_crear_usuario
    $("#form-crear-laboratorio").submit((e) => {
        e.preventDefault();
        let nombre_laboratorio = $("#nombre_laboratorio").val();
        funcion = "crear";
        $.post(
            "../controlador/LaboratorioController.php",
            { nombre_laboratorio, funcion },
            (response) => {
                console.log(response);
                if (response.trim() == "add") {
                    $("#add-laboratorio").hide("slow");
                    $("#add-laboratorio").show(1000);
                    $("#add-laboratorio").hide(2000);
                    $("#form-crear-laboratorio").trigger("reset");
                } else {
                    $("#noadd-laboratorio").hide("slow");
                    $("#noadd-laboratorio").show(1000);
                    $("#noadd-laboratorio").hide(2000);
                    $("#form-crear-laboratorio").trigger("reset");
                }
            }
        );
    });
});

