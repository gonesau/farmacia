$(document).ready(function(){
    var funcion = '';
    var id_usuario = $('#id_usuario').val();
    function buscarUsuario(dato){
        funcion = 'buscar_usuario';
        $.post('../controlador/UsuarioController.php',{dato, funcion},(response)=>{
            let nombre = '';
            let apellido = '';
            let edad = '';
            let dui = '';
            let tipo = '';
            let telefono = '';
            let residencia = '';
            let correo = '';
            let sexo = '';
            let adicional = '';
            const usuario = JSON.parse(response);
            nombre += `${usuario.nombre}`;
            apellido += `${usuario.apellido}`;
            edad += `${usuario.edad}`;
            dui += `${usuario.dui}`;
            tipo += `${usuario.tipo}`;
            telefono += `${usuario.telefono}`;
            residencia += `${usuario.residencia}`;
            correo += `${usuario.correo}`;
            sexo += `${usuario.sexo}`;
            adicional += `${usuario.adicional}`;
        });
    }
});