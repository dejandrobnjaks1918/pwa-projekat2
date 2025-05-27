@extends('layouts.app')
@section('title', 'Kontakt')
@section('content')
@php
    $latitude = 44.815450;
    $longitude = 20.459805;
    $adresa = "Knez Mihailova 6, 11000 Beograd";
@endphp

<style>
    .card-title {
        font-size: 1.1rem;
        font-weight: 600;
    }
    .card-text {
        font-size: 0.9rem;
    }
    .gradient-card {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    .gradient-card:hover {
        background: rgba(255, 255, 255, 0.8);
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.15);
    }
    .map-card {
        background: rgba(233, 236, 239, 0.7);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .form-control {
        font-size: 0.9rem;
        padding: 0.5rem 0.75rem;
        background: rgba(255, 255, 255, 0.7);
        border: 1px solid rgba(0, 0, 0, 0.1);
    }
    .btn-gradient {
        background: linear-gradient(to right, #dc3545, #c82333);
        border: none;
        color: white;
    }
    .btn-gradient:hover {
        background: linear-gradient(to right, #c82333, #bd2130);
        color: white;
    }
</style>

<div class="container mt-4">
    <h1 class="text-left mb-4" style="font-size: 1.8rem; line-height: 4;">Ako Vam je potrebna pomoć u odabiru vozila, kontaktirajte nas!</h1>  

    <div class="row g-3">
        {{-- Kontakt podaci --}}
        <div class="col-lg-4">
            <div class="card h-100 gradient-card">
                <div class="card-body">
                    <h3 class="card-title"><i class="bi bi-geo-alt-fill text-danger"></i> Adresa</h3>
                    <p class="card-text">
                        RAF Rent-a-Car<br>
                        {{ $adresa }}
                    </p>
                    
                    <h3 class="card-title mt-4"><i class="bi bi-telephone-fill text-danger"></i> Telefon</h3>
                    <p class="card-text">
                        +381 11 123 4567
                    </p>
                    
                    <h3 class="card-title mt-4"><i class="bi bi-envelope-fill text-danger"></i> Email</h3>
                    <p class="card-text">
                        info@rafrentacar.rs
                    </p>
                    
                    <h3 class="card-title mt-4"><i class="bi bi-clock-fill text-danger"></i> Radno vreme</h3>
                    <p class="card-text">
                        Pon–Pet: 08:00–20:00<br>
                        Subota: 09:00–15:00<br>
                        Nedelja: zatvoreno
                    </p>
                </div>
            </div>
        </div>

        {{-- Kontakt forma --}}
        <div class="col-lg-8">
            <div class="card h-100 gradient-card">
                <div class="card-body">
                    <h3 class="card-title mb-3">Pošaljite nam poruku</h3>
                    <form action="#" method="POST"> {{-- ili route('contact.send') --}}
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Ime i prezime</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email adresa</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Telefon</label>
                            <input type="tel" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Poruka</label>
                            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-gradient w-100 py-2">
                            <i class="bi bi-send-fill"></i> Pošalji
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Mapa --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card map-card">
                <div class="card-header bg-dark text-white">
                    <i class="bi bi-map-fill"></i> Naša lokacija
                </div>
                <div class="card-body p-0">
                    <div id="osm-map" style="height: 400px; width: 100%;"></div>
                </div>
                <div class="card-footer text-center bg-dark text-white">
                    <small>{{ $adresa }}</small>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Leaflet.js --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const map = L.map('osm-map').setView([{{ $latitude }}, {{ $longitude }}], 17);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            maxZoom: 19
        }).addTo(map);

        L.marker([{{ $latitude }}, {{ $longitude }}]).addTo(map)
            .bindPopup("<b>RAF Rent-a-Car</b><br>{{ $adresa }}");
    });
</script>
@endsection
