<div class="row d-flex justify-content-evenly">
    <div class="col-10 col-md-2 form-group">
        <label for="rol_id" class="requerido">Rol de Usuario</label>
        <select name="rol_id[]" id="rol_id_form" class="form-control" required {{ isset($data) ? 'disabled' : '' }}>
            <option value="">Elija un Rol</option>
            @foreach ($roles as $id => $nombre)
                <option value="{{ $id }}"
                    {{ is_array(old('rol_id')) ? (in_array($id, old('rol_id')) ? 'selected' : '') : (isset($data) ? ($data->usuario->roles->firstWhere('id', $id) ? 'selected' : '') : '') }}>
                    {{ $nombre }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="row d-flex justify-content-evenly">
    <div class="col-10 col-md-2 form-group">
        <label for="nombre1" class="requerido">Primer Nombre</label>
        <input type="text" class="form-control" id="nombre1" name="nombre1" placeholder="Nombre de Usuario"
            value="{{ old('nombre1', $data->nombre1 ?? '') }}" required>
        <small id="helpId" class="form-text text-muted">Nombres</small>
    </div>
    <div class="col-10 col-md-2 form-group">
        <label for="nombre2">Segundo Nombre</label>
        <input type="text" class="form-control" id="nombre2" name="nombre2" placeholder="Nombre de Usuario"
            value="{{ old('nombre2', $data->nombre2 ?? '') }}">
        <small id="helpId" class="form-text text-muted">Nombres</small>
    </div>
    <div class="col-10 col-md-2 form-group">
        <label for="apellido1" class="requerido">Primer Apellido</label>
        <input type="text" class="form-control" id="apellido1" name="apellido1" placeholder="Primer Apellido"
            value="{{ old('apellido1', $data->apellido1 ?? '') }}" required>
        <small id="helpId" class="form-text text-muted">Apellidos</small>
    </div>
    <div class="col-10 col-md-2 form-group">
        <label for="apellido2">Segundo Apellido</label>
        <input type="text" class="form-control" id="apellido2" name="apellido2" placeholder="Segundo Apellido"
            value="{{ old('apellido2', $data->apellido2 ?? '') }}">
        <small id="helpId" class="form-text text-muted">Apellidos</small>
    </div>
    <!--  ------------------------------------------------------------------------------------  -->
</div>
<div class="row d-flex justify-content-evenly">
    <div class="col-10 col-md-1 form-group">
        <label for="docutipos_id" class="requerido">Tipo Documento</label>
        <select name="docutipos_id" id="docutipos_id" class="form-control" required>
            <option value="">Tip Docum</option>
            @foreach ($tiposdocu as $tipo_docu)
                <option value="{{ $tipo_docu->id }}"
                    {{ is_array(old('docutipos_id')) ? (in_array($tipo_docu->id, old('docutipos_id')) ? 'selected' : '') : (isset($data) ? ($data->docutipos_id == $tipo_docu->id ? 'selected' : '') : '') }}>
                    {{ $tipo_docu->abreb_id }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-10 col-md-2 form-group">
        <label for="identificacion" class="requerido">N° de Identificaci&oacute;n</label>
        <input type="text" class="form-control" id="identificacion" name="identificacion"
            placeholder="N° de Identificación de  del Usuario"
            value="{{ old('identificacion', $data->identificacion ?? '') }}" required>
        <small id="helpId" class="form-text text-muted">N° de Identificaci&oacute;n</small>
    </div>
    <div class="col-10 col-md-2 form-group">
        <label for="email" class="requerido">Correo Electr&oacute;nico</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Email de  del Usuario"
            value="{{ old('email', isset($data) ? ($data->email != 'Sin Email' ? $data->email : '') : '') }}"
            required>
        <small id="helpId" class="form-text text-muted">Correo Electr&oacute;nico</small>
    </div>
    <div class="col-10 col-md-2 form-group">
        <label for="telefono" class="requerido">Tel&eacute;fono</label>
        <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Tel&eacute;fono Usuario"
            value="{{ old('telefono', isset($data) ? ($data->telefono != 'Sin Telefono' ? $data->telefono : '') : '') }}"
            required>
        <small id="helpId" class="form-text text-muted">Tel&eacute;fono</small>
    </div>
    <div class="col-10 col-md-2 form-group">
        <label for="direccion" class="requerido">Dirección</label>
        <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion Usuario"
            value="{{ old('direccion', isset($data) ? ($data->direccion != 'Sin Direccion' ? $data->direccion : '') : '') }}"
            required>
        <small id="helpId" class="form-text text-muted">Dirección</small>
    </div>
</div>
<div class="row d-flex justify-content-evenly">
    <div class="col-10 col-md-2 form-group">
        <label for="foto">Fotografía</label>
        <input type="file" class="form-control" id="foto" name="foto" placeholder="Foto del usuario"  accept="image/png,image/jpeg" onchange="mostrar()">
        <small id="helpId" class="form-text text-muted">Fotografía</small>
    </div>
    <div class="col-12">
        <div class="row d-flex justify-content-evenly">
            <div class="col-10 col-md-2">
                <img class="img-fluid fotoUsuario" id="fotoUsuario" src="{{asset( isset($data)?'/imagenes/usuarios/'.$data->foto:'/imagenes/usuarios/usuario-inicial.jpg') }}" alt="">
            </div>
        </div>
    </div>
</div>
