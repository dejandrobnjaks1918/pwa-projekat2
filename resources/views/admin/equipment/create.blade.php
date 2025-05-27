@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Dodaj novu opremu</h1>
    <form action="{{ route('admin.equipment.store') }}" method="POST">
        @include('admin.equipment.form')
        <button type="submit" class="btn btn-danger">Sačuvaj</button>
        <a href="{{ route('admin.equipment.index') }}" class="btn btn-danger">Nazad</a>
    </form>
</div>
@endsection
