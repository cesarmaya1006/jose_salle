@extends("theme.back.plantilla")
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
{{-- Sistema de informaci&oacute;n PQR LEGAL PROCEEDINGS --}}
Sistema de informaci&oacute;n
@endsection
<!-- ************************************************************* -->
@section('cuerpo_pagina')
<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        {{-- Solicitud sobre mis datos personales --}}
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Crear Solicitud sobre mis datos personales</h3>
                </div>
                <form action="{{ route('usuario-generarSolicitudDatos-guardar') }}" method="POST"
                    autocomplete="off" enctype="multipart/form-data" id="fromSolicitudDatos">
                    @csrf
                    @method('post')
                    <div class="card-body">
                        <div class="col-12  mt-2 pt-2" id="solicitudes">
                            <div class="col-12 solicitud rounded border mb-3">
                                <div class="form-group col-12 mt-2 titulo-solicitud">
                                    <div class="col-12 d-flex justify-content-between mb-2">
                                        <label for="">Tipo de solicitud</label>
                                        <button type="button"
                                            class="btn btn-danger btn-xs btn-sombra pl-2 pr-2 eliminarPeticion"><i
                                                class="fas fa-minus-circle"></i></button>
                                    </div>
                                    <select name="tiposolicitud" id="tiposolicitud" class="custom-select rounded-0">
                                        <option value="">--Seleccione--</option> 
                                        <option value="Actualizar">Actualizar</option>
                                        <option value="Suprimir parcialmente mis datos">Suprimir parcialmente mis datos</option>
                                        <option value="Suprimir totalmente mis datos">Suprimir totalmente mis datos</option>
                                    </select>
                                </div>
                                <div class="form-group col-12 indentifiquedocinfo-solicitud">
                                    <label for="">Datos personales objeto de la solicitud</label>
                                    <input class="form-control" type="text" name="datossolicitud" id="datossolicitud">
                                </div>
                                <div class="form-group col-12 justificacion-solicitud">
                                    <label for="">Descripción de la solicitud</label>
                                    <input class="form-control" type="text" name="descripcionsolicitud" id="descripcionsolicitud">
                                </div>
                                <div class="form-group col-12 mt-4">
                                    <h6>Anexo o prueba</h6>
                                </div>
                                <div class="col-12" id="anexosSolicitud">
                                    <div class="col-12 d-flex row anexosolicitud">
                                        <div class="col-12 titulo-anexo d-flex justify-content-between">
                                            <h6>Anexo</h6>
                                            <button type="button"
                                                class="btn btn-danger btn-xs btn-sombra pl-2 pr-2 eliminaranexoSolicitud"><i
                                                    class="fas fa-minus-circle"></i></button>
                                        </div>
                                        <div class="col-12 col-md-4 form-group titulo-anexoSolicitud">
                                            <label for="titulo">Título anexo</label>
                                            <input type="text" class="form-control form-control-sm" name="titulo" id="titulo">
                                        </div>
                                        <div class="col-12 col-md-4 form-group descripcion-anexoSolicitud">
                                            <label for="descripcion">Descripción</label>
                                            <input type="text" class="form-control form-control-sm" name="descripcion"
                                                id="descripcion">
                                        </div>
                                        <div class="col-12 col-md-4 form-group doc-anexoSolicitud">
                                            <label for="documentos">Anexos o Pruebas</label>
                                            <input class="form-control form-control-sm" type="file" name="documentos"
                                                id="documentos">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end flex-row mb-3">
                                    <button class="btn btn-success btn-xs btn-sombra pl-2 pr-2 crearAnexo" id="crearAnexo"><i
                                            class="fa fa-plus-circle mr-2" aria-hidden="true"></i> Añadir
                                        otro Anexo</button>
                                </div>
                                <input class="cantidadAnexosSolicitud" id="cantidadAnexosSolicitud" name="cantidadAnexosSolicitud" type="hidden" value="0">
                            </div>
                        </div>
                        <input class="cantidadSolicitudes" id="cantidadSolicitudes" name="cantidadSolicitudes" type="hidden" value="0">
                        <div class="col-12 d-flex justify-content-end flex-row">
                            <button class="btn btn-success btn-xs btn-sombra pl-2 pr-2" id="crearSolicitud"><i
                                    class="fa fa-plus-circle mr-2" aria-hidden="true"></i> Añadir
                                otro solicitud</button>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-4">Crear</button>
                    </div>
                    <input class="totalCantidadAnexosSolicitud" id="totalCantidadAnexosSolicitud" name="totalCantidadAnexosSolicitud" type="hidden" value="0">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- ************************************************************* -->
<!-- script hoja -->
@section('scripts_pagina')
    <script src="{{ asset('js/intranet/solicituddatos/solicitud.js') }}"></script>
@endsection
<!-- ************************************************************* -->