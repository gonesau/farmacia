$(document).ready(function () {
    let funcion = "listar";
    $.post('../controlador/VentaController.php', { funcion }, (response) => {
        console.log(JSON.parse(response));
    });

    $('#tabla_venta').DataTable({
        "ajax": {
            "url": "../controlador/VentaController.php",
            "method": "POST",
            "data": { funcion: funcion }
        },
        "columns": [
            { "data": "id_venta" },
            { "data": "fecha" },
            { "data": "cliente" },
            { "data": "dui" },
            { "data": "total" },
            { "data": "vendedor" },
        ]
    });
});