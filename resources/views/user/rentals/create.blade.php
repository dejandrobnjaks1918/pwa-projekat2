@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Iznajmljivanje: {{ $car->brand }} {{ $car->model }}</h2>

    <form action="{{ route('user.rental.store', $car) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Datum početka</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Datum završetka</label>
            <input type="date" name="end_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Dodatna oprema</label>
            <select name="equipment[]" class="form-select" multiple>
                @foreach ($equipment as $item)
                    <option value="{{ $item->id }}">
                        {{ $item->name }} ({{ $item->price_per_day }} €/dan)
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Rezerviši</button>
        <a href="{{ route('catalog') }}" class="btn btn-secondary">Nazad</a>
    </form>
</div>
@endsection
