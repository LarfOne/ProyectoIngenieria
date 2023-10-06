const formAddActivo = document.getElementById('formAddActivo');
const formUpdateActivo = document.getElementById('formUpdateActivo');

const codigoActivomInput = document.getElementById('codigoActivom');

const idSucursalActivoInput = document.getElementById('idSucursalActivo');
const idSucursalActivomInput = document.getElementById('idSucursalActivom');

const descripcionActivoInput = document.getElementById('descripcionActivo');
const descripcionActivomInput = document.getElementById('descripcionActivom');

const estadoActivoInput = document.getElementById('estadoActivo');
const estadoActivomInput = document.getElementById('estadoActivom');

const empleado_idInput = document.getElementById('empleado_id');
const empleado_idmInput = document.getElementById('empleado_idm');

if(formAddActivo !== null && formUpdateActivo !== null) {
    // Verificaciones para el formulario de agregar activo
    formAddActivo.addEventListener('submit', function(event) {
        // Verifica si los campos están vacíos
        if (idSucursalActivoInput.value === '' || descripcionActivoInput.value === '' || estadoActivoInput.value === '' || sucursalUserInput.value === '' ||
            empleado_idInput.value === '') {
            event.preventDefault(); // Evita que el formulario se envíe

            // Muestra un mensaje de error o realiza otra acción
            alert('Por favor, completa todos los campos obligatorios.');
        }
    });


    // Verificaciones para el formulario de modificar activo
    formUpdateActivo.addEventListener('submit', function(event) {
        // Verifica si los campos están vacíos
        if (codigoActivomInput.value === '' || idSucursalActivomInput.value === '' || descripcionActivomInput.value === '' || estadoActivomInput.value === '' || sucursalUserInput.value === '' ||
            empleado_idmInput.value === '') {
            event.preventDefault(); // Evita que el formulario se envíe

            // Muestra un mensaje de error o realiza otra acción
            alert('Por favor, completa todos los campos obligatorios.');
        }
    });
}


$(".btnUpdateActivo").click(function(){
    var codigo = $(this).attr("codigo");

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

            $("#codigoActivom").val(respuesta["codigo"]);
            $("#idSucursalActivom").val(respuesta["idSucursal"]);
            $("#descripcionActivom").val(respuesta["descripcion"]);
            $("#estadoActivom").val(respuesta["estado"]);
            $("#empleado_idm").val(respuesta["empleado_id"]);


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

$('#codigoActivom').on('keypress input', function(e) {
    validarCodigoActivo(e);
});

/*$('#idSucursalActivo, #idSucursalActivom').on('keypress input', function(e) {
    validarInputUser(e, 45);
});*/

$('#descripcionActivo, #descripcionActivom').on('keypress input', function(e) {
    validarInputActivo(e, 45);
});

$('#estadoActivo, #estadoActivom').on('keypress input', function(e) {
    validarInputActivo(e, 45);
});

/*$('#empleado_id, #empleado_idm').on('keypress input', function(e) {
    validarInputUser(e, 45);
});*/


function validarCodigoActivo(e) {
    let input = e.target.value;

    if (e.keyCode <= 47 || e.keyCode >= 58 || input.length >= 10) {
        e.preventDefault();
    }
}

function validarInputActivo(e, maxLength) {
    let input = e.target.value;

    if (input.length >= maxLength) {
        e.preventDefault();
    }
}