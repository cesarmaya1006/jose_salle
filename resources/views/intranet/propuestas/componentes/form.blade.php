<div class="row d-flex">
    <div class="col-12 col-md-6 form-group">
        <label for="componente_id">Categoría Componente</label>
        <select class="form-control form-control-sm" name="componente_id" id="componente_id">
            <option value="">---Seleccione---</option>
            @foreach ($componentes as $componente)
                <option value="{{ $componente->id }}"
                    {{ isset($sub_componente) ? ($componente->id == $sub_componente->componente_id ? 'selected' : '') : '' }}>
                    {{ $componente->componente }}</option>
            @endforeach
        </select>
        <small id="helpId" class="form-text text-muted">Categoría Componente</small>
    </div>
    <div class="col-12 col-md-6 form-group">
        <label for="sub_componente">Componente</label>
        <input type="text" class="form-control form-control-sm" name="sub_componente" id="sub_componente" aria-describedby="helpId"
            value="{{ old('sub_componente', $sub_componente->sub_componente ?? '') }}" placeholder="Nombre de cargo" required>
        <small id="helpId" class="form-text text-muted">Componente</small>
    </div>
</div>