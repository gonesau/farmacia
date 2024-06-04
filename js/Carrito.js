$(document).ready(function () {
  calcularTotal();
  Contar_productos();
  RecuperarLS_carrito();
  RecuperarLS_carrito_compra();

  $(document).on("click", ".agregar-carrito", (e) => {
    const elemento = $(e.currentTarget).closest("[prodId]");
    const id = $(elemento).attr("prodId");
    const nombre = $(elemento).attr("prodNombre");
    const concentracion = $(elemento).attr("prodConcentracion");
    const adicional = $(elemento).attr("prodAdicional");
    const precio = $(elemento).attr("prodPrecio");
    const laboratorio = $(elemento).attr("prodLaboratorio");
    const tipo = $(elemento).attr("prodtipo");
    const presentacion = $(elemento).attr("prodPresentacion");
    const avatar = $(elemento).attr("prodAvatar");
    const stock = $(elemento).attr("prodStock");
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
      stock: stock,
      cantidad: 1,
    };

    let id_producto;
    let productos;
    productos = RecuperarLS();
    productos.forEach((prod) => {
      if (prod.id === producto.id) {
        id_producto = prod.id;
      }
    });
    if (id_producto === producto.id) {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "El producto ya se encuentra en el carrito",
        footer: "Verifique el carrito de compras",
      });
    } else {
      let template = `
        <tr prodId = "${producto.id}">
            <td>${producto.id}</td>
            <td>${producto.nombre}</td>
            <td>${producto.concentracion}</td>
            <td>${producto.adicional}</td>
            <td>${producto.precio}</td>
            <td><button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button></td>
        </tr>
    `;
      $("#lista").append(template);
      AgregarLS(producto);
      Contar_productos();
    }
  });

  $(document).on("click", ".borrar-producto", (e) => {
    const elemento = $(e.currentTarget).closest("tr");
    const id = $(elemento).attr("prodId");
    elemento.remove();
    Eliminar_producto_LS(id);
    Contar_productos();
    calcularTotal();
  });

  $(document).on("click", "#vaciar_carrito", (e) => {
    $("#lista").empty();
    Eliminar_LS();
    Contar_productos();
  });

  $(document).on("click", "#procesar_pedido", (e) => {
    Procesar_pedido();
  });

  $(document).on("click", "#procesar-compra", (e) => {
    Procesar_compra();
  });

  function RecuperarLS() {
    let productos;
    if (localStorage.getItem("productos") === null) {
      productos = [];
    } else {
      productos = JSON.parse(localStorage.getItem("productos")) || [];
    }
    return productos;
  }

  function AgregarLS(producto) {
    let productos = RecuperarLS();
    productos.push(producto);
    localStorage.setItem("productos", JSON.stringify(productos));
  }


  //Versión solo Local Storage
  function RecuperarLS_carrito() {
    let productos;
    productos = RecuperarLS();
    productos.forEach((producto) => {
      let template = `
                      <tr prodId = "${producto.id}">
                          <td>${producto.id}</td>
                          <td>${producto.nombre}</td>
                          <td>${producto.concentracion}</td>
                          <td>${producto.adicional}</td>
                          <td>${producto.precio}</td>
                          <td><button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button></td>
                      </tr>
                  `;
      $("#lista").append(template);
    });
  }

  //Versión de POST más local Storage
  /*   function RecuperarLS_carrito() {
      let productos, id_producto;
      productos = RecuperarLS();
      funcion = "buscar_id";
      productos.forEach(producto => {
        id_producto = producto.id;
        $.post('../controlador/ProductoController.php', { funcion, id_producto }, (response) => {
          //console.log(response);
          let template_carrito = '';
          let json = JSON.parse(response);
          template_carrito = `
                <tr prodId="${json.id}">
                  <td>${json.id}</td>
                  <td>${json.nombre}</td>
                  <td>${json.concentracion}</td>
                  <td>${json.adicional}</td>
                  <td>${json.precio}</td>
                  <td><button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button></td>
                </tr>
              `;
          $('#lista').append(template_carrito);
        });
      });
    }
   */

  function Eliminar_producto_LS(id) {
    let productos;
    productos = RecuperarLS();
    productos.forEach(function (producto, index) {
      if (producto.id === id) {
        productos.splice(index, 1);
      }
    });
    localStorage.setItem("productos", JSON.stringify(productos));
  }

  function Eliminar_LS() {
    localStorage.clear();
  }

  function Contar_productos() {
    let productos;
    let contador = 0;
    productos = RecuperarLS();
    productos.forEach((producto) => {
      contador++;
    });
    $("#contador").html(contador);
  }

  function Procesar_pedido() {
    let productos;
    productos = RecuperarLS();
    if (productos.length === 0) {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "No hay productos en el carrito",
        footer: "Agregue productos al carrito",
      });
    } else {
      location.href = "../vista/adm_compra.php";
    }
  }

  //Versión solo Local Storage
  function RecuperarLS_carrito_compra() {
    let productos;
    productos = RecuperarLS();
    let template = '';
    productos.forEach((producto) => {
      template = `
                    <tr prodId = "${producto.id}">
                        <td>${producto.nombre}</td>
                        <td>${producto.stock}</td>
                        <td>${producto.precio}</td>
                        <td>${producto.concentracion}</td>
                        <td>${producto.adicional}</td>
                        <td>${producto.laboratorio}</td>
                        <td>${producto.presentacion}</td>
                        <td>
                            <input type="number" min="1" class="form-control cantidad_producto" value="${producto.cantidad}">
                        </td>
                        <td class="subtotales">
                        <h5>${(producto.precio * producto.cantidad).toFixed(2)}</h5>
                        </td>
                        <td><button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button></td>
                    </tr>
                `;
      $("#lista-compra").append(template);
    });
  };

  //Versión de POST más local Storage
  //de RecuperarLS_carrito_compra()
  /* 
    function RecuperarLS_carrito_compra() {
      let productos = RecuperarLS();
      //console.log(productos);
      let funcion = "buscar_id";
  
      productos.forEach((producto, index) => {
        let id_producto = producto.id;
        console.log(producto.cantidad);
        $.post('../controlador/ProductoController.php', { funcion, id_producto }, (response) => {
          //console.log(response);
          let json = JSON.parse(response);
  
          // Actualizar el precio en localStorage
          productos[index].precio = json.precio;
  
          // Crear el template con los datos del servidor
          let template_compra = `
                    <tr prodId="${producto.id}" prodPrecio="${json.precio}">
                        <td>${json.nombre}</td>
                        <td>${json.stock}</td>
                        <td>${json.precio}</td>
                        <td>${json.concentracion}</td>
                        <td>${json.adicional}</td>
                        <td>${json.laboratorio}</td>
                        <td>${json.presentacion}</td>
                        <td>
                            <input type="number" min="1" class="form-control cantidad_producto" value="${producto.cantidad}">
                        </td>
                        <td class="subtotales">
                            <h5>${(json.precio * producto.cantidad).toFixed(2)}</h5>
                        </td>
                        <td><button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button></td>
                    </tr>
                `;
          $('#lista-compra').append(template_compra);
  
          // Actualizar el localStorage con el nuevo precio
          localStorage.setItem('productos', JSON.stringify(productos));
        });
      });
    };
   */

  $(document).on('click', '#actualizar', (e) => {
    let productos, precios;
    precios = document.querySelectorAll('.precio');
    productos = RecuperarLS();
    productos.forEach(function (producto, indice) {
      producto.precio = precios[indice].textContent;
    });
    localStorage.setItem('productos', JSON.stringify(productos));
    calcularTotal();
  });

  //versión original
  $('#cp input').on("input", function () {
    let id, cantidad, producto, productos, montos;
    producto = $(this).closest("tr"); // Obtener el elemento tr más cercano que contiene el input
    id = $(producto).attr("prodId");
    cantidad = $(this).val(); // Obtener el valor del input
    montos = document.querySelectorAll(".subtotales");
    productos = RecuperarLS();
    productos.forEach(function (prod, index) {
      if (prod.id === id) {
        prod.cantidad = cantidad;
        montos[index].innerHTML = `<h5>${(cantidad * productos[index].precio).toFixed(2)}</h5>`;
      }
    });
    localStorage.setItem("productos", JSON.stringify(productos));
    calcularTotal();
  });


  /* 
  $('#cp input').keyup((e) => {
    let id, cantidad, producto, montos;
    producto = $(this)[0].activeElement.parentElement.parentElement;
    id = $(producto).attr('prodId');
    cantidad = producto.querySelector('input').value();
    montos = document.querySelectorAll('.subtotales');
    productos = RecuperarLS();
    productos.forEach(function (prod, indice) {
      if (prod.id === id) {
        prod.cantidad = cantidad;
        montos[indice].innerHTML = `<h5>${cantidad * productos[indice].precio}</h5>`;
      }
    });
    localStorage.setItem('productos', JSON.stringify(productos));
  });
 */

  //Versión original de calcularTotal()
  function calcularTotal() {
    let productos, subtotal, con_iva, total_sin_descuento;
    let pago, vuelto, descuento;
    let total = 0, iva = 0.13;
    productos = RecuperarLS();
    productos.forEach(producto => {
      let subtotal_producto = Number(producto.precio * producto.cantidad);
      total = total + subtotal_producto;
    });
    pago = $('#pago').val();

    descuento = $('#descuento').val();
    total_sin_descuento = total.toFixed(2);
    con_iva = parseFloat(total * iva).toFixed(2);
    subtotal = parseFloat(total - con_iva).toFixed(2);

    total = total - descuento;
    vuelto = pago - total;

    $('#subtotal').html(subtotal);
    $('#con_iva').html(con_iva);
    $('#total_sin_descuento').html(total_sin_descuento);

    $('#total').html(total.toFixed(2));
    $('#vuelto').html(vuelto.toFixed(2));
  }

  function Procesar_compra() {
    let nombre, dni;
    nombre = $('#cliente').val();
    dni = $('#dni').val();

    if (RecuperarLS().length == 0) {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'No hay productos, debe seleccionar algunos!',
      })
        .then(function () {
          location.href = '../vista/adm_catalogo.php';
        });

    } else if (nombre == '') {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Debe ingresar el nombre del cliente',
      });
    } else {
      VerificarStock().then(result => {
        let conflictoStock = false;
        let mensajeError = '';

        result.forEach(item => {
          if (!item.suficiente) {
            conflictoStock = true;
            mensajeError += `Producto: ${item.nombre}, Cantidad Solicitada: ${item.cantidad_solicitada}, Stock Disponible: ${item.stock_disponible}\n`;
          }
        });

        if (!conflictoStock) {
          Registrar_compra(nombre, dni);
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Se realizo la compra',
            showConfirmButton: false,
            timer: 1500,
          }).then(function () {
            Eliminar_LS();
            location.href = '../vista/adm_catalogo.php';
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Hay conflicto en el stock:\n' + mensajeError
          });
        }
      }).catch(error => {
        console.error('Error en VerificarStock:', error);
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Ocurrió un error al verificar el stock',
        });
      });
    }
  }
  /* 
    async function VerificarStock() {
      let productos;
      funcion = 'verificar_stock';
      productos = RecuperarLS();
      const response = await fetch('../controlador/ProductoController.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'funcion=' + funcion + '&&productos=' + JSON.stringify(productos)
      });
      let error = await response.text();
      return error;
    } */

  async function VerificarStock() {
    const funcion = 'verificar_stock';
    const productos = RecuperarLS();
    const response = await fetch('../controlador/ProductoController.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: 'funcion=' + funcion + '&productos=' + JSON.stringify(productos)
    });
    const result = await response.json();
    return result;
    /* result.forEach(item => {
      console.log(`ID Producto: ${item.id}`);
      console.log(`Cantidad Solicitada: ${item.cantidad_solicitada}`);
      console.log(`Stock Disponible: ${item.stock_disponible}`);
      console.log(`Suficiente: ${item.suficiente ? 'Sí' : 'No'}`);
    }); */
  }

  function Registrar_compra(nombre, dui) {
    funcion = 'registrar_compra';
    let total = $('#total').get(0).textContent;
    let productos = RecuperarLS();
    let json = JSON.stringify(productos);
    $.post('../controlador/CompraController.php', { funcion, total, nombre, dui, json }, (response) => {
      console.log(response);
    });
  }

});
