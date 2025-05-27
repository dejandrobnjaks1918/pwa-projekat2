@extends('layouts.app')

@section('content')
<div class="container">
    <br>
    <h1 class="mb-4">Izmeni vozilo</h1>

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
