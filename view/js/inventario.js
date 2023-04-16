$(".btnUpdateInventario").click(function(){
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
            //Ingresar los datos al localStorage
            localStorage.setItem("codigoInventario", respuesta["codigo"]);
            localStorage.setItem("idSucursal", respuesta["idSucursal"]);
            localStorage.setItem("cantProducto", respuesta["cantidad"]);
            localStorage.setItem("existProducto", respuesta["existencia"]);
            localStorage.setItem("minProducto", respuesta["minimo"]);

            $("#codigoInventario").val(respuesta["codigo"]);
            $("#idSucursal").val(respuesta["idSucursal"]);
            $("#cantProducto").val(respuesta["cantidad"]);
            $("#existProducto").val(respuesta["existencia"]);
            $("#minProducto").val(respuesta["minimo"]);
            console.log("respuestaInventario", respuesta);

        }

    })
})

$(document).ready(function(){

    // Obtener los datos del localStorage
    var idProducto = localStorage.getItem("idProducto");
    var nameProducto = localStorage.getItem("nameProducto");
    var marcaProducto = localStorage.getItem("marcaProducto");
    var descriptionProducto = localStorage.getItem("descriptionProducto");
    var precioProducto = localStorage.getItem("precioProducto");
    var cateProducto = localStorage.getItem("cateProducto");
    var unitProducto = localStorage.getItem("unitProducto");
    var porcProducto = localStorage.getItem("porcProducto");
    var gananciaProducto = localStorage.getItem("gananciaProducto");
    var porGananProducto = localStorage.getItem("porGananProducto");
    var obsProducto = localStorage.getItem("obsProducto");

    // Asignar los datos a los campos correspondientes
    $("#idProducto").val(idProducto);
    $("#nameProducto").val(nameProducto);
    $("#marcaProducto").val(marcaProducto);
    $("#descriptionProducto").val(descriptionProducto);
    $("#precioProducto").val(precioProducto);
    $("#cateProducto").val(cateProducto);
    $("#unitProducto").val(unitProducto);
    $("#porcProducto").val(porcProducto);
    $("#gananciaProducto").val(gananciaProducto);
    $("#porGananProducto").val(porGananProducto);
    $("#obsProducto").val(obsProducto);
    //$("#idSucursal").val(idSucursal);
    //$("#cantProducto").val(cantProducto);
    //$("#existProducto").val(existProducto);
    //$("#minProducto").val(minProducto);
    //localStorage.clear(); //Cuando se oprima el boton de editar se vacia el localStorage
})

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