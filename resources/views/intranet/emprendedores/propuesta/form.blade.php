@csrf
<div class="row">
    <div class="col-12 col-md-4 form-group">
        <label for="personas_id" class="requerido">Emprendedor</label>
        <select class="form-control form-control-sm" id="personas_id" name="personas_id" required>
            <option value="">---Seleccione---</option>
            @foreach ($emprendedores as $item)
                <option value="{{ $item->id }}" {{isset($propuesta)?$propuesta->personas_id == $item->id?'selected':'':''}}>
                    {{ $item->nombre1 . ' ' . $item->nombre2 . ' ' . $item->apellido1 . ' ' . $item->apellido2 }}
                </option>
            @endforeach

        </select>
        <small id="helpId" class="form-text text-muted">Nombre del emprendedor</small>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-12">
        <h5>Jurados Asociados a la propuesta</h5>
    </div>
    @foreach ($jurados as $jurado)
        <div class="col-12 col-md-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="{{ 'jurado' . $jurado->id }}"
                    name="jurados[]" value="{{ $jurado->id }}"
                    @isset($propuesta)
                    @foreach ($propuesta->jurados as $item)
                    @if ($item->id == $jurado->id)
                    checked
                    @endif
                @endforeach
                    @endisset
                    >
                <label class="form-check-label" for="flexCheckDefault">
                    {{ $jurado->nombre1 . ' ' . $jurado->nombre2 . ' ' . $jurado->apellido1 . ' ' . $jurado->apellido2 }}
                </label>
            </div>
        </div>
    @endforeach
</div>
<hr>
<div class="row d-flex justify-content-between">
    <div class="col-12">
        <h5>Datos de la propuesta</h5>
    </div>
    <div class="col-12 col-md-3 form-group">
        <label for="categorias_id" class="requerido">Categoria</label>
        <div class="input-group input-group-sm">
            <select class="form-control form-control-sm" id="categorias_id" name="categorias_id" required>
                <option value="">---Seleccione---</option>
                @foreach ($categorias as $item)
                    <option value="{{ $item->id }}" {{isset($propuesta)?$propuesta->categorias_id == $item->id?'selected':'':''}}>{{ $item->categoria }}</option>
                @endforeach
            </select>
            <span class="input-group-append">
                <button type="button" class="btn btn-info btn-flat" data-bs-toggle="modal"
                    data-bs-target="#exampleModal"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
            </span>
        </div>
        <small id="helpId" class="form-text text-muted">Categoria Propuesta</small>
    </div>
    <div class="col-12 col-md-3 form-group">
        <label for="titulo" class="requerido">Titulo</label>
        <input type="text" class="form-control form-control-sm" name="titulo" id="titulo"
            aria-describedby="helpId" value="{{ old('titulo', $propuesta->titulo ?? '') }}"
            placeholder="Titulo de la propuesta" required>
        <small id="helpId" class="form-text text-muted">Titulo de la propuesta</small>
    </div>
    <div class="col-12 col-md-5 form-group">
        <label for="descripcion">Descripción</label>
        <textarea class="form-control form-control-sm" name="descripcion" id="descripcion" cols="30" rows="5">{{$propuesta->descripcion?? ''}}</textarea>
        <small id="helpId" class="form-text text-muted">Descripción de la propuesta</small>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-12 d-flex flex-col justify-content-between">
        <h5>Componentes primera fase de la propuesta</h5>
        <button type="button" class="btn btn-warning btn-xs btn-sombra pl-4 pr-4" id="anadirComponente"><i class="fa fa-plus-circle"
                aria-hidden="true"></i> añadir componente</button>
    </div>
</div>
<div class="row" id="cajaComponentes">
    @if (isset($propuesta))
        @if ($propuesta->componentesFaseUno->count())
            @php
                $contador = 0;
            @endphp
            @foreach ($propuesta->componentesFaseUno as $componente)
                @php
                    $contador++;
                @endphp
                <div class="col-12 col-md-3 form-group componente_grupo_" id="componente_grupo_{{ $contador }}">
                    <label for="componente_{{ $contador }}" class="requerido">Componente
                        {{ $contador }}</label>
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control form-control-sm" name="componentes[]"
                            id="componente_{{ $componente->id }}" aria-describedby="helpId"
                            value="{{ $componente->componente }}" placeholder="Titulo del componente">
                        <span class="input-group-append">
                            <button type="button"
                                    class="btn btn-danger btn-flat quitar_componente_form"
                                    title="Eliminar este registro"
                                    data_id="1"
                                    data_url="{{ route('componente-eliminar', ['id' => $componente->id]) }}">
                                <i class="fa fa-fw fa-trash"></i>
                            </button>
                        </span>
                    </div>
                    <small id="helpId" class="form-text text-muted">Titulo del componente</small>
                </div>
            @endforeach
        @endif
    @endif
    <div class="col-12 col-md-3 form-group componente_grupo d-none" id="componente_grupo">
        <label for="componente" class="requerido">Componente</label>
        <div class="input-group input-group-sm">
            <input type="text" class="form-control form-control-sm" name="componentes[]" id="componente"
                aria-describedby="helpId" value="" placeholder="Titulo del componente" disabled>
            <span class="input-group-append">
                <button type="button" class="btn btn-danger btn-flat quitar_componente"
                    title="Eliminar este registro" data_id="1" onclick="quitar_componente(0)">
                    <i class="fa fa-fw fa-trash"></i>
                </button>
            </span>
        </div>
        <small id="helpId" class="form-text text-muted">Titulo del componente</small>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-12 d-flex flex-col justify-content-between">
        <h5>Componentes segunda fase de la propuesta</h5>
        <button type="button" class="btn btn-warning btn-xs btn-sombra pl-4 pr-4" id="anadirComponente_dos"><i class="fa fa-plus-circle"
                aria-hidden="true"></i> añadir componente</button>
    </div>
</div>
<div class="row" id="cajaComponentes_dos">
    @if (isset($propuesta))
        @if ($propuesta->componentesFaseDos->count())
            @php
                $contador = 0;
            @endphp
            @foreach ($propuesta->componentesFaseDos as $componente)
                @php
                    $contador++;
                @endphp
                <div class="col-12 col-md-3 form-group componente_grupo_dos_" id="componente_grupo_dos_{{ $contador }}">
                    <label for="componente_dos_{{ $contador }}" class="requerido">Componente
                        {{ $contador }}</label>
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control form-control-sm" name="componentes_dos[]"
                            id="componente_dos_{{ $componente->id }}" aria-describedby="helpId"
                            value="{{ $componente->componente }}" placeholder="Titulo del componente">
                        <span class="input-group-append">
                            <button type="button"
                                    class="btn btn-danger btn-flat quitar_componente_form_dos"
                                    title="Eliminar este registro"
                                    data_id="1"
                                    data_url="{{ route('componente_dos-eliminar', ['id' => $componente->id]) }}">
                                <i class="fa fa-fw fa-trash"></i>
                            </button>
                        </span>
                    </div>
                    <small id="helpId" class="form-text text-muted">Titulo del componente</small>
                </div>
            @endforeach
        @endif
    @endif
    <div class="col-12 col-md-3 form-group componente_grupo_dos d-none" id="componente_grupo_dos">
        <label for="componente_dos" class="requerido">Componente</label>
        <div class="input-group input-group-sm">
            <input type="text" class="form-control form-control-sm" name="componentes_dos[]" id="componente_dos"
                aria-describedby="helpId" value="" placeholder="Titulo del componente" disabled>
            <span class="input-group-append">
                <button type="button" class="btn btn-danger btn-flat quitar_componente_dos"
                    title="Eliminar este registro" data_id="1" onclick="quitar_componente_dos(0)">
                    <i class="fa fa-fw fa-trash"></i>
                </button>
            </span>
        </div>
        <small id="helpId" class="form-text text-muted">Titulo del componente</small>
    </div>
</div>
