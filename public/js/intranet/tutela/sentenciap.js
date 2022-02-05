$(document).ready(function() {
    $('#cajaCantiodad').addClass('d-none');
    $('#detalles0').addClass('d-none');
    $('.archivoAdjuntoC').addClass('d-none');

    $('input[type=radio][name=formaCarga]').change(function() {
        if (this.value == 'cantidad') {
            $('#cajaCantiodad').removeClass('d-none');
            $('#cajaDetalle').addClass('d-none');
        } else if (this.value == 'detalle') {
            $('#cajaDetalle').removeClass('d-none');
            $('#cajaCantiodad').addClass('d-none');
        }
    });

    $("#anadirResuelve").click(function() {
        var cantElem = 0;
        $("#detalles0").clone().appendTo("#cajaDetalleP");
        $(".detallesTarjeta").each(function(indice, elemento) {
            if (cantElem > 0) {
                $(elemento).removeClass("d-none");
                $(elemento).attr('id', 'detalles' + cantElem);
                //---------------------------------------------------
                $(elemento).find('input#numeracion').attr('name', 'numeracion' + cantElem);
                $(elemento).find('input#numeracion').val(cantElem);
                $(elemento).find('input#numeracion').attr('id', 'numeracion' + cantElem);
                //---------------------------------------------------
                $(elemento).find('textarea#resuelve').attr('name', 'resuelve' + cantElem);
                $(elemento).find('textarea#resuelve').attr("required", "true");
                $(elemento).find('textarea#resuelve').attr('id', 'resuelve' + cantElem);
                //---------------------------------------------------
                $(elemento).find('label#resuelveLabel').attr('name', 'resuelveLabel' + cantElem);
                $(elemento).find('label#resuelveLabel').html('Resuelve N° ' + cantElem);
                $(elemento).find('label#resuelveLabel').attr('id', 'resuelveLabel' + cantElem);
                //---------------------------------------------------
                $(elemento).find('input#dias').attr('name', 'dias' + cantElem);
                $(elemento).find('input#dias').attr('id', 'dias' + cantElem);
                //---------------------------------------------------
                $(elemento).find('label#diasLabel').attr('name', 'diasLabel' + cantElem);
                $(elemento).find('label#diasLabel').attr('id', 'diasLabel' + cantElem);
                //---------------------------------------------------
                $(elemento).find('input#horas').attr('name', 'horas' + cantElem);
                $(elemento).find('input#horas').attr('id', 'horas' + cantElem);
                //---------------------------------------------------
                $(elemento).find('label#horasLabel').attr('name', 'horasLabel' + cantElem);
                $(elemento).find('label#horasLabel').attr('id', 'horasLabel' + cantElem);
                //---------------------------------------------------
                $(elemento).find('a').attr('idResuelve', cantElem);
                $(elemento).find('a').attr("onclick", "eliminarDiv(" + cantElem + ")");
                //---------------------------------------------------
                $(elemento).hide();
                $(elemento).show();
            }
            cantElem++;
        });
        $('#catnResuelves').val(cantElem - 1);
    });

    $("#anadirArchivoAdjunto").click(function() {
        var cantElem = 0;
        $("#archivoAdjuntoC0").clone().appendTo("#cajaAdjunto");
        $(".archivoAdjuntoC").each(function(indice, elemento) {
            if (cantElem > 0) {
                $(elemento).removeClass("d-none");
                $(elemento).attr('id', 'archivoAdjuntoC' + cantElem);
                //---------------------------------------------------
                $(elemento).find('input#url_anexo0').attr('name', 'url_anexo' + cantElem);
                $(elemento).find('input#url_anexo0').attr('id', 'url_anexo' + cantElem);
                //---------------------------------------------------
                $(elemento).find('input#titulo_anexo0').attr('name', 'titulo_anexo' + cantElem);
                $(elemento).find('input#titulo_anexo0').attr('id', 'titulo_anexo' + cantElem);
                //---------------------------------------------------
                $(elemento).find('textarea#descripcion_anexo0').attr('name', 'descripcion_anexo' + cantElem);
                $(elemento).find('textarea#descripcion_anexo0').attr('id', 'descripcion_anexo' + cantElem);
                //---------------------------------------------------
                $(elemento).find('a').attr('idAnexo', cantElem);
                $(elemento).find('a').attr("onclick", "eliminarAnexo(" + cantElem + ")");
                //---------------------------------------------------
                $(elemento).hide();
                $(elemento).show();
            }
            cantElem++;
        });
        $('#cantAdjuntos').val(cantElem - 1);
    });
});

function eliminarDiv(id) {
    var cantElem = 0;
    $("#detalles" + id).remove();
    $(".detallesTarjeta").each(function(indice, elemento) {
        if (cantElem > 0) {
            $(elemento).removeClass("d-none");
            $(elemento).attr('id', 'detalles' + cantElem);
            //---------------------------------------------------
            $(elemento).find('input.numeracion').attr('name', 'numeracion' + cantElem);
            $(elemento).find('input.numeracion').val(cantElem);
            $(elemento).find('input.numeracion').attr('id', 'numeracion' + cantElem);
            //---------------------------------------------------
            $(elemento).find('textarea.resuelve').attr('name', 'resuelve' + cantElem);
            $(elemento).find('textarea.resuelve').attr("required", "true");
            $(elemento).find('textarea.resuelve').attr('id', 'resuelve' + cantElem);
            //---------------------------------------------------
            $(elemento).find('label.resuelveLabel').attr('name', 'resuelveLabel' + cantElem);
            $(elemento).find('label.resuelveLabel').html('Resuelve N° ' + cantElem);
            $(elemento).find('label.resuelveLabel').attr('id', 'resuelveLabel' + cantElem);
            //---------------------------------------------------
            $(elemento).find('input.dias').attr('name', 'dias' + cantElem);
            $(elemento).find('input.dias').attr('id', 'dias' + cantElem);
            //---------------------------------------------------
            $(elemento).find('input.horas').attr('name', 'horas' + cantElem);
            $(elemento).find('input.horas').attr('id', 'horas' + cantElem);
            //---------------------------------------------------
            $(elemento).find('a').attr('idResuelve', cantElem);
            $(elemento).find('a').attr("onclick", "eliminarDiv(" + cantElem + ")");
            //---------------------------------------------------
            $(elemento).hide();
            $(elemento).show();
        }
        cantElem++;
    });
    $('#catnResuelves').val(cantElem - 1);
}

function eliminarAnexo(id) {
    var cantElem = 0;
    $("#archivoAdjuntoC" + id).remove();


    $(".archivoAdjuntoC").each(function(indice, elemento) {
        if (cantElem > 0) {
            $(elemento).removeClass("d-none");
            $(elemento).attr('id', 'archivoAdjuntoC' + cantElem);
            //---------------------------------------------------
            $(elemento).find('input.url_anexo0').attr('name', 'url_anexo' + cantElem);
            $(elemento).find('input.url_anexo0').attr('id', 'url_anexo' + cantElem);
            //---------------------------------------------------
            $(elemento).find('input.titulo_anexo0').attr('name', 'titulo_anexo' + cantElem);
            $(elemento).find('input.titulo_anexo0').attr('id', 'titulo_anexo' + cantElem);
            //---------------------------------------------------
            $(elemento).find('textarea.descripcion_anexo0').attr('name', 'descripcion_anexo' + cantElem);
            $(elemento).find('textarea.descripcion_anexo0').attr('id', 'descripcion_anexo' + cantElem);
            //---------------------------------------------------
            $(elemento).find('a').attr('idAnexo', cantElem);
            $(elemento).find('a').attr("onclick", "eliminarAnexo(" + cantElem + ")");
            //---------------------------------------------------
            $(elemento).hide();
            $(elemento).show();
        }
        cantElem++;
    });

    $('#cantAdjuntos').val(cantElem - 1);
}