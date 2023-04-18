<div class="card-header">
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
</div>
<div class="card-body pb-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if (session('rol_id') < 3)
                    @include('intranet.propuestas.admin.index')
                @endif
            </div>
        </div>
    </div>
</div>
<div class="card-footer">

</div>
