<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0">Propuestas</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin-index') }}">Home</a></li>
                <li class="breadcrumb-item active">Propuestas</li>
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
            @if (session('rol_id') < 3)
                @include('intranet.propuestas.admin.index')
            @endif
        </div>
    </div>
</div>
