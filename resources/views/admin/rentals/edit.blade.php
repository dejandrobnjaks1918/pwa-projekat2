@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Izmeni najam</h1>

    <form action="{{ route('admin.rentals.update', $rental) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.rentals.form')
        <button type="submit" class="btn btn-danger">Sačuvaj izmene</button>
        <a href="{{ route('admin.rentals.index') }}" class="btn btn-danger">Nazad</a>
    </form>
</div>
@endsection
