const dataArrayProductos = JSON.parse(localStorage.getItem("datosProductos"));
const dataArrayInventario = JSON.parse(localStorage.getItem("datosInventario"));

console.log("HOLA SI ESTOY", dataArrayProductos);
console.log("HOLA SI ESTOY2", dataArrayInventario);

//dataArrayProductos[0].codigo

$("#idProductoAjuste").val(dataArrayProductos[0].codigo);
$("#codigoInventarioAjuste").val(dataArrayInventario[0].codigo);
$("#nameProductoAjuste").val(dataArrayProductos[0].nombre);
$("#marcaProductoAjuste").val(dataArrayProductos[0].marca);
$("#descriptionProductoAjuste").val(dataArrayProductos[0].descripcion);
$("#existenciaAjuste").val(dataArrayInventario[0].cantidad);
$("#idSucursalAjuste").val(dataArrayInventario[0].idSucursal);
$("#unitProductoAjuste").val(dataArrayProductos[0].unidadMedida);
$("#porcProductoAjuste").val(dataArrayProductos[0].porcentajeIva);
$("#precioNetoAjuste").val(dataArrayProductos[0].precioNeto);
$("#precioTotalAjuste").val(dataArrayProductos[0].precioTotal);
$("#cateProductoAjuste").val(dataArrayProductos[0].categoria);
$("#obsProductoAjuste").val(dataArrayProductos[0].observaciones);
$("#fotoActualProducto").val(dataArrayProductos[0].image);

if (dataArrayProductos[0].image != null) {
    $(".imageTemp").attr("src", dataArrayProductos[0].image);
} else {
    $(".imageTemp").attr("src", "imagen/computadoraDefault.png");
}




$(".botonAjusteInventario").click(function(){
    localStorage.clear();
})

$('#porcProductoAjuste').on('blur', function() {
    let porcentaje = 0;
    let precioTotal = 0;
    let precioNeto = 0;
    let precioIVA = 0;
    let porc;

    porc = document.getElementById("porcProductoAjuste").value;
    porcentaje = Number.parseFloat(porc) / 100;
    precioNeto = document.getElementById("precioNetoAjuste").value

    if(porc != "" && precioNeto != ""){

        precioIVA = precioNeto * porcentaje;
        precioTotal = Number.parseInt(precioNeto) + Number.parseInt(precioIVA);
        
        $("#ivaProductoAjuste").val(precioIVA);
        $("#precioTotalAjuste").val(precioTotal);
    }
});

$('#precioNetoAjuste').on('blur', function() {
    let porcentaje = 0;
    let precioTotal = 0;
    let precioNeto = 0;
    let precioIVA = 0;
    let porc;

    porc = document.getElementById("porcProductoAjuste").value;
    porcentaje = Number.parseFloat(porc) / 100;
    precioNeto = document.getElementById("precioNetoAjuste").value;

    if(porc != "" && precioNeto != ""){
        
        precioIVA = precioNeto * porcentaje;
        precioTotal = Number.parseInt(precioNeto) + Number.parseInt(precioIVA);

        $("#ivaProductoAjuste").val(precioIVA);
        $("#precioTotalAjuste").val(precioTotal);

    }
});


