var stock;

$(".btnAgregarProduct").click(function(){
    var idInventario = $(this).attr("idInventario");
    var datas = new FormData();

    datas.append("idInventario", idInventario);

    $.ajax({

        url:"ajax/inventarioAjax.php",
        method:"POST",
        data: datas,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
			stock = respuesta["cantidad"];

        }

    })
})

//se agrega los productos
$(".btnAgregarProduct").click(function(){
	var idProduct = $(this).attr("idProduct");
	//console.log("idProduct ",idProduct)

	$(this).removeClass("btn-primary btnAgregarProduct");
	
    $(this).addClass("btn-default");

	//const button = document.querySelector(".btnAgregarProduct");
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

			success: function(respuesta){
				var nombre = respuesta["nombre"];
				var precio = respuesta["precio"];
				//console.log("respuesta", respuesta);

				$(".nuevoProducto").append(

					'<div class="row" style="padding:5px 15px">'+
	  
					'<!-- Descripción del producto -->'+
					
					'<div class="col-xs-6" style="padding-right:0px">'+
					
					  '<div class="input-group">'+
						
						'<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProduct="'+idProduct+'"><i class="fa fa-times"></i></button></span>'+
	  
						'<input type="text" class="form-control nuevaDescripcionProducto" name="nuevaDescripcionProducto" value="'+nombre+'" readonly required>'+
						'<input type="hidden" class="form-control codigoProducto" name="codigoProducto" value="'+idProduct+'" readonly required>'+
					  '</div>'+
	  
					'</div>'+

					'<!-- Cantidad del producto -->'+

						'<div class="col-xs-3">'+
							
							'<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+

						'</div>' +
	  
					'<!-- Precio del producto -->'+
	  
					'<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+
	  
					  '<div class="input-group">'+
	  
						'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
						   
						'<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+precio+'" name="nuevoPrecioProducto" value="'+precio+'" readonly required>'+
		   
					  '</div>'+
					   
					'</div>'+
	  
				  '</div>') 

				  // SUMAR TOTAL DE PRECIOS

				  	sumarTotalPrecios()

				  // AGRUPAR PRODUCTOS EN FORMATO JSON

    				listarProductos()
	  

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
			
            console.log("respuesta", respuesta);
			var codigo = respuesta["codigo"];
			var descripcion = respuesta["descripcion"];
			var precio = respuesta["precioTotal"];
			var porDescuento = "0";
			var descuento = "0";
			var subTotal = "0";
			//var nombre = respuesta["nombre"];

			

			$(".tablita").append( //los datos obtenidos se agrega a la tabla

			'<tr id="listaP'+codigo+'">'+
	  
				'<td>'+codigo+'</td>'+
				'<td>'+descripcion+'</td>'+
				'<td>'+cantidad+'</td>'+
				'<td>'+descuento+'</td>'+
				'<td>'+precio+'</td>'+
				'<td>'+subTotal+'</td>'+
				'<td><button type="button" class="btn btn-danger d-flex justify-content-center quitarProducto" style="width:40px; height:35px; text-align:center;" idProduct="'+codigo+'"><i class="fa fa-times fa-xs"></i></button></td>'+

		  	'</tr>') 

        }

    })
})



/*=============================================
QUITAR PRODUCTOS DE LA VENTA
=============================================*/

$(".tableU").on("click", "button.quitarProducto", function(){

	var idProduct = $(this).attr("idProduct");

	console.log("Codigo del producto",idProduct);

	let tr = document.querySelector('#listaP'+idProduct);

	console.log("tr",tr);

	tr.remove();

})




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
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/

var idQuitarProducto = [];

$(".formularioVenta").on("click", "button.quitarProducto", function(){

	$(this).parent().parent().parent().parent().remove();

	var idProduct = $(this).attr("idProduct");

	if(localStorage.getItem("quitarProducto") == null){

		idQuitarProducto = [];
	
	}else{

		idQuitarProducto.concat(localStorage.getItem("quitarProducto"))

	}

	$("button.recuperarBoton[idProduct='"+idProduct+"']").removeClass('btn-default');

	$("button.recuperarBoton[idProduct='"+idProduct+"']").addClass('btn-primary btnAgregarProduct');


	if($(".nuevoProducto").children().length == 0){

		$("#nuevoImpuestoVenta").val(0);
		$("#nuevoTotalVenta").val(0);
		$("#totalVenta").val(0);
		$("#nuevoTotalVenta").attr("total",0);

	}else{

		// SUMAR TOTAL DE PRECIOS

    	sumarTotalPrecios()

    	// AGREGAR IMPUESTO
	        
        agregarImpuesto()

        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductos()

	}

})


$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function(){

	var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

	var precioFinal = $(this).val() * precio.attr("precioReal");
	
	precio.val(precioFinal);

	var nuevoStock = Number($(this).attr("stock")) - $(this).val();

	$(this).attr("nuevoStock", nuevoStock);

	if(Number($(this).val()) > Number($(this).attr("stock"))){

		/*=============================================
		SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
		=============================================*/

		$(this).val(1);

		var precioFinal = $(this).val() * precio.attr("precioReal");

		precio.val(precioFinal);

		sumarTotalPrecios();

		swal({
	      title: "La cantidad supera el Stock",
	      text: "¡Sólo hay "+$(this).attr("stock")+" unidades!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });

	    return;

	}

	// SUMAR TOTAL DE PRECIOS

	sumarTotalPrecios()

    // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos()

})

function sumarTotalPrecios(){

	var precioItem = $(".nuevoPrecioProducto");
	var arraySumaPrecio = [];  

	for(var i = 0; i < precioItem.length; i++){

		 arraySumaPrecio.push(Number($(precioItem[i]).val()));
		 
	}

	function sumaArrayPrecios(total, numero){

		return total + numero;

	}

	var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);
	
	$("#nuevoTotalVenta").val(sumaTotalPrecio);
	$("#totalVenta").val(sumaTotalPrecio);
	$("#nuevoTotalVenta").attr("total",sumaTotalPrecio);


}

/*function listarMetodos(){

	var listaMetodos = "";

	if($("#nuevoMetodoPago").val() == "Efectivo"){

		$("#listaMetodoPago").val("Efectivo");

	}else{

		$("#listaMetodoPago").val($("#nuevoMetodoPago").val()+"-"+$("#nuevoCodigoTransaccion").val());

	}

}
*/
/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductos(){

	var listaProductos = [];

	var codigo = $(".codigoProducto");

	var descripcion = $(".nuevaDescripcionProducto");

	var cantidad = $(".nuevaCantidadProducto");

	var precio = $(".nuevoPrecioProducto");
	
	for(var i = 0; i < descripcion.length; i++){

		listaProductos.push({ "id" : $(codigo[i]).val(), 
							  "descripcion" : $(descripcion[i]).val(),
							  "cantidad" : $(cantidad[i]).val(),
							  "stock" : $(cantidad[i]).attr("nuevoStock"),
							  "precio" : $(precio[i]).attr("precioReal"),
							  "total" : $(precio[i]).val()})

		//console.log(listaProductos[i].descripcion);
		
		var datas = [];

    	datas.push("detalleData", listaProductos[i]);

		console.log(datas[i]);

		$.ajax({

			url:"view/moduls/createVenta.php",
			method:"POST",
			data: datas,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta){
				
	
			}
	
		})
		
	}
	

	$("#listaProductos").val(JSON.stringify(listaProductos));


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

