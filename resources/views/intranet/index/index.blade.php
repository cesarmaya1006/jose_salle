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
CONVOCATORIA Nª 01 DE 2022 DEL FONDO DE EMPRENDIMIENTO DE FUNZA – FEMF
@endsection
<!-- ************************************************************* -->
@section('cuerpo_pagina')
    <div class="card">
        @include('includes.error-form')
        @include('includes.mensaje')
        @if (session('rol_id') < 3)
        @include('intranet.index.indexadmin')
        @endif
        @if (session('rol_id') == 3)
            @include('intranet.index.indexjurado')
        @endif
        @if (session('rol_id') == 4)
            @include('intranet.index.indexemprendedor')
        @endif
    </div>
@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('scripts_pagina')
@endsection
<!-- ************************************************************* -->
