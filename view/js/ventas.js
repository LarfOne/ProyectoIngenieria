var stock;
var codigoProducto = "";
let cantidadTr = 0;

// Creamos un array vacío
const arrayProductos = [];

$(".btnAgregarProducto1").click(function(){
    
	var idProducto = document.getElementById("idProducto").value;
	
	//console.log("Id del productooooo",idProducto);

	/*var idInventario = $(this).attr("idInventario");*/
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
			console.log("respuesta",respuesta);
			stock = respuesta["cantidad"];
			//console.log("cantidad", stock);
        }

    })
})



/*=============================================
BOTON PARA AGREGAR PRODUCTOS A LA TABLA
=============================================*/

$(".btnAgregarProducto1").click(function(){
	//porc = document.getElementById("idProducto").value;
	//console.log("Hello",porc);

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
				
				//console.log("respuesta", respuesta);
				codigoProducto = respuesta["codigo"];
				var descripcion = respuesta["descripcion"];
				var precio = respuesta["precioTotal"];
				var porDescuento = "0";
				var descuento = "0";
				var subTotal = parseInt(precio)*cantidad;
				
				//verifica si existe el cosigo del producto en la tabla de ventas
				if ($('.tablita #listaP'+codigoProducto).length) { 
					let tr = document.querySelector('#listaP'+codigoProducto);

					let td = tr.querySelector('.cantidadProducto');
					
					let cantidadProducto = parseInt(td.textContent) + parseInt(cantidad);
					//console.log("td121", td)
					//console.log("tipo de una variable",typeof cantidad);

					subTotal = parseInt(precio)*cantidadProducto;

					//se modifica el contenido de la tabla
					$('.tablita #listaP'+codigoProducto+' td:eq(2)').text(cantidadProducto);

					$('.tablita #listaP'+codigoProducto+' td:eq(5)').text(subTotal);

					

				}else{
					
					$(".tablita").append(

						'<tr id="listaP'+codigoProducto+'">'+
				
							'<td>'+codigoProducto+'</td>'+
							'<td class="descripcionProducto">'+descripcion+'</td>'+
							'<td class="cantidadProducto">'+cantidad+'</td>'+
							'<td class="descuentoProducto">'+descuento+'</td>'+
							'<td class="precioProducto">'+precio+'</td>'+
							'<td class="subTotalProducto">'+subTotal+'</td>'+
							'<td><button type="button" class="btn btn-danger d-flex justify-content-center quitarProducto" style="width:40px; height:35px; text-align:center;" idProduct="'+codigoProducto+'"><i class="fa fa-times fa-xs"></i></button></td>'+
	
						'</tr>')

				}

					cantidadMayorStock()

					sumarTotalPrecios()

					//contarFilas()

					listarProductos()

        	}

    	})
	}
})




/*=============================================
QUITAR PRODUCTOS DE LA TABLA
=============================================*/

function eliminarFila(idProduct) {
	let tr = document.querySelector('#listaP' + idProduct);
	if (tr) {
	  tr.remove();
	  sumarTotalPrecios();
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
VERIFICAR LOS TR QUE HAY EN LA TABLA
=============================================*/

/*function contarFilas() {
	let tabla = document.getElementById("tablitaC"); 
	//console.log("TABLAAAAAA",tabla)
	let filas = tabla.getElementsByTagName("tr");
	//console.log("filas de la tabla",filas)
	cantidadTr =  filas.length - 1;
}*/

/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductos(){

	let tr = document.querySelector('#listaP' + codigoProducto); //3 23

	//console.log("listar Productos", tr);

	let codigo = codigoProducto;
	let descripcion = tr.querySelector('.descripcionProducto');
	let cantidad = tr.querySelector('.cantidadProducto');
	let precioUnitario = tr.querySelector('.precioProducto');
	let subTotal = tr.querySelector('.subTotalProducto');

	// Buscamos el objeto en el array de arrayProductos con el mismo id
	let index = arrayProductos.findIndex(producto => producto.id === codigo);

	if (index !== -1) {
		// Si el objeto ya existe, actualizamos su propiedad cantidad
		arrayProductos[index].cantidad = cantidad.textContent;
	} else {
		// Si el objeto no existe, lo agregamos al array
		arrayProductos.push({
			id: codigo,
			descripcion: descripcion.textContent,
			cantidad: cantidad.textContent,
			stock: cantidad.textContent,
			precioUnitario: precioUnitario.textContent,
			subTotal: subTotal.textContent,
		});
	}

	console.log("lista de productos JSON", arrayProductos);
	$("#listaProductos").val(JSON.stringify(arrayProductos));

}

/*=============================================
SELECCIONAR MÉTODO DE PAGO
=============================================*/

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

