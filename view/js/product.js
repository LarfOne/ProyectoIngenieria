
// Obtén el formulario y los elementos de entrada
const formProductAdd = document.getElementById('formProducto');

const idProductoInput = document.getElementById('idProducto');

const nameProductoInput = document.getElementById('nameProducto');

const marcaProductoInput = document.getElementById('marcaProducto');

const descriptionProductoInput = document.getElementById('descriptionProducto');

const cantProductoInput = document.getElementById('cantProducto');

const idSucursalProductoInput = document.getElementById('idSucursalProducto');

const unitProductoInput = document.getElementById('unitProducto');

const porcProductoInput = document.getElementById('porcProducto');

const precioNetoInput = document.getElementById('precioNeto');

const precioTotalInput = document.getElementById('precioTotal');

const ivaProductoInput = document.getElementById('ivaProducto');

const cateProductoInput = document.getElementById('cateProducto');

const obsProductoInput = document.getElementById('obsProducto');

if(formProductAdd !== null){
    // Verificaciones para el formulario de agregar usuario
    formProductAdd.addEventListener('submit', function(event) {
        // Verifica si los campos están vacíos
        if (idProductoInput.value === '' || nameProductoInput.value === '' || marcaProductoInput.value === '' || descriptionProductoInput.value === '' ||
            cantProductoInput.value === '' || idSucursalProductoInput.value === '' || unitProductoInput.value === '' || porcProductoInput.value === '' ||
            precioNetoInput.value === '' || precioTotalInput.value === '' || ivaProductoInput.value === '' ||
            cateProductoInput.value === '') {
            event.preventDefault(); // Evita que el formulario se envíe

            // Muestra un mensaje de error o realiza otra acción
            alert('Por favor, completa todos los campos obligatorios.');
        }
    });
}


$(".cerrarM").click(function(){
    $("#modalUpdateInventario").modal('hide')
})

let porcentaje = 0;
let precioTotal = 0;
let precioNeto = 0;
let precioIVA = 0;
let porc;

function obtenerPorcentaje() {
        porc = document.getElementById("porcProducto").value;
        porcentaje = parseFloat(porc) / 100;
        precioNeto = document.getElementById("precioNeto").value;

        if (porc !== "" && precioNeto !== "") {
            precioIVA = precioNeto * porcentaje;
            precioTotal = parseInt(precioNeto) + parseInt(precioIVA);

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

$('#porcProducto').on('blur', function() {
    obtenerPorcentaje();
});

$('#precioNeto').on('blur', function() {
    obtenerPrecioNeto();
});

$('#porcProducto').on('keypress input', function(e) {
    validarPorcentaje(e, 2);
});


$('#precioNeto').on('keypress input', function(e) {
    validarDatosNumericos(e, 10);
});

$('#cantProducto').on('keypress input', function(e) {
    validarDatosNumericos(e, 45);
});

$('#idProducto').on('keypress input', function(e) {
    validarDatosNumericos(e, 18);
});

$('#nameProducto').on('keypress input', function(e) {
    validarInputProducto(e, 25);
});

$('#marcaProducto').on('keypress input', function(e) {
    validarInputProducto(e, 20);
});

$('#descriptionProducto').on('keypress input', function(e) {
    validarInputProducto(e, 50);
});

$('#obsProducto').on('keypress input', function(e) {
    validarInputProducto(e, 300);
});


function validarInputProducto(e, maxLength) {
    let input = e.target.value;

    if (input.length >= maxLength) {
        e.preventDefault();
    }
}

function validarDatosNumericos(e, maxLength) {
    let input = e.target.value;

    // Permitir solo números (código ASCII entre 48 y 57)
    if (e.keyCode <= 47 || e.keyCode >= 58 || input.length >= maxLength) {
        e.preventDefault();
    }
}


function validarPorcentaje(e, maxLength) {

    let input = e.target.value;

    // Permitir solo números (código ASCII entre 48 y 57)
    if (e.keyCode <= 47 || e.keyCode >= 58 || input.length >= maxLength) {
        e.preventDefault();
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



