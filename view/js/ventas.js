let stock = "";
let codigoProducto = "";
let codigoInventario = "";
let descuento = "";


// Creamos un array vacío
const arrayProductos = [];

$(".btnAgregarProducto1").click(function(){
    
	let idProducto = document.getElementById("idProducto").value;
	
    var datas = new FormData();
	
    datas.append("idProducto", idProducto);

    $.ajax({

        url:"ajax/inventarioAjax.php",
        method:"POST",
        data: datas,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
			console.log("respuestaAa",respuesta);
			codigoInventario = respuesta["codigo"];
			stock = respuesta["cantidad"];

			llenarTablaVentas();
			
        }

    })
	
})

/*=============================================
BOTON PARA AGREGAR PRODUCTOS A LA TABLA
=============================================*/

function llenarTablaVentas(){

	var idProduct = document.getElementById("idProducto").value;
	var cantidad = document.getElementById("cantidadProducto").value;

	if(idProduct != ""){


		console.log("idProduct ",idProduct)

		var datas = new FormData();

		datas.append("idProduct", idProduct);

		$.ajax({

			url:"ajax/productAjax.php",
			method:"POST",
			data: datas,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",

			success: function(respuesta){ //vienen los datos del producto que se digito
				
				if(respuesta != false){//comprueba que existe el producto

					//console.log("respuesta", respuesta);
					codigoProducto = respuesta["codigo"];
					let descripcion = respuesta["descripcion"];
					let precio = respuesta["precioTotal"];
					let porDescuento = "0";
					let descuento = "0";
					let subTotal = parseInt(precio)*cantidad;
					
					//verifica si existe el codigo del producto en la tabla de ventas
					if ($('.tablita #listaP'+codigoProducto).length) { 
						let tr = document.querySelector('#listaP'+codigoProducto);

						let td = tr.querySelector('.cantidadProducto');

						let cantidadProducto = parseInt(td.textContent) + parseInt(cantidad);

						subTotal = parseInt(precio)*cantidadProducto;

						//se modifica el contenido de la tabla
						$('.tablita #listaP'+codigoProducto+' td:eq(2)').text(cantidadProducto);

						$('.tablita #listaP'+codigoProducto+' td:eq(5)').text(	);

						

					}else{
						
						$(".tablita").append(

							'<tr id="listaP'+codigoProducto+'">'+
					
								'<td>'+codigoProducto+'</td>'+
								'<td class="descripcionProducto">'+descripcion+'</td>'+
								'<td class="cantidadProducto">'+cantidad+'</td>'+
								'<td class="descuentoProducto"><input type="number" min="0" max="100" step="1" value="'+0+'" class="descuentoInput"></td>'+
								'<td class="precioProducto">'+precio+'</td>'+
								'<td class="subTotalProducto">'+subTotal+'</td>'+
								'<td><button type="button" class="btn btn-danger d-flex justify-content-center quitarProducto" style="width:40px; height:35px; text-align:center;" idProduct="'+codigoProducto+'"><i class="fa fa-times fa-xs"></i></button></td>'+
		
							'</tr>')

					}

							
						cantidadMayorStock()
							
						sumarTotalPrecios()
							
						listarProductos()
						
				}

			}

    	})
	}
}




/*=============================================
QUITAR PRODUCTOS DE LA TABLA
=============================================*/

function eliminarFila(idProduct) {
	let tr = document.querySelector('#listaP' + idProduct);

	let index = arrayProductos.findIndex(producto => producto.idProducto === idProduct);

	if (index !== -1) {
		if (tr) {
			arrayProductos.splice(index, 1);
			tr.remove();
			sumarTotalPrecios();
		  }
	}
  }

/*======================================================
CLICK AL BOTON DE QUITAR PRODUCTOS DE LA TABLA DE VENTAS
========================================================*/

$('.tableU').on('click', 'button.quitarProducto', function() {
	var idProduct = $(this).attr('idProduct');
	eliminarFila(idProduct);
  });

/*=============================================
SUMAR LOS PRECIOS DE LOS PRODUCTOS PARA EL TOTAL
=============================================*/

function sumarTotalPrecios(){

	var precios = document.querySelectorAll(".tableU td.subTotalProducto"); //se coloca la class de la tabla y la class del td

	var total = 0;

	precios.forEach(function(precio) {
		total += parseFloat(precio.textContent);
	});

	//console.log("El total es",total);

	$("#nuevoTotalVenta").val(total);

}


/*================================================================
FUNCION PARA VERIFICAR SI HAY LOS SUFICIENTES PRODUCTOS EN STOCK
==================================================================*/

function cantidadMayorStock(){

	let tr = document.querySelector('#listaP'+codigoProducto);

	//console.log("TR", tr);

	let td = tr.querySelector('.cantidadProducto');

	let cantidades = td.textContent;

	console.log("stock", stock);
	console.log("cantidades", cantidades);

	if(stock < parseInt(cantidades)){
		Swal.fire({
			title: 'No hay suficientes productos en el inventario',
			html: 'Solo hay '+stock+' productos en el inventario.<br>',
			showConfirmButton: true,
			confirmButtonText: 'Cerrar',
			closeOnConfirm: false,
			icon: 'warning'
		})

		eliminarFila(codigoProducto)
	}

	cantidades = "";
}



$(".btnDeleteUser").click(function(){

    var idEmpleado = $(this).attr("idEmpleado"); 
      
    Swal.fire({
        title: 'Estas seguro de eliminar el usuario?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Borrar'
    }).then((result) => {
        if(result.value){

            window.location = "index.php?ruta=users&idEmpleadoE="+idEmpleado;
        }
        
    })

})


/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductos(){

	let tr = document.querySelector('#listaP' + codigoProducto); //selecionamos el tr por el codigo

	//console.log("listar Productos", tr);
	let idInventario = codigoInventario;
	let stockProducto = stock;
	let codigo = codigoProducto;
	let descripcion = tr.querySelector('.descripcionProducto').textContent;
	let cantidad = tr.querySelector('.cantidadProducto').textContent;
	let precioUnitario = tr.querySelector('.precioProducto').textContent;
	let subTotal = tr.querySelector('.subTotalProducto').textContent;
	let descuento = tr.querySelector('.descuentoProducto input').value;

	// Buscamos el objeto en el array de arrayProductos con el mismo id
	let index = arrayProductos.findIndex(producto => producto.idProducto === codigo);
	console.log("subTOTAL encontrado:", subTotal);

	if (index !== -1) {
		console.log("Entra el if");
		// Si el objeto ya existe, actualizamos su propiedad cantidad
		arrayProductos[index].cantidad = cantidad;
		arrayProductos[index].subTotal = subTotal;
		arrayProductos[index].descuento = descuento;
	} else {
		// Si el objeto no existe, lo agregamos al array
		arrayProductos.push({
			idInventario: idInventario,
			idProducto: codigo,
			descripcion: descripcion,
			cantidad: cantidad,
			stockProducto: stockProducto,
			precioUnitario: precioUnitario,
			subTotal: subTotal,
			descuento: descuento
		});
	}

	console.log("lista de productos JSON", arrayProductos);
	$("#listaProductos").val(JSON.stringify(arrayProductos));

	stock = "";
	codigoInventario = "";
}

/*=============================================
SELECCIONAR MÉTODO DE PAGO

$("#nuevoMetodoPago").change(function(){

	var metodo = $(this).val();

	if(metodo == "Efectivo"){

		$(this).parent().parent().removeClass("col-xs-6");

		$(this).parent().parent().addClass("col-xs-4");

		$(this).parent().parent().parent().children(".cajasMetodoPago").html(
			'<div class="col-xs-4">'+ 
			'<h4>Pago</h4>'+
				'<div class="input-group">'+ 

					'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+ 
					'<input type="text" class="form-control" id="nuevoValorEfectivo" placeholder="000000" required>'+

				'</div>'+

			'</div>'+

			'<div class="col-xs-4" id="capturarCambioEfectivo" style="padding-left:0px">'+
			'<h4>Cambio</h4>'+
				'<div class="input-group">'+
				
					'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

					'<input type="text" class="form-control" id="nuevoCambioEfectivo" placeholder="000000" readonly required>'+

				'</div>'+

			'</div>'
		 )

		// Agregar formato al precio

		$('#nuevoValorEfectivo').number( true, 2);
      	$('#nuevoCambioEfectivo').number( true, 2);


      	// Listar método en la entrada
      	listarMetodos()

	}else{

		$(this).parent().parent().removeClass('col-xs-4');

		$(this).parent().parent().addClass('col-xs-6');

		 $(this).parent().parent().parent().children('.cajasMetodoPago').html(
	 	'<div class="col-xs-6" style="padding-left:0px">'+
                        
                '<div class="input-group" style="padding:33px 0px 0px 0px !important">'+
                     
                  '<input type="number" min="0" class="form-control" id="nuevoCodigoTransaccion" placeholder="Código transacción"  required>'+
                       
                  
                '</div>'+

              '</div>')

	}

	

})
=============================================*/

/*=============================================
CAMBIO EN EFECTIVO
=============================================*/

$(".formularioVenta").on("change", "input#nuevoValorEfectivo", function(){

	var efectivo = $(this).val();

	var cambio =  Number(efectivo) - Number($('#nuevoTotalVenta').val());

	var nuevoCambioEfectivo = $(this).parent().parent().parent().children('#capturarCambioEfectivo').children().children('#nuevoCambioEfectivo');

	nuevoCambioEfectivo.val(cambio);

})




/*=============================================
IMPRIMIR FACTURA
=============================================*/

$(".tablas").on("click", ".btnImprimirFactura", function(){

	var codigoVenta = $(this).attr("codigoVenta");

	window.open("extensiones/tcpdf/pdf/factura.php?codigo="+codigoVenta, "_blank");
})



/*=============================================
IMPRIMIR FACTURA
=============================================*/

$(".tablas").on("click", ".btnImprimirTicket", function(){

	var codigoVenta = $(this).attr("codigoVenta");

	window.open("extensiones/tcpdf/pdf/ticket.php?codigo="+codigoVenta, "_blank");
})







/*=============================================
SELECCIONAR PRODUCTO
=============================================*/
/*
$(".formularioVenta").on("change", "select.nuevaDescripcionProducto", function(){

	var nombreProducto = $(this).val();

	var nuevaDescripcionProducto = $(this).parent().parent().parent().children().children().children(".nuevaDescripcionProducto");

	var nuevoPrecioProducto = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

	var nuevaCantidadProducto = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");

	var datos = new FormData();
    datos.append("nombreProducto", nombreProducto);


	  $.ajax({

		url:"ajax/productAjax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){
      	    
      	    $(nuevaDescripcionProducto).attr("idProducto", respuesta["id"]);
      	    $(nuevaCantidadProducto).attr("stock", respuesta["stock"]);
      	    $(nuevaCantidadProducto).attr("nuevoStock", Number(respuesta["stock"])-1);
      	    $(nuevoPrecioProducto).val(respuesta["precio_venta"]);
      	    $(nuevoPrecioProducto).attr("precioReal", respuesta["precio_venta"]);

  	      // AGRUPAR PRODUCTOS EN FORMATO JSON

	        listarProductos()

      	}

      })
})*/

