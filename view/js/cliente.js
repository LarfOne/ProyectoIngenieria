
$(".btnUpdateClient").click(function(){
    var idClient = $(this).attr("idClient");
    var datas = new FormData();
    console.log("idClient", idClient);
    datas.append("idClient", idClient);
  
    $.ajax({
  
        url:"ajax/clienteAjax.php",
        method:"POST",
        data: datas,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
  
            $("#cedulam").val(respuesta["cedula"]);
            $("#nomClientem").val(respuesta["nomCliente"]);
            $("#apellidosm").val(respuesta["apellidos"]);
            $("#telefonoClim").val(respuesta["telefonoCli"]);
            $("#emailm").val(respuesta["email"]);
            $("#direccionm").val(respuesta["direccion"]);
  
            //console.log("respuesta", respuesta);
  
        }
  
    })
  })
  
  $(".btnDeleteClient").click(function(){
  
    var codigoC= $(this).attr("codigoC"); 
  
  
    Swal.fire({
        title: 'Estas seguro de eliminar el Cliente?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Borrar'
    }).then((result) => {
        if(result.value){
  
            window.location = "index.php?ruta=cliente&codigoE="+codigoC;
        }
  
    })
  
  })