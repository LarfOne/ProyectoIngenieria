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

	let idProduct = document.getElementById("idProducto").value;
	let cantidad = document.getElementById("cantidadProducto").value;

	if(idProduct != ""){


		console.log("idProduct ",idProduct)

		let datas = new FormData();

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
					let subTotal = parseInt(precio)*cantidad;
					
					//verifica si existe el codigo del producto en la tabla de ventas
					if ($('.tablita #listaP'+codigoProducto).length) { 
						let tr = document.querySelector('#listaP'+codigoProducto);

						let td = tr.querySelector('.cantidadProducto');

						let cantidadProducto = parseInt(td.textContent) + parseInt(cantidad);

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
								'<td class="descuentoProducto"><input class="descuentoInput" type="number" min="0" max="100" idProduct="'+codigoProducto+'" step="1" value="'+0+'"></td>'+
								'<td class="precioProducto">'+precio+'</td>'+
								'<td class="subTotalProducto">'+subTotal+'</td>'+
								'<td><button type="button" class="btn btn-danger d-flex justify-content-center quitarProducto" style="width:40px; height:35px; text-align:center;" idProduct="'+codigoProducto+'"><i class="fa fa-times fa-xs"></i></button></td>'+
		
							'</tr>')

					}

					let tr = document.querySelector('#listaP' + codigoProducto); //selecionamos el tr por el codigo

					//console.log("listar Productos", tr);
					
					let descuento = tr.querySelector('.descuentoInput').value;

							
						cantidadMayorStock()
							
						getTotalSale()
							
						listarProductos(descuento, codigoProducto, subTotal);
						
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
	let idProduct = $(this).attr('idProduct');
	eliminarFila(idProduct);
});


/*=============================================
SUMAR LOS PRECIOS DE LOS PRODUCTOS PARA EL TOTAL
=============================================*/

function sumarTotalPrecios(){

	let precios = document.querySelectorAll(".tableU td.subTotalProducto"); //se coloca la class de la tabla y la class del td

	let total = 0;

	precios.forEach(function(precio) {
		total += parseFloat(precio.textContent);
	});

	return total;

}


/*======================================================
	EVENTO PARA DESCUENTO DE TODA LA VENTA
========================================================*/

$('.tablaD').on('blur', '#nuevoDescuentoVenta', function() {

	if(document.getElementById("nuevoTotalVenta").value !="0"){

		let totalTaxt = parseFloat(sumarTotalPrecios()) + getTax();

		let totalFinal = parseFloat(totalTaxt) - getDiscount();
		console.log(totalFinal);
		$("#nuevoTotalVenta").val(totalFinal);
	}
		
});


/*======================================================
	EVENTO PARA IMPUESTO DE TODA LA VENTA
========================================================*/

$('.tablaD').on('blur', '#nuevoImpuestoVenta', function() {

	if(document.getElementById("nuevoTotalVenta").value !="0"){

		let totalDiscount = parseFloat(sumarTotalPrecios()) - getDiscount();

		let totalFinal = parseFloat(totalDiscount) + getTax();
		console.log(totalFinal);
		$("#nuevoTotalVenta").val(totalFinal);
	}

});


function getTax(){

	let impuestoVenta = parseInt(document.getElementById("nuevoImpuestoVenta").value);
	let porcentajeImpuesto= impuestoVenta / 100;
	let impuestoTotal = parseFloat(sumarTotalPrecios()) * porcentajeImpuesto;

	return impuestoTotal;
}

function getDiscount(){

	let descuentoVenta = parseInt(document.getElementById("nuevoDescuentoVenta").value);
	let porcentajeDescuento = descuentoVenta / 100;
	let descuentoTotal = porcentajeDescuento * parseFloat(sumarTotalPrecios());

	return descuentoTotal;

}

function getTotalSale(){
	let total = parseFloat(sumarTotalPrecios());

	total = total + getTax();

	total = total - getDiscount();
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


/*======================================================
	EVENTO PARA DESCUENTO
========================================================*/
$('.tableU').on('blur', '.descuentoInput', function() {
	let descuentoProducto = $(this).val();
	let idProduct = $(this).attr('idProduct');
	let tr = document.querySelector('#listaP'+idProduct);
	let precioUnitario = tr.querySelector('.precioProducto').textContent;
	let cantidad = tr.querySelector('.cantidadProducto').textContent;

	let subTotal = parseInt(precioUnitario)*cantidad;

	console.log('blur',idProduct);										
	listarProductos(descuentoProducto, idProduct,subTotal);
	getTotalSale();
});


/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductos(descuentoProducto, codigoProducto, subTotalP){

	let tr = document.querySelector('#listaP' + codigoProducto); //selecionamos el tr por el codigo

	//console.log("listar Productos", tr);
	let idInventario = codigoInventario;
	let stockProducto = stock;
	console.log("stock",stock);
	let codigo = codigoProducto;
	let descripcion = tr.querySelector('.descripcionProducto').textContent;
	let cantidad = tr.querySelector('.cantidadProducto').textContent;
	let precioUnitario = tr.querySelector('.precioProducto').textContent;
	let subTotal = subTotalP;
	let descuento = parseInt(descuentoProducto);

	let porcentajeDescuento = descuento / 100; // convierte el descuento a un porcentaje
	let descuentoTotal = porcentajeDescuento * parseFloat(subTotal); // calcula la cantidad a restar del subtotal

	let subTotalDescuento = parseFloat(subTotal) - descuentoTotal; // resta el descuento al subtotal original
	console.log("subTotalDescuento",subTotalDescuento);
	// Buscamos el objeto en el array de arrayProductos con el mismo id
	let index = arrayProductos.findIndex(producto => producto.idProducto === codigo);

	if (index !== -1) {
		// Si el objeto ya existe, actualizamos su propiedad cantidad
		arrayProductos[index].cantidad = cantidad;
		arrayProductos[index].subTotal = subTotalDescuento;
		arrayProductos[index].descuento = descuento;

		$('.tablita #listaP'+codigoProducto+' td:eq(5)').text(subTotalDescuento);

	} else {
		// Si el objeto no existe, lo agregamos al array
		arrayProductos.push({
			idInventario: idInventario,
			idProducto: codigo,
			descripcion: descripcion,
			cantidad: cantidad,
			stockProducto: stockProducto,
			precioUnitario: precioUnitario,
			subTotal: subTotalDescuento,
			descuento: descuento
		});
	}

	console.log("lista de productos JSON", arrayProductos);
	$("#listaProductos").val(JSON.stringify(arrayProductos));

	stock = "";
	codigoInventario = "";
}

$("#nuevoMetodoPago").change(function(){

	let metodo = $(this).val();

	console.log("Metodo de pago", metodo);

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


