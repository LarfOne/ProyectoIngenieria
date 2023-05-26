$(".cerrarM").click(function(){
    $("#modalUpdateInventario").modal('hide')
})

let porcentaje = 0;
let precioTotal = 0;
let precioNeto = 0;
let precioIVA = 0;
let porc;

function obtenerPorcentaje() {
    if(validarPorcentaje() == true){
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

$('#cantProducto').on('blur', function() {
    validarCantidad();
});

$('#idProducto').on('blur', function() {
    validarCodigo();
});

$('#nameProducto').on('blur', function() {
    validarNombre();
});

$('#marcaProducto').on('blur', function() {
    validarMarca();
});

$('#descriptionProducto').on('blur', function() {
    validarDescripcion();
});

$('#obsProducto').on('blur', function() {
    validarObservaciones();
});

$('#precioNeto').on('blur', function() {
    validarPrecioNeto();
});

function validarPrecioNeto() {
    let inputNeto = document.getElementById("precioNeto");
    let neto = inputNeto.value;

    if (!/^\d+$/.test(neto) || parseInt(neto) < 0) {
        alert("El precio neto debe de ser un numero entero mayor a 0.");
        inputNeto.value = 0; // Limpiar el campo de entrada
        inputNeto.focus(); // Colocar el foco en el campo de entrada
        return false; // Indicar que la validación no pasó
    }else if(neto.length > 10){
        alert("El precio neto debe contener como máximo 10 dígitos.");
        inputNeto.value = 0; // Limpiar el campo de entrada
        inputNeto.focus(); // Colocar el foco en el campo de entrada
        return false; // Indicar que la validación no pasó
    }

    return true; // Indicar que la validación pasó
}

function validarPorcentaje() {
    let inputPorcentaje = document.getElementById("porcProducto");
    let porcentaje = inputPorcentaje.value;

    if (!/^\d+$/.test(porcentaje) || parseInt(porcentaje) < 0 || parseInt(porcentaje) > 99) {
        alert("El porcentaje debe de ser un numero entero entre 0 y 99.");
        inputPorcentaje.value = 13; // Limpiar el campo de entrada
        inputPorcentaje.focus(); // Colocar el foco en el campo de entrada
        return false; // Indicar que la validación no pasó
    }

    return true; // Indicar que la validación pasó
}

function validarCantidad() {
    let inputCantidad = document.getElementById("cantProducto");
    let cantidad = inputCantidad.value;

    if (!/^\d+$/.test(cantidad) || parseInt(cantidad) < 1) {
        alert("La cantidad debe ser un número entero mayor a 0.");
        inputCantidad.value = 1; // Limpiar el campo de entrada
        inputCantidad.focus(); // Colocar el foco en el campo de entrada
        return false; // Indicar que la validación no pasó
    }else if(cantidad.length > 45){
        alert("La cantidad debe contener como máximo 45 dígitos.");
        inputCantidad.value = 1 // Limpiar el campo de entrada
        inputCantidad.focus(); // Colocar el foco en el campo de entrada
        return false; // Indicar que la validación no pasó
    }

    return true; // Indicar que la validación pasó
}


function validarCodigo() {
    let inputCodigo = document.getElementById("idProducto");
    let codigo = inputCodigo.value;

    if (!/^\d+$/.test(codigo)) {
        alert("La cantidad debe ser un número entero");
        inputCodigo.value = 0; // Limpiar el campo de entrada
        inputCodigo.focus(); // Colocar el foco en el campo de entrada
        return false; // Indicar que la validación no pasó
    }else if(codigo.length > 10){
        alert("El codigo debe contener como máximo 10 dígitos.");
        inputCodigo.value = 0 // Limpiar el campo de entrada
        inputCodigo.focus(); // Colocar el foco en el campo de entrada
        return false; // Indicar que la validación no pasó
    }

    return true; // Indicar que la validación pasó
}

function validarNombre() {
    let inputNombre = document.getElementById("nameProducto");
    let nombre = inputNombre.value;

    if (nombre.length > 20) {
        alert("El nombre no puede sobrepasar los 20 caracteres.");
        inputNombre.value = ""; // Limpiar el campo de entrada
        inputNombre.focus(); // Colocar el foco en el campo de entrada
        return false; // Indicar que la validación no pasó
    }

    return true; // Indicar que la validación pasó
}


function validarMarca() {
    let inputMarca = document.getElementById("marcaProducto");
    let marca = inputMarca.value;

    if (marca.length > 20) {
        alert("La marca no puede sobrepasar los 20 caracteres.");
        inputMarca.value = ""; // Limpiar el campo de entrada
        inputMarca.focus(); // Colocar el foco en el campo de entrada
        return false; // Indicar que la validación no pasó
    }

    return true; // Indicar que la validación pasó
}

function validarDescripcion() {
    let inputDescripcion = document.getElementById("descriptionProducto");
    let descripcion = inputDescripcion.value;

    if (descripcion.length > 45) {
        alert("La descripcion no puede sobrepasar los 45 caracteres.");
        inputDescripcion.value = ""; // Limpiar el campo de entrada
        inputDescripcion.focus(); // Colocar el foco en el campo de entrada
        return false; // Indicar que la validación no pasó
    }

    return true; // Indicar que la validación pasó
}

function validarObservaciones() {
    let inputObservaciones = document.getElementById("obsProducto");
    let observacion = inputObservaciones.value;

    if (observacion.length > 300) {
        alert("La descripcion no puede sobrepasar los 300 caracteres.");
        inputObservaciones.value = ""; // Limpiar el campo de entrada
        inputObservaciones.focus(); // Colocar el foco en el campo de entrada
        return false; // Indicar que la validación no pasó
    }

    return true; // Indicar que la validación pasó
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



