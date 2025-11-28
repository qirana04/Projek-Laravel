@extends('layouts.app')
@section('title','Create Medicine')
@section('content')
<h1>Create Medicine</h1>
<form method="post" action="{{ route('medicines.store') }}">
  @csrf
  <div class="mb-3">
    <label class="form-label">Name</label>
    <input name="name" class="form-control" value="{{ old('name') }}">
    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
  </div>

  <div class="mb-3">
    <label class="form-label">Functions / Indications</label>
    <textarea name="functions" class="form-control" rows="3">{{ old('functions') }}</textarea>
    @error('functions') <div class="text-danger">{{ $message }}</div> @enderror
  </div>

  <div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control" rows="2">{{ old('description') }}</textarea>
  </div>

  <div class="mb-3">
    <label class="form-label">Related Diseases (select multiple)</label>
    <select name="diseases[]" class="form-select" multiple>
      @foreach($diseases as $d)
        <option value="{{ $d->id }}">{{ $d->name }}</option>
      @endforeach
    </select>
  </div>

  <button class="btn btn-primary">Save</button>
  <a class="btn btn-secondary" href="{{ route('medicines.index') }}">Cancel</a>
</form>
@endsection
