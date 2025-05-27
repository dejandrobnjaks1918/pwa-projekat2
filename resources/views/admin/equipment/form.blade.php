@csrf

<div class="mb-3">
    <label for="name" class="form-label">Naziv</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $equipment->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="price_per_day" class="form-label">Cena po danu (€)</label>
    <input type="number" step="0.01" name="price_per_day" class="form-control" value="{{ old('price_per_day', $equipment->price_per_day ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="description" class="form-label">Opis</label>
    <textarea name="description" class="form-control" rows="3">{{ old('description', $equipment->description ?? '') }}</textarea>
</div>
