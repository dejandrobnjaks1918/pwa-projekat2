@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Izmeni opremu</h1>
    <form action="{{ route('admin.equipment.update', $equipment) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.equipment.form')
        <button type="submit" class="btn btn-danger">Sačuvaj izmene</button>
        <a href="{{ route('admin.equipment.index') }}" class="btn btn-danger">Nazad</a>
    </form>
</div>
@endsection
