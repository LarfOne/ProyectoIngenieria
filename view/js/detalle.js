

$(".btnImprimirTicket").click(function(){
    var codigoDetalle= $(this).attr("codigoDetalle");
    var datas = new FormData();

    datas.append("codigoDetalle", codigoDetalle);

    $.ajax({

        url:"ajax/detalleAjax.php",
        method:"POST",
        data: datas,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){



        }

    })
})




$(".btnImprimirFactura").click(function(){
    var codigoDetalle= $(this).attr("codigoDetalle");
    var datas = new FormData();

    datas.append("codigoDetalle", codigoDetalle);

    $.ajax({

        url:"ajax/detalleAjax.php",
        method:"POST",
        data: datas,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){


        }

    })
})

