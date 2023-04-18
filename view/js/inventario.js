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
            
            $("#codigoInventario").val(respuesta["codigo"]);
            $("#idSucursal").val(respuesta["idSucursal"]);
            //$("#idProducto").val(respuesta["idProducto"]);
            $("#cantProducto").val(respuesta["cantidad"]);
            $("#existProducto").val(respuesta["existencia"]);
            $("#minProducto").val(respuesta["minimo"]);
            console.log("respuesta", respuesta);

        }

    })
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