@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Dodaj novo vozilo</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Greška:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @include('admin.cars.form')
</div>
@endsection
