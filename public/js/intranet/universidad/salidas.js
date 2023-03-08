$(document).ready(function () {
    //==========================================================================
    $("#producto_id").on("change", function (event) {
        const id = $(this).val();
        const url_t = $(this).attr('data_url');
        var data = {
            "id": id,
        };
        $.ajax({
            url: url_t,
            type: 'GET',
            data: data,
            success: function(respuesta) {
                console.log(respuesta);
                $("#cantidad").attr({
                    "max" : respuesta.stock,
                 });
            },
            error: function() {

            }
        });

    });
    //==========================================================================
});
