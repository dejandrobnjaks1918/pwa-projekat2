@extends('layouts.app')

@section('title', 'Katalog vozila')

@section('content')
<style>
    .gradient-card {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border-radius: 10px;
        overflow: hidden;
    }
    .gradient-card:hover {
        background: rgba(255, 255, 255, 0.85);
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.15);
    }
    .card-img-container {
        height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px;
        background: rgba(255,255,255,0.3);
    }
    .card-img-top {
        max-height: 100%;
        width: auto;
        max-width: 100%;
        object-fit: contain;
    }
    .car-specs li {
        margin-bottom: 8px;
    }
    .car-specs i {
        width: 20px;
        text-align: center;
        margin-right: 8px;
        color: #dc3545;
    }
</style>

<div class="container mt-5">
    <h1 class="text-left mb-4" style="font-size: 1.8rem; line-height: 4;">Pregled dostupnih vozila</h1>  
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        @forelse ($cars as $car)
            <div class="col">
                <div class="card h-100 gradient-card">
                    <div class="card-img-container">
                        @if($car->image)
                            <img src="{{ asset('storage/' . $car->image) }}" 
                                 class="card-img-top" 
                                 alt="{{ $car->model }}">
                        @endif
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">
                            {{ $car->brand }} {{ $car->model }}
                            <small class="text-muted">({{ $car->year }})</small>
                        </h5>

                        <ul class="list-unstyled car-specs">
                            <li>
                                <i class="fas fa-cogs"></i>
                                <strong>Menjač:</strong> {{ $car->transmission }}
                            </li>
                            <li>
                                <i class="fas fa-gas-pump"></i>
                                <strong>Gorivo:</strong> {{ $car->fuel }}
                            </li>
                            <li>
                                <i class="fas fa-car"></i>
                                <strong>Kategorija:</strong> {{ $car->category }}
                            </li>
                            <li>
                                <i class="fas fa-tag"></i>
                                <strong>Cena:</strong> {{ number_format($car->price_per_day, 0) }}€/dan
                            </li>
                            @if($car->featured)
                                <li>
                                    <i class="fas fa-star"></i>
                                    <span class="badge bg-danger">Top ponuda!</span>
                                </li>
                            @endif
                        </ul>
                    </div>

                    <div class="card-footer bg-transparent border-top-0">
                        <a href="{{ route('cars.show', $car) }}" class="btn btn-danger w-100">
                            <i class="fas fa-info-circle me-2"></i>Opširnije
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle me-2"></i> Trenutno nema dostupnih vozila.
                </div>
            </div>
        @endforelse
    </div>
</div>

{{-- FontAwesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endsection
