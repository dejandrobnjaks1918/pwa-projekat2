@extends('layouts.app')

@section('title', $car->brand . ' ' . $car->model)

@section('content')
<style>
    .car-details-container {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(8px);
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        padding: 25px;
    }
    .car-image {
        max-height: 400px;
        object-fit: contain;
        border-radius: 10px;
    }
    .reservation-form {
        background: rgba(255,255,255,0.95);
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.08);
    }
    .spec-icon {
        color: #dc3545;
        margin-right: 10px;
        width: 24px;
        text-align: center;
    }
    #total_price {
        font-weight: bold;
        color: #dc3545;
    }
</style>

<div class="container my-5">
    <div class="row">
        {{-- Leva kolona: detalji --}}
        <div class="col-md-6">
            <div class="car-details-container mb-4">
                <h2>{{ $car->brand }} {{ $car->model }} <small class="text-muted">({{ $car->year }})</small></h2>

                @if($car->image)
                    <img src="{{ asset('storage/' . $car->image) }}" class="img-fluid car-image mb-4" alt="{{ $car->model }}">
                @endif

                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-cogs spec-icon"></i> <strong>Menjač:</strong> {{ $car->transmission }}</li>
                    <li class="mb-2"><i class="fas fa-gas-pump spec-icon"></i> <strong>Gorivo:</strong> {{ $car->fuel }}</li>
                    <li class="mb-2"><i class="fas fa-car spec-icon"></i> <strong>Kategorija:</strong> {{ $car->category }}</li>
                    <li class="mb-2"><i class="fas fa-tag spec-icon"></i> <strong>Cena po danu:</strong> {{ number_format($car->price_per_day, 2) }}€</li>
                    @if($car->featured)
                        <li class="mb-2"><i class="fas fa-star spec-icon"></i> <span class="badge bg-danger">Top ponuda!</span></li>
                    @endif
                </ul>
            </div>
        </div>

        {{-- Desna kolona: forma --}}
        <div class="col-md-6">
            <div class="reservation-form sticky-top" style="top: 20px;">
                <h3 class="mb-4">Rezervišite vozilo</h3>

                @if(session('success'))
                    <div class="alert alert-success mb-3">{{ session('success') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger mb-3">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('user.rental.store', $car) }}" method="POST" id="reservationForm">
                    @csrf

                    <div class="mb-3">
                        <label for="start_date" class="form-label">Datum preuzimanja</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" min="{{ now()->toDateString() }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="end_date" class="form-label">Datum vraćanja</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dodatna oprema</label>
                        <div class="form-check">
                            @foreach($equipment as $item)
                                <div class="form-check mb-1">
                                    <input class="form-check-input" type="checkbox" name="equipment[]" value="{{ $item->id }}" id="eq{{ $item->id }}">
                                    <label class="form-check-label" for="eq{{ $item->id }}">
                                        {{ $item->name }} <small class="text-muted">({{ number_format($item->price_per_day, 2) }}€/dan)</small>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-3 p-3 bg-light rounded">
                        <h5>Informacije o ceni</h5>
                        <p class="mb-1">Cena po danu: <strong>{{ number_format($car->price_per_day, 2) }}€</strong></p>
                        <p class="mb-1">Ukupno dana: <strong><span id="total_days">0</span></strong></p>
                        <p class="mb-0">Ukupna cena: <strong><span id="total_price">0.00</span>€</strong></p>
                    </div>

                    <button type="submit" class="btn btn-danger btn-lg w-100">
                        <i class="fas fa-calendar-check me-2"></i> Potvrdi rezervaciju
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- FontAwesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<script>
document.addEventListener('DOMContentLoaded', function () {
    const startInput = document.getElementById('start_date');
    const endInput = document.getElementById('end_date');
    const totalDaysEl = document.getElementById('total_days');
    const totalPriceEl = document.getElementById('total_price');
    const pricePerDay = {{ $car->price_per_day }};

    function updatePrice() {
        const start = new Date(startInput.value);
        const end = new Date(endInput.value);

        if (!isNaN(start) && !isNaN(end) && end >= start) {
            const days = Math.floor((end - start) / (1000 * 60 * 60 * 24)) + 1;
            const total = days * pricePerDay;
            totalDaysEl.textContent = days;
            totalPriceEl.textContent = total.toFixed(2);
        } else {
            totalDaysEl.textContent = '0';
            totalPriceEl.textContent = '0.00';
        }
    }

    startInput.addEventListener('change', function () {
        endInput.min = startInput.value;
        if (endInput.value < startInput.value) {
            endInput.value = '';
        }
        updatePrice();
    });

    endInput.addEventListener('change', updatePrice);
});
</script>
@endsection
