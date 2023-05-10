@extends('theme.back.plantilla')
<!-- ************************************************************* -->
<!-- Funciones php -->
@section('funciones_php')
    @include('includes.funciones_php')
@endsection
<!-- Pagina CSS -->
@section('estilosHojas')
    <!-- <link rel="stylesheet" href="{{ asset('css/intranet/index.css') }}"> -->
@endsection
<!-- ************************************************************* -->
@section('tituloHoja')
    Propuestas Categorías Componentes
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
                        <h3 class="m-0">Listado de Categorías Componentes</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin-index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Categorias Componentes</li>
                        </ol>
                    </div>
                </div>
                @if (session('rol_id') < 3)
                <div class="row mb-3">
                    <div class="col-12 text-md-right pl-2 pr-md-5">
                        <a href="{{route('componentes-crear')}}" class="btn btn-success btn-sm text-center pl-3 pr-3"
                            style="font-size: 0.9em;"><i class="fas fa-plus-circle mr-2"></i> Nueva categoría</a>
                    </div>
                </div>
                @endif
            </div>
            <hr>
            <div class="container-fluid">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 col-md-6 responsive">
                        <table class="table table-striped table-hover table-sm tabla_data_table tabla-borrando">
                            <thead class="thead-inverse">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Categoria Componente</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($componentes as $componente)
                                    <tr>
                                        <td class="text-center">{{ $componente->id }}</td>
                                        <td class="text-center">{{ $componente->componente }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('componentes-editar', ['id' => $componente->id]) }}"
                                                class="btn-accion-tabla tooltipsC" title="Editar este registro">
                                                <i class="fas fa-pen-square"></i>
                                            </a>
                                            <form action="{{ route('componentes-eliminar', ['id' => $componente->id]) }}"
                                                class="d-inline form-eliminar" method="POST">
                                                @csrf @method("delete")
                                                <button type="submit" class="btn-accion-tabla eliminar tooltipsC"
                                                    title="Eliminar este registro">
                                                    <i class="fa fa-fw fa-trash text-danger"></i>
                                                </button>
                                            </form>
                                        </td>
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