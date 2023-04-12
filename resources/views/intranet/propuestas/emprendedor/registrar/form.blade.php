<div class="row d-flex justify-content-center">
    <input type="hidden" name="personas_id" value="{{session('id_usuario')}}">
    <div class="col-12 col-md-7">
        <div class="form-group">
            <label for="titulo" class="requerido">Título de la Propuesta</label>
            <input type="text" class="form-control form-control-sm" name="titulo" id="titulo" aria-describedby="helpId"
                value="{{ old('titulo', $propuesta->titulo ?? '') }}" placeholder="" required>
        </div>
    </div>
    <div class="col-12 col-md-7">
        <div class="form-group">
            <label for="codigo" class="requerido">Código de la Propuesta</label>
            <input type="text" class="form-control form-control-sm" name="codigo" id="codigo" aria-describedby="helpId"
                value="{{ old('codigo', $propuesta->codigo ?? '') }}" placeholder="" required>
        </div>
    </div>
    <div class="col-12 col-md-7">
        <div class="form-group">
            <label for="descripcion" class="requerido">Descripción de la propuesta</label>
            <textarea class="form-control form-control-sm" name="descripcion" id="descripcion" cols="30" rows="5" required>{{$propuesta->descripcion?? ''}}</textarea>
        </div>
    </div>
    <div class="col-12 col-md-7">
        <div class="form-group">
            <label for="canvas">Subir Canvas</label>
            <input type="file" class="form-control form-control-sm" name="canvas" id="canvas" aria-describedby="helpId" accept="application/pdf">
            <small id="helpId" class="form-text text-muted">Archivo en PDF unicamente</small>
        </div>
    </div>
    <div class="col-12 col-md-7">
        <div class="form-group">
            <label for="video">Subir video</label>
            <input type="file" class="form-control form-control-sm" name="video" id="video" aria-describedby="helpId" accept="video/mp4,video/mkv, video/x-m4v,video/*">
            <small id="helpId" class="form-text text-muted">Solo archivos de video</small>
        </div>
    </div>
</div>
<hr>
<div class="row mt-3 mb-3">
    <div class="col-12">
        <h4>Componentes de la propuesta</h4>
    </div>
</div>
@foreach ($componentes as $componente)
<div class="accordion accordion-flush" id="accordionComponentes">
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading{{$componente->id}}">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$componente->id}}" aria-expanded="false" aria-controls="flush-collapse{{$componente->id}}">
                <h5><strong>{{$componente->componente}}</strong></h5>
            </button>
        </h2>
        <div id="flush-collapse{{$componente->id}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$componente->id}}" data-bs-parent="#accordionComponentes">
            <div class="row mt-4">
                @foreach ($componente->sub_componentes as $sub_componente)
                <div class="col-11 col-md-4">
                    <div class="card card-outline">
                        <div class="card-header">
                            <h6 class="card-title"><strong>{{$sub_componente->sub_componente}}</strong></h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="sustentacion" class="requerido">Sustentación del componente</label>
                                        <input type="hidden" name="sub_componente_id_{{$sub_componente->id}}" value="{{$sub_componente->id}}">
                                        <textarea class="form-control form-control-sm" name="sustentacion[]" id="sustentacion_{{$sub_componente->id}}" cols="30" rows="5" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12 mb-3" style="border-bottom: 1px solid black">
                                    <h6><strong>Archivos adjuntos del componente</strong> (Opcionales)</h6>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <a class="btn btn-warning btn-xs btn-sombra pl-2 pr-2 agregar_pdf" data_comp="{{$sub_componente->id}}"><i class="fa fa-plus-circle mr-2 ml-1" aria-hidden="true"></i>Agregar PDF</a>
                                        </div>
                                        <div class="col-12 cajas_pdfs" id="cajas_pdfs{{$sub_componente->id}}" style="background-color: rgba(196, 200, 238, 0.404)">
                                            <div class="caja_pdf mt-2 caja_ini_pdf_gen{{$sub_componente->id}}" id="caja_pdf_{{$sub_componente->id}}_0">
                                                <div class="form-group">
                                                    <label for="pdf_{{$sub_componente->id}}_0">Archivo 0</label>
                                                    <input type="file" class="form-control form-control-sm" name="pdf[{{$sub_componente->id}}][]" id="pdf_{{$sub_componente->id}}_0" aria-describedby="helpId" accept="application/pdf">
                                                    <small id="helpId" class="form-text text-muted">Archivo en PDF unicamente</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <a class="btn btn-warning btn-xs btn-sombra pl-2 pr-2 agregar_imagen" data_comp="{{$sub_componente->id}}"><i class="fa fa-plus-circle mr-2 ml-1" aria-hidden="true"></i>Agregar Imagen</a>
                                        </div>
                                        <div class="col-12 cajas_imagenes" id="cajas_imagenes{{$sub_componente->id}}" style="background-color: rgba(196, 200, 238, 0.404)">
                                            <div class="caja_imagen mt-2 caja_ini_imagen_gen{{$sub_componente->id}}" id="caja_imagen_{{$sub_componente->id}}_0">
                                                <div class="form-group">
                                                    <label for="imagen_{{$sub_componente->id}}_0">Imagen 0</label>
                                                    <input type="file" class="form-control form-control-sm" name="imagen[{{$sub_componente->id}}][]" id="imagen_{{$sub_componente->id}}_0" aria-describedby="helpId" accept="image/png,image/jpeg">
                                                    <small id="helpId" class="form-text text-muted">Archivos de imagen unicamente</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                
                        </div>
                        <div class="card-footer">

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endforeach