@extends("theme.back.plantilla")
<!-- ************************************************************* -->
<!-- titulo hoja -->
@section('estilosHojas')
    <!-- Pagina CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin/admin_rol.css') }}">
@endsection
<!-- ************************************************************* -->
<!-- titulo hoja -->
@section('tituloHoja')
    Editar Usuario
@endsection
<!-- ************************************************************* -->
<!-- ************************************************************* -->
<!-- titulo hoja -->
@section('cuerpo_pagina')
    <div class="card">
        {{ $mensaje ?? '' }}
        @include('includes.error-form')
        @include('includes.mensaje')
        <div class="card-header">
            <h3 class="card-title">
                <font style="vertical-align: inherit;">Edición Usuario (datos b&aacute;sicos)</font>
            </h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('admin-usuario-actualizar', ['id' => $data->id]) }}" class="form-horizontal" method="POST"
            autocomplete="off" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card-body">
                @include('intranet.sistema.usuario.form')
            </div>
            <!-- /.card-body -->
            <div class="card-footer mt-3 mb-5">
                @include('includes.botones_editar')
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
@endsection
<!-- ************************************************************* -->
<!-- scripts hoja -->
@section('scripts_pagina')
    <script src="{{ asset('js/intranet/usuario/crear.js') }}"></script>
@endsection
<!-- ************************************************************* -->
