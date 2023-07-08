// Obtén el formulario y los elementos de entrada
const formSucursalAdd = document.getElementById('modalAddSucursal');
const formSucursalUpdate = document.getElementById('modalUpdateSucursal');

const idSucursalInput = document.getElementById('idSucursal');
const idSucursalmInput = document.getElementById('idSucursalm');

const nameSucursalInput = document.getElementById('nameSucursal');
const nameSucursalmInput = document.getElementById('nameSucursalm');

const direccionSucursalInput = document.getElementById('direccionSucursal');
const direccionSucursalmInput = document.getElementById('direccionSucursalm');

const telefonoSucursalInput = document.getElementById('telefonoSucursal');
const telefonoSucursalmInput = document.getElementById('telefonoSucursalm');

const emailSucursalInput = document.getElementById('emailSucursal');
const emailSucursalmInput = document.getElementById('emailSucursalm');
if(formSucursalAdd != null && formSucursalUpdate != null){
    // Verificaciones para el formulario de agregar usuario
    formSucursalAdd.addEventListener('submit', function(event) {
        // Verifica si los campos están vacíos
        if (idSucursalInput.value === '' || nameSucursalInput.value === '' || direccionSucursalInput.value === ''||
            telefonoSucursalInput.value === '' || emailSucursalInput.value === '') {
            event.preventDefault(); // Evita que el formulario se envíe

            // Muestra un mensaje de error o realiza otra acción
            alert('Por favor, completa todos los campos obligatorios.');
        }
    });

    // Agrega un controlador de evento al enviar el formulario
    formSucursalUpdate.addEventListener('submit', function(event) {
        // Verifica si los campos están vacíos
        if (idSucursalmInput.value === '' || nameSucursalmInput.value === '' || direccionSucursalmInput.value === ''||
            telefonoSucursalmInput.value === '' || emailSucursalmInput.value === '') {
            event.preventDefault(); // Evita que el formulario se envíe

            // Muestra un mensaje de error o realiza otra acción
            alert('Por favor, completa todos los campos obligatorios.');
        }
    });
}


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

$('#idSucursal, #idSucursalm').on('keypress input', function(e) {
    validarCodigoSucursal(e);
});

$('#nameSucursal, #nameSucursalm').on('keypress input', function(e) {
    validarInputSucursal(e, 45);
})

$('#direccionSucursal, #direccionSucursalm').on('keypress input', function(e) {
    validarInputSucursal(e, 200);
})

$('#telefonoSucursal, #telefonoSucursalm').on('keypress input', function(e) {
    validarTelefonoSucursal(e);
})

$('#emailSucursal, #emailSucursalm').on('keypress input', function(e) {
    validarInputSucursal(e, 50);
})

function validarCodigoSucursal(e) {
    let input = e.target.value;

    // Permitir solo números (código ASCII entre 47 y 58)
    if (e.keyCode <= 47 || e.keyCode >= 58 || input.length >= 18) {
        e.preventDefault();
    }
}

function validarTelefonoSucursal(e) {
    let input = e.target.value;

    // Permitir solo números (código ASCII entre 47 y 58)
    if (e.keyCode <= 47 || e.keyCode >= 58 || input.length >= 10) {
        e.preventDefault();
    }
}

function validarInputSucursal(e, maxLength) {
    let input = e.target.value;

    if (input.length >= maxLength) {
        e.preventDefault();
    }
}
