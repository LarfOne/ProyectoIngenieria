$(".btnUpdateSucursal").click(function(){
    var idSucursal = $(this).attr("idSucursal");
    var datas = new FormData();

    datas.append("idSucursal", idSucursal);

    $.ajax({

        url:"ajax/sucursalAjax.php",
        method:"POST",
        data: datas,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

            $("#idSucursalm").val(respuesta["codigo"]);
            $("#nameSucursalm").val(respuesta["nombre"]);
            $("#direccionSucursalm").val(respuesta["direccion"]);
            $("#telefonoSucursalm").val(respuesta["telefono"]);
            $("#emailSucursalm").val(respuesta["email"]);

            console.log("respuesta", respuesta);

        }

    })
})

$(".btnDeleteSucursal").click(function(){

    var codigoM = $(this).attr("codigoM"); 


    Swal.fire({
        title: 'Estas seguro de eliminar la Sucursal?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Borrar'
    }).then((result) => {
        if(result.value){

            window.location = "index.php?ruta=sucursal&codigoE="+codigoM;
        }

    })

})
