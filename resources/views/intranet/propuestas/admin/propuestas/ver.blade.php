@extends('theme.back.plantilla')
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php')
    @include('includes.funciones_php')
@endsection
<!-- Pagina CSS -->
@section('estilosHojas')
    <link rel="stylesheet" href="{{ asset('css/intranet/index.css') }}">
@endsection
<!-- ************************************************************* -->
@section('tituloHoja')
CONVOCATORIA Nª 01 DE 2022 DEL FONDO DE EMPRENDIMIENTO DE FUNZA – FEMF
@endsection
<!-- ************************************************************* -->
@php
    $cantJurados = $propuesta->jurados->count();
@endphp
@section('cuerpo_pagina')
    <div class="card">
        @include('includes.error-form')
        @include('includes.mensaje')
        <div class="card-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-12 mb-3"><h1 class="m-0">{{$propuesta->titulo}}</h1></div>
                        <h4><strong>Codigo:</strong>{{$propuesta->codigo}}</h4>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-12">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin-index') }}">Home</a></li>
                                <li class="breadcrumb-item active"><a href="{{ route('propuestas-index') }}">Propuestas</a></li>
                                <li class="breadcrumb-item active">Ver Propuestas</li>
                            </ol>
                        </div>
                        <div class="col-12">
                            <a  href="{{ route('propuestas-index') }}"
                                class="btn btn-success btn-sm text-center pl-3 pr-3 float-sm-right" style="font-size: 0.9em;"><i
                                class="fas fa-reply mr-2"></i> Volver</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body pb-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 mb-3">
                        <h4>Datos empendedor</h4>
                    </div>
                    <div class="col-12">
                        <p style="font-size: 1.2em;">Emprendedor: <strong>{{$propuesta->emprendedor->nombre1 . ' ' . $propuesta->emprendedor->nombre2 . ' ' . $propuesta->emprendedor->apellido1 . ' ' . $propuesta->emprendedor->apellido2 }}</strong></p>
                        <p style="font-size: 1.2em;">Telefono: <strong>{{$propuesta->emprendedor->telefono}}</strong></p>
                        <p style="font-size: 1.2em;">Email: <strong>{{$propuesta->emprendedor->email}}</strong></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <h6>Semaforo</h6>
                    </div>
                    <div class="col-">
                        <div class="row d-flex">
                            <div class="col-12 col-md-3"><span class="badge bg-success w-100" style="font-size: 1.1em;">Notas completas</span></div>
                            <div class="col-12 col-md-3"><span class="badge bg-warning w-100" style="font-size: 1.1em;">Notas incompletas</span></div>
                            <div class="col-12 col-md-3"><span class="badge bg-danger w-100" style="font-size: 1.1em;">Sin Notas</span></div>
                        </div>
                    </div>
                </div>
                <hr>
                @if ($propuesta->estado == 1)
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            Propuesta sin carga completa
                        </div>
                    </div>
                </div>
                @else
                @php
                    $cantNotas = 0;
                    $cantJurados=0;
                    $cantComponentes =0;
                    if ($propuesta->jurados->count()) {
                        $cantJurados = $propuesta->jurados->count();
                    }
                    foreach ($propuesta->componentesFaseUno as $compFaseUno) {
                        foreach ($compFaseUno->notas as $nota) {
                            $cantNotas++;
                        }
                    }
                    $i=0;
                    foreach ($componentes as $componente) {
                        $nota_ini =0;
                            foreach ($propuesta->componentesFaseUno as $compFaseUno) {
                                if ($componente->id==$compFaseUno->subcomponente->componente_id) {
                                    $cantComponentes++;
                                    $nota_ini+=$compFaseUno->not_promedio;
                                }
                            }
                        $notasComponentes[$componente->id]= $nota_ini/$componente->sub_componentes->count();
                    }
                    $notaFinalPropuesta = array_sum($notasComponentes)/count($notasComponentes);
                    $porcentajeCalificado = number_format(($cantNotas*100)/($cantJurados * $cantComponentes),'2','.',',');
                @endphp
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            @if ($cantNotas==0)
                            <div class="alert alert-danger alert-dismissible">
                                <h5><i class="icon fas fa-ban"></i> Sin calificaciones!</h5>
                                    La propuesta no tiene calificaciones
                                    <p>Porcentaje calificado: {{$porcentajeCalificado}}</p>
                                </div>
                            @else
                                @if ($cantNotas===($cantJurados * $cantComponentes))
                                <div class="alert alert-success alert-dismissible">
                                    <h5><i class="icon fas fa-check"></i> Propuesta Completamente Calificada</h5>
                                    <h5>Nota promedio de la Propuesta: <strong>{{number_format($notaFinalPropuesta,2,'.',',')}}</strong></h5>
                                    <p>Porcentaje calificado: {{$porcentajeCalificado}} %</p>
                                    </div>
                                @else
                                <div class="alert alert-warning alert-dismissible">
                                    <h5><i class="icon fas fa-exclamation-triangle"></i> Propuesta parcialmente calificada!</h5>
                                    <h5>Nota promedio de la Propuesta: <strong>{{number_format($notaFinalPropuesta,2,'.',',')}}</strong></h5>
                                    <p>Notas faltantes: {{($cantJurados * $cantComponentes) - $cantNotas}}</p>
                                    <p>Porcentaje calificado: {{$porcentajeCalificado}} %</p>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="row d-flex justify-content-around">
                        <div class="col-12">
                            <h6><strong>Descripción:</strong></h6>
                            <p style="text-align: justify">{{$propuesta->descripcion}}</p>
                        </div>
                        <div class="col-12 col-md-5">
                            <div class="row">
                                <div class="col-12"><h6><strong>Informe final</strong></h6></div>
                                <div class="col-12"><iframe src="{{asset('documentos/proyectos/'.$propuesta->informe)}}" style="width:100%;height: 600pX;" frameborder="0" ></iframe></div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-3 mb-3">
                        <div class="col-12 col-md-11">
                            <h4>Componentes de la propuesta</h4>
                        </div>
                        <div class="col-12 col-md-1">
                            <span class="badge bg-success w-100">Notas completas</span>
                            <span class="badge bg-warning w-100">Notas incompletas</span>
                            <span class="badge bg-danger w-100">Sin Notas</span>
                        </div>
                    </div>
                    @foreach ($componentes as $componente)
                    <div class="accordion accordion-flush" id="accordionComponentes">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-heading{{$componente->id}}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$componente->id}}" aria-expanded="false" aria-controls="flush-collapse{{$componente->id}}">
                                    <h5 class="w-100">
                                        <strong>{{$componente->componente}}</strong>
                                        @if ($cantJurados>0)
                                        <div class="card-tools float-end mr-4">
                                            @php
                                                $cantSubComponentes =$componente->sub_componentes->count();
                                                $cantNotasCompPrimeraFase = 0;
                                                $notaPromCompCompletas =1;
                                            @endphp
                                            @foreach ($propuesta->componentesFaseUno as $componenteFaseUno)
                                                @php
                                                if ($componente->id==$componenteFaseUno->subcomponente->componente_id) {
                                                    $cantNotasCompPrimeraFase+=$componenteFaseUno->notas->count();
                                                }
                                                @endphp
                                            @endforeach
                                            @php
                                                if ($cantNotasCompPrimeraFase==0) {
                                                    $notaPromCompCompletas = 1;
                                                } else {
                                                    if ($cantNotasCompPrimeraFase==($cantJurados*$cantSubComponentes)) {
                                                        $notaPromCompCompletas = 3;
                                                    } else {
                                                        $notaPromCompCompletas = 2;
                                                    }
                                                }
                                            @endphp
                                            <span title="" class="badge {{$notaPromCompCompletas==1?'bg-danger':($notaPromCompCompletas==2?'bg-warning':'bg-success')}} " style="font-size: 0.7em;">Promedio Categoría <strong class="ml-3">{{number_format($notasComponentes[$componente->id],2,',','.')}}</strong></span>
                                        </div>
                                        @else
                                        <div class="card-tools float-end mr-4">
                                            <span title="" class="badge bg-danger" style="font-size: 0.7em;">Sin jurados asignados<strong></strong></span>
                                        </div>
                                        @endif
                                    </h5>
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
                                                                @foreach ($propuesta->componentesFaseUno as $componenteFaseUno)
                                                                    @if ($componenteFaseUno->sub_componente_id === $sub_componente->id)
                                                                    <div class="col-12 mb-2">
                                                                        <h6>Nota Promedio: <strong>{{number_format($componenteFaseUno->notas->sum('calificacion')/$cantJurados,2,'.',',')}}</strong></h6>
                                                                    </div>
                                                                    <div class="col-12 mb-4">
                                                                        <table class="table">
                                                                            <thead>
                                                                            <tr>
                                                                                <th scope="col">#</th>
                                                                                <th scope="col">Jurado</th>
                                                                                <th scope="col">Nota</th>
                                                                                <th scope="col">Observación</th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @php
                                                                                    $contador = 0;
                                                                                @endphp
                                                                                @foreach ($componenteFaseUno->notas as $nota)
                                                                                    @php
                                                                                        $contador ++;
                                                                                    @endphp
                                                                                <tr>
                                                                                    <th scope="row">Nota {{$contador}}</th>
                                                                                    <td>{{$nota->jurado->nombre1 . ' ' . $nota->jurado->nombre2 . ' ' . $nota->jurado->apellido1 . ' ' . $nota->jurado->apellido2}}</td>
                                                                                    <td>{{$nota->calificacion}}</td>
                                                                                    <td>{{$nota->observacion}}</td>
                                                                                </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    @endif
                                                                @endforeach
                                                                <div class="col-12 mt-5"><strong>Sustentacion del componente</strong></div>
                                                                <div class="col-12">
                                                                    @foreach ($propuesta->componentesFaseUno as $componenteFaseUno)
                                                                    @if ($componenteFaseUno->sub_componente_id === $sub_componente->id)
                                                                    <div class="sustentacion">
                                                                        <p style="text-align: justify">{{$componenteFaseUno->sustentacion}}</p>
                                                                    </div>
                                                                    @endif
                                                                    @endforeach
                                                                </div>
                                                            @else
                                                                @if ($sub_componente->sub_componente==='Canvas')
                                                                    @foreach ($propuesta->componentesFaseUno as $componenteFaseUno)
                                                                        @if ($componenteFaseUno->sub_componente_id === $sub_componente->id)
                                                                        <div class="col-12 mb-2">
                                                                            <h6>Nota Promedio: <strong>{{number_format($componenteFaseUno->notas->sum('calificacion')/$cantJurados,2,'.',',')}}</strong></h6>
                                                                        </div>
                                                                        <div class="col-12 mb-4">
                                                                            <table class="table">
                                                                                <thead>
                                                                                  <tr>
                                                                                    <th scope="col">#</th>
                                                                                    <th scope="col">Jurado</th>
                                                                                    <th scope="col">Nota</th>
                                                                                    <th scope="col">Observación</th>
                                                                                  </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @php
                                                                                        $contador = 0;
                                                                                    @endphp
                                                                                    @foreach ($componenteFaseUno->notas as $nota)
                                                                                        @php
                                                                                            $contador ++;
                                                                                        @endphp
                                                                                    <tr>
                                                                                        <th scope="row">Nota {{$contador}}</th>
                                                                                        <td>{{$nota->jurado->nombre1 . ' ' . $nota->jurado->nombre2 . ' ' . $nota->jurado->apellido1 . ' ' . $nota->jurado->apellido2}}</td>
                                                                                        <td>{{$nota->calificacion}}</td>
                                                                                        <td>{{$nota->observacion}}</td>
                                                                                    </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                              </table>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="row">
                                                                                <div class="col-12"><h6><strong>Documento Canvas</strong></h6></div>
                                                                                <div class="col-12"><iframe src="{{asset('documentos/proyectos/'.$componenteFaseUno->canvas)}}" style="width:100%;height: 600pX;" frameborder="0" ></iframe></div>
                                                                            </div>
                                                                        </div>
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    @foreach ($propuesta->componentesFaseUno as $componenteFaseUno)
                                                                        @if ($componenteFaseUno->sub_componente_id === $sub_componente->id)
                                                                        <div class="col-12 mb-2">
                                                                            <h6>Nota Promedio: <strong>{{number_format($componenteFaseUno->notas->sum('calificacion')/$cantJurados,2,'.',',')}}</strong></h6>
                                                                        </div>
                                                                        <div class="col-12 mb-4">
                                                                            <table class="table">
                                                                                <thead>
                                                                                  <tr>
                                                                                    <th scope="col">#</th>
                                                                                    <th scope="col">Jurado</th>
                                                                                    <th scope="col">Nota</th>
                                                                                    <th scope="col">Observación</th>
                                                                                  </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @php
                                                                                        $contador = 0;
                                                                                    @endphp
                                                                                    @foreach ($componenteFaseUno->notas as $nota)
                                                                                        @php
                                                                                            $contador ++;
                                                                                        @endphp
                                                                                    <tr>
                                                                                        <th scope="row">Nota {{$contador}}</th>
                                                                                        <td>{{$nota->jurado->nombre1 . ' ' . $nota->jurado->nombre2 . ' ' . $nota->jurado->apellido1 . ' ' . $nota->jurado->apellido2}}</td>
                                                                                        <td>{{$nota->calificacion}}</td>
                                                                                        <td>{{$nota->observacion}}</td>
                                                                                    </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                              </table>
                                                                        </div>
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
                                                @foreach ($propuesta->componentesFaseUno as $componenteFaseUno)
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
                </div>
                @endif
            </div>
        </div>
        <div class="card-footer">

        </div>
    </div>
@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('scripts_pagina')
@endsection
<!-- ************************************************************* -->
