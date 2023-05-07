let datosProductos = [];
//localStorage.setItem('datosProductos', datosProductos);

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

            const infoProductos = {
                codigo: respuesta["codigo"],
                nombre: respuesta["nombre"],
                marca: respuesta["marca"],
                descripcion: respuesta["descripcion"],
                precioNeto: respuesta["precioNeto"],
                categoria: respuesta["categoria"],
                unidadMedida: respuesta["unidadmedida"],
                porcentajeIva: respuesta["porcentajeIva"],
                precioTotal: respuesta["precioTotal"],
                observaciones: respuesta["observaciones"]
            }

            datosProductos = [...datosProductos, infoProductos];

            let productos = JSON.stringify(datosProductos);
            localStorage.setItem("datosProductos",productos);

            const dataArray = JSON.parse(localStorage.getItem("datosProductos"));

            mostrarValores(dataArray);
        }

    })
})


function mostrarValores(dataArray){

    $("#idProducto").val(dataArray[0].codigo);

}


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

var porcentaje = 0;
var precioTotal = 0;
var precioNeto = 0;
var precioIVA = 0;
var porc;

function obtenerPorcentaje(){
    porc = document.getElementById("porcProducto").value;
    porcentaje = Number.parseFloat(porc) / 100;
    precioNeto = document.getElementById("precioNeto").value

    console.log(porcentaje);

    if(porc != "" && precioNeto != ""){

        precioIVA = precioNeto * porcentaje; //260
        precioTotal = Number.parseInt(precioNeto) + Number.parseInt(precioIVA);//2000260
        
        $("#ivaProducto").val(precioIVA);
        $("#precioTotal").val(precioTotal);
    }
}

function obtenerPrecioNeto(){
    porc = document.getElementById("porcProducto").value;
    porcentaje = Number.parseFloat(porc) / 100;
    precioNeto = document.getElementById("precioNeto").value;

    console.log("Pecio Neto", precioNeto);

    if(porc != "" && precioNeto != ""){
        
        precioIVA = precioNeto * porcentaje;
        precioTotal = Number.parseInt(precioNeto) + Number.parseInt(precioIVA);//2000260

        $("#ivaProducto").val(precioIVA);
        $("#precioTotal").val(precioTotal);

    }
}




