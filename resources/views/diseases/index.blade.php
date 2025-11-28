@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Daftar Penyakit</h2>

    <a href="{{ route('diseases.create') }}" class="btn btn-primary mb-3">Tambah Penyakit</a>

    @if($diseases->count() > 0)
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Penyakit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($diseases as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td>
                        <a href="{{ route('diseases.edit', $item->id) }}" 
                           class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('diseases.destroy', $item->id) }}" 
                              method="POST" 
                              style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus data penyakit ini?')">
                                Hapus
                            </button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info">
            Belum ada data penyakit.
        </div>
    @endif

</div>
@endsection
