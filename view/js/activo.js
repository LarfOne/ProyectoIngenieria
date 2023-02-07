$(".btnUpdateActivo").click(function(){
    var codigo = $(this).attr("codigo");
    //console.log("idEmpleado", idEmpleado);

    var datas = new FormData();

    datas.append("codigo", codigo);

    $.ajax({

        url:"ajax/activoAjax.php",
        method:"POST",
        data: datas,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

            $("#codigom").val(respuesta["codigo"]);
            $("#idSucursalm").val(respuesta["idSucursal"]);
            $("#descripcionm").val(respuesta["descripcion"]);
            $("#estadom").val(respuesta["estado"]);
            $("#empleado_idm").val(respuesta["empleado_id"]);

            //console.log("respuesta", respuesta);

        }

    })
})

$(".btnDeleteActivo").click(function(){

    var codigo = $(this).attr("codigo"); 


    Swal.fire({
        title: 'Estas seguro de eliminar el activo?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Borrar'
    }).then((result) => {
        if(result.value){

            window.location = "index.php?ruta=activos&idActivoE="+codigo;
        }

    })

})