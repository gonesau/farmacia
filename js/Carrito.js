$(document).ready(function () {



    $(document).on('click', '.agregar-carrito', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr("prodId");
        const nombre = $(elemento).attr("prodNombre");
        const concentracion = $(elemento).attr("prodConcentracion");
        const adicional = $(elemento).attr("prodAdicional");
        const precio = $(elemento).attr("prodPrecio");
        const laboratorio = $(elemento).attr("prodLaboratorio");
        const tipo = $(elemento).attr("prodtipo");
        const presentacion = $(elemento).attr("prodPresentacion");
        const avatar = $(elemento).attr("prodAvatar");

        const producto = {
            id: id,
            nombre: nombre,
            concentracion: concentracion,
            adicional: adicional,
            precio: precio,
            laboratorio: laboratorio,
            tipo: tipo,
            presentacion: presentacion,
            avatar: avatar,
            cantidad: 1
        };
        template = `
            <tr>
                <td>${producto.id}</td>
                <td>${producto.nombre}</td>
                <td>${producto.concentracion}</td>
                <td>${producto.adicional}</td>
                <td>${producto.precio}</td>
                <td><button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></td>
            </tr>
        `;
        $('#lista').append(template);
    });
    $(document).on('click', '.borrar-producto', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        elemento.remove();
    });

    $(document).on('click','#vaciar_carrito', (e) => {
        $('#lista').empty();
    });

});