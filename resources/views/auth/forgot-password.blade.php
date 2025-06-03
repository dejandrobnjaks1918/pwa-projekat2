@extends('layouts.app')

@section('title', 'Zaboravljena lozinka')

@section('content')
<div class="container mt-5" style="max-width: 500px;">
    <h2 class="mb-4">Zaboravljena lozinka</h2>

    <p class="text-muted mb-4">
        Zaboravili ste lozinku? Unesite svoju email adresu i poslaćemo vam link za resetovanje lozinke.
    </p>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email adresa</label>
            <input type="email" name="email" id="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-danger">
                Pošalji link za reset lozinke
            </button>
        </div>
    </form>
</div>
@endsection
