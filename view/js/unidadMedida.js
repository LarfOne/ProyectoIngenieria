// Obtén el formulario y los elementos de entrada
const modalAddUnit = document.getElementById('modalAddUnit');
const modalUpdateUnit = document.getElementById('modalUpdateUnit');

const nameUnitInput = document.getElementById('nameUnit');
const nameUnitmInput = document.getElementById('nameUnitm');
const idUnitmInput = document.getElementById('idUnitm');

if(modalAddUnit != null && modalUpdateUnit != null){
   // Verificaciones para el formulario de agregar usuario
   modalAddUnit.addEventListener('submit', function(event) {
        // Verifica si los campos están vacíos
        if (nameUnitInput.value === '') {
            event.preventDefault(); // Evita que el formulario se envíe
            // Muestra un mensaje de error o realiza otra acción
            alert('Por favor, completa todos los campos obligatorios.');
        }
    });

    // Agrega un controlador de evento al enviar el formulario
    modalUpdateUnit.addEventListener('submit', function(event) {
        // Verifica si los campos están vacíos
        if (nameUnitmInput.value === '' || idUnitmInput.value === '') {
            event.preventDefault(); // Evita que el formulario se envíe
            // Muestra un mensaje de error o realiza otra acción
            alert('Por favor, completa todos los campos obligatorios.');
        }
    }); 
}



$(".btnUpdateUnit").click(function(){
    var idUnit = $(this).attr("idUnit");
    var datas = new FormData();
    console.log(idUnit);
    datas.append("idUnit", idUnit);

    $.ajax({

        url:"ajax/unidadAjax.php",
        method:"POST",
        data: datas,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            console.log("respuesta", respuesta);
            $("#idUnitm").val(respuesta["codigo"]);
            $("#nameUnitm").val(respuesta["nombre"]);
            
        }
    })
})

$(".btnDeleteUnit").click(function(){

    var codigoM = $(this).attr("codigoM"); 


    Swal.fire({
        title: 'Estas seguro de eliminar la Unidad de Medida?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Borrar'
    }).then((result) => {
        if(result.value){

            window.location = "index.php?ruta=unidadMedida&idUnitE="+codigoM;
        }

    })

})

$('#nameUnit, #nameUnitm').on('keypress input', function(e) {
    validarInputUnit(e, 60);
});

function validarInputUnit(e, maxLength) {
    let input = e.target.value;

    if (input.length >= maxLength) {
        e.preventDefault();
    }
}