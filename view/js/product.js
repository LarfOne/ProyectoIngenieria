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
            $(".img-thumbnail").attr("src", rutaImagen);
        })
    }

})



