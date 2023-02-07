$(".btnUpdateCategories").click(function(){
    var idCategories = $(this).attr("idCategories");
    var datas = new FormData();

    datas.append("idCategories", idCategories);

    $.ajax({

        url:"ajax/categoriesAjax.php",
        method:"POST",
        data: datas,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

            $("#idCategoriesm").val(respuesta["codigo"]);
            $("#nameCategoriesm").val(respuesta["nombre"]);
            

            console.log("respuesta", respuesta);

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
