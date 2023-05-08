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
        </div>
        <div class="card-body pb-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h4>Asignación de jurados a las propuestas</h4>
                    </div>
                    <div class="col-12 responsive">
                        <table class="table table-striped table-hover table-sm tabla_data_table">
                            <thead class="thead-inverse">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Propuesta</th>
                                    <th class="text-center">Jurados</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($propuestas as $propuesta)
                                <tr>
                                    <td>{{$propuesta->id}}</td>
                                    <td>
                                        <h5><strong>{{$propuesta->titulo}}</strong></h5>
                                        <h6>Emprendedor: <strong>{{$propuesta->emprendedor->nombre1 . ' ' . $propuesta->emprendedor->nombre2 . ' ' . $propuesta->emprendedor->apellido1 . ' ' . $propuesta->emprendedor->apellido2 }}</strong></h6>
                                        Código: <strong>{{$propuesta->codigo}}</strong>
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach ($jurados as $jurado)
                                                <li style="list-style:none">
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
                                                                @endforeach
                                                                @php
                                                                    $check_disable =0;
                                                                    foreach ($propuesta->componentesFaseUno as $componenteFaseUno) {
                                                                        foreach ($componenteFaseUno->notas as $nota) {
                                                                           if ($jurado->id === $nota->personas_id) {
                                                                            $check_disable =1;
                                                                           }
                                                                        }
                                                                    }
                                                                @endphp
                                                                @if ($check_disable)
                                                                disabled
                                                                @endif
                                                            >
                                                        <label class="form-check-label" for="flexCheckChecked" style="font-size: 1.3em;">
                                                            {{$jurado->nombre1 . ' ' . $jurado->nombre2 . ' ' . $jurado->apellido1 . ' ' . $jurado->apellido2}}
                                                        </label>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
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
<script src="{{ asset('js/intranet/propuestas/admin/propuestas/asignacion.js') }}"></script>
@endsection
<!-- ************************************************************* -->
