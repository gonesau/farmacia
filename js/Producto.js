$(document).ready(function () {
	var funcion;
	var edit = false;

	$(".select2").select2;
	rellenar_Laboratorios();
	rellenar_tipos();
	rellenar_presentaciones();
	rellenar_Proveedores();
	buscar_producto();



	function rellenar_Proveedores() {
		funcion = "rellenar_proveedores";
		$.post(
			"../controlador/ProveedorController.php",
			{ funcion },
			(response) => {
				const proveedores = JSON.parse(response);
				let template = "";
				proveedores.forEach((proveedor) => {
					template += `
				<option value="${proveedor.id}">${proveedor.nombre}</option>
			 `;
				});
				$("#proveedor").html(template);
			}
		);
	}


	function rellenar_Laboratorios() {
		funcion = "rellenar_laboratorios";
		$.post(
			"../controlador/LaboratorioController.php",
			{ funcion },
			(response) => {
				const laboratorios = JSON.parse(response);
				let template = "";
				laboratorios.forEach((laboratorio) => {
					template += `
				<option value="${laboratorio.id}">${laboratorio.nombre}</option>
			 `;
				});
				$("#laboratorio").html(template);
			}
		);
	}
	function rellenar_tipos() {
		funcion = "rellenar_tipos";
		$.post("../controlador/TipoController.php", { funcion }, (response) => {
			const tipos = JSON.parse(response);
			let template = "";
			tipos.forEach((tipo) => {
				template += `
				<option value="${tipo.id}">${tipo.nombre}</option>
			 `;
			});
			$("#tipo").html(template);
		});
	}
	function rellenar_presentaciones() {
		funcion = "rellenar_presentaciones";
		$.post(
			"../controlador/PresentacionController.php",
			{ funcion },
			(response) => {
				const presentaciones = JSON.parse(response);
				let template = "";
				presentaciones.forEach((presentacion) => {
					template += `
				<option value="${presentacion.id}">${presentacion.nombre}</option>
			 `;
				});
				$("#presentacion").html(template);
			}
		);
	}

	$("#form-crear-producto").submit((e) => {
		let id = $("#id_edit_prod").val();
		let nombre = $("#nombre_producto").val();
		let concentracion = $("#concentracion").val();
		let adicional = $("#adicional").val();
		let precio = $("#precio").val();
		let laboratorio = $("#laboratorio").val();
		let tipo = $("#tipo").val();
		let presentacion = $("#presentacion").val();
		if (edit == true) {
			funcion = "editar";
			edit = false;
		} else {
			funcion = "crear";
		}
		$.post(
			"../controlador/ProductoController.php",
			{
				funcion,
				id,
				nombre,
				concentracion,
				adicional,
				precio,
				laboratorio,
				tipo,
				presentacion,
			},
			(response) => {
				if (response == "add") {
					$("#add").hide("slow");
					$("#add").show(1000);
					$("#add").hide(2000);
					$("#form-crear-producto").trigger("reset");
					buscar_producto();
				}
				if (response == "edit") {
					$("#edit_prod").hide("slow");
					$("#edit_prod").show(1000);
					$("#edit_prod").hide(2000);
					$("#form-crear-producto").trigger("reset");
					buscar_producto();
				}
				if (response == "noadd") {
					$("#noadd").hide("slow");
					$("#noadd").show(1000);
					$("#noadd").hide(2000);
					$("#form-crear-producto").trigger("reset");
				}
				if (response == "noedit") {
					$("#noedit_prod").hide("slow");
					$("#noedit_prod").show(1000);
					$("#noedit_prod").hide(2000);
					$("#form-crear-producto").trigger("reset");
				}
				edit = false;

				buscar_producto();
			}
		);
		e.preventDefault();
	});

	// Producto.js
	function buscar_producto(consulta) {
		funcion = "buscar";
		$.post(
			"../controlador/ProductoController.php",
			{ consulta, funcion },
			(response) => {
				const productos = JSON.parse(response);
				let template = "";
				productos.forEach((producto) => {
					template += `
		<div prodId="${producto.id}" prodNombre="${producto.nombre}" 
		prodPrecio="${producto.precio}" prodConcentracion="${producto.concentracion}" 
		prodAdicional="${producto.adicional}" prodLaboratorio="${producto.laboratorio_id}" 
		prodtipo="${producto.tipo_id}" prodPresentacion="${producto.presentacion_id}" prodAvatar="${producto.avatar}"
		class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
		<div class="card bg-light d-flex flex-fill">
		    <div class="card-header text-muted border-bottom-0">
			   <i class="fas fa-lg fa-cubes mr-1"></i>${producto.stock}
		    </div>
		    <div class="card-body pt-0">
			   <div class="row">
				  <div class="col-7">
					 <h2 class="lead"><b>${producto.nombre}</b></h2>
					 <h4 class="lead"><b><i class="fas fa-lg fa-dollar-sign mr-1"></i>${producto.precio}</b></h2>
						<ul class="ml-4 mb-0 fa-ul text-muted">
						    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mortar-pestle"></i></span>
							   Concentracion: ${producto.concentracion}</li>
						    <li class="small"><span class="fa-li"><i
									 class="fas fa-lg fa-prescription-bottle-alt"></i></span> Adicional:
							   ${producto.adicional}</li>
						    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-flask"></i></span> Laboratorio:
							   ${producto.laboratorio}</li>
						    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-copyright"></i></span> Tipo:
							   ${producto.tipo}</li>
						    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-pills"></i></span>
							   Presentacion: ${producto.presentacion}</li>
						</ul>
				  </div>
				  <div class="col-5 text-center">
					 <img src="${producto.avatar}" class="img-circle img-fluid">
				  </div>
			   </div>
		    </div>
		    <div class="card-footer">
			   <div class="text-right">
				  <button class="avatar btn btn-sm bg-teal" type="button" data-toggle="modal" data-target="#cambiologo">
					 <i class="fas fa-image"></i>
				  </button>
				  <button class="editar btn btn-sm btn-success type="button" data-toggle="modal" data-target="#crearproducto">
					 <i class="fas fa-pencil-alt"></i>
				  </button>
				  <button class="lote btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#crearlote">
					 <i class="fas fa-plus-square"></i>
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
				$("#productos").html(template);
			}
		);
	}

	$(document).on("keyup", "#buscar-producto", function () {
		let valor = $(this).val();
		if (valor != "") {
			buscar_producto(valor);
		} else {
			buscar_producto();
		}
	});

	$(document).on("click", ".avatar", (e) => {
		const funcion = "cambiar_avatar";
		const elemento = $(e.currentTarget).closest("[prodId]");
		const id = $(elemento).attr("prodId");
		const avatar = $(elemento).attr("prodAvatar");
		const nombre = $(elemento).attr("prodNombre");
		$("#funcion").val(funcion);
		$("#id_logo_prod").val(id); // Corregir ID
		$("#avatar").val(avatar);
		$("#logoactual").attr("src", avatar); // Añadir '#'
		$("#nombre_logo").html(nombre);
	});

	$(document).on("click", ".lote", (e) => {
		const elemento = $(e.currentTarget).closest("[prodId]");
		const id = $(elemento).attr("prodId");
		const nombre = $(elemento).attr("prodNombre");
		$("#id_lote_prod").val(id);
		$("#nombre_producto_lote").html(nombre);

	});




	$("#form_logo").submit((e) => {
		e.preventDefault(); // Mover preventDefault al principio
		let formData = new FormData($("#form_logo")[0]);
		$.ajax({
			url: "../controlador/ProductoController.php",
			type: "POST",
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
		}).done(function (response) {
			const json = JSON.parse(response);
			if (json.alert == "edit") {
				$("#logoactual").attr("src", json.ruta);
				$("#edit-prod").hide("slow").show(1000).hide(2000);
				$("#form_logo").trigger("reset");
				buscar_producto();
			}
			if (json.alert == "noedit") {
				$("#noedit-prod").hide("slow").show(1000).hide(2000);
				$("#form_logo").trigger("reset");
			}
		});
		e.preventDefault();
	});

	// Producto.js
	$(document).on("click", ".editar", (e) => {
		const elemento = $(e.currentTarget).closest("[prodId]");
		const id = $(elemento).attr("prodId");
		const nombre = $(elemento).attr("prodNombre");
		const concentracion = $(elemento).attr("prodConcentracion");
		const adicional = $(elemento).attr("prodAdicional");
		const precio = $(elemento).attr("prodPrecio"); // Asegúrate de que el atributo está correcto
		const laboratorio = $(elemento).attr("prodLaboratorio");
		const tipo = $(elemento).attr("prodtipo");
		const presentacion = $(elemento).attr("prodPresentacion");

		$("#id_edit_prod").val(id);
		$("#nombre_producto").val(nombre);
		$("#concentracion").val(concentracion);
		$("#adicional").val(adicional);
		$("#precio").val(precio); // Aquí se asigna el precio
		$("#laboratorio").val(laboratorio).trigger("change");
		$("#tipo").val(tipo).trigger("change");
		$("#presentacion").val(presentacion).trigger("change");
		edit = true;
	});

	$(document).on("click", ".borrar", (e) => {
		funcion = "borrar";
		const elemento = $(e.currentTarget).closest("[prodId]");
		const id = $(elemento).attr("prodId");
		const nombre = $(elemento).attr("prodNombre");
		const avatar = $(elemento).attr("prodAvatar");
		console.log(id);
		const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: "btn btn-success",
				cancelButton: "btn btn-danger mr-1",
			},
			buttonsStyling: false,
		});
		swalWithBootstrapButtons
			.fire({
				title: "Estás seguro de eliminar el producto " + nombre + "?",
				text: "No podrás revertir esto!",
				imageUrl: avatar,
				imageWidth: 100,
				imageHeight: 100,
				showCancelButton: true,
				confirmButtonText: "Si, borrar producto",
				cancelButtonText: "No, cancelar",
				reverseButtons: true,
			})
			.then((result) => {
				if (result.isConfirmed) {
					$.post(
						"../controlador/ProductoController.php",
						{ id, funcion },
						(response) => {
							edit = false;
							if (response.trim() == "borrado") {
								swalWithBootstrapButtons.fire({
									title: "Eliminado",
									text: "El producto " + nombre + " ha sido eliminado",
									icon: "success",
								});

								buscar_producto();
							} else {
								swalWithBootstrapButtons.fire({
									title: "Error",
									text:
										"El producto " +
										nombre +
										" no ha sido eliminado porque tiene lotes asociados",
									icon: "error",
								});
							}
						}
					);
				} else if (result.dismiss === Swal.DismissReason.cancel) {
					swalWithBootstrapButtons.fire({
						title: "Cancelado",
						text: "El producto " + nombre + " no ha sido eliminado",
						icon: "error",
					});
				}
			});
	});


	$("#form-crear-lote").submit((e) => {
		let id_producto = $("#id_lote_prod").val();
		let proveedor = $("#proveedor").val();
		let stock = $("#stock").val();
		let vencimiento = $("#vencimiento").val();
		let funcion = "crear_lote"; // Asegúrate de usar 'crear_lote'

		$.post(
			"../controlador/LoteController.php",
			{ funcion, id_producto, proveedor, stock, vencimiento },
			(response) => {
				console.log("Respuesta del servidor: ", response);
				if (response.trim() === "add") {
					$("#add_lote").hide("slow");
					$("#add_lote").show(1000);
					$("#add_lote").hide(2000);
					$("#form-crear-lote").trigger("reset");
					buscar_producto(); // Verifica que esta función no recarga la página
				} else {
					console.log('Error al agregar lote');
				}
			}
		);
		e.preventDefault();
	});



});
