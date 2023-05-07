let stock = "";
let codigoProducto = "";
let codigoInventario = "";


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
					var descripcion = respuesta["descripcion"];
					var precio = respuesta["precioTotal"];
					var porDescuento = "0";
					var descuento = "0";
					var subTotal = parseInt(precio)*cantidad;
					
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
								'<td class="descuentoProducto">'+descuento+'</td>'+
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
	console.log("stock",stock);
	let codigo = codigoProducto;
	let descripcion = tr.querySelector('.descripcionProducto').textContent;
	let cantidad = tr.querySelector('.cantidadProducto').textContent;
	let precioUnitario = tr.querySelector('.precioProducto').textContent;
	let subTotal = tr.querySelector('.subTotalProducto').textContent;

	// Buscamos el objeto en el array de arrayProductos con el mismo id
	let index = arrayProductos.findIndex(producto => producto.idProducto === codigo);
	console.log("subTOTAL encontrado:", subTotal);

	if (index !== -1) {
		console.log("Entra el if");
		// Si el objeto ya existe, actualizamos su propiedad cantidad
		arrayProductos[index].cantidad = cantidad;
		arrayProductos[index].subTotal = subTotal;
	} else {
		// Si el objeto no existe, lo agregamos al array
		arrayProductos.push({
			idInventario: idInventario,
			idProducto: codigo,
			descripcion: descripcion,
			cantidad: cantidad,
			stockProducto: stockProducto,
			precioUnitario: precioUnitario,
			subTotal: subTotal
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
