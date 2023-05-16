let datosInventario = [];
let datosProductos = [];

$(".btnUpdateInventario").click(function(event){
    // Evitar el comportamiento predeterminado del botón
    event.preventDefault();

    let idInventario = $(this).attr("idInventario");
    let idProduct = $(this).attr("idProduct");

    // Realizar las dos funciones AJAX de forma asíncrona
    let request1 = $.ajax({
        url:"ajax/inventarioAjax.php",
        method:"POST",
        data: {idInventario: idInventario},
        dataType: "json"
    });
    let request2 = $.ajax({
        url:"ajax/productAjax.php",
        method:"POST",
        data: {idProduct: idProduct},
        dataType: "json"
    });

    // Esperar a que ambas funciones AJAX terminen de ejecutarse
    $.when(request1, request2).done(function(respuesta1, respuesta2){
        const infoInventario = {
            codigo: respuesta1[0]["codigo"],
            idSucursal: respuesta1[0]["idSucursal"],
            cantidad: respuesta1[0]["cantidad"]
        }
        datosInventario = [...datosInventario, infoInventario];
        let inventario = JSON.stringify(datosInventario);
        localStorage.setItem("datosInventario",inventario);

        const infoProductos = {
            codigo: respuesta2[0]["codigo"],
            nombre: respuesta2[0]["nombre"],
            marca: respuesta2[0]["marca"],
            descripcion: respuesta2[0]["descripcion"],
            precioNeto: respuesta2[0]["precioNeto"],
            categoria: respuesta2[0]["categoria"],
            unidadMedida: respuesta2[0]["unidadmedida"],
            porcentajeIva: respuesta2[0]["porcentajeIva"],
            precioTotal: respuesta2[0]["precioTotal"],
            observaciones: respuesta2[0]["observaciones"],
            image: respuesta2[0]["image"],
            usuarioResponsable: respuesta2[0]["usuarioResponsable"]
        }
        datosProductos = [...datosProductos, infoProductos];
        let productos = JSON.stringify(datosProductos);
        localStorage.setItem("datosProductos",productos);

        // Redirigir a la nueva página después de que las funciones AJAX terminen
        window.location.href = "editarInventario";
    });
});


/*$(document).ready(function(){

    // Obtener los datos del localStorage
    var codigoInventario = localStorage.getItem("codigoInventario");
    var idSucursal = localStorage.getItem("idSucursal");
    var cantProducto = localStorage.getItem("cantProducto");
   ///var existProducto = localStorage.getItem("existProducto");

    // Asignar los datos a los campos correspondientes
    $("#codigoInventario").val(codigoInventario);
    $("#idSucursal").val(idSucursal);
    $("#existProducto").val(cantProducto);
    //$("#existProducto").val(existProducto);

    //localStorage.clear(); //Cuando se oprima el boton de editar se vacia el localStorage
})*/

$(".btnDeleteInventario").click(function(){

    var codigoIventarioM = $(this).attr("codigoIventarioM"); 


    Swal.fire({
        title: 'Estas seguro de eliminar el inventario?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Borrar'
    }).then((result) => {
        if(result.value){

            window.location = "index.php?ruta=inventarios&codigoInventarioE="+codigoIventarioM;
        }

    })

})