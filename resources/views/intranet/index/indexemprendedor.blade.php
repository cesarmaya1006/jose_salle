<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            @if ($usuario->persona->propuesta)
            <h3 class="m-0">Nombre Propuestas</h3>
            @else
            <h3 class="m-0">Sin propuesta Cargada</h3>
            @endif
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin-index') }}">Home</a></li>
            </ol>
        </div>
    </div>
    <hr>
    @if ($usuario->persona->propuesta)
    <div class="row">
        <div class="col-12">
            <h4>Aún no has registrado tu propuesta....</h4>
        </div>
        <div class="col-12">
            <a class="btn btn-success btn-xs btn-sombra  pl-5 pr-5 " href="" >Registra tu propuesta</a>
        </div>
    </div>
    @else
    <div class="row mb-5">
        <div class="col-12 mb-4">
            <h5>Aún no has registrado tu propuesta....</h5>
        </div>
        <div class="col-12">
            <a class="btn btn-success btn-xs btn-sombra  pl-5 pr-5 " href="{{route('propuestas-crear')}}" >Registra tu propuesta</a>
        </div>
    </div>
    @endif
</div>
