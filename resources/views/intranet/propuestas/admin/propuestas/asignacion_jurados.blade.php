@extends('theme.back.plantilla')
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php')
    @include('includes.funciones_php')
@endsection
<!-- Pagina CSS -->
@section('estilosHojas')
    <!-- <link rel="stylesheet" href="{{ asset('css/intranet/index.css') }}">  -->
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
                    <div class="row col-12 mb-3"><h3 class="m-0">Asignacion de Jurados</h3></div>
                    <div class="row col-12"><h5>{{$propuesta->titulo}}</h5></div>
                    @csrf
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-12">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin-index') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('propuestas-index') }}">Propuestas</a></li>
                                <li class="breadcrumb-item active">Asignación Jurados</li>
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
                    @foreach ($jurados as $jurado)
                        <div class="col-12 col-md-2">
                            <div class="form-check">
                                <input
                                    class="form-check-input jurado_check"
                                    type="checkbox"
                                    data_url="{{route('propuestas-asignar_guardar',['persona_id' => $jurado->id,'propuesta_id' => $propuesta->id])}}"
                                    name="persona_id"
                                    value="{{$jurado->id}}"
                                    id="jurado_{{$jurado->id}}"
                                    @foreach ($propuesta->jurados as $item)
                                    @if ($item->id === $jurado->id)
                                    checked
                                    @endif
                                    @if ($item->notas_uno->count()>0)
                                    disabled
                                    @endif
                                    @endforeach
                                >
                                <label class="form-check-label" for="jurado_{{$jurado->id}}">{{$jurado->nombre1 . ' '. $jurado->nombre2. ' ' . $jurado->apellido1}}</label>
                            </div>
                        </div>
                    @endforeach
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
<script src="{{ asset('js/intranet/propuestas/admin/propuestas/asignacion.js') }}"></script>
@endsection
<!-- ************************************************************* -->
