$(document).ready(function () {
    //----------------------------------------------------
    $("#boton_registrar").on("click", function (e) {
        e.preventDefault();
        var form = $(this).parents("form");
        Swal.fire({
            title: "Esta Seguro de registrar esta propuesta?",
            html: "Los cambios registrados no se podran deshacer ni agregar nuevos elementos luego,<br/>debe esta seguro de haber completado el registro correctamente!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, registrar!",
            cancelButtonText: "Cancelar!",
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
    //------------------------------------------------------
    //------------------------------------------------------
    // Cajas PDF
    $(".caja_pdf").addClass("d-none");
    $(".agregar_pdf").click(function () {
        const sub_componente = $(this).attr("data_comp");
        $(".caja_ini_pdf_gen" + sub_componente)
            .clone()
            .appendTo("#cajas_pdfs" + sub_componente);
        $(".caja_ini_pdf_gen" + sub_componente).addClass(
            "caja_show_pdf" + sub_componente
        );
        $(".caja_ini_pdf_gen" + sub_componente + ":first").removeClass(
            "caja_show_pdf" + sub_componente
        );
        $(".caja_show_pdf" + sub_componente).removeClass(
            "caja_ini_pdf_gen" + sub_componente
        );
        $(".caja_show_pdf" + sub_componente).removeClass("d-none");

        var cajas = $("#cajas_pdfs" + sub_componente).find(
            ".caja_show_pdf" + sub_componente
        );
        var cont = 0;
        cajas.each(function () {
            cont++;
            $(this).attr("id", "caja_pdf_" + sub_componente + "_" + cont);
            $(this)
                .find("label")
                .attr("for", "pdf_" + sub_componente);
            $(this)
                .find("label")
                .html("Archivo " + cont);
            $(this)
                .find("input")
                .attr("id", "pdf_" + sub_componente + "_" + cont);
        });
    });
    //------------------------------------------------------
    //cajas Imagenes
    $(".caja_imagen").addClass("d-none");

    $(".agregar_imagen").click(function () {
        const sub_componente = $(this).attr("data_comp");
        $(".caja_ini_imagen_gen" + sub_componente)
            .clone()
            .appendTo("#cajas_imagenes" + sub_componente);
        $(".caja_ini_imagen_gen" + sub_componente).addClass(
            "caja_show_imagen" + sub_componente
        );
        $(".caja_ini_imagen_gen" + sub_componente + ":first").removeClass(
            "caja_show_imagen" + sub_componente
        );
        $(".caja_show_imagen" + sub_componente).removeClass(
            "caja_ini_imagen_gen" + sub_componente
        );
        $(".caja_show_imagen" + sub_componente).removeClass("d-none");

        var cajas = $("#cajas_imagenes" + sub_componente).find(
            ".caja_show_imagen" + sub_componente
        );
        var cont = 0;
        cajas.each(function () {
            cont++;
            $(this).attr("id", "caja_imagen_" + sub_componente + "_" + cont);
            $(this)
                .find("label")
                .attr("for", "imagen_" + sub_componente);
            $(this)
                .find("label")
                .html("Archivo " + cont);
            $(this)
                .find("input")
                .attr("id", "imagen_" + sub_componente + "_" + cont);
        });
    });
    $("#descripcion").keyup(function () {
        var thought = jQuery("textarea#descripcion").val();
        var words = thought.split(" ");
        cantPalabras = words.length;
        var stringFinal = "";
        if (cantPalabras > 30) {
            control = 0;
            $.each(words, function (index, item) {
                control++;
                if (control <= 29) {
                    stringFinal += item + " ";
                }
                if (control == 30) {
                    stringFinal += item;
                }
            });
            //-------------------
            let timerInterval;
            Swal.fire({
                title: "Mas de 30 palabras!",
                html: "En la descripción no puede incluir mas de 30 palabras. <br/> Espera <b></b> milisegundos.",
                timer: 2000,
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
                $("textarea#descripcion").val(stringFinal);
            });
            //-------------------
        }
    });
});
