@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>{{ $car->name }}</h1>
    <p>{{ $car->description }}</p>
    <p><strong>Cena:</strong> {{ $car->price_per_day }} €</p>
    <p><strong>Istaknut:</strong> {{ $car->featured ? 'DA' : 'NE' }}</p>

    @if($car->image)
        <img src="{{ asset('storage/' . $car->image) }}" class="img-fluid mt-3" style="max-width: 300px;">
    @endif

    <br><br>
    <a href="{{ route('admin.cars.index') }}" class="btn btn-secondary">Nazad</a>
</div>
@endsection
