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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="m-0">Nueva Propuesta</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">Inicio</li>
                            <li class="breadcrumb-item"><a href="{{ route('propuestas-index') }}">Propuestas</a></li>
                            <li class="breadcrumb-item active">nueva Propuestas</li>
                        </ol>
                    </div>
                </div>
                @if (session('rol_id') < 3)
                <div class="row mb-3">
                    <div class="col-12 text-md-right pl-2 pr-md-5">
                        <a href="#" class="btn btn-success btn-sm text-center pl-3 pr-3"
                            style="font-size: 0.9em;"><i class="fas fa-plus-circle mr-2"></i> Nueva propuesta</a>
                    </div>
                </div>
                @endif
            </div>
            <hr>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('propuestas-guardar') }}" class="form-horizontal row"
                        method="POST" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <div class="card-body">
                            @include('intranet.propuestas.admin.propuestas.form')
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-warning btn-sm btn-sombra pl-5 pr-5">Guardar</button>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content card">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nueva Categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('propuestas-guardar_categorias') }}" class="d-inline" method="POST" id="form_categorias">
                @csrf
                @method('post')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 form-group">
                            <label for="categoria" class="requerido">Categoría</label>
                            <input type="text" class="form-control form-control-sm" name="categoria" id="categoria"
                                required>
                            <small id="helpId" class="form-text text-muted">Titulo de la categoría</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-xs btn-sombra mr-3 pl-5 pr-5"
                        data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-warning btn-xs btn-sombra mr-3 pl-5 pr-5">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('scripts_pagina')
<script src="{{ asset('js/intranet/propuestas/admin/propuestas/crear.js') }}"></script>
@endsection
<!-- ************************************************************* -->
