@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Pregled svih najmova</h1>
    <br>

    <table class="table table-bordered" id="carsTable">
        <thead>
            <tr>
                <th>Korisnik</th>
                <th>Vozilo</th>
                <th>Od</th>
                <th>Do</th>
                <th>Ukupna cena (€)</th>
                <th>Akcije</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rentals as $rental)
                <tr>
                    <td>{{ $rental->user->name }}</td>
                    <td>{{ $rental->car->brand }} {{ $rental->car->model }}</td>
                    <td>{{ $rental->start_date }}</td>
                    <td>{{ $rental->end_date }}</td>
                    <td>{{ $rental->total_price }}</td>
                    <td>
                        <a href="{{ route('admin.rentals.edit', $rental) }}" class="btn btn-sm btn-danger">Izmeni</a>
                        <form action="{{ route('admin.rentals.destroy', $rental) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Obrisati najam?')">Obriši</button>
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
