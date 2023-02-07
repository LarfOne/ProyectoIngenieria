$(".btnUpdateInventario").click(function(){
    var idProduct = $(this).attr("idProduct");
    //console.log("idEmpleado", idEmpleado);

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

            $("#idProducto").val(respuesta["codigo"]);
            $("#nameProducto").val(respuesta["nombre"]);
            $("#marcaProducto").val(respuesta["marca"]);
            $("#descriptionProducto").val(respuesta["descripcion"]);
            $("#precioProducto").val(respuesta["precio"]);
            $("#cateProducto").val(respuesta["categoria"]);
            //$("#idSucursal").val(respuesta["idSucursal"]);
            $("#unitProducto").val(respuesta["unidadmedida"]);
            $("#porcProducto").val(respuesta["porcentajeIVA"]);
            //$("#cantProducto").val(respuesta["cantidad"]);
            $("#gananciaProducto").val(respuesta["ganancia"]);
            $("#porGananProducto").val(respuesta["porcentajeGanancia"]);
            //$("#existProducto").val(respuesta["existencia"]);
            //$("#minProducto").val(respuesta["minimo"]);
            $("#obsProducto").val(respuesta["observaciones"]);


            //console.log("respuesta", respuesta);

        }

    })
})

$(".btnDeleteInventario").click(function(){

    var codigoProductM = $(this).attr("codigoProductM"); 


    Swal.fire({
        title: 'Estas seguro de eliminar el producto?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Borrar'
    }).then((result) => {
        if(result.value){

            window.location = "index.php?ruta=inventarios&idProductE="+codigoProductM;
        }

    })
})

$(".cerrarM").click(function(){
    $("#modalUpdateInventario").modal('hide')
})