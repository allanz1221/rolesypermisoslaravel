<div class="form-group">
    <label for="name">Nombre</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $material->name) }}">
</div>

<div class="form-group">
    <label for="marca">Marca</label>
    <input type="text" name="marca" class="form-control" value="{{ old('marca', $material->marca) }}">
</div>

<div class="form-group">
    <label for="modelo">Modelo</label>
    <input type="text" name="modelo" class="form-control" value="{{ old('modelo', $material->modelo) }}">
</div>

<div class="form-group">
    <label for="noserie">No. de Serie</label>
    <input type="text" name="noserie" class="form-control" value="{{ old('noserie', $material->noserie) }}">
</div>

<div class="form-group">
    <label for="ubicacion">Ubicación</label>
    <input type="text" name="ubicacion" class="form-control" value="{{ old('ubicacion', $material->ubicacion) }}">
</div>

<div class="form-group">
    <label for="costo">Costo</label>
    <input type="text" name="costo" class="form-control" value="{{ old('costo', $material->costo) }}">
</div>

<div class="form-group">
    <label for="foto">Foto</label>
    <input type="file" name="foto" class="form-control">
    @if ($material->foto)
        <img src="{{ $material->foto_url }}" alt="Foto del material" width="150">
    @endif
</div>

<div class="form-group">
    <label for="estado">Estado</label>
    <input type="text" name="estado" class="form-control" value="{{ old('estado', $material->estado) }}">
</div>

<div class="form-group">
    <label for="ocupado">Ocupado</label>
    <input type="text" name="ocupado" class="form-control" value="{{ old('ocupado', $material->ocupado) }}">
</div>

<div class="form-group">
    <label for="description">Descripción</label>
    <textarea name="description" class="form-control">{{ old('description', $material->description) }}</textarea>
</div>

<div class="form-group">
    <label for="quantity">Cantidad</label>
    <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $material->quantity) }}">
</div>
