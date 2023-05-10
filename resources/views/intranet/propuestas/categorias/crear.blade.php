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
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="m-0">Nueva Categoría Componentes</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin-index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('componente-index') }}">Categorias Componentes</a></li>
                        <li class="breadcrumb-item active">Nueva Categoría</li>
                    </ol>
                </div>
            </div>
            <a href="{{ route('componente-index') }}"
            class="btn btn-success btn-sm btn-sombra text-center pl-3 pr-3 float-end" style="font-size: 0.9em;"><i
                class="fas fa-reply mr-2"></i> Volver</a>
        </div>
        <form action="{{ route('componentes-guardar') }}" class="form-horizontal row"
            method="POST" autocomplete="off" enctype="multipart/form-data">
            @csrf
            @method('post')
            <div class="card-body">
                @include('intranet.propuestas.categorias.form')
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm btn-sombra pl-4 pr-4">Guardar</button>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('scripts_pagina')
@endsection
<!-- ************************************************************* -->
