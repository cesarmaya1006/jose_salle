$(document).ready(function () {
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
            $(this).find("input").attr("disabled", false);

            var html_ = "";
            html_ +=
                '<button type="button" class="btn btn-danger btn-flat quitar_componente" title="Eliminar este registro"data_id="' +
                cont +
                '" onclick="quitar_componente(' +
                cont +
                ')"><i class="fa fa-fw fa-trash"></i></button>';
            $(this).find("span").html(html_);
            cont++;
        });
    });
    $(".quitar_componente_form").on("click", function (e) {
        const id = $(this).attr('data_id');
        const idCajon = $(this).attr('data_id');
        Swal.fire({
            title: "Esta ud seguro?",
            text: "Esta acción no se puede deshacer!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, Borrar!",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                console.log(idCajon);
                const url_t = $(this).attr("data_url");
                var data = {
                    id: id,
                    _token: $("input[name=_token]").val(),
                };
                $.ajax({
                    url: url_t,
                    type: "GET",
                    data: data,
                    success: function (respuesta) {
                        if (respuesta.mensaje == "ok") {
                            console.log("componente_grupo_" + idCajon);
                            quitar_componente(idCajon);
                            Sistema.notificaciones(
                                "El registro fue eliminado correctamente",
                                "Sistema",
                                "success"
                            );
                        } else {
                            Sistema.notificaciones(
                                "El registro no pudo ser eliminado, hay recursos usandolo",
                                "Sistema",
                                "error"
                            );
                        }
                    },
                    error: function () {},
                });
            }
        });
    });
    function quitar_componente(id) {
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

            var html_ = "";
            html_ +=
                '<button type="button" class="btn btn-danger btn-flat quitar_componente" title="Eliminar este registro"data_id="' +
                cont +
                '" onclick="quitar_componente(' +
                cont +
                ')"><i class="fa fa-fw fa-trash"></i></button>';
            $(this).find("span").html(html_);
            cont++;
        });
        location.reload();
    }
});
