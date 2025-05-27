@extends('layouts.app')
@section('title', 'Moje rezervacije')
@section('content')
<div class="container mt-4">

    @if($rentals->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Vozilo</th>
                    <th>Period</th>
                    <th>Oprema</th>
                    <th>Cena (€)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rentals as $rental)
                    <tr>
                        <td>{{ $rental->car->brand }} {{ $rental->car->model }}</td>
                        <td>{{ $rental->start_date }} → {{ $rental->end_date }}</td>
                        <td>
                            @foreach($rental->equipment as $eq)
                                <span class="badge bg-danger">{{ $eq->name }}</span>
                            @endforeach
                        </td>
                        <td>{{ $rental->total_price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Nemate nijednu rezervaciju.</p>
    @endif
</div>
@endsection
