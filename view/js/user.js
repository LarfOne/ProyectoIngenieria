/**EDITAR USUARIO */

$(".btnUpdateUser").click(function(){
    var idEmpleado = $(this).attr("idEmpleado");
    console.log("idEmpleado", idEmpleado);

    var datas = new FormData();

    datas.append("idEmpleado", idEmpleado);

    $.ajax({

        url:"ajax/userAjax.php",
        method:"POST",
        data: datas,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            console.log("respuesta", respuesta);

            $("#idUserm").val(respuesta["cedula"]);
            $("#nameUserm").val(respuesta["nombre"]);
            $("#lastNameUserm").val(respuesta["apellidos"]);
            $("#sucursalUserm").val(respuesta["idSucursal"]);
            $("#emailUserm").val(respuesta["email"]);
            $("#roleUserm").val(respuesta["role"]);
            $("#passwordUserm").val(respuesta["password"]);
            $("#cuentaUserm").val(respuesta["cuentaBancaria"]);
            $("#directionUserm").val(respuesta["direccion"]);

            //$("#passwordActual").val(respuesta["password"]);

        }

    })
})

$(".btnDeleteUser").click(function(){

    var idEmpleado = $(this).attr("idEmpleado"); 
      
    Swal.fire({
        title: 'Estas seguro de eliminar el usuario?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Borrar'
    }).then((result) => {
        if(result.value){

            window.location = "index.php?ruta=users&idEmpleadoE="+idEmpleado;
        }
        
    })

})



/*function fotoUser(f){
    console.log(f.target.files)
    const name = f.target.files[0];
    
    const nameTemp = URL.createObjectURL(name);
    
    document.getElementById("img-preview").src = nameTemp;
}*/

//AGREGAR IMAGEN AL USUARIO
$(".image").change(function(){

    var imagen = this.files[0];

    console.log(imagen);

    /*$target_dir = "imagen/"; //directorio en el que se subira
    $target_file = $target_dir . basename($_FILES["image"]["name"]);//se añade el directorio y el nombre del archivo
    */
    if(imagen["type"] != "image/png" && imagen["type"] != "image/jpg" && imagen["type"] != "image/jpeg"){

            $(".image").val("");

                Swal.fire(
                    'Error!',
                    'La imagen debe de estar en formato JPG, PNG O JPEG!',
                    'error'
            );
    }else if(imagen["size"] > 10000000){

        $(".image").val("");

            Swal.fire(
                'Error!',
                'La imagen no debe de pesar mas de 10MB!',
                'error'
        );
        
    }else{

        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);

        $(datosImagen).on("load", function(event){
            var rutaImagen = event.target.result;
            $(".imageTemp").attr("src",rutaImagen);
        })
    }

})