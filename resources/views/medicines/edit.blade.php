{{-- @extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Edit Data Obat</h2>

    <a href="{{ route('medicines.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    <div class="card">
        <div class="card-body">

            <form action="{{ route('medicines.update', $medicine->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Obat</label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        value="{{ old('name', $medicine->name) }}"
                        class="form-control" 
                        required>
                </div>

                <div class="mb-3">
                    <label for="disease_id" class="form-label">Jenis Penyakit</label>
                    <select name="disease_id" id="disease_id" class="form-control" required>
                        <option value="">-- Pilih Penyakit --</option>
                        @foreach($diseases as $dis)
                            <option value="{{ $dis->id }}" 
                                {{ $medicine->disease_id == $dis->id ? 'selected' : '' }}>
                                {{ $dis->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="function" class="form-label">Fungsi / Kegunaan Obat</label>
                    <textarea 
                        name="function" 
                        id="function" 
                        rows="4" 
                        class="form-control"
                        required>{{ old('function', $medicine->function) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Update Obat</button>

            </form>

        </div>
    </div>

</div>
@endsection --}}


@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Data Obat</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('medicines.update', $medicine->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nama Obat --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Obat</label>
                    <input type="text" name="name" class="form-control" 
                           value="{{ $medicine->name }}" required>
                </div>

                {{-- Pilih Penyakit --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Pilih Penyakit Terkait</label>

                    <select name="diseases[]" class="form-select" multiple size="6" required>
                        @foreach($diseases as $disease)
                            <option value="{{ $disease->id }}"
                                @if(in_array($disease->id, $medicine->diseases->pluck('id')->toArray()))
                                    selected
                                @endif>
                                {{ $disease->name }}
                            </option>
                        @endforeach
                    </select>

                    <small class="text-muted">Tekan <strong>CTRL</strong> untuk memilih lebih dari satu.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Functions / Indications</label>
                    <textarea name="functions" class="form-control" rows="3">{{ old('functions') }}</textarea>
                    @error('functions') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="5" required>{{ $disease->description }}</textarea>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('medicines.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
