@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Data Penyakit</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('diseases.update', $disease->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nama Penyakit --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Penyakit</label>
                    <input type="text" name="name" class="form-control" 
                           value="{{ $disease->name }}" required>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('diseases.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
