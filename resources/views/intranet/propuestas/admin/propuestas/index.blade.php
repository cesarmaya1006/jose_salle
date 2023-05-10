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
    Propuestas
@endsection
<!-- ************************************************************* -->
@section('cuerpo_pagina')
    <div class="card">
        @include('includes.error-form')
        @include('includes.mensaje')
        <div class="card-header">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Administración de Propuestas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin-index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Propuestas</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="card-body pb-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 responsive">
                        <table class="table table-striped table-hover table-sm tabla_data_table">
                            <thead class="thead-inverse">
                                <tr>
                                    <th></th>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Emprendedor</th>
                                    <th class="text-center">Titulo</th>
                                    <th class="text-center">Descripción</th>
                                    <th class="text-center">Cant Componentes</th>
                                    <th class="text-center">Jurados Asignados</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Nota Promedio 1era Fase</th>
                                    @if (session('rol_id') < 3)
                                    <th class="text-center">Pasa SI / NO</th>
                                    @endif
                                    <th class="text-center">Nota Promedio 2da Fase</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($propuestas as $propuesta)
                                    <tr>
                                        <td>
                                            <a href="{{route('propuestas-ver',['id' => $propuesta->id])}}"
                                                class="btn-accion-tabla tooltipsC text-info" title="Ver Propuesta"><i
                                                    class="fa fa-eye" aria-hidden="true"></i></a>
                                        </td>
                                        <td class="text-center">{{ $propuesta->id }}</td>
                                        <td class="text-center">{{ $propuesta->emprendedor->nombre1 }} {{ $propuesta->emprendedor->nombre2!=null? ' ' .$propuesta->emprendedor->nombre2:'' }} {{ ' '.$propuesta->emprendedor->apellido1 }} {{ $propuesta->emprendedor->apellido!=null? ' ' .$propuesta->emprendedor->apellido:'' }}</td>
                                        <td class="text-center">{{ $propuesta->titulo }}</td>
                                        <td class="text-center">{{ $propuesta->descripcion??'' }}</td>
                                        <td class="text-center">{{ $propuesta->componentesFaseUno->Count() }}</td>
                                        <td class="text-center">
                                            <strong>{{$propuesta->jurados->Count()}}</strong>
                                        </td>
                                        <td class="text-center">
                                            <div class="row">
                                                <div class="col-12">
                                                    {{ $propuesta->estado_str}}
                                                </div>
                                                <div class="col-12">
                                                    {!!$propuesta->barra_progreso!!}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">{{ $propuesta->promedio_primera??'Sin Calificación' }}</td>
                                        @if (session('rol_id') < 3)
                                            <td class="text-center">{{ $propuesta->promedio_segunda==null?'N/A': ($propuesta->promedio_segunda>3?'Pasa':'No pasa')}}</td>
                                        @endif
                                        <td class="text-center">{{ $propuesta->promedio_segunda??'Sin Calificación' }}</td>
                                        <td>
                                            @if ($propuesta->estado==1)
                                                {{ $propuesta->estado_str}}
                                            @else
                                                @if ($propuesta->estado<4)
                                                    @if ($propuesta->jurados->Count()>0)
                                                        <a href="{{route('propuestas-asignar',['id' => $propuesta->id])}}" class="btn btn-success bg-gradient btn-sombra btn-xs pl-3 pr-3 ml-3">ModificarJurados</a>
                                                    @else
                                                        <a href="{{route('propuestas-asignar',['id' => $propuesta->id])}}" class="btn btn-danger bg-gradient btn-sombra btn-xs pl-3 pr-3">Asignar Jurados</a>
                                                    @endif
                                                @else
                                                    <a href="{{route('exportar_notas',['id' => $propuesta->id])}}" class="btn btn-info bg-gradient btn-sombra btn-xs pl-3 pr-3 ml-3"><i class="fas fa-file-download    "></i> Descargar Informe</a>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
