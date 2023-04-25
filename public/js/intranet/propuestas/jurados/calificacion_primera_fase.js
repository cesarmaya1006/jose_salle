$(document).ready(function () {
    $(".number_calificacion").keyup(function () {
        if ($(this).val() > 10) {
            let timerInterval;
            Swal.fire({
                title: "Valor superior a 10",
                html: "El valor de la calificación no puede superar a 10",
                timer: 1500,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const b = Swal.getHtmlContainer().querySelector("b");
                    timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft();
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                },
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    $(this).val("10");
                }
            });
        }
        if ($(this).val() < 0) {
            let timerInterval;
            Swal.fire({
                title: "Valor negativo",
                html: "El valor de la calificación no puede ser negativo",
                timer: 1500,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const b = Swal.getHtmlContainer().querySelector("b");
                    timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft();
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                },
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    $(this).val("0");
                }
            });
        }
    });

    $(".form_calificar_fase_uno").submit(function (event) {
        event.preventDefault();
        const form = $(this);
        var valorCalificacion =0;
        form.find('input[name="calificacion"]').each(function () {
            valorCalificacion = $(this).val();
        });

        if (valorCalificacion==0) {
            Swal.fire({
                title: "¿El valor de la calificacion esta en ceros desea continuar?",
                text: "Esta acción no se puede deshacer!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, Ingresar Calificación!",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    submitRequest(form);
                }
            });
        } else {
            Swal.fire({
                title: "¿Ingresar la calificación con el siguiente valor : "+ valorCalificacion + "?",
                text: "Esta acción no se puede deshacer!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, Ingresar Calificación!",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    submitRequest(form);
                }
            });
        }



    });

    function submitRequest(form) {
        const data_url = form.attr("data_url");
        $.ajax({
            url: form.attr("action"),
            type: "POST",
            data: form.serialize(),
            success: function (respuesta) {
                if (respuesta.mensaje == "ok") {
                    $('#form_'+respuesta.id).addClass('d-none');
                    $('span_calificacion_')+respuesta.id.html('ssss');
                    $('#caja_componente_span_'+respuesta.id).removeClass('d-none');

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
