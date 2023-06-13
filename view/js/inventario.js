$(".btnDeleteInventario").click(function() {
    var codigoProductM = $(this).attr("codigoProductM");
    var codigoInventarioM = $(this).attr("codigoInventarioM");

    Swal.fire({
        title: '¿Estás seguro de eliminar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Borrar'
    }).then((result) => {
        if (result.value) {
            if (codigoProductM && codigoInventarioM) {
                window.location = "index.php?ruta=inventarios&idProductE=" + codigoProductM + "&codigoInventarioE=" + codigoInventarioM;
            }
        }
    });
});
