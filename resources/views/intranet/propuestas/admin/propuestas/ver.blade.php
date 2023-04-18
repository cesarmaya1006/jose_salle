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
                    <h1 class="m-0">{{$propuesta->titulo}}</h1>
                    <br>
                    @if ($cantJurados==0)
                    <h4><span class="badge bg-danger">Propuesta sin Jurados Asignados</span></h4>
                    @endif
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin-index') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('propuestas-index') }}">Propuestas</a></li>
                        <li class="breadcrumb-item active">Ver Propuestas</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="card-body pb-3">
            <div class="container-fluid">
                <div class="container-fluid">
                    @if ($propuesta)
                    <div class="row d-flex justify-content-around">
                        <div class="col-12">
                            <h6><strong>Descripción:</strong></h6>
                            <p style="text-align: justify">{{$propuesta->descripcion}}</p>
                        </div>
                        <div class="col-12 col-md-5">
                            <div class="row">
                                <div class="col-12"><h6><strong>Documento Canvas</strong></h6></div>
                                <div class="col-12"><iframe src="{{asset('documentos/proyectos/'.$propuesta->canvas)}}" style="width:100%;height: 600pX;" frameborder="0" ></iframe></div>
                            </div>
                        </div>
                        <div class="col-12 col-md-5">
                            <div class="row">
                                <div class="col-12"><h6><strong>Video Apoyo</strong></h6></div>
                                <div class="col-12">
                                    <div class="video d-flex justify-content-center w-100" style="">
                                        <video controls src="{{asset('documentos/proyectos/'.$propuesta->video)}}"></video>
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
                                    <h5 class="w-100">
                                        <strong>{{$componente->componente}}</strong>
                                        @if ($cantJurados>0)
                                        <div class="card-tools float-end mr-4">
                                            <span title="3 New Messages" class="badge bg-primary" style="font-size: 0.7em;">Promedio Categoría <strong></strong></span>
                                        </div>
                                        @else
                                        <div class="card-tools float-end mr-4">
                                            <span title="3 New Messages" class="badge bg-danger" style="font-size: 0.7em;">Sin jurados asignados<strong></strong></span>
                                        </div>
                                        @endif
                                    </h5>
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
                                                @foreach ($propuesta->componentesFaseUno as $componenteFaseUno)
                                                @if ($componenteFaseUno->sub_componente_id === $sub_componente->id)
                                                @php
                                                    if ($componenteFaseUno->propuesta->jurados->count() > 0) {
                                                        $notaPromedio = $componenteFaseUno->notas->sum('calificacion')/$componenteFaseUno->propuesta->jurados->count();
                                                        $cantJurados = $componenteFaseUno->propuesta->jurados->count();
                                                    } else {
                                                        $notaPromedio = 0;
                                                        $cantJurados = 0;
                                                    }
                                                @endphp
                                                <div class="row">
                                                    <div class="col-12">
                                                        @if ($cantJurados != 0)
                                                        <p>Nota Promedio Componente: <strong>{{number_format($notaPromedio,2,',','.')}}</strong></p>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-12"><strong>Notas</strong></div>
                                                        </div>
                                                        @foreach ($componenteFaseUno->propuesta->jurados as $jurado)
                                                        @foreach ($jurado->notas_uno as $nota_uno)
                                                            @if ($nota_uno->prim_fase_componentes_id===$componenteFaseUno->id)
                                                            <div class="row">
                                                                <div class="col-9">{{$jurado->nombre1 . ' ' . $jurado->apellido1}}</div>
                                                                <div class="col-3">{{$nota_uno->calificacion}}</div>
                                                            </div>
                                                            @endif
                                                        @endforeach
                                                        @endforeach
                                                        @else
                                                        <p>Nota Promedio Componente: <strong class="text-danger">Sin jusrados asignados</strong></p>
                                                        @endif

                                                    </div>
                                                </div>
                                                <hr>
                                                @endif
                                                @endforeach
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-12"><strong>Sustentacion del componente</strong></div>
                                                            <div class="col-12">
                                                                @foreach ($propuesta->componentesFaseUno as $componenteFaseUno)
                                                                @if ($componenteFaseUno->sub_componente_id === $sub_componente->id)
                                                                <div class="sustentacion">
                                                                    <p style="text-align: justify">{{$componenteFaseUno->sustentacion}}</p>
                                                                </div>
                                                                @endif
                                                                @endforeach
                                                            </div>
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
                    @else
                    <div class="row mb-5">
                        <div class="col-12 mb-4">
                            <h5>Aún no has registrado tu propuesta....</h5>
                        </div>
                        <div class="col-12">
                            <a class="btn btn-success btn-xs btn-sombra  pl-5 pr-5 " href="{{route('propuestas-crear')}}" >Registra tu propuesta</a>
                        </div>
                    </div>
                    @endif
                </div>
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
