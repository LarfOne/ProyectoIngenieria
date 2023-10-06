// Obtén el formulario y los elementos de entrada
const formCategoriesAdd = document.getElementById('modalAddCategories');
const formCategoriesUpdate = document.getElementById('modalUpdateCategories');

const nameCategoriesInput = document.getElementById('nameCategories');
const nameCategoriesmInput = document.getElementById('nameCategoriesm');
const idCategoriesmInput = document.getElementById('idCategoriesm');

if(formCategoriesAdd != null && formCategoriesUpdate != null){
   // Verificaciones para el formulario de agregar usuario
    formCategoriesAdd.addEventListener('submit', function(event) {
        // Verifica si los campos están vacíos
        if (nameCategoriesInput.value === '') {
            event.preventDefault(); // Evita que el formulario se envíe
            // Muestra un mensaje de error o realiza otra acción
            alert('Por favor, completa todos los campos obligatorios.');
        }
    });

    // Agrega un controlador de evento al enviar el formulario
    formCategoriesUpdate.addEventListener('submit', function(event) {
        // Verifica si los campos están vacíos
        if (nameCategoriesmInput.value === '' || idCategoriesmInput.value === '') {
            event.preventDefault(); // Evita que el formulario se envíe
            // Muestra un mensaje de error o realiza otra acción
            alert('Por favor, completa todos los campos obligatorios.');
        }
    }); 
}



$(".btnUpdateCategories").click(function(){
    var idCategories = $(this).attr("idCategories");
    var datas = new FormData();

    datas.append("idCategories", idCategories);

    $.ajax({

        url:"ajax/categoriaAjax.php",
        method:"POST",
        data: datas,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

            $("#idCategoriesm").val(respuesta["codigo"]);
            $("#nameCategoriesm").val(respuesta["nombre"]);

        }

    })
})

$(".btnDeleteCategories").click(function(){

    var codigoM = $(this).attr("codigoM"); 


    Swal.fire({
        title: 'Estas seguro de eliminar la Categoría?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Borrar'
    }).then((result) => {
        if(result.value){

            window.location = "index.php?ruta=categories&codigoE="+codigoM;
        }

    })

})

$('#nameCategories, #nameCategoriesm').on('keypress input', function(e) {
    validarInputCategories(e, 60);
});

function validarInputCategories(e, maxLength) {
    let input = e.target.value;

    if (input.length >= maxLength) {
        e.preventDefault();
    }
}