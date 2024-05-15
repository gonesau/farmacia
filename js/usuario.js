$(document).ready(function(){
    var funcion = '';
    var id_usuario = $('#id_usuario').val();
    buscar_usuario(id_usuario);
    function buscar_usuario(dato){
        funcion = 'buscar_usuario';
        
        $.post('../controlador/UsuarioController.php',{dato, funcion},(response)=>{
            console.log(response);
            let nombre = '';
            let apellidos = '';
            let edad = '';
            let dui = '';
            let tipo = '';
            let telefono = '';
            let residencia = '';
            let correo = '';
            let sexo = '';
            let adicional = '';
            const usuario = JSON.parse(response);
            console.log(usuario);
            nombre += `${usuario.nombre}`;
            apellidos += `${usuario.apellidos}`;
            edad += `${usuario.edad}`;
            dui += `${usuario.dui}`;
            tipo += `${usuario.tipo}`;
            telefono += `${usuario.telefono}`;
            residencia += `${usuario.residencia}`;
            correo += `${usuario.correo}`;
            sexo += `${usuario.sexo}`;
            adicional += `${usuario.adicional}`;
            $('#nombre_us').html(nombre);
            $('#apellidos_us').html(apellidos);
            $('#edad').html(edad);
            $('#dui_us').html(dui);
            $('#us_tipo').html(tipo);
            $('#telefono_us').html(telefono);
            $('#residencia_us').html(residencia);
            $('#correo_us').html(correo);
            $('#sexo_us').html(sexo);
            $('#adicional_us').html(adicional);
        })
    }
});