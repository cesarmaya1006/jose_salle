$(document).ready(function() {
    $("#form_fechas").submit(function(e) {
        e.preventDefault();
        const form = $(this);
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(respuesta) {
                console.log(respuesta);
                if (respuesta.mensaje == "ok") {
                    Sistema.notificaciones('Se registraron las fehcas de manera correcta correctamente', 'Sistema', 'success');
                } else {
                    Sistema.notificaciones('El registro no pudo ser eliminado, hay recursos usandolo', 'Sistema', 'error');
                }
            },
            error: function() {

            }
        });
    });
});
