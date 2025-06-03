@extends('layouts.app')

@section('title', 'Verifikacija email adrese')

@section('content')
<div class="container mt-5" style="max-width: 600px;">
    <div class="alert alert-info mb-4">
        Hvala na registraciji! Pre nego što započnete, molimo vas da verifikujete svoju email adresu klikom na link koji smo vam poslali.
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success mb-4">
            Novi link za verifikaciju je poslat na vašu email adresu.
        </div>
    @endif

    <div class="d-flex justify-content-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-danger">
                Pošalji ponovo verifikacioni email
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-secondary">
                Odjavi se
            </button>
        </form>
    </div>
</div>
@endsection
