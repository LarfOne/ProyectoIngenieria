const passwordError = document.getElementById('password-error');
const passwordErrorm = document.getElementById('password-errorm');

// Obtén el formulario y los elementos de entrada
const formUserAdd = document.getElementById('modalAddUser');
const formUserUpdate = document.getElementById('modalUpdateUser');

const idUserInput = document.getElementById('idUser');
const idUsermInput = document.getElementById('idUserm');

const nameUserInput = document.getElementById('nameUser');
const nameUsermInput = document.getElementById('nameUserm');

const lastNameUserInput = document.getElementById('lastNameUser');
const lastNameUsermInput = document.getElementById('lastNameUserm');

const sucursalUserInput = document.getElementById('sucursalUser');
const sucursalUsermInput = document.getElementById('sucursalUserm');

const emailUserInput = document.getElementById('emailUser');
const emailUsermInput = document.getElementById('emailUserm');

const roleUserInput = document.getElementById('roleUser');
const roleUsermInput = document.getElementById('roleUserm');

const passwordUserInput = document.getElementById('passwordUser');
const passwordUsermInput = document.getElementById('passwordUserm');

const cuentaUserInput = document.getElementById('cuentaUser');
const cuentaUsermInput = document.getElementById('cuentaUserm');

const directionUserInput = document.getElementById('directionUser');
const directionUsermInput = document.getElementById('directionUserm');

const estadoUserInput = document.getElementById('estadoUser');
const estadoUsermInput = document.getElementById('estadoUserm');

const telefonoUserInput = document.getElementById('telefonoUser');
const telefonoUsermInput = document.getElementById('telefonoUserm');

const rolesPermitidos = ['Administrador', 'Usuario', 'SuperAdmin'];
const estadosPermitidos = ['Activo', 'Inactivo'];




let role = "";
let roleUsuario = "";
if(formUserAdd !== null && formUserUpdate != null){
    // Verificaciones para el formulario de agregar usuario
    formUserAdd.addEventListener('submit', function(event) {
        // Verifica si los campos están vacíos
        if (idUserInput.value === '' || nameUserInput.value === '' || lastNameUserInput.value === '' || sucursalUserInput.value === '' ||
            emailUserInput.value === '' || roleUserInput.value === '' || passwordUserInput.value === '' || cuentaUserInput.value === '' ||
            directionUserInput.value === '' || estadoUserInput.value === '' || telefonoUserInput.value==='') {
            event.preventDefault(); // Evita que el formulario se envíe

            // Muestra un mensaje de error o realiza otra acción
            alert('Por favor, completa todos los campos obligatorios.');
        }else if(!validarLongitudPassword()){
            event.preventDefault(); // Evita que el formulario se envíe
            // Muestra un mensaje de error o realiza otra acción
            alert('Debes de digitar una contraseña valida.');
        }else if(roleUserInput.value === '' || !rolesPermitidos.includes(roleUserInput.value)) {
            event.preventDefault(); // Evita que el formulario se envíe
            // Muestra un mensaje de error o realiza otra acción
            alert('Por favor, selecciona un perfil válido.');
        }else if(!estadosPermitidos.includes(estadoUserInput.value)){
            event.preventDefault(); // Evita que el formulario se envíe
            // Muestra un mensaje de error o realiza otra acción
            alert('Por favor, selecciona un estado válido.');
        }
    });

    // Agrega un controlador de evento al enviar el formulario
    formUserUpdate.addEventListener('submit', function(event) {
        // Verifica si los campos están vacíos
        if (idUsermInput.value === '' || nameUsermInput.value === '' || lastNameUsermInput.value === '' || sucursalUsermInput.value === '' ||
            emailUsermInput.value === '' || roleUsermInput.value === '' || cuentaUsermInput.value === '' ||
            directionUsermInput.value === '' || estadoUsermInput.value === '' || telefonoUsermInput.value ==='') {
            event.preventDefault(); // Evita que el formulario se envíe

            // Muestra un mensaje de error o realiza otra acción
            alert('Por favor, completa todos los campos obligatorios.');
        }else if(!validarLongitudPasswordm()){
            event.preventDefault(); // Evita que el formulario se envíe
            // Muestra un mensaje de error o realiza otra acción
            alert('Debes de digitar una contraseña valida.');
        }else if(role === 'SuperAdmin' && (roleUsuario === "Administrador" || roleUsuario === "Usuario")){
            event.preventDefault(); // Evita que el formulario se envíe
            // Muestra un mensaje de error o realiza otra acción
            alert('No puedes editar un super administrador.');
        }else if(roleUsermInput.value === '' || !rolesPermitidos.includes(roleUsermInput.value)) {
            event.preventDefault(); // Evita que el formulario se envíe
            // Muestra un mensaje de error o realiza otra acción
            alert('Por favor, selecciona un perfil válido.');
        }else if(!estadosPermitidos.includes(estadoUsermInput.value)){
            event.preventDefault(); // Evita que el formulario se envíe
            // Muestra un mensaje de error o realiza otra acción
            alert('Por favor, selecciona un estado válido.');
        }
    });
    }


/**EDITAR USUARIO */

$(".btnUpdateUser").click(function() {
    let idEmpleado = $(this).attr("idEmpleado");

    let datas = new FormData();

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
            role = respuesta["role"];
            roleUsuario = document.getElementById("sessionRole").value;

            if(respuesta["role"] === "SuperAdmin" && (roleUsuario === "Administrador" || roleUsuario === "Usuario")){

                $("#idUserm").val(respuesta["cedula"]);
                $("#nameUserm").val(respuesta["nombre"]);
                $("#lastNameUserm").val(respuesta["apellidos"]);
                $("#sucursalUserm").val(respuesta["idSucursal"]);
                $("#emailUserm").val(respuesta["email"]);
                $("#roleUserm").val(respuesta["role"]);
                $("#passwordActual").val(respuesta["password"]);
                $("#cuentaUserm").val(respuesta["cuentaBancaria"]);
                $("#directionUserm").val(respuesta["direccion"]);
                $("#estadoUserm").val(respuesta["estado"]);
                $("#telefonoUserm").val(respuesta["telefono"]);
                $("#fotoActual").val(respuesta["image"]);

                if (respuesta["image"] != null && respuesta["image"] != "") {



                }else{

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
                $('#telefonoUserm').prop('readonly', true);
                $('#imageUpdateUser').prop('disabled', true);
                $('#passwordUserm').prop('readonly', true);
                //$('#btnModificarUser').prop('disabled', true);

            }else{
                $("#idUserm").val(respuesta["cedula"]);
                $("#nameUserm").val(respuesta["nombre"]);
                $("#lastNameUserm").val(respuesta["apellidos"]);
                $("#sucursalUserm").val(respuesta["idSucursal"]);
                $("#emailUserm").val(respuesta["email"]);
                $("#roleUserm").val(respuesta["role"]);
                $("#passwordActual").val(respuesta["password"]);
                $("#cuentaUserm").val(respuesta["cuentaBancaria"]);
                $("#directionUserm").val(respuesta["direccion"]);
                $("#estadoUserm").val(respuesta["estado"]);
                $('#telefonoUserm').val(respuesta["telefono"]);
                $("#fotoActual").val(respuesta["image"]);
                if (respuesta["image"] != null && respuesta["image"] != "") {

                    $(".imageTemp").attr("src", respuesta["image"]);
                    
                }else{

                    $(".imageTemp").attr("src", "imagen/userDefault.png");
                }

                $('#idUserm').prop('readonly', true);
                $('#nameUserm').prop('readonly', false);
                $('#lastNameUserm').prop('readonly', false);
                $('#sucursalUserm').prop('disabled', false);
                $('#emailUserm').prop('readonly', false);
                $('#roleUserm').prop('disabled', false);
                $('#passwordActual').prop('readonly', false);
                $('#cuentaUserm').prop('readonly', false);
                $('#directionUserm').prop('readonly', false);
                $('#estadoUserm').prop('disabled', false);
                $('#telefonoUserm').prop('readonly', false);
                $('#imageUpdateUser').prop('disabled', false);
                $('#passwordUserm').prop('readonly', false);
                $('#btnModificarUser').prop('disabled', false);
            }
            

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


$('#idUser, #idUserm').on('keypress', function(e) {
    let charCode = e.which ? e.which : e.keyCode;

    if (!esNumeroOLetraUsuario(charCode)) {
        e.preventDefault();
    }

    if (e.target.value.length >= 20) {
        e.preventDefault();
    }
});

$('#nameUser, #nameUserm').on('keypress input', function(e) {
    validarInputUser(e, 45);
});

$('#lastNameUser, #lastNameUserm').on('keypress input', function(e) {
    validarInputUser(e, 45);
});

$('#emailUser, #emailUserm').on('keypress input', function(e) {
    validarInputUser(e, 50);
});

$('#passwordUser, #passwordUserm').on('keypress input', function(e) {
    validarInputUser(e, 20);
});

$('#cuentaUser, #cuentaUserm').on('keypress input', function(e) {
    validarInputUser(e, 45);
});

$('#directionUser, #directionUserm').on('keypress input', function(e) {
    validarInputUser(e, 200);
});

$('#cuentaUser, #cuentaUserm').on('keypress input', function(e) {
    validarInputUser(e, 45);
});

$('#telefonoUser, #telefonoUserm').on('keypress input', function(e) {
    validarTelefonoUser(e);
});

function validarInputUser(e, maxLength) {
    let input = e.target.value;

    if (input.length >= maxLength) {
        e.preventDefault();
    }
}

function validarTelefonoUser(e) {
    let input = e.target.value;

    // Permitir solo números (código ASCII entre 47 y 58)
    if (e.keyCode <= 47 || e.keyCode >= 58 || input.length >= 8) {
        e.preventDefault();
    }
}

function esNumeroOLetraUsuario(charCode) {
    return (charCode >= 48 && charCode <= 57) || // Números
           (charCode >= 65 && charCode <= 90) || // Letras mayúsculas
           (charCode >= 97 && charCode <= 122);  // Letras minúsculas
}
if(passwordUserInput !== null && passwordUsermInput !== null){
    passwordUserInput.addEventListener('blur', validarLongitudPassword);

    function validarLongitudPassword() {
        const password = passwordUserInput.value;

        if (password.length < 8) {
            passwordError.style.display = 'block';
            return false;
        } else {
            passwordError.style.display = 'none';
            return true;
        }
    }

    passwordUsermInput.addEventListener('blur', validarLongitudPasswordm);

    function validarLongitudPasswordm() {
        const password = passwordUsermInput.value;
        if (password.length >= 8 || password.length == 0) {
            passwordErrorm.style.display = 'none';
            return true;
        } else{
            passwordErrorm.style.display = 'block';
            return false;
        }
    }
}






