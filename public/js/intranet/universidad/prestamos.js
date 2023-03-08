
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
    //==========================================================================
    $('input:radio[name=tipousuario]').change(function () {
        const radio = $("input:radio[name=tipousuario]:checked").val();
        const url_t1 = $("input:radio[name=tipousuario]:checked").attr("data_url1");
        const url_t2 = $("input:radio[name=tipousuario]:checked").attr("data_url2");
        var url_t = "";
        var encabezadoFalla = "";
        if (radio == 3) {
            url_t = url_t1;
            $("#carrera_id").html('<option value="">Seleccione primero un área</option>');
            $("#persona_id").html('<option value="">Seleccione primero un cargo</option>');
            $('#facultad_label').html('Área');
            $('#carrera_label').html('Cargo');
        } else {
            url_t = url_t2;
            $("#carrera_id").html('<option value="">Seleccione primero una una facultad</option>');
            $("#persona_id").html('<option value="">Seleccione primero una carrera</option>');
            $('#facultad_label').html('Facultad');
            $('#carrera_label').html('Carrera');
        }
        $.ajax({
            url: url_t,
            type: "GET",
            success: function (respuesta) {
                respuesta_html = "";
                respuesta_html += '<option value="">---Seleccione---</option>';
                $.each(respuesta, function (index, item) {
                    if (radio == 3) {
                        respuesta_html += '<option value="' + item["id"] +'">' +item["area"] +"</option>";
                    } else {
                        respuesta_html += '<option value="' + item["id"] +'">' +item["facultad"] +"</option>";
                    }

                });
                $("#facultad_id").html(respuesta_html);

            },
            error: function () {},
        });
    });
    //==========================================================================
    //==========================================================================
    $("#facultad_id").on("change", function (event) {
        const url_t1 = $(this).attr("data_url1");
        const url_t2 = $(this).attr("data_url2");
        const id = $(this).val();
        const radio = $("input:radio[name=tipousuario]:checked").val();
        var url_t = "";
        var encabezadoFalla = "";
        if (radio == 3) {
            url_t = url_t1;
            encabezadoFalla ='<option value="">Seleccione primero un áera</option>';
            $("#persona_id").html('<option value="">Seleccione primero un cargo</option>');
        } else {
            url_t = url_t2;
            encabezadoFalla ='<option value="">Seleccione primero una facultad</option>';
            $("#persona_id").html('<option value="">Seleccione primero una carrera</option>');
        }
        var data = {
            id: id,
        };
        $.ajax({
            url: url_t,
            type: "GET",
            data: data,
            success: function (respuesta) {
                respuesta_html = "";
                if (id != "") {
                    respuesta_html +=
                        '<option value="">---Seleccione---</option>';
                } else {
                    respuesta_html += encabezadoFalla;
                }
                $.each(respuesta, function (index, item) {
                    if (radio == 3) {
                        respuesta_html += '<option value="' + item["id"] +'">' +item["cargo"] +"</option>";
                    } else {
                        respuesta_html += '<option value="' + item["id"] +'">' +item["carrera"] +"</option>";
                    }

                });
                $("#carrera_id").html(respuesta_html);

            },
            error: function () {},
        });
    });
    //==========================================================================
    //==========================================================================
    $("#carrera_id").on("change", function (event) {
        const url_t1 = $(this).attr("data_url1");
        const url_t2 = $(this).attr("data_url2");
        const id = $(this).val();
        const radio = $("input:radio[name=tipousuario]:checked").val();
        var url_t = "";
        var encabezadoFalla = "";
        if (radio == 3) {
            url_t = url_t1;
            encabezadoFalla ='<option value="">Seleccione primero un cargo</option>';
        } else {
            url_t = url_t2;
            encabezadoFalla ='<option value="">Seleccione primero una carrera</option>';
        }
        var data = {
            id: id,
            rol_id: radio,
        };
        $.ajax({
            url: url_t,
            type: "GET",
            data: data,
            success: function (respuesta) {
                respuesta_html = "";
                if (id != "") {
                    respuesta_html +=
                        '<option value="">---Seleccione---</option>';
                } else {
                    respuesta_html += encabezadoFalla;
                }
                $.each(respuesta, function (index, item) {
                        var nombreCompleto = "";
                        nombreCompleto +=item.nombre1;
                        if (item.nombre2!=null) {
                            nombreCompleto += ' '  + item.nombre2;
                        }
                        nombreCompleto += ' '  + item.apellido1;
                        if (item.apellido2!=null) {
                            nombreCompleto += ' '  + item.apellido2;
                        }

                        respuesta_html += '<option value="' + item["id"] +'">' + nombreCompleto +"</option>";
                });
                $("#persona_id").html(respuesta_html);
            },
            error: function () {},
        });
    });
    //==========================================================================
});
