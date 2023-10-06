// Obtén el formulario y los elementos de entrada
const formClienteAdd = document.getElementById('modalAddClient');
const formClienteUpdate = document.getElementById('modalUpdateClient');

const idClienteInput = document.getElementById('idCliente');
const idClientemInput = document.getElementById('idClientem');

const nomClienteInput = document.getElementById('nomCliente');
const nomClientemInput = document.getElementById('nomClientem');

const telefonoCliInput = document.getElementById('telefonoCli');
const telefonoClimInput = document.getElementById('telefonoClim');

const emailCliInput = document.getElementById('email');
const emailClimInput = document.getElementById('emailm');

const direccionCliInput = document.getElementById('direccion');
const direccionClimInput = document.getElementById('direccionm');

if(formClienteAdd !== null && formClienteUpdate !== null) {
    // Verificaciones para el formulario de agregar usuario
    formClienteAdd.addEventListener('submit', function(event) {
        // Verifica si los campos están vacíos
        if (idClienteInput.value === '' || nomClienteInput.value === '' || telefonoCliInput.value === '' ||
            emailCliInput.value === '' || direccionCliInput.value === '') {
            event.preventDefault(); // Evita que el formulario se envíe

            // Muestra un mensaje de error o realiza otra acción
            alert('Por favor, completa todos los campos obligatorios.');
        }
    });

    // Agrega un controlador de evento al enviar el formulario
    formClienteUpdate.addEventListener('submit', function(event) {
        // Verifica si los campos están vacíos
        if (idClientemInput.value === '' || nomClientemInput.value === '' || telefonoClimInput.value === '' ||
            emailClimInput.value === '' || direccionClimInput.value === '') {
            event.preventDefault(); // Evita que el formulario se envíe

            // Muestra un mensaje de error o realiza otra acción
            alert('Por favor, completa todos los campos obligatorios.');
        }
    });    
}


$(".btnUpdateClient").click(function(){
    var idClient = $(this).attr("idClient");
    var datas = new FormData();

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

            $("#idClientem").val(respuesta["cedula"]);
            $("#nomClientem").val(respuesta["nomCliente"]);
            $("#telefonoClim").val(respuesta["telefonoCli"]);
            $("#emailm").val(respuesta["email"]);
            $("#direccionm").val(respuesta["direccion"]);



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

$('#idCliente, #idClientem').on('keypress', function(e) {
    let charCode = e.which ? e.which : e.keyCode;

    if (!esNumeroOLetraCliente(charCode)) {
        e.preventDefault();
    }

    if (e.target.value.length >= 20) {
        e.preventDefault();
    }
});

$('#nomCliente, #nomClientem').on('keypress input', function(e) {
    validarInputCliente(e, 70);
});

$('#telefonoCli, #telefonoClim').on('keypress input', function(e) {
    validarTelefonoCliente(e);
});

$('#email, #emailm').on('keypress input', function(e) {
    validarInputCliente(e, 45);
});

$('#direccion, #direccionm').on('keypress input', function(e) {
    validarInputCliente(e, 45);
});

function esNumeroOLetraCliente(charCode) {
    return (charCode >= 48 && charCode <= 57) || // Números
           (charCode >= 65 && charCode <= 90) || // Letras mayúsculas
           (charCode >= 97 && charCode <= 122);  // Letras minúsculas
}

function validarTelefonoCliente(e) {
    let input = e.target.value;

    // Permitir solo números (código ASCII entre 47 y 58)
    if (e.keyCode <= 47 || e.keyCode >= 58 || input.length >= 8) {
        e.preventDefault();
    }
}

function validarInputCliente(e, maxLength) {
    let input = e.target.value;

    if (input.length >= maxLength) {
        e.preventDefault();
    }
}