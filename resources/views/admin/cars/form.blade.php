@php
    $isEdit = isset($car);
@endphp

<form action="{{ $isEdit ? route('admin.cars.update', $car->id) : route('admin.cars.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="brand" class="form-label">Marka</label>
        <input type="text" name="brand" class="form-control" value="{{ old('brand', $car->brand ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="model" class="form-label">Model</label>
        <input type="text" name="model" class="form-control" value="{{ old('model', $car->model ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="year" class="form-label">Godina</label>
        <input type="number" name="year" class="form-control" value="{{ old('year', $car->year ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="price_per_day" class="form-label">Cena po danu (€)</label>
        <input type="number" name="price_per_day" step="0.01" class="form-control" value="{{ old('price_per_day', $car->price_per_day ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="transmission" class="form-label">Menjač</label>
        <select name="transmission" class="form-select" required>
            <option value="Manuelni" {{ old('transmission', $car->transmission ?? '') == 'Manuelni' ? 'selected' : '' }}>Manuelni</option>
            <option value="Automatski" {{ old('transmission', $car->transmission ?? '') == 'Automatski' ? 'selected' : '' }}>Automatski</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="fuel" class="form-label">Gorivo</label>
        <select name="fuel" class="form-select" required>
            <option value="Benzin" {{ old('fuel', $car->fuel ?? '') == 'Benzin' ? 'selected' : '' }}>Benzin</option>
            <option value="Dizel" {{ old('fuel', $car->fuel ?? '') == 'Dizel' ? 'selected' : '' }}>Dizel</option>
            <option value="Elektricni" {{ old('fuel', $car->fuel ?? '') == 'Elektricni' ? 'selected' : '' }}>Električni</option>
            <option value="Hibrid" {{ old('fuel', $car->fuel ?? '') == 'Hibrid' ? 'selected' : '' }}>Hibrid</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="category" class="form-label">Kategorija</label>
        <select name="category" class="form-select" required>
            <option value="Malo vozilo" {{ old('category', $car->category ?? '') == 'Malo vozilo' ? 'selected' : '' }}>Malo vozilo</option>
            <option value="Srednje vozilo" {{ old('category', $car->category ?? '') == 'Srednje vozilo' ? 'selected' : '' }}>Srednje vozilo</option>
            <option value="Veliko vozilo" {{ old('category', $car->category ?? '') == 'Veliko vozilo' ? 'selected' : '' }}>Veliko vozilo</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Slika</label>
        <input type="file" name="image" class="form-control">
        @if($isEdit && $car->image)
            <img src="{{ asset('storage/' . $car->image) }}" alt="Slika" class="img-fluid mt-2" style="max-height: 150px;">
        @endif
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" name="featured" class="form-check-input" id="featured"
            {{ old('featured', $car->featured ?? false) ? 'checked' : '' }}>
        <label class="form-check-label" for="featured">Istaknuto vozilo (Ponuda meseca)</label>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Opis</label>
        <textarea name="description" id="description" class="form-control">{{ old('description', $car->description ?? '') }}</textarea>
    </div>

    <button type="submit" class="btn btn-danger">
        {{ isset($car) ? 'Sačuvaj izmene' : 'Sačuvaj' }}
    </button>   
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- Summernote --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        $('#description').summernote({
            height: 200,
            placeholder: 'Unesite opis vozila...',
        });
    });
</script>
