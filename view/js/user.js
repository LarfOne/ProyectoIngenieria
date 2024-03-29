/**EDITAR USUARIO */

$(".btnUpdateUser").click(function() {
    var idEmpleado = $(this).attr("idEmpleado");
    console.log("idEmpleado", idEmpleado);

    var datas = new FormData();

    datas.append("idEmpleado", idEmpleado);

    $.ajax({

        url: "ajax/userAjax.php",
        method: "POST",
        data: datas,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            console.log("respuesta", respuesta);

            $("#idUserm").val(respuesta["cedula"]);
            $("#nameUserm").val(respuesta["nombre"]);
            $("#lastNameUserm").val(respuesta["apellidos"]);
            $("#sucursalUserm").val(respuesta["idSucursal"]);
            $("#emailUserm").val(respuesta["email"]);
            $("#roleUserm").val(respuesta["role"]);
            //$("#passwordUserm").val(respuesta["password"]);
            $("#passwordActual").val(respuesta["password"]);
            $("#cuentaUserm").val(respuesta["cuentaBancaria"]);
            $("#directionUserm").val(respuesta["direccion"]);
            $("#estadoUserm").val(respuesta["estado"]);
            $("#fotoActual").val(respuesta["image"]);
            if (respuesta["image"] != null) {
                $(".imageTemp").attr("src", respuesta["image"]);
            } else {
                $(".imageTemp").attr("src", "imagen/userDefault.png");
            }
            //$("#passwordActual").val(respuesta["password"]);

        }

    })
})

$(".btnDeleteUser").click(function() {

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
        if (result.value) {

            window.location = "index.php?ruta=users&idEmpleadoE=" + idEmpleado;
        }

    })

})

/*AGREGAR IMAGEN AL USUARIO
$(".imageUser").change(function() {

    var imagen = this.files[0];

    console.log(this.files[0]);

    /*$target_dir = "imagen/"; //directorio en el que se subira
    $target_file = $target_dir . basename($_FILES["image"]["name"]);//se añade el directorio y el nombre del archivo
    */
    /*if (imagen["type"] != "image/png" && imagen["type"] != "image/jpg" && imagen["type"] != "image/jpeg") {

        $(".image").val("");

        Swal.fire(
            'Error!',
            'La imagen debe de estar en formato JPG, PNG O JPEG!',
            'error'
        );
    } else if (imagen["size"] > 10000000) {

        $(".image").val("");

        Swal.fire(
            'Error!',
            'La imagen no debe de pesar mas de 10MB!',
            'error'
        );

    } else {

        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);

        $(datosImagen).on("load", function(event) {
            var rutaImagen = event.target.result;
            $(".imageTemp").attr("src", rutaImagen);
        })
    }

})*/