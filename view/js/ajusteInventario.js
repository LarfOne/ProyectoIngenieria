// Obtener el objeto URLSearchParams con los parámetros de la URL
const urlParams = new URLSearchParams(window.location.search);

// Obtener el valor del parámetro 'codigo'
const codigo = urlParams.get('codigoInventario');


if(codigo != null){

    // Obtén el formulario y los elementos de entrada
const formProductUpdate = document.getElementById('formProductoAjuste');

const idProductoAjusteInput = document.getElementById('idProductoAjuste');

const nameProductoAjusteInput = document.getElementById('nameProductoAjuste');

const marcaProductoAjusteInput = document.getElementById('marcaProductoAjuste');

const descriptionProductoAjusteInput = document.getElementById('descriptionProductoAjuste');

const cantProductoAjusteInput = document.getElementById('cantProductoAjuste');

const idSucursalProductoAjusteInput = document.getElementById('idSucursalAjuste');

const unitProductoAjusteInput = document.getElementById('unitProductoAjuste');

const porcProductoAjusteInput = document.getElementById('porcProductoAjuste');

const precioNetoAjusteInput = document.getElementById('precioNetoAjuste');

const precioTotalAjusteInput = document.getElementById('precioTotalAjuste');

const ivaProductoAjusteInput = document.getElementById('ivaProductoAjuste');

const cateProductoAjusteInput = document.getElementById('cateProductoAjuste');


// Verificaciones para el formulario de agregar usuario
formProductUpdate.addEventListener('submit', function(event) {
    // Verifica si los campos están vacíos
    if (idProductoAjusteInput.value === '' || nameProductoAjusteInput.value === '' || marcaProductoAjusteInput.value === '' || descriptionProductoAjusteInput.value === '' ||
        cantProductoAjusteInput.value === '' || idSucursalProductoAjusteInput.value === '' || unitProductoAjusteInput.value === '' || porcProductoAjusteInput.value === '' ||
        precioNetoAjusteInput.value === '' || precioTotalAjusteInput.value === '' || ivaProductoAjusteInput.value === '' ||
        cateProductoAjusteInput.value === '') {
        event.preventDefault(); // Evita que el formulario se envíe

        // Muestra un mensaje de error o realiza otra acción
        alert('Por favor, completa todos los campos obligatorios.');
    }
});


    let datasInventario = new FormData();

    datasInventario.append("idInventario", codigo);

    $.ajax({
        url:"ajax/inventarioAjax.php",
        method:"POST",
        data: datasInventario,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            $("#codigoInventarioAjuste").val(respuesta["codigo"]);
            $("#idProductoAjuste").val(respuesta["idProducto"]);
            $("#idSucursalAjuste").val(respuesta["idSucursal"]);
            $("#existenciaAjuste").val(respuesta["cantidad"]);
            ajaxProducto();
        }
        
    })


    function ajaxProducto(){

        let datasProducto = new FormData();
        datasProducto.append("idProduct", document.getElementById("idProductoAjuste").value);

        $.ajax({
            url:"ajax/productAjax.php",
            method:"POST",
            data: datasProducto,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                console.log("respuestaP",respuesta);
                // Resto del código que usa la respuesta de la llamada AJAX
                $("#nameProductoAjuste").val(respuesta["nombre"]);
                $("#marcaProductoAjuste").val(respuesta["marca"]);
                $("#descriptionProductoAjuste").val(respuesta["descripcion"]);;
                $("#unitProductoAjuste").val(respuesta["unidadmedida"]);
                $("#porcProductoAjuste").val(respuesta["porcentajeIva"]);
                $("#precioNetoAjuste").val(respuesta["precioNeto"]);
                $("#precioTotalAjuste").val(respuesta["precioTotal"]);
                $("#cateProductoAjuste").val(respuesta["categoria"]);
                $("#obsProductoAjuste").val(respuesta["observaciones"]);
                $("#fotoActualProducto").val(respuesta["image"]);

                if(respuesta["image"] != null) {
                    $(".imageTempAjuste").attr("src", respuesta["image"]);
                } else {
                    $(".imageTempAjuste").attr("src", "imagen/computadoraDefault.png");
                }
            }
        });

    }

}

function obtenerPorcentajeAjuste() {
    porc = document.getElementById("porcProductoAjuste").value;
    porcentaje = Number.parseFloat(porc) / 100;
    precioNeto = document.getElementById("precioNetoAjuste").value

    if(porc != "" && precioNeto != ""){

        precioIVA = precioNeto * porcentaje;
        precioTotal = Number.parseInt(precioNeto) + Number.parseInt(precioIVA);
        
        $("#ivaProductoAjuste").val(precioIVA);
        $("#precioTotalAjuste").val(precioTotal);
    }

}

function obtenerPrecioNetoAjuste(){
    porc = document.getElementById("porcProductoAjuste").value;
    porcentaje = Number.parseFloat(porc) / 100;
    precioNeto = document.getElementById("precioNetoAjuste").value;

    if(porc != "" && precioNeto != ""){
        
        precioIVA = precioNeto * porcentaje;
        precioTotal = Number.parseInt(precioNeto) + Number.parseInt(precioIVA);

        $("#ivaProductoAjuste").val(precioIVA);
        $("#precioTotalAjuste").val(precioTotal);

    }
}

$('#porcProductoAjuste').on('blur', function() {
    obtenerPorcentajeAjuste();
});

$('#precioNetoAjuste').on('blur', function() {
    obtenerPrecioNetoAjuste();
});

$('#porcProductoAjuste').on('keypress input', function(e) {
    validarPorcentajeAjuste(e, 2);
});


$('#precioNetoAjuste').on('keypress input', function(e) {
    validarDatosNumericosAjuste(e, 10);
});

$('#cantProductoAjuste').on('keypress input', function(e) {
    validarDatosNumericosAjuste(e, 20);
});

$('#existenciaAjuste').on('keypress input', function(e) {
    validarDatosNumericosAjuste(e, 20);
});

$('#idProductoAjuste').on('keypress input', function(e) {
    validarDatosNumericosAjuste(e, 18);
});

$('#nameProductoAjuste').on('keypress input', function(e) {
    validarInputProductoAjuste(e, 25);
});

$('#marcaProductoAjuste').on('keypress input', function(e) {
    validarInputProductoAjuste(e, 20);
});

$('#descriptionProductoAjuste').on('keypress input', function(e) {
    validarInputProductoAjuste(e, 50);
});

$('#obsProductoAjuste').on('keypress input', function(e) {
    validarInputProductoAjuste(e, 300);
});


function validarInputProductoAjuste(e, maxLength) {
    let input = e.target.value;

    if (input.length >= maxLength) {
        e.preventDefault();
    }
}

function validarDatosNumericosAjuste(e, maxLength) {
    let input = e.target.value;

    // Permitir solo números (código ASCII entre 48 y 57)
    if (e.keyCode <= 47 || e.keyCode >= 58 || input.length >= maxLength) {
        e.preventDefault();
    }
}


function validarPorcentajeAjuste(e, maxLength) {

    let input = e.target.value;

    // Permitir solo números (código ASCII entre 48 y 57)
    if (e.keyCode <= 47 || e.keyCode >= 58 || input.length >= maxLength) {
        e.preventDefault();
    }

}

//AGREGAR IMAGEN AL PRODUCTO
$(".imageProductosAjuste").change(function() {

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


