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
            let roleUsuario = document.getElementById("sessionRole").value;
            console.log("roleUsuario", roleUsuario);
            console.log("respuesta", respuesta);
            if(respuesta["role"] === "SuperAdmin" && (roleUsuario === "Administrador" || roleUsuario === "Usuario")){
                let selectElement = document.getElementById("roleUserm");

                // Crear una nueva opción
                let newOption = document.createElement("option");
                newOption.value = "SuperAdmin";
                newOption.text = "Super Administrador";

                // Agregar la nueva opción al final del select
                selectElement.add(newOption);
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

                $('#idUserm').prop('readonly', true);
                $('#nameUserm').prop('readonly', true);
                $('#lastNameUserm').prop('readonly', true);
                $('#sucursalUserm').prop('disabled', true);
                $('#emailUserm').prop('readonly', true);
                $('#roleUserm').prop('disabled', true);
                $('#passwordActual').prop('readonly', true);
                $('#cuentaUserm').prop('readonly', true);
                $('#directionUserm').prop('readonly', true);
                $('#estadoUserm').prop('disabled', true);
                $('#imageUpdateUser').prop('disabled', true);
                $('#passwordUserm').prop('readonly', true);
                $('#btnModificarUser').prop('disabled', true);

            }else{
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

                $('#idUserm').prop('readonly', false);
                $('#nameUserm').prop('readonly', false);
                $('#lastNameUserm').prop('readonly', false);
                $('#sucursalUserm').prop('disabled', false);
                $('#emailUserm').prop('readonly', false);
                $('#roleUserm').prop('disabled', false);
                $('#passwordActual').prop('readonly', false);
                $('#cuentaUserm').prop('readonly', false);
                $('#directionUserm').prop('readonly', false);
                $('#estadoUserm').prop('disabled', false);
                $('#imageUpdateUser').prop('disabled', false);
                $('#passwordUserm').prop('readonly', false);
                $('#btnModificarUser').prop('disabled', false);
            }
            
            //$("#passwordActual").val(respuesta["password"]);

        }

    })
})

$(".btnDeleteUser").click(function() {

    let idEmpleado = $(this).attr("idEmpleado");
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

/*AGREGAR IMAGEN AL USUARIO*/
$(".imageUser").change(function() {

    let imagen = this.files[0];

    console.log(this.files[0]);

    if (imagen["type"] != "image/png" && imagen["type"] != "image/jpg" && imagen["type"] != "image/jpeg") {

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

        let datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);

        $(datosImagen).on("load", function(event) {
            let rutaImagen = event.target.result;
            $(".img-thumbnail").attr("src", rutaImagen);
        })
    }

})


$('#idUser').on('blur', function() {
    validarCedula();
});

function validarCedula() {
    let inputCedula = document.getElementById("idUser");
    let cedula = inputCedula.value;

    if (!/^\d+$/.test(cedula)) {
        alert("La cedula debe ser un número entero");
        inputCedula.value = 0; // Limpiar el campo de entrada
        inputCedula.focus(); // Colocar el foco en el campo de entrada
        return false; // Indicar que la validación no pasó
    }else if(codigo.length > 10){
        alert("La cedula debe contener como máximo 10 dígitos.");
        inputCedula.value = 0 // Limpiar el campo de entrada
        inputCedula.focus(); // Colocar el foco en el campo de entrada
        return false; // Indicar que la validación no pasó
    }

    return true; // Indicar que la validación pasó
}