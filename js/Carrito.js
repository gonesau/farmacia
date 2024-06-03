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

  function RecuperarLS() {
    let productos;
    if (localStorage.getItem("productos") === null) {
      productos = [];
    } else {
      productos = JSON.parse(localStorage.getItem("productos"));
    }
    return productos;
  }

  function AgregarLS(producto) {
    let productos = RecuperarLS();
    productos.push(producto);
    localStorage.setItem("productos", JSON.stringify(productos));
  }

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

  //NO FUNCIONAL !!!
  //Obtiene los datos por medio de una consulta
  /* //function RecuperarLS_carrito()
    function RecuperarLS_carrito() {
      let productos, id_producto;
      productos = RecuperarLS();
      funcion = "buscar_id";
      productos.forEach(producto => {
        id_producto = producto.id;
        $.post('../controlador/ProductoController.php', { funcion, id_producto }, (response) => {
          // console.log(response);
          let template = '';
          let json = JSON.parse(response);
          template = `
            <tr prodId="${producto.id}">
              <td>${producto.id}</td>
              <td>${producto.nombre}</td>
              <td>${producto.concentracion}</td>
              <td>${producto.adicional}</td>
              <td>${json.precio}</td>
              <td><button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button></td>
            </tr>
          `;
          $('#lista').append(template);
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
                      <h5>${producto.precio * producto.cantidad}</h5>
                      </td>
                      <td><button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button></td>
                  </tr>
              `;
      $("#lista-compra").append(template);
    });
  }

  //NO FUNCIONAL !!!
  //Obtiene los datos realizando una consulta a la base de datos
  //Obteniendo principalmente el precio actualizado del producto
  //Al momento que se hace la consulta, pero no se ejecuta el calculo de los subtotales
  /* //function RecuperarLS_carrito_compra
  function RecuperarLS_carrito_compra() {
    let productos, id_producto;
    productos = RecuperarLS();
    funcion = "buscar_id";
    productos.forEach(producto => {
      id_producto = producto.id;
      $.post('../controlador/ProductoController.php', { funcion, id_producto }, (response) => {
        // console.log(response);
        let template = '';
        let json = JSON.parse(response);
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
                      <input type="number" min="1" class="form-control 
                      cantidad_producto" value="${json.cantidad}">
                  </td>
                  <td class="subtotales">
                    <h5>${json.precio * json.cantidad}</h5>
                  </td>
                  <td><button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button></td>
                </tr>
                `;
        $('#lista-compra').append(template);
      });
    });
  };
  */

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
        montos[index].innerHTML = `<h5>${cantidad * productos[index].precio}</h5>`;
      }
    });
    localStorage.setItem("productos", JSON.stringify(productos));
    calcularTotal();
  });

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
    // console.log(total);
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

});


/*
  $('#cp').keyup((e) => {
    let id, cantidad, producto, productos, montos;
    producto = $(this)[0].activeElement.parentElement.parentElement;
    id = $(producto).attr("prodId");
    cantidad = producto.querySelector('input').value(); // Obtener el valor del input
    montos = document.querySelectorAll(".subtotales");
    productos = RecuperarLS();
    productos.forEach(function (prod, indice) {
      if (prod.id === id) {
        prod.cantidad = cantidad;
        montos[indice].innerHTML = `
        <h5>${cantidad * productos[indice].precio}</h5>
        `;
      }
    });
    localStorage.setItem('productos', JSON.stringify(productos));
  });
 */





/*
  $('#cp').keyup((e) => {
    let id, cantidad, producto, productos, montos;
    // producto = $(this)[0].activeElement.parentElement.parentElement;
    producto = $(this).closest("tr");
    id = $(producto).attr("prodId");
    cantidad = producto.querySelector('input').value(); // Obtener el valor del input
    montos = document.querySelectorAll(".subtotales");
    productos = RecuperarLS();
    productos.forEach(function (prod, index) {
      if (prod.id === id) {
        prod.cantidad = cantidad;
        montos[index].innerHTML = `<h5>${cantidad * productos[index].precio}</h5>`;
      }
    });
    localStorage.setItem("productos", JSON.stringify(productos));
  });
 
 */
