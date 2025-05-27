@extends('layouts.app')

@section('content')
<div class="container">
    <br>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.cars.create') }}" class="btn btn-danger mb-3">Dodaj novo vozilo</a>

    <table class="table table-bordered" id="carsTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Marka</th>
                <th>Model</th>
                <th>Godina</th>
                <th>Cena (€)</th>
                <th>Istaknuto</th>
                <th>Akcije</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cars as $car)
                <tr>
                    <td>{{ $car->id }}</td>
                    <td>{{ $car->brand }}</td>
                    <td>{{ $car->model }}</td>
                    <td>{{ $car->year }}</td>
                    <td>{{ number_format($car->price_per_day, 2) }}</td>
                    <td>{{ $car->featured ? 'Da' : 'Ne' }}</td>
                    <td>
                        <a href="{{ route('admin.cars.edit', $car->id) }}" class="btn btn-sm btn-danger">Izmeni</a>

                        <form action="{{ route('admin.cars.destroy', $car->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Da li ste sigurni da želite da obrišete ovo vozilo?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Obriši</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#carsTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/2.3.1/i18n/sr-SP.json'                
                }
            });
        });
    </script>
@endsection
