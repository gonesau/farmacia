$(document).ready(function(){
    // Funcion para buscar un usuario
    var funcion;
    function buscar_datos(consulta){   
        funcion = "buscar_usuario_adm";
        $.post('../controlador/UsuarioController.php',{consulta, funcion}, (response) => {
            const usuarios = JSON.parse(response);
            let template = '';
            usuarios.forEach(usuario => {
                template += `
                <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                    ${usuario.tipo}
                </div>
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
                  <div class="text-right">
                    <button class="btn btn-danger">
                        <i class="fas fa-trash"></i> Eliminar
                    </button>
                    <button class="btn btn-primary">
                        <i class="fas fa-edit"></i> Editar
                    </button>
                  </div>
                </div>
              </div>
            
                `;
            });
            $('#usuarios').html(template);
        });
    }
    $(document).on('keyup', '#buscar', function(){
        let valor = $(this).val();
        if(valor != ""){
            buscar_datos(valor);
        }
        else{
            buscar_datos(valor);
        }
    });
    buscar_datos();

})