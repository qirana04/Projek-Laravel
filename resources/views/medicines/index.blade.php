@extends('layouts.app')
@section('title','Medicines')
@section('content')
<div class="d-flex justify-content-between mb-3">
  <h1>Medicines</h1>
  <div>
    <a href="{{ route('medicines.create') }}" class="btn btn-primary">Add Medicine</a>
    <a href="{{ route('diseases.create') }}" class="btn btn-secondary">Add Disease</a>
  </div>
</div>

@if($medicines->count())
  <div class="row">
    @foreach($medicines as $m)
      <div class="col-md-4 mb-3">
        <div class="card h-100">
          <div class="card-body">
            <h5 class="card-title">{{ $m->name }}</h5>
            <p class="card-text">{{ \Illuminate\Support\Str::limit($m->functions, 120) }}</p>
            <p>
              @foreach($m->diseases as $d)
                <span class="badge bg-info text-dark">{{ $d->name }}</span>
              @endforeach
            </p>
            <a href="{{ route('medicines.show', $m) }}" class="btn btn-sm btn-outline-primary">View</a>
            <a href="{{ route('medicines.edit', $m) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
            <form action="{{ route('medicines.destroy', $m) }}" method="post" class="d-inline" onsubmit="return confirm('Delete?')">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-danger">Delete</button>
            </form>
          </div>
        </div>
      </div>
    @endforeach
  </div>
  <div class="mt-3">{{ $medicines->links() }}</div>
@else
  <p>No medicines yet.</p>
@endif
@endsection
