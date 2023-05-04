<div class="card-header">
    <div class="row">
        <div class="col-sm-6">
            <h3 class="m-0 mb-2">{{$usuario->persona->propuesta->titulo}}</h3>
            <h6><strong>Codigo:</strong>{{$usuario->persona->propuesta->codigo}}</h6>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin-index') }}">Home</a></li>
            </ol>
        </div>
    </div>
</div>
<div class="card-body pb-3">
    <div class="container-fluid">
        @if ($usuario->persona->propuesta->estado > 1)
        <div class="row d-flex justify-content-around">
            <div class="col-12">
                <h6><strong>Descripción:</strong></h6>
                <p style="text-align: justify">{{$usuario->persona->propuesta->descripcion}}</p>
            </div>
            <div class="col-12 col-md-5">
                <div class="row">
                    <div class="col-12"><h6><strong>Informe final</strong></h6></div>
                    <div class="col-12"><iframe src="{{asset('documentos/proyectos/'.$usuario->persona->propuesta->informe)}}" style="width:100%;height: 600pX;" frameborder="0" ></iframe></div>
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
                        <div class="col-11 {{$sub_componente->sub_componente!='Canvas' && $sub_componente->sub_componente!='Video'? 'col-md-4' : 'col-md-6'}} ">
                            <div class="card card-outline">
                                <div class="card-header">
                                    <h6 class="card-title"><strong>{{$sub_componente->sub_componente}}</strong></h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                @if ($sub_componente->sub_componente!='Canvas' && $sub_componente->sub_componente!='Video')
                                                <div class="col-12"><strong>Sustentacion del componente</strong></div>
                                                <div class="col-12">
                                                    @foreach ($usuario->persona->propuesta->componentesFaseUno as $componenteFaseUno)
                                                    @if ($componenteFaseUno->sub_componente_id === $sub_componente->id)
                                                    <div class="sustentacion">
                                                        <p style="text-align: justify">{{$componenteFaseUno->sustentacion}}</p>
                                                    </div>
                                                    @endif
                                                    @endforeach
                                                </div>
                                                @else
                                                    @if ($sub_componente->sub_componente==='Canvas')
                                                        @php
                                                            $contador =0;
                                                        @endphp
                                                        @foreach ($usuario->persona->propuesta->componentesFaseUno as $componenteFaseUno)
                                                            @if ($componenteFaseUno->sub_componente_id === $sub_componente->id)
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="col-12"><h6><strong>Documento Canvas</strong></h6></div>
                                                                    <div class="col-12"><iframe src="{{asset('documentos/proyectos/'.$componenteFaseUno->canvas)}}" style="width:100%;height: 600pX;" frameborder="0" ></iframe></div>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        @foreach ($usuario->persona->propuesta->componentesFaseUno as $componenteFaseUno)
                                                            @if ($componenteFaseUno->sub_componente_id === $sub_componente->id)
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="col-12"><h6><strong>Video Apoyo</strong></h6></div>
                                                                    <div class="col-12">
                                                                        <div class="video d-flex justify-content-center w-100" style="">
                                                                            <video controls src="{{asset('documentos/proyectos/'.$componenteFaseUno->video)}}" style="max-width: 90%"></video>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @foreach ($usuario->persona->propuesta->componentesFaseUno as $componenteFaseUno)

                                    @if (($componenteFaseUno->documentos->count() || $componenteFaseUno->fotos->count())&& $componenteFaseUno->sub_componente_id === $sub_componente->id)
                                    <hr>
                                    <div class="row">
                                        <div class="col-12 mb-3" style="border-bottom: 1px solid black">
                                            <h6><strong>Archivos adjuntos del componente</strong></h6>
                                        </div>
                                        <div class="col-12">
                                            @if ($componenteFaseUno->documentos->count())
                                            <div class="row">
                                                <div class="col-12 mb-3">
                                                    <strong>Documentos</strong>
                                                </div>
                                                <div class="col-12">
                                                    <ul>
                                                        @foreach ($componenteFaseUno->documentos as $documento)
                                                        @if ($documento->componenteFaseUno->sub_componente_id === $sub_componente->id)
                                                        <li><a href="{{asset('documentos/proyectos/'.$documento->archivo)}}" target="_blank">{{$documento->titulo}}</a></li>
                                                        @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                            <hr>
                                            @endif
                                            @if ($componenteFaseUno->fotos->count())
                                            <div class="row">
                                                <div class="col-12 mb-3">
                                                    <strong>Imagenes de apoyo</strong>
                                                </div>
                                                <div class="col-12">
                                                    <ul>
                                                        @foreach ($componenteFaseUno->fotos as $foto)
                                                        @if ($foto->componenteFaseUno->sub_componente_id === $sub_componente->id)
                                                        <li><a href="{{asset('documentos/proyectos/'.$foto->foto)}}" target="_blank">{{$foto->titulo}}</a></li>
                                                        @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                            <hr>
                                            @endif
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
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
        @else
        <div class="row mb-5">
            <div class="col-12 mb-4">
                <h5>Aún no has terminado el registro de tu propuesta....</h5>
            </div>
            <div class="col-12">
                <a class="btn btn-success btn-xs btn-sombra  pl-5 pr-5 " href="{{route('propuestas-crear')}}" >Registra tu propuesta</a>
            </div>
        </div>
        @endif
    </div>
</div>
<div class="card-footer">

</div>

