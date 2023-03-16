@extends("theme.back.plantilla")
<!-- ************************************************************* -->
<!-- titulo hoja -->
@section('estilosHojas')
    <!-- Pagina CSS -->

@endsection
<!-- ************************************************************* -->
<!-- titulo hoja -->
@section('tituloHoja')
    Usuarios
@endsection
<!-- ************************************************************* -->
<!-- ************************************************************* -->
<!-- titulo hoja -->
@section('cuerpo_pagina')
    <div class="card">
        @include('includes.error-form')
        @include('includes.mensaje')
        <div class="card-header">
            <h3 class="card-title">
                <font style="vertical-align: inherit;">Nuevo Usuario (datos b&aacute;sicos)</font>
            </h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('admin-usuario-guardar') }}" class="form-horizontal" method="POST" autocomplete="off"
            enctype="multipart/form-data">
            @csrf
            @method('post')
            <div class="card-body">
                @include('intranet.sistema.usuario.form')
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                @include('includes.botones_crear')
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
