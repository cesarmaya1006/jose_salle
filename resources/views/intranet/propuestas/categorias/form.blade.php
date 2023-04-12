<div class="row">
    <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="componente">Categoría Componente</label>
            <input type="text" class="form-control" name="componente" id="componente" aria-describedby="helpId"
                value="{{ old('componente', $componente->componente ?? '') }}" placeholder="Nombre de categoría" required>
            <small id="helpId" class="form-text text-muted">Categoría Componente</small>
        </div>
    </div>
</div>