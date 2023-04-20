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
    Jurados
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
                        <h3 class="m-0">Asignación de Propuestas</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin-index') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('jurados-index') }}">Jurados</a></li>
                            <li class="breadcrumb-item active">Asignación</li>
                        </ol>
                    </div>
                </div>
            </div>
            <hr>
            <div class="container-fluid">
                @foreach ($propuestas as $propuesta)
                <div class="row">
                    <div class="col-12 mb-4">
                        <h4>{{$propuesta->titulo}}</h4>
                    </div>
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
                            <label class="form-check-label" for="flexCheckChecked">
                                {{$jurado->nombre1 . ' ' . $jurado->nombre2 . ' ' . $jurado->apellido1 . ' ' . $jurado->apellido2}}
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endforeach
                <div class="row">

                </div>
            </div>
        </div>
    </div>
@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('scripts_pagina')
<script src="{{ asset('js/intranet/propuestas/admin/propuestas/asignacion.js') }}"></script>
@endsection
<!-- ************************************************************* -->
