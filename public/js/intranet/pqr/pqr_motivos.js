// import swal from 'sweetalert';
window.addEventListener('DOMContentLoaded', function () {
    // Incio Validacion envio de formulario
    if (document.querySelectorAll('#fromPQRMotivos')) {
        let btnSubmit = document.querySelector('#fromPQRMotivos')
        btnSubmit.addEventListener('submit', function (e) {
            e.preventDefault()
            let contadorValidacion;
            if(document.querySelectorAll('.titulo-motivo input')){
                let validacionConsultas = document.querySelectorAll('.titulo-motivo option')
                validacionConsultas.forEach(motivo =>{
                    if (motivo.value == '') {
                        swal({
                            title: "Alerta",
                            text: `Debe diligencias el campo ${motivo.parentNode.querySelector('label').textContent}`,
                            icon: "error",
                            button: "Continuar",
                          });
                        contadorValidacion = 1
                    }else {
                        contadorValidacion = 0
                    }
                })
            }
            if (contadorValidacion == 0) {
                let anexos = document.querySelectorAll('input[type="file"]')
                anexos.forEach(anexo =>{
                    if(anexo.value == ''){
                        anexo.parentNode.parentNode.remove()
                    }
                })
                let hechos = document.querySelectorAll('.hechoMotivo input')
                hechos.forEach(hecho =>{
                    if(hecho.value == ''){
                        hecho.parentNode.remove()
                    }
                })
                ajustarMotivos()
                ajustarNameHecho(document.querySelectorAll('.hechoMotivo'))
                ajustarNameAnexo(document.querySelectorAll('.anexomotivo'))
                document.querySelector('.totalCantidadAnexosMotivos').value = document.querySelectorAll('.anexomotivo').length
                this.submit();
            }
        })
        // Fin Validacion envio de formulario

        // ---------------------------------------------------------------------------------------------------------
        // Fin Función para generar varios anexos en un motivo con validación.
        ajustarNameAnexo(document.querySelectorAll('.anexomotivo'))
        let btncrearAnexo = document.querySelectorAll('.crearAnexo')
        btncrearAnexo.forEach(btn => btn.addEventListener('click', crearNuevoAnexo))
        let btnEliminarAnexo = document.querySelector('.eliminaranexomotivo')
        btnEliminarAnexo.addEventListener('click', agregarEliminarAnexo)

        function crearNuevoAnexo(e) {
            e.preventDefault()
            let motivo = e.target.parentNode.parentNode
            let nuevoAnexo = motivo.querySelectorAll('.anexomotivo')[0].cloneNode(true)
            nuevoAnexo.querySelector('.titulo-anexomotivo input').value = ''
            nuevoAnexo.querySelector('.descripcion-anexomotivo input').value = ''
            nuevoAnexo.querySelector('.doc-anexomotivo input').value = ''
            motivo.querySelector('#anexosmotivo').appendChild(nuevoAnexo)
            ajustarNameAnexo(document.querySelectorAll('.anexomotivo'))
            document.querySelectorAll('.eliminaranexomotivo').forEach(item => item.addEventListener('click', agregarEliminarAnexo))
        }

        function ajustarNameAnexo(anexosMotivo) {
            for (let i = 0; i < anexosMotivo.length; i++) {
                const anexomotivo = anexosMotivo[i];
                anexomotivo.id = `anexosMotivo${i}`
                anexomotivo.querySelector('.titulo-anexomotivo input').id = `titulo${i}`
                anexomotivo.querySelector('.titulo-anexomotivo input').name = `titulo${i}`
                anexomotivo.querySelector('.descripcion-anexomotivo input').id = `descripcion${i}`
                anexomotivo.querySelector('.descripcion-anexomotivo input').name = `descripcion${i}`
                anexomotivo.querySelector('.doc-anexomotivo input').id = `documentos${i}`
                anexomotivo.querySelector('.doc-anexomotivo input').name = `documentos${i}`

            }
        }

        function agregarEliminarAnexo(e) {
            e.preventDefault()
            let motivo = e.target
            if (motivo.tagName === 'I') {
                motivo = motivo.parentNode.parentNode.parentNode.parentNode
            }else {
                motivo = motivo.parentNode.parentNode.parentNode
            }
            if (motivo.querySelectorAll('.anexomotivo').length >= 2) {
                let idAnexo = e.target
                if (idAnexo.tagName === 'I') {
                    idAnexo = idAnexo.parentNode.parentNode.parentNode
                } else {
                    idAnexo = idAnexo.parentNode.parentNode
                }
                idAnexo.remove()
                ajustarNameAnexo(document.querySelectorAll('.anexomotivo'))
            }
        }
        // --------------------------------------------------------------------------------------------------------------------
        // Inicio Función para generar varios Hechos con validación.
        ajustarNameHecho(document.querySelectorAll('.hechoMotivo'))
        let btncrearHecho = document.querySelector('.crearHecho')
        btncrearHecho.addEventListener('click', crearNuevoHecho)
        let btnEliminarHecho = document.querySelector('.eliminarHecho')
        btnEliminarHecho.addEventListener('click', agregarEliminarHecho)
        
        function crearNuevoHecho(e) {
            e.preventDefault()
            let motivo = e.target.parentNode.parentNode
            nuevoHecho = motivo.querySelectorAll('.hechoMotivo')[0].cloneNode(true)
            nuevoHecho.querySelector('.hechoMotivo input').value = ''
            motivo.querySelector('#hechos').appendChild(nuevoHecho)
            ajustarNameHecho(document.querySelectorAll('.hechoMotivo'))
            document.querySelectorAll('.eliminarHecho').forEach(item => item.addEventListener('click', agregarEliminarHecho))
        }

        function ajustarNameHecho(motivoHechos){
            for (let i = 0; i < motivoHechos.length; i++) {
                const hecho = motivoHechos[i];
                hecho.id = `hecho${i}`
                hecho.querySelector('input').id = `hecho${i}`
                hecho.querySelector('input').name = `hecho${i}`
            }
        }
        function agregarEliminarHecho(e) {
            e.preventDefault()
            let motivo = e.target
            if (motivo.tagName === 'I') {
                motivo = motivo.parentNode.parentNode.parentNode.parentNode
            }else {
                motivo = motivo.parentNode.parentNode.parentNode
            }
            if(motivo.querySelectorAll('.hechoMotivo').length >= 2){
                let idHecho = e.target
                if (idHecho.tagName === 'I') {
                    idHecho = idHecho.parentNode.parentNode.parentNode
                }else {
                    idHecho = idHecho.parentNode.parentNode
                }
                idHecho.remove()
                ajustarNameHecho(document.querySelectorAll('.hechoMotivo'))
            }
        }
        // Fin Función para generar varios Hechos con validación.
        // ---------------------------------------------------------------------------------------------------------
        // Fin Función para generar varias motivos con validación.
        ajustarNameMotivo(document.querySelectorAll('.motivo'))
        let btncrearMotivo = document.querySelector('#crearMotivo')
        btncrearMotivo.addEventListener('click', function (e) {
            e.preventDefault()
            crearNuevaMotivo()
        })
        let btnEliminarMotivo = document.querySelector('.eliminarMotivo')
        btnEliminarMotivo.addEventListener('click', eliminarMotivo)

        ajustarMotivos()
        function ajustarMotivos(){
            let motivos = document.querySelectorAll('.motivo')
            for (let i = 0; i < motivos.length; i++) {
                motivos[i].querySelector('.cantidadAnexosMotivo').value = motivos[i].querySelectorAll('.anexomotivo').length
                motivos[i].querySelector('.cantidadHechosMotivo').value = motivos[i].querySelectorAll('.hechoMotivo').length
            }
        }

        function crearNuevaMotivo() {
            let nuevaMotivo = document.querySelectorAll('.motivo')[0].cloneNode(true)
            nuevaMotivo.querySelector('#descripcionmotivo').value = ''
            anexosTotal = nuevaMotivo.querySelectorAll('.anexomotivo')
            for (let i = 0; i < anexosTotal.length; i++) {
                const anexo = anexosTotal[i];
                if (i == 0) {
                    anexo.querySelector('.titulo-anexomotivo input').value = ''
                    anexo.querySelector('.descripcion-anexomotivo input').value = ''
                    anexo.querySelector('.doc-anexomotivo input').value = ''
                }else{
                    anexo.remove()
                }
            }
            hechosTotal = nuevaMotivo.querySelectorAll('.hechoMotivo')
            for (let i = 0; i < hechosTotal.length; i++) {
                const hecho = hechosTotal[i];
                if (i == 0) {
                    hecho.querySelector('input').value = ''
                }else{
                    hecho.remove()
                }
            }
            document.querySelector('#motivos').appendChild(nuevaMotivo)
            document.querySelectorAll('.eliminarMotivo').forEach(item => item.addEventListener('click', eliminarMotivo))
            ajustarNameMotivo(document.querySelectorAll('.motivo'))
            document.querySelectorAll('.crearAnexo').forEach(btn => btn.addEventListener('click', crearNuevoAnexo))
            document.querySelectorAll('.eliminaranexomotivo').forEach(item => item.addEventListener('click', agregarEliminarAnexo))
            document.querySelectorAll('.crearHecho').forEach(btn => btn.addEventListener('click', crearNuevoHecho))
            document.querySelectorAll('.eliminarHecho').forEach(item => item.addEventListener('click', agregarEliminarHecho))
            ajustarNameHecho(document.querySelectorAll('.hechoMotivo'))
            ajustarNameAnexo(document.querySelectorAll('.anexomotivo'))
        }

        function eliminarMotivo(e) {
            e.preventDefault()
            let motivo = e.target
            if (motivo.tagName === 'I') {
                motivo = motivo.parentNode.parentNode.parentNode.parentNode.parentNode
            }else {
                motivo = motivo.parentNode.parentNode.parentNode.parentNode
            }
            if (motivo.querySelectorAll('.motivo').length >= 2) {
                let idMotivo = e.target
                if (idMotivo.tagName === 'I') {
                    idMotivo = idMotivo.parentNode.parentNode.parentNode.parentNode
                } else {
                    idMotivo = idMotivo.parentNode.parentNode.parentNode
                }
                idMotivo.remove()
                ajustarNameMotivo(document.querySelectorAll('.motivo'))
            }
        }

        function ajustarNameMotivo(motivos) {
            for (let i = 0; i < motivos.length; i++) {
                const motivo = motivos[i]
                motivo.id = `motivo${i}`
                motivo.querySelector('.titulo-principal-card').innerHTML = `Motivo #${i + 1}`
                motivo.querySelector('.cantidadAnexosMotivo').id = `cantidadAnexosMotivo${i}`
                motivo.querySelector('.cantidadAnexosMotivo').name = `cantidadAnexosMotivo${i}`
                motivo.querySelector('.cantidadHechosMotivo').id = `cantidadHechosMotivo${i}`
                motivo.querySelector('.cantidadHechosMotivo').name = `cantidadHechosMotivo${i}`
            }
            document.querySelector('#cantidadmotivos').value = document.querySelectorAll('.motivo').length
        }

    }
})