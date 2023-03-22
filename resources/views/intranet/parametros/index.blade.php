@extends('theme.back.plantilla')
<!-- ************************************************************* -->
<!-- titulo hoja -->
@section('estilosHojas')
    <!-- Pagina CSS -->
    <link rel="stylesheet" href="{{ asset('css/intranet/parametros/index.css') }}">
@endsection
<!-- ************************************************************* -->
<!-- titulo hoja -->
@section('tituloHoja')
@endsection
<!-- ************************************************************* -->
<!-- ************************************************************* -->
<!-- Cuerpo hoja -->
@section('cuerpo_pagina')
    @include('includes.mensaje')
    @include('includes.error-form')
    <div class="row">
        <div class="col-12">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Parametros</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin-index') }}">Inicio</a></li>
                                <li class="breadcrumb-item active">Parametros</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-11 card">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active btn-light" id="pills-fechas-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-fechas" type="button" role="tab" aria-controls="pills-fechas"
                        aria-selected="true">Fechas</button>
                </li>
                <!--<li class="nav-item" role="presentation">
                    <button class="nav-link btn-light" id="pills-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                        aria-selected="false">Profile</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link btn-light" id="pills-contact-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                        aria-selected="false">Contact</button>
                </li> -->
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-fechas" role="tabpanel" aria-labelledby="pills-fechas-tab">
                    <div class="row d-flex flex-row justify-content-center">
                        <div class="col-12">
                            <h4>Parametrización de fechas</h4>
                        </div>
                        <hr>
                        <div class="col-12">
                            <form action="{{ route('parametros-fechas') }}" class="d-inline row d-flex flex-row justify-content-evenly" method="POST"
                                id="form_fechas">
                                @csrf
                                @method('post')
                                <div class="col-12 col-md-3 form-group">
                                    <label for="fec_inicial_reg" class="requerido">Fecha inicial de registro</label>
                                    <input type="date" class="form-control" id="fec_inicial_reg" name="fec_inicial_reg"
                                        value="{{ $data !== null && isset($data['fechas']) ? $data['fechas']['fec_inicial_reg'] : '' }}"
                                        required>
                                    <small id="helpId" class="form-text text-muted">Fecha inicial de registro</small>
                                </div>
                                <div class="col-12 col-md-3 form-group">
                                    <label for="fec_final_reg" class="requerido">Fecha final de registro</label>
                                    <input type="date" class="form-control" id="fec_final_reg" name="fec_final_reg"
                                        value="{{ $data !== null && isset($data['fechas']) ? $data['fechas']['fec_final_reg'] : '' }}"
                                        required>
                                    <small id="helpId" class="form-text text-muted">Fecha final de registro</small>
                                </div>
                                <div class="col-12 col-md-3 form-group">
                                    <label for="fec_final_cal" class="requerido">Fecha final de calificación 1era
                                        etapa</label>
                                    <input type="date" class="form-control" id="fec_final_cal" name="fec_final_cal"
                                        value="{{ $data !== null && isset($data['fechas']) ? $data['fechas']['fec_final_cal'] : '' }}"
                                        required>
                                    <small id="helpId" class="form-text text-muted">Fecha final de calificación 1era
                                        etapa</small>
                                </div>
                                <div class="col-12 col-md-3 form-group">
                                    <label for="fec_final_cal_seg" class="requerido">Fecha final de calificación 2da
                                        etapa</label>
                                    <input type="date" class="form-control" id="fec_final_cal_seg"
                                        name="fec_final_cal_seg"
                                        value="{{ $data !== null && isset($data['fechas']) ? $data['fechas']['fec_final_cal_seg'] : '' }}"
                                        required>
                                    <small id="helpId" class="form-text text-muted">Fecha final de calificación 2da
                                        etapa</small>
                                </div>
                                <div class="col-12 pl-5 mt-3 mb-3">
                                    <button class="btn btn-warning btn-sombra ml-5 pl-5 pr-5"
                                        type="submit">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">...
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...
                </div> -->
            </div>
        </div>
    </div>
    <!-- ********************************************************************************************************************** -->
@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('scripts_pagina')
    <script src="{{ asset('js/intranet/parametros/index.js') }}"></script>
@endsection
<!-- ************************************************************* -->
