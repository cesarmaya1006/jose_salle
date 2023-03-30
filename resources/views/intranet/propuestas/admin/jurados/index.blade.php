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
                        <h1 class="m-0">Parametrización de Jurados</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin-index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Jurados</li>
                        </ol>
                    </div>
                </div>
                @if (session('rol_id') < 3)
                <div class="row mb-3">
                    <div class="col-12 text-md-right pl-2 pr-md-5">
                        <a href="{{route('jurados-asignacion')}}" class="btn btn-success btn-sm text-center pl-3 pr-3"
                            style="font-size: 0.9em;"><i class="fas fa-user-check mr-2"></i> Asignación de Propuestas</a>
                    </div>
                </div>
                @endif
            </div>
            <hr>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 responsive">
                        <table class="table table-striped table-hover table-bordered table-sm display">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center" scope="col">Id</th>
                                    <th class="text-center" scope="col">N. Identificacion</th>
                                    <th class="text-center" scope="col">Nombres y Apellidos</th>
                                    <th class="text-center" scope="col">Telefono</th>
                                    <th class="text-center" scope="col">Email</th>
                                    <th class="text-center" scope="col">Propuestas asignadas</th>
                                </tr>
                            </thead>
                            <tbody id="cuerpo_tabla_usuarios2">
                                @foreach ($jurados as $jurado)
                                    <tr>
                                        <td class="text-center text-nowrap">{{ $jurado->id }}</td>
                                        <td class="text-left text-nowrap">{{$jurado->identificacion}}</td>
                                        <td class="text-left text-nowrap">{{$jurado->nombre1 . ' ' . $jurado->nombre2 . ' ' . $jurado->apellido1 . ' ' . $jurado->apellido2}}</td>
                                        <td class="text-right text-nowrap">{{$jurado->telefono}}</td>
                                        <td class="text-left text-nowrap">{{$jurado->email}}</td>
                                        <td class="text-center text-nowrap">{{$jurado->propuestas_j->count()}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
