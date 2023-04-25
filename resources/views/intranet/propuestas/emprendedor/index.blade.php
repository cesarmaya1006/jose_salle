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
                    <div class="row col-12 mb-3"><h3 class="m-0">Emprendedores</h3></div>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-12">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin-index') }}">Home</a></li>
                                <li class="breadcrumb-item active">Emprendedores</li>
                            </ol>
                        </div>
                        <div class="col-12">
                            <a  href="{{ route('admin-index') }}"
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
                    <div class="col-12 responsive">
                        <table class="table table-striped table-hover table-bordered table-sm  tabla_data_table">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center" scope="col">Id</th>
                                    <th class="text-center" scope="col">N. Identificacion</th>
                                    <th class="text-center" scope="col">Nombres y Apellidos</th>
                                    <th class="text-center" scope="col">Telefono</th>
                                    <th class="text-center" scope="col">Email</th>
                                    <th class="text-center" scope="col">Propuesta registrada</th>
                                </tr>
                            </thead>
                            <tbody id="cuerpo_tabla_usuarios2">
                                @foreach ($emprendedores as $emprendedor)
                                    <tr>
                                        <td class="text-center text-nowrap">{{ $emprendedor->id }}</td>
                                        <td class="text-center text-nowrap">{{$emprendedor->identificacion}}</td>
                                        <td class="text-left text-nowrap">{{$emprendedor->nombre1 . ' ' . $emprendedor->nombre2 . ' ' . $emprendedor->apellido1 . ' ' . $emprendedor->apellido2}}</td>
                                        <td class="text-center text-nowrap">{{$emprendedor->telefono}}</td>
                                        <td class="text-left text-nowrap">{{$emprendedor->email}}</td>
                                        <td class="text-center text-nowrap">{{$emprendedor->propuesta?'SI':'NO'}}</td>
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
