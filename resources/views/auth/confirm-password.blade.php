@extends('layouts.app')

@section('title', 'Potvrda lozinke')

@section('content')
<div class="container mt-5" style="max-width: 500px;">
    <div class="alert alert-info mb-4">
       Potvrdite svoju lozinku pre nego što nastavite.
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="mb-3">
            <label for="password" class="form-label">Lozinka</label>
            <input type="password" name="password" id="password"
                   class="form-control @error('password') is-invalid @enderror"
                   required autocomplete="current-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-danger">
                Potvrdi
            </button>
        </div>
    </form>
</div>
@endsection
