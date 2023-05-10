const dataArrayProductos = JSON.parse(localStorage.getItem("datosProductos"));
const dataArrayInventario = JSON.parse(localStorage.getItem("datosInventario"));


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


$(".botonAjusteInventario").click(function(){
    localStorage.clear();
})
