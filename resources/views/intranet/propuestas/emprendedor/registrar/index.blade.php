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
    Propuestas
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
                        <h3 class="m-0">Registro de Propuestas</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin-index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Registro de propuestas</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <form action="{{ route('propuestas-guardar') }}" class="form-horizontal"
            method="POST" autocomplete="off" enctype="multipart/form-data">
            @csrf
            @method('post')
            <div class="card-body">
                @include('intranet.propuestas.emprendedor.registrar.form')
            </div>
            <!-- /.card-body -->
            <div class="card-footer mb-4">
                <button type="submit" class="btn btn-primary bg-gradient btn-sombra pl-5 pr-5">Registrar</button>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('scripts_pagina')
<script src="{{ asset('js/intranet/propuestas/registrar.js') }}"></script>
@endsection
<!-- ************************************************************* -->
