<div class="row d-flex justify-content-center">
    <input type="hidden" name="personas_id" value="{{session('id_usuario')}}">
    <input type="hidden" name="propuestas_id" value="{{$usuario->propuesta->id}}">
    <div class="col-12 col-md-7">
        <div class="form-group">
            <label for="descripcion" class="requerido">Descripción de la propuesta</label>
            <textarea class="form-control form-control-sm" name="descripcion" id="descripcion" cols="30" rows="3" maxlength="260" required>{{$propuesta->descripcion?? ''}}</textarea>
            <small id="helpId" class="form-text text-muted">Maximo 30 palabras</small>
        </div>
    </div>
    <div class="col-12 col-md-7">
        <div class="form-group">
            <label class="requerido" for="informe">Informe General</label>
            <input type="file" class="form-control form-control-sm" name="informe" id="informe" aria-describedby="helpId" accept="application/pdf" required>
            <small id="helpId" class="form-text text-muted">Archivo en PDF unicamente</small>
        </div>
    </div>
    <div class="col-12 col-md-7">
        <div class="form-group">
            <label for="descripcion" class="requerido">Sector Socio - Económico</label>
            <select class="form-control form-control-sm" name="sector" id="sector" required>
                <option value="">Seleccione</option>
                <option value="Sector 1"> Sector 1</option>
                <option value="Sector 2"> Sector 2</option>
                <option value="Sector 3"> Sector 3</option>
                <option value="Sector 4"> Sector 4</option>
                <option value="Sector 5"> Sector 5</option>
            </select>
            <small id="helpId" class="form-text text-muted">Sector Socio - Económico</small>
        </div>
    </div>
    <div class="col-12 col-md-7">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="descripcion" class="requerido">Años de experiencia y/o antiguedad</label>
                    <select class="form-control form-control-sm" name="annos" id="annos" required>
                        <option value="">Seleccione</option>
                        <option value="1">1 año</option>
                        @for ($i = 2; $i < 25; $i++)
                        <option value="{{$i}}">{{$i}} años</option>
                        @endfor
                    </select>
                    <small id="helpId" class="form-text text-muted">Experiencia en años</small>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="descripcion" class="requerido">Meses de experiencia y/o antiguedad</label>
                    <select class="form-control form-control-sm" name="meses" id="meses" required>
                        <option value="0">0</option>
                        @for ($i = 1; $i < 13; $i++)
                        <option value="{{$i}}">{{$i}} meses</option>
                        @endfor
                    </select>
                    <small id="helpId" class="form-text text-muted">Experiencia en meses</small>
                </div>
            </div>
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
                <div class="col-12">
                    <div class="card card-outline">
                        <div class="card-header">
                            <h6 class="card-title"><strong>{{$sub_componente->sub_componente}}</strong></h6>
                        </div>
                        <div class="card-body">
                            @if ($sub_componente->sub_componente!='Canvas'&& $sub_componente->sub_componente!='Video' && $sub_componente->sub_componente!='Propuesta de cofinanciamiento')
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="sustentacion" class="requerido">Sustentación del componente</label>
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
                            @else
                                @if ($sub_componente->sub_componente==='Canvas')
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="canvas">Subir Canvas</label>
                                            <input type="file" class="form-control form-control-sm" name="canvas" id="canvas_{{$sub_componente->id}}" aria-describedby="helpId" accept="application/pdf">
                                            <small id="helpId" class="form-text text-muted">Archivo en PDF unicamente</small>
                                        </div>
                                    </div>
                                </div>
                                @else
                                    @if ($sub_componente->sub_componente==='Video')
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="video">Subir url video</label>
                                                <input type="text" class="form-control form-control-sm" name="video" id="video_{{$sub_componente->id}}" aria-describedby="helpId">
                                                <small id="helpId" class="form-text text-muted">Subir la url del video</small>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="excel">Subir propuesta en Excel </label>
                                                <input type="file" class="form-control form-control-sm" name="excel" id="excel_{{$sub_componente->id}}" aria-describedby="helpId" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                                <small id="helpId" class="form-text text-muted">Archivo en Excel  unicamente xls ó xlsx</small>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12 mb-3" style="border-bottom: 1px solid black">
                                            <h6><strong>Agregar Cotizaciones</strong> (Opcionales)</h6>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12 mb-3">
                                                    <a class="btn btn-warning btn-xs btn-sombra pl-2 pr-2 agregar_pdf" data_comp="{{$sub_componente->id}}"><i class="fa fa-plus-circle mr-2 ml-1" aria-hidden="true"></i>Agregar Cotización en PDF</a>
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
                                        </div>
                                    </div>
                                    @endif
                                @endif
                            @endif
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
