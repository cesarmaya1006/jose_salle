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
@section('cuerpo_pagina')
    <div class="card">
        @include('includes.error-form')
        @include('includes.mensaje')
        <div class="card-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$propuesta->titulo}}</h1>
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
            <hr>
            <div class="container-fluid">
                <div class="row d-flex justify-content-between mb-5">
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-12 text-center mb-3"><h3>Datos de la propuesta</h3></div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-right"><strong><h5>Categoría:</h5></strong></div>
                            <div class="col-6"><h6>{{$propuesta->categoria->categoria}}</h6></div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-right"><strong><h5>Emprendedor:</h5></strong></div>
                            <div class="col-6"><h6>{{ $propuesta->emprendedor->nombre1 }} {{ $propuesta->emprendedor->nombre2!=null? ' ' .$propuesta->emprendedor->nombre2:'' }} {{ ' '.$propuesta->emprendedor->apellido1 }} {{ $propuesta->emprendedor->apellido!=null? ' ' .$propuesta->emprendedor->apellido:'' }}</h6></div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-right"><strong><h5>Descripción:</h5></strong></div>
                            <div class="col-6"><h6>{{$propuesta->descripcion??'Sin descripción'}}</h6></div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-right"><strong><h5>Promedio primera fase:</h5></strong></div>
                            <div class="col-6"><h6>{{$propuesta->promedio_primera??'Sin notas'}}</h6></div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-right"><strong><h5>Promedio segunda fase:</h5></strong></div>
                            <div class="col-6"><h6>{{$propuesta->promedio_segunda??'Sin notas'}}</h6></div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-right"><strong><h5>Estado:</h5></strong></div>
                            <div class="col-6"><h6>{{ $propuesta->estado=1?'Sin carga completa':$propuesta->estado=2?'1era fase Cargada':$propuesta->estado=3?'1era fase calificada' :$propuesta->estado=4?'2da fase sin calificar':'Calificado' }}</h6></div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-12 text-center"><h4><strong>Documento Final</strong></h4></div>
                            <div class="col-12"><iframe src="{{asset('documentos/proyectos/1.pdf')}}" style="width:100%;height: 500pX;" frameborder="0" ></iframe></div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row d-flex justify-content-around mt-5">
                    <div class="col-12 text-center"><h3>Componentes primera fase</h3></div>
                    @foreach ($propuesta->componentesFaseUno as $componente)
                    <div class="col-12 col-md-5 ml-1 mr-1 mb-5 mt-3 p-2 btn-sombra" style="border: 2px solid black;border-radius: 5px;">
                        <div class="row">
                            <div class="col-6 text-right"><strong><h5>Componente:</h5></strong></div>
                            <div class="col-6"><h6>{{$componente->componente}}</h6></div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-right"><strong><h5>Nota:</h5></strong></div>
                            <div class="col-6"><h6>{{$componente->not_promedio??'Sin Notas'}}</h6></div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-right"><strong><h5>Estado:</h5></strong></div>
                            <div class="col-6"><h6>{{ $componente->estado=1?'Sin carga completa':$componente->estado=2?'1era fase Cargada':$componente->estado=3?'1era fase calificada' :$componente->estado=4?'2da fase sin calificar':'Calificado' }}</h6></div>
                        </div>
                        <div class="row d-flex justify-content-center mt-5">
                            <div class="col-12 text-center"><Strong><h5>Archivo</h5></Strong></div>
                            <div class="col-12 col-md-9"><iframe src="{{asset('documentos/proyectos/1.pdf')}}" style="width:100%;height: 500pX;" frameborder="0" ></iframe></div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <hr>
                <div class="row d-flex justify-content-around">
                    <div class="col-12 text-center"><h4>Componentes segunda fase</h4></div>
                    @foreach ($propuesta->componentesFaseDos as $componente)
                    <div class="col-12 col-md-5 ml-1 mr-1 mb-5 mt-3 p-2 btn-sombra" style="border: 2px solid black;border-radius: 5px;">
                        <div class="row">
                            <div class="col-6 text-right"><strong><h5>Componente:</h5></strong></div>
                            <div class="col-6"><h6>{{$componente->componente}}</h6></div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-right"><strong><h5>Nota:</h5></strong></div>
                            <div class="col-6"><h6>{{$componente->not_promedio??'Sin Notas'}}</h6></div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-right"><strong><h5>Observación:</h5></strong></div>
                            <div class="col-6"><h6>{{$componente->observacion??'Sin Observación'}}</h6></div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-right"><strong><h5>Estado:</h5></strong></div>
                            <div class="col-6"><h6>{{ $componente->estado=1?'Sin carga completa':$componente->estado=2?'1era fase Cargada':$componente->estado=3?'1era fase calificada' :$componente->estado=4?'2da fase sin calificar':'Calificado' }}</h6></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('scripts_pagina')
@endsection
<!-- ************************************************************* -->
