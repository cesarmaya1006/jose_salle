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
                            <li class="breadcrumb-item active">Propuestas</li>
                        </ol>
                    </div>
                </div>
            </div>
            <hr>
            <div class="container-fluid">
                <div class="row d-flex justify-content-between">
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-12 text-center"><h4>Datos de la propuesta</h4></div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-right"><strong>Categoría:</strong></div>
                            <div class="col-6">{{$propuesta->categoria->categoria}}</div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-right"><strong>Emprendedor:</strong></div>
                            <div class="col-6">{{ $propuesta->emprendedor->nombre1 }} {{ $propuesta->emprendedor->nombre2!=null? ' ' .$propuesta->emprendedor->nombre2:'' }} {{ ' '.$propuesta->emprendedor->apellido1 }} {{ $propuesta->emprendedor->apellido!=null? ' ' .$propuesta->emprendedor->apellido:'' }}</div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-right"><strong>Descripción:</strong></div>
                            <div class="col-6">{{$propuesta->descripcion??'Sin descripción'}}</div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-right"><strong>Promedio primera fase:</strong></div>
                            <div class="col-6">{{$propuesta->promedio_primera??'Sin notas'}}</div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-right"><strong>Promedio segunda fase:</strong></div>
                            <div class="col-6">{{$propuesta->promedio_segunda??'Sin notas'}}</div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-right"><strong>Estado:</strong></div>
                            <div class="col-6">{{ $propuesta->estado=1?'Sin carga completa':$propuesta->estado=2?'1era fase Cargada':$propuesta->estado=3?'1era fase calificada' :$propuesta->estado=4?'2da fase sin calificar':'Calificado' }}</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-12 text-center"><h4>Documento Final</h4></div>
                            <div class="col-12"><iframe src="https://docs.google.com/gview?url=
                                http://www.educoas.org/portal/bdigital/contenido/valzacchi/ValzacchiCapitulo-2New.pdf
                                &embedded=true" style="width:100%; height:700px;" frameborder="0" ></iframe></div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12 text-center"><h4>Componentes primera fase</h4></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12 text-center"><h4>Componentes segunda fase</h4></div>
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
