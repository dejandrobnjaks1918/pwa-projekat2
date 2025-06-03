@extends('layouts.app')

@section('title', 'Prijava')

@section('content')
<div class="container mt-5" style="max-width: 500px;">
    <h2 class="mb-4">Prijava</h2>

    {{-- Session Status --}}
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email Address --}}
        <div class="mb-3">
            <label for="email" class="form-label">Email adresa</label>
            <input type="email" id="email" name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password --}}
        <div class="mb-3">
            <label for="password" class="form-label">Lozinka</label>
            <input type="password" id="password" name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   required autocomplete="current-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Remember Me --}}
        <div class="mb-3 form-check">
            <input type="checkbox" id="remember_me" name="remember" class="form-check-input">
            <label for="remember_me" class="form-check-label">Zapamti me</label>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="btn btn-link">Zaboravljena lozinka?</a>
            @endif

            <button type="submit" class="btn btn-danger">Prijava</button>
        </div>
    </form>
</div>
@endsection
