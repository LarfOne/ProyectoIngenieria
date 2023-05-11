let datosProductos = [];
$(".btnUpdateInventario").click(function(){
    var idProduct = $(this).attr("idProduct");
    var datas = new FormData();
    datas.append("idProduct", idProduct);
    $.ajax({
        url:"ajax/productAjax.php",
        method:"POST",
        data: datas,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            const infoProductos = {
                codigo: respuesta["codigo"],
                nombre: respuesta["nombre"],
                marca: respuesta["marca"],
                descripcion: respuesta["descripcion"],
                precioNeto: respuesta["precioNeto"],
                categoria: respuesta["categoria"],
                unidadMedida: respuesta["unidadmedida"],
                porcentajeIva: respuesta["porcentajeIva"],
                precioTotal: respuesta["precioTotal"],
                observaciones: respuesta["observaciones"],
                image: respuesta["image"],
                usuarioIngresa: respuesta["usuarioIngresa"]
            }
            datosProductos = [...datosProductos, infoProductos];
            let productos = JSON.stringify(datosProductos);
            localStorage.setItem("datosProductos",productos);
        }

    })
})

$(".btnDeleteInventario").click(function(){

    var codigoProductM = $(this).attr("codigoProductM"); 


    Swal.fire({
        title: 'Estas seguro de eliminar el producto?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Borrar'
    }).then((result) => {
        if(result.value){

            window.location = "index.php?ruta=inventarios&idProductE="+codigoProductM;
        }

    })
})

$(".cerrarM").click(function(){
    $("#modalUpdateInventario").modal('hide')
})

let porcentaje = 0;
let precioTotal = 0;
let precioNeto = 0;
let precioIVA = 0;
let porc;

function obtenerPorcentaje(){
    porc = document.getElementById("porcProducto").value;
    porcentaje = Number.parseFloat(porc) / 100;
    precioNeto = document.getElementById("precioNeto").value

    if(porc != "" && precioNeto != ""){

        precioIVA = precioNeto * porcentaje;
        precioTotal = Number.parseInt(precioNeto) + Number.parseInt(precioIVA);
        
        $("#ivaProducto").val(precioIVA);
        $("#precioTotal").val(precioTotal);
    }
}

function obtenerPrecioNeto(){
    porc = document.getElementById("porcProducto").value;
    porcentaje = Number.parseFloat(porc) / 100;
    precioNeto = document.getElementById("precioNeto").value;

    if(porc != "" && precioNeto != ""){
        
        precioIVA = precioNeto * porcentaje;
        precioTotal = Number.parseInt(precioNeto) + Number.parseInt(precioIVA);

        $("#ivaProducto").val(precioIVA);
        $("#precioTotal").val(precioTotal);

    }
}


//AGREGAR IMAGEN AL PRODUCTO
$(".imageProductos").change(function() {

    var imagen = this.files[0];

    console.log(this.files[0]);

    /*$target_dir = "imagen/"; //directorio en el que se subira
    $target_file = $target_dir . basename($_FILES["image"]["name"]);//se añade el directorio y el nombre del archivo
    */
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

        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);

        $(datosImagen).on("load", function(event) {
            var rutaImagen = event.target.result;
            $(".imageTemp").attr("src", rutaImagen);
        })
    }

})  



