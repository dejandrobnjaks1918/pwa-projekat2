@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <a href="{{ route('admin.equipment.create') }}" class="btn btn-danger mb-3">Dodaj opremu</a>

    <table class="table table-bordered" id="carsTable">
        <thead>
            <tr>
                <th>Naziv</th>
                <th>Cena po danu (€)</th>
                <th>Opis</th>
                <th>Akcije</th>
            </tr>
        </thead>
        <tbody>
            @foreach($equipment as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->price_per_day }}</td>
                    <td>{{ Str::limit($item->description, 60) }}</td>
                    <td>
                        <a href="{{ route('admin.equipment.edit', $item) }}" class="btn btn-sm btn-danger">Izmeni</a>
                        <form action="{{ route('admin.equipment.destroy', $item) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Obrisati opremu?')">Obriši</button>
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

