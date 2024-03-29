let stock = "";
let codigoProducto = "";
let codigoInventario = "";
let descuento = "";
let metodosSeleccionados = []; 
//const formularioVenta = document.querySelector('.formularioVenta');

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

	let index = arrayProductos.findIndex(producto => producto.idProducto == idProduct);

	if (index !== -1) {
		if (tr) {
			arrayProductos.splice(index, 1);
			tr.remove();
			sumarTotalPrecios();
			Discount();
			Tax();
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


	$("#nuevoSubTotalVenta").val(total);
	//$("#nuevoTotalVenta").val(total);
	return total;

}


/*======================================================
	EVENTO PARA DESCUENTO DE TODA LA VENTA
========================================================*/

function Discount(){
	if(document.getElementById("nuevoTotalVenta").value !="0"){

		let totalTaxt = parseFloat(sumarTotalPrecios()) + getTax();

		let totalFinal = parseFloat(totalTaxt) - getDiscount();
		console.log(totalFinal);
		$("#descuentoVenta").val(getDiscount());
		$("#nuevoTotalVenta").val(totalFinal);
	}
}

$('.tablaD').on('blur', '#nuevoDescuentoVenta', function() {
	Discount();
});


/*======================================================
	EVENTO PARA PAGO DE VENTA Y CUANTA PLATA DEVOLVER
========================================================*/

$('.tablaD').on('blur', '#nuevoPagoVenta', function() {

	if(document.getElementById("nuevoTotalVenta").value !="0"){

		if(document.getElementById("nuevoPagoVenta").value !="0"){
			let pagoVenta = parseInt(document.getElementById("nuevoPagoVenta").value);
			let totalVenta = parseInt(document.getElementById("nuevoTotalVenta").value);

			let deuSale = pagoVenta - totalVenta;

			$("#nuevoDueVenta").val(deuSale);
		}

	}
	

});


/*======================================================
	EVENTO PARA IMPUESTO DE TODA LA VENTA
========================================================*/

function Tax(){
	if(document.getElementById("nuevoTotalVenta").value !="0"){

		let totalDiscount = parseFloat(sumarTotalPrecios()) - getDiscount();

		let totalFinal = parseFloat(totalDiscount) + getTax();
		console.log(totalFinal);
		$("#impuestoVenta").val(getTax());
		$("#nuevoTotalVenta").val(totalFinal);
	}
}

$('.tablaD').on('blur', '#nuevoImpuestoVenta', function() {
	Tax();
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


/*formularioVenta.addEventListener('submit', function(event) {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    let alMenosUnoSeleccionado = false;
    checkboxes.forEach(function(checkbox) {
      if (checkbox.checked) {
        alMenosUnoSeleccionado = true;
      }
    });
    if (!alMenosUnoSeleccionado) {
      event.preventDefault();
      alert('Por favor, selecciona al menos una opción de pago.');
    }
});*/

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

$("#checkEfectivo, #checkTarjeta, #checkSinpe").change(function() {
    // Verificar si el checkbox se seleccionó o deseleccionó
    if ($(this).is(":checked")) {
        // Si se seleccionó, agregarlo al arreglo
        metodosSeleccionados.push($(this).val());
    } else {
        // Si se deseleccionó, eliminarlo del arreglo
        let index = metodosSeleccionados.indexOf($(this).val());
        if (index !== -1) {
            metodosSeleccionados.splice(index, 1);
        }
    }
	    // Imprimir el arreglo actualizado (para fines de depuración)
		console.log(metodosSeleccionados);

		$("#listaMetodoPago").val(metodosSeleccionados);
		//console.log(document.getElementById("listaMetodoPago").textContent);
		pagosVenta();
});

let $th1, $th2, $th3, $td1, $td2, $td3;

function pagosVenta(){

	if(metodosSeleccionados.length == 1){

		if(metodosSeleccionados[0] == "Efectivo"){

			quitarElementos();

			$th1 = $('<th class="total-texto">Pago</th>');

			$td1 = $('<td>'+
							'<div class="input-group">'+
								'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
								'<input type="number" class="form-control input-lg" id="nuevoPagoVenta" name="nuevoPagoVenta" value=0 min=0 max=100000000 required>'+
							'</div>'+
						'</td>');

			$td2 = $('<td>'+
							'<div class="input-group">'+
								'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
								'<input type="number" class="form-control input-lg" id="nuevoDueVenta" name="nuevoDueVenta" value=0 min=0 max=100000000 required readonly>'+
							'</div>'+
						'</td>');
						
			$td3 = $(
						'<td>'+
						'<div class="input-group">'+
							'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
							'<input type="hidden" id="nuevoPagoEfectivo" name="nuevoPagoEfectivo" value="'+parseInt(document.getElementById("nuevoTotalVenta").value)+'">'+
						'</div>'+
					'</td>'
					);

			// Agregar los elementos
			$th1.appendTo(".thead_tableD");
			$td1.appendTo(".tbody_tableD");
			$td2.appendTo(".tbody_tableD");
			$td3.appendTo(".tbody_tableD");
			


		}if(metodosSeleccionados[0] == "Sinpe"){
			quitarElementos();
			$td3 = $(
				'<td>'+
				'<div class="input-group">'+
					'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
					'<input type="hidden" id="nuevoPagoEfectivo" name="nuevoPagoSinpe" value="'+parseInt(document.getElementById("nuevoTotalVenta").value)+'">'+
				'</div>'+
			'</td>'
			);

			$td3.appendTo(".tbody_tableD");

		}if(metodosSeleccionados[0] == "Tarjeta"){
			quitarElementos();
			$td3 = $(
				'<td>'+
				'<div class="input-group">'+
					'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
					'<input type="hidden" id="nuevoPagoEfectivo" name="nuevoPagoTarjeta" value="'+parseInt(document.getElementById("nuevoTotalVenta").value)+'">'+
				'</div>'+
			'</td>'
			);

			$td3.appendTo(".tbody_tableD");

		}

	}else{
		quitarElementos();
		
		if(metodosSeleccionados.length == 2){
			//Nuevos elementos cuando hay dos
			$th1 = $('<th class="total-texto">'+metodosSeleccionados[0]+'</th>');

			$th2 = $('<th class="total-texto">'+metodosSeleccionados[1]+'</th>');

			$td1 = $('<td>'+
							'<div class="input-group">'+
								'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
								'<input type="number" class="form-control input-lg" id="nuevoPago'+metodosSeleccionados[0]+'" name="nuevoPago'+metodosSeleccionados[0]+'" value=0 min=0 max=100000000 required>'+
							'</div>'+
						'</td>');

			$td2 = $('<td>'+
							'<div class="input-group">'+
								'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
								'<input type="number" class="form-control input-lg" id="nuevoPago'+metodosSeleccionados[1]+'" name="nuevoPago'+metodosSeleccionados[1]+'" value=0 min=0 max=100000000 required>'+
							'</div>'+
						'</td>');						

			// Agregar los elementos
			$th1.appendTo(".thead_tableD");
			$th2.appendTo(".thead_tableD");
			$td1.appendTo(".tbody_tableD");
			$td2.appendTo(".tbody_tableD");

		}if(metodosSeleccionados.length == 3){
			//Nuevos elementos cuando hay tres
			$th1 = $('<th class="total-texto">Sinpe</th>');

			$th2 = $('<th class="total-texto">Efectivo</th>');

			$th3 = $('<th class="total-texto">Tarjeta</th>');

			$td1 = $('<td>'+
							'<div class="input-group">'+
								'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
								'<input type="number" class="form-control input-lg" id="nuevoPagoSinpe" name="nuevoPagoSinpe" value=0 min=0 max=100000000 required>'+
							'</div>'+
						'</td>');

			$td2 = $('<td>'+
							'<div class="input-group">'+
								'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
								'<input type="number" class="form-control input-lg" id="nuevoPagoEfectivo" name="nuevoPagoEfectivo" value=0 min=0 max=100000000 required>'+
							'</div>'+
						'</td>');
			
			$td3 = $('<td>'+
						'<div class="input-group">'+
							'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
							'<input type="number" class="form-control input-lg" id="nuevoPagoTarjeta" name="nuevoPagoTarjeta" value=0 min=0 max=100000000 required>'+
						'</div>'+
					'</td>');

			// Agregar los elementos
			$th1.appendTo(".thead_tableD");
			$th2.appendTo(".thead_tableD");
			$th3.appendTo(".thead_tableD");
			$td1.appendTo(".tbody_tableD");
			$td2.appendTo(".tbody_tableD");
			$td3.appendTo(".tbody_tableD");

		}
		
	}
}

function quitarElementos(){
	if ($th1) {
		$th1.remove();

	}if($th2){
		$th2.remove();

	}if($th3){
		$th3.remove();

	}if ($td1) {
		$td1.remove();

	}if ($td2) {
		$td2.remove();

	}if ($td3) {
		$td3.remove();
	}
}



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




