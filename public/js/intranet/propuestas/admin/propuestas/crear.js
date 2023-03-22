$(document).ready(function () {
    $("#form_categorias").submit(function (e) {
        e.preventDefault();
        const myModal = new bootstrap.Modal(
            document.getElementById("exampleModal")
        );
        const form = $(this);
        $.ajax({
            url: form.attr("action"),
            type: "POST",
            data: form.serialize(),
            success: function (respuesta) {
                console.log(respuesta);
                if (respuesta.mensaje == "ok") {
                    respuesta_html =
                        '<option value="">---Seleccione---</option>';
                    $.each(respuesta.categorias, function (index, item) {
                        if (respuesta.categoria["id"] == item["id"]) {
                            respuesta_html +=
                                '<option value="' +
                                item["id"] +
                                '" selected>' +
                                item["categoria"] +
                                "</option>";
                        } else {
                            respuesta_html +=
                                '<option value="' +
                                item["id"] +
                                '">' +
                                item["categoria"] +
                                "</option>";
                        }
                    });
                    $("#categorias_id").html(respuesta_html);
                    myModal.hide();
                    Sistema.notificaciones(
                        "Se registro la categoria de manera correcta",
                        "Sistema",
                        "success"
                    );
                } else {
                    Sistema.notificaciones(
                        "El registro no pudo ser realizado",
                        "Sistema",
                        "error"
                    );
                }
            },
            error: function () {},
        });
    });
    $("#anadirComponente").on("click", function () {
        var hijos = $("#cajaComponentes").find(".componente_grupo");
        var cont = 0;
        hijos.each(function () {
            cont++;
            $(this).clone().appendTo("#cajaComponentes");
            console.log(cont);
        });
        cont = 0;
        var hijos2 = $("#cajaComponentes").find(".componente_grupo");
        hijos2.each(function () {
            if (cont > 0) {
                $(this).removeClass("componente_grupo d-none");
                $(this).addClass("componente_grupo_");
            }
            cont++;
        });
        var hijos3 = $("#cajaComponentes").find(".componente_grupo_");
        cont = 1;
        hijos3.each(function () {
            $(this).attr("id", "componente_grupo_" + cont);
            $(this)
                .find("label")
                .attr("for", "componente" + cont);
            $(this)
                .find("label")
                .html("componente " + cont);
                $(this)
                .find("input")
                .attr("id", "componente_" + cont);
                $(this)
                .find("input")
                .attr("disabled", false);
                

            var html_ ='';
            html_+='<button type="button" class="btn btn-danger btn-flat quitar_componente" title="Eliminar este registro"data_id="'+cont+'" onclick="quitar_componente('+cont+')"><i class="fa fa-fw fa-trash"></i></button>';
            $(this).find("span").html(html_);
            cont++;
        });
    });
    
});
 function quitar_componente (id) { 
    var idCajon = id;
    console.log(idCajon);
    $("#componente_grupo_" + idCajon).remove();
    var hijos3 = $("#cajaComponentes").find(".componente_grupo_");
        cont = 1;
        hijos3.each(function () {
            $(this).attr("id", "componente_grupo_" + cont);
            $(this)
                .find("label")
                .attr("for", "componente" + cont);
            $(this)
                .find("label")
                .html("componente " + cont);
            $(this)
                .find("input")
                .attr("id", "componente_" + cont);

            var html_ ='';
            html_+='<button type="button" class="btn btn-danger btn-flat quitar_componente" title="Eliminar este registro"data_id="'+cont+'" onclick="quitar_componente('+cont+')"><i class="fa fa-fw fa-trash"></i></button>';
            $(this).find("span").html(html_);
            cont++;
        });    
  }