@csrf

<div class="mb-3">
    <label for="user_id" class="form-label">Korisnik</label>
    <select name="user_id" class="form-select" required>
        @foreach($users as $user)
            <option value="{{ $user->id }}" {{ old('user_id', $rental->user_id ?? '') == $user->id ? 'selected' : '' }}>
                {{ $user->name }} ({{ $user->email }})
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="car_id" class="form-label">Vozilo</label>
    <select name="car_id" class="form-select" required>
        @foreach($cars as $car)
            <option value="{{ $car->id }}" {{ old('car_id', $rental->car_id ?? '') == $car->id ? 'selected' : '' }}>
                {{ $car->brand }} {{ $car->model }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="start_date" class="form-label">Datum početka</label>
    <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $rental->start_date ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="end_date" class="form-label">Datum završetka</label>
    <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $rental->end_date ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="total_price" class="form-label">Ukupna cena (€)</label>
    <input type="number" name="total_price" step="0.01" class="form-control" value="{{ old('total_price', $rental->total_price ?? '') }}">
</div>
<div class="mb-3">
    <label for="equipment" class="form-label">Dodatna oprema</label>
    <select name="equipment[]" class="form-select" multiple>
        @foreach($allEquipment as $item)
            <option value="{{ $item->id }}"
                {{ in_array($item->id, old('equipment', $rental->equipment->pluck('id')->toArray() ?? [])) ? 'selected' : '' }}>
                {{ $item->name }} ({{ $item->price_per_day }} €/dan)
            </option>
        @endforeach
    </select>
</div>

