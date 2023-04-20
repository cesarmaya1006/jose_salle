$(document).ready(function () {
    $(".jurado_check").change(function() {
        if(this.checked) {
            valor= 1;
        }else{
            valor= 0;
        }
        const url_t = $(this).attr('data_url');
        var data = {
            "valor": valor,
            _token: $('input[name=_token]').val(),
        };
        $.ajax({
            url: url_t,
            type: 'POST',
            data: data,
            success: function(respuesta) {
                if (respuesta.mensaje == "ok") {
                    Sistema.notificaciones('Jurado asignado a la propuesta correctamente', 'Sistema', 'success');
                } else {
                    Sistema.notificaciones('Jurado desasociadoa a la propuesta correctamente', 'Sistema', 'warning');
                }
            },
            error: function() {

            }
        });
    });
});
