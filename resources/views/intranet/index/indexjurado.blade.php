<div class="card-header">
    <div class="row">
        <div class="col-sm-6">
            <h1 class="m-0">Dashboard Jurados</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Home</li>
            </ol>
        </div>
    </div>
</div>
<div class="card-body pb-3">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-12">
                    <h4>Propuestas Asignadas</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12 responsive">
                    <table class="table table-striped table-hover table-sm tabla_data_table">
                        <thead class="thead-inverse">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Estado Calificación 1era Fase</th>
                                <th class="text-center">Estado Calificación 2da Fase</th>
                                <th class="text-center">Emprendedor</th>
                                <th class="text-center">Titulo</th>
                                <th class="text-center">Descripción</th>
                                <th class="text-center">Cant Componentes</th>
                                <th class="text-center">Componentes Calificados</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jurado->propuestas_j as $propuesta)
                                @php
                                    $cantComponentes = $propuesta->componentesFaseUno->count();
                                    $cantCalificado = 0;
                                @endphp
                                @foreach ($propuesta->componentesFaseUno as $componenteFaseUno)
                                    @php
                                        $cantCalificado+=$componenteFaseUno->notas->where('personas_id',session('id_usuario'))->count();
                                        $componenteCalificado =0;
                                    @endphp
                                    @foreach ($componenteFaseUno->notas as $nota)
                                        @php
                                            if ($nota->prim_fase_componentes_id === $componenteFaseUno->id && $nota->prim_fase_componentes_id === $jurado->id) {
                                                $componenteCalificado++;
                                            }
                                        @endphp
                                    @endforeach
                                @endforeach
                                @php
                                    $porcentajeCalificado = number_format(($cantCalificado*100)/$cantComponentes,2,',','.');
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $propuesta->id }}</td>
                                    <td>
                                        @if ($porcentajeCalificado===0)
                                        <span class="badge bg-danger w-100">Propuesta sin calificar</span>
                                        @else
                                        <div class="progress w-100">
                                            <div class="progress-bar {{$porcentajeCalificado<=25? 'bg-danger':($porcentajeCalificado<=50?'bg-warning':($porcentajeCalificado<=75?'bg-info':($porcentajeCalificado<=99?'bg-primary':'bg-success')))}}"
                                                 role="progressbar"
                                                 style="width: {{$porcentajeCalificado}}%;"
                                                 aria-valuenow="{{$porcentajeCalificado}}"
                                                 aria-valuemin="0"
                                                 aria-valuemax="100">
                                                 {{$porcentajeCalificado}}%
                                            </div>
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        --
                                    </td>
                                    <td class="text-center">{{ $propuesta->emprendedor->nombre1 }} {{ $propuesta->emprendedor->nombre2!=null? ' ' .$propuesta->emprendedor->nombre2:'' }} {{ ' '.$propuesta->emprendedor->apellido1 }} {{ $propuesta->emprendedor->apellido!=null? ' ' .$propuesta->emprendedor->apellido:'' }}</td>
                                    <td class="text-center">{{ $propuesta->titulo }}</td>
                                    <td class="text-center">{{ $propuesta->descripcion??'' }}</td>
                                    <td class="text-center">{{ $propuesta->componentesFaseUno->Count() }}</td>
                                    <td class="text-center">{{ $cantCalificado }}</td>
                                    <td>
                                    @if ($propuesta->componentesFaseUno->Count()!=$cantCalificado)
                                        <a href="{{route('calificar_primera_fase',['id' => $propuesta->id])}}" class="btn btn-warning bg-gradient btn-sombra btn-xs pl-3 pr-3 ml-3"><i class="fas fa-chalkboard-teacher"></i> Calificar  primera fase</a>
                                    @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card-footer">

</div>

