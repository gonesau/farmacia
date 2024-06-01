$(document).ready(function () {
    var funcion;

    buscar_lote();

    function buscar_lote(consulta) {
        let funcion = "buscar";
        $.post("../controlador/LoteController.php", { consulta, funcion }, (response) => {
            console.log(response); // Añadir esta línea para ver los datos en la consola
            //El try es para identificar errores
            try {
                const lotes = JSON.parse(response);
                if (lotes.error) {
                    throw new Error(lotes.error);
                }
                let template = "";
                lotes.forEach((lote) => {
                    const mes = lote.mes !== undefined ? lote.mes : 0;
                    const dia = lote.dia !== undefined ? lote.dia : 0;

                    template += `
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                    `;
                    if (lote.estado == 'light') {
                        template += `<div class="card bg-light">`;
                    }
                    if (lote.estado == 'danger') {
                        template += `<div class="card bg-danger">`;
                    }
                    if (lote.estado == 'warning') {
                        template += `<div class="card bg-warning">`;
                    }

                    // template += `<div class="card bg-ligth d-flex flex-fill">`;
                    template += `
                        <div class="card-header border-bottom-0">
                            <i class="fas fa-lg fa-cubes mr-1"></i>${lote.stock}
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b>${lote.nombre}</b></h2>
                                    <ul class="ml-4 mb-0 fa-ul">
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mortar-pestle"></i></span> Concentracion: ${lote.concentracion}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-prescription-bottle-alt"></i></span> Adicional: ${lote.adicional}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-flask"></i></span> Laboratorio: ${lote.laboratorio}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-copyright"></i></span> Tipo: ${lote.tipo}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-pills"></i></span> Presentacion: ${lote.presentacion}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-calendar-times"></i></span> Vencimiento: ${lote.vencimiento}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-truck"></i></span> Proveedor: ${lote.proveedor}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-calendar-alt"></i></span> Mes: ${lote.mes}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-calendar-day"></i></span> Dia: ${lote.dia}</li>
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <img src="${lote.logo}" class="img-circle img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <button class="editar btn btn-sm btn-success type="button" data-toggle="modal" data-target="#crearlote">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="borrar btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                `;
                });
                $("#lotes").html(template);
            }
            catch (e) {
                console.error('Error parsing JSON:', e);
                alert('Error processing data from server.');
            }
        }).fail((xhr, status, error) => {
            console.error('AJAX error:', status, error);
            alert('An error occurred while fetching data from server.');
        });
    }

    $(document).on("keyup", "#buscar_lote", function () {
        let valor = $(this).val();
        if (valor != "") {
            buscar_lote(valor);
        } else {
            buscar_lote();
        }
    });
});
